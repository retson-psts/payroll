<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bank extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	 $this->load->library('form_validation');
	  // $this->load->model();
    }
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$contents=$this->common_model->fetch_contents('company_config',array('company_id'=>1));
		$data['menu']=12;
	  	$data['menu1']=122;
	  	$data['bank_details']=$this->common_model->fetch_contents('company_bank_details',array());
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['page_title']="Bank Details";
		$this->load->view('header',$data);
	    $this->load->view('side_menu_admin',$data);
	    $this->load->view('bank_view',$data);
	    $this->load->view('footer');
	}
	public function update_bank()
	{
		$data=$this->input->post();
		$update=$this->common_model->update_table_custom('company_bank_details',$data,array('bank_id'=>'1'));
		if($update==true)
		{
			echo json_encode(array('status'=>'1','message'=>'Updated Succesfully'));
		}
		else
		{
			echo json_encode(array('status'=>'0','message'=>'Something Went Wrong! Please Try Again'));
		}
    }
}
