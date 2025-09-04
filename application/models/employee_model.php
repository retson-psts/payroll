<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Employee_model extends CI_Model
{
	public function add_employee_step_1($form_data)
	{
		//$data=array(''=>$form_data['']);
		$this->db->trans_begin();
		$this->db->insert('employee',$form_data);
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
	public function create_employee_login($form_data)
	{
		$this->db->trans_begin();
		$this->db->insert('users',$form_data);
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	public function is_employee_login_exist($id)
	{
		$this->db->select('employee_id');
		$this->db->from('users');
		$this->db->where('employee_id',$id);
		$query = $this -> db -> get();
	    if($query -> num_rows() == 1)
	    {
		  return true;
	    }
	    else
	    {
		  return false;
	    }
	}
	public function list_employees()
	{
	   $this->db->select('a.*,b.*,a.employee_id as emp_id,a.joined_date as join_date');
	   $this->db->from('employee as a');
	   $this->db->join('users as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->where('a.employee_deleted','0');
	   $this->db->where('a.add_stat >=','1');
	   $query = $this -> db -> get();
	   
	   if($query -> num_rows() >= 1)
	   {
		 return $query->result();
	   }
	   else
	   {
		 return false;
	   }
	}
	public function list_employees1()
	{
	   $this->db->select('a.*,b.*,a.employee_id as emp_id,a.joined_date as join_date,c.*,e.*');
	   $this->db->from('employee as a');
	   $this->db->join('users as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->join('employee_contact_address as c','a.employee_id = c.employee_id','LEFT');
	   $this->db->join('employee_job_details as e','a.employee_id = e.employee_id','LEFT');
	   $this->db->where('a.employee_deleted','0');
	   $this->db->where('a.add_stat >=','1');
	   $query = $this -> db -> get();
	   
	   if($query -> num_rows() >= 1)
	   {
		 return $query->result_array();
	   }
	   else
	   {
		 return false;
	   }
	}
	public function employee_details($employee_id)
	{
	   $this->db->select('a.*,b.*,a.employee_id as emp_id,a.joined_date as join_date');
	   $this->db->from('employee as a');
	   $this->db->join('users as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->where('a.employee_id',$employee_id);
	   $this->db->where('a.employee_deleted','0');
	   $query = $this -> db -> get();
	   //echo $this->db->last_query();
	   if($query -> num_rows() == 1)
	   {
		 return $query->result();
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	
	/**
	*  yuvaraj object array have to parse so need to change my own
	* @param int $employee_id
	* 
	* @return array
	*/
	public function employee_details1($employee_id)
	{
	   $this->db->select('a.*,b.*,a.employee_id as emp_id,a.joined_date as join_date');
	   $this->db->from('employee as a');
	   $this->db->join('users as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->where('a.employee_id',$employee_id);
	   $this->db->where('a.employee_deleted','0');
	   $query = $this -> db -> get();
	   //echo $this->db->last_query();
	   if($query -> num_rows() == 1)
	   {
		 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}

	public function employee_details_using_user_id($user_id)
	{
	   $this->db->select('a.*,b.*,a.employee_id as emp_id,a.joined_date as join_date');
	   $this->db->from('employee as a');
	   $this->db->join('users as b','a.employee_id = b.employee_id','LEFT');
	   $this->db->where('b.user_id',$user_id);
	   $this->db->where('a.employee_deleted','0');
	   $query = $this -> db -> get();
	   //echo $this->db->last_query();
	   if($query -> num_rows() == 1)
	   {
		 return $query->result_array();
		 
	   }
	   else
	   {
		 return false;
	   }
	}

	public function update_employee_common($data,$employee_id)
	{
		$this->db->trans_begin();
		$this->db->where('employee_id',$employee_id);
		$this->db->update('employee',$data);
		//echo $this->db->last_query();
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	public function update_user_common($data,$employee_id)
	{
		$this->db->trans_begin();
		$this->db->where('employee_id',$employee_id);
		$this->db->update('users',$data);
		//echo $this->db->last_query();
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	public function check_adding_emp($id='',$table='')
	{
		$this->db->select('employee_id');
		$this->db->from($table);
		$this->db->where('employee_id',$id);
		$query = $this -> db -> get();
		//var_dump($this->db->last_query());
	    if($query -> num_rows() == 1)
	    {
		  return true;
	    }
	    else
	    {
		  return false;
	    }
	}
	public function check_adding_emp1($id='',$table='',$step=1)
	{
		$this->db->select('employee_id');
		$this->db->from($table);
		$this->db->where('employee_id',$id);
		$this->db->where('add_stat >= ',$step);
		$query = $this -> db -> get();
		
		//var_dump($this->db->last_query());
	    if($query -> num_rows() == 1)
	    {
		  return true;
	    }
	    else
	    {
		  return false;
	    }
	}
	public function add_employee_media($data)
	{
		$this->db->trans_begin();
		$this->db->insert('employee_media',$data);
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	public function employee_photo($id)
	{
		$this->db->select('*');
		$this->db->from('employee_media');
		$this->db->where('employee_id',$id);
		$this->db->where('screen','emp_photo');
		$this->db->order_by('emp_attach_id','DESC');
		$this->db->limit('1');
		$query = $this -> db -> get();
	    if($query -> num_rows() == 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function employee_add_step1_details($id)
	{
		$this->db->select('*');
		$this->db->from('employee');
		$this->db->where('employee_id',$id);
		$query = $this -> db -> get();
	    if($query -> num_rows() == 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function employee_add_step2_details($id)
	{
		/*$this->db->select('u.user_id, u.username, t.topic_id, t.topic_name, q.quote_id, q.quote_name');
$this->db->from('users u');
$this->db->join('topics t', 't.user_id = u.user_id'); // this joins the user table to topics
$this->db->join('quotes q', 'q.topic_id = t.topic_id'); // this joins the quote table to the topics table
$query = $this->db->get();*/
		$this->db->select('a.*');
		$this->db->from('employee_contact_address as a');
		 
		
		/*$this->db->from('','a.employee_id=b.employee_id',$id);*/
		$this->db->where('a.employee_id',$id);
		$query = $this -> db -> get();
		
	    if($query -> num_rows() == 1)
	    {
			
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function add_emp_curr_level($id)
	{
		$this->db->select('add_stat');
		$this->db->from('employee');
		$this->db->where('employee_id',$id);
		$query = $this -> db -> get();
	    if($query -> num_rows() == 1)
	    {
		  $result=$query->result();
		  return $result['0']->add_stat;
	    }
	    else
	    {
		  return false;
	    }
	}
	public function get_emp_emergency($id)
	{
		$this->db->select('*');
		$this->db->from('employee_emergency_contact');
		$this->db->where('employee_id',$id);
		$query = $this -> db -> get();
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function update_emp_details($table,$data,$fields)
	{
		$this->db->trans_begin();
		foreach($fields as $field_name=>$field_value)
		{
			$this->db->where($field_name,$field_value);
		}
		$this->db->update($table,$data);
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	public function add_employee_details($table,$data)
	{
		 
		
 		$this->db->trans_begin();
		$this->db->insert($table,$data);
		
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	
	
	public function get_employe_skills($id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('emp_skills as a');
		$this->db->join('skills as b','a.esk_skill_id=b.skill_id',$id,'left');
		$this->db->where('a.employee_id',$id);
		$query = $this -> db -> get();
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function get_employe_skills1($id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('emp_skills as a');
		$this->db->join('skills as b','a.esk_skill_id=b.skill_id',$id,'left');
		$this->db->where('a.employee_id',$id);
		$query = $this -> db -> get();
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result_array();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function emp_skill_list($id)
	{
		$this->db->select('*');
		$this->db->from('skills');
		$query = $this -> db -> get();
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function employee_media_list($id,$screen)
	{
		$this->db->select('*');
		$this->db->from('employee_media');
		$this->db->where('employee_id',$id);
		$this->db->where('screen',$screen);
		$this->db->where('removed',0);
		$query = $this -> db -> get();
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function employee_ajax_list($employee_id='0')
	{
		$this->db->select('*');
		$this->db->from('employee');
		//$this->db->join('employee as b','','left');
		if($employee_id!='0')
		{
			$this->db->where('employee_id !=',$id);
		}
		$query = $this -> db -> get();
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function emp_dependents($id)
	{
		$this->db->select('*');
		$this->db->from('employee_dependents');
		$this->db->where('employee_id',$id);
		$query = $this -> db -> get();
		//echo $this->db->last_query();
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result_array();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function employee_job_details($id)
	{
		$this->db->select('*');
		$this->db->from('employee_job_details');
		$this->db->where('employee_id',$id);
		$query = $this -> db -> get();
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	
	
	
	public function employee_passport_details($id)
	{
		$this->db->select('*');
		$this->db->from('employee_passport');
		$this->db->where('ep_employee_id',$id);
		$query = $this -> db -> get();
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
	
	
	
	
	
	public function get_employe_details($table,$id)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('employee_id',$id);
		$query = $this -> db -> get();
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function employee_salary($id)
	{
		$this->db->select('*');
		$this->db->from('employee_salary');
		$this->db->where('employee_id',$id);
		$query = $this -> db -> get();
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	
	
	 /*================================== Search Order ==================================*/
	
	public function  employee_search($value)
	{
 			$this -> db -> select('a.employee_id,a.emp_firstname,a.emp_middle_name,a.emp_lastname');
			$this -> db -> from('employee as a');
 			$this->db->or_like('a.emp_firstname',$value);
			$this->db->or_like('a.emp_lastname',$value);
			$this->db->or_like('a.emp_middle_name',$value);
			
    		$this->db->order_by ('a.employee_id','desc'); 
			$query = $this -> db -> get();	
 				if($query -> num_rows() >= 1)
				{
					return $query->result();
				}
				else
				{
 					return false;
				}
 	}

	/**
	* Yuvaraj Adding New methods===================================================
	*/
	public function add_employee($data)
	{
		//checking edit or adding employee
		//var_dump($data['employee_id']);
		if($data['employee_id']==0)
		{
			// checking enable login added
			if($data['enable_login']==0)
			{
				unset($data['username']);
				unset($data['password']);
				$this->db->trans_begin();
				
				$this->db->insert('employee',$data);
				$id=$this->db->insert_id();
				$emp['employee_id']=$id;
				$ep['ep_employee_id']=$id;
				$this->db->insert('employee_salary',$emp);
				$this->db->insert('employee_contact_address',$emp);
				$this->db->insert('employee_job_details',$emp);
				$this->db->insert('employee_passport',$ep);
				$this->db->insert('employee_immigration',$emp);
				$this->db->insert('employee_bank',$emp);
				
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					return false;
				}
				else
				{
					
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
			else
			{
				$data1['username']=$this->db->escape_str($data['username']);
				$data1['password']=$this->db->escape_str(md5($data['password']));
				$data1['first_name']=$data['emp_firstname'];
				$data1['last_name']=$data['emp_lastname'];
				$data1['verified']=1;
				
				unset($data['username']);
				unset($data['password']);
				$this->db->trans_begin();
				$this->db->insert('employee',$data);
				$id=$this->db->insert_id();
				$data1['employee_id']=$id;
				$data1['group_id']=2;
				$this->db->insert('users',$data1);
				$emp['employee_id']=$id;
				$ep['ep_employee_id']=$id;
				$this->db->insert('employee_salary',$emp);
				$this->db->insert('employee_contact_address',$emp);
				$this->db->insert('employee_job_details',$emp);
				$this->db->insert('employee_immigration',$emp);
				$this->db->insert('employee_passport',$ep);
				$this->db->insert('employee_bank',$emp);
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					return false;
				}
				else
				{
					
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
			
		}
		else
		{
			if($data['enable_login']==0)
			{
				$emp_id=$data['employee_id'];
				unset($data['username']);
				unset($data['password']);
				unset($data['employee_id']);
				$this->db->trans_begin();
				$this->db->where('employee_id',$emp_id);
				$this->db->update('employee',$data);
				$this->db->delete('users',array('employee_id'=>$emp_id));
				if ($this->db->trans_status() === FALSE)
				{
					$this->db->trans_rollback();
					return false;
				}
				else
				{
					//$id=$this->db->insert_id();
					if($this->db->trans_commit())
					{
						return $emp_id;
					}
					else
					{
						return false;
					}
				}
				
			}
			else
			{
				$emp_id=$data['employee_id'];
				$data1['username']=$this->db->escape_str($data['username']);
				$data1['password']=$this->db->escape_str(md5($data['password']));
				$data1['first_name']=$data['emp_firstname'];
				$data1['last_name']=$data['emp_lastname'];
				$data1['verified']=1;
				unset($data['username']);
				unset($data['password']);
				unset($data['employee_id']);
				$this->db->trans_begin();
				$this->db->where('employee_id',$emp_id);
				$this->db->update('employee',$data);
				//$id=$this->db->insert_id();
				//$data1['employee_id']=$id;
				$this->db->select('employee_id');
				$this->db->from('users');
				$this->db->where('employee_id',$emp_id);
				$query = $this -> db -> get();
				if($query -> num_rows() == 1)
	    		{
	    			$this->db->where('employee_id',$emp_id);
					$this->db->update('users',$data1);	
				}
				else
				{
					$data1['employee_id']=$emp_id;
					$this->db->insert('users',$data1);
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
						return $emp_id;
					}
					else
					{
						return false;
					}
				}
			}
			
		}
	}
	
	public function add_contact($data)
	{
		$this->db->trans_begin();
		$data1['employee_id']=$data['employee_id'];
		unset($data['employee_id']);
		if(!isset($data['emp_contact_curr_perma_address']))
		{
			$data['emp_contact_curr_perma_address']=0;
			
		}
		else
		{
			$data['emp_contact_perma_street1']=$data['emp_contact_temp_street1'];
			$data['emp_contact_perma_street2']=$data['emp_contact_temp_street2'];
			$data['emp_contact_perma_city']=$data['emp_contact_temp_city'];
			$data['emp_contact_perma_country']=$data['emp_contact_temp_country'];
			$data['emp_contact_perma_provience']=$data['emp_contact_temp_provience'];
			
		}
		$this->db->where($data1);
		$this->db->update('employee_contact_address',$data);
		//print_r($this->db->last_query());
		$this->db->where($data1);
		$this->db->where('add_stat < ',2);
		$this->db->update('employee',array('add_stat'=>2));
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			if($this->db->trans_commit())
			{
				return $data1['employee_id'];
			}
			else
			{
				return false;
			}
		}
	}
	public function add_passport($data)
	{
		$x=0;
		$this->db->trans_begin();
		$data1['employee_id']=$data['ep_employee_id'];
		$data11['ep_employee_id']=$data['ep_employee_id'];
		unset($data['ep_employee_id']);
		unset($data['id']);
		$this->db->where($data11);
		$this->db->update('employee_passport',$data);
		$this->db->select('ei_permit_type');
		$this->db->where($data1);
		$this->db->from('employee_immigration');
		$query = $this -> db -> get();
		if($query -> num_rows() >= 1)
	    {
		    $datax=$query->result_array();
		    $x=$datax[0]['ei_permit_type'];
		    
	    }
	    if(!empty($x))
	    {
			$this->db->where($data1);
			$this->db->where('add_stat < ',5);
			$this->db->update('employee',array('add_stat'=>5));	
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
				return $data1['employee_id'];
			}
			else
			{
				return false;
			}
		}
	}
	public function add_immigration($data)
	{
		$x='';
		$this->db->trans_begin();
		$data1['employee_id']=$data['ep_employee_id'];
		$data11['ep_employee_id']=$data['ep_employee_id'];
		unset($data['ep_employee_id']);
		unset($data['id']);
		$this->db->where($data1);
		$this->db->update('employee_immigration',$data);
		$this->db->select('ep_passport_number');
		$this->db->where($data11);
		$this->db->from('employee_passport');
		$query = $this -> db -> get();
		if($query -> num_rows() >= 1)
	    {
		    $datax=$query->result_array();
		    $x=$datax[0]['ep_passport_number'];
		    
	    }
	    if(!empty($x))
	    {
			$this->db->where($data1);
			$this->db->where('add_stat < ',5);
			$this->db->update('employee',array('add_stat'=>5));	
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
				return $data1['employee_id'];
			}
			else
			{
				return false;
			}
		}
	}
	
	public function add_jobdetails($data)
	{
		$x='';
		$this->db->trans_begin();
		$data1['employee_id']=$data['employee_id'];
		unset($data['employee_id']);
		unset($data['id']);
		$this->db->where($data1);
		$this->db->update('employee_job_details',$data);
		
		$this->db->where($data1);
		$this->db->where('add_stat < ',6);
		$this->db->update('employee',array('add_stat'=>6));	
		
		
	   	if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			
			if($this->db->trans_commit())
			{
				
				return $data1['employee_id'];
			}
			else
			{
				return false;
			}
		}
	}
	public function add_salarydetails($data)
	{
		$x='';
		$this->db->trans_begin();
		$data1['employee_id']=$data['employee_id'];
		unset($data['employee_id']);
		unset($data['id']);
		$this->db->where($data1);
		$this->db->update('employee_salary',$data);
		$this->db->where($data1);
		$this->db->where('add_stat < ',7);
		$this->db->update('employee',array('add_stat'=>7));	
	
	   	if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			if($this->db->trans_commit())
			{
				return $data1['employee_id'];
			}
			else
			{
				return false;
			}
		}
	}
	
	public function employee_bank($id)
	{
		$this->db->select('a.*');
	   $this->db->from('employee_bank as a');
	   $this->db->where('a.employee_bank_removed','0');
	   $this->db->where('a.employee_id',$id);
	   $query = $this -> db -> get();
	   if($query -> num_rows() >= 1)
	   {
		 return $query->result_array();
	   }
	   else
	   {
		 return false;
	   }
	}
	public function user_reset($id,$key)
	{
		$this->db->select('a.*');
	   $this->db->from('users as a');
	   $this->db->where('a.employee_id',$id);
	   $this->db->where('a.validate',$key);
	   $query = $this -> db -> get();
	   if($query -> num_rows() == 1)
	   {
		 return $query->result_array();
	   }
	   else
	   {
		 return false;
	   }
	}
	
	public function add_bank($data)
	{
		$this->db->trans_begin();
		$this->db->where('employee_id',$data['employee_id']);
		$this->db->where('add_stat <','12');
		$this->db->update('employee',array('add_stat'=>12));
		$this->db->where('employee_id',$data['employee_id']);
		unset($data['employee_id']);
		$this->db->update('employee_bank',$data);
		
		//echo $this->db->last_query();
		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			return false;
		}
		else
		{
			$this->db->trans_commit();
			return true;
		}
	}
	
	public function report_duplicate($emp_id,$sub_id,$id=0)
	{
		$this->db->select('report_id');
		$this->db->from('emp_reportto');
		$this->db->or_where('(emp_sup_employeee_id='.$emp_id.' AND emp_sub_employeee_id='.$sub_id.')');
		$this->db->or_where('(emp_sup_employeee_id='.$sub_id.' AND emp_sub_employeee_id='.$emp_id.')');
		if($id!=0)
		{
			$this->db->where('report_id <> ',$id);
		}
		$query = $this -> db -> get();
		if($query -> num_rows() >= 1)
		{
			return $query->result_array();
		}
		else
		{
		return false;
		}	
	}
	public function reportto_employee($id)
	{
	   $this->db->select('a.*,b.*,a.employee_id as emp_id,a.joined_date as join_date,c.*');
	   $this->db->from('employee as a');
	  
	   $this->db->join('emp_reportto as c','a.employee_id = c.emp_sup_employeee_id OR a.employee_id = c.emp_sub_employeee_id ','LEFT');
	    $this->db->join('users as b','a.employee_id = b.employee_id','LEFT');
	  /* $this->db->join('emp_reportto as d','a.employee_id = b.emp_sub_employeee_id','LEFT');*/
	   $this->db->where('a.employee_deleted','0');
	   $this->db->where('a.add_stat >=','1');
	   $query = $this -> db -> get();
	  
	   if($query -> num_rows() >= 1)
	   {
		 return $query->result_array();
	   }
	   else
	   {
		 return false;
	   }
	}
	public function select_employeereportto($id)
	{
	   $this->db->select('a.*,b.*,a.employee_id as emp_id,a.joined_date as join_date');
	   $this->db->from('employee as a');
	   $this->db->join('users as b','a.employee_id = b.employee_id','LEFT');
	  /* $this->db->join('emp_reportto as d','a.employee_id = b.emp_sub_employeee_id','LEFT');*/
	   $this->db->where('a.employee_deleted','0');
	   $this->db->where('a.add_stat >=','1');
	   $this->db->where('a.employee_id <>',$id);
	   $query = $this -> db -> get();
	  
	   if($query -> num_rows() >= 1)
	   {
		 return $query->result_array();
	   }
	   else
	   {
		 return false;
	   }
	}
	public function remove_report($id)
	{
		
		$this->db->where('report_id',$id);
		$this->db->delete('emp_reportto');	
	
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
	public function emp_supervisor($id)
	{
		$this->db->select('a.*,d.*,a.employee_id as emp_id,a.joined_date as join_date,c.*');
	   $this->db->from('employee as a');
	  
	   $this->db->join('emp_reportto as c','a.employee_id = c.emp_sup_employeee_id ','LEFT');
	     $this->db->join('emp_reporting_method as d','d.reporting_method_id = c.emp_reporting_method');
	   
		$this->db->where('c.emp_sub_employeee_id',$id);
		$query = $this -> db -> get();
		
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return false;
	    }
	}
	public function emp_subordinates($id)
	{
		$this->db->select('a.*,a.employee_id as emp_id,a.joined_date as join_date,c.*,d.*');
	   $this->db->from('employee as a');
	  
	   $this->db->join('emp_reportto as c','a.employee_id = c.emp_sub_employeee_id ','LEFT');
	   $this->db->join('emp_reporting_method as d','d.reporting_method_id = c.emp_reporting_method');
	   	$this->db->where('c.emp_sup_employeee_id',$id);
		$query = $this -> db -> get();
		
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result();
	    }
	    else
	    {
		  return FALSE;
	    }
	}
	
}