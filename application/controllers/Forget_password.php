<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Forget_password extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	  // $this->load->library();
	   $this->load->model('employee_model');
    }
	public function index()
	{
		$page_name=$this->router->fetch_class();
		$data['page_title']="Company Settings";
		$data['message_div']="Enter Mail Id";
		if(isset($this->session->userdata['forget']))
		{
			$data['message_div']=$this->session->userdata['forget'];
			$this->session->unset_userdata('forget');
		}
		
		$this->load->view('forget_password_view',$data);
	}
	public function send()
	{
		$this->load->library('form_validation');
		if($this->form_validation->run('forget_password')!==false)
		{
			$this->verify_email($this->input->post('email'));
			$this->session->set_userdata('forget','Check your Mail');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
		else
		{
			$this->session->set_userdata('forget','Email id is not valid');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
			
		}
		
	}
	public function reset_password()
	{
		$this->load->library('form_validation');
		if($this->form_validation->run('reset_password')!==false)
		{
			if($this->input->post('username')==$this->input->post('password'))
			{
				$data['password']=md5($this->input->post('username'));
				$insert_verify_email_details=$this->employee_model->update_user_common($data,0);
				$errors=array('Password Reset successfully. <br>Login with new password');
			  $this->session->set_userdata('login_error',$errors);
			  redirect(site_path."login",'refresh');
			  
			}
			else
			{
				$this->session->set_userdata('forget1','Password not matched');
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
		}
		else
		{
			$this->session->set_userdata('forget1','Password not valid');
			redirect($_SERVER['HTTP_REFERER'],'refresh');
			
		}
		
	}
	public function verify()
	{
		if(isset($_GET['user_id']))
		{
			$key=$_GET['verify_key'];
			$result=$this->employee_model->user_reset($_GET['user_id'],$_GET['verify_key']);
			if($result!==false)
			{
				$data=array();
				if(isset($this->session->userdata['forget1']))
				{
					$data['message']=$this->session->userdata('forget1');
				}
				$this->load->view('reset_password',$data);
				
			}
			else
			{
				$this->session->set_userdata('forget','Link May expire please try again');
				redirect(site_path."forget_password",'refresh');
			}
			
			
		}
	}
	
	protected function verify_email($email_id)
   {
	   $email_random=random_string('unique');
	   
	   ///sms
	   
 	
	   
   $data=array(
  		
		'validate'	=>$email_random,
		
  );
   $insert_verify_email_details=$this->employee_model->update_user_common($data,0);
  if($insert_verify_email_details == true)
  { 
  
  
  
 // echo base_url("recruiter/verify").'?user_id='.$user_id.'&'.'verify_key='.$email_random;
   		 $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
		$this->load->library('email');
        $this->email->initialize($config);

        $this->email->from('info@getln.com', 'getln');
        $this->email->to($email_id);

        $this->email->subject('Verify Email from DWZ Payroll');
        $html = 'Dear User,<br>Please click on below URL or paste into your browser to verify your Email Address<br><a href="'.site_path.'forget_password/verify?user_id=0&verify_key='.$email_random.'">click here</a> <br> copy this url '.site_path.'forget_password/verify?user_id=0&verify_key='.$email_random.' <br><br>Thanks<br><br>Admin Team<br><a href="'.site_path.'">DWZ Payroll</a>';
        $this->email->message($html);

        $this->email->send();

 	 
	  
	  
	  
    }
    }
	
}
