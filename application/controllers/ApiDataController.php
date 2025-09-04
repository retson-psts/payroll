<?php

class ApiDataController extends CI_Controller {
 
	public function __construct()
	 {
	   parent::__construct();
       $this->load->helper('custom_helper');
       $this->load->model('common_model');
       $this->load->model('projects_model');
       $this->load->model('employee_model');
       $this->load->library('upload');
       $this->load->library('form_validation');
       $this->load->helper('string');
       $this->load->helper('error'); // Ensure the custom error handler is loaded

       // Set the custom error handler
       set_error_handler('custom_error_handler');
	  // $this->load->model();
    }
	public function employee_login()
	{  
            $data['username']             = $this->input->post('username');
            $contents                     = $this->common_model->__fetch_contents('users', $data);
            $data1['log_entertime']       = date('Y-m-d H:i:s');
            $data1['log_enter_ipaddress'] = $this->input->ip_address();
            $data1['log_result']          = 0;
            $data1['log_valid_till']      = time() + valid_till;
            $data1['log_user']            = 0;
            $data1['log_browser']         = $_SERVER['HTTP_USER_AGENT'];
            $data1['log_time_of_sec']     = date('Y-m-d H:i:s');
            $data1['log_session_id']      = session_id();
            $data1['log_last_accessed']   = time();
            if ($contents !== false)
            {
                $pass_old = $contents[0]['password'];
                if ($pass_old == md5($this->input->post('password')))
                {
                    
                    $data['password']    = $this->input->post('password');
                    $data1['log_result'] = 1;
                    $data1['log_user']   = $contents[0]['user_id'];
                    $last_id             = $this->common_model->insert_table_lastid('log', $data1);
                
                    $result     = $this->user->login($data['username'], $data['password']);
                    $sess_array = array();
                    $token=encryptor("encrypt",$contents[0]['user_id']."-".convertDatetoepoch());
                    // $etoken=encryptor("decrypt",$token);
                    foreach ($result as $row)
                    {
                        $sess_array = array(
                            'user_id' => $row->user_id,
                            'employee_id' => $row->employee_id,
                            'username' => $row->username,
                            'first_name' => $row->first_name,
                            'last_name' => $row->last_name,
                            'email' => $row->email,
                            'group_id' => $row->group_id,
                            'photo_url' => $row->photo_url,
                            'joined_date' => $row->joined_date,
                            'gender' => $row->gender,
                            'token'=>$token,
                            'expired_at'=>date('Y-m-d H:i:s', strtotime('+1 year'))
                        );
                    }
                    // $company_details = $this->common_model->__fetch_contents('company_config', array(), '*');  
                    $update_token=$this->common_model->update_table_custom('users',array("is_mlogin"=>1,"mlogin_token"=>$token),array("user_id"=>$contents[0]['user_id']));   
                    echo returnResponse(true,"Sucessfully logged in",$sess_array,3,200);                   
                }
                else
                {
                    $data1['log_password'] = $this->input->post('user_password');
                    $last_id               = $this->common_model->insert_table_lastid('failure_log', $data1);
                    $message               = "Username or password mismatched";     
                         
                    echo returnResponse(false,$message,'No data found',1,400);   
                }
            }
            else
            {
                $data1['log_password'] = $this->input->post('user_password');
                $last_id               = $this->common_model->insert_table_lastid('failure_log', $data1);
                $message               = "Username or password mismatched";
                echo returnResponse(false,$message,'No data found',1,400);   
            }      
      
    }
    public function employee_logout()
	{
        $data['user_id']             = $this->input->post('user_id'); 
        $update_token=$this->common_model->update_table_custom('users',array("is_mlogin"=>0,"mlogin_token"=>""),array("user_id"=>$data['user_id']));   
        echo returnResponse(true,"Sucessfully logged out","No data found",3,200);      
    }
    public function checkcurrentuser1(){
        $user_id=$this->input->post('user_id');
        $token=$this->input->post('token');
        $check_user=checkcurrentuser($user_id,$token);
        echo $check_user;
    }

