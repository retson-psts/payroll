<?php
 class Report_model extends CI_Model
{
	public function leave_list($type,$from,$to,$month)
	{
	   $this->db->select('count(a.employee_id) as leaves,a.leave_date,MONTHNAME(a.leave_date) as month','YEAR(a.leave_date) as year');
	   $this->db->from('employee_leave as a');
	   
	   $this->db->join('jobsheet as b','a.leave_date = b.jobsheet_date','LEFT');
	   if(!empty($type))
	   {
	   	 $this->db->where('a.leave_type',$type);
	   }
	   if(!empty($from))
	   {
	   	$this->db->where('a.leave_date >=', $from);
		$this->db->where('a.leave_date <=', $to);
	   }
	   if(!empty($month))
	   {
	   	$this->db->where('a.leave_date >=', $month[0]);
		$this->db->where('a.leave_date <=', $month[1]);
	   /*	$this->db->where('c.')*/
	   }
	   $this->db->where('a.employee_leave_removed','0');
	   $this->db->group_by('a.leave_date');
	   
	   

	 $query = $this -> db -> get();
	//var_dump($this->db->last_query());
	  if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	public function leave_list1($type,$from,$to,$month)
	{
	   $this->db->select('a.leave_date as elapsed,count(a.employee_id) as value');
	   $this->db->from('employee_leave as a');
	   
	  /* $this->db->join('jobsheet as b','a.leave_date = b.jobsheet_date','LEFT');*/
	  $this->db->where('a.leave_request','1');
	   $this->db->where('a.employee_leave_removed','0');
	   $this->db->where('a.leave_date <= ',date('Y-m-d'));
	   $this->db->group_by('a.leave_date');
	   $this->db->order_by("a.leave_date", "desc"); 
	   $this->db->limit(10);
	   

	 $query = $this -> db -> get();
	//var_dump($this->db->last_query());
	  if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	
	public function allowance_request()
	{
	   $this->db->select('count(emp_allowance_id) as res');
	   $this->db->from('emp_allowance as a');
	   /* $this->db->join('jobsheet as b','a.leave_date = b.jobsheet_date','LEFT');*/
	   $this->db->where('a.emp_allowance_approved','0');
	   $this->db->where('a.emp_allowance_removed','0');
	   $query = $this -> db -> get();
	//var_dump($this->db->last_query());
	  if($query -> num_rows()>= 1)
	   {
		     
			$x=$query->result_array();
			return $x[0]['res'];
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
//	public function leave_list1($type,$from,$to,$month)
//	{
//	   $this->db->select('a.leave_date count(a.employee_id) as value');
//	   $this->db->from('employee_leave as a');
//	   
//	  /* $this->db->join('jobsheet as b','a.leave_date = b.jobsheet_date','LEFT');*/
//	   $this->db->where('a.employee_leave_removed','0');
//	   $this->db->where('a.leave_date <= ',date('Y-m-d'));
//	   $this->db->group_by('a.leave_date,a.');
//	   $this->db->order_by("a.leave_date", "desc"); 
//	   $this->db->limit(10);
//	   
//
//	 $query = $this -> db -> get();
//	//var_dump($this->db->last_query());
//	  if($query -> num_rows()>= 1)
//	   {
//		     
//			 return $query->result_array();
//		 
//	   }
//	   else
//	   {
//		 return false;
//	   }
//	}
		
	public function allowance_types()
	{
	   $this->db->select('a.*');
	   $this->db->from('allowance_types as a');
	   $this->db->where('a.allowance_types_removed','0');
	  
	   

	 $query = $this -> db -> get();
	//var_dump($this->db->last_query());
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	public function allowance_report($id)
	{
	   $this->db->select('a.*,b.*,c.*,a.employee_id as emp_id');
	   $this->db->from('emp_allowance as a');
	   $this->db->join('employee as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->join('allowance_types as c','c.allowance_types_id = a.allownce_type_id');
	   $this->db->where('b.employee_deleted','0');
	   $this->db->where('a.emp_allowance_removed','0');
	   $this->db->where('a.employee_id',$id);
	   

	 $query = $this -> db -> get();
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	
	public function category_report()
	{
	   $this->db->select('count(a.employee_id) as value,b.job_title_name as label');
	   $this->db->from('employee_job_details as a');
	   
	   $this->db->join('job_titles as b','a.emp_job_title = b.job_title_id');
	   $this->db->join('employee as c','a.employee_id = c.employee_id');
	   $this->db->where('c.employee_deleted','0');
	   $this->db->group_by('a.emp_job_title');
	   

	 $query = $this -> db -> get();
   //var_dump($this->db->last_query());
	  if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	public function daywise_leave($date)
	{
	   $this->db->select('c.emp_number,c.emp_firstname,c.emp_lastname,f.job_title_name,d.emp_hm_telephone,b.leave_type_name,a.leave_reason');
	   $this->db->from('employee_leave as a');
	   $this->db->join('leave_types as b','a.leave_type=b.leave_type_id');
	   $this->db->join('employee as c','a.employee_id=c.employee_id');
	   $this->db->join('employee_contact_address as d','a.employee_id=d.employee_id');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('job_titles as f','e.emp_job_title=f.job_title_id','LEFT');
	   
	   $this->db->where('a.employee_leave_removed','0');
	   $this->db->where('a.leave_date',$date);
	   $this->db->where('a.leave_request','1');
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

	
	public function otreport($type,$from,$to,$month)
	{
	   $this->db->select('c.emp_number,c.emp_firstname,c.emp_lastname,f.job_title_name,d.emp_hm_telephone,sum(jobsheet_otfixed) as otfixed,sum(jobsheet_ot15) as ot15,sum(jobsheet_ot2) as ot2');
	   $this->db->from('jobsheet as a');
	   //$this->db->join('leave_types as b','a.leave_type=b.leave_type_id');
	   $this->db->join('employee as c','a.employee_id=c.employee_id');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id');
	   $this->db->join('employee_contact_address as d','a.employee_id=d.employee_id');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('job_titles as f','e.emp_job_title=f.job_title_id','LEFT');
	   if($type!='')
	   {
	   		if($type==1)
	   		{
				$this->db->where('b.emp_salary_over_time','1');
			}
			else
			{
				$this->db->where('b.emp_salary_over_time <>','1');
			}
	   		
	   }
	   if($month!='')
	   {
	   		$date = DateTime::createFromFormat('Y-m', $month);
	   		$this->db->where('month(jobsheet_date)',$date->format('m'));
	   		
	   }
	   elseif($from!='')
	   {
	   	$this->db->where('jobsheet_date >= ',$from);
	   	$this->db->where('jobsheet_date <= ',$to);
	   	
	   }
	   $this->db->group_by('a.employee_id');
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
	
	public function allowance_report1($type,$from,$to,$month)
	{
	   $this->db->select('c.emp_number,c.emp_firstname,c.emp_lastname,f.job_title_name,d.emp_hm_telephone,sum(emp_allowance_amount) as otfixed,allowance_cpf_detect,allowance_type_name,a.employee_id');
	   $this->db->from('emp_allowance as a');
	   $this->db->join('allowance_types as i','a.allownce_type_id=i.allowance_types_id');
	   $this->db->join('employee as c','a.employee_id=c.employee_id');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id');
	   $this->db->join('employee_contact_address as d','a.employee_id=d.employee_id');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('job_titles as f','e.emp_job_title=f.job_title_id','LEFT');
	   if($type!='')
	   {
	   		$this->db->where('a.allownce_type_id',$type);
	   		
	   }
	   if($month!='')
	   {
	   		$date = DateTime::createFromFormat('Y-m', $month);
	   		$this->db->where('month(emp_allowance_month)',$date->format('m'));
	   		
	   }
	   elseif($from!='')
	   {
	   	$this->db->where('emp_allowance_from >= ',$from);
	   	$this->db->where('emp_allowance_from <= ',$to);
	   	
	   }
	   $this->db->group_by('a.employee_id');
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
	
	public function project_wise($project,$location,$from,$to,$month)
	{
	   $this->db->select('c.emp_number,c.emp_firstname,c.emp_lastname,f.job_title_name,d.emp_hm_telephone,count(working_id) as otfixed,a.employee_id');
	   $this->db->from('working as a');
	   $this->db->join('employee as c','a.employee_id=c.employee_id');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id');
	   $this->db->join('employee_contact_address as d','a.employee_id=d.employee_id');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('job_titles as f','e.emp_job_title=f.job_title_id','LEFT');
	   if($project!='')
	   {
	   		$this->db->where('a.working_projects',$project);
	   		
	   }
	   if($location!='')
	   {
	   		$this->db->where('a.working_location',$location);
	   		
	   }
	   if($month!='')
	   {
	   		$date = DateTime::createFromFormat('Y-m', $month);
	   		$this->db->where('month(working_date)',$date->format('m'));
	   		
	   }
	   elseif($from!='')
	   {
	   	$this->db->where('working_date >= ',$from);
	   	$this->db->where('working_date <= ',$to);
	   	
	   }
	   $this->db->group_by('a.employee_id');
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
	
}