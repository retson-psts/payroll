<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sample_salary_slip extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	  
    }
	public function index()
	{
			$user_id=$this->session->userdata['logged_in']['user_id'];
 			$page_name=$this->router->fetch_class();
				$user_details=$this->users_lib->get_logged_user_details($user_id);
			  $data['user_details']=$user_details;
 			  $data['page_title']="Sample Salary Slip";
			  $this->load->view('header',$data);
			  if($user_details->user_group_id=='1')
			  {
				  $this->load->view('side_menu_admin',$data);
			  }
			  else
			  {
				  $this->load->view('employee/side_menu_employee',$data);
			  }
			  $this->load->view('sample_salary_slip_view',$data);
			  $this->load->view('footer');
	}
}
?>