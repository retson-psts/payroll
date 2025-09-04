<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_category extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	   $this->load->model(array('employee_model','job_model'));
    }
	public function index()
	{
		$data['menu']=10;
		$data['menu1']=102;
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['cat_job_list']=$this->job_model->list_job_cat();
		$data['page_title']="Job Category";
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('job_category',$data);
		$this->load->view('footer');
	}
	public function add1()// Edited add => add1
	{
		$this->form_validation->set_rules('job_cat_name', 'Job Category Name', 'trim|required');
		$this->form_validation->set_rules('enable_login', 'Enable Login', 'trim|required');
		if($this->form_validation->run()===false)
		{
			$message=$this->html_lib->alert_div(validation_errors());
			$data=array('add_job_category'=>array('status'=>'0','message'=>$message));
			$this->session->set_userdata('form',$data);
		}
		else
		{
			$values=array('job_category_name'=>$this->input->post('job_cat_name'),'job_category_enable_login'=>$this->input->post('enable_login'));
			$insert_cat=$this->job_model->add_job_cat($values);
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
		redirect(site_path.'job_category','refresh');
	}
	public function edit1($cat_id='0')// Edit edit=>edit1
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['message_div']='';
		$data['cat_id']=$cat_id;
		$data['cat_details']=$this->job_model->get_job_cat_details($cat_id);
		if($data['cat_details']!=false)
		{
			$data['cat_job_list']=$this->job_model->list_job_cat();
			if(isset($this->session->userdata['form']['add_job_category']['status']))
			{
				$data['message_div']=$this->session->userdata['form']['add_job_category']['message'];
				$this->session->unset_userdata('form');
			}
			$data['page_title']="Job Category";
			$this->load->view('header',$data);
			$this->load->view('side_menu_admin',$data);
			$this->load->view('job_category',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(site_path.'job_category','refresh');
		}
	}
	public function update_cat()
	{
		$this->form_validation->set_rules('job_cat_name', 'Job Category Name', 'trim|required');
		$this->form_validation->set_rules('enable_login', 'Enable Login', 'trim|required');
		$this->form_validation->set_rules('cat_id', 'Category Id', 'trim|required');
		if($this->form_validation->run()===false)
		{
			$message=$this->html_lib->alert_div(validation_errors());
			$data=array('add_job_category'=>array('status'=>'0','message'=>$message));
			$this->session->set_userdata('form',$data);
		}
		else
		{
			$cat_id=$this->input->post('cat_id');
			$values=array('job_category_name'=>$this->input->post('job_cat_name'),'job_category_enable_login'=>$this->input->post('enable_login'));
			$insert_cat=$this->job_model->update_job_cat_details($cat_id,$values);
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
		redirect(site_path.'job_category','refresh');
	}

	
	// Added by yuvaraj
	
	public function add()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('job_category_add'))
		{
			$data=$this->input->post();
			$emp_id=$this->common_model->insert_table('job_category',$data);
			if($emp_id!==false)
			{
				
				$message="Job Category Added Successfully";
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
	public function edit()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('job_category_edit'))
		{
			$data=$this->input->post();
			$where['job_category_id']=$data['id'];
			unset($data['id']);
			
			$emp_id=$this->common_model->update_table_custom('job_category',$data,$where);
			if($emp_id!==false)
			{
				
				$message="Job Category updated successfully";
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
 	 		$res=$this->common_model->__fetch_contents('job_category',array('job_category_id <>'=>$id,'job_category_name'=>$name),'job_category_id');
		  	if($res!==FALSE)
		    {
				
					$this->form_validation->set_message('catexist', 'Job category already used');
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
   public function remove($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->delete_table('job_category',array('job_category_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Jobcategory Removed Successfully';
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
}
?>