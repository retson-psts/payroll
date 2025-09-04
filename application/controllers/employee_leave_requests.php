<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_leave_requests extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation','leave_lib'));
    }
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['page_title']="List Leave Request";
		$data['leave_requests']=$this->leave_lib->list_leave_request();
		$data['message_div']='';
		if(isset($this->session->userdata['form']['employee_request_leave']['status']))
		{
			$status=$this->session->userdata['form']['employee_request_leave']['status'];
			$message=$this->session->userdata['form']['employee_request_leave']['message'];
			if($status==1)
			{
				$data['message_div']= '<div class="alert alert-success alert-dismissable">
									  <i class="fa fa-check"></i>
									  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									  <b>Alert! </b>'.$message.'</div>';
				$this->session->unset_userdata('form');
			}
			else
			{
				$data['message_div']='<div class="alert alert-danger alert-dismissable">
									  <i class="fa fa-ban"></i>
									  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									  <b>Alert! </b>'.$message.'</div>';
				$shortlist = $this->session->userdata('form');
				unset($shortlist['employee_request_leave']['message'],$shortlist['employee_request_leave']['status']);
				$this->session->set_userdata('form',$shortlist);
			}
		}
		$this->load->view('header',$data);
		$this->load->view('employee/side_menu_employee',$data);
		$this->load->view('employee/employee_leave_requests',$data);
		$this->load->view('footer');
	}
}
?>