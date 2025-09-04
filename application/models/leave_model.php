<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Leave_model extends CI_Model
{
	public function  add_leave($leave_data,$request_data)
	{
		$this->db->trans_begin();
		$this->db->insert('leave_requests',$request_data);
		$insert_id=$this->db->insert_id();
		foreach($leave_data as $key=>$leave)
		{
			$leave_data[$key]['leave_request_id']=$insert_id;
		}
		$this->db->insert_batch('employee_leave',$leave_data);
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
		  $id=$this->db->insert_id();
		  if($this->db->trans_commit())
		  {
			  return $id;
		  }
		  else
		  {
			  return false;
		  }
		}
	}
	public function list_leave_request($user_id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('leave_requests as a');
		$this->db->join('leave_types as b','a.leave_request_type = b.leave_type_id','LEFT');
		//$this->db->where('a.leave_request_type','b.leave_type_id');
		$this->db->where('a.leave_request_user_id',$user_id);
		$this->db->order_by('a.leave_request_id','DESC');
		$query=$this->db->get();
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function pending_leave_request()
	{
		$this->db->select('a.*,b.*,c.emp_firstname,c.emp_lastname,c.employee_id');
		$this->db->from('leave_requests as a');
		$this->db->join('leave_types as b','a.leave_request_type = b.leave_type_id','LEFT');
		$this->db->join('employee as c','a.leave_request_user_id = c.employee_id','LEFT');
		$this->db->where('a.leave_request_approve_status','0');
		$this->db->order_by('a.leave_request_id','DESC');
		$query=$this->db->get();
		//echo $this->db->last_query(); 
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function all_leave_request()
	{
		$this->db->select('a.*,b.*,c.emp_firstname,c.emp_lastname,c.employee_id');
		$this->db->from('leave_requests as a');
		$this->db->join('leave_types as b','a.leave_request_type = b.leave_type_id','LEFT');
		$this->db->join('employee as c','a.leave_request_user_id = c.employee_id','LEFT');
		$this->db->order_by('a.leave_request_id','DESC');
		$query=$this->db->get();
		//echo $this->db->last_query();
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function today_leave_request_count()
	{
		$date=date('Y-m-d');
		$this->db->select('count(leave_request_id) as leave_count');
		$this->db->from('leave_requests');
		$this->db->where('DATE(`leave_requested_at`)',$date);
		$query=$this->db->get();
		//echo $this->db->last_query();
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function leave_types()
	{
		$this->db->select('*');
		$this->db->from('leave_types');
		$query=$this->db->get();
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return true;
		}
	}
	public function get_leave_req_details($request_id)
	{
		$this->db->select('a.*,b.*,c.*,c.emp_firstname,c.emp_lastname,c.employee_id');
		$this->db->from('leave_requests as a');
		$this->db->join('leave_types as b','a.leave_request_type = b.leave_type_id','LEFT');
		$this->db->join('employee as c','a.leave_request_user_id = c.employee_id','LEFT');
		$this->db->order_by('a.leave_request_id','DESC');
		$this->db->where('a.leave_request_id',$request_id);
		$query=$this->db->get();
		//echo $this->db->last_query();
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function get_leaves($request_id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('employee_leave as a');
		$this->db->join('leave_types as b','a.leave_type=b.leave_type_id');
		$this->db->where('employee_leave_removed','0');
		$this->db->where('a.leave_request_id',$request_id);
		$query=$this->db->get();
		
		if($query->num_rows()>=1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	public function get_group_leave($request_id)
	{
		$this->db->select('b.leave_type_name,count(a.leave_id) as leaves');
		$this->db->from('employee_leave as a');
		$this->db->join('leave_types as b','a.leave_type=b.leave_type_id');
		$this->db->where('employee_leave_removed','0');
		$this->db->where('a.leave_request_id',$request_id);
		$this->db->group_by('a.leave_type');
		$query=$this->db->get();
		
		if($query->num_rows()>=1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	public function get_group_leave_all($employee_id)
	{
		$this->db->select('b.leave_type_name,count(a.leave_id) as leaves,leave_request');
		$this->db->from('employee_leave as a');
		$this->db->join('leave_types as b','a.leave_type=b.leave_type_id');
		$this->db->where('employee_leave_removed','0');
		$this->db->where('a.employee_id',$employee_id);
		$this->db->group_by('a.leave_type,a.leave_request');
		$query=$this->db->get();
		
		if($query->num_rows()>=1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	public function get_max_leaves($leave_type)
	{
		$this->db->select('a.leave_type_days');
		$this->db->from('leave_types as a');
		$this->db->where('a.leave_type_id',$leave_type);
		$query=$this->db->get();
		
		if($query->num_rows()>=1)
		{
			$s=$query->result_array();
			return $s[0]['leave_type_days'];
		}
		else
		{
			return false;
		}
	}
	public function leave_taken($id,$employee_id)
	{
		$this->db->select('count(employee_id) as leaves,leave_request as leave_status');
		$this->db->from('employee_leave as a');
		$this->db->where('leave_type',$id);
		$this->db->where('employee_id',$employee_id);
		$this->db->where('employee_leave_removed',0);
		$this->db->group_by('leave_request');
		$query=$this->db->get();
		//var_dump($this->db->last_query());
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function leave_taken_total($employee_id)
	{
		$this->db->select('count(employee_id) as leaves,leave_request as leave_status');
		$this->db->from('employee_leave as a');
		$this->db->where('employee_id',$employee_id);
		$this->db->where('employee_leave_removed',0);
		$this->db->group_by('leave_request');
		$query=$this->db->get();
		//var_dump($this->db->last_query());
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function update_req_status($request_id,$data,$update_array,$leave_ids)
	{
		$this->db->trans_begin();
		$this->db->where('leave_request_id',$request_id);
		$this->db->update('leave_requests',$data);
		foreach($leave_ids as $item)
		{
			$this->db->where('leave_id',$item);
			$this->db->update('employee_leave',$update_array);
		}
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			if($this->db->trans_commit())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	public function fixed_salary_employees($term,$month="")
	{
	   if($month=="")
	   {
	   	$month=date('Y-m-01');
	   }
	   $this->db->select('a.employee_id,a.emp_firstname,a.emp_lastname');
	   $this->db->from('employee as a');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id','LEFT');
	   $this->db->where('emp_job_start_date <=',$month);
	   $this->db->where('emp_job_end_date >=',$month);
	   $this->db->where('emp_salary_fixed',1);
	   $this->db->where("(`emp_firstname` LIKE '%".$term."%' OR `emp_lastname` LIKE '%".$term."%')");
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
	public function fixed_salary_employees1($term,$month="")
	{
	   if($month=="")
	   {
	   	$month=date('Y-m-01');
	   }
	   $this->db->select('a.employee_id,a.emp_firstname,a.emp_lastname');
	   $this->db->from('employee as a');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id','LEFT');
	   $this->db->where('YEAR(emp_job_start_date) <=',$month);
	   $this->db->where('YEAR(emp_job_end_date) >=',$month);
	   $this->db->where('emp_salary_fixed',1);
	   $this->db->where("(`emp_firstname` LIKE '%".$term."%' OR `emp_lastname` LIKE '%".$term."%')");
	   $query = $this -> db -> get();
	  /* var_dump($this->db->last_query());*/
	   if($query -> num_rows()>= 1)
	   {
		     
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	public function employee_available_month($emp_id,$month="")
	{
	   if($month=="")
	   {
	   	$month=date('Y-m-01');
	   }
	   $this->db->select('a.employee_id,a.emp_firstname,a.emp_lastname');
	   $this->db->from('employee as a');
	   $this->db->join('employee_job_details as e','a.employee_id=e.employee_id','LEFT');
	   $this->db->join('employee_salary as b','a.employee_id=b.employee_id','LEFT');
	   $this->db->where('emp_job_start_date <=',$month);
	   $this->db->where('emp_job_end_date >=',$month);
	   $this->db->where('emp_salary_fixed',1);
	   $this->db->where('a.employee_id',$emp_id);
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
	
	public function submit_ot($jobsheet_id,$jobsheet_array)
	{
		$this->db->trans_begin();
		/*$ss="";*/
		foreach($jobsheet_id as $key=>$item)
		{
			if(empty($item))
			{
				$this->db->insert('jobsheet',$jobsheet_array[$key]);
					
			}
			else
			{
				$this->db->where('jobsheet_id',$item);
				$this->db->update('jobsheet',$jobsheet_array[$key]);
				
			}
			/*$ss.=$this->db->last_query();*/
		}
		/*print_r($ss);*/
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			if($this->db->trans_commit())
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
}