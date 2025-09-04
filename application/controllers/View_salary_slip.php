<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_salary_slip extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->model(array('report_model','salary_model'));
	   $this->load->library(array('form_validation'));
	  
    }
	public function index($id=0)
	{
			if(is_numeric($id) && (!empty($id)) )
			{
				$user_id=$this->session->userdata['logged_in']['user_id'];
				$page_name=$this->router->fetch_class();
				$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
			  	$data['page_title']="Salary Slip";
			  /*	$date=new DateTime();
			  	$date->modify('-1 month');
			  	$date1=$date->format('Y-m');
			  	$month=explode('-',$date1);*/
			  	$this->load->view('header',$data);
				$this->load->view('side_menu_admin',$data);
				$this->load->view('salary_slip_view',$data);
				$this->load->view('footer');
			}
			else
			{
				echo "hi asdsa";
			}
	}
	
	
}

?>