    private function set_upload_options() {
        $config = array();
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
        $config['max_size'] = '5120';
        $config['encrypt_name'] = TRUE;

        return $config;
    }
    private function create_upload_directory($path) {
       
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    }
    public function add_attandance(){

        $params = $this->input->post();
        log_message('error', 'Received parameters: ' . json_encode($params,true));
        $this->form_validation->set_rules('job_date', 'job_date', 'required');
        $this->form_validation->set_rules('user_id', 'user id', 'required');
        $this->form_validation->set_rules('clock_in', 'clock in', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
       
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, load the form again with errors
            echo returnResponse(false,"validation error",validation_errors(),2,400); 
            exit;
        }
        $this->create_upload_directory('./uploads/');
        $this->upload->initialize($this->set_upload_options());

      
        $token="";
         $header_value = $this->input->get_request_header('Authorization', TRUE);
         if ($header_value !== NULL) {
            $token = substr($header_value, 7);
         }
         $data['job_date']=$this->input->post('job_date');
         $data['created_by']=$this->input->post('user_id');
         $data['clock_in']=$this->input->post('clock_in');
         $data['clock_in_location']=$this->input->post('location');
         $data['job_date']=$this->input->post('job_date');
         $data['project_id']=$this->input->post('project_id');
         $data['present']=1;

         if(checkcurrentuser($data['created_by'],$token)){
           
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            echo returnResponse(true,$error['error'],"No Data found",2,400); 
            // $this->load->view('file_upload_view', $error);
        } else {
            $data1 = $this->upload->data();
             $data['clock_in_file']=$data1['file_name'];
             $result=$this->common_model->insert_table('attendance_mark',$data);
            
             if($result){
                echo returnResponse(true,"Attendance data added",$data,3,200); 
             }else{
                echo returnResponse(false,"some thing went wrong!","No Data found",2,400); 
             }
        }
              
         }else{
            echo returnResponse(false,"Auth error","No data found",2,401);     
         }
        
    }

    public function add_check_out(){
        $this->create_upload_directory('./uploads/');
        $this->upload->initialize($this->set_upload_options());

        $this->form_validation->set_rules('job_date', 'job_date', 'required');
        $this->form_validation->set_rules('user_id', 'user id', 'required');
        $this->form_validation->set_rules('clock_out', 'clock in', 'required');
        $this->form_validation->set_rules('location', 'location', 'required');
        if ($this->form_validation->run() == FALSE) {
            // Validation failed, load the form again with errors
            echo returnResponse(false,"validation error",validation_errors(),2,400); 
            exit;
        }
        $token="";
         $header_value = $this->input->get_request_header('Authorization', TRUE);
         if ($header_value !== NULL) {
            $token = substr($header_value, 7);
         }
         $data['job_date']=$this->input->post('job_date');
         $data['created_by']=$this->input->post('user_id');
         $data['clock_out']=$this->input->post('clock_out');
         $data['clock_out_location']=$this->input->post('location');
         $data['job_date']=$this->input->post('job_date');
         if(checkcurrentuser($data['created_by'],$token)){
           
        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            echo returnResponse(true,$error['error'],"No Data found",2,400); 
            // $this->load->view('file_upload_view', $error);
        } else {
             $data_id=$this->common_model->__fetch_contents('attendance_mark',array("DATE(`job_date`)"=>$data['job_date'],"created_by"=>$data['created_by'],"clock_out"=>null));
  
            $data1 = $this->upload->data();
             $data['clock_out_file']=$data1['file_name'];
             $result=$this->common_model->update_table('attendance_mark',$data,$data_id[0]['attendance_mark_id']);
            
             if($result){
                echo returnResponse(true,"Attendance data added",$data,3,200); 
             }else{
                echo returnResponse(false,"some thing went wrong!","No Data found",2,400); 

             }
        }
              
         }else{
            echo returnResponse(false,"Auth error","No data found",2,401);     
         }
        
    }

    public function projects_list(){
        $data['created_by']=$this->input->post('user_id');
        $token="";
        $header_value = $this->input->get_request_header('Authorization', TRUE);
        if ($header_value !== NULL) {
           $token = substr($header_value, 7);
        }
        if(checkcurrentuser($data['created_by'],$token)){
        $data['project_list']=$this->projects_model->list_projects();
        if($data['project_list']){
            echo returnResponse(true,"User Project Data",$data['project_list'],3,200); 
         }else{
            echo returnResponse(false,"some thing went wrong!","No Data found",2,400); 
         }
        }else{
            echo returnResponse(false,"Auth error","No data found",2,401);    
        }
    }

    public function attendance_list(){
        $data['created_by']=$this->input->post('user_id');
        $token="";
        $header_value = $this->input->get_request_header('Authorization', TRUE);
        if ($header_value !== NULL) {
           $token = substr($header_value, 7);
        }
        if(checkcurrentuser($data['created_by'],$token)){
        $data['list']=$this->common_model->__fetch_contents('attendance_mark',array("created_by"=>$data['created_by']),'IF(c1202_attendance_mark.present, "Present", "Absent") as status,attendance_mark.*','','job_date,clock_in desc');
        if($data['list']){
            echo returnResponse(true,"User Project Data",$data['list'],3,200); 
         }else{
            echo returnResponse(false,"some thing went wrong!","No Data found",2,400); 
         }
        }else{
            echo returnResponse(false,"Auth error","No data found",2,401);    
        }
    }

    public function employee_details(){
        $data['created_by']=$this->input->post('user_id');
        $token="";
        $header_value = $this->input->get_request_header('Authorization', TRUE);
        if ($header_value !== NULL) {
           $token = substr($header_value, 7);
        }
        if(checkcurrentuser($data['created_by'],$token)){
        $data['list']=array("present"=>3,"Absent"=>0,"avaiable_leave"=>10);
        if($data['list']){
            echo returnResponse(true,"User Project Data",$data['list'],3,200); 
         }else{
            echo returnResponse(false,"some thing went wrong!","No Data found",2,400); 
         }
        }else{
            echo returnResponse(false,"Auth error","No data found",2,401);    
        }
    }

    public function check_in_auth(){
        $data['created_by']=$this->input->post('user_id');
        $token="";
        $header_value = $this->input->get_request_header('Authorization', TRUE);
        if ($header_value !== NULL) {
           $token = substr($header_value, 7);
        }
        if(checkcurrentuser($data['created_by'],$token)){
             $last_check_in_details=$this->common_model->__fetch_contents('attendance_mark',array("created_by"=>$data['created_by'],"clock_out"=>null));
             if($last_check_in_details){  
               $last_check_in_time = new DateTime($last_check_in_details[0]['job_date']." ".$last_check_in_details[0]['clock_in']);
               $current_time = new DateTime();
               $interval = $last_check_in_time->diff($current_time);            
              if ($interval->days >= 1) { 
                 echo returnResponse(false,"You have not checked out for more than 24 hours. Please contact the admin.",$last_check_in_details[0],2,400);                 
              }else{ 
                  echo returnResponse(true,"User Project Data",$last_check_in_details[0],3,200); 
              }            
              }else{
                $Response['present'] = 1;
                $Response['job_date'] = date("Y-m-d");
                $Response['clock_in'] = "08:00:00";
                $Response['clock_out'] = NULL;
                $Response['created_at'] = date("Y-m-d H:i:s");
                $Response['created_by'] = $this->input->post('user_id');
                
                $result=$this->common_model->insert_table('attendance_mark',$Response);
                if($result > 0)
                {
                    $last_check_in_details=$this->common_model->__fetch_contents('attendance_mark',array("job_date"=>$Response['job_date'],"created_by"=>$data['created_by'],"clock_out"=>null));
                }
                echo returnResponse(false,"User not checked in!",$last_check_in_details[0],2,400); 
              }
            
        }else{
            echo returnResponse(false,"Auth error","No data found",2,401);    
        }
    }

    public function user_details(){
        $data['created_by']=$this->input->post('user_id');
        $token="";
        $header_value = $this->input->get_request_header('Authorization', TRUE);
        if ($header_value !== NULL) {
           $token = substr($header_value, 7);
        }
        if(checkcurrentuser($data['created_by'],$token)){
             $user_details=$this->employee_model->employee_details_using_user_id($data['created_by']);
             if($user_details){  
              
                 echo returnResponse(true,"User Data Found",$user_details[0],3,200);                 
                 
              }else{
                echo returnResponse(false,"Data not found",array(),2,400); 
              }
            
        }else{
            echo returnResponse(false,"Auth error","No data found",2,401);    
        }
    }

    public function change_password(){
        $data['created_by']=$this->input->post('user_id');
        $data['password']=$this->input->post('password');
        $token="";
        $header_value = $this->input->get_request_header('Authorization', TRUE);
        if ($header_value !== NULL) {
           $token = substr($header_value, 7);
        }
        if(checkcurrentuser($data['created_by'],$token)){
             $user_details=$this->common_model->password_update($data['password'],'',$data['created_by']);
             if($user_details){  
              
                 echo returnResponse(true,"Password has changed",$user_details,3,200);                 
                 
              }else{
                echo returnResponse(false,"something went wrong",array(),3,400); 
              }
            
        }else{
            echo returnResponse(false,"Auth error","No data found",2,401);    
        }
        
    }
