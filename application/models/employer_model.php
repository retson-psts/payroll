<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Employer_model extends CI_Model
{
	/**
	* Yuvaraj Adding New methods===================================================
	*/
	public function add_employer($data)
	{
		//checking edit or adding employee
		//var_dump($data['employee_id']);
		
			// checking enable login added
			
				$data1['username']=$this->db->escape_str($data['employer_username']);
				$data1['password']=$this->db->escape_str(md5($data['employer_password']));
				$data1['first_name']=$data['employer_firstname'];
				$data1['last_name']=$data['employer_lastname'];
				$data1['email']=$data['employer_email'];
				$data1['verified']=1;
				$data1['group_id']=3;
				if(isset($data['employer_photo']))
				{
					$data1['photo_url']=$data['employer_photo'];
				}
				unset($data['employer_username']);
				unset($data['employer_password']);
				unset($data['employer_cpassword']);
				$this->db->trans_begin();
				$this->db->insert('users',$data1);
				$id=$this->db->insert_id();
				$data['user_id']=$id;
				$this->db->insert('employer',$data);
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
	public function edit_employer($data,$user_id,$employer_id)
	{
		//checking edit or adding employee
		//var_dump($data['employee_id']);
		
			// checking enable login added
			
				$data1['username']=$this->db->escape_str($data['employer_username']);
				$data1['password']=$this->db->escape_str(md5($data['employer_password']));
				$data1['first_name']=$data['employer_firstname'];
				$data1['last_name']=$data['employer_lastname'];
				$data1['email']=$data['employer_email'];
				$data1['verified']=1;
				$data1['group_id']=1;
				if(isset($data['employer_photo']))
				{
					$data1['photo_url']=$data['employer_photo'];
				}
				unset($data['employer_id']);
				unset($data['user_id']);
				unset($data['employer_username']);
				unset($data['employer_password']);
				unset($data['employer_cpassword']);
				$this->db->trans_begin();
				$this->db->where('user_id',$user_id);
				$this->db->update('users',$data1);
				//$id=$this->db->insert_id();
				//$data['user_id']=$id;
				$this->db->where('employer_id',$employer_id);
				$this->db->update('employer',$data);
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
	public function list_employers()
	{
	   $this->db->select('a.*,b.*,a.user_id as user');
	   $this->db->from('employer as a');
	   $this->db->join('users as b','a.user_id = b.user_id','LEFT');
	   $this->db->where('a.employer_removed','0');
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
	public function employer_details($id=0)
	{
	   $this->db->select('a.*,b.*,a.user_id as user');
	   $this->db->from('employer as a');
	   $this->db->join('users as b','a.user_id = b.user_id','LEFT');
	   $this->db->where('a.employer_removed','0');
	   $this->db->where('a.employer_id',$id);
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
	
	
	
}