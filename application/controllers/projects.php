<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Projects extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	   $this->load->model(array('employee_model','projects_model'));
    }
	/**
	Default function if that page create this function called
	 */
	public function index(){
		//getting user id
		$data['menu']=11;
		$data['menu1']=111;
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['project_list']=$this->projects_model->list_projects();
		$data['page_title']="Projects";
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('projects_view',$data);
		$this->load->view('footer');
	}
	/**
	* add page 
	* 
	* @return
	*/
	public function add1(){
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$this->form_validation->set_rules('project_title', 'Project Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('Project_description', 'Project Description', 'trim|xss_clean');
		if($this->form_validation->run()===false)
		{
			$message=$this->html_lib->alert_div(validation_errors());
			$data=array('add_project'=>array('status'=>'0','message'=>$message),'form_data'=>array('project_title'=>$this->input->post('project_title'),'project_description'=>$this->input->post('project_description')));
			$this->session->set_userdata('form',$data);
		}
		else
		{
			$values=array('project_title'=>$this->input->post('project_title'),'project_description'=>$this->input->post('project_description'),'project_added_date'=>date('Y-m-d H:i:s'),'project_added_by'=>$user_id);
			if(!$this->projects_model->check_projects($this->input->post('project_title')))
			{
				
			$insert_cat=$this->projects_model->add_project($values);
			if($insert_cat==true)
			{
				$message=$this->html_lib->success_div('Project added Succesfully');
				$data=array('add_project'=>array('status'=>'1','message'=>$message));
			}
			else
			{
				$message=$this->html_lib->alert_div('Please try again');
				$data=array('add_project'=>array('status'=>'0','message'=>$message),'form_data'=>array('project_title'=>$this->input->post('project_title'),'project_description'=>$this->input->post('project_description')));
			}
			}
			else
			{
				
				$message=$this->html_lib->alert_div('Project name repeated');
				$data=array('add_project'=>array('status'=>'0','message'=>$message),'form_data'=>array('project_title'=>$this->input->post('project_title'),'project_description'=>$this->input->post('project_description')));
			}
			$this->session->set_userdata('form',$data);
		}
		redirect(site_path.'projects','refresh');
	}
	/**
	* 
	* @param int $project_id
	* 
	* @return
	*/
	public function edit1($project_id='0'){
	
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['message_div']='';
		$data['status']=1;
		$data['project_id']=$project_id;
		
		$data['project_details']=$this->projects_model->get_project_details($project_id);
			
		if($data['project_details']!=false)
		{
			
			$data['project_list']=$this->projects_model->list_projects();
			$array=json_decode(json_encode($data['project_details']), true);
			$data['form_data']=$array[0];
			if(isset($this->session->userdata['form']['add_project']['status']))
			{
				$data['status']=0;
				$data['message_div']=$this->session->userdata['form']['add_project']['message'];
				$data['form_data']=$this->session->userdata['form']['form_data'];
				$this->session->unset_userdata('form');
			}
			
			$data['page_title']="projects";
			$this->load->view('header',$data);
			$this->load->view('side_menu_admin',$data);
			$this->load->view('projects_view',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(site_path.'projects','refresh');
		}
	}
	/**
	* 
	* 
	* @return
	*/
	public function update_job1(){
		$this->form_validation->set_rules('project_title', 'Project Title', 'trim|required|xss_clean');
		$this->form_validation->set_rules('project_description', 'Project Description', 'trim|xss_clean');
		$this->form_validation->set_rules('project_id', 'Project Id', 'trim|required|xss_clean');
		
		if($this->form_validation->run()===false)
		{
			$message=$this->html_lib->alert_div(validation_errors());
			$data=array('add_projects'=>array('status'=>'0','message'=>$message),'form_data'=>array('project_title'=>$this->input->post('project_title'),'project_description'=>$this->input->post('Project_description'),'project_id'=>$this->input->post('project_id')));
			$this->session->set_userdata('form',$data);
			
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			
			$project_id=$this->input->post('project_id');
			$values=array('project_title'=>$this->input->post('project_title'),'project_description'=>$this->input->post('project_description'));
			// check new project title already exist except old
			if(!$this->projects_model->check_projects_edit($this->input->post('project_title'),$project_id))
			{
				
			$insert_cat=$this->projects_model->update_project_details($project_id,$values);
			if($insert_cat==true)
			{
				$message=$this->html_lib->success_div('Project updated successfully');
				$data=array('add_project'=>array('status'=>'1','message'=>$message));
				$this->session->set_userdata('form',$data);
				redirect(site_path.'projects','refresh');
			}
			else
			{
				$message=$this->html_lib->alert_div('Please try again');
				$data=array('add_project'=>array('status'=>'0','message'=>$message),'form_data'=>array('project_title'=>$this->input->post('project_title'),'project_description'=>$this->input->post('project_description'),'project_id'=>$this->input->post('project_id')));
				$this->session->set_userdata('form',$data);
				redirect($_SERVER['HTTP_REFERER']);
			}
			}
			else
			{
				
				$message=$this->html_lib->alert_div('Project name already exist');
				$data=array('add_project'=>array('status'=>'0','message'=>$message),'form_data'=>array('project_title'=>$this->input->post('project_title'),'project_description'=>$this->input->post('project_description'),'project_id'=>$this->input->post('project_id')));
				$this->session->set_userdata('form',$data);
				redirect($_SERVER['HTTP_REFERER']);
			}
			
		}
		//redirect(site_path.'projects','refresh');
	}



// Added by yuvaraj
	
	public function add()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('projects_add'))
		{
			$data=$this->input->post();
			$emp_id=$this->common_model->insert_table('projects',$data);
			if($emp_id!==false)
			{
				
				$message="Projects Added Successfully";
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
    	
    	if($this->form_validation->run('projects_edit'))
		{
			$data=$this->input->post();
			$where['project_id']=$data['id'];
			unset($data['id']);
			
			$emp_id=$this->common_model->update_table_custom('projects',$data,$where);
			if($emp_id!==false)
			{
				
				$message="Project updated successfully";
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
 	 		$res=$this->common_model->__fetch_contents('projects',array('project_id <>'=>$id,'project_title'=>$name),'project_id');
		  	if($res!==FALSE)
		    {
				
					$this->form_validation->set_message('catexist', 'Project name already used');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
			
		}
		else
		{
			$this->form_validation->set_message('catexist', 'Project name already used');
			return FALSE;
		}
 	 	
  		
    
  }
   public function remove($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->delete_table('projects',array('project_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'project Removed Successfully';
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
	/**
	* 
	* @param int $project_id
	* 
	* @return
	*/
	public function location($project_id='0'){
		if(!is_numeric($project_id)){
			redirect($_SERVER['HTTP_REFERER']);
		}
		else{
			if($project_id!=0){
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$page_name=$this->router->fetch_class();
			$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
			$data['message_div']='';
			$data['project_id']=$project_id;
			$data['location_list']=$this->projects_model->list_location($project_id);
			$data['project_list']=$this->projects_model->list_projects();
			
			//this status indicates 1 fresh page or successfully insert page else this page error returned page
			$data['status']=1;
	
			if(isset($this->session->userdata['form']['add_location']['status'])){
				
				$data['status']=$this->session->userdata['form']['add_location']['status'];
				$data['message_div']=$this->session->userdata['form']['add_location']['message'];
				/*$data['form_data']=$this->session->userdata['form']['form_data'];*/
				
				$this->session->unset_userdata('form');
			}
			$data['page_title']="Projects";
			$this->load->view('header',$data);
			$this->load->view('side_menu_admin',$data);
			$this->load->view('location_view',$data);
			$this->load->view('footer');
		}
		else{
			redirect($_SERVER['HTTP_REFERER']);
		}
		}
		//getting user id
		
	}
	/**
	* 
	* 
	* @return
	*/
	public function location_add(){
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$project_id=$this->input->post('project_id');
		if(isset($_POST['location_id']))
		{
			$location1_array=$this->input->post('location_name');
			$details1_array=$this->input->post('location_details');
			$id1_array=$this->input->post('location_id');
			$time=date('Y-m-d H:i:s');
			$pass_array=array();
			$id_array=array();
			for($i=0;$i<count($location1_array);$i++)
			{
				$pass1_array[]=array('project_id'=>$project_id,'location_name'=>$location1_array[$i],'location_details'=>$details1_array[$i]);
				$id_array[]=$id1_array[$i];
				
			}
			$project_result1=$this->projects_model->update_location($id_array,$pass1_array);
			if($project_result1===false)
			{
				$status=1;
			}
			else
			{
				$status=2;
			}
		}
		if(isset($_POST['location1_name']))
		{
			$location_array=$this->input->post('location1_name');
			$details_array=$this->input->post('location1_details');
			$time=date('Y-m-d H:i:s');
			$pass_array=array();
			for($i=0;$i<count($location_array);$i++)
			{
				$pass_array[]=array('project_id'=>$project_id,'location_name'=>$location_array[$i],'location_details'=>$details_array[$i],'location_added_by'=>$user_id,'location_added_date'=>$time);
				
			}
			$project_result=$this->projects_model->add_location($pass_array);
			if($project_result===false)
			{
				$status1=1;
			}
			else
			{
				$status1=2;
			}
			
			
		}
		if($status1==2 && $status==2)
		{
				$message=$this->html_lib->success_div('Location Added/Updated successfully');
				$data=array('add_location'=>array('status'=>'1','message'=>$message));
				$this->session->set_userdata('form',$data);
				redirect(site_path.'projects/location/'.$project_id,'refresh');
				
		}
		else if($status1==2 || $status==2)
		{
				$message=$this->html_lib->success_div('Partially Inserted / Updated');
				$data=array('add_location'=>array('status'=>'0','message'=>$message));
				$this->session->set_userdata('form',$data);
				redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$message=$this->html_lib->alert_div('Please Try again');
				$data=array('add_location'=>array('status'=>'0','message'=>$message));
				$this->session->set_userdata('form',$data);
				redirect($_SERVER['HTTP_REFERER']);
		}
	}
	/**
	* 
	* @param int $location_id
	* 
	* @return
	*/
	public function delete_location($location_id){
		$data=array('location_removed'=>'1');
		$deleted=$this->projects_model->delete_location($location_id,$data);
		if($deleted===false)
		{
			$message=$this->html_lib->alert_div('Please Try again');
				$data=array('add_location'=>array('status'=>'0','message'=>$message));
				$this->session->set_userdata('form',$data);
				redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$message=$this->html_lib->success_div('Removed successfully');
				$data=array('add_location'=>array('status'=>'1','message'=>$message));
				$this->session->set_userdata('form',$data);
				redirect($_SERVER['HTTP_REFERER']);
		}
	}
}