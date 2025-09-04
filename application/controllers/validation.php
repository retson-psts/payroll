<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');
class Validation extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library(array('form_validation','employee_lib'));
    $this->load->model(array('employee_model','job_model'));
	if(isset($_POST['ci_csrf_token']))
	{
		unset($_POST['ci_csrf_token']);
	}

  }
  /**
  * Validate field and insert via ajax step1
  * @param undefined $id
  * 
  * @return
  */
  public function step1($id = '0')
  {
    if ($this->input->is_ajax_request())
    {
    	if($this->input->post('employee_id')==0)
    	{
			
		    	if($this->input->post('enable_login')=='1')
		    	{
		    		
					if($this->form_validation->run('add_employee_steplogin1'))
			    	{
			    		$data=$this->input->post();
			    		//unset($data['employee_id']);
			    		$data['add_stat']=1;
			    		$emp_id=$this->employee_model->add_employee($data);
			    		if($emp_id!==false)
						{
							$message='Employee Basic Added Successfully';
							$url=site_path."add_employee/employee_contact/".$emp_id;
					        $report = array('status' => 1,'message' => $message,'url'=>$url);
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
					if ($this->form_validation->run('add_employee_step1') !== false)
		    		{
						$data=$this->input->post();
						$data['add_stat']=1;
						$emp_id=$this->employee_model->add_employee($data);
						if($emp_id!==false)
						{
							$message='Employee Basic Added Successfully';
							$url=site_path."add_employee/employee_contact/".$emp_id;
					        $report = array('status' => 1,'message' => $message,'url'=>$url);
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
					}//validation success
				    else
				    {
				    	
				        $message = $this->form_validation->error_array();
				        $report  = array('status' => 0,'message' => $message);
				        echo json_encode($report);
				        exit;
				    }
					
				}
		    	
		      	
		   
		}
		else
		{
			if($this->input->post('enable_login')=='1')
		    {
		    	if($this->form_validation->run('add_employee_steplogin11'))
			    {
			    	
			    	$data=$this->input->post();
			    	$dublicate=$this->common_model->__edit_dublicate_check('employee',array('emp_number'=>$data['emp_number']),'employee_id',$data['employee_id']);
					$dublicate1=$this->common_model->__edit_dublicate_check('users',array('username'=>$data['username']),'employee_id',$data['employee_id']);
					if($dublicate!==true && $dublicate1!==true )
					{
						$emp_id=$this->employee_model->add_employee($data);
			    		if($emp_id!==false)
						{
							$message='Employee Basic Updated Successfully';
							$url=site_path."add_employee/employee_contact/".$emp_id;
					        $report = array('status' => 1,'message' => $message,'url'=>$url);
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
						$error=array();
						if($dublicate===true )
						{
							$error['emp_number']="Employee number already exist";
						}
						if($dublicate===true )
						{
							$error['username']="Employee user already exist";
						}
						
						$message = $error;
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
				if ($this->form_validation->run('add_employee_step11') !== false)
	    		{
	    			
					$data=$this->input->post();
					$dublicate=$this->common_model->__edit_dublicate_check('employee',array('emp_number'=>$data['emp_number']),'employee_id',$data['employee_id']);
					if($dublicate!==true )
					{
						
					
						$emp_id=$this->employee_model->add_employee($data);
						if($emp_id!==false)
						{
							$message='Employee Basic Updated Successfully';
							//http://localhost/projects/dwz/payroll/site/1/add_employee/employee_emergency/0
							$url=site_path."add_employee/employee_contact/".$emp_id;
					        $report = array('status' => 1,'message' => $message,'url'=>$url);
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
			    		$error['emp_number']="Employee number already exist";
						$message =$error;
			        	$report  = array('status' => 0,'message' => $message);
			        	echo json_encode($report);
			        	exit;
					}
					
					
				}//validation success
			    else
			    {
			    	
			        $message = $this->form_validation->error_array();
			        $report  = array('status' => 0,'message' => $message);
			        echo json_encode($report);
			        exit;
			    }
				
			}
		}
      
    }
    else
    {
      show_error("No direct access allowed");
      //or redirect to wherever you would like
    }
  }
	
  /**
  * 
  * @param undefined $age
  * 
  * @return
  */
  
  public function step2()
  {
  	if ($this->input->is_ajax_request())
    {
    	if($this->form_validation->run('add_employee_step2'))
		{
			$data=$this->input->post();
			$emp_id=$this->employee_model->add_contact($data);
			    		if($emp_id!==false)
						{
							$message='Employee Contact Details Updated Successfully';
							
							$url=site_path."add_employee/employee_emergency/".$emp_id;
					        $report = array('status' => 1,'message' => $message,'url'=>$url);
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
  
  
  public function step12()
  {
  	if ($this->input->is_ajax_request())
    {
    	if($this->form_validation->run('add_employee_step12'))
		{
			$data=$this->input->post();
			$emp_id=$this->employee_model->add_bank($data);
    		if($emp_id!==false)
			{
				$message='All Details added successfully';
				$url=site_path."list_employee";
		        $report = array('status' => 1,'message' => $message,'url'=>$url);
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
  
  
  /**
  * Validate and insert employee emergency contact
  * This will perform two ways 1 check if id not 0 it'll update 
  * if id is 0 it will insert
  * 
  * @return
  */
  public function step3()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step3'))
		{
			$data=$this->input->post();
			if(empty($data['id']))
			{
				unset($data['id']);
				$emp_id=$this->common_model->insert_table('employee_emergency_contact',$data);
			}
			else
			{
				$id=$data['id'];
				unset($data['id']);
				$emp_id=$this->common_model->update_table_custom('employee_emergency_contact',$data,array('eec_id'=>$id));
			}
    		if($emp_id!==false)
			{
				
				$message='Emergency Conatct Updated successfully';
				if(empty($data['id']))
				{
					$message='Emergency Conatct Added successfully';
				}
				$url=site_path."add_employee/employee_emergency/".$emp_id;
		        $report = array('status' => 1,'message' => $message,'url'=>$url);
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


  public function step4()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step4'))
		{
			$data=$this->input->post();
			if(empty($data['id']))
			{
				$data['ed_relationship']="";
				if($data['ed_relationship_type']=="Others")
				{
					$data['ed_relationship']=$data['specify'];
					
				}
				unset($data['specify']);
				unset($data['id']);
				$emp_id=$this->common_model->insert_table('employee_dependents',$data);
			}
			else
			{
				$id=$data['id'];
				unset($data['id']);
				$data['ed_relationship']="";
				if($data['ed_relationship_type']=="Others")
				{
					$data['ed_relationship']=$data['specify'];
					
				}
				unset($data['specify']);
				$emp_id=$this->common_model->update_table_custom('employee_dependents',$data,array('ed_id'=>$id));
			}
    		if($emp_id!==false)
			{
				
				$message='Employee Dependents Updated successfully';
				if(empty($data['id']))
				{
					$message='Emergency Dependents Added successfully';
				}
				//$url=site_path."add_employee/employee_emergency/".$emp_id;
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


  public function step51()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step5_1'))
		{
			$data=$this->input->post();
			//var_dump($data);
			$emp_id=$this->employee_model->add_passport($data);
			if($emp_id!==false)
			{
				
				$message='Employee Passport Updated successfully';
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

  public function step52()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step5'))
		{
			$data=$this->input->post();
			//var_dump($data);
			$emp_id=$this->employee_model->add_immigration($data);
			if($emp_id!==false)
			{
				
				$message='Employee immigration Updated successfully';
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
  
  
  public function step6()
  {
  	
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step6'))
		{
			$data=$this->input->post();
			$emp_id=$this->employee_model->add_jobdetails($data);
			if($emp_id!==false)
			{
				
				$message='Employee job details Updated successfully';
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

  public function step7()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step7_1'))
		{
			$emp_salary_cpf=$emp_salary_cdac=$emp_salary_mbmf=$emp_salary_sinda=$emp_salary_ecf=$emp_salary_share=$emp_salary_sdl=$emp_allowance=$levy=$fixed=0;
				$id=$_POST['employee_id'];
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
				if(isset($_POST['emp_salary_fixed']))
				{
					$fixed=1;
				}
				$data=array('emp_salary_amount'=>$this->input->post('emp_salary_amount'),
							'emp_weekly_days'=>$this->input->post('emp_weekly_days'),
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
						  'emp_ot_per_hour_amount'=>$this->input->post('emp_ot_per_hour_amount'),'emp_salary_levy'=>$levy,'emp_salary_levy_amt'=>$this->input->post('emp_salary_levy_amt'), 'emp_allowance'=>$emp_allowance,'emp_salary_fixed'=>$fixed,'employee_id'=>$id);
			$emp_id=$this->employee_model->add_salarydetails($data);
			if($emp_id!==false)
			{
				
				$message='Employee salary details Updated successfully';
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
  
  
  public function step81()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step8_1'))
		{
			$data=$this->input->post();
			if(empty($data['id']))
			{
				$dub=$this->employee_model->report_duplicate($data['employee_id'],$data['emp_sub_id']);
				if($dub!==FALSE)
				{
					
				$message=array('emp_sub_id'=>'This Supervisor already assigned');
				//$url=site_path."add_employee/employee_emergency/".$emp_id;
		        $report = array('status' => 0,'message' => $message);
		        echo json_encode($report);
		        exit;
					
				}
				else
				{
					unset($data['id']);	
					$data['emp_sub_employeee_id	']=$data['employee_id'];
					$data['emp_sup_employeee_id	']=$data['emp_sub_id'];
					unset($data['emp_sub_id']);
					unset($data['employee_id']);
					$emp_id=$this->common_model->insert_table('emp_reportto',$data);
				}
				
			}
			else
			{
				
			}
    		if($emp_id!==false)
			{
				
				$message='Employee Report to added successfully Updated successfully';
				//$url=site_path."add_employee/employee_emergency/".$emp_id;
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
  public function step82()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step8_1'))
		{
			$data=$this->input->post();
			if(empty($data['id']))
			{
				$dub=$this->employee_model->report_duplicate($data['employee_id'],$data['emp_sub_id']);
				if($dub!==FALSE)
				{
					
				$message=array('emp_sub_id'=>'This subordinate already assigned');
				//$url=site_path."add_employee/employee_emergency/".$emp_id;
		        $report = array('status' => 0,'message' => $message);
		        echo json_encode($report);
		        exit;
					
				}
				else
				{
					unset($data['id']);	
					$data['emp_sub_employeee_id	']=$data['emp_sub_id'];
					$data['emp_sup_employeee_id	']=$data['employee_id'];
					unset($data['emp_sub_id']);
					unset($data['employee_id']);
					$emp_id=$this->common_model->insert_table('emp_reportto',$data);
				}
				
			}
			else
			{
				
			}
    		if($emp_id!==false)
			{
				
				$message='Employee Report to added successfully successfully';
				
				//$url=site_path."add_employee/employee_emergency/".$emp_id;
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

	public function step9_1()
    {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step9_1'))
		{
			$data=$this->input->post();
			if(empty($data['id']))
			{
				unset($data['id']);
				$emp_id=$this->common_model->insert_table('emp_workexp',$data);
			}
			else
			{
				$id=$data['id'];
				unset($data['id']);
				$emp_id=$this->common_model->update_table_custom('emp_workexp',$data,array('eexp_id'=>$id));
			}
    		if($emp_id!==false)
			{
				
				$message='Employee Experience  Updated successfully';
				if(empty($data['id']))
				{
					$message='Employee Experience Added successfully';
				}
				//$url=site_path."add_employee/employee_emergency/".$emp_id;
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
	public function step9_2()
    {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step9_2'))
		{
			$data=$this->input->post();
			if(empty($data['id']))
			{
				unset($data['id']);
				$emp_id=$this->common_model->insert_table('emp_education',$data);
			}
			else
			{
				$id=$data['id'];
				unset($data['id']);
				$emp_id=$this->common_model->update_table_custom('emp_education',$data,array('emp_edu_id'=>$id));
			}
    		if($emp_id!==false)
			{
				
				$message='Employee Education  Updated successfully';
				if(empty($data['id']))
				{
					$message='Employee Education Added successfully';
				}
				//$url=site_path."add_employee/employee_emergency/".$emp_id;
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

	
	public function step10()
    {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('add_employee_step10'))
		{
			$data=$this->input->post();
			if(empty($data['id']))
			{
				unset($data['id']);
				$emp_id=$this->common_model->insert_table('emp_skills',$data);
			}
			else
			{
				$id=$data['id'];
				unset($data['id']);
			
				$emp_id=$this->common_model->update_table_custom('emp_skills',$data,array('esk_id'=>$id));
			}
    		if($emp_id!==false)
			{
				
				$message='Employee Skills  Updated successfully';
				if(empty($data['id']))
				{
					$message='Employee skills Added successfully';
				}
				//$url=site_path."add_employee/employee_emergency/".$emp_id;
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
	public function step10_1()
  {
  	if ($this->input->is_ajax_request())
    {
    	
    	if($this->form_validation->run('edit_employee_step10'))
		{
			$data=$this->input->post();
			$id=$data['id'];
			unset($data['id']);
			$emp_id=$this->common_model->update_table_custom('emp_skills',$data,array('esk_id'=>$id));
			if($emp_id!==false)
			{
				$message='Employee Skills  Updated successfully';
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
  
   public function remove_report($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->employee_model->remove_report($id);
  		if($result!==false)
  		{
			
			$message = 'Attachment Removed Successfully';
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
  	

	
	
  
  public function validate_age($age)
  {
  	$dob = new DateTime($age);
    $now = new DateTime();
    if($now->diff($dob)->y < 18)
    {
    		$this->form_validation->set_message('validate_age', 'Employee age atleast 18');
			return FALSE;
	}
	else
	{
			return TRUE;
	}
    
  }	
  
  public function attachment_add()
  {
  		$uploaddir = upload_path . 'uploads/temp/';
        if ($this->input->is_ajax_request())
        {
        	$actual_image_name="";
            if (isset($_GET['files']))
            {
                $error = false;
                $files = array();
                $msg1  = "";
                $files=array();
                
                foreach ($_FILES as $file)
                {
                    $txt = "attachment";
                    
                    $valid_formats = array(
                        "jpg",
                        "png",
                        "gif",
                        "bmp",
                        "jpeg",
                        "PNG",
                        "JPG",
                        "JPEG",
                        "GIF",
                        "BMP",
                        'doc',
                        'docx',
                        'pdf',
                        'PDF',
                        'DOC',
                        'DOCX'
                    );
                    $name          = $file['name'];
                    $size=filesize($file['tmp_name']);
                    if (strlen($name))
                    {
                        $ext = $this->getExtension($name);
                        if (in_array($ext, $valid_formats))
                        {
                            if ($size < (1024 * 1024))
                            {
                                $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 0) . "." . $ext;
                                $tmp               = $file['tmp_name'];
                                
                                if (move_uploaded_file($tmp, $uploaddir . $actual_image_name))
                                {
                                    $files[] = $actual_image_name;
                                }
                                else
                                {
                                    $error = true;
                                    $msg1  = "Uploading File Error";
                                }
                            }
                            else
                            {
                                $error = true;
                                $msg1  = "Size Exceeded than 1 mb";
                            }
                        }
                        else
                        {
                            $error = true;
                            $msg1  = "Invalid Format";
                        }
                    }
                   
                    
                }
                $data = ($error) ? array( 'error' => $msg1,'upload'=> '' ) : array('files' => $files,'upload'=> $actual_image_name );
                echo json_encode($data);
                exit;
            }
            if ($this->form_validation->run('emp_media') !== false)///**/
            {
               $content=$this->input->post();
               $data['employee_id']=$content['emp_id'];
               $data['eattach_filename']=$content['filenames'][0];
               $data['eattach_desc']=$content['attach_comment'];
               $data['screen']=$content['screen'];
               $data['attached_time']=date('Y-m-d H:i:s');
               if(rename($uploaddir.$data['eattach_filename'],upload_path . 'attachments/'.$data['eattach_filename']))
               {
						$insert=$this->common_model->insert_table('employee_media',$data);
		               if($insert!==FALSE)
		               {
		               
		                	
		                    
		               		$message = "added Successfully";
			                $report  = array(
			                    'status' => 1,
			                    'message' => $message
			                );
			                echo json_encode($report);
		               	
					   	
					   }
					   else
					   {
						   	$message = "Something Wrong";
			                $report  = array(
			                    'status' => 0,
			                    'message' => $message
			                );
			                echo json_encode($report);
					   	
					   }
				}
				else
				{
					$message = "Upload Failed";
			                $report  = array(
			                    'status' => 0,
			                    'message' => $message
			                );
			                echo json_encode($report);
				}
               
               
                
                
                
            }
            else
            {
                $message = $this->form_validation->error_array();
                $report  = array(
                    'status' => 0,
                    'message' => $message
                );
                echo json_encode($report);
            }
            
            
        }
        else
        {
            $message = "Direct Access not allowed";
            
            $report = array(
                'status' => 0,
                'message' => $message
            );
            echo json_encode($report);
        }
  }
  public function attachment_edit()
  {
  		$uploaddir = upload_path . 'uploads/temp/';
        if ($this->input->is_ajax_request())
        {
        	$actual_image_name="";
            if (isset($_GET['files']))
            {
                $error = false;
                $files = array();
                $msg1  = "";
                $files=array();
                
                foreach ($_FILES as $file)
                {
                    $txt = "allowancefile";
                    
                    $valid_formats = array("jpg","png","gif","bmp","jpeg","PNG","JPG","JPEG","GIF","BMP",'doc','docx','pdf','PDF','DOC','DOCX');
                    $name          = $file['name'];
                    $size=filesize($file['tmp_name']);
                    if (strlen($name))
                    {
                        $ext = $this->getExtension($name);
                        if (in_array($ext, $valid_formats))
                        {
                            if ($size < (1024 * 1024))
                            {
                                $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 0) . "." . $ext;
                                $tmp               = $file['tmp_name'];
                                
                                if (move_uploaded_file($tmp, $uploaddir . $actual_image_name))
                                {
                                    $files[] = $actual_image_name;
                                }
                                else
                                {
                                    $error = true;
                                    $msg1  = "Uploading File Error";
                                }
                            }
                            else
                            {
                                $error = true;
                                $msg1  = "Size Exceeded than 1 mb";
                            }
                        }
                        else
                        {
                            $error = true;
                            $msg1  = "Invalid Format";
                        }
                    }
                    
                    /*if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
                    {
                    $files[] = $file['name'];
                    }
                    else
                    {
                    $error = true;
                    }*/
                    
                }
                $data = ($error) ? array( 'error' => $msg1,'upload'=> '' ) : array('files' => $files,'upload'=> $actual_image_name );
                echo json_encode($data);
                exit;
            }
            if ($this->form_validation->run('emp_allowance') !== false)
            {
                
                $user_id                     = $this->session->userdata['logged_in']['user_id'];
                $employee_id              = $this->session->userdata['logged_in']['employee_id'];
                $datetime                    = date('Y-m-d H:i:s');
                $data                        = $this->input->post();
                $data['employee_id']         = $employee_id;
                $data['emp_allowance_month'] = date('Y-m') . "-01";
                if (!empty($data['emp_allowance_date']))
                {
                    $x1                         = explode('-', $data['emp_allowance_date']);
                    $data['emp_allowance_date'] = $x1[2] . "-" . $x1[1] . "-" . $x1[0];
                }
                else
                {
                    $data['emp_allowance_date'] = '0000-00-00';
                }
                if (isset($data['filenames']))
                {
                    $data['emp_allowance_filename'] = implode($data['filenames']);
                    rename($uploaddir.$data['emp_allowance_filename'],upload_path . 'uploads/attachment/'.$data['emp_allowance_filename']);
                    unset($data['filenames']);
                }
                $data1 = $data;
                $range = $data['range'];
                $rr    = explode(' - ', $range);
                if (!empty($rr) && count($rr) == 2)
                {
                    $data['emp_allowance_from'] = $rr[0];
                    $data['emp_allowance_to']   = $rr[1];
                    
                }
                unset($data['range']);
                $data['emp_allowance_added']    = $datetime;
                $data['emp_allowance_added_by'] = $user_id;
                
                unset($data1['emp_allowance_reason']);
                unset($data1['emp_allowance_amount']);
                unset($data1['range']);
                unset($data1['emp_allowance_date']);
                /*var_dump($data1);*/
                $dublicate_check = $this->common_model->dublicate_check('emp_allowance', $data1);
                if ($dublicate_check === false)
                {
                    $insert_table = $this->common_model->insert_table('emp_allowance', $data);
                    if ($insert_table === true)
                    {
                        $message = 'Allowance added successfully';
                        $report  = array(
                            'status' => 1,
                            'message' => $message
                        );
                        echo json_encode($report);
                        
                    }
                    else
                    {
                        $message = 'Something Wrong';
                        $report  = array(
                            'status' => 0,
                            'message' => $message
                        );
                        echo json_encode($report);
                    }
                    
                }
                else
                {
                    $message = 'Already Added';
                    $report  = array(
                        'status' => 2,
                        'message' => $message
                    );
                    echo json_encode($report);
                }
                
                
                
                
            }
            else
            {
                $message = validation_errors();
                $report  = array(
                    'status' => 0,
                    'message' => $message
                );
                echo json_encode($report);
            }
            
            
        }
        else
        {
            $message = "Direct Access not allowed";
            
            $report = array(
                'status' => 0,
                'message' => $message
            );
            echo json_encode($report);
        }
  }
  public function remove_attachment($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->update_table_custom('employee_media',array('removed'=>1),array('emp_attach_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Attachment Removed Successfully';
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
 
 public function remove_eec($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->delete_table('employee_emergency_contact',array('eec_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Emergency contact Removed Successfully';
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

public function remove_ed($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->delete_table('employee_dependents',array('ed_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Employee Dependents Removed Successfully';
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



public function remove_eex($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->delete_table('emp_workexp',array('eexp_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Employee Experience Removed Successfully';
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
  public function remove_eedu($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->delete_table('emp_education',array('emp_edu_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Education Removed Successfully';
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
  public function remove_esk($id=0)
  {
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->delete_table('emp_skills',array('esk_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Skill Removed Successfully';
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
   protected function getExtension($str)
    {
        
        $i = strrpos($str, ".");
        if (!$i)
        {
            return "";
        }
        
        $l   = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }
  
/**
*   validation for step4
* @param int $id
* 
* @return
*/	
  public function ed_relation($id)
	{
		$relation=$this->input->post('ed_relationship_type');
		if($relation=='Others')
		{
			$specify=$this->input->post('specify');
			if($specify=='')
			{
				$this->form_validation->set_message('ed_relation', 'Please Specify Relation type');
				return false;
			}
			return true;
		}
	}
	public function skillexist($id,$type)
	{
		$emp_id=$this->input->post('employee_id');
		$where=array('employee_id'=>$emp_id,'esk_skill_id'=>$id,'emp_skills_removed'=>0);
		if($type==1)
		{
			$where['esk_id <>']=$this->input->post('id');
		}
		$fetch_content=$this->common_model->__fetch_contents('emp_skills',$where);
		if($fetch_content!==FALSE)
		{
			
				$this->form_validation->set_message('skillexist', 'This Skill already added');
				return false;
			
		}
	}
	 /**
  *  Validation for step 5
  * 
  * @return
  */
 
	public function ei_immigration($id)
	{
		
		$relation=$this->input->post('ei_permit_type');
		if($relation==8)
		{
			
			$specify=$this->input->post('ei_specify_permit_type');
			if($specify=='')
			{
				$this->form_validation->set_message('ei_immigration', 'Please Specify Permit type');
				return false;
			}
		}
		if($relation!=3 && $relation!=4)
		{
			$specify1=$this->input->post('ei_quota');
			$specify2=$this->input->post('ei_yard');
			$specify3=$this->input->post('ei_permit_expirydate');
			/*if($specify1=='')
			{
				$this->form_validation->set_message('ei_immigration', 'Please Specify Quota');
				return false;
			}
			if($specify2=='')
			{
				$this->form_validation->set_message('ei_immigration', 'Please Specify yard');
				return false;
			}*/
			if($specify3=='')
			{
				$this->form_validation->set_message('ei_immigration', 'Please Specify expiry date');
				return false;
			}
			
			
		}
		
		return true;
	}
  
 
}