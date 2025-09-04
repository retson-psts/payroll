<?php
 class Salary_model extends CI_Model
{
	
	
	
	public function salary_add($final_array,$month)
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		foreach($final_array as $key=>$array)
		{
			$final_array[$key]['salary_master_generared']=date('Y-m-d H:i:s');
			$final_array[$key]['salary_master_app']=$user_id;
			
		}
		$this->db->trans_begin();
		$this->db->where('salary_master_month',$month);
		$this->db->update('salary_master',array('salary_master_removed'=>1));
		//var_dump($this->db->last_query());
		$this->db->insert_batch('salary_master',$final_array);
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		    return false;
		}
		else
		{
		    $this->db->trans_commit();
		    return true;
		    die();
		}
	}
	public function show_result($month,$type=4,$from='',$to='')
	{
		//var_dump($month);
		//month getting array 2015,06
	   $this->db->select('c.emp_number,c.emp_firstname,c.emp_lastname,f.job_title_name,a.net_pay,month(salary_master_month) as month,year(salary_master_month) as year,salary_master_id');
	   $this->db->from('salary_master as a');
	   //$this->db->join('leave_types as b','a.leave_type=b.leave_type_id');
	   $this->db->join('employee as c','a.employee_id=c.employee_id');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('job_titles as f','e.emp_job_title=f.job_title_id','LEFT');
	   $this->db->where('salary_master_removed',0);
	   $this->db->where('salary_pay_period',$type);
	   if($type==4)
	   {
	   	$this->db->where('salary_master_month',$month[0]."-".$month[1]."-1");	
	   }
	   else
	   {
	   	 	$this->db->where('salary_period_from',$from);
	   	 	$this->db->where('salary_period_to',$to);
	   }
	   
	   $query = $this -> db -> get();
	   /*echo $this->db->last_query();*/
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}

	/**
	* 
	* This function simply get Total Value of Salary earned from Salary Master
	* @author BYZ0004
	* 
	* @param int $year - Year of IR8A to be generated
	* @param int $emp_id - Employee Id
	* 
	* @return mixed - Employee details or false
	*/
	public function ir8a($year,$emp_id)
	{
	   $this->db->select('a.*,b.*,c.*,e.*,g.*,f.job_title_name,h.country_nationality,j.country_name,i.city_name,sum(emp_salary_amount) as emp_salary_amount,k.state_name,sum(cpf_employee) as cpf_employee,sum(cpf_employer) as cpf_employer,sum(cdac)+sum(mbmf)+sum(sinda)+sum(ecf)+sum(share) as sum_value,l.*');
	   $this->db->from('salary_master as a');
	   $this->db->join('employee as c','a.employee_id=c.employee_id');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('job_titles as f','e.emp_job_title=f.job_title_id','LEFT');
	   $this->db->join('employee_contact_address as g','a.employee_id=g.employee_id','LEFT');
	   $this->db->join('countries as h','c.nation_code=h.country_id','LEFT');
	   $this->db->join('city as i','g.emp_contact_temp_city=i.city_id','LEFT');
	   $this->db->join('countries as j','g.emp_contact_temp_country=j.country_id','LEFT');
	   $this->db->join('state as k','g.emp_contact_temp_provience=k.state_id','LEFT');
	   $this->db->join('employee_bank as l','a.employee_id=l.employee_id','LEFT');
	   $this->db->where('salary_master_removed',0);
	   $this->db->where('year(salary_master_month)',$year);
	   $this->db->where('a.employee_id',$emp_id);
	   /*if($type==4)
	   {
	   	$this->db->where('salary_master_month',$month[0]."-".$month[1]."-1");	
	   }
	   else
	   {
	   	 	$this->db->where('salary_period_from',$from);
	   	 	$this->db->where('salary_period_to',$to);
	   }*/
	   
	   $query = $this -> db -> get();
	  
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	
	
	public function show_result_employee($employee_id)
	{
		//var_dump($month);
		//month getting array 2015,06
	   $this->db->select('c.emp_number,c.emp_firstname,c.emp_lastname,f.job_title_name,a.net_pay,month(salary_master_month) as month,year(salary_master_month) as year,salary_master_id');
	   $this->db->from('salary_master as a');
	   //$this->db->join('leave_types as b','a.leave_type=b.leave_type_id');
	   $this->db->join('employee as c','a.employee_id=c.employee_id');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('job_titles as f','e.emp_job_title=f.job_title_id','LEFT');
	   $this->db->where('salary_master_removed',0);
	   $this->db->where('a.employee_id',$employee_id);
	   $query = $this -> db -> get();
	   //echo $this->db->last_query();
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	
	public function salary_view($salary_id)
	{
	   $this->db->select('a.*,c.emp_number,c.emp_firstname,c.emp_lastname,d.emp_contact_temp_street1,d.emp_contact_temp_street2,d.emp_contact_temp_city,d.emp_hm_telephone,d.emp_work_email,f1.ei_permit_number,ci.city_name');
	   $this->db->from('salary_master as a');
	   //$this->db->join('leave_types as b','a.leave_type=b.leave_type_id');
	   $this->db->join('employee as c','a.employee_id=c.employee_id');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id');
	   $this->db->join('employee_contact_address as d','a.employee_id=d.employee_id');
	   $this->db->join('city as ci','d.emp_contact_temp_city=ci.city_id');
	   $this->db->join('employee_immigration as f1','a.employee_id=f1.employee_id');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('job_titles as f','e.emp_job_title=f.job_title_id','LEFT');
	   $this->db->where('salary_master_id',$salary_id);
	   $query = $this -> db -> get();
	   //echo $this->db->last_query();
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	
	public function available_employees($month,$type=4)
	{
		if($type==4 || $type==5)
		{
			$month=date("Y-m-t", strtotime($month."-01"));		
		}
	   $this->db->select('a.employee_id');
	   $this->db->from('employee as a');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('employee_salary as c','a.employee_id=c.employee_id','LEFT');
	   $this->db->where('emp_job_start_date <=',$month);
	   $this->db->where('emp_job_end_date >=',$month);
	   $this->db->where('emp_salary_pay_period >=',$type);
	   $query = $this -> db -> get();
	  /* echo $this->db->last_query();
	   die();*/
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	/**
	* 
	* @param month $month
	* @abstract Finding all employees having fixed salary or not
	* 
	* @return 
	*/
	public function fixed_salary_employee_all($month,$type=0)
	{
		
		if($type!=1)
		{
			$month=date("Y-m-t", strtotime($month."-01"));		
		}
	   
	   $this->db->select('a.employee_id');
	   $this->db->from('employee as a');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id','LEFT');
	   $this->db->where('emp_job_start_date <=',$month);
	   $this->db->where('emp_job_end_date >=',$month);
	   $this->db->where('emp_salary_fixed <>',1);
	   $query = $this -> db -> get();
	 
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	public function leave_details($where_array)
	{
	   $this->db->select('a.leave_date,b.leave_type_name,a.leave_deduct_salary,a.leave_reason');
	   $this->db->from('employee_leave as a');
	   $this->db->join('leave_types as b','a.leave_type=b.leave_type_id');
	   $this->db->where($where_array);
	    $query = $this -> db -> get();
	   /*echo $this->db->last_query();
	   die();*/
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	public function allowance_details($where_array)
	{
	   $this->db->select('a.emp_allowance_from,a.emp_allowance_to,a.emp_allowance_date,emp_allowance_amount,b.allowance_type_name,emp_allowance_reason');
	   $this->db->from('emp_allowance as a');
	   $this->db->join('allowance_types as b','a.allownce_type_id=b.allowance_types_id');
	   $this->db->where($where_array);
	    $query = $this -> db -> get();
	   /*echo $this->db->last_query();
	   die();*/
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	public function deduction_details($where_array)
	{
	   $this->db->select('a.sld_amount,b.dec_name,sld_from,sld_notes');
	   $this->db->from('salary_deduction as a');
	   $this->db->join('deduction_category as b','a.sld_dec_id=b.dec_id');
	   $this->db->where($where_array);
	    $query = $this -> db -> get();
	   /*echo $this->db->last_query();
	   die();*/
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
}
	