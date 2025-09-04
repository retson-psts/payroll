<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_employee_process extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation','employee_lib'));
	   $this->load->model(array('employee_model','job_model'));
    }
	public function employee_personal($id='0')
	{
	    //step 1
		//echo $id;
			
		$this->form_validation->set_rules('emp_number', 'Employee Number / ID', 'trim|required');
		$this->form_validation->set_rules('emp_firstname', 'First name', 'trim|required|alpha');
		$this->form_validation->set_rules('emp_lastname', 'Last Name', 'trim|required|alpha');
		$this->form_validation->set_rules('emp_middle_name', 'Middle Name', 'trim');
		$this->form_validation->set_rules('emp_dri_lice_exp', 'Employee Licence Expiry Date', 'xss_clean');
		$this->form_validation->set_rules('emp_other_id', 'Other ID', 'trim');
		$this->form_validation->set_rules('emp_gender', 'Gender', 'trim|required');
		$this->form_validation->set_rules('nation_code', 'Nationality', 'trim');
		$this->form_validation->set_rules('emp_birthday', 'Date of Birth', 'required');
		$this->form_validation->set_rules('emp_dri_lice_num', 'Driving Liscence', 'trim');
		$this->form_validation->set_rules('emp_dri_lice_exp_date', 'Liscence Expiry Date', 'xss_clean');
		$this->form_validation->set_rules('emp_marital_status', 'Marital Status', 'trim');
		
		
		
		if($this->form_validation->run()===false)
		{
			//
			$all_post_data=$this->input->post();
			//print_r($all_post_data);
			
			
			$new_form_data=array('form_data'=>$all_post_data,'step'=>'1','status'=>'0','message'=>validation_errors());
			$this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			
			//die();
			redirect(site_path.'add_employee/index/'.$id,'refresh');
		}
		else
		{
			//echo $id;
			//echo 'ds';
			//die();
 			$data=array('emp_number'=>$this->input->post('emp_number'), 'emp_lastname'=>$this->input->post('emp_lastname'), 'emp_firstname'=>$this->input->post('emp_firstname'), 
						'emp_middle_name'=>$this->input->post('emp_middle_name'),'emp_birthday'=>$this->input->post('emp_birthday'),'nation_code'=>$this->input->post('nation_code'),
						'emp_gender'=>$this->input->post('emp_gender'),'emp_marital_status'=>$this->input->post('emp_marital_status'),'emp_other_id'=>$this->input->post('emp_other_id'),
						'emp_dri_lice_num'=>$this->input->post('emp_dri_lice_num'),'emp_dri_lice_exp_date'=>$this->input->post('emp_dri_lice_exp_date'),'add_stat'=>'1','emp_licence_type'=>$this->input->post('emp_licence_type'));
			$add_employee=$this->employee_lib->add_employee('2',$data,$id);
			if($add_employee==true)
			{
				if($this->input->post('enable_login')=='1')
				{
					$this->form_validation->set_rules('username', 'Username', 'alpha_numeric|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('password', 'Password', 'alpha_numeric|required');
					  $username=$this->input->post('username');
					  $password=$this->input->post('password');
					  if($this->form_validation->run()===false)
					  {
						  $all_post_data=$this->input->post(NULL,TRUE);
						  $new_form_data=array('form_data'=>$all_post_data,'step'=>'1','status'=>'0','message'=>validation_errors());
			$this->session->set_userdata('form',array('add_employee'=>$new_form_data));
						redirect(site_path.'add_employee','refresh');
					  }
					  else
					  {
						  $login_data=array('username'=>$username,'password'=>md5($password),'first_name'=>$this->input->post('emp_firstname'),'last_name'=>$this->input->post('emp_lastname'),'status'=>'1','gender'=>$this->input->post('emp_gender'),'group_id'=>'2','verified'=>'1','employee_id'=>$id);
						  if($this->employee_model->is_employee_login_exist($id)==true)
						  {
							$update_login=$this->employee_model->update_emp_details('users',$login_data,array('employee_id'=>$id));
						  }
						  else
						  {
							  $cretae_login=$this->employee_model->create_employee_login($login_data);
						  }
					  }
					   //print_r($login_data); die();
				}
				 $this->session->unset_userdata('form');
				 $new_form_data=array('form_data'=>'','step'=>'2','status'=>'1');
				 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				redirect(site_path.'add_employee/employee_contact/'.$id,'refresh');
			}
			else
			{
				$old_data=$this->session->userdata['form']['add_employee']['form_data'];
				$new_form_data=array('form_data'=>$old_data,'step'=>'1','status'=>'0','message'=>'Please Try Again!');
				$this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			}
		}

	}
	public function emergency_contact_edit($id='0')
	{
		$check_valid=true;
		if($check_valid==true)
		{
			if($this->form_validation->run('add_employee_step3')==true)
			{
				$eec_id=$this->input->post('eec_id');
				
				 $data=array('employee_id'=>$id,
				 			 'eec_name'=>$this->input->post('eec_name'),
							 'eec_relationship'=>$this->input->post('eec_relationship'),
							 'eec_home_no'=>$this->input->post('eec_home_no'),
							 'eec_mobile_no'=>$this->input->post('eec_mobile_no'),
							 'eec_office_no'=>$this->input->post('eec_office_no'),
							 'eec_id'=>$this->input->post('eec_id'));
				 
				/*$data=array('emp_hm_telephone'=>$this->input->post('emp_hm_telephone'),'emp_mobile'=>$this->input->post('emp_mobile'),'emp_work_telephone'=>$this->input->post('emp_work_telephone'),
							'emp_oth_email'=>$this->input->post('emp_oth_email'),'emp_contact_temp_street1'=>$this->input->post('emp_contact_temp_street1'),
							'emp_contact_temp_street2'=>$this->input->post('emp_contact_temp_street2'), 'emp_contact_temp_city'=>$this->input->post('emp_contact_temp_city'),
							'emp_contact_temp_country'=>$this->input->post('emp_contact_temp_country'),'emp_contact_temp_provience'=>$this->input->post('emp_contact_temp_provience'),
							'emp_contact_temp_pincode'=>$this->input->post('emp_contact_temp_pincode'), 'emp_contact_perma_street1'=>$this->input->post('emp_contact_perma_street1'),
							'emp_contact_perma_street2'=>$this->input->post('emp_contact_perma_street2'), 'emp_contact_perma_city'=>$this->input->post('emp_contact_perma_city'),
							'emp_contact_perma_country'=>$this->input->post('emp_contact_perma_country'), 'emp_contact_perma_provience'=>$this->input->post('emp_contact_perma_provience'),
							'emp_contact_perma_pincode'=>$this->input->post('emp_contact_perma_pincode'),'emp_contact_other_city'=>$this->input->post('emp_contact_other_city'),
							'emp_contact_other_country'=>$this->input->post('emp_contact_other_country'),'emp_contact_other_provience'=>$this->input->post('emp_contact_other_provience'),
							'emp_contact_other_pincode'=>$this->input->post('emp_contact_other_pincode'));*/
							
							
							
							
				 $add_employee=$this->employee_model->update_emp_details('employee_emergency_contact',$data,array('eec_id'=>$eec_id,'employee_id'=>$id));
				 if($add_employee==true)
				 {
					 $this->session->unset_userdata('form');
					 $new_form_data=array('step'=>'2','status'=>'1');
					 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					 redirect(site_path.'add_employee/employee_emergency/'.$id,'refresh');
				 }
				 else
				 {
					  $old_data=$this->session->userdata['form']['add_employee']['form_data'];
					  $new_form_data=array('form_data'=>$old_data,'step'=>'2','status'=>'0','message'=>'Please Try Again!','edit'=>'1');
					  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					  redirect($_SERVER['HTTP_REFERER'],'refresh');
				 }
			}
			else
			 {
				  $all_post_data=$this->input->post(NULL,TRUE);
				  $new_form_data=array('form_data'=>$all_post_data,'step'=>'3','status'=>'0','message'=>validation_errors(),'edit'=>'1');
				  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				  redirect($_SERVER['HTTP_REFERER'],'refresh');
			 }
		}
	}
	public function emp_dependent_edit($id='0')
	{
		$check_valid=true;
		if($check_valid==true)
		{
			if($this->form_validation->run('add_employee_step4')==true)
			{
				$ed_id=$this->input->post('ed_id');
				$data=array('employee_id'=>$id,'ed_name'=>$this->input->post('ed_name'),'ed_relationship_type'=>$this->input->post('ed_relationship_type'),'ed_relationship'=>$this->input->post('specify'),'ed_date_of_birth'=>$this->input->post('ed_date_of_birth'));
				 $add_employee=$this->employee_model->update_emp_details('employee_dependents',$data,array('ed_id'=>$ed_id,'employee_id'=>$id));
				 //die();
				 if($add_employee==true)
				 {
					 $this->session->unset_userdata('form');
					 $new_form_data=array('step'=>'2','status'=>'1');
					 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					 redirect(site_path.'add_employee/employee_dependents/'.$id,'refresh');
				 }
				 else
				 {
					  $old_data=$this->session->userdata['form']['add_employee']['form_data'];
					  $new_form_data=array('form_data'=>$old_data,'step'=>'2','status'=>'0','message'=>'Please Try Again!','edit'=>'1');
					  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					  redirect($_SERVER['HTTP_REFERER'],'refresh');
				 }
			}
			else
			 {
				  $all_post_data=$this->input->post(NULL,TRUE);
				  $new_form_data=array('form_data'=>$all_post_data,'step'=>'3','status'=>'0','message'=>validation_errors(),'edit'=>'1');
				  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				  redirect($_SERVER['HTTP_REFERER'],'refresh');
			 }
		}
	}
	public function emp_immigration_edit($id)
	{
  		$check_valid=true;
		if($check_valid==true)
		{
			if($this->form_validation->run('add_employee_step5')==true)
			{
				$ei_id=$this->input->post('ei_id');
				$dob=$this->input->post('ed_date_of_birth');
				$dob1=$dob['year'].'-'.$dob['month'].'-'.$dob['date'];
				
				if($_POST['ei_permit_type']==3)
				 {
					 $ei_permit_number='';
					 $ei_specify_permit_type='';
				 }
				 elseif($_POST['ei_permit_type']==8)
				 {
					 $ei_specify_permit_type=$this->input->post('ei_specify_permit_type');
					 $ei_permit_number=$this->input->post('ei_permit_number');
				 }
				 else
				 {
					  $ei_permit_number=$this->input->post('ei_permit_number');
					  $ei_specify_permit_type='';
				 }
				 
				 
				 
				$data=array('ei_permit_type'=>$this->input->post('ei_permit_type'),
				'ei_specify_permit_type'=>$ei_specify_permit_type,
				'ei_permit_number'=>$ei_permit_number,
				 'ei_permit_expirydate'=>$this->input->post('ei_permit_expirydate'),
				  'ei_permit_issuedate'=>$this->input->post('ei_permit_issuedate'),'ei_comments'=>$this->input->post('ei_comments'),'ei_issued_by'=>$this->input->post('ei_issued_by'),'ei_eligible_status'=>$this->input->post('ei_eligible_status'),'ei_review_date'=>$this->input->post('ei_review_date'),'employee_id'=>$id);
				 $add_employee=$this->employee_model->update_emp_details('employee_immigration',$data,array('ei_id'=>$ei_id,'employee_id'=>$id));
				 
  				 if($add_employee==true)
				 {
					 $this->session->unset_userdata('form');
					 $new_form_data=array('step'=>'2','status'=>'1');
					 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					 redirect(site_path.'add_employee/employee_immigration/'.$id,'refresh');
				 }
				 else
				 {
					  $old_data=$this->session->userdata['form']['add_employee']['form_data'];
					  $new_form_data=array('form_data'=>$old_data,'step'=>'2','status'=>'0','message'=>'Please Try Again!','edit'=>'1');
					  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					  redirect($_SERVER['HTTP_REFERER'],'refresh');
				 }
			}
			else
			 {
				  $all_post_data=$this->input->post(NULL,TRUE);
				  $new_form_data=array('form_data'=>$all_post_data,'step'=>'3','status'=>'0','message'=>validation_errors(),'edit'=>'1');
				  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				  redirect($_SERVER['HTTP_REFERER'],'refresh');
			 }
		}
	}
	
	
	
	
	public function edit_employee_passport_details($id)
	{
		$check_valid=true;
		if($check_valid==true)
		{
			if($this->form_validation->run('add_employee_step5_1')==true)
			{
				$ei_id=$this->input->post('ep_id');
				$dob=$this->input->post('ed_date_of_birth');
				$dob1=$dob['year'].'-'.$dob['month'].'-'.$dob['date'];
				$data=array('ei_permit_type'=>$this->input->post('ei_permit_type'),
							'ei_permit_number'=>$this->input->post('ei_permit_number'),
							'ei_permit_expirydate'=>$this->input->post('ei_permit_expirydate'),
							'ei_permit_issuedate'=>$this->input->post('ei_permit_issuedate'),
							'ei_comments'=>$this->input->post('ei_comments'),
							'ei_issued_by'=>$this->input->post('ei_issued_by'),
							'ei_eligible_status'=>$this->input->post('ei_eligible_status'),
							'ei_review_date'=>$this->input->post('ei_review_date'),
							'employee_id'=>$id);
  				 $add_employee=$this->employee_model->update_emp_details('employee_immigration',$data,array('ei_id'=>$ei_id,'employee_id'=>$id));
				 if($add_employee==true)
				 {
					 $this->session->unset_userdata('form');
					 $new_form_data=array('step'=>'5','status'=>'1');
					 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					 redirect(site_path.'add_employee/employee_immigration/'.$id,'refresh');
				 }
				 else
				 {
					  $old_data=$this->session->userdata['form']['add_employee']['form_data'];
					  $new_form_data=array('form_data'=>$old_data,'step'=>'2','status'=>'0','message'=>'Please Try Again!','edit'=>'1');
					  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					  redirect($_SERVER['HTTP_REFERER'],'refresh');
				 }
			}
			else
			 {
				  $all_post_data=$this->input->post(NULL,TRUE);
				  $new_form_data=array('form_data'=>$all_post_data,'step'=>'3','status'=>'0','message'=>validation_errors(),'edit'=>'1');
				  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				  redirect($_SERVER['HTTP_REFERER'],'refresh');
			 }
		}
	}
	
	
	
	
/*	
	
	public function emp_immigration_edit($id)
	{
		$check_valid=true;
		if($check_valid==true)
		{
			if($this->form_validation->run('add_employee_step5')==true)
			{
				$ei_id=$this->input->post('ei_id');
				$dob=$this->input->post('ed_date_of_birth');
				$dob1=$dob['year'].'-'.$dob['month'].'-'.$dob['date'];
				$data=array('ei_permit_type'=>$this->input->post('ei_permit_type'),'ei_permit_number'=>$this->input->post('ei_permit_number'), 'ei_permit_expirydate'=>$this->input->post('ei_permit_expirydate'), 'ei_permit_issuedate'=>$this->input->post('ei_permit_issuedate'),'ei_comments'=>$this->input->post('ei_comments'),'ei_issued_by'=>$this->input->post('ei_issued_by'),'ei_eligible_status'=>$this->input->post('ei_eligible_status'),'ei_review_date'=>$this->input->post('ei_review_date'),'employee_id'=>$id);
				 $add_employee=$this->employee_model->update_emp_details('employee_immigration',$data,array('ei_id'=>$ei_id,'employee_id'=>$id));
				 if($add_employee==true)
				 {
					 $this->session->unset_userdata('form');
					 $new_form_data=array('step'=>'2','status'=>'1');
					 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					 redirect(site_path.'add_employee/employee_immigration/'.$id,'refresh');
				 }
				 else
				 {
					  $old_data=$this->session->userdata['form']['add_employee']['form_data'];
					  $new_form_data=array('form_data'=>$old_data,'step'=>'2','status'=>'0','message'=>'Please Try Again!','edit'=>'1');
					  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					  redirect($_SERVER['HTTP_REFERER'],'refresh');
				 }
			}
			else
			 {
				  $all_post_data=$this->input->post(NULL,TRUE);
				  $new_form_data=array('form_data'=>$all_post_data,'step'=>'3','status'=>'0','message'=>validation_errors(),'edit'=>'1');
				  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				  redirect($_SERVER['HTTP_REFERER'],'refresh');
			 }
		}
	}
	
	
	
	
*/	
	
	public function employee_skills($id='0')
	{
		if($this->form_validation->run('add_employee_step10')!==false)
		{
		   $data=array('employee_id'=>$id,'esk_id'=>$this->input->post('esk_id'),'esk_skill_id'=>$this->input->post('esk_skill_id'),'esk_skill_comment'=>$this->input->post('esk_skill_comment'));
		   $add_employee=$this->employee_model->update_emp_details('emp_skills',$data,array('esk_id'=>$this->input->post('esk_id'),'employee_id'=>$id));
		   if($add_employee==true)
		   {
			   $this->session->unset_userdata('form');
			   redirect(site_path.'add_employee/employee_skills/'.$id,'refresh');
		   }
		   else
		   {
				$old_data=$this->session->userdata['form']['add_employee']['form_data'];
				$new_form_data=array('form_data'=>$old_data,'step'=>'2','status'=>'0','message'=>'Please Try Again!','edit'=>'1');
				$this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
		   }
		}
		else
		{
		   $all_post_data=array_merge_recursive($this->input->post(NULL,TRUE),array('esk_id'=>''));
		   $new_form_data=array('form_data'=>$all_post_data,'step'=>'3','status'=>'0','message'=>validation_errors());
		   $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
		   redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}
	public function ed_relation($id)
	{
		$relation=$this->input->post('ed_relationship_type');
		if($relation=='others')
		{
			$specify=$this->input->post('specify');
			if($specify=='')
			{
				$this->form_validation->set_message('ed_relation', 'Please Enter Relation Name');
				return false;
			}
			return true;
		}
		return true;
	}
	public function ei_immigration()
	{
		$permit_type=$this->input->post('ei_permit_type');
		if(($permit_type4='3')&&($permit_type!='4'))
		{
			$number=$this->input->post('ei_permit_number');			
			if($number=='')
			{
				$this->form_validation->set_message('ei_immigration', 'Please Enter Permit Number');
				return false;
			}
			return true;
		}
		return true;
	}
}
