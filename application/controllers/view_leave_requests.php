<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class View_leave_Requests extends CI_Controller {
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
	  $data['page_title']="Leave Requests";
	  $data['leave_requests']=$this->leave_lib->all_leave_request();
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	  $this->load->view('list_leave_request',$data);
	  $this->load->view('footer');
	}
	public function view()
	{
		
	}
		
}
?>