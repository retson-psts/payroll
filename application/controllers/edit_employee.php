<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Edit_employee extends CI_Controller {
	public function __construct()
	{
	   parent::__construct();
	   $this->load->library(array('form_validation','employee_lib'));
	   $this->load->model(array('employee_model','job_model'));
    }
	public function index($id='0')
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['edit']=1;
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['message_div']=$this->messages();
		$data['nav_steps']='';
		$data['employee_id']=$id;
		$data['form_data']=array('emp_number'=>'','emp_lastname'=>'','emp_firstname'=>'','emp_middle_name'=>'','emp_birthday'=>'','nation_code'=>'','emp_gender'=>'','emp_marital_status'=>'','emp_other_id'=>'','emp_dri_lice_num'=>'','emp_dri_lice_exp_date'=>'','emp_dri_lice_exp'=>'','username'=>'','password'=>'','emp_licence_type'=>'');
		$data['update_panel']=false;
		$data['nationality_list']=$this->common_model->country_list();
		if($id!='0')
		{
			$add_employee_data=$this->employee_model->employee_details($id);
			
			if($add_employee_data!=false)
			{
				//no need this step when we get resultarray in m
				foreach($add_employee_data['0'] as $key=>$value)
				{
					$op[$key]=$value;
				}
				
				$data['form_data']=$op;
				$data['update_panel']=true;
			}
		}
		if(isset($this->session->userdata['form']['add_employee']['form_data']))
			{
				
				$data['form_data']=$this->session->userdata['form']['add_employee']['form_data'];
				$this->session->unset_userdata('form');
			}
		
		$data['page_title']="Edit Employee";
		$this->page_vars($data,'1');
	}
	public function employee_photo($id='0')
	{
		
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['edit']=1;
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['employee_photo']=$this->employee_model->employee_photo($id);
		$data['message_div']=$this->messages();
		$data['nav_steps']='';
		$data['employee_id']=$id;
		
		$data['page_title']="Edit Employee";
		$this->page_vars($data,'11');
	}
	public function employee_contact($id='0')
	{
 		$adding_employee=$this->employee_model->check_adding_emp1($id,'employee',1);
 		$data['edit']=1;
 		//var_dump($adding_employee);
		if($adding_employee===true)
		{
			
			$data['employee_id']=$id;
			$data['nav_steps']='';
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$page_name=$this->router->fetch_class();
			$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
			$data['message_div']=$this->messages();
			$data['city']=$this->common_model->__fetch_contents('city',array('city_removed'=>0),'city_id,city_name,state_id','','city_name asc');
			$data['state']=$this->common_model->__fetch_contents('state',array('state_removed'=>0),'state_id,state_name,country_id','','state_name asc');
			$data['employee_photo']=$this->employee_model->employee_photo($id);
			$data['nationality_list']=$this->common_model->country_list();
			$add_employee_data=$this->employee_model->employee_add_step2_details($id);
			 
			
			$data['update_panel']=false;
			
			if($add_employee_data!=false)
			{
				foreach($add_employee_data['0'] as $key=>$value)
				{
					$op[$key]=$value;
				}
				$data['form_data']=$this->sanitize_display($op);
				$data['update_panel']=true;
			}
			$data['page_title']="Edit Employee";
			$this->page_vars($data,'2');
		}
		else
		{
			redirect(site_path.'add_employee/index/'.$id,'refresh');
		}
	}
	public function employee_emergency($id='0')
	{
		if(isset($id) && is_numeric($id) && !empty($id))
		{
			$data['edit']=1;
			$adding_employee=$this->employee_model->check_adding_emp1($id,'employee',2);
 		//var_dump($adding_employee);
			if($adding_employee===true)
			{
			$data['employee_id']=$id;
			$data['nav_steps']='';
			$data['page_title']="Employee Emergency Contact";
			$data['emergency_contacts']=$this->employee_model->get_emp_emergency($id);
			$data['attachments']=$this->employee_model->employee_media_list($id,'ed');
			$this->page_vars($data,'3');
			}
			else
			{
				redirect(site_path.'add_employee/employee_contact/'.$id,'refresh');
			}
			
		}
		else
		{
			redirect(site_path,'refresh');
		}
		
	}
	public function employee_dependents($id='0')
	{
		if(isset($id) && is_numeric($id) && !empty($id))
		{
			$data['edit']=1;
			$adding_employee=$this->employee_model->check_adding_emp1($id,'employee',2);
 		//var_dump($adding_employee);
			if($adding_employee===true)
			{
				$data['employee_id']=$id;
				$data['nav_steps']='';
				$data['page_title']="Edit Employee";
				$data['emp_dependents']=$this->sanitize_display($this->employee_model->emp_dependents($id));
				//var_dump($data['emp_dependents']);
				$data['attachments']=$this->employee_model->employee_media_list($id,'ed');
				$this->page_vars($data,'4');
			}
			else
			{
				redirect(site_path.'add_employee/employee_contact/'.$id,'refresh');
			}
		}
		else
		{
			redirect(site_path,'refresh');
		}
		
	}
	public function employee_immigration($id='0')
	{
		if(isset($id) && is_numeric($id) && !empty($id))
		{
			$data['edit']=1;
			$adding_employee=$this->employee_model->check_adding_emp1($id,'employee',2);
			if($adding_employee===true)
			{
				$data['employee_id']=$id;
				$data['nav_steps']='';
				$data['page_title']="Edit Employee";
				$data['nationality_list']=$this->common_model->country_list();
				$data['emp_immigrations']=$this->employee_model->get_employe_details('employee_immigration',$id);
				$data['emp_passport']=$this->employee_model->employee_passport_details($id);
				$data['attachments']=$this->employee_model->employee_media_list($id,'ei');
				$data['permit_types']=$this->employee_lib->emp_immigration_permit();
				$fomr_data=$this->common_model->__fetch_contents('employee_immigration',array('employee_id'=>$id));
				$data['form_data']=$this->sanitize_display($fomr_data[0]);
				$fomr1_data=$this->common_model->__fetch_contents('employee_passport',array('ep_employee_id'=>$id));
				$data['form1_data']=$this->sanitize_display($fomr1_data[0]);
				$this->page_vars($data,'5');
			}
			else
			{
				$this->session->unset_userdata('form');
				redirect(site_path.'add_employee/employee_contact/'.$id,'refresh');
			}
		}
		else
		{
			redirect(site_path,'refresh');
		}
	}
	public function employee_job_details($id='0')
	{
		if(isset($id) && is_numeric($id) && !empty($id))
		{
			$data['edit']=1;
		$adding_employee=$this->employee_model->check_adding_emp1($id,'employee',5);
		if($adding_employee===true)
		{
			$data['employee_id']=$id;
			$data['nav_steps']='';
			$data['employee_photo']=$this->employee_model->employee_photo($id);
			$data['page_title']="Edit Employee";
			$data['nationality_list']=$this->common_model->country_list();
			$data['emp_immigrations']=$this->employee_model->get_employe_details('employee_immigration',$id);
			$this->load->model('jobsheet_model');
			$data['project_list']=$this->jobsheet_model->project_list();
			$data['locations']=$this->jobsheet_model->location_list_all();
			$data['message_div']=$this->messages();
			$data['emp_job_details']=$this->employee_model->employee_job_details($id);
			$data['list_job_titles']=$this->job_model->list_job_titles();
			$data['attachments']=$this->employee_model->employee_media_list($id,'ej');
			$data['form_data'] =  (array) $data['emp_job_details']['0'];
			$data['form_data']=$this->sanitize_display($data['form_data']);
			$data['permit_types']=$this->employee_lib->emp_immigration_permit();
			$this->page_vars($data,'6');
			/*$this->load->view('header',$data);
			$this->load->view('side_menu_admin',$data);
			$this->load->view('test/step_5',$data);
			$this->load->view('footer');*/
		}
		else
		{
			$this->session->unset_userdata('form');
			redirect(site_path.'add_employee/employee_immigration/'.$id,'refresh');
		}
		}
		else
		{
			redirect(site_path,'refresh');
		}
	}
	public function employee_salary($id='0')
	{
		if(isset($id) && is_numeric($id) && !empty($id))
		{
			$data['edit']=1;
		$adding_employee=$this->employee_model->check_adding_emp1($id,'employee',5);
		if($adding_employee===true)
		{
			$data['edit']=1;
			$data['user_details']=$this->session->userdata['logged_in'];
			$data['employee_id']=$id;
			$data['nav_steps']='';
		
			$data['employee_photo']=$this->employee_model->employee_photo($id);
			$data['page_title']="Edit Employee";
			$data['curriencies']=$this->job_model->currency_list();
			$data['pay_periods']=$this->job_model->pay_period();
			$data['nationality_list']=$this->common_model->country_list();
			$data['emp_salary_details']=$this->employee_model->employee_salary($id);
			$data['attachments']=$this->employee_model->employee_media_list($id,'es');
			$data['weekly_days']=array('6.0','5.5','5.0','4.5','4.0','3.5','3.0','2.5','2.0','1.5','1.0');
			if($data['emp_salary_details']!=false)
			{
				$data['form_data'] =  (array) $data['emp_salary_details']['0'];
			}
			$data['form_data']=$this->sanitize_display($data['form_data']);
			$data['permit_types']=$this->employee_lib->emp_immigration_permit();
			$this->page_vars($data,'7');
			}
		else
		{
			$this->session->unset_userdata('form');
			redirect(site_path.'add_employee/employee_immigration/'.$id,'refresh');
		}
		}
		else
		{
			redirect(site_path,'refresh');
		}
		
	}
	public function employee_report($id='0')
	{
		if(isset($id) && is_numeric($id) && !empty($id))
		{
			$data['edit']=1;
		$adding_employee=$this->employee_model->check_adding_emp1($id,'employee',7);
		if($adding_employee===true)
		{
			
			$data['employee_id']=$id;
			$data['nav_steps']='';
			$data['employee_photo']=$this->employee_model->employee_photo($id);
			$data['page_title']="Edit Employee";
			$data['reporting_methods']=$this->job_model->reporting_methods();
			$data['attachments']=$this->employee_model->employee_media_list($id,'rt');
			$data['emp_supervisors']=$this->employee_model->emp_supervisor($id);
		//	var_dump($data['emp_supervisors']);
			$data['emp_subordinates']=$this->employee_model->emp_subordinates($id);
			$data['other_employee']=$this->employee_model->select_employeereportto($id);
			//var_dump($data['other_employee']);
			
			$this->page_vars($data,'8');
		}
		else
		{
			$this->session->unset_userdata('form');
			redirect(site_path.'add_employee/employee_salary/'.$id,'refresh');
		}
		}
		else
		{
			redirect(site_path,'refresh');
		}
	}
	public function employee_qualification($id)
	{
		$adding_employee=$this->employee_model->check_adding_emp1($id,'employee',7);
		if($adding_employee===true)
		{
			$data['edit']=1;
			$data['employee_id']=$id;
			$data['nav_steps']='';
			$data['employee_photo']=$this->employee_model->employee_photo($id);
			$data['page_title']="Edit Employee";
			$data['message_div']=$this->messages();
			$data['attachments']=$this->employee_model->employee_media_list($id,'qa');
			$data['emp_work_experiences']=$this->employee_model->get_employe_details('emp_workexp',$id);
			$data['emp_educations']=$this->employee_model->get_employe_details('emp_education',$id);
			$data['form_data']=array('emp_salary_amount'=>'','emp_salary_currency_id'=>'','emp_salary_pay_period'=>'','emp_salary_comments'=>'','employee_id'=>$id);
			if(isset($this->session->userdata['form']['add_employee']['form_data']))
			{
				if($this->session->userdata['form']['add_employee']['form_data']!='')
				{
					$data['form_data']=$this->session->userdata['form']['add_employee']['form_data'];
				}
				if(!isset($this->session->userdata['form']['add_employee']['edit']))
				{
					$data['add_form']=$this->session->userdata['form']['add_employee']['form_data'];	
				}
				else
				{
					$data['edit_form']=true;	
				}
			}
			$this->page_vars($data,'9');
		}
		else
		{
			$this->session->unset_userdata('form');
			redirect(site_path.'add_employee/employee_salary/'.$id,'refresh');
		}
	}
	public function employee_skills($id='0')
	{
		$adding_employee=$this->employee_model->check_adding_emp1($id,'employee',7);
		if($adding_employee===true)
		{
			$data['edit']=1;
			$data['employee_id']=$id;
			$data['nav_steps']='';
			$data['employee_photo']=$this->employee_model->employee_photo($id);
			$data['page_title']="Edit Employee";
			$data['message_div']=$this->messages();
			$data['attachments']=$this->employee_model->employee_media_list($id,'esk');
			$data['emp_skills']=$this->employee_model->get_employe_skills($id);
			$data['skill_list']=$this->employee_model->emp_skill_list($id);
			$data['form_data']=array('esk_id'=>'','esk_skill_id'=>'','esk_skill_comment'=>'','employee_id'=>$id);
			if(isset($this->session->userdata['form']['add_employee']['form_data']))
			{
				if($this->session->userdata['form']['add_employee']['form_data']!='')
				{
					$data['form_data']=$this->session->userdata['form']['add_employee']['form_data'];
				}
				if(!isset($this->session->userdata['form']['add_employee']['edit']))
				{
					$data['add_form']=$this->session->userdata['form']['add_employee']['form_data'];	
				}
				else
				{
					$data['edit_form']=true;	
				}
			}
			$this->page_vars($data,'10');
		}
		else
		{
			$this->session->unset_userdata('form');
			redirect(site_path.'add_employee/employee_salary/'.$id,'refresh');
		}
	}
	protected function page_vars($data,$step)
	{
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('add_employee/step_'.$step,$data);
		$this->load->view('footer');
	}
	public function employee_bank($id='0')
	{
		$adding_employee=$this->employee_model->check_adding_emp1($id,'employee',7);
		if($adding_employee===true)
		{
			$data['edit']=1;
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$frm=$this->employee_model->employee_bank($id);
		$data['form_data']=$frm[0];
		$data['message_div']=$this->messages();
		$data['nav_steps']='';
		$data['employee_id']=$id;
		
		
		$data['page_title']="Edit Employee";
		$this->page_vars($data,'12');
		}
		else
		{
			$this->session->unset_userdata('form');
			redirect(site_path.'add_employee/employee_salary/'.$id,'refresh');
		}
		
	}
	protected function messages()
	{
		$data['message_div']='';
		if(isset($this->session->userdata['form']['add_employee']['message']))
		{
			
			$status=$this->session->userdata['form']['add_employee']['status'];
			$message=$this->session->userdata['form']['add_employee']['message'];
			$data['form_data']=$this->session->userdata['form']['add_employee']['form_data'];
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
				unset($shortlist['add_employee']['message'],$shortlist['add_employee']['status']);
				$this->session->set_userdata('form',$shortlist);
			}
		}
		return $data['message_div'];
	}
	
	private function sanitize_display($result)
	{
		//var_dump($result);
		if($result!==FALSE)
		{
			
		
		foreach($result as $key=>$item)
		{
			if(is_array($item))
			{
				foreach($item as $key1=>$item1)
				{
					if(is_array($item1))
					{
						foreach($item1 as $key2=>$item2)
						{
							
							if(is_array($item1))
							{
								foreach($item2 as $key3=>$item3)
								{
									if(is_array($item2))
									{
										
									}
									else
									{
										$result[$key][$key1][$key2][$key3]=$this->sanitize_input($item3);
									}
									
								}
								
							}
							else
							{
								$result[$key][$key1][$key2]=$this->sanitize_input($item2);
								
							}
							
						}
						
					}
					else
					{
						$result[$key][$key1]=$this->sanitize_input($item1);
					}
				}
			}
			else
			{
				$result[$key]=$this->sanitize_input($item);
			}
		}
		return $result;
		}
		else
		{
			return $result;
		}
	}
	private function sanitize_input($input)
	{
		if($input=='0000-00-00')
		{
			return '';
		}
		if($input=='0')
		{
			return '';
		}
		if($input=='0000-00-00 00:00:00')
		{
			return '';
		}
		if($input==NULL)
		{
		 	return '';
		}
		else
		{
			//var_dump($input);
		   return $input;
		}
	}
	
}
