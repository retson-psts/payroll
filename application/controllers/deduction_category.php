<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Deduction_category extends CI_Controller {
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	}
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['menu']=21;
		$data['menu1']=211;
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['dec']=$this->common_model->__fetch_contents('deduction_category',array('dec_removed'=>0));
		$data['page_title']="Deduction Category";
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('deduction_category_view',$data);
		$this->load->view('footer');
	}
	// Yuvaraj Edited
	
	public function add()
  {
  	if ($this->input->is_ajax_request())
    {
    	$this->form_validation->set_rules('dec_name', 'Name', 'required|is_unique[deduction_category.dec_name]');
    	$this->form_validation->set_rules('dec_description', 'Name', 'xss_clean');
    	if($this->form_validation->run())
		{
			$data=$this->input->post();
			$emp_id=$this->common_model->insert_table('deduction_category',$data);
			if($emp_id!==false)
			{
				
				$message="Deduction Added Successfully";
				$url="";
		        $report = array('status' => 1,'message' => $message,'url'=>$url);
		        echo json_encode($report);
		        exit;
			}
			else
			{
				$message = 'Something wrong please try again';
	        	$report  = array('status' => 0,'message' => $message);
	        	echo json_encode($report);
	        	exit;
				
			}
		}
		else
		{
			$message = $this->form_validation->error_array();
			$report  = array('status' => 0,'message' => $message);
			echo json_encode($report);
			exit;
		}
    	
    }
     else
    {
      show_error("No direct access allowed");
      //or redirect to wherever you would like
    }
  }
  public function remove($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->update_table_custom('deduction_category',array('dec_removed'=>1),array('dec_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Deduction Category Removed Successfully';
            $report  = array(
                'status' => 1,
                'message' => $message
            );
            echo json_encode($report);
		}
		else
		{
			
			$message = 'Not Removed';
            $report  = array(
                'status' => 0,
                'message' => $message
            );
            echo json_encode($report);
		}
		
	}
	else
	{
		
		$message = 'Access failed';
            $report  = array(
                'status' => 0,
                'message' => $message
            );
            echo json_encode($report);
	}
	}
  	
  }
	public function edit()
  {
  	if ($this->input->is_ajax_request())
    {
    	$this->form_validation->set_rules('dec_name', 'Name', 'required|callback_catexist');
    	$this->form_validation->set_rules('dec_description', 'Name', 'xss_clean');
    	if($this->form_validation->run())
		{
			$data=$this->input->post();
			$where['dec_id']=$data['id'];
			unset($data['id']);
			
			$emp_id=$this->common_model->update_table_custom('deduction_category',$data,$where);
			if($emp_id!==false)
			{
				
				$message="Deduction updated successfully";
				$url="";
		        $report = array('status' => 1,'message' => $message,'url'=>$url);
		        echo json_encode($report);
		        exit;
			}
			else
			{
				$message = 'Something wrong please try again';
	        	$report  = array('status' => 0,'message' => $message);
	        	echo json_encode($report);
	        	exit;
				
			}
		}
		else
		{
			$message = $this->form_validation->error_array();
			$report  = array('status' => 0,'message' => $message);
			echo json_encode($report);
			exit;
		}
    	
    }
     else
    {
      show_error("No direct access allowed");
      //or redirect to wherever you would like
    }
  }
  public function catexist($name)
  {
  	$id=$this->input->post('id');
 	 	if(!empty($id) && is_numeric($id))
 	 	{
 	 		$res=$this->common_model->__fetch_contents('deduction_category',array('dec_id <>'=>$id,'dec_name'=>$name),'dec_name');
		  	if($res!==FALSE)
		    {
				
					$this->form_validation->set_message('catexist', 'Deduction already Added');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
			
		}
		else
		{
			$this->form_validation->set_message('catexist', 'Job category already Added');
			return FALSE;
		}
 	 	
  		
    
  }
	
}
?>