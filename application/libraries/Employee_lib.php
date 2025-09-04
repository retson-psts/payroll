<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Employee_lib 
{
   private $byzero;
   public function __construct()
   {
	 $this->byzero = & get_instance();
	 $this->byzero->load->model('employee_model');
   }
   public function add_employee($step,$data,$id='0')
   {
	   if($step=='1')
	   {
		   $add_step1=$this->byzero->employee_model->add_employee_step_1($data);
		   return $add_step1;
	   }
	   elseif($step=='2')
	   {
		   $add_step2=$this->byzero->employee_model->update_employee_common($data,$id);
		   return $add_step2;
	   }
   }
   public function edit_employee($step,$data,$id='0')
   {
	   if($step=='1')
	   {
		   $add_step1=$this->byzero->employee_model->add_employee_step_1($data);
		   return $add_step1;
	   }
	   elseif($step=='2')
	   {
		   $add_step2=$this->byzero->employee_model->update_employee_common($data,$id);
		   return $add_step2;
	   }
   }
   public function emp_immigration_permit()
   {
	   return array(/*'1'=>array('name'=>'Passport','id'=>'1'),*/'2'=>array('name'=>'Visa','id'=>'2'),'3'=>array('name'=>'Singapore Citizen','id'=>'3'),'4'=>array('name'=>'Permanent Resident(PR)','id'=>'4'),'5'=>array('name'=>'E-PASS','id'=>'5'),'6'=>array('name'=>'S-PASS','id'=>'6'),'7'=>array('name'=>'Work Permit','id'=>'7'),'8'=>array('name'=>'Others','id'=>'8'));
   }
   public function add_steps($id='0')
   {
	   $add_emp_link=site_path.'add_employee/';
	   //wrong method by yuvaraj
	  /* $current_level=$this->byzero->employee_model->add_emp_curr_level($id)+1;*/
	 
	   
	   $current_method=$this->byzero->router->fetch_method();
	   
	   $op='<div class="row bs-wizard" style="border-bottom:0;">';
	   $steps=array('1'=>array('name'=>'Personal','link'=>$add_emp_link.'index/'.$id,'function'=>'index','icon'=>'ion-person'),
	   				'2'=>array('name'=>'Contact','link'=>$add_emp_link.'employee_contact/'.$id,'function'=>'employee_contact','icon'=>'ion-ios-navigate'),
					'3'=>array('name'=>'Emergency','link'=>$add_emp_link.'employee_emergency/'.$id,'function'=>'employee_emergency','icon'=>'ion-help-buoy'),
					'4'=>array('name'=>'Dependents','link'=>$add_emp_link.'employee_dependents/'.$id,'function'=>'employee_dependents','icon'=>'ion-ios-people'),
					'5'=>array('name'=>'Immigration','link'=>$add_emp_link.'employee_immigration/'.$id,'function'=>'employee_immigration','icon'=>'ion-ios-paper'),
					'6'=>array('name'=>'Job Details','link'=>$add_emp_link.'employee_job_details/'.$id,'function'=>'employee_job_details','icon'=>'ion-erlenmeyer-flask'),
					'7'=>array('name'=>'Salary','link'=>$add_emp_link.'employee_salary/'.$id,'function'=>'employee_salary','icon'=>'ion-cash'),
					'8'=>array('name'=>'Report To','link'=>$add_emp_link.'employee_report/'.$id,'function'=>'employee_report','icon'=>'ion-ios-bell'),
					'9'=>array('name'=>'Qualifications','link'=>$add_emp_link.'employee_qualification/'.$id,'function'=>'employee_qualification','icon'=>'ion-university'),
					'10'=>array('name'=>'Skills','link'=>$add_emp_link.'employee_skills/'.$id,'function'=>'employee_skills','icon'=>'ion-bookmark'),'11'=>array('name'=>'Photo','link'=>$add_emp_link.'employee_photo/'.$id,'function'=>'employee_photo','icon'=>'ion-image'),'12'=>array('name'=>'Bank','link'=>$add_emp_link.'employee_bank/'.$id,'function'=>'employee_bank','icon'=>'ion-card'));
					
					$status=0;
	   foreach($steps as $step=>$step_data)
	   {
	   	if($status==0)
	   	{
			if($step_data['function']!=$current_method)
		  {
		  	
			  $step_stat='complete ';
			  $link=$step_data['link'];
			  $name="<b>".$step_data['name']."</b>";
		  }
		  if($step_data['function']==$current_method)
		  {
		  	
			  $step_stat='complete current';
			  $link=$step_data['link'];
			  $name="<b>".$step_data['name']."</b>";
			  $status=1;
		  }
		}
	   	else
		{
			  $step_stat='';
			  $link=$step_data['link'];
			  $name="<span>".$step_data['name']."</span>";
			  /*$link='#';
			  $name="<span class='disabled'>".$step_data['name']."</span>";*/
		}
		   $op.='<div class="col-xs-1 bs-wizard-step '.$step_stat.'">
					<div class="text-center bs-wizard-stepnum"><span class="top"><i class="ion '.$step_data['icon'].' "></i></span>
					<span class="hidden-y">'.$name.'</span>&nbsp;</div>
					<div class="progress"><div class="progress-bar"></div></div>
					<a href="'.$link.'"  class="bs-wizard-dot"></a>
				 </div>';
	   }
	   $op.='</div>';
	   return $op;
   }
}