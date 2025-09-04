<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_claim_requests extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	   $this->load->model('allowance_model');
    }
	public function index()
	{
		  $user_id=$this->session->userdata['logged_in']['user_id'];
		  $page_name=$this->router->fetch_class();
		  $data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		  $data['allowance_list']=$this->allowance_model->allowance_report_user($user_id);
		 /* $data['employees_list']=$this->allowance_model->allowance_list();
		  $data['allowance_list']=$this->allowance_model->allowance_types();*/
		  $data['page_title']="Allowance Reports";
			  $this->load->view('header',$data);
			  $this->load->view('employee/side_menu_employee',$data);
			  $this->load->view('employee/employee_claim_requests',$data);
			  $this->load->view('footer');
	}
}
?>