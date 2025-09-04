<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_request_leave extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation','leave_lib'));
    }
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['page_title']="Request Leave";
		$data['message_div']='';
		$data['leave_request_types']=$this->leave_lib->leave_request_types();
		//print_r($this->session->all_userdata());
		if(isset($this->session->userdata['form']['employee_request_leave']['status']))
		{
			$status=$this->session->userdata['form']['employee_request_leave']['status'];
			$message=$this->session->userdata['form']['employee_request_leave']['message'];
			if($status==1)
			{
				$data['message_div']= '<div class="alert alert-success alert-dismissable">
									  <i class="fa fa-check"></i>
									  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									  <b>Alert! </b>'.$message.'</div>';
				$this->session->unset_userdata('form');
			}
			else
			{
				$data['message_div']='<div class="alert alert-danger alert-dismissable">
									  <i class="fa fa-ban"></i>
									  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									  <b>Alert! </b>'.$message.'</div>';
				$shortlist = $this->session->userdata('form');
				unset($shortlist['employee_request_leave']['message'],$shortlist['employee_request_leave']['status']);
				$this->session->set_userdata('form',$shortlist);
			}
		}
		$this->load->view('header',$data);
		$this->load->view('employee/side_menu_employee',$data);
		$this->load->view('employee/employee_request_leave',$data);
		$this->load->view('footer');
	}
	public function request_leave_add()
	{
		$this->form_validation->set_rules('leave_type', 'Leave Type', 'trim|required');
		$this->form_validation->set_rules('date_range', 'Date Range', 'trim|required|callback_check_dates');
		$this->form_validation->set_rules('leave_notes', 'Leave Notes', 'trim');
		if($this->form_validation->run()!== FALSE)
		{
			$leave_type=$this->input->post('leave_type');
			$date_range=$this->input->post('date_range');
			$leave_notes=$this->input->post('leave_notes');
			$submit_leave_request=$this->leave_lib->add_leave_request($leave_type,$date_range,$leave_notes);
			$new_form_data=array('message'=>'Leave Request Succesfully Submitted','status'=>'1');
			$this->session->set_userdata('form',array('employee_request_leave'=>$new_form_data));
			redirect(site_path.'employee_leave_requests','refresh');
		}
		else
		{
			$message=array('status'=>'0','message'=>validation_errors());
			$all_post_data=$this->input->post(NULL,TRUE);
			$new_form_data=array('form_data'=>$all_post_data,'message'=>validation_errors(),'status'=>'0');
			$this->session->set_userdata('form',array('employee_request_leave'=>$new_form_data));
			redirect(site_path.'employee_request_leave','refresh');
		}
	}

	public function leave_list()
	{
		if ($this->input->is_ajax_request())
		{
			if($this->form_validation->run('request_leave')!==false)
			{
				
				$range=$this->input->post('range');
				$array1=explode('-',$range);
				$from=$array1[0];
				$to=$array1[1];
				
				$begin = new DateTime( $from );
				$end = new DateTime($to);
				$end->modify("+1 day");
				$interval = new DateInterval('P1D');
				$daterange = new DatePeriod($begin, $interval ,$end);
				$arrray=array();
				$i=0;
				foreach($daterange as $date){
					
				$array[$i]['date']=$date->format('d M, Y');
				$array[$i]['day']=$date->format('D');
				$array[$i]['date1']=$date->format('Y-m-d');
				$i++;
				}
				echo json_encode($array);
				exit;
				
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
	public function employee_leave_add()
	{
		if ($this->input->is_ajax_request())
		{
			if($this->form_validation->run('emp_leave_add')!==false)
			{
				$employee_id=$this->session->userdata['logged_in']['employee_id'];
				$data=$this->input->post();
				$dates=$data['dates'];
				$leave_types=$data['leave_types1'];
				$leave_reason=$data['leave_notes'];
				$i=0;
				$leave_add=array();
				$last=count($dates)-1;
				$status=1;
				$dates_added=array();
				$leave_days=0;
				$leave_status=1;
				$leave_avail=0;
				$max_leave_days=$this->leave_model->get_max_leaves($data['leave_type']);
				foreach($dates as $date)
				{
					if($i==0)
					{
						$from=$date;
					}
					if($i==$last)
					{
						$last=$date;
					}
					if($data['leave_type']==$leave_types[$i])
					{
						$leave_days++;
					}
					if($leave_types[$i]==9 || $leave_types[$i]==12)
					{
						$deduct_salary=1;
					}
					else
					{
						$deduct_salary=0;
					}
					$where_data=array('employee_id'=>$employee_id,'leave_date'=>$date);
					$leave_data=array('employee_id'=>$employee_id,'leave_date'=>$date,'leave_type'=>$leave_types[$i],'leave_deduct_salary'=>$deduct_salary);
					$duplicate=$this->common_model->dublicate_check('employee_leave',$where_data);
					if($duplicate!==true)
					{
						$leave_add[]=$leave_data;
						
					}
					else
					{
						$status=0;
						$dates_added[]=$date;
					}
					
					$i++;
				}
				if($status==0)
				{
					$report=array('dates'=>$dates_added,'status'=>2);
					echo json_encode($report);
				}
				else
				{
					$leave_request=array('leave_request_user_id'=>$employee_id,'leave_request_type'=>$data['leave_type'],'leave_request_from'=>$from,'leave_request_to'=>$last,'leave_notes'=>$data['leave_notes'],'leave_requested_at'=>date('Y-m-d H:i:s'));
					$leaves_array=$this->leave_model->leave_taken($data['leave_type'],$employee_id);
					
					if($leaves_array!==false)
					{
						$total=0;
						foreach($leaves_array as $item)
						{
							if($item->leave_status!=2)
							{
								$total+=$item->leaves;
							}
						}
						if(($leave_days+$total)>$max_leave_days)
						{
							$leave_status=0;
							$leave_avail=$max_leave_days-$total;
						}
					
					}
					else
					{
						if($leave_days>$max_leave_days)
						{
							$leave_status=0;
							$leave_avail=$max_leave_days;
						}
						
					}
					if($leave_status==1)
					{
						$result=$this->leave_model->add_leave($leave_add,$leave_request);
						if($result!==false)
						{
							$message="Added Successfully";
						   	$report=array('status'=>1,'message'=>$message);
							echo json_encode($report);
						}
						else
						{
							$message="Not Saved";
						   	$report=array('status'=>0,'message'=>$message);
							echo json_encode($report);
						}
					}
					else
					{
						$message="You Can't take leave this category for not more than ".$leave_avail;
					   	$report=array('status'=>0,'message'=>$message);
						echo json_encode($report);
					}
					
					
				}
			}
			else
			{
				$message=validation_errors();
			   	$report=array('status'=>0,'message'=>$message);
				echo json_encode($report);
			}
		}
		else
		{
			redirect(site_path,"refresh");
		}
	}

	public function check_leave()
	{
		if ($this->input->is_ajax_request())
		{
			if($this->form_validation->run('check_leave')!==false)
			{
				
				$data['leave_type']=$this->input->post('id');
				$employee_id=$this->session->userdata['logged_in']['employee_id'];
				$this->load->model('leave_model');
				$leaves_array=$this->leave_model->leave_taken($data['leave_type'],$employee_id);
				$max_leave_days=$this->leave_model->get_max_leaves($data['leave_type']);
				$array=array();
				if($leaves_array===false)
				{
					$leaves_array=array(array('leaves'=>0,'leave_status'=>0),array('leaves'=>0,'leave_status'=>1),array('leaves'=>0,'leave_status'=>2),'total'=>0,'leave_allowed'=>$max_leave_days);
					$array=array('status'=>1,'leave_array'=>$leaves_array);
				}
				else
				{
					$total=0;
					foreach($leaves_array as $item)
					{
						$total+=$item->leaves;
						
					}
					$leaves_array['total']=$total;
					$leaves_array['leave_allowed']=$max_leave_days;
					
					$array=array('status'=>1,'leave_array'=>$leaves_array);
				}
				echo json_encode($array);
				exit;
				
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
	protected function add_dates()
	{
		return true;
	}
	public function validate_date($date)
	{
		$dateTime = DateTime::createFromFormat('Y-m-d', $date);
		$errors = DateTime::getLastErrors();
		if (!empty($errors['warning_count'])) {
		    $this->form_validation->set_message('validate_date', 'Please Provide valid days');
			return FALSE;
		}
		else
		{
			$now = new DateTime();
			if($dateTime->diff($now)->days < 1 )
		    {
		    		$this->form_validation->set_message('validate_date', 'you can\'t choose date below today or today');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
		}
	}
	
}
?>