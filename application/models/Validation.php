<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class Validation extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library(array('form_validation','employee_lib'));
    $this->load->model(array('employee_model','job_model'));
  }
  public function step1($id = '0')
  {
    if ($this->input->is_ajax_request())
    {
      if ($this->form_validation->run('add_employee_step1') !== false)
      {
        $report = array('status' => 1,'message' => $message);
        echo json_encode($report);
      }
      else
      {
        $message = validation_errors();
        $report  = array('status' => 0,'message' => $message);
        echo json_encode($report);
      }
    }
    else
    {
      show_error("No direct access allowed");
      //or redirect to wherever you would like
    }
  }
}