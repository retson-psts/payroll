<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_methods extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation','employee_lib'));
	   $this->load->model(array('employee_model'));
    }
	public function employee_list($main_emp_id='0')
	{
		$employee_list=$this->employee_model->employee_ajax_list($main_emp_id);
		if($employee_list!=false)
		{
			echo json_encode(array('status'=>'1','result'=>$employee_list));
		}
		else
		{
			echo json_encode(array('status'=>'0','result'=>''));
		}
	}
}
?>