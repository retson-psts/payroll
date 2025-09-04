<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Claim_Requests extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	  
    }
	public function index()
	{
			$user_id=$this->session->userdata['logged_in']['user_id'];
 			$page_name=$this->router->fetch_class();
			  $data['user_details']=$this->users_lib->get_logged_user_details($user_id);
 			  $data['page_title']="Claim Requests";
			  $this->load->view('header',$data);
			  $this->load->view('side_menu_admin',$data);
			  $this->load->view('list_claim_request',$data);
			  $this->load->view('footer');
	}
}
?>