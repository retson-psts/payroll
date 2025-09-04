<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Terminate extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	 $this->load->library('form_validation');
	  // $this->load->model();
    }
	public function index()
	{
		
	}
	public function termination()
	{
		if ($this->input->is_ajax_request()) {
		if($this->form_validation->run('termination')!==FALSE)
		{
			
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$datetime=date('Y-m-d H:i:s');
			
			$data=$this->input->post();
			$data['termination_by']=$user_id;
			$data['termination_on']=$datetime;
			
			$this->load->model('termination_model');
			$insert_table=$this->termination_model->terminate_employee($data);
			if($insert_table===true)
			{
				$message='Employee Terminated';
				$report=array('status'=>1,'message'=>$message);
				echo json_encode($report);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message);
				echo json_encode($report);
			}
				
				
		}
		else
		{
			    $message=$this->form_validation->error_array();
			   
				$report=array('status'=>0,'message'=>$message);
				echo json_encode($report);
		}
	}
	else
	{
		
	}
			
			
    }
}
