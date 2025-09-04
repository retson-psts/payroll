<?php
 class Jobsheet_model extends CI_Model
{
	public function job_sheet_list($date)
	{
	   $this->db->select('a.*,b.*,a.employee_id as emp_id,c.*');
	   $this->db->from('employee as a');
	   $this->db->join('employee_salary as b','a.employee_id = b.employee_id');
	   $this->db->join('employee_job_details as c','c.employee_id = b.employee_id');
	  /* $this->db->join('employee_leave as c','a.employee_id = c.employee_id');*/
	   /*$this->db->where('c.leave_date','2015-06-28');*/
	   $this->db->where('c.emp_job_start_date <=',$date);
	   $this->db->where('c.emp_job_end_date >=',$date);
	   $this->db->where('b.emp_salary_fixed <>',1);
	   $this->db->where('a.employee_deleted','0');
	
	 $query = $this -> db -> get();
	//var_dump($this->db->last_query());
	   if($query -> num_rows()>= 1)
	   {
		     /*var_dump($query->result_array());*/
			 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	public function job_sheet_list_employee($id,$date)
	{
	   $this->db->select('a.*,b.*,a.employee_id as emp_id');
	   $this->db->from('employee as a');
	   $this->db->join('employee_salary as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->join('users as c','c.employee_id = b.employee_id','LEFT');
	    $this->db->join('employee_job_details as d','d.employee_id = b.employee_id');
	  /* $this->db->join('employee_leave as c','a.employee_id = c.employee_id');*/
	   /*$this->db->where('c.leave_date','2015-06-28');*/
	  // $this->db->where('d.emp_job_start_date <=',$date);
	  // $this->db->where('d.emp_job_end_date >=',$date);
	   $this->db->where('a.employee_deleted','0');
	   $this->db->where('c.user_id',$id);

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
	public function project_list()
	{
	   $this->db->select('a.*');
	   $this->db->from('projects as a');
	   $this->db->where('a.project_removed','0');

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
	public function location_list($project_id)
	{
	   $this->db->select('a.*');
	   $this->db->from('location as a');
	   
	   $this->db->where('a.location_removed','0');
	   $this->db->where('a.project_id',$project_id);

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
	public function location_list_all()
	{
	   $this->db->select('a.location_id,a.location_name,a.project_id');
	   $this->db->from('location as a');
	   
	   $this->db->where('a.location_removed','0');
	   //$this->db->where('a.project_id',$project_id);

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
	public function jobsheet_complete($master,$project_array,$jobsheet_array)
	{
		$this->db->trans_begin();
		if($master['jobsheet_master_id']==0)
		{
		$this->db->insert('jobsheet_master',$master);
		$last_id=$this->db->insert_id();
		}
		else
		{
			$last_id=$master['jobsheet_master_id'];
			unset($master['jobsheet_master_id']);
			$this->db->where('jobsheet_master_id',$last_id);
			$this->db->update('jobsheet_master',$master);
		}
		foreach($jobsheet_array as $data=>$value)
		{
			if($value['jobsheet_id']!=0)
			{
				$jobsheet_array[$data]['jobsheet_master_id']=$last_id;
				$this->db->where('jobsheet_id',$value['jobsheet_id']);
				$this->db->update('jobsheet',$value);
				$last1_id=$value['jobsheet_id'];
				$this->db->delete('working',array('jobsheet_master_id'=>$last1_id));
				if(!empty($project_array))
				{
					foreach($project_array as $key=>$entry)
					{
						
					    if($entry['employee_id']==$value['employee_id'])
					    {
					    	$project_array[$key]['jobsheet_master_id']=$last1_id;
					    	
							
						}
						
					}
					//var_dump($project_array);
					//$this->db->insert('working',$project_array[$data]);
					
				}
			}
			else
			{
				
			
					$jobsheet_array[$data]['jobsheet_master_id']=$last_id;
					$this->db->insert('jobsheet',$value);
					$last1_id=$this->db->insert_id();
					if(!empty($project_array))
					{
						foreach($project_array as $key=>$entry)
						{
							
						    if($entry['employee_id']==$value['employee_id'])
						    {
						    	$project_array[$key]['jobsheet_master_id']=$last1_id;
						    	
								
							}
							
						}
						//var_dump($project_array);
						//$this->db->insert_batch('working',$project_array);
					}
			}
			
			
			
		}
		if(!empty($project_array))
		{
		$this->db->insert_batch('working',$project_array);
		}
		//die();
		
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
	public function jobsheet_data($where_data)
	{
		$this->db->select('a.*,b.*,c.project_title,d.location_name');
	 	$this->db->from('jobsheet as a');
	 	$this->db->join('working as b','a.jobsheet_id = b.jobsheet_master_id','LEFT');
	 	$this->db->join('projects as c','b.working_projects=c.project_id','LEFT');
	   	$this->db->join('location as d','b.working_location=d.location_id','LEFT');
	   	$this->db->where($where_data);
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
	public function jobsheet_complete_employee($master,$project_array,$jobsheet_array)
	{
		$this->db->trans_begin();
		if($master['jobsheet_master_id']==0)
		{
			
		
		$this->db->insert('employee_jobsheet_master',$master);
		$last_id=$this->db->insert_id();
		}
		else
		{
			$last_id=$master['jobsheet_master_id'];
			unset($master['jobsheet_master_id']);
			$this->db->where('jobsheet_master_id',$last_id);
			$this->db->update('employee_jobsheet_master',$master);
		}
		foreach($jobsheet_array as $data=>$value)
		{
			if($value['jobsheet_id']!=0)
			{
				$jobsheet_array[$data]['jobsheet_master_id']=$last_id;
				$this->db->where('jobsheet_id',$value['jobsheet_id']);
				$this->db->update('jobsheet',$value);
				$last1_id=$value['jobsheet_id'];
				$this->db->delete('working',array('jobsheet_master_id'=>$last1_id));
				if(!empty($project_array))
				{
					foreach($project_array as $key=>$entry)
					{
						
					    if($entry['employee_id']==$value['employee_id'])
					    {
					    	$project_array[$key]['jobsheet_master_id']=$last1_id;
					    	
							
						}
						
					}
					//var_dump($project_array);
					//$this->db->insert('working',$project_array[$data]);
					
				}
			}
			else
			{
				
			
					$jobsheet_array[$data]['jobsheet_master_id']=$last_id;
					$this->db->insert('jobsheet',$value);
					$last1_id=$this->db->insert_id();
					if(!empty($project_array))
					{
						foreach($project_array as $key=>$entry)
						{
							
						    if($entry['employee_id']==$value['employee_id'])
						    {
						    	$project_array[$key]['jobsheet_master_id']=$last1_id;
						    	
								
							}
							
						}
						//var_dump($project_array);
						//$this->db->insert_batch('working',$project_array);
					}
			}
			
			
			
		}
		$this->db->insert_batch('working',$project_array);
		//die();
		
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
}