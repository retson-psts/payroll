<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jobsheet extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation','leave_lib'));
	   $this->load->model(array('employee_model','projects_model','jobsheet_model','job_model'));
    }
	/**
	Default function if that page create this function called
	 */
	public function index()
	{
		//getting user id
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['message_div']='';
		$data['project_list']=$this->projects_model->list_projects();
		$data['form_data']=array('jobsheet_date'=>'');
		//$data['cat_job_list']=$this->job_model->list_job_cat();
		//this status indicates 1 fresh page or successfully insert page else this page error returned page
		$data['status']=1;
		$data['page_title']="Job Sheet";
		$data=$this->messages('jobsheet',$data);
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('jobsheet_view',$data);
		$this->load->view('footer');
	}
	public function date_jobsheet()
	{
		
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$this->form_validation->set_rules('jobsheet_date', 'Date Jobsheet', 'trim|required|xss_clean');
		if($this->form_validation->run()===false)
		{
			
			$message=validation_errors();
			$data=array('status'=>'0','message'=>$message,'form_data'=>array('jobsheet_date'=>$this->input->post('jobsheet_date')));
			$this->session->set_userdata('form',array('jobsheet'=>$data));
			redirect(site_path.'jobsheet','refresh');
		}
		else
		{
			
			$date=$this->input->post('jobsheet_date');
			$date_follow=$date;
			$date1=explode('-',$date);
			if(count($date1)==3 && checkdate($date1['1'],$date1['2'],$date1['0']))
			{
				$today=strtotime(date('Y-m-d'));
				$date=strtotime($date);
				if($today>=$date)
				{
					$page_name=$this->router->fetch_class();
					$data['left_menu']=0;
					$data['jobsheet_master_id']=0;
					$check_user_added=$this->common_model->fetch_contents('jobsheet_master',array('jobsheet_master_date'=>$date_follow));
					if($check_user_added!==false)
					{
						/*var_dump($check_user_added);*/
						$data['jobsheet_master_id']=$check_user_added[0]['jobsheet_master_id'];
					}
					$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
					$data['message_div']='';
					$data['project_list']=$this->projects_model->list_projects();
					$data['total_list1']=$this->jobsheet_model->job_sheet_list($date_follow);
					
					//$data['cat_job_list']=$this->job_model->list_job_cat();
					//this status indicates 1 fresh page or successfully insert page else this page error returned page
					$data['status']=2;
					$data['date']=$date1['2'].'-'.$date1['1'].'-'.$date1['0'];
					$data['dateold']=$this->input->post('jobsheet_date');
					$data['total_list']=$this->fetch_jobsheet_leave($data['total_list1'],$data['dateold']);
					//var_dump($data['total_list']);
					$data['leave_request_types']=$this->leave_lib->leave_request_types();
					$data['pay_periods']=$this->job_model->pay_period();
					$data['project_list']=$this->jobsheet_model->project_list();
					$data['locations']=json_encode($this->jobsheet_model->location_list_all());
					$data['page_title']="Job Sheet";
					$this->load->view('header',$data);
					$this->load->view('side_menu_admin',$data);
					$this->load->view('jobsheet_full',$data);
					$this->load->view('footer');
					
				}
				else
				{
					$message="Please Select today or less";
					$data=array('status'=>'0','message'=>$message,'form_data'=>array('jobsheet_date'=>$this->input->post('jobsheet_date')));
					$this->session->set_userdata('form',array('jobsheet'=>$data));
					redirect(site_path.'jobsheet','refresh');
				}
				
				
				
			}
			else
			{
				$message="Not Valid Date";
			$data=array('status'=>'0','message'=>$message,'form_data'=>array('jobsheet_date'=>$this->input->post('jobsheet_date')));
			$this->session->set_userdata('form',array('jobsheet'=>$data));
			redirect(site_path.'jobsheet','refresh');
			}
		}
	}
	public function location_list()
	{
		
		
		$this->form_validation->set_rules('id', 'id', 'trim|required|xss_clean|numeric');
		$id=$this->input->get('id');
		$data['location_list']=$this->jobsheet_model->location_list($id);
		$this->load->view('location_list_ajax',$data);
		
		
	}
	public function absent()
	{
		if ($this->input->is_ajax_request()) {
			if($this->form_validation->run('absent')!==false)
		{
			
			$data=$this->input->post();
			$data1=$data;
			if($data['leave_type']==9 || $data['leave_type']==12)
					{
						$data['leave_deduct_salary']=1;
					}
					else
					{
						$data['leave_deduct_salary']=0;
					}
			$data['leave_request']=1;
			unset($data1['leave_type']);
			unset($data1['leave_reason']);
			$dublicate_check=$this->common_model->dublicate_check('employee_leave',$data1);
			if($dublicate_check===false)
			{
				$insert_table=$this->common_model->insert_table('employee_leave',$data);
			if($insert_table===true)
			{
				$message='absent marked successfully';
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
				$message='already leave marked';
				$report=array('status'=>2,'message'=>$message);
				echo json_encode($report);
			}
				
			
			
			
		}
		else
		{
			    $message=validation_errors();
			   
				$report=array('status'=>0,'message'=>$message);
				echo json_encode($report);
		}
			
			
			}
			else{
				redirect(site_path,'refresh');
			}
	}
	
	public function reabsent()
	{
		if ($this->input->is_ajax_request()) {
			
			if(isset($_GET['employee_id']) && is_numeric($_GET['employee_id']) ){
				$where_data=$this->input->get();
				$data=array('employee_leave_removed'=>1);
				$insert_table=$this->common_model->update_table_custom('employee_leave',$data,$where_data);
			if($insert_table===true)
			{
				$message='absent marked successfully';
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
				
			}
		
			}
			else{
				redirect(site_path,'refresh');
			}
	}
		
	public function jobsheet_complete()
	{
		if ($this->input->is_ajax_request()) {
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$data=$this->input->post();
		$datetime=date('Y-m-d H:i:s');
		$date1=$data['jobsheet_date'];
		$jobsheet_master_id=$data['jobsheet_master_id'];
		$master=array('jobsheet_master_entered'=>$datetime,'jobsheet_master_date'=>$date1,'jobsheet_master_entered_by'=>$user_id,'jobsheet_master_id'=>$jobsheet_master_id);
		$array_jobsheet=array();
		$data1['project_list']=$this->input->post('project_list');
		$data1['location_list']=$this->input->post('location_list');
		
		$arrayjobsheet=array();
		$workingarray=array();
		$jobsheet_list_array=$this->input->post('jobsheet_id');
		foreach($this->input->post('employees') as $id=>$value)
		{
			$jobsheet_id=0;
			if($jobsheet_list_array[$id]!='')
			{
				$jobsheet_id=$jobsheet_list_array[$id];
			}
			if(isset($data['leave'][$value]))
			{
				$arrayjobsheet[]=array('employee_id'=>$value,'jobsheet_entered'=> $datetime,'jobsheet_date'=>$date1 ,'jobsheet_entered_by'=>$user_id ,'jobsheet_normalhour'=>0 ,'jobsheet_otfixed'=>0 ,'jobsheet_ot15'=>0 ,'jobsheet_ot2'=>0 ,'jobsheet_total'=>0 ,'jobsheet_absent'=>1 ,'jobsheet_notes'=>'','jobsheet_workhours'=>'','jobsheet_id'=>$jobsheet_id );	
			}
			else
			{
				$total=$data['normal_hours'][$value]+$data['ot15'][$value]+$data['ot2'][$value]+$data['otf'][$value];
				$arrayjobsheet[]=array('employee_id'=>$value,'jobsheet_entered'=> $datetime,'jobsheet_date'=>$date1 ,'jobsheet_entered_by'=>$user_id ,'jobsheet_normalhour'=>$data['normal_hours'][$value] ,'jobsheet_otfixed'=>$data['otf'][$value] ,'jobsheet_ot15'=>$data['ot15'][$value] ,'jobsheet_ot2'=>$data['ot2'][$value] ,'jobsheet_total'=>$total ,'jobsheet_absent'=>0 ,'jobsheet_notes'=>$data['remarks'][$value],'jobsheet_workhours'=>$data['in-out'][$value],'jobsheet_id'=>$jobsheet_id );	
			}
			
		}
		//var_dump($data['location_list']);
		if(isset($data['location_list']))
		{
			foreach($data['location_list'] as $id1=>$value1)
			{
				foreach($value1 as $id2=>$value2)
				{
					$workingarray[]=array('employee_id'=>$id2 ,'working_date'=>$date1,'working_projects'=>$data['project_list'][$id1][$id2] ,'working_location'=>$value2);
				}
				
			}
		}
		$dublicate=$this->common_model->dublicate_check('jobsheet_master',array('jobsheet_master_date'=>$date1));
		$dublicate=false;
		if($dublicate===false)
		{
			$insert_master=$this->jobsheet_model->jobsheet_complete($master,$workingarray,$arrayjobsheet);
			if($insert_master===true)
			{
				$message='Jobsheet added';
				$report=array('status'=>1,'message'=>$message);
				echo json_encode($report);
			}
			else
			{
				$message='Something wrong please try again';
				$report=array('status'=>0,'message'=>$message);
				echo json_encode($report);
			}
			
		}
		else
		{
			$message='This date already added';
				$report=array('status'=>0,'message'=>$message);
				echo json_encode($report);
		}
		}
		
		else
		{
			redirect(site_path,'refresh');
		}
		
	}	
	public function jobsheet_validation()
	{
		
	}
	
	
	protected function messages($form,$data)
	{
		
		$data['message_div']='';
		if(isset($this->session->userdata['form'][$form]['message']))
		{
			$status=$this->session->userdata['form'][$form]['status'];
			$message=$this->session->userdata['form'][$form]['message'];
			if(isset($this->session->userdata['form'][$form]['step']))
			{
				$data['step']=$this->session->userdata['form'][$form]['step'];
			}
			if($status==1)
			{
				$data['message_div']='<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">*</button>'.$message.'</div>';
				
			}
			else
			{
				if(isset($this->session->userdata['form'][$form]['form_data']))
				{
					$data['form_data']=$this->session->userdata['form'][$form]['form_data'];
				}
				if(isset($this->session->userdata['form'][$form]['form_data1']))
				{
					$data['form_data1']=$this->session->userdata['form'][$form]['form_data1'];
				}
				if(isset($this->session->userdata['form'][$form]['form_data2']))
				{
					$data['form_data2']=$this->session->userdata['form'][$form]['form_data2'];
				}
				
				
				$data['message_div']='<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">*</button>'.$message.'</div>';
				
			}
		}
		$this->session->unset_userdata('form');
		return $data;
	}
	protected function fetch_jobsheet_leave($employee_array,$leave_date)
	{
		
		$leave_array=array();
		$job_array=array();
		if(!empty($employee_array))
		{
		
	   foreach($employee_array as $key=>$item)
	   {
	   	$data_leave=array('employee_id'=>$item['employee_id'],'leave_date'=>$leave_date,'leave_request'=>1);
		$data_jobsheet=array('a.employee_id'=>$item['employee_id'],'b.employee_id'=>$item['employee_id'],'jobsheet_date'=>$leave_date);
	   	$employee_array[$key]['leave']=$this->common_model->fetch_contents('employee_leave',$data_leave); 
	   	$employee_array[$key]['jobsheet']=$this->jobsheet_model->jobsheet_data($data_jobsheet); 
	   }	
	   	
		}
		
	  return $employee_array;
	}
	
}