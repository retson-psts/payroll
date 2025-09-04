<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Event_list extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	 $this->load->library('form_validation');
	 $this->load->helper('custom_helper');
	  // $this->load->model();
    }
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$contents=$this->common_model->fetch_contents('company_config',array('company_id'=>1));
		$events=$this->common_model->__fetch_contents('event',array('event_removed'=>0),'event_id as id,color as backgroundColor,border as borderColor,allday as allDay,title,start,end');
		if(!empty($events))
		{
		foreach($events as $key=>$item)
		{
				if($item['allDay']==1)
				{
					$events[$key]['allDay']=true;
				}
				else
				{
					$events[$key]['allDay']=false;
				}
		}
		}
		$data['events']=$events;
		$data['menu']=12;
	  	$data['menu1']=122;
	  	$data['bank_details']=$this->common_model->fetch_contents('company_bank_details',array());
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['page_title']="Event Management";
		$this->load->view('header',$data);
	    $this->load->view('side_menu_admin',$data);
	    $this->load->view('calendar/calendar',$data);
	    $this->load->view('footer');
	    
	}
	public function add_event()
    {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('event'))
		{
			$data=$this->input->post();
			if(empty($data['id']))
			{
				unset($data['id']);
				$color_code=$this->color_code($data['status']);
				$data['allday']=0;
				if(isset($data['allday1']))
				{
					$data['allday']=1;
					unset($data['allday1']);
				}
				$data['color']=$color_code['color'];
				$data['border']=$color_code['border'];
				
				$emp_id=$this->common_model->insert_table('event',$data);
			}
			else
			{
				$id=$data['id'];
				unset($data['id']);
				$color_code=$this->color_code($data['status']);
				$data['allday']=0;
				if(isset($data['allday1']))
				{
					$data['allday']=1;
					unset($data['allday1']);
				}
				$data['color']=$color_code['color'];
				$data['border']=$color_code['border'];
				$emp_id=$this->common_model->update_table_custom('event',$data,array('event_id'=>$id));
			}
    		if($emp_id!==false)
			{
				
				$message='Event Updated successfully';
				if(empty($data['id']))
				{
					$message='Event Added successfully';
				}
				
		        $report = array('status' => 1,'message' => $message);
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
	public function events()
	{
		if ($this->input->is_ajax_request())
    	{
    		$events=$this->common_model->__fetch_contents('event',array('event_removed'=>0),'event_id as id,color as backgroundColor,border as borderColor,allday as allDay,title,start,end');
    		foreach($events as $key=>$item)
    		{
				if($item['allDay']==1)
				{
					$events[$key]['allDay']=true;
				}
				else
				{
					$events[$key]['allDay']=false;
				}
			}
    		echo json_encode($events);
    	}
    	 else
	    {
	      show_error("No direct access allowed");
	      //or redirect to wherever you would like
	    }
	}
	public function fetch1()
    {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('event_fetch'))
		{
			$data=$this->input->post();
			$emp_id=$this->common_model->__fetch_contents('event',array('event_id'=>$data['id']),'*');
    		if($emp_id!==FALSE)
			{
				
				$message=$emp_id[0];
				$message=sanitize_display1($message);
		        $report = array('status' => 1,'message' => $message);
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
  function color_code($id)
  {
  	$data=array();
  	$data['color']="";
	$data['border']="";
  	switch($id)
  	{
		case 1:
		   $data['color']="#0073b7";
		   $data['border']="#0073b7";
		   break;
		case 2:
		   $data['color']="#f39c12";
		   $data['border']="#f39c12";
		   break;
		case 3:
		   $data['color']="#f56954";
		   $data['border']="#f56954";
		   break;
		case 4:
		   $data['color']="#00c0ef";
		   $data['border']="#00c0ef";
		   break;
		   
		   
	}
	return $data;
  }
	 public function remove_event($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->delete_table('event',array('event_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Event Removed';
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
