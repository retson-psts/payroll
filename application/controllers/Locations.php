<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Locations extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	   $this->load->model(array('employee_model','projects_model'));
    }
	/**
	Default function if that page create this function called
	 */
	public function index($project_id=0){
		//getting user id
		if(empty($project_id))
		{
				$data['project_id']='';
				$data['location_list']=$this->projects_model->list_location();
			
		}
		elseif(is_numeric($project_id))
		{
			$data['project_id']=$project_id;
			$data['location_list']=$this->projects_model->list_location($project_id);
		}
		else
		{
			redirect(site_path.'locations','refresh');
			exit;
		}
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['message_div']='';
		$data['menu']=11;
		$data['menu1']=112;
		$data['project_list']=$this->projects_model->list_projects();
		$data['page_title']="Location";
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('test/test-projects',$data);
		$this->load->view('footer');
	}
	/**
	* add page 
	* 
	* @return
	*/
	



// Added by yuvaraj
	
	public function add()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('locations_add'))
		{
			$data=$this->input->post();
			$emp_id=$this->common_model->insert_table('location',$data);
			if($emp_id!==false)
			{
				
				$message="Location Added Successfully";
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
    	
    	if($this->form_validation->run('locations_edit'))
		{
			$data=$this->input->post();
			$where['location_id']=$data['id'];
			unset($data['id']);
			
			$emp_id=$this->common_model->update_table_custom('location',$data,$where);
			if($emp_id!==false)
			{
				
				$message="Location updated successfully";
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
 	 		$res=$this->common_model->__fetch_contents('location',array('location_id <>'=>$id,'location_name'=>$name),'location_id');
		  	if($res!==FALSE)
		    {
				
					$this->form_validation->set_message('catexist', 'Location name already used');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
			
		}
		else
		{
			$this->form_validation->set_message('catexist', 'Location name already used');
			return FALSE;
		}
 	 	
  		
    
  }
   public function remove($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->delete_table('location',array('location_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Location Removed Successfully';
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