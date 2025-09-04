<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Login extends CI_Controller
{
    public function __construct()
    {
            
            parent::__construct();   
          
        $this->load->library(array(
            'form_validation'
        ));
   
        $this->load->model(array(
            'user'
        ));
        $this->load->helper('string');
    }

    public function test()
    {
        echo json_encode("aaa1");
        echo json_encode([]);die;
    }
    public function index()
    {
       
        if (!isset($this->session->userdata[user_id]))
        {
           
            $data['username'] = '';
            if (isset($this->session->userdata['form']))
            {
                
                $error               = $this->session->userdata['form'];
                $data['login_error'] = $error['login']['message'];
                if (isset($error['login']['form_data']['username']))
                {
                    $data['username'] = $error['login']['form_data']['username'];
                }
                $this->session->unset_userdata('form');
            }
            $data['page_title'] = 'Login';
            $this->load->helper(array(
                'form'
            ));
            
            $this->load->view('login_test', $data);
        }
        else
        {
            redirect(site_path . 'home', 'refresh');
        }
       

    }
    public function login_val()
    {
        
    	if ($this->form_validation->run('login') !== false)
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
                    //$_SESSION[user_id]=$last_id;
                    $this->session->set_userdata(user_id, $last_id);
                    $this->session->set_userdata('user', $contents[0]);
                    $result     = $this->user->login($data['username'], $data['password']);
                    $sess_array = array();
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
                            'gender' => $row->gender
                        );
                    }
                    
                    $this->session->set_userdata('logged_in', $sess_array);
                    $company_details = $this->common_model->__fetch_contents('company_config', array(), '*');                  
                    $this->session->set_userdata('company', $company_details[0]);
                   
                    if (isset($this->session->userdata['url_login']))
                    {     
                           
                        $url = $this->session->userdata['url_login'];   
                                              
                        unset($this->session->userdata['url_login']);                      
                        redirect(site_path . $url, 'refresh');
                    }
                    else
                    {       
                                     
                        redirect(site_path, 'refresh');
                    }
                   
                }
                else
                {
                    $data1['log_password'] = $this->input->post('user_password');
                    $last_id               = $this->common_model->insert_table_lastid('failure_log', $data1);
                    $message               = "Username or password mismatched";
                    $report                = array(
                        'status' => 0,
                        'form_data' => $this->input->post(),
                        'message' => $message
                    );
                    $this->session->set_userdata('form', array(
                        'login' => $report
                    ));
                    redirect(site_path . 'Login', 'refresh');
                }
            }
            else
            {
                $data1['log_password'] = $this->input->post('user_password');
                $last_id               = $this->common_model->insert_table_lastid('failure_log', $data1);
                $message               = "Username or password mismatched";
                $report                = array(
                    'status' => 0,
                    'form_data' => $this->input->post(),
                    'message' => $message
                );
                $this->session->set_userdata('form', array(
                    'login' => $report
                ));
                redirect(site_path . 'login', 'refresh');
            }
        }
        else
        {
          
            $data1['log_password'] = $this->input->post('user_password');
           
            $last_id               = $this->common_model->insert_table_lastid('failure_log', $data1);
           
            $message               = validation_errors();
            $report                = array(
                'status' => 0,
                'form_data' => $this->input->post(),
                'message' => $message
            );
            
            $this->session->set_userdata('form', array(
                'login' => $report
            ));
          
            redirect(site_path . 'login', 'refresh');
        }
    }
    public function send()
    {
        if ($this->input->is_ajax_request())
        {
            $this->load->library('form_validation');
            if ($this->form_validation->run('forget_password') !== false)
            {
                $this->verify_email($this->input->post('email'));
                $message = 'Check Your Email Spam also';
                $report  = array(
                    'status' => 1,
                    'message' => $message,
                    'url' => ""
                );
                echo json_encode($report);
                exit;
            }
            else
            {
                $report  = array(
                    'status' => 0,
                    'message' => $this->form_validation->error_array(),
                    'url' => ""
                );
                echo json_encode($report);
                exit;
            }
        }
        else
        {
            show_error("No direct access allowed");
        }
    }
    public function check_databases($password)
    {
        $username = $this->input->post('username');
        $result   = $this->user->login($username, $password);
        // print_r($result);die();
        if ($result)
        {
            $sess_array = array();
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
                    'gender' => $row->gender
                );
                /* var_dump($sess_array);
                die();*/
            }
            // create the session variable
            $this->session->set_userdata('logged_in', $sess_array);
            $company_details = $this->common_model->__fetch_contents('company_config', array(), '*');
            $this->session->set_userdata('company', $company_details[0]);
            // insert the session in to db
            $this->user->insert_session('1');
            return TRUE;
        }
        else
        {
            $this->form_validation->set_message('callback_check_databases', 'Invalid username or password');
            return false;
        }
    }
    
    public function verify()
    {
        if (isset($_GET['key']))
        {
        	
            $key    = $_GET['verify_key'];
            $user_id=urldecode($_GET['key']);
            $result = $this->common_model->__fetch_contents('reset_password',array('user_email'=>$user_id,'reset_key'=>$key,'reset_disabled <>'=>1,'reset_completed <>'=>1),'max(reset_password_id) as id,reset_tried');
            if (!empty($result[0]['id']))
            {
            	$try=$result[0]['reset_tried']+1;
            	$this->common_model->update_table_custom('reset_password',array('reset_tried'=>$try),array('reset_password_id'=>$result[0]['id']));
            	$data['message']="";
            	$data['password']="";
            	$data['cpassword']="";
                if (isset($this->session->userdata['forget1']))
                {
                    $data['message'] = $this->session->userdata('forget1');
                    $data['password']=$this->session->userdata('password');
                    $data['cpassword']=$this->session->userdata('cpassword');
                    $this->session->unset_userdata('forget1');
                    $this->session->unset_userdata('password');
                    $this->session->unset_userdata('cpassword');
                }
                $this->session->set_userdata('forget_id',$result[0]['id']);
                $this->load->view('reset_password', $data);
            }
            else
            {
                redirect(site_path . "login", 'refresh');
            }
        }
    }
	public function reset_password()
	{
		if ($this->form_validation->run('reset_password') !== false)
        {
           $password=$this->input->post('password');
           $forget_id=$this->session->userdata('forget_id');
           $reset=$this->common_model->__fetch_contents('reset_password',array('reset_password_id'=>$forget_id),'user_id as id');
           $result=$this->common_model->password_update($password,$forget_id,$reset[0]['id']);
           if(!empty($result))
           {
		   
		   			$report                = array(
                        'status' => 0,
                        'message' => '<p>Password Reset Successfull. Please login with new password</P>'
                    );
                    $this->session->set_userdata('form', array(
                        'login' => $report
                    ));
                    redirect(site_path.'login','refresh');
		   	
		   }
		   else
		   {
		   		$this->session->set_userdata('forget1','<p>Something Wrong please try again</p>');
	           $this->session->set_userdata('password',$this->input->post('password'));
	           $this->session->set_userdata('cpassword',$this->input->post('cpassword'));
	           redirect($_SERVER['HTTP_REFERER'],'refresh');
		   	
		   }
           
        }
        else
        {
        
           $this->session->set_userdata('forget1',validation_errors());
           $this->session->set_userdata('password',$this->input->post('password'));
           $this->session->set_userdata('cpassword',$this->input->post('cpassword'));
           redirect($_SERVER['HTTP_REFERER'],'refresh');
        }
	}
    protected function verify_email($email_id)
    {
    	$email=$this->common_model->__fetch_contents('users',array('email'=>$email_id),'user_id,email,employee_id');
    	
    	
        $email_random = random_string('unique');
        $data['user_id']=$email[0]['user_id'];
        $data['sending_time']=date('Y-m-d H:i:s');
        $data['user_email']=$email[0]['email'];
        $data['reset_key']=$email_random;
        //var_dump($data);
        $update=$this->common_model->update_table_custom('reset_password',array('reset_disabled'=>1),array('user_email'=>$email_id,'user_id'=>$data['user_id'],'reset_completed <>'=>1));
        $insert_verify_email_details=$this->common_model->insert_table('reset_password',$data);
       $encrypt=urlencode($email_id);
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
            $html = 'Dear User,<br>Please click on below URL or paste into your browser to verify your Email Address<br><a href="' . site_path . 'login/verify?key='.$encrypt.'&verify_key=' . $email_random . '">click here</a> <br> copy this url ' . site_path . 'login/verify?key='.$encrypt.'&verify_key=' . $email_random . ' <br><br>Thanks<br><br>Admin Team<br><a href="' . site_path . '">DWZ Payroll</a>';
            $this->email->message($html);
            $this->email->send();
        }
      //var_dump(site_path . 'login/verify?key='.$encrypt.'&verify_key=' . $email_random);
    }
	public function existemail($email)
	{
    
    $email=$this->common_model->__fetch_contents('users',array('email'=>$email),'*'); 
    if($email==FALSE)
    {
    		$this->form_validation->set_message('existemail', 'Email id not exist please try again');
			return FALSE;
	}
	else
	{
			return TRUE;
	}
		
	}
}
