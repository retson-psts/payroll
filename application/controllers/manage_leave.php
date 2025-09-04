<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_leave extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	  // $this->load->library();
	  // $this->load->model();
    }
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		//$data['message_div']=$this->messages();
		$data['form_data']=array('emp_number'=>'','emp_lastname'=>'','emp_firstname'=>'','emp_middle_name'=>'','emp_birthday'=>'','nation_code'=>'','emp_gender'=>'','emp_marital_status'=>'','emp_other_id'=>'','emp_dri_lice_num'=>'','emp_dri_lice_exp_date'=>'','emp_dri_lice_exp'=>'','username'=>'','password'=>'','emp_licence_type'=>'');
		$data['update_panel']=false;
		$data['page_title']="Manage Leave";
		$this->load->view('header',$data);
	    $this->load->view('side_menu_admin',$data);
	   // $this->load->view('allowance_list',$data);
	    $this->load->view('footer');
	}
	
}
