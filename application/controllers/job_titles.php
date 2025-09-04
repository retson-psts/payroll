<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_titles extends CI_Controller {
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	   $this->load->model(array('employee_model','job_model'));
    }
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['menu']=10;
		$data['menu1']=101;
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['job_title_list']=$this->job_model->list_job_titles();
		$data['cat_job_list']=$this->job_model->list_job_cat();
		$data['page_title']="Job Titles";
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('job_titles',$data);
		$this->load->view('footer');
	}
	public function add1() // Edited add=>add1
	{
		$this->form_validation->set_rules('job_title', 'Job Title Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('job_cat', 'Job Category', 'trim|required|xss_clean|numeric');
		if($this->form_validation->run()===false)
		{
			$message=$this->html_lib->alert_div(validation_errors());
			$data=array('add_job_category'=>array('status'=>'0','message'=>$message));
			$this->session->set_userdata('form',$data);
		}
		else
		{
			$values=array('job_title_category'=>$this->input->post('job_cat'),'job_title_name'=>$this->input->post('job_title'));
			$insert_cat=$this->job_model->add_job_title($values);
			if($insert_cat==true)
			{
				$message=$this->html_lib->success_div('Job Title Created Succesfully');
				$data=array('add_job_title'=>array('status'=>'1','message'=>$message));
			}
			else
			{
				$message=$this->html_lib->alert_div('Please Try Again');
				$data=array('add_job_title'=>array('status'=>'0','message'=>$message));
			}
			$this->session->set_userdata('form',$data);
		}
		redirect(site_path.'job_titles','refresh');
	}
	public function edit1($job_id='0') // Edited edit=>edit1
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['message_div']='';
		$data['job_id']=$job_id;
		$data['job_details']=$this->job_model->get_job_title_details($job_id);
		if($data['job_details']!=false)
		{
			$data['job_title_list']=$this->job_model->list_job_titles();
			$data['cat_job_list']=$this->job_model->list_job_cat();
			if(isset($this->session->userdata['form']['add_job_title']['status']))
			{
				$data['message_div']=$this->session->userdata['form']['add_job_category']['message'];
				$this->session->unset_userdata('form');
			}
			$data['page_title']="Job Category";
			$this->load->view('header',$data);
			$this->load->view('side_menu_admin',$data);
			$this->load->view('job_titles',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(site_path.'job_titles','refresh');
		}
	}
	public function update_job1() // Edite update_job=>update_job1
	{
		$this->form_validation->set_rules('job_title', 'Job Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('job_cat', 'Enable Login', 'trim|required|xss_clean');
		$this->form_validation->set_rules('job_id', 'Category Id', 'trim|required|xss_clean');
		if($this->form_validation->run()===false)
		{
			$message=$this->html_lib->alert_div(validation_errors());
			$data=array('add_job_category'=>array('status'=>'0','message'=>$message));
			$this->session->set_userdata('form',$data);
		}
		else
		{
			$job_id=$this->input->post('job_id');
			$values=array('job_title_category'=>$this->input->post('job_cat'),'job_title_name'=>$this->input->post('job_title'));
			$insert_cat=$this->job_model->update_job_title_details($job_id,$values);
			if($insert_cat==true)
			{
				$message=$this->html_lib->success_div('Job Category Created Succesfully');
				$data=array('add_job_category'=>array('status'=>'1','message'=>$message));
			}
			else
			{
				$message=$this->html_lib->alert_div('Please Try Again');
				$data=array('add_job_category'=>array('status'=>'0','message'=>$message));
			}
			$this->session->set_userdata('form',$data);
		}
		redirect(site_path.'job_titles','refresh');
	}
	
	// Yuvaraj Edited
	
	public function add()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('job_title_add'))
		{
			$data=$this->input->post();
			$emp_id=$this->common_model->insert_table('job_titles',$data);
			if($emp_id!==false)
			{
				
				$message="Job Title Added Successfully";
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
  		
  		
  		$result=$this->common_model->delete_table('job_titles',array('job_title_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Job title Removed Successfully';
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
    	
    	if($this->form_validation->run('job_title_edit'))
		{
			$data=$this->input->post();
			$where['job_title_id']=$data['id'];
			unset($data['id']);
			
			$emp_id=$this->common_model->update_table_custom('job_titles',$data,$where);
			if($emp_id!==false)
			{
				
				$message="Job Title updated successfully";
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
 	 		$res=$this->common_model->__fetch_contents('job_titles',array('job_title_id <>'=>$id,'job_title_name'=>$name),'job_title_id');
		  	if($res!==FALSE)
		    {
				
					$this->form_validation->set_message('catexist', 'Job Title already used');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
			
		}
		else
		{
			$this->form_validation->set_message('catexist', 'Job category already used');
			return FALSE;
		}
 	 	
  		
    
  }
	
}
?>