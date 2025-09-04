<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library(array('form_validation','leave_lib'));
	   $this->load->model(array('employee_model','leave_model','report_model'));	  
    }
	public function index()
	{
	  	
	  $user_id=$this->session->userdata['logged_in']['user_id'];
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
	  $page_name=$this->router->fetch_class();
	  $user_details=$this->users_lib->get_logged_user_details($user_id);
	  $data['user_details']=$user_details;
	  $data['page_title']="Dashboard";
	  $data['employees_list']=$this->employee_model->list_employees();
	  $data['pending_leave_request']=$this->leave_model->pending_leave_request();
	  $data['today_leave_req']=$this->leave_model->today_leave_request_count();
	  $from='';
	  $to='';
	  $data['leaves']=$this->report_model->leave_list1('',$from,$to,'');
	  //var_dump($data['leaves']);
	  if($data['leaves']!==false)
	  {
	  	
	 
			  foreach($data['leaves'] as $key=>$item)
			  {
			  	$data['leaves'][$key]['elapsed']=$this->common_lib->format_time($item['elapsed'],'Y-m-d','d M Y');
			  }
	  }
	  else
	  {
	  	$data['leaves'][]=array('elapsed'=>date('d M Y'),'value'=>'0');
	  }
	  $data['leaves']=json_encode($data['leaves']);
	  
	  $data['leaves_requests']=array();
	  $data['employee_pie']=json_encode($this->report_model->category_report());
	  $data['allowance_request']=$this->report_model->allowance_request();
	  //var_dump($this->report_model->category_report());
	  $data['pending_allowance']=4;
	  $this->load->view('header',$data);
	  if($user_details->user_group_id=='1')
	  {
		  $this->load->view('side_menu_admin',$data);
		  $this->load->view('home',$data);
	  }
	  else
	  {
		  $this->load->view('employee/side_menu_employee',$data);
		  $this->load->view('employee/employee_home',$data);
	  }
	  $this->load->view('footer');			  
	}
	public function logout()
    {
        $this->users_lib->logout();
    }
    
    public function events()
	{
		if ($this->input->is_ajax_request())
    	{
    		$events=$this->common_model->__fetch_contents('event',array('event_removed'=>0),'event_id as id,color as backgroundColor,border as borderColor,allday as allDay,title,start,end');
    		$data=$this->input->get();
    		if(date('d',$data['start'])==1)
    		{
				$month=date('m',$data['start']);
				$year=date('Y',$data['start']);
			
			}
			else
			{
				$date=new DateTime(date('Y-m-t',$data['start']));
				$date->modify('+1 day');
				$month=$date->format('m');
				$year=$date->format('Y');
			}
    		$this->load->library('notification');
			$res=$this->notification->get_birthdays($month,$year);
			$res1=$this->notification->passport_expiry($month,$year);
			if(!empty($res))
			{
				foreach($res as $key=>$item)
				{
					$events[]=$res[$key];
					
				}
			}
			if(!empty($res1))
			{
				foreach($res1 as $key=>$item)
				{
					$events[]=$res1[$key];
					
				}
			}
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
    
}

?>