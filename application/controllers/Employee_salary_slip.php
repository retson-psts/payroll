<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employee_salary_slip extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->model(array('report_model','salary_model'));
	   $this->load->library(array('form_validation'));
	  
    }
	public function index()
	{
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$employee_id=$this->session->userdata['logged_in']['employee_id'];
			$page_name=$this->router->fetch_class();
			$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		  	$data['page_title']="Salary Slip";
		  	$date=new DateTime();
		  	$date->modify('-1 month');
		  	$date1=$date->format('Y-m');
		  	$month=explode('-',$date1);
		  	$data['salary_slips']=$this->custom_encrypt($this->salary_model->show_result_employee($employee_id),'salary_master_id');
		  	
		  	//var_dump($data['salary_slips']);
			$this->load->view('header',$data);
			$this->load->view('employee/side_menu_employee',$data);
			$this->load->view('employee/salary_slip_employee',$data);
			$this->load->view('footer');
	}
	
	public function view($id)
	{
		if(is_numeric($id) && (!empty($id)) )
		{
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$page_name=$this->router->fetch_class();
			$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		  	$data['page_title']="Salary Slip";
		  	$company_details=$this->common_model->__fetch_contents('company_config',array(),'*');
		  	//var_dump($company_details);
		  	$data['company_details']=$company_details[0];
		  	$total_details=$this->salary_model->salary_view($id);
		  	$data['total_details']=$total_details[0];
		  	$this->load->view('header',$data);
			$this->load->view('employee/side_menu_employee',$data);
			$this->load->view('employee/salary_slip_view',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(site_path,'redirect');
		}
	}
	
	
    private function custom_encrypt($array,$column)
    {
    	$this->load->library('encrypt');
    	//var_dump($array);
    	
		foreach($array as $key => $value){
			
//		 	$array[$key][$column]=$this->encrypt->encode($value[$column]);
		 	
		 }
		 return $array;
		 
	}
	
}

?>