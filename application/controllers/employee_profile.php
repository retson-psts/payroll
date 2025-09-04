<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_profile extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->model(array('employee_model'));
	  $this->load->library('employee_lib');
    }
	public function index($employee_id)
	{
		if(is_numeric($employee_id) && !empty($employee_id))
		{
			$data['employee_id']=$employee_id;
			$this->load->helper('custom_helper');
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
			$employee=$this->common_model->__fetch_contents('employee',array('employee_id'=>$employee_id),'*');
			$contact=$this->common_model->__fetch_contents('employee_contact_address',array('employee_id'=>$employee_id),'*');
			$emergency=$this->common_model->__fetch_contents('employee_emergency_contact',array('employee_id'=>$employee_id),'*');
			$dependents=$this->common_model->__fetch_contents('employee_dependents',array('employee_id'=>$employee_id),'*');
			$this->load->model('employee_profile_model');
			$job_details=$this->employee_profile_model->job_details($employee_id);
			
			$immigration=$this->common_model->__fetch_contents('employee_immigration',array('employee_id'=>$employee_id),'*');
			$passport=$this->common_model->__fetch_contents('employee_passport',array('ep_employee_id'=>$employee_id),'*');
			$experience=$this->common_model->__fetch_contents('emp_workexp',array('employee_id'=>$employee_id),'*');
			$education=$this->common_model->__fetch_contents('emp_education',array('employee_id'=>$employee_id),'*');
			$bank=$this->common_model->__fetch_contents('employee_bank',array('employee_id'=>$employee_id),'*');
			$img=$this->common_model->__fetch_contents('employee_media',array('employee_id'=>$employee_id),'*','','emp_attach_id DESC');
			$skills=$this->employee_model->get_employe_skills1($employee_id);
			$salary=$this->common_model->__fetch_contents('employee_salary',array('employee_id'=>$employee_id),'*');
			$salary[0]['emp_salary_pay_period']=$this->salary_period($salary[0]['emp_salary_pay_period']);
			$employee[0]['nationality']=$this->nationality($employee[0]['nation_code']);
			$employee[0]['licence']=licence_type($employee[0]['emp_licence_type']);
			$employee[0]['gender']=gender_name($employee[0]['emp_gender']);
			$employee[0]['marital']=marital_status($employee[0]['emp_marital_status']);
			$employee[0]['dob']=format_date_custom($employee[0]['emp_birthday']);
			$employee[0]['licence_exp']=format_date_custom($employee[0]['emp_dri_lice_exp_date']);
			$contact[0]['emp_contact_temp_country_name']=$this->country_name($contact[0]['emp_contact_temp_country']);
			$contact[0]['emp_contact_temp_provience_name']=$this->state_name($contact[0]['emp_contact_temp_provience']);
			$contact[0]['emp_contact_temp_city_name']=$this->city_name($contact[0]['emp_contact_temp_city']);
			$contact[0]['emp_contact_perma_country_name']=$this->country_name($contact[0]['emp_contact_perma_country']);
			$contact[0]['emp_contact_perma_provience_name']=$this->state_name($contact[0]['emp_contact_perma_provience']);
			$contact[0]['emp_contact_perma_city_name']=$this->city_name($contact[0]['emp_contact_perma_city']);
			$contact[0]['emp_contact_other_country_name']=$this->country_name($contact[0]['emp_contact_other_country']);
			$contact[0]['emp_contact_other_provience_name']=$this->state_name($contact[0]['emp_contact_other_provience']);
			$contact[0]['emp_contact_other_city_name']=$this->city_name($contact[0]['emp_contact_other_city']);
			$this->load->library('employee_lib');
			$permit_types=$this->employee_lib->emp_immigration_permit();
			$immigration[0]['ei_permit_type']=$permit_types[$immigration[0]['ei_permit_type']]['name'];
			if($dependents!=FALSE)
			{
				foreach($dependents as $key=>$item)
				{
					$dependents[$key]['ed_date_of_birth']=format_date_custom($dependents[$key]['ed_date_of_birth']);
					
				}
			}
			
			
			$passport[0]['ep_permit_issuedate']=format_date_custom($passport[0]['ep_permit_issuedate']);
			$passport[0]['ep_permit_expirydate']=format_date_custom($passport[0]['ep_permit_expirydate']);
			$passport[0]['ep_issued_by']=$this->country_name($passport[0]['ep_issued_by']);
			//var_dump($immigration);
			/*$immigration[0]['ei_permit_type']=$this->permit_type($immigration[0]['ei_permit_type']);*/
			$immigration[0]['ei_permit_issuedate']=format_date_custom($immigration[0]['ei_permit_issuedate']);
			$immigration[0]['ei_permit_expirydate']=format_date_custom($immigration[0]['ei_permit_expirydate']);
			$immigration[0]['ei_review_date']=format_date_custom($immigration[0]['ei_review_date']);
			//var_dump($education);
			if($education!=FALSE)
			{
				foreach($education as $key=>$item)
				{
					$education[$key]['emp_edu_start_date']=format_date_custom($education[$key]['emp_edu_start_date']);
					$education[$key]['emp_edu_end_date']=format_date_custom($education[$key]['emp_edu_end_date']);
					
					
				}
			}
			if($experience!=FALSE)
			{
				foreach($experience as $key=>$item)
				{
					$experience[$key]['eexp_from_date']=format_date_custom($experience[$key]['eexp_from_date']);
					$experience[$key]['eexp_to_date']=format_date_custom($experience[$key]['eexp_to_date']);
					
					
				}
			}
			
			
			
			$data['emp_supervisors']=$this->employee_model->emp_supervisor($employee_id);
			$data['emp_subordinates']=$this->employee_model->emp_subordinates($employee_id);
			if($img!=FALSE)
			{
			$data['img']=sanitize_display1($img[0]);
			}
			else
			{
				$data['img']=FALSE;
			}
			$data['employee']=sanitize_display1($employee[0]);
			$data['salary']=sanitize_display1($salary[0]);
			$data['contact']=sanitize_display1($contact[0]);
			$data['emergency']=sanitize_display1($emergency);
			$data['dependents']=sanitize_display1($dependents);
			$data['job_details']=sanitize_display1($job_details[0]);
			$data['immigration']=sanitize_display1($immigration[0]);
			$data['passport']=sanitize_display1($passport[0]);
			$data['skills']=sanitize_display1($skills);
			$data['experience']=sanitize_display1($experience);
			$data['education']=sanitize_display1($education);
			$data['bank']=sanitize_display1($bank[0]);
			$data['page_title']="Employee Profile";
			$this->load->view('header',$data);
		    $this->load->view('side_menu_admin',$data);
		    $this->load->view('employee_profile',$data);
		    $this->load->view('footer');
				
		}
		else
		{
			redirect(site_path,'refresh');
		}
		
		
		
	}
	
	
	public function download_employee($employee_id)
	{
			if(!empty($employee_id) && is_numeric($employee_id))
			{
				$this->load->library('pdf');
				
			
			$data['employee_id']=$employee_id;
			$this->load->helper('custom_helper');
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
			$employee=$this->common_model->__fetch_contents('employee',array('employee_id'=>$employee_id),'*');
			$contact=$this->common_model->__fetch_contents('employee_contact_address',array('employee_id'=>$employee_id),'*');
			$emergency=$this->common_model->__fetch_contents('employee_emergency_contact',array('employee_id'=>$employee_id),'*');
			$dependents=$this->common_model->__fetch_contents('employee_dependents',array('employee_id'=>$employee_id),'*');
			$this->load->model('employee_profile_model');
			$job_details=$this->employee_profile_model->job_details($employee_id);
			
			$immigration=$this->common_model->__fetch_contents('employee_immigration',array('employee_id'=>$employee_id),'*');
			$passport=$this->common_model->__fetch_contents('employee_passport',array('ep_employee_id'=>$employee_id),'*');
			$experience=$this->common_model->__fetch_contents('emp_workexp',array('employee_id'=>$employee_id),'*');
			$education=$this->common_model->__fetch_contents('emp_education',array('employee_id'=>$employee_id),'*');
			$bank=$this->common_model->__fetch_contents('employee_bank',array('employee_id'=>$employee_id),'*');
			$img=$this->common_model->__fetch_contents('employee_media',array('employee_id'=>$employee_id),'*','','emp_attach_id DESC');
			$skills=$this->employee_model->get_employe_skills1($employee_id);
			$salary=$this->common_model->__fetch_contents('employee_salary',array('employee_id'=>$employee_id),'*');
			$salary[0]['emp_salary_pay_period']=$this->salary_period($salary[0]['emp_salary_pay_period']);
			$employee[0]['nationality']=$this->nationality($employee[0]['nation_code']);
			$employee[0]['licence']=licence_type($employee[0]['emp_licence_type']);
			$employee[0]['gender']=gender_name($employee[0]['emp_gender']);
			$employee[0]['marital']=marital_status($employee[0]['emp_marital_status']);
			$employee[0]['dob']=format_date_custom($employee[0]['emp_birthday']);
			$employee[0]['licence_exp']=format_date_custom($employee[0]['emp_dri_lice_exp_date']);
			$contact[0]['emp_contact_temp_country_name']=$this->country_name($contact[0]['emp_contact_temp_country']);
			$contact[0]['emp_contact_temp_provience_name']=$this->state_name($contact[0]['emp_contact_temp_provience']);
			$contact[0]['emp_contact_temp_city_name']=$this->city_name($contact[0]['emp_contact_temp_city']);
			$contact[0]['emp_contact_perma_country_name']=$this->country_name($contact[0]['emp_contact_perma_country']);
			$contact[0]['emp_contact_perma_provience_name']=$this->state_name($contact[0]['emp_contact_perma_provience']);
			$contact[0]['emp_contact_perma_city_name']=$this->city_name($contact[0]['emp_contact_perma_city']);
			$contact[0]['emp_contact_other_country_name']=$this->country_name($contact[0]['emp_contact_other_country']);
			$contact[0]['emp_contact_other_provience_name']=$this->state_name($contact[0]['emp_contact_other_provience']);
			$contact[0]['emp_contact_other_city_name']=$this->city_name($contact[0]['emp_contact_other_city']);
			$this->load->library('employee_lib');
			$permit_types=$this->employee_lib->emp_immigration_permit();
			$immigration[0]['ei_permit_type']=$permit_types[$immigration[0]['ei_permit_type']]['name'];
			
			if($dependents!=FALSE)
			{
				foreach($dependents as $key=>$item)
				{
					$dependents[$key]['ed_date_of_birth']=format_date_custom($dependents[$key]['ed_date_of_birth']);
					
				}
			}
			
			
			$passport[0]['ep_permit_issuedate']=format_date_custom($passport[0]['ep_permit_issuedate']);
			$passport[0]['ep_permit_expirydate']=format_date_custom($passport[0]['ep_permit_expirydate']);
			$passport[0]['ep_issued_by']=$this->country_name($passport[0]['ep_issued_by']);
			//var_dump($immigration);
			$immigration[0]['ei_permit_type']=$this->permit_type($immigration[0]['ei_permit_type']);
			$immigration[0]['ei_permit_issuedate']=format_date_custom($immigration[0]['ei_permit_issuedate']);
			$immigration[0]['ei_permit_expirydate']=format_date_custom($immigration[0]['ei_permit_expirydate']);
			$immigration[0]['ei_review_date']=format_date_custom($immigration[0]['ei_review_date']);
			//var_dump($education);
			if($education!=FALSE)
			{
				foreach($education as $key=>$item)
				{
					$education[$key]['emp_edu_start_date']=format_date_custom($education[$key]['emp_edu_start_date']);
					$education[$key]['emp_edu_end_date']=format_date_custom($education[$key]['emp_edu_end_date']);
					
					
				}
			}
			if($experience!=FALSE)
			{
				foreach($experience as $key=>$item)
				{
					$experience[$key]['eexp_from_date']=format_date_custom($experience[$key]['eexp_from_date']);
					$experience[$key]['eexp_to_date']=format_date_custom($experience[$key]['eexp_to_date']);
					
					
				}
			}
			
			
			
			$data['emp_supervisors']=$this->employee_model->emp_supervisor($employee_id);
			$data['emp_subordinates']=$this->employee_model->emp_subordinates($employee_id);
			if($img!=FALSE)
			{
			$data['img']=sanitize_display1($img[0]);
			}
			else
			{
				$data['img']=FALSE;
			}
			$data['employee']=sanitize_display1($employee[0]);
			$data['salary']=sanitize_display1($salary[0]);
			$data['contact']=sanitize_display1($contact[0]);
			$data['emergency']=sanitize_display1($emergency);
			$data['dependents']=sanitize_display1($dependents);
			$data['job_details']=sanitize_display1($job_details[0]);
			$data['immigration']=sanitize_display1($immigration[0]);
			$data['passport']=sanitize_display1($passport[0]);
			$data['skills']=sanitize_display1($skills);
			$data['experience']=sanitize_display1($experience);
			$data['education']=sanitize_display1($education);
			$data['bank']=sanitize_display1($bank[0]);
			$data['page_title']="Employee Profile";
			
		    /*$this->load->view('download_employee_profile',$data);*/
		    $this->load->view('sample_download_employee_profile',$data);
		    
		    
		    
				
		}
		else
		{
			redirect(site_path,'refresh');
		}
				
				
		
	}
	
	private function country_name($country_id)
	{
		$country=$this->common_model->__fetch_contents('countries',array(),'*');
		foreach($country as $item)
		{
			if($country_id== $item['country_id'])
			{
				return $item['country_name'];
			}
		}
		return '';
	}
	private function nationality($country_id)
	{
		$country=$this->common_model->__fetch_contents('countries',array(),'*');
		foreach($country as $item)
		{
			if($country_id== $item['country_id'])
			{
				return $item['country_nationality'];
			}
		}
		return '';
	}
	private function state_name($id)
	{
		$country=$this->common_model->__fetch_contents('state',array(),'*');
		foreach($country as $item)
		{
			if($id== $item['state_id'])
			{
				return $item['state_name'];
			}
		}
		return '';
		
	}
	private function city_name($id)
	{
		$country=$this->common_model->__fetch_contents('city',array(),'*');
		foreach($country as $item)
		{
			if($id== $item['city_id'])
			{
				return $item['city_name'];
			}
		}
		return '';
	}
	/**
	* 
	* 
	* @param int $id - Passing Parameter from call back function
	* 
	* @return
	*/
	private function permit_type($id)
	{
		//var_dump($this->employee_lib->emp_immigration_permit());
		foreach($this->employee_lib->emp_immigration_permit() as $key => $value){
			if($value['id']==$id)
			{
				return $value['name'];
			}
		}
		return '';
	}
	private function salary_period($period_id)
	{
		$periods=$this->common_model->__fetch_contents('pay_period',array('payperiod_code'=>$period_id),'payperiod_name');
		if(!empty($periods))
		{
			return $periods[0]['payperiod_name'];
		}
		return '';
	}
	
}