public function change_password1(){
        $data['created_by']=$this->input->post('user_id');
        $data['password']=$this->input->post('password');
        $token="";
        $header_value = $this->input->get_request_header('Authorization', TRUE);
        if ($header_value !== NULL) {
           $token = substr($header_value, 7);
        }
        if(checkcurrentuser($data['created_by'],$token)){
             $user_details=$this->common_model->password_update($data['password'],'',$data['created_by']);
             if($user_details){  
              
                 echo returnResponse(true,"Password has changed",$user_details,3,200);                 
                 
              }else{
                echo returnResponse(false,"something went wrong",array(),2,400); 
              }
            
        }else{
            echo returnResponse(false,"Auth error","No data found",2,401);    
        }
        
    }
public function forget_password(){
    $email=$this->input->post('email');
    $this->load->library('form_validation');
    $email=$this->common_model->__fetch_contents('users',array('email'=>$email),'*'); 
    if ($email !== false)
    {
      $result=$this->verify_email($this->input->post('email'));
      echo returnResponse(true,"Check Your Email Spam also",$result[0],3,200);   
    }else{
        echo returnResponse(false,"Email id not exist please try again","No data found",2,400);     
    }
}
protected function verify_email($email_id)
{
    $email=$this->common_model->__fetch_contents('users',array('email'=>$email_id),'user_id,email,employee_id');
     
    $email_otp = rand(1000, 9999);    
    $email_random_text = random_string('unique');
    $data['user_id']=$email[0]['user_id'];
    // $data['sending_time']=date('Y-m-d H:i:s');
    $data['mail']=$email[0]['email'];
    $data['encrypt_text']=$email_random_text;
    $data['otp']=$email_otp;
    $data['status']=1;

    //var_dump($data);
    // $update=$this->common_model->update_table_custom('reset_password',array('reset_disabled'=>1),array('user_email'=>$email_id,'user_id'=>$data['user_id'],'reset_completed <>'=>1));
    $insert_verify_email_details=$this->common_model->insert_table('forget_password_otp_transaction',$data);
   //    $encrypt=urlencode($email_id);
    if ($insert_verify_email_details == true)
    {
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset']  = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->from('info@getln.com', 'getln');
        $this->email->to($email_id);
        $this->email->subject('Verify Email from DWZ Payroll');
        $html = 'Dear User,<br>OTP: '.$email_otp.'<br>';
        $this->email->message($html);
        $this->email->send();
        return $data;
    }
    
  //var_dump(site_path . 'login/verify?key='.$encrypt.'&verify_key=' . $email_random);
}
public function validate_otp(){
    $otp=$this->input->post('otp');
    $encrypt_text=$this->input->post('encrypt_text');

    $this->load->library('form_validation');
    $otp_validate=$this->common_model->__fetch_contents('forget_password_otp_transaction',array('otp'=>$otp,"otp"=>$otp,"encrypt_text"=>$encrypt_text,"status"=>1),'*'); 
    if($otp_validate){
        $data['status']=0;
        $id=$otp_validate[0]['forget_password_otp_transaction_id'];
        
        $update=$this->common_model->update_table('forget_password_otp_transaction',$data,$id);
        echo returnResponse(true,"OTP verified",$otp_validate[0],3,200);  
    }else{
        echo returnResponse(false,"Enter correct OTP","No data found",2,400);  
    }
}
public function reset_password(){
    if ($this->form_validation->run('reset_password') !== false)
    {
        $password=$this->input->post('password');
        $user_id=$this->input->post('user_id');
        $result=$this->common_model->password_update($password,"",$user_id);
        if(!empty($result))
           {
            echo returnResponse(true,"password changed",array(),3,200); 
           }else{
            echo returnResponse(false,"something went wrong",array(),2,400); 
           }
    }else{
        echo returnResponse(false,"password_mismatch",validation_errors(),2,400);  
    }
}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
