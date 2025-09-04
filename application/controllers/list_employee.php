<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class List_employee extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	   $this->load->model(array('employee_model'));
    }
	public function index()
	{
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['user_details']=$this->users_lib->get_logged_user_details($user_id);
	  $employees=$this->employee_model->list_employees1();
	  $data['employees_list']=$this->calculate_percent($employees);
	  //var_dump($data['employees_list']);
	  $data['page_title']="List Employees";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	  $this->load->view('list_employees',$data);
	  $this->load->view('footer');
	}
	private function calculate_percent($employee_list)
	{
		if($employee_list!==FALSE)
		{
			foreach($employee_list as $key=>$item)
			{
			  $employee_list[$key]['percent']=$this->percent_details($item['add_stat']);
			  $employee_list[$key]['complete']=$this->complete_step($item['add_stat']);
			  	
			}
			return $employee_list;
		}
		else
		{
			return $employee_list;
		}
	}
	private function percent_details($stat)
	{
		switch($stat)
		{
			case 1:
			  return 15;
			case 2:
			  return 30;
			case 3:
			  return 35;
			case 4:
			  return 40;
			case 5:
			  return 55;
			case 6:
			  return 70;
			case 7:
			  return 75;
			case 8:
			  return 80;
			case 9:
			  return 85;
			case 10:
			  return 90;
			case 11:
			  return 95;
			case 12:
			  return 100;
			
			
		}
		
	}
	private function complete_step($stat)
	{
		switch($stat)
		{
			case 1:
			  return 'employee_contact';
			case 2:
			  return 'employee_emergency';
			case 3:
			  return 'employee_dependents';
			case 4:
			  return 'employee_immigration';
			case 5:
			  return 'employee_job_details';
			case 6:
			  return 'employee_salary';
			case 7:
			  return 'employee_report';
			case 8:
			  return 'employee_qualification';
			case 9:
			  return 'employee_skills';
			case 10:
			  return 'employee_photo';
			case 11:
			  return 'employee_bank';
			case 12:
			  return 'employee_profile';
			
			
		}
		
	}

}
?>