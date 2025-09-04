<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Reports extends CI_Controller {
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	   $this->load->model(array('report_model'));
    }
	public function index()
	{
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['menu']=9;
	  $data['menu1']=0;
	  $data['page_title']="Leave Report";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	  //$this->load->view('allowance_list',$data);
	  $this->load->view('footer');
	}


	public function leave()
	{
		$data['menu']=6;
		$data['menu1']=62;
	  $this->load->library('leave_lib');
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['leave_request_types']=$this->leave_lib->leave_request_types();
	  $data['message_div']='';
	  $data['page_title']="Leave Reports";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	 $this->load->view('leave_report',$data);
	  $this->load->view('footer');
	}
	public function ajax_leave()
	{
		if ($this->input->is_ajax_request()) 
		{
		if($this->form_validation->run('ajax_leave')!==false)
		{
			
			$data=$this->input->post();
			$month='';
			$from='';
			$to='';
			$type='';
			if(!empty($data['range']))
			{
				$split=explode(' - ',$data['range']);
				$date = DateTime::createFromFormat('Y/m/d', $split[0]);
				$date1= DateTime::createFromFormat('Y/m/d', $split[1]);
				$from=$date->format('Y-m-d');
				$to=$date1->format('Y-m-d');
				
			}
			if(!empty($data['month']))
			{
				$split[0]='01-'.$data['month'];
				$date = DateTime::createFromFormat('d-m-Y', $split[0]);
				$month[0]=$date->format('Y-m-d');
				$month[1]=$date->format('Y-m-t');
				
				
			}
			if(!empty($data['leave_type']))
			{
				$type=$data['leave_type'];
			}
			
			$insert_table=$this->report_model->leave_list($type,$from,$to,$month);
			if($insert_table!==false)
			{
				$message='Absent marked successfully';
			
				$report=array('status'=>1,'message'=>$message,'result'=>$insert_table,'link1'=>site_path.'reports/download_leave?leave_type='.$data['leave_type'].'&range='.$data['range'].'&month='.$data['month']);
				echo json_encode($report);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message,'link1'=>'#');
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
	public function download_leave()
	{
		if(isset($_GET['leave_type']))
		{
			
		
			
			$data=array();
			$month='';
			$from='';
			$to='';
			$type='';
			if(!empty($_GET['range']))
			{
				$split=explode(' - ',$_GET['range']);
				$date = DateTime::createFromFormat('Y/m/d', $split[0]);
				$date1= DateTime::createFromFormat('Y/m/d', $split[1]);
				$from=$date->format('Y-m-d');
				$to=$date1->format('Y-m-d');
				
			}
			if(!empty($_GET['month']))
			{
				$split[0]='01-'.$_GET['month'];
				$date = DateTime::createFromFormat('d-m-Y', $split[0]);
				$month[0]=$date->format('Y-m-d');
				$month[1]=$date->format('Y-m-t');
				
				
			}
			if(!empty($_GET['leave_type']))
			{
				$type=$_GET['leave_type'];
			}
			
			$insert_table=$this->report_model->leave_list($type,$from,$to,$month);
			if($insert_table!==false)
			{
				
			
				$data['result']=$insert_table;
				$data['content']="<table><tr><th>#</th><th>Date</th><th>Leaves</th><th>Month</th></tr>";
				$cc=0;
				foreach($insert_table as $item)
				{
					$cc++;
					$data['content'].="<tr><td>".$cc."</td><td>".$item['leave_date']."</td><td>".$item['leaves']."</td><td>".$item['month']."</td></tr>";
					//leavesmonth
				}
				$data['content'].="</table>";
				$this->load->view('excel',$data);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message,'link1'=>'#');
				
			}
				
			
		}		
		else
		{
			redirect(site_path,'refresh');
		}	
			
			
		
		
	}
	/* *********************  leave Completed *************************/


	public function salary()
	{
		
	  $this->load->library('leave_lib');
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['menu']=6;
	  $data['menu1']=61;
	  $data['message_div']='';
	  $data['page_title']="Salary Report";
	  $this->load->model('salary_model');
	  $date=new DateTime();
	  	$date->modify('-1 month');
	  	$date1=$date->format('Y-m');
	  	$month=explode('-',$date1);
	  	$data['salary_slips']=$this->salary_model->show_result($month);
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	  $this->load->view('emp_salary_report',$data);
	  $this->load->view('footer');
		
	}
	public function ajax_salary()
	{
		if ($this->input->is_ajax_request()) 
		{
			
		if($this->form_validation->run('salary_ajax')!==false)
		{
			
			$data=$this->input->post();
			$date=$data['month'];
				$month1=$date."-01";
				$month=explode('-',$month1);
				$this->load->model('salary_model');
				$result=$this->salary_model->show_result($month);
				if($result!==FALSE)
				{
					$json_array=array('status'=>1,'confirm'=>1,'message'=>'Results','result_array'=>$result);
					echo json_encode($json_array);	
					exit;	
				}
				else
				{
					$json_array=array('status'=>0,'confirm'=>1,'message'=>'Not generated','result_array'=>$result);
					echo json_encode($json_array);	
					exit;
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
	

/* *********************  Salary  Completed *************************/


	public function day_leave()
	{
		/*$this->load->model(array('employee_model'));*/
		$data['menu']=6;
		$data['menu1']=63;
	  $this->load->library('leave_lib');
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	 /* $data['employees_list']=$this->employee_model->list_employees();*/
	  $data['message_div']='';
	  $data['page_title']="Day Wise Leave Report";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	  $this->load->view('day_wise',$data);
	  $this->load->view('footer');
	}
	
	public function ajax_dayleave()
	{
		if ($this->input->is_ajax_request()) 
		{
			
			
		if($this->form_validation->run('dayleave_ajax')!==false)
		{
			
			$data=$this->input->post();
			$date=$data['month'];
			
			$list_employee=$this->report_model->daywise_leave($date);
			if($list_employee!==false)
			{
				$message='Value returned';
			
				$report=array('status'=>1,'message'=>$message,'result'=>$list_employee,'link1'=>site_path.'reports/download_dayleave?month='.$data['month']);
				echo json_encode($report);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message,'link1'=>'#');
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
	public function download_dayleave()
	{
		if(isset($_GET['month']))
		{
			if($this->validate_date_lessthantoday($_GET['month']))
			{
				
			
			$date=$_GET['month'];
			$list_employee=$this->report_model->daywise_leave($date);
			if($list_employee!==false)
			{
				
			
				$data['result']=$list_employee;
				$data['content']="<table> <tr><th>#</th><th>Employee No</th><th>Employee Name</th><th>Job Type</th><th>Employee Mobile</th><th>Leave Type</th><th>Reason</th></tr>";
				$cc=0;
				foreach($list_employee as $item)
				{
					$cc++;
					$data['content'].="<tr><td>".$cc."</td><td>".$item['emp_number']."</td><td>".$item['emp_firstname']." ".$item['emp_lastname']."</td><td>".$item['job_title_name']."</td><td>".$item['emp_hm_telephone']."</td><td>".$item['leave_type_name']."</td><td>".$item['leave_reason']."</td></tr>";
					//leavesmonth
				}
				$data['content'].="</table>";
				$this->load->view('excel',$data);
				
			}
			else
			{
				/*$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message,'link1'=>'#');*/
				
			}
				
			}
			else
			{
				redirect(site_path,'refresh');
			}
		}		
		else
		{
			redirect(site_path,'refresh');
		}	
			
			
		
		
	}


/* *********************  daywise  Completed *************************/


	public function Ot_report()
	{
		$data['menu']=6;
		$data['menu1']=64;
	  $this->load->library('leave_lib');
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['leave_request_types']=$this->leave_lib->leave_request_types();
	  $data['message_div']='';
	  $data['page_title']="Allowance";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	  $this->load->view('ot_report',$data);
	  $this->load->view('footer');
	}
	public function ajax_otreport()
	{
		if ($this->input->is_ajax_request()) 
		{
		if($this->form_validation->run('otreport_ajax')!==false)
		{
			
			$data=$this->input->post();
			$month='';
			$from='';
			$to='';
			$type='';
			if(!empty($data['range']))
			{
				$split=explode(' - ',$data['range']);
				$date = DateTime::createFromFormat('Y/m/d', $split[0]);
				$date1= DateTime::createFromFormat('Y/m/d', $split[1]);
				$from=$date->format('Y-m-d');
				$to=$date1->format('Y-m-d');
				
			}
			if(!empty($data['month']))
			{
				$month=$data['month'];
				
				
			}
			if(!empty($data['ot_type']))
			{
				$type=$data['ot_type'];
			}
			
			$insert_table=$this->report_model->otreport($type,$from,$to,$month);
			if($insert_table!==false)
			{
				$message='Result Fetched Successfully';
			
				$report=array('status'=>1,'message'=>$message,'result'=>$insert_table,'link1'=>site_path.'reports/download_otreport?ot_type='.$data['ot_type'].'&range='.$data['range'].'&month='.$data['month']);
				echo json_encode($report);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message,'link1'=>'#');
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
	public function download_otreport()
	{
		if(isset($_GET['ot_type']))
		{
			
		
			
			$data=array();
			$month='';
			$from='';
			$to='';
			$type='';
			if(!empty($_GET['range']))
			{
				$split=explode(' - ',$_GET['range']);
				$date = DateTime::createFromFormat('Y/m/d', $split[0]);
				$date1= DateTime::createFromFormat('Y/m/d', $split[1]);
				$from=$date->format('Y-m-d');
				$to=$date1->format('Y-m-d');
				
			}
			if(!empty($_GET['month']))
			{
				$month=$_GET['month'];
				
				
			}
			if(!empty($_GET['ot_type']))
			{
				$type=$_GET['ot_type'];
			}
			
			$insert_table=$this->report_model->otreport($type,$from,$to,$month);
			if($insert_table!==false)
			{
				
			
				$data['result']=$insert_table;
				$data['content']="<table><tr><th>#</th><th>Employee No</th><th>Employee Name</th><th>JOB TYPE</th><th>OT Fixed Hours</th><th>OT 1.5 Hours</th><th>OT 2 Hours</th><th>Total OT Hours</th></tr>";
				$cc=0;
				foreach($insert_table as $item)
				{
					$cc++;
					$total=$item['otfixed']+$item['ot15']+$item['ot2'];
					$data['content'].="<tr><td>".$cc."</td><td>".$item['emp_number']."</td><td>".$item['emp_firstname']." ".$item['emp_lastname']."</td><td>".$item['job_title_name']."</td><td>".$item['otfixed']."</td><td>".$item['ot15']."</td><td>".$item['ot2']."</td><td>".$total."</td></tr>";
					//leavesmonth
				}
				$data['content'].="</table>";
				$this->load->view('excel',$data);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message,'link1'=>'#');
				
			}
				
			
		}		
		else
		{
			redirect(site_path,'refresh');
		}	
			
			
		
		
	}
	
/* *********************  Ot Report  Completed *************************/
	
	
	public function allowance()
	{
		$data['menu']=6;
		$data['menu1']=65;
	  $this->load->model(array('allowance_model'));
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['allowance_type']=$this->allowance_model->allowance_types();
	  $data['message_div']='';
	  $data['page_title']="Allowance";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	 $this->load->view('allowance_report1',$data);
	  $this->load->view('footer');
	}
	public function ajax_allowance()
	{
		if ($this->input->is_ajax_request()) 
		{
		if($this->form_validation->run('otreport_ajax')!==false)
		{
			
			$data=$this->input->post();
			$month='';
			$from='';
			$to='';
			$type='';
			if(!empty($data['range']))
			{
				$split=explode(' - ',$data['range']);
				$date = DateTime::createFromFormat('Y/m/d', $split[0]);
				$date1= DateTime::createFromFormat('Y/m/d', $split[1]);
				$from=$date->format('Y-m-d');
				$to=$date1->format('Y-m-d');
				
			}
			if(!empty($data['month']))
			{
				$month=$data['month'];
				
				
			}
			if(!empty($data['ot_type']))
			{
				$type=$data['ot_type'];
			}
			
			$insert_table=$this->report_model->allowance_report1($type,$from,$to,$month);
			if($insert_table!==false)
			{
				$message='Result Fetched Successfully';
			
				$report=array('status'=>1,'message'=>$message,'result'=>$insert_table,'link1'=>site_path.'reports/download_allowance?ot_type='.$data['ot_type'].'&range='.$data['range'].'&month='.$data['month']);
				echo json_encode($report);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message,'link1'=>'#');
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
	public function download_allowance()
	{
		if(isset($_GET['ot_type']))
		{
			
		
			
			$data=array();
			$month='';
			$from='';
			$to='';
			$type='';
			if(!empty($_GET['range']))
			{
				$split=explode(' - ',$_GET['range']);
				$date = DateTime::createFromFormat('Y/m/d', $split[0]);
				$date1= DateTime::createFromFormat('Y/m/d', $split[1]);
				$from=$date->format('Y-m-d');
				$to=$date1->format('Y-m-d');
				
			}
			if(!empty($_GET['month']))
			{
				$month=$_GET['month'];
				
				
			}
			if(!empty($_GET['ot_type']))
			{
				$type=$_GET['ot_type'];
			}
			
			$insert_table=$this->report_model->allowance_report1($type,$from,$to,$month);
			if($insert_table!==false)
			{
				
			
				$data['result']=$insert_table;
				$data['content']="<table><tr><th>#</th><th>Employee No</th><th>Employee Name</th><th>Jobtype</th><th>Allowance Amount</th></tr>";
				$cc=0;
				foreach($insert_table as $item)
				{
					$cc++;
					$data['content'].="<tr><td>".$cc."</td><td>".$item['emp_number']."</td><td>".$item['emp_firstname']." ".$item['emp_lastname']."</td><td>".$item['job_title_name']."</td><td>".$item['otfixed']."</td></tr>";
					//leavesmonth
				}
				$data['content'].="</table>";
				$this->load->view('excel',$data);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message,'link1'=>'#');
				
			}
				
			
		}		
		else
		{
			redirect(site_path,'refresh');
		}	
			
			
		
		
	}

/* *********************  Allowance Report  Completed *************************/

	public function project_wise()
	{
		$data['menu']=6;
		$data['menu1']=67;
	  $this->load->model('jobsheet_model');
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['message_div']='';
	  $data['project_list']=$this->jobsheet_model->project_list();
	  $data['locations']=json_encode($this->jobsheet_model->location_list_all());
	  $data['page_title']="Project Wise Report";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	 $this->load->view('project_wise',$data);
	  $this->load->view('footer');
	}
	public function ajax_project()
	{
		if ($this->input->is_ajax_request()) 
		{
		if($this->form_validation->run('project_ajax')!==false)
		{
			
			$data=$this->input->post();
			$month='';
			$from='';
			$to='';
			$project='';
			$location='';
			if(!empty($data['range']))
			{
				$split=explode(' - ',$data['range']);
				$date = DateTime::createFromFormat('Y/m/d', $split[0]);
				$date1= DateTime::createFromFormat('Y/m/d', $split[1]);
				$from=$date->format('Y-m-d');
				$to=$date1->format('Y-m-d');
				
			}
			if(!empty($data['month']))
			{
				$month=$data['month'];
				
				
			}
			if(!empty($data['project']))
			{
				$project=$data['project'];
			}
			if(!empty($data['project']))
			{
				$location=$data['location'];
			}
			
			$insert_table=$this->report_model->project_wise($project,$location,$from,$to,$month);
			if($insert_table!==false)
			{
				$message='Result Fetched Successfully';
			
				$report=array('status'=>1,'message'=>$message,'result'=>$insert_table,'link1'=>site_path.'reports/download_project?project='.$data['project'].'&location='.$data['location'].'&range='.$data['range'].'&month='.$data['month']);
				echo json_encode($report);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message,'link1'=>'#');
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
	public function download_project()
	{
		if(isset($_GET['project']))
		{
			
		
			
			$data=array();
			$month='';
			$from='';
			$to='';
			$project='';
			$location='';
			if(!empty($_GET['range']))
			{
				$split=explode(' - ',$_GET['range']);
				$date = DateTime::createFromFormat('Y/m/d', $split[0]);
				$date1= DateTime::createFromFormat('Y/m/d', $split[1]);
				$from=$date->format('Y-m-d');
				$to=$date1->format('Y-m-d');
				
			}
			if(!empty($_GET['month']))
			{
				$month=$_GET['month'];
				
				
			}
			if(!empty($_GET['project']))
			{
				$project=$_GET['project'];
			}
			if(!empty($_GET['location']))
			{
				$location=$_GET['location'];
			}
			
			$insert_table=$this->report_model->project_wise($project,$location,$from,$to,$month);
			if($insert_table!==false)
			{
				
			
				$data['result']=$insert_table;
				$data['content']="<table><tr><th>#</th><th>Employee No</th><th>Employee Name</th><th>Jobtype</th><th>Worked Days</th></tr>";
				$cc=0;
				foreach($insert_table as $item)
				{
					$cc++;
					$data['content'].="<tr><td>".$cc."</td><td>".$item['emp_number']."</td><td>".$item['emp_firstname']." ".$item['emp_lastname']."</td><td>".$item['job_title_name']."</td><td>".$item['otfixed']."</td></tr>";
					//leavesmonth
				}
				$data['content'].="</table>";
				$this->load->view('excel',$data);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message,'link1'=>'#');
				
			}
				
			
		}		
		else
		{
			redirect(site_path,'refresh');
		}	
			
			
		
		
	}
	
	
	public function leave_request()
	{
	  $data['menu']=6;
	  $data['menu1']=66;
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['message_div']='';
	  $data['page_title']="Leave Request Report";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	  $this->load->view('leave_request_report',$data);
	  $this->load->view('footer');
	}
	
	
	
	
	
	
	public function expense()
	{
	  $data['menu']=6;
	  $data['menu1']=68;
	 
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['message_div']='';
	  $data['page_title']="Expense Report";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	 $this->load->view('expense_report',$data);
	  $this->load->view('footer');
	}
	
	public function validateDate($date, $format = 'Y-m-d')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}
	public function validate_date_lessthantoday($date)
	{
		if($this->validateDate($date))
		{
			
		
			$date = DateTime::createFromFormat('Y-m-d', $date);
			$date2=new DateTime();
			if($date<$date2)
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('validate_date_lessthantoday', 'Given Date not less than today');
				return FALSE;
			}
			}
			else
			{
					$this->form_validation->set_message('validate_date_lessthantoday', 'Given Date not valid');
					return FALSE;
				
			}
		
	}
	public function month_validate($date)
	{
		if($date=='')
		{
		    return TRUE;	
		}
		else
		{
			
		
			if($this->validateDate($date,'Y-m'))
																	{
			
		
			$date = DateTime::createFromFormat('Y-m', $date);
			$date2=new DateTime();
			if($date<=$date2)
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('month_validate', 'Given month not valid');
				return FALSE;
			}
			}
			else
			{
					$this->form_validation->set_message('month_validate', 'month not valid');
					return FALSE;
				
			}
		}
		
	}
	public function rangevalidate($range)
	{
		if($range=='')
		{
			return TRUE;
		}
		else
		{
			
		
		$resarray=explode(' - ',$range);
		
		if(isset($resarray[0]) && isset($resarray[1]) && $this->validateDate($resarray[0],'Y/m/d') && $this->validateDate($resarray[1],'Y/m/d'))
		{
			
		
			$date = DateTime::createFromFormat('Y-m-d', $resarray[0]);
			$date2 = DateTime::createFromFormat('Y-m-d', $resarray[1]);
			if($date<=$date2)
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('rangevalidate', 'Given Date not less than today');
				return FALSE;
			}
			}
		else
		{
				$this->form_validation->set_message('rangevalidate', 'Given Range Not valid');
				return FALSE;
			
		}
		}
	}
	
}
?>