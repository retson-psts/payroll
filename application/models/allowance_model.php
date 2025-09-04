<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Allowance_model extends CI_Model
{
	public function allowance_list()
	{
	   $this->db->select('a.*,b.*,c.*,a.employee_id as emp_id,a.joined_date as join_date');
	   $this->db->from('employee as a');
	   $this->db->join('users as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->join('employee_salary as d','d.employee_id = a.employee_id','LEFT');
	   $this->db->join('employee_contact_address as c','a.employee_id = c.employee_id','LEFT');
	   $this->db->where('a.employee_deleted','0');
	   $this->db->where('d.emp_allowance','1');
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
	   $this->db->where('a.emp_allowance_approved','1');
	   $this->db->where('a.employee_id',$id);
	   

	 $query = $this -> db -> get();
	// var_dump($this->db->last_query());
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	public function allowance_rejected($id)
	{
	   $this->db->select('a.*,b.*,c.*,a.employee_id as emp_id');
	   $this->db->from('emp_allowance as a');
	   $this->db->join('employee as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->join('allowance_types as c','c.allowance_types_id = a.allownce_type_id');
	   $this->db->where('b.employee_deleted','0');
	   $this->db->where('a.emp_allowance_removed','0');
	   $this->db->where('a.emp_allowance_approved','2');
	   $this->db->where('a.employee_id',$id);
	   

	 $query = $this -> db -> get();
	// var_dump($this->db->last_query());
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	public function allowance_report_user($id)
	{
	   $this->db->select('a.*,b.*,c.*,a.employee_id as emp_id');
	   $this->db->from('emp_allowance as a');
	   $this->db->join('employee as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->join('users as e','a.employee_id = e.employee_id','LEFT');
	   $this->db->join('allowance_types as c','c.allowance_types_id = a.allownce_type_id');
	   $this->db->where('b.employee_deleted','0');
	   $this->db->where('a.emp_allowance_removed','0');
	   $this->db->where('e.user_id',$id);
	   

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
	public function allowance_report_request()
	{
	   $this->db->select('a.*,b.*,c.*,a.employee_id as emp_id');
	   $this->db->from('emp_allowance as a');
	   $this->db->join('employee as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->join('users as e','a.employee_id = e.employee_id','LEFT');
	   $this->db->join('allowance_types as c','c.allowance_types_id = a.allownce_type_id');
	   $this->db->where('b.employee_deleted','0');
	   $this->db->where('a.emp_allowance_removed','0');
	   $this->db->where('a.emp_allowance_approved','0');
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
	public function get_allowance($table_name,$data)
	{
		$this->db->select('emp_allowance_from,emp_allowance_to,emp_allowance_month,emp_allowance_filename,allownce_type_id,emp_allowance_reason,emp_allowance_amount,emp_allowance_id');
		$this->db->from($table_name);
		$this->db->where($data);
		$this->db->where($table_name.'_removed','0');
		
		$query = $this -> db -> get();
		/*var_dump($this->db->last_query());*/
	    if($query -> num_rows())
	    {
	   	  return $query->result_array();
		 
		 
	    }
	    else
	    {
		 return false;
	    }
	}
	
}