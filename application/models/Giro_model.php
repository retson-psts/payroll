<?php
 class Giro_model extends CI_Model
{
	
	
	
	public function giro_month($month)
	{
		//var_dump($month);
		//month getting array 2015,06
	   $this->db->select('c.emp_number,c.emp_firstname,c.emp_lastname,f.job_title_name,a.net_pay,salary_master_id,g.*');
	   $this->db->from('salary_master as a');
	   //$this->db->join('leave_types as b','a.leave_type=b.leave_type_id');
	   $this->db->join('employee as c','a.employee_id=c.employee_id');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('job_titles as f','e.emp_job_title=f.job_title_id','LEFT');
	   $this->db->join('employee_bank as g','g.employee_id=b.employee_id','LEFT');
	   $this->db->where('salary_master_removed',0);
	   $this->db->where('salary_master_month',$month."-1");	
	   
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

	
}
	