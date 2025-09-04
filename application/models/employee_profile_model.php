<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Employee_profile_model extends CI_Model
{
	public function job_details($employee_id)
	{
	   $this->db->select('a.*,b.job_title_name,c.project_title,d.location_name');
	   $this->db->from('employee_job_details as a');
	   $this->db->join('job_titles as b','a.emp_job_title = b.job_title_id','LEFT');
	   $this->db->join('projects as c','a.emp_sub_unit = c.project_id','LEFT');
	   $this->db->join('location as d','a.emp_job_location = d.location_id','LEFT');
	   $this->db->where('a.employee_id',$employee_id);
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
		
	
	
}