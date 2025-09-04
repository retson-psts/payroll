<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Salary_slip extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->model(array('report_model','salary_model'));
	   $this->load->library(array('form_validation'));
	  
    }
	public function index()
	{
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$page_name=$this->router->fetch_class();
			$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		  	$data['page_title']="Salary Slip";
		  	$date=new DateTime();
		  	$date->modify('-1 month');
		  	$date1=$date->format('Y-m');
		  	$month=explode('-',$date1);
		  	$data['salary_slips']=$this->salary_model->show_result($month);
		  	
		  	//var_dump($data['salary_slips']);
			$this->load->view('header',$data);
			$this->load->view('side_menu_admin',$data);
			$this->load->view('list_employee_salary_slip',$data);
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
			$check_data=$this->jobsheet_added_test($date);
			if($check_data==1)
			{
				$month=explode('-',$date);
				$check_already_generated=$this->common_model->__fetch_contents('salary_master',array('month(salary_master_month)'=>$month[1],'year(salary_master_month)'=>$month[0],'salary_master_removed'=>0),'count(salary_master_id) as generated');
				$emp_count=$this->salary_model->available_employees($date);
				if($emp_count==FALSE)
				{
					$count11=0;
				}
				else
				{
					$count11=count($emp_count);
				}
				
			if($check_already_generated[0]['generated']==$count11 && $check_already_generated[0]['generated']!=0)
			{
				$month1=$date."-01";
				$result=$this->salary_model->show_result($month);
				$json_array=array('status'=>1,'confirm'=>1,'message'=>'Are You sure to regenerate Salary slips','result_array'=>$result);
				echo json_encode($json_array);	
				exit;
			}
			else
			{
				$result=$this->generate_salary_slip($date);
				$json_array=array('status'=>1,'confirm'=>0,'message'=>'Salary Slips Generated Successfully','result_array'=>$result);
				echo json_encode($json_array);
			}
				
			}
			else
			{
				
				$json_array=array('status'=>0,'message'=>'<p><b>Following Days Jobsheet not added </b></p><p>'.implode(", ",$check_data).'</p>');
				echo json_encode($json_array);
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
	
	public function view($id)
	{
		if(is_numeric($id) && (!empty($id)) )
		{
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$page_name=$this->router->fetch_class();
			$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		  	$data['page_title']="Salary Slip";
		  	$company_details=$this->common_model->__fetch_contents('company_config',array(),'*');
		  	//var_dump($company_details);
		  	$data['company_details']=$company_details[0];
		  	$total_details=$this->salary_model->salary_view($id);
		  	$data['total_details']=$total_details[0];
		  	$this->load->view('header',$data);
			$this->load->view('side_menu_admin',$data);
			$this->load->view('salary_slip_view',$data);
			$this->load->view('footer');
		}
		else
		{
			redirect(site_path,'redirect');
		}
	}
	
	public function salary_regenerate()
	{
		if ($this->input->is_ajax_request()) 
		{
			
			
		if($this->form_validation->run('salary_ajax')!==false)
		{
			
			$data=$this->input->post();
			$date=$data['month'];
			$check_data=$this->jobsheet_added_test($date);
			if($check_data==1)
			{
				$month=explode('-',$date);
				$check_already_generated=$this->common_model->__fetch_contents('salary_master',array('month(salary_master_month)'=>$month[1],'year(salary_master_month)'=>$month[0],'salary_master_removed'=>0),'count(salary_master_id) as generated');
				$emp_count=$this->common_model->__fetch_contents('employee',array('employee_deleted'=>0,'add_stat > '=>6),'count(employee_id) as employee');
			if($check_already_generated[0]['generated']==$emp_count[0]['employee'] && $check_already_generated[0]['generated']!=0)
			{
				$result=$this->generate_salary_slip($date);
				$json_array=array('status'=>1,'confirm'=>0,'message'=>'Salary Slips Regenerated Successfully','result_array'=>$result);				echo json_encode($json_array);
				exit;
			}
			else
			{
				$result=$this->generate_salary_slip($date);
				$json_array=array('status'=>1,'confirm'=>0,'message'=>'Salary Slips Regenerated Successfully','result_array'=>$result);
				echo json_encode($json_array);
				
			}
				
			}
			else
			{
				
				$json_array=array('status'=>0,'message'=>'<p><b>Following Days Jobsheet not added </b></p><p>'.implode(", ",$check_data).'</p>');
				echo json_encode($json_array);
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
	/**
	* 
	* @param Date $month 
	* 
	* @return 
	*/
	public function jobsheet_added_test($month)
	{
		$emp_list=$this->salary_model->fixed_salary_employee_all($month);
		if($emp_list!==FALSE)
		{
			
		
		$date_array=array();
		$date= DateTime::createFromFormat('Y-m',$month);
		$begin= DateTime::createFromFormat('Y-m-d',$date->format('Y-m-01'));
		$end= DateTime::createFromFormat('Y-m-d',$date->format('Y-m-t'));
		$end->modify('+1 day');
		$interval = new DateInterval('P1D');
		$daterange = new DatePeriod($begin, $interval ,$end);
		$status=1;
		foreach($daterange as $date1)
		{
			$checkdate=$date1->format('Y-m-d');
			$checkdate1=$date1->format('d-M-Y');
			$check_date_added=$this->common_model->__fetch_contents('jobsheet_master',array('jobsheet_master_date'=>$checkdate),'*');
			if($check_date_added===false)
			{
				$status=0;
				$date_array[]=$checkdate1;
			}
		}
		if($status==0)
		{
			return $date_array;
		}
		else
		{
			return $status;
		}
		}
		else
		{
			return 1;
		}
		
	}
	/**
	* @method generate_salar_slip()
	*  fetch all values for salary calculation
	* @param string $month
	* 
	* @return $final array
	*/
	private function generate_salary_slip($month)
	{
		$date=explode('-',$month);
		$emp_count=$this->common_model->__fetch_contents('employee',array('employee_deleted'=>0,'add_stat > '=>6),'employee_id');
		$fetch_employee_id=$this->salary_model->available_employees($month);
		$jobsheet=array();
		$leaves=array();
		$employee_type=array();
		$allowance=array();
		$final_array=array();
		$salary_details=array();
		foreach($fetch_employee_id as $employee_id)
		{
			$jobsheet[$employee_id['employee_id']]=$this->common_model->__fetch_contents('jobsheet',array('employee_id'=>$employee_id['employee_id'],'jobsheet_removed'=>0,'month(jobsheet_date)'=>$date[1],'year(jobsheet_date)'=>$date[0]),'sum(jobsheet_ot15) as ot15,sum(jobsheet_ot2) as ot2');
			$ot_fixed=$this->common_model->__fetch_contents('jobsheet',array('employee_id'=>$employee_id['employee_id'],'jobsheet_removed'=>0,'month(jobsheet_date)'=>$date[1],'year(jobsheet_date)'=>$date[0],'jobsheet_otfixed <>'=>0),'count(jobsheet_otfixed) as otfixed');
			$jobsheet[$employee_id['employee_id']][0]['otfixed']=$ot_fixed[0]['otfixed'];
			$jobsheet1[$employee_id['employee_id']]=$this->common_model->__fetch_contents('jobsheet',array('employee_id'=>$employee_id['employee_id'],'jobsheet_removed'=>0,'jobsheet_absent <>'=>1,'month(jobsheet_date)'=>$date[1],'year(jobsheet_date)'=>$date[0]),'count(employee_id) as present');
			
			$leaves[$employee_id['employee_id']]=$this->common_model->__fetch_contents('employee_leave',array('employee_id'=>$employee_id['employee_id'],'leave_request'=>1,'month(leave_date)'=>$date[1],'year(leave_date)'=>$date[0],'leave_deduct_salary'=>1),'count(leave_id) as emp_leave');
			$leaves_non_deduct=$this->common_model->__fetch_contents('employee_leave',array('employee_id'=>$employee_id['employee_id'],'leave_request'=>1,'month(leave_date)'=>$date[1],'year(leave_date)'=>$date[0],'leave_deduct_salary'=>0),'count(leave_id) as emp_leave');
			$allowance[$employee_id['employee_id']]=$this->common_model->__fetch_contents('emp_allowance',array('employee_id'=>$employee_id['employee_id'],'emp_allowance_approved'=>1,'month(emp_allowance_month)'=>$date[1],'year(emp_allowance_month)'=>$date[0]),'sum(emp_allowance_amount) as allowance_amount, allowance_cpf_detect','allowance_cpf_detect');
			$employee_type[$employee_id['employee_id']]=$this->common_model->__fetch_contents('employee_immigration',array('employee_id'=>$employee_id['employee_id']),'ei_permit_type as permit');
			$salary_details[$employee_id['employee_id']]=$this->common_model->__fetch_contents('employee_salary',array('employee_id'=>$employee_id['employee_id']),'*');
			
			$final_array[$employee_id['employee_id']]['jobsheet']=$jobsheet[$employee_id['employee_id']][0];
			$final_array[$employee_id['employee_id']]['leaves']=$leaves[$employee_id['employee_id']][0];
			$final_array[$employee_id['employee_id']]['nleaves']=$leaves_non_deduct[0];
			$final_array[$employee_id['employee_id']]['allowance']=$allowance[$employee_id['employee_id']];
			$final_array[$employee_id['employee_id']]['employee_type']=$employee_type[$employee_id['employee_id']][0];
			$final_array[$employee_id['employee_id']]['salary']=$salary_details[$employee_id['employee_id']][0];
			$final_array[$employee_id['employee_id']]['present']=$jobsheet1[$employee_id['employee_id']][0];
			
			
		}
		return $this->check_and_insert($final_array,$month);
		
		
	}
	private function check_and_insert($final_array,$month)
	{
		//print_r($final_array);
	
		$insert_final_array=array();
		$month=$month.'-01';
		foreach($final_array as $emp_id=>$array)
		{
			$insert_final_array[$emp_id]['employee_id']=$emp_id;
			$insert_final_array[$emp_id]['salary_master_month']=$month;
			$insert_final_array[$emp_id]['employee_master_basic_salay']=$array['salary']['emp_salary_amount'];
			$fixed_salary=$array['salary']['emp_salary_fixed'];
			$per_day=$array['salary']['emp_salary_amount']/30;
			$insert_final_array[$emp_id]['per_day']=$per_day;
			$insert_final_array[$emp_id]['leave_days']=$array['leaves']['emp_leave'];
			$less_salay=$array['leaves']['emp_leave']*$per_day;
			$insert_final_array[$emp_id]['leave_less_pay']=$array['leaves']['emp_leave']*$per_day;
			if($fixed_salary==1)
			{
				$total_salary=$insert_final_array[$emp_id]['employee_master_basic_salay']-$insert_final_array[$emp_id]['leave_less_pay'];
			}
			else
			{
				$total_salary=($array['nleaves']['emp_leave']+$array['present']['present'])*$per_day;
			}
			
			$ordinary_wage=round($total_salary, 0, PHP_ROUND_HALF_UP);
			$insert_final_array[$emp_id]['ordinary_wage']=$ordinary_wage;
			$insert_final_array[$emp_id]['worked_days']=$array['present']['present'];
			$insert_final_array[$emp_id]['non_deduct_leave']=$array['nleaves']['emp_leave'];
			$insert_final_array[$emp_id]['ordinary_wage']=$ordinary_wage;
			$insert_final_array[$emp_id]['otfixed_hours']=$array['jobsheet']['otfixed'];
			$insert_final_array[$emp_id]['otfixed_amount']=$array['salary']['emp_ot_base_amount'];
			
			$otfixed_pay=$array['salary']['emp_ot_base_amount']*$array['jobsheet']['otfixed'];
			
			$insert_final_array[$emp_id]['otfixed_pay']=round($otfixed_pay,2,PHP_ROUND_HALF_UP);
			$insert_final_array[$emp_id]['ot15_hours']=$array['jobsheet']['ot15']?$array['jobsheet']['ot15']:0;
			$insert_final_array[$emp_id]['othour_amount']=$array['salary']['emp_ot_per_hour_amount'];
			$ot15_pay=($array['salary']['emp_ot_per_hour_amount']*1.5)*$array['jobsheet']['ot15'];
			$insert_final_array[$emp_id]['ot15_pay']=round($ot15_pay,2,PHP_ROUND_HALF_UP);
			//var_dump($array['jobsheet']['ot2']);
			$insert_final_array[$emp_id]['ot2_hours']=$array['jobsheet']['ot2']?$array['jobsheet']['ot2']:0;
			$ot2_pay=($array['salary']['emp_ot_per_hour_amount']*2)*($array['jobsheet']['ot2']?$array['jobsheet']['ot2']:0);
			//var_dump($ot2_pay);
			$insert_final_array[$emp_id]['ot2_pay']=round($ot2_pay,2,PHP_ROUND_HALF_UP);
			$insert_final_array[$emp_id]['allowance_cpf_deduct']=0;
			$insert_final_array[$emp_id]['allowance_cpf_ndeduct']=0;
			
			
			if(!empty($array['allowance']))
			{
			   
				foreach($array['allowance'] as $allowance)
				{
					if($allowance['allowance_cpf_detect']==0)
					{
						$insert_final_array[$emp_id]['allowance_cpf_deduct']=$allowance['allowance_amount'];
					}
					else if($allowance['allowance_cpf_detect']==1)
					{
						$insert_final_array[$emp_id]['allowance_cpf_ndeduct']=$allowance['allowance_amount'];
					}
					
				}
			}
			$total_wages=$ordinary_wage+$ot15_pay+$otfixed_pay+$ot2_pay+$insert_final_array[$emp_id]['allowance_cpf_deduct'];
			$insert_final_array[$emp_id]['total_wage']=$total_wages;
			$insert_final_array[$emp_id]['total_wage1']=$total_wages+$insert_final_array[$emp_id]['allowance_cpf_ndeduct'];
			$insert_final_array[$emp_id]['sdl']=$this->calculate_sdl($insert_final_array[$emp_id]['total_wage1']);
			$insert_final_array[$emp_id]['cdac']=0;
			$insert_final_array[$emp_id]['cdac_calculation']='';
			if($array['salary']['emp_salary_cdac']==1)
			{
				$cdac_array=$this->calculate_cdac($insert_final_array[$emp_id]['total_wage1']);
				$insert_final_array[$emp_id]['cdac']=$cdac_array['res'];
				$insert_final_array[$emp_id]['cdac_calculation']=$cdac_array['calc'];
			}
			$insert_final_array[$emp_id]['mbmf']=0;
			$insert_final_array[$emp_id]['mbmf_calculation']='';
			if($array['salary']['emp_salary_mbmf']==1)
			{
				$cdac_array=$this->calculate_mbmf($insert_final_array[$emp_id]['total_wage1']);
				$insert_final_array[$emp_id]['mbmf']=$cdac_array['res'];
				$insert_final_array[$emp_id]['mbmf_calculation']=$cdac_array['calc'];
			}
			$insert_final_array[$emp_id]['sinda']=0;
			$insert_final_array[$emp_id]['sinda_calculation']='';
			if($array['salary']['emp_salary_sinda']==1)
			{
				$cdac_array=$this->calculate_sinda($insert_final_array[$emp_id]['total_wage1']);
				$insert_final_array[$emp_id]['sinda']=$cdac_array['res'];
				$insert_final_array[$emp_id]['sinda_calculation']=$cdac_array['calc'];
			}
			$insert_final_array[$emp_id]['ecf']=0;
			$insert_final_array[$emp_id]['ecf_calculation']='';
			if($array['salary']['emp_salary_ecf']==1)
			{
				$cdac_array=$this->calculate_ecf($insert_final_array[$emp_id]['total_wage1']);
				$insert_final_array[$emp_id]['ecf']=$cdac_array['res'];
				$insert_final_array[$emp_id]['ecf_calculation']=$cdac_array['calc'];
			}
			$insert_final_array[$emp_id]['share']=0;
			$insert_final_array[$emp_id]['share_calculation']='';
			if($array['salary']['emp_salary_share']==1)
			{
				$cdac_array=$this->calculate_share($insert_final_array[$emp_id]['total_wage1']);
				$insert_final_array[$emp_id]['share']=$cdac_array['res'];
				$insert_final_array[$emp_id]['share_calculation']=$cdac_array['calc'];
			}
			$employee_type=$array['employee_type']['permit'];
			$additional_wage=$ot15_pay+$otfixed_pay+$ot2_pay+$insert_final_array[$emp_id]['allowance_cpf_deduct'];
			$array_cpf=$this->calculate_cpf($emp_id,$total_wages,$employee_type,$ordinary_wage,$additional_wage,$month);
			$insert_final_array[$emp_id]['additional_wages']=$additional_wage;
			$insert_final_array[$emp_id]['cpf_employee']=$array_cpf['employee'];
			$insert_final_array[$emp_id]['cpf_employer']=$array_cpf['employer'];
			
			$insert_final_array[$emp_id]['cpf_calc']=$array_cpf['res'];
			$net_pay=$insert_final_array[$emp_id]['total_wage1']-($array_cpf['employee']+$insert_final_array[$emp_id]['cdac']+$insert_final_array[$emp_id]['mbmf']+$insert_final_array[$emp_id]['sinda']+$insert_final_array[$emp_id]['ecf']+$insert_final_array[$emp_id]['share']);
			$insert_final_array[$emp_id]['net_pay']=$net_pay;
			$date1=DateTime::createFromFormat('Y-m-d',$month);
			$to=$date1->format('Y-m-t');
			$insert_final_array[$emp_id]['salary_period_from']=$month;
			$insert_final_array[$emp_id]['salary_period_to']=$to;
		}
		$this->salary_model->salary_add($insert_final_array,$month);
		$month1=explode('-',$month);
		return $this->salary_model->show_result($month1);
		
	}
	private function calculate_cdac($total_wage)
	{
		if($total_wage<=2000)
		{
			$ret_array=array('res'=>0.5,'calc'=>'Wage <=2000');
		}
		elseif($total_wage>2000 && $total_wage<=3500)
		{
			$ret_array=array('res'=>1,'calc'=>'Wage between 2000 to 3500');
		}
		elseif($total_wage>3500 && $total_wage<=5000)
		{
			$ret_array=array('res'=>1.5,'calc'=>'Wage between 3500 to 5000');
		}
		else if($total_wage>5000 && $total_wage<=7500)
		{
			$ret_array=array('res'=>2,'calc'=>'Wage between 5000 to 7500');
		}
		elseif($total_wage>7500)
		{
			$ret_array=array('res'=>3,'calc'=>'Wage > 7500');
		}
		return $ret_array;
	}
	private function calculate_mbmf($total_wage)
	{
		if($total_wage<200)
		{
			$ret_array=array('res'=>0,'calc'=>'Wage <=200');
			
		}
		elseif($total_wage<=1000)
		{
			$ret_array=array('res'=>2,'calc'=>'Wage <=2000');
		}
		elseif($total_wage>1000 && $total_wage<=2000)
		{
			$ret_array=array('res'=>3.5,'calc'=>'Wage between 1001 to 2000');
		}
		elseif($total_wage>2000 && $total_wage<=3000)
		{
			$ret_array=array('res'=>5,'calc'=>'Wage between 2001 to 3000');
		}
		elseif($total_wage>3000 && $total_wage<=4000)
		{
			$ret_array=array('res'=>12.5,'calc'=>'Wage between 3001 to 4000');
		}
		elseif($total_wage>4000)
		{
			$ret_array=array('res'=>16,'calc'=>'Wage > 7500');
		}
		return $ret_array;
	}
	private function calculate_share($total_wage)
	{
		$ret_array=array('res'=>0,'calc'=>'0');
		return $ret_array;
	}
	private function calculate_sinda($total_wage)
	{
		if($total_wage<=1000)
		{
			$ret_array=array('res'=>1,'calc'=>'Wage <=1000');
		}
		elseif($total_wage>1000 && $total_wage<=1500)
		{
			$ret_array=array('res'=>3,'calc'=>'Wage between 1000 to 1500');
		}
		elseif($total_wage>1500 && $total_wage<=2500)
		{
			$ret_array=array('res'=>5,'calc'=>'Wage between 1500 to 2500');
		}
		elseif($total_wage>2500 && $total_wage<=4500)
		{
			$ret_array=array('res'=>7,'calc'=>'Wage between 2500 to 4500');
		}
		elseif($total_wage>4500 && $total_wage<=7500)
		{
			$ret_array=array('res'=>9,'calc'=>'Wage between 4500 to 7500');
		}
		elseif($total_wage>7500 && $total_wage<=10000)
		{
			$ret_array=array('res'=>12,'calc'=>'Wage between 7500 to 10000');
		}
		elseif($total_wage>10000 && $total_wage<=15000)
		{
			$ret_array=array('res'=>18,'calc'=>'Wage between 10000 to 15000');
		}
		elseif($total_wage>15000)
		{
			$ret_array=array('res'=>30,'calc'=>'Wage > 30000');
		}
		return $ret_array;
		
	}
	private function calculate_ecf($total_wage)
	{
		if($total_wage<=1000)
		{
			$ret_array=array('res'=>2,'calc'=>'Wage <=1000');
		}
		elseif($total_wage>1000 && $total_wage<=1500)
		{
			$ret_array=array('res'=>4,'calc'=>'Wage between 1000 to 1500');
		}
		elseif($total_wage>1500 && $total_wage<=2500)
		{
			$ret_array=array('res'=>6,'calc'=>'Wage between 1500 to 2500');
		}
		elseif($total_wage>2500 && $total_wage<=4000)
		{
			$ret_array=array('res'=>9,'calc'=>'Wage between 2500 to 4000');
		}
		elseif($total_wage>4000 && $total_wage<=7000)
		{
			$ret_array=array('res'=>12,'calc'=>'Wage between 4500 to 7000');
		}
		elseif($total_wage>7000 && $total_wage<=10000)
		{
			$ret_array=array('res'=>16,'calc'=>'Wage between 7500 to 10000');
		}
		elseif($total_wage>10000)
		{
			$ret_array=array('res'=>20,'calc'=>'Wage > 30000');
		}
		return $ret_array;
		
	}
	/**
	*  @method calculate_cpf
	* this method select which type of user and calculate depeding user
	* example is singapore citizen calculate
	* @param int $emp_id
	* @param float $total_wages
	* @param int $employee_type
	* @param float $ordinary_wage
	* @param float $additional_wage
	* @param string $month
	* 
	* @return array contains description calculated, employee contribution, employer contribution 
	*/
	private function calculate_cpf($emp_id,$total_wages,$employee_type,$ordinary_wage,$additional_wage,$month)
	{
		if($employee_type==singapore_citizen)
		{
			if($total_wages<=50)
			{
				$ret_array=array('res'=>'Wage less than 50','employee'=>'','employer'=>'');
				return $ret_array;
			}
			else
			{
				
				return $this->calculate_singapore_cpf($emp_id,$total_wages,$employee_type,$ordinary_wage,$additional_wage,$month);
				
			}
		}
		elseif($employee_type==permenant_resitent)
		{
			if($total_wages<=50)
			{
				$ret_array=array('res'=>'Wage less than 50','employee'=>'','employer'=>'');
				return $ret_array;
			}
			else
			{
				
				$year=$this->check_spr_year($emp_id,$month);
				switch($year)
				{
					case 1:
						return $this->calculate_singapore_first($emp_id,$total_wages,$employee_type,$ordinary_wage,$additional_wage,$month);
						break;
					case 2:
						return $this->calculate_singapore_second($emp_id,$total_wages,$employee_type,$ordinary_wage,$additional_wage,$month);
						break;
					case 3:
						return $this->calculate_singapore_cpf($emp_id,$total_wages,$employee_type,$ordinary_wage,$additional_wage,$month);
						break;
						
					
				}
				
				
			}
		}
		else
		{
			$ret_array=array('res'=>'Not Applicable','employee'=>'','employer'=>'');
			return $ret_array;
		}
		
	}


	/**
	* @method calculate_singapore_second
	* This method calculate Second year singapore permanent resident holder will allocate there salary
	* ref:https://mycpf.cpf.gov.sg/Assets/employers/Documents/CPFconratetable_from1Jan2015_forPTEandNPEN_SC.pdf
	* 
	* @param int $emp_id
	* @param float $total_wages
	* @param int $employee_type
	* @param float $ordinary_wage
	* @param float $additional_wage
	* @param string $month
	* 
	* @return array contains description calculated, employee contribution, employer contribution 
	* 
	* 
	* 
	*/
	private function calculate_singapore_cpf($emp_id,$total_wages,$employee_type,$ordinary_wage,$additional_wage,$month)
	{
		$age_category=$this->age_category($emp_id,$month);
		switch($age_category)
		{
			
			case 1:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*17)/100;
				 	$employee=0;
				 	$res="17% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*17)/100;
				 	$employee=0.6*($total_wages-500);
				 	$res="17% (TW) + 0.6 (TW - $500) 0.6 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
			     	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*17)/100)+(($additional_wage*17)/100);
				 	$employee=(($ordinary_wage*20)/100)+(($additional_wage*20)/100);
				 	$res="[37% (OW)]* + 37% (AW)  [20% (OW)]* + 20% (AW)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			  
			  case 2:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*16)/100;
				 	$employee=0;
				 	$res="16% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*16)/100;
				 	$employee=0.57*($total_wages-500);
				 	$res="16% (TW) + 0.57 (TW - $500) 0.57 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*16)/100)+(($additional_wage*16)/100);
				 	$employee=(($ordinary_wage*19)/100)+(($additional_wage*19)/100);
				 	$res="[35% (OW)]* + 35% (AW) * Max. of $1,750 [19% (OW)]* + 19% (AW) * Max. of $950";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			  
			  case 3:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*12)/100;
				 	$employee=0;
				 	$res="12% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*12)/100;
				 	$employee=0.39*($total_wages-500);
				 	$res="12% (TW) + 0.39 (TW - $500) 0.39 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*12)/100)+(($additional_wage*12)/100);
				 	$employee=(($ordinary_wage*13)/100)+(($additional_wage*13)/100);
				 	$res="[25% (OW)]* + 25% (AW) * Max. of $1,250  [13% (OW)]* + 13% (AW) * Max. of $650";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			   case 4:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*8.5)/100;
				 	$employee=0;
				 	$res="8.5% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*8.5)/100;
				 	$employee=0.225*($total_wages-500);
				 	$res="8.5% (TW) + 0.225 (TW - $500) 0.225 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*8.5)/100)+(($additional_wage*8.5)/100);
				 	$employee=(($ordinary_wage*7.5)/100)+(($additional_wage*7.5)/100);
				 	$res="[16% (OW)]* + 16% (AW) * Max. of $1,250  [7.5% (OW)]* + 7.5% (AW) * Max. of $650";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			   case 5:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*7.5)/100;
				 	$employee=0;
				 	$res="7.5% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*7.5)/100;
				 	$employee=0.15*($total_wages-500);
				 	$res="7.5% (TW) + 0.15 (TW - $500) 0.15 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*7.5)/100)+(($additional_wage*7.5)/100);
				 	$employee=(($ordinary_wage*5)/100)+(($additional_wage*5)/100);
				 	$res="[12.5% (OW)]* + 12.5% (AW) * Max. of $625 [5% (OW)]* + 5% (AW) * Max. of $250";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			
			
		}
	}

	/**
	* @method calculate_singapore_second
	* This method calculate Second year singapore permanent resident holder will allocate there salary
	* ref:https://mycpf.cpf.gov.sg/Assets/employers/Documents/CPFconratetable_from1Jan2015_forPTEandNPEN_2GG.pdf
	* 
	* @param int $emp_id
	* @param float $total_wages
	* @param int $employee_type
	* @param float $ordinary_wage
	* @param float $additional_wage
	* @param string $month
	* 
	* @return array contains description calculated, employee contribution, employer contribution 
	* 
	* 
	* 
	*/
	
	private function calculate_singapore_second($emp_id,$total_wages,$employee_type,$ordinary_wage,$additional_wage,$month)
	{
		$age_category=$this->age_category($emp_id,$month);
		switch($age_category)
		{
			
			case 1:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*9)/100;
				 	$employee=0;
				 	$res="9% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*9)/100;
				 	$employee=0.45*($total_wages-500);
				 	$res="17% (TW) + 0.6 (TW - $500) 0.6 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
			     	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*9)/100)+(($additional_wage*9)/100);
				 	$employee=(($ordinary_wage*15)/100)+(($additional_wage*15)/100);
				 	$res="[24% (OW)]* + 24% (AW)  [15% (OW)]* + 15% (AW)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			  
			  case 2:
			      if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*9)/100;
				 	$employee=0;
				 	$res="9% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*9)/100;
				 	$employee=0.45*($total_wages-500);
				 	$res="17% (TW) + 0.6 (TW - $500) 0.6 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
			     	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*9)/100)+(($additional_wage*9)/100);
				 	$employee=(($ordinary_wage*15)/100)+(($additional_wage*15)/100);
				 	$res="[24% (OW)]* + 24% (AW)  [15% (OW)]* + 15% (AW)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			  
			  case 3:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*6)/100;
				 	$employee=0;
				 	$res="6% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*6)/100;
				 	$employee=0.375*($total_wages-500);
				 	$res="6% (TW) + 0.375 (TW - $500) 0.375 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*6)/100)+(($additional_wage*6)/100);
				 	$employee=(($ordinary_wage*12.5)/100)+(($additional_wage*12.5)/100);
				 	$res="[18.5% (OW)]* + 18.5% (AW) * Max. of $1,250  [12.5% (OW)]* + 12.5% (AW) * Max. of $650";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			   case 4:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*3.5)/100;
				 	$employee=0;
				 	$res="3.5% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*3.5)/100;
				 	$employee=0.225*($total_wages-500);
				 	$res="3.5% (TW) + 0.225 (TW - $500) 0.225 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*8.5)/100)+(($additional_wage*3.5)/100);
				 	$employee=(($ordinary_wage*7.5)/100)+(($additional_wage*7.5)/100);
				 	$res="[11% (OW)]* + 11% (AW) * Max. of $1,250  [7.5% (OW)]* + 7.5% (AW) * Max. of $650";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			   case 5:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*3.5)/100;
				 	$employee=0;
				 	$res="3.5% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*3.5)/100;
				 	$employee=0.15*($total_wages-500);
				 	$res="3.5% (TW) + 0.57 (TW - $500) 0.15 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*3.5)/100)+(($additional_wage*3.5)/100);
				 	$employee=(($ordinary_wage*5)/100)+(($additional_wage*5)/100);
				 	$res="[8.5% (OW)]* + 8.5% (AW) * Max. of $625 [5% (OW)]* + 5% (AW) * Max. of $250";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			
			
		}
	}
	
	/**
	* @method calculate_singapore_first
	* This method calculate first year singapore permanent resident holder will allocate there salary
	* ref:https://mycpf.cpf.gov.sg/Assets/employers/Documents/CPFconratetable_from1Jan2015_forPTEandNPEN_1GG.pdf
	* 
	* @param int $emp_id
	* @param float $total_wages
	* @param int $employee_type
	* @param float $ordinary_wage
	* @param float $additional_wage
	* @param string $month
	* 
	* @return array contains description calculated, employee contribution, employer contribution 
	* 
	* 
	* 
	*/
	private function calculate_singapore_first($emp_id,$total_wages,$employee_type,$ordinary_wage,$additional_wage,$month)
	{
		$age_category=$this->age_category($emp_id,$month);
		switch($age_category)
		{
			
			case 1:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*4)/100;
				 	$employee=0;
				 	$res="4% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*4)/100;
				 	$employee=0.15*($total_wages-500);
				 	$res="4% (TW) + 0.4 (TW - $500) 0.4 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
			     	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*4)/100)+(($additional_wage*4)/100);
				 	$employee=(($ordinary_wage*5)/100)+(($additional_wage*5)/100);
				 	$res="[9% (OW)]* + 9% (AW)  [5% (OW)]* + 5% (AW)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			  
			  case 2:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*4)/100;
				 	$employee=0;
				 	$res="4% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*4)/100;
				 	$employee=0.15*($total_wages-500);
				 	$res="4% (TW) + 0.15 (TW - $500) 0.15 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*4)/100)+(($additional_wage*4)/100);
				 	$employee=(($ordinary_wage*5)/100)+(($additional_wage*5)/100);
				 	$res="[9% (OW)]* + 9% (AW) * Max. of $1,750 [4% (OW)]* + 4% (AW) * Max. of $950";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			  
			  case 3:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*4)/100;
				 	$employee=0;
				 	$res="4% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*4)/100;
				 	$employee=0.15*($total_wages-500);
				 	$res="4% (TW) + 0.15 (TW - $500) 0.15 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*4)/100)+(($additional_wage*4)/100);
				 	$employee=(($ordinary_wage*5)/100)+(($additional_wage*5)/100);
				 	$res="[9% (OW)]* + 9% (AW) * Max. of $1,750 [5% (OW)]* + 5% (AW) * Max. of $950";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  
			   case 4:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*3.5)/100;
				 	$employee=0;
				 	$res="3.5% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*3.5)/100;
				 	$employee=0.15*($total_wages-500);
				 	$res="3.5% (TW) + 0.15 (TW - $500) 0.15 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*3.5)/100)+(($additional_wage*3.5)/100);
				 	$employee=(($ordinary_wage*5)/100)+(($additional_wage*5)/100);
				 	$res="[8.5% (OW)]* + 8.5% (AW) * Max. of $1,750 [5% (OW)]* + 5% (AW) * Max. of $950";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			  case 5:
			     if($total_wages>50 && $total_wages<=500)
			     {
				 	$employer=($total_wages*3.5)/100;
				 	$employee=0;
				 	$res="3.5% (TW) - Nil";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 else if($total_wages>500 && $total_wages<=750)
			     {
				 	$employer=($total_wages*3.5)/100;
				 	$employee=0.15*($total_wages-500);
				 	$res="3.5% (TW) + 0.15 (TW - $500) 0.15 (TW - $500)";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				else if($total_wages>750)
			     {
				 	if($ordinary_wage>5000)
			     	{
						$ordinary_wage=5000;
					}
				 	$employer=(($ordinary_wage*3.5)/100)+(($additional_wage*3.5)/100);
				 	$employee=(($ordinary_wage*5)/100)+(($additional_wage*5)/100);
				 	$res="[8.5% (OW)]* + 8.5% (AW) * Max. of $1,750 [5% (OW)]* + 5% (AW) * Max. of $950";
				 	$ret_array=array('res'=>$res,'employee'=>round($employee,0),'employer'=>round($employer,0));
				 }
				 return $ret_array;
			  break;
			
			
		}
	}

	private function age_category($emp_id,$month)
	{
		$dob=$this->common_model->__fetch_contents('employee',array('employee_id'=>$emp_id),'emp_birthday');
		$dob1=$dob[0]['emp_birthday'];
		$date = DateTime::createFromFormat('Y-m-d', $dob1);
		$now = DateTime::createFromFormat('Y-m-d',$month);
		$now->modify('-1 day');
		$years=$now->diff($date)->y;
    	if($years<=50)
    	{
			return 1;
		}
		elseif($years>50 && $years<=55)
		{
			return 2;
		}
		elseif($years>55 && $years<=60)
		{
			return 3;
		}
		elseif($years>60 && $years<=65)
		{
			return 4;
		}
		elseif($years>65)
		{
			return 5;
		}
   	}

    private function custom_encrypt($array,$column)
    {
    	//var_dump($array);
    	$this->load->library('encrypt');
    	//var_dump($array);
    	
		foreach($array as $key => $value){
			
//		 	$array[$key][$column]=$this->encrypt->encode($value[$column]);
		 	
		 }
		 return $array;
		 
	}
	
	
	/**
	*  @method check_spr_year($emp_id,$month)
	*  to find year after singapore permanent residence
	* 
	* @param int $emp_id
	* 
	* @return
	*/
	private function check_spr_year($emp_id,$month)
	{
		$fetch=$this->common_model->__fetch_contents('employee_immigration',array('employee_id'=>$emp_id),'ei_permit_issuedate');
		$date=$fetch[0]['ei_permit_issuedate'];
		$dob = new DateTime($date);
    	$now = new DateTime($month);
    	$now->modify('-1 month');
    	$now->modify('-1 day');
    	$xxx=$now->diff($dob)->y;
    	if($xxx >= 2)
    	{
			return 3;
		}
		else if($xxx < 2 && $xxx>=1)
		{
			return 2;
		}
		else
		{
			return 1;
			
		}
	
	}
	/**
	* calculate sdl
	*/
	private function calculate_sdl($total_wage)
	{
		if($total_wage<800)
		{
			return 2;
		}
		else if($total_wage>=800 && $total_wage<4500)
		{
			
			$sdl_emp=($total_wage*0.25)/100;
			return round($sdl_emp,2);
			
		}
		else if( $total_wage>=4500)
		{
			return 11.25;
		}
		
	}
	/*private function check_all_are_fixed_salary($month)
	{
		$emp_details=$this->salary_model->fixed_salary_employee_all($month);
		return $emp_details;
	}*/

}
