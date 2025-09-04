<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_employee_process extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation','employee_lib'));
	   $this->load->model(array('employee_model','job_model'));
    }
	public function employee_personal()
	{
		$step1='add_employee_step1';
		$valid_login=array(false,false);
		$login_errors='';
		if($this->input->post('enable_login')=='1')
		{
			$valid_login[0]=true;
			$username=$this->input->post('username');
			$password=$this->input->post('password');
			if($password==''){ $login_errors.='<p> Please Enter Password</p>';$valid_login[1]=FALSE;}else{$valid_login[1]=TRUE;}
			if($username==''){ $login_errors.='<p> Please Enter Username</p>';$valid_login[1][1]=FALSE;}else{$valid_login[1]=TRUE;}
			if($valid_login==TRUE)
			{
				$check_username=$this->user->username_check($username);
				if($check_username==FALSE)
				{
					$login_errors.="<p>Username Already Taken</p>";
					$valid_login[1]=FALSE;
				}
			}
		}
		if($this->input->post('employee_id')==0)
		{
			$step1='add_employee_step1';	
		}
		if($this->form_validation->run('add_employee_step1')===false)
		{
		 	$all_post_data=$this->input->post();
			$new_form_data=array('form_data'=>$all_post_data,'step'=>'1','status'=>'0','message'=>validation_errors().$login_errors);
			$this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			redirect(site_path.'add_employee','refresh');
		}
		else
		{
			if(($valid_login[0]==FALSE)||($valid_login[1]==TRUE))
			{
				$data=array('emp_number'=>$this->input->post('emp_number'), 'emp_lastname'=>$this->input->post('emp_lastname'), 'emp_firstname'=>$this->input->post('emp_firstname'), 
						'emp_middle_name'=>$this->input->post('emp_middle_name'),'emp_birthday'=>$this->input->post('emp_birthday'),'nation_code'=>$this->input->post('nation_code'),
						'emp_gender'=>$this->input->post('emp_gender'),'emp_marital_status'=>$this->input->post('emp_marital_status'),'emp_other_id'=>$this->input->post('emp_other_id'),
						'emp_dri_lice_num'=>$this->input->post('emp_dri_lice_num'),'emp_dri_lice_exp_date'=>$this->input->post('emp_dri_lice_exp_date'),'add_stat'=>'1','emp_licence_type'=>'');
				$add_employee=$this->employee_lib->add_employee('1',$data);
				if($add_employee==true)
				{
					if($valid_login[0]==TRUE)
					{
						$login_data=array('username'=>$username,'password'=>md5($password),'first_name'=>$this->input->post('emp_firstname'),'last_name'=>$this->input->post('emp_lastname'),'status'=>'1','gender'=>$this->input->post('emp_gender'),'group_id'=>'2','verified'=>'1','employee_id'=>$add_employee);
						$cretae_login=$this->employee_model->create_employee_login($login_data);
					}
					 $this->session->unset_userdata('form');
					 $new_form_data=array('form_data'=>'','step'=>'2','status'=>'1');
					 redirect(site_path.'add_employee/employee_contact/'.$add_employee,'refresh');
				}
				else
				{
					$old_data=$this->session->userdata['form']['add_employee']['form_data'];
					$new_form_data=array('form_data'=>$old_data,'step'=>'1','status'=>'0','message'=>'Please Try Again!');
					$this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					redirect($_SERVER['HTTP_REFERER'],'refresh');
				}
			}
			else
			{
				$all_post_data=$this->input->post();
				$new_form_data=array('form_data'=>$all_post_data,'step'=>'1','status'=>'0','message'=>validation_errors().$login_errors);
				$this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				redirect(site_path.'add_employee','refresh');
			}
		}
	}
	public function employee_contact($id='0')
	{
		
		if($this->form_validation->run('add_employee_step2')!==false)
		{
 		  $job_details=$this->employee_model->check_adding_emp($id,'employee_contact_address');
						
			if(isset($_POST['emp_contact_curr_perma_address']))			
			{
				$emp_contact_perma_street1=$this->input->post('emp_contact_temp_street1');
				$emp_contact_perma_street2=$this->input->post('emp_contact_temp_street2');
				$emp_contact_perma_city=$this->input->post('emp_contact_temp_city');
				$emp_contact_perma_country=$this->input->post('emp_contact_temp_country');
				$emp_contact_perma_provience=$this->input->post('emp_contact_temp_provience');
				$emp_contact_perma_pincode=$this->input->post('emp_contact_temp_pincode');
			}
			else
			{
				$emp_contact_perma_street1=$this->input->post('emp_contact_perma_street1');
				$emp_contact_perma_street2=$this->input->post('emp_contact_perma_street2');
				$emp_contact_perma_city=$this->input->post('emp_contact_perma_city');
				$emp_contact_perma_country=$this->input->post('emp_contact_perma_country');
				$emp_contact_perma_provience=$this->input->post('emp_contact_perma_provience');
				$emp_contact_perma_pincode=$this->input->post('emp_contact_perma_pincode');
			}
						
		  $data=array('emp_hm_telephone'=>$this->input->post('emp_hm_telephone'),
						'emp_mobile'=>$this->input->post('emp_mobile'),
						'emp_work_telephone'=>$this->input->post('emp_work_telephone'),
						'emp_oth_email'=>$this->input->post('emp_oth_email'),
						'emp_work_email'=>$this->input->post('emp_work_email'),
 						'emp_contact_temp_street1'=>$this->input->post('emp_contact_temp_street1'),
						'emp_contact_temp_street2'=>$this->input->post('emp_contact_temp_street2'),
						'emp_contact_temp_city'=>$this->input->post('emp_contact_temp_city'),
						'emp_contact_temp_country'=>$this->input->post('emp_contact_temp_country'),
						'emp_contact_temp_provience'=>$this->input->post('emp_contact_temp_provience'),
						'emp_contact_temp_pincode'=>$this->input->post('emp_contact_temp_pincode'),
						
						
						'emp_contact_perma_street1'=>$emp_contact_perma_street1,
						'emp_contact_perma_street2'=>$emp_contact_perma_street2,
						'emp_contact_perma_city'=>$emp_contact_perma_city,
						'emp_contact_perma_country'=>$emp_contact_perma_country,
						'emp_contact_perma_provience'=>$emp_contact_perma_provience,
						'emp_contact_perma_pincode'=>$emp_contact_perma_pincode,
						
						
						'emp_contact_other_street1'=>$this->input->post('emp_contact_other_street1'),
						'emp_contact_other_street2'=>$this->input->post('emp_contact_other_street2'),
						'emp_contact_other_city'=>$this->input->post('emp_contact_other_city'),
						'emp_contact_other_country'=>$this->input->post('emp_contact_other_country'),
						'emp_contact_other_provience'=>$this->input->post('emp_contact_other_provience'),
						'emp_contact_other_pincode'=>$this->input->post('emp_contact_other_pincode'),
						'emp_contact_curr_perma_address'=>$this->input->post('emp_contact_curr_perma_address'),
						'employee_id'=>$id);
						
  		  if($job_details==false)
		  {
 			  // insert new row
			/*  $insert_job_details=$this->employee_model->update_emp_details('employee_contact_address',$data,array('employee_id'=>$id));*/
			   $insert_job_details=$this->employee_model->add_employee_details('employee_contact_address',$data); 
			  if($insert_job_details==false)
			  {
				$stop=true;
			  }
			  else
			  {
				$stop=false;
			  }
		  }
		  else
		  {
			  // update job row
			  $update_job_details=$this->employee_model->update_emp_details('employee_contact_address',$data,array('employee_id'=>$id));
			/*  $update_job_details=$this->employee_model->update_emp_details('employee_contact_address',$data1,array('employee_id'=>$id));*/
			  if($update_job_details==false)
			  {
				$stop=true;
			  }
			  else
			  {
				$stop=false;
			  }
		  }
		  if($stop==false)
		  {
			  $data=array('add_stat'=>'7');
			  $add_employee=$this->employee_lib->add_employee('2',$data,$id);
			  $this->session->unset_userdata('form');
			  $new_form_data=array('step'=>'8','status'=>'1');
			  $this->session->set_userdata('form',array('add_contact'=>$new_form_data));
			  redirect(site_path.'add_employee/employee_emergency/'.$id,'refresh');
		  }
		  else
		  {
			  $all_post_data=$this->input->post(NULL,TRUE);
			  $new_form_data=array('form_data'=>$all_post_data,'step'=>'7','status'=>'0','message'=>'Please Try Again..');
			  $this->session->set_userdata('form',array('add_contact'=>$new_form_data));
			  redirect($_SERVER['HTTP_REFERER'],'refresh'); 
		  }
		}
		else
		{
			$all_post_data=$this->input->post();
			$new_form_data=array('form_data'=>$all_post_data,'step'=>'7','status'=>'0','message'=>validation_errors());
			$this->session->set_userdata('form',array('add_contact'=>$new_form_data));
			
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}
	public function emergency_contact($id='0')
	{
		//step 3
		 if(isset($_POST['next']))
		 {
			 $data=array('add_stat'=>'3');
			 /*$add_employee=$this->employee_lib->add_employee('3',$data,$id);*/
			 redirect(site_path.'add_employee/employee_dependents/'.$id,'refresh');
		 }
		 elseif(isset($_POST['save']))
		 {
			 if($this->form_validation->run('add_employee_step3')!==false)
			 {
				 $data=array('employee_id'=>$id, 'eec_name'=>$this->input->post('eec_name'), 'eec_relationship'=>$this->input->post('eec_relationship'), 'eec_home_no'=>$this->input->post('eec_home_no'), 'eec_mobile_no'=>$this->input->post('eec_mobile_no'), 'eec_office_no'=>$this->input->post('eec_office_no'),'eec_id'=>$this->input->post('eec_id'));
				 $add_employee=$this->employee_model->add_employee_details('employee_emergency_contact',$data);
				 if($add_employee==true)
				 {
					 $data=array('add_stat'=>'3');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $this->session->unset_userdata('form');
					 $new_form_data=array('step'=>'4','status'=>'1');
					 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					 redirect(site_path.'add_employee/employee_emergency/'.$id,'refresh');
				 }
				 else
				 {
					  $old_data=$this->session->userdata['form']['add_employee']['form_data'];
					  $new_form_data=array('form_data'=>$old_data,'step'=>'2','status'=>'0','message'=>'Please Try Again!');
					  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					  redirect($_SERVER['HTTP_REFERER'],'refresh');
				 }
			 }
			 else
			 {
				  $all_post_data=array_merge_recursive($this->input->post(NULL,TRUE),array('eec_id'=>''));
				  $new_form_data=array('form_data'=>$all_post_data,'step'=>'3','status'=>'0','message'=>validation_errors());
				  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				  redirect($_SERVER['HTTP_REFERER'],'refresh');
			 }
		 }
	}
	public function employee_dependents($id='0')
	{
		 if(isset($_POST['next']))
		 {
			 $data=array('add_stat'=>'4');
			 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
			 redirect(site_path.'add_employee/employee_immigration/'.$id,'refresh');
		 }
		 elseif(isset($_POST['save']))
		 {
			 if($this->form_validation->run('add_employee_step4')!==false)
			 {
			 	$other='';
				 if($_POST['ed_relationship_type']=='child')
				 {
					 $other='';
				 }
				 elseif($_POST['ed_relationship_type']=='others')
				 {
					 $other=$this->input->post('specify');
				 }
				 
				 $data=array('employee_id'=>$id,
				 'ed_name'=>$this->input->post('ed_name'),
				 'ed_relationship_type'=>$this->input->post('ed_relationship_type'),
				 'ed_relationship'=>$other,
				 'ed_date_of_birth'=>$this->input->post('ed_date_of_birth'));
				 
				 
				 $add_employee=$this->employee_model->add_employee_details('employee_dependents',$data);
				 if($add_employee==true)
				 {
					 $data=array('add_stat'=>'4');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $this->session->unset_userdata('form');
					 $new_form_data=array('step'=>'5','status'=>'1');
					 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					 redirect(site_path.'add_employee/employee_dependents/'.$id,'refresh');
				 }
				 else
				 {
					  $old_data=$this->session->userdata['form']['add_employee']['form_data'];
					  $new_form_data=array('form_data'=>$old_data,'step'=>'2','status'=>'0','message'=>'Please Try Again!');
					  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					  redirect($_SERVER['HTTP_REFERER'],'refresh');
				 }
			 }
			 else
			 {
				 $all_post_data=array_merge_recursive($this->input->post(NULL,TRUE),array('ed_id'=>''));
				 $new_form_data=array('form_data'=>$all_post_data,'step'=>'3','status'=>'0','message'=>validation_errors());
				 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				 redirect($_SERVER['HTTP_REFERER'],'refresh');
			 }
		 }
	}
	public function employee_immigration($id='0')
	{
		if(isset($_POST['next']))
		 {
			 $data=array('add_stat'=>'5');
			 /*$add_employee=$this->employee_lib->add_employee('2',$data,$id);*/
			 redirect(site_path.'add_employee/employee_job_details/'.$id,'refresh');
		 }
		 elseif(isset($_POST['save']))
		 {
			 if($this->form_validation->run('add_employee_step5')!==false)
			 {
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
				   'ei_permit_issuedate'=>$this->input->post('ei_permit_issuedate'),
				   'ei_comments'=>$this->input->post('ei_comments'),
				   'ei_issued_by'=>$this->input->post('ei_issued_by'),
				   'ei_eligible_status'=>$this->input->post('ei_eligible_status'),
				   'ei_review_date'=>$this->input->post('ei_review_date'),
				   
				   'employee_id'=>$id);
				   
 				 $add_employee=$this->employee_model->add_employee_details('employee_immigration',$data);
				 if($add_employee==true)
				 {
					 $data=array('add_stat'=>'5');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $this->session->unset_userdata('form');
					 $new_form_data=array('step'=>'6','status'=>'1');
					 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					 redirect(site_path.'add_employee/employee_immigration/'.$id,'refresh');
				 }
				 else
				 {
					  $old_data=$this->session->userdata['form']['add_employee']['form_data'];
					  $new_form_data=array('form_data'=>$old_data,'step'=>'2','status'=>'0','message'=>'Please Try Again!');
					  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					  redirect($_SERVER['HTTP_REFERER'],'refresh');
				 }
			 }
			 else
			 {
				 $all_post_data=array_merge_recursive($this->input->post(NULL,TRUE),array('ei_id'=>''));
				 $new_form_data=array('form_data'=>$all_post_data,'step'=>'3','status'=>'0','message'=>validation_errors());
				 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				 redirect($_SERVER['HTTP_REFERER'],'refresh');
			 }
		 }
	}
	/**
	*yuvaraj added
	
	*/
	public function employee_passport_details($id='0')
	{
		 
		if(isset($_POST['next']))
		 {
			 $data=array('add_stat'=>'6');
			 /*$add_employee=$this->employee_lib->add_employee('2',$data,$id);*/
			 redirect(site_path.'add_employee/employee_job_details/'.$id,'refresh');
		 }
		if($this->form_validation->run('add_employee_step5_1')!==false)
		{
			 
		  $job_details=$this->employee_model->employee_passport_details($id);
		  //print_r($job_details);
		  
		 $data=array('ep_passport_number'=>$this->input->post('ep_passport_number'),
				 				'ep_permit_number'=>$this->input->post('ep_permit_number'),
							  'ep_permit_expirydate'=>$this->input->post('ep_permit_expirydate'),
							   'ep_permit_issuedate'=>$this->input->post('ep_permit_issuedate'),
							   'ep_comments'=>$this->input->post('ep_comments'),
							   'ep_issued_by'=>$this->input->post('ep_issued_by'),
							   'ep_eligible_status'=>$this->input->post('ep_eligible_status'),
							   'ep_review_date'=>$this->input->post('ep_review_date'),
							   'ep_passport_number'=>$this->input->post('ep_passport_number'),
							   'ep_provience'=>$this->input->post('ep_provience'),							   'ep_employee_id'=>$id);
							   
							   
		  if($job_details==false)
		  {
			  // insert new row
			  $insert_job_details=$this->employee_model->add_employee_details('employee_passport',$data);
			  if($insert_job_details==false)
			  {
				$stop=true;
				$x=1;
			  }
			  else
			  {
				$stop=false;
				$x=2;
			  }
		  }
		  else
		  {
			  // update job row
			  $update_job_details=$this->employee_model->update_emp_details('employee_passport',$data,array('ep_id'=>$job_details['0']->ep_id,'ep_employee_id'=>$id));
			 // die();
			  if($update_job_details==false)
			  {
				$stop=true;
				$x=3;
			  }
			  else
			  {
				$stop=false;
				$x=4;
			  }
		  }
		  
		  /*echo $x;*/
		  //die();
		  if($stop==false)
		  {
			  $data=array('add_stat'=>'5');
			  $add_employee=$this->employee_lib->add_employee('2',$data,$id);
			  $this->session->unset_userdata('form');
			  $new_form_data=array('step'=>'5`','status'=>'1');
			  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			  redirect(site_path.'add_employee/employee_immigration/'.$id,'refresh');
		  }
		  else
		  {
			  $all_post_data=$this->input->post(NULL,TRUE);
			  $new_form_data=array('form_data'=>$all_post_data,'step'=>'5','status'=>'0','message'=>validation_errors());
			  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			  redirect($_SERVER['HTTP_REFERER'],'refresh'); 
		  }
		}
		else
		{
			 $all_post_data=$this->input->post(NULL,TRUE);
			 $new_form_data=array('form_data'=>$all_post_data,'step'=>'5','status'=>'0','message'=>validation_errors());
			 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			 redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
 	}
	public function employee_job_details($id='0')
	{
		if(isset($_POST['next']))
		 {
			 $data=array('add_stat'=>'6');
			/* $add_employee=$this->employee_lib->add_employee('2',$data,$id);*/
			 redirect(site_path.'add_employee/employee_salary/'.$id,'refresh');
		 }
		if($this->form_validation->run('add_employee_step6')!==false)
		{
		  $job_details=$this->employee_model->employee_job_details($id);
		  $data=array('emp_joined_date'=>$this->input->post('emp_joined_date'),'emp_job_title'=>$this->input->post('emp_job_title'),'emp_job_status'=>$this->input->post('emp_job_status'),'emp_sub_unit'=>$this->input->post('emp_sub_unit'),'emp_job_location'=>$this->input->post('emp_job_location'),'emp_job_start_date'=>$this->input->post('emp_job_start_date'),'emp_job_end_date'=>$this->input->post('emp_job_end_date'),'employee_id'=>$this->input->post('employee_id'));
		  if($job_details==false)
		  {
			  // insert new row
			  $insert_job_details=$this->employee_model->add_employee_details('employee_job_details',$data);
			  if($insert_job_details==false)
			  {
				$stop=true;
			  }
			  else
			  {
				$stop=false;
			  }
		  }
		  else
		  {
			  // update job row
			  $update_job_details=$this->employee_model->update_emp_details('employee_job_details',$data,array('emp_job_id'=>$job_details['0']->emp_job_id,'employee_id'=>$id));
			  if($update_job_details==false)
			  {
				$stop=true;
			  }
			  else
			  {
				$stop=false;
			  }
		  }
		  if($stop==false)
		  {
			  $data=array('add_stat'=>'6');
			  $add_employee=$this->employee_lib->add_employee('2',$data,$id);
			  $this->session->unset_userdata('form');
			  $new_form_data=array('step'=>'7','status'=>'1');
			  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			  redirect(site_path.'add_employee/employee_job_details/'.$id,'refresh');
		  }
		  else
		  {
			  $all_post_data=$this->input->post(NULL,TRUE);
			  $new_form_data=array('form_data'=>$all_post_data,'step'=>'6','status'=>'0','message'=>validation_errors());
			  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			  redirect($_SERVER['HTTP_REFERER'],'refresh'); 
		  }
		}
		else
		{
			 $all_post_data=$this->input->post(NULL,TRUE);
			 $new_form_data=array('form_data'=>$all_post_data,'step'=>'6','status'=>'0','message'=>validation_errors());
			 $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			 redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}
	public function employee_salary($id='0')
	{
		if(isset($_POST['next']))
		 {
			 $data=array('add_stat'=>'7');
			 /*$add_employee=$this->employee_lib->add_employee('2',$data,$id);*/
			 redirect(site_path.'add_employee/employee_report/'.$id,'refresh');
		 }
		 elseif(isset($_POST['save']))
		 {
			  if($this->form_validation->run('add_employee_step7_1')!==false)
			  {
				$job_details=$this->employee_model->employee_salary($id);
 				
				$emp_salary_cpf=$emp_salary_cdac=$emp_salary_mbmf=$emp_salary_sinda=$emp_salary_ecf=$emp_salary_share=$emp_salary_sdl=$emp_allowance=0;
			
				if(isset($_POST['emp_salary_cpf']))
				{
					$emp_salary_cpf=1;
				}
				if(isset($_POST['emp_salary_cdac']))
				{
					$emp_salary_cdac=1;
				}
				if(isset($_POST['emp_salary_mbmf']))
				{
					$emp_salary_mbmf=1;
				}
				if(isset($_POST['emp_salary_sinda']))
				{
					$emp_salary_sinda=1;
				}
				if(isset($_POST['emp_salary_ecf']))
				{
					$emp_salary_ecf=1;
				}
				if(isset($_POST['emp_salary_share']))
				{
					$emp_salary_share=1;
				}
				if(isset($_POST['emp_salary_sdl']))
				{
					$emp_salary_sdl=1;
				}
				if(isset($_POST['emp_allowance']))
				{
					$emp_allowance=1;
				}
				if(isset($_POST['emp_salary_levy']))
				{
					$levy=1;
				}
				
				
				
							$data=array('emp_salary_amount'=>$this->input->post('emp_salary_amount'),
								  'emp_salary_currency_id'=>$this->input->post('emp_salary_currency_id'),
								  'emp_salary_pay_period'=>$this->input->post('emp_salary_pay_period'),
								  'emp_salary_comments'=>$this->input->post('emp_salary_comments'),
								  'emp_salary_cpf'=>$emp_salary_cpf,
								  'emp_salary_cdac'=>$emp_salary_cdac,
								  'emp_salary_mbmf'=>$emp_salary_mbmf,
								  'emp_salary_sinda'=>$emp_salary_sinda,
								  'emp_salary_ecf'=>$emp_salary_ecf,
								  'emp_salary_share'=>$emp_salary_share,
								  'emp_salary_sdl'=>$emp_salary_sdl,
								  'emp_salary_per_hour'=>$this->input->post('emp_salary_per_hour'),
								  'emp_salary_per_day_hour'=>$this->input->post('emp_salary_per_day_hour'),
								  'emp_salary_weekly_hour'=>$this->input->post('emp_salary_weekly_hour'),
								  'emp_salary_weekly_pay'=>$this->input->post('emp_salary_weekly_pay'),
								  'emp_salary_monthly_hour'=>$this->input->post('emp_salary_monthly_hour'),
								  'emp_salary_monthly_pay'=>$this->input->post('emp_salary_monthly_pay'),
								  'emp_salary_over_time'=>$this->input->post('emp_salary_over_time'),
								  'emp_ot_base_amount'=>$this->input->post('emp_ot_base_amount'),
								  'emp_ot_per_hour_amount'=>$this->input->post('emp_ot_per_hour_amount'),'emp_salary_levy'=>$levy,'emp_salary_levy_amt'=>$this->input->post('emp_salary_levy_amt'), 'emp_allowance'=>$emp_allowance,
								  'employee_id'=>$id);
									  
									  
									  
									  
				/*$data=array('emp_salary_amount'=>$this->input->post('emp_salary_amount'),'emp_salary_currency_id'=>$this->input->post('emp_salary_currency_id'),'emp_salary_pay_period'=>$this->input->post('emp_salary_pay_period'),'emp_salary_comments'=>$this->input->post('emp_salary_comments'),'employee_id'=>$id);*/
				if($job_details==false)
				{
					// insert new row
					$insert_job_details=$this->employee_model->add_employee_details('employee_salary',$data);	 
					if($insert_job_details==false)
					{
					  $stop=true;
					}
					else
					{
					  $stop=false;
					}
				}
				else
				{
					// update job row
					$update_job_details=$this->employee_model->update_emp_details('employee_salary',$data,array('employee_id'=>$id));
					if($update_job_details==false)
					{
					  $stop=true;
					}
					else
					{
					  $stop=false;
					}
				}
				if($stop==false)
				{
					$data=array('add_stat'=>'7');
					$add_employee=$this->employee_lib->add_employee('2',$data,$id);
					$this->session->unset_userdata('form');
					$new_form_data=array('step'=>'8','status'=>'1');
					$this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					redirect(site_path.'add_employee/employee_salary/'.$id,'refresh');
				}
				else
				{
					$all_post_data=$this->input->post(NULL,TRUE);
					$new_form_data=array('form_data'=>$all_post_data,'step'=>'7','status'=>'0','message'=>'Please Try Again');
					$this->session->set_userdata('form',array('add_employee'=>$new_form_data));
					redirect($_SERVER['HTTP_REFERER'],'refresh'); 
				}
		     }
			 else
			  {
				   $all_post_data=$this->input->post(NULL,TRUE);
				   $new_form_data=array('form_data'=>$all_post_data,'step'=>'7','status'=>'0','message'=>validation_errors());
				   $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				   redirect($_SERVER['HTTP_REFERER'],'refresh');
			  }
		 }
	}
	public function employee_report($id='0')
	{
		$stop=true;
		if(isset($_POST['next']))
		 {
			 $data=array('add_stat'=>'8');
			/* $add_employee=$this->employee_lib->add_employee('2',$data,$id);*/
			 redirect(site_path.'add_employee/employee_qualification/'.$id,'refresh');
		 }
		 elseif(isset($_POST['save_sup']))
		 {
			 if($this->form_validation->run('add_employee_step8_1')!==false)
			 {
				 $data=array('emp_sup_employeee_id'=>$this->input->post('emp_supervisor_name'),'emp_sub_employeee_id'=>$id,'emp_reporting_method'=>$this->input->post('emp_reporting_method'));
				 $add_employee=$this->employee_model->add_employee_details('emp_reportto',$data);
				 if($add_employee==true)
				 {
					 $data=array('add_stat'=>'7');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $stop=false;
				 }
				 else
				 {
					$stop=true; 
				 }
			 }
			 else
			 {
				 $stop=true; 
			 }
		 }
		 elseif(isset($_POST['edit_sup']))
		 {
			 if($this->form_validation->run('add_employee_step8_1')!==false)
			 {
				 $data=array('emp_sup_employeee_id'=>$this->input->post('emp_supervisor_name'),'emp_reporting_method'=>$this->input->post('emp_reporting_method'));
				 $update_job_details=$this->employee_model->update_emp_details('emp_reportto',$data,array('emp_sub_employeee_id'=>$id));
				 if($update_job_details==true)
				 {
					 $data=array('add_stat'=>'7');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $stop=false;
				 }
				 else
				 {
					  $stop=true; 
				 }
			 }
			 else
			 {
				 $stop=true; 
			 }
		 }
		 elseif(isset($_POST['save_sub']))
		 {
			 if($this->form_validation->run('add_employee_step8_1')!==false)
			 {
				 $data=array('emp_sub_employeee_id'=>$this->input->post('emp_supervisor_name'),'emp_sup_employeee_id'=>$id,'emp_reporting_method'=>$this->input->post('emp_reporting_method'));
				 $add_employee=$this->employee_model->add_employee_details('emp_reportto',$data);
				 if($add_employee==true)
				 {
					 $data=array('add_stat'=>'7');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $stop=false;
				 }
				 else
				 {
					$stop=true; 
				 }
			 }
			 else
			 {
				 $stop=true; 
			 }
		 }
		 elseif(isset($_POST['edit_sub']))
		 {
			 if($this->form_validation->run('add_employee_step8_1')!==false)
			 {
				 $data=array('emp_sub_employeee_id'=>$this->input->post('emp_supervisor_name'),'emp_reporting_method'=>$this->input->post('emp_reporting_method'));
				 $update_job_details=$this->employee_model->update_emp_details('emp_reportto',$data,array('emp_sup_employeee_id'=>$id));
				 if($update_job_details==true)
				 {
					 $data=array('add_stat'=>'7');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $stop=false;
				 }
				 else
				 {
					  $stop=true; 
				 }
			 }
			 else
			 {
				 $stop=true; 
			 }
		 }
		 if($stop==false)
		  {
			  $this->session->unset_userdata('form');
			  $new_form_data=array('step'=>'8','status'=>'1');
			  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			  redirect(site_path.'add_employee/employee_report/'.$id,'refresh');
		  }
		  else
		  {
			  $all_post_data=$this->input->post(NULL,TRUE);
			  $new_form_data=array('form_data'=>$all_post_data,'step'=>'7','status'=>'0','message'=>validation_errors());
			  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			  redirect($_SERVER['HTTP_REFERER'],'refresh'); 
		  }
	}
	public function employee_search()
	{
		$value=$this->input->post('search');
		$results=$this->employee_model->employee_search($value);
		foreach($results as $result)
		{
			$op[]=$result->emp_lastname.' '.$result->emp_middle_name.' '.$result->emp_firstname;
			$fetch_emp_id[]=$result->employee_id;
		}
		
		echo json_encode($results);
		
		
 	}
	public function employee_education($id='0')
	{
		$stop=true;
		if(isset($_POST['next']))
		 {
			 $data=array('add_stat'=>'8');
			/* $add_employee=$this->employee_lib->add_employee('2',$data,$id);*/
			 redirect(site_path.'add_employee/employee_immigration/'.$id,'refresh');
		 }
		 elseif(isset($_POST['save_we']))
		 {
			 if($this->form_validation->run('add_employee_step9_1')!==false)
			 {
				 $data=array('eexp_employer'=>$this->input->post('eexp_employer'),'eexp_jobtit'=>$this->input->post('eexp_jobtit'),'eexp_to_date'=>$this->input->post('eexp_to_date'),'eexp_from_date'=>$this->input->post('eexp_from_date'),'eexp_comments'=>$this->input->post('eexp_comments'),'employee_id'=>$id);
				 $add_employee=$this->employee_model->add_employee_details('emp_workexp',$data);
				 if($add_employee==true)
				 {
					 $data=array('add_stat'=>'9');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $stop=false;
				 }
				 else
				 {
					$stop=true; 
				 }
			 }
			 else
			 {
				 $stop=true; 
			 }
		 }
		 elseif(isset($_POST['edit_we']))
		 {
			 if($this->form_validation->run('add_employee_step9_1')!==false)
			 {
				 $data=array('emp_sup_employeee_id'=>$this->input->post('emp_supervisor_name'),'emp_reporting_method'=>$this->input->post('emp_reporting_method'));
				 $update_job_details=$this->employee_model->update_emp_details('emp_reportto',$data,array('emp_sub_employeee_id'=>$id));
				 if($update_job_details==true)
				 {
					 $data=array('add_stat'=>'7');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $stop=false;
				 }
				 else
				 {
					  $stop=true; 
				 }
			 }
			 else
			 {
				 $stop=true; 
			 }
		 }
		 elseif(isset($_POST['save_edu']))
		 {
			 if($this->form_validation->run('add_employee_step9_2')!==false)
			 {
				 $data=array('emp_edu_institute'=>$this->input->post('emp_edu_institute'),'emp_edu_major'=>$this->input->post('emp_edu_major'),'emp_edu_year'=>$this->input->post('emp_edu_year'),'emp_edu_score'=>$this->input->post('emp_edu_score'),'emp_edu_start_date'=>$this->input->post('emp_edu_start_date'),'emp_edu_end_date'=>$this->input->post('emp_edu_end_date'),'employee_id'=>$id);
				 $add_employee=$this->employee_model->add_employee_details('emp_education',$data);
				 if($add_employee==true)
				 {
					 $data=array('add_stat'=>'9');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $stop=false;
				 }
				 else
				 {
					$stop=true; 
				 }
			 }
			 else
			 {
				 $stop=true; 
			 }
		 }
		 elseif(isset($_POST['edit_edu']))
		 {
			 if($this->form_validation->run('add_employee_step9_2')!==false)
			 {
				 $data=array('emp_sub_employeee_id'=>$this->input->post('emp_supervisor_name'),'emp_reporting_method'=>$this->input->post('emp_reporting_method'));
				 $update_job_details=$this->employee_model->update_emp_details('emp_reportto',$data,array('emp_sup_employeee_id'=>$id));
				 if($update_job_details==true)
				 {
					 $data=array('add_stat'=>'7');
					 $add_employee=$this->employee_lib->add_employee('2',$data,$id);
					 $stop=false;
				 }
				 else
				 {
					  $stop=true; 
				 }
			 }
			 else
			 {
				 $stop=true; 
			 }
		 }
		 if($stop==false)
		  {
			  $this->session->unset_userdata('form');
			  $new_form_data=array('step'=>'9','message'=>'Employee Details Succesfully Added!','status'=>'1','form_data'=>'');
			  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			  redirect(site_path.'add_employee/employee_qualification/'.$id,'refresh');
		  }
		  else
		  {
			  $all_post_data=$this->input->post(NULL,TRUE);
			  $new_form_data=array('form_data'=>$all_post_data,'step'=>'8','status'=>'0','message'=>validation_errors());
			  $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			  redirect($_SERVER['HTTP_REFERER'],'refresh'); 
		  }
	}
	public function employee_skills($id='0')
	{
		if($this->form_validation->run('add_employee_step10')!==false)
		{
		   $data=array('employee_id'=>$id,'esk_id'=>$this->input->post('esk_id'),'esk_skill_id'=>$this->input->post('esk_skill_id'),'esk_skill_comment'=>$this->input->post('esk_skill_comment'));
		   $add_employee=$this->employee_model->add_employee_details('emp_skills',$data);
		   if($add_employee==true)
		   {
			   $this->session->unset_userdata('form');
			   $new_form_data=array('step'=>'5','status'=>'1');
			   $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
			   redirect(site_path.'add_employee/employee_skills/'.$id,'refresh');
		   }
		   else
		   {
				$old_data=$this->session->userdata['form']['add_employee']['form_data'];
				$new_form_data=array('form_data'=>$old_data,'step'=>'10','status'=>'0','message'=>'Please Try Again!');
				$this->session->set_userdata('form',array('add_employee'=>$new_form_data));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
		   }
		}
		else
		{
		   $all_post_data=array_merge_recursive($this->input->post(NULL,TRUE),array('ed_id'=>''));
		   $new_form_data=array('form_data'=>$all_post_data,'step'=>'3','status'=>'0','message'=>validation_errors());
		   $this->session->set_userdata('form',array('add_employee'=>$new_form_data));
		   redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}
	public function upload_attachment($employee_id='0')
	{
		$this->form_validation->set_rules('screen', 'Attachment Type', 'trim|required');
		$this->form_validation->set_rules('attach_file', 'Employee Id', 'trim');
		$this->form_validation->set_rules('attach_comment', 'Employee Id', 'trim');
		if($this->form_validation->run()!==false)
		{
			if($_FILES['attach_file']['name']!='')
			 {
				$new_file_name=$employee_id."_".uniqid(mt_rand());
				$config['upload_path'] = attachments_path;
				$config['allowed_types'] = 'gif|jpg|png|doc|docx|pdf|txt|jpeg';
				$config['max_size']	= '1024';
				$config['file_name']	= $new_file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('attach_file'))
				{
					//print_r($_FILES); echo attachments_path;
					$this->session->set_userdata('form',array('add_employee'=>array('status'=>'1','message'=>$this->upload->display_errors())));
					echo $this->upload->display_errors();
				}
				else
				{
					$file_name=$this->upload->data();
					$file=$file_name['file_name'];
					$date=date('Y-m-d H:i:s');
					$data=array('employee_id'=>$employee_id,'eattach_desc'=>$this->input->post('attach_comment'),'eattach_filename'=>$file,'eattach_size'=>$file_name['file_size'],'eattach_type'=>$file_name['file_type'],'screen'=>$this->input->post('screen'),'attached_time'=>$date);
					$this->employee_model->add_employee_media($data);
					$this->session->set_userdata('form',array('add_employee'=>array('status'=>'1','message'=>'Media file Succesfully Added','form_data'=>'')));
				}
			 }
			 else
			 {
				 $this->session->set_userdata('form',array('add_employee'=>array('message'=>'Please Select a File')));
			 }
		}
		else
		{
			$this->session->set_userdata('form',array('add_employee'=>array('message'=>validation_errors())));
		}
		redirect($_SERVER['HTTP_REFERER'],'refresh');
	}
	public function add_photo()
	{
		$this->form_validation->set_rules('employee_photo', 'Employee Photo', 'strip_image_tags|trim');
		$this->form_validation->set_rules('employee_id', 'Employee Id', 'trim|required');
		if($this->form_validation->run()!==false)
		{
			if($_FILES['employee_photo']['name']!='')
			 {
				$this->session->unset_userdata('form');
				$employee_id=$this->input->post('employee_id');
				$new_file_name=$employee_id."_".uniqid(mt_rand());
				$config['upload_path'] = uploads_dir;
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']	= '1024';
				$config['file_name']	= $new_file_name;
				$this->load->library('upload', $config);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('employee_photo'))
				{
					$message=$this->html_lib->alert_div($this->upload->display_errors());
					$this->session->set_userdata('form',array('add_employee'=>array('status'=>'1','message'=>$message,'form_data'=>'')));
				}
				else
				{
					$file_name=$this->upload->data();
					$img=$file_name['file_name'];
					$date=date('Y-m-d H:i:s');
					$data=array('employee_id'=>$employee_id,'eattach_desc'=>'Employee Photo','eattach_filename'=>$img,'eattach_size'=>$file_name['file_size'],'eattach_type'=>$file_name['file_type'],'screen'=>'emp_photo','attached_time'=>$date);
					$this->employee_model->add_employee_media($data);
					$this->session->set_userdata('form',array('add_employee'=>array('status'=>'1','message'=>'Succesfully Updated','form_data'=>'')));
				}
			 }
			 else
			 {
				 $this->session->set_userdata('form',array('add_employee'=>array('status'=>'1','message'=>'Please Select a photo','form_data'=>'')));
			 }
		}
		else
		{
			$this->session->set_userdata('form',array('add_employee'=>array('status'=>'1','message'=>validation_errors())));
		}
		redirect($_SERVER['HTTP_REFERER'],'refresh');
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
	}
	public function ei_immigration()
	{
		$permit_type=$this->input->post('ei_permit_type');
		if(($permit_type!='3'))
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




