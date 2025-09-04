<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Common_model extends CI_Model
{
	public function country_list()
	{
		$this -> db -> select('*');
		$this -> db -> from('countries');
		$this->db->where('countries_removed',0);
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
	public function country_list1()
	{
		$this -> db -> select('*');
		$this -> db -> from('countries');
		$this->db->where('countries_removed',0);
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
	public function fetch_contents($table_name,$data)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($data);
		$this->db->where($table_name.'_removed','0');
		$query = $this -> db -> get();
	    if($query -> num_rows())
	    {
	   	  return $query->result_array();
		 
		 
	    }
	    else
	    {
		 return false;
	    }
	}
	/**
	* @author BYZ0004
	* Common Get result any single table with condition or all rows
	* @param string $table_name  Contains Tablename
	* @param array $where_data optional array contains where condition columnname=>value n number of items
	* @param string $select  optional data to retrieved for table example * or table_field1, table_field2 or leave it blank
	* @param string $group_by  optional group by particular column example table_field1,table_field2
	* @param string $order_by  optional  order by example tablefield asc, table_field1 desc etc
	* 
	* @return mixed  boolean or array
	*/
	public function __fetch_contents($table_name,$where_data=array(),$select='*',$group_by='',$order_by='')
	{
		$this->db->select($select);
		$this->db->from($table_name);
		$this->db->where($where_data);
		$this->db->group_by($group_by);
		if($order_by!='')
		{
			$this->db->order_by($order_by);	
		}
		
//		$this->db->where($table_name.'_removed','0');
		$query = $this -> db -> get();
		//var_dump($this->db->last_query());
		//var_dump($this->db->last_query());
	    if($query -> num_rows())
	    {
	   	  return $query->result_array();
		 
		 
	    }
	    else
	    {
		 return false;
	    }
	}
	
	public function insert_table($table_name,$data)
	{
		/*var_dump($data);*/
		$this->db->insert($table_name,$data);
		
		return $this->db->affected_rows() > 0;
		
	}
	public function delete_table($table_name,$data)
	{
		/*var_dump($data);*/
		$this->db->delete($table_name,$data);
		
		return $this->db->affected_rows() > 0;
		
	}

	public function update_table($table_name,$data,$id)
	{
		$this->db->where($table_name.'_id',$id);
		$this->db->update($table_name,$data);
		if($this->db->_error_message())
		{
			return false;
		}
		return true;
		
	}
	public function update_table_custom($table_name,$data,$where_data)
	{
		$this->db->where($where_data);
		$this->db->update($table_name,$data);
		
		if($this->db->_error_message())
		{
			return false;
		}
		return true;
		
	}

	public function dublicate_check($table_name,$array)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($array);
		$this->db->where($table_name.'_removed','0');
		
		$query=$this->db->get();
		//var_dump($this->db->last_query());
		/*echo $this->db->last_query();*/
		if($query->num_rows())
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	public function __dublicate_check($table_name,$array)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($array);
		/*$this->db->where($table_name.'_removed','0');*/
		
		$query=$this->db->get();
		//var_dump($this->db->last_query());
		/*echo $this->db->last_query();*/
		if($query->num_rows())
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	public function edit_dublicate_check($table_name,$array,$id)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($array);
		$this->db->where($table_name.'_removed','0');
		$this->db->where($table_name.'_id <> ',$id);
		
		$query=$this->db->get();
		
		if($query->num_rows())
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	public function __edit_dublicate_check($table_name,$array,$column,$id)
	{
		$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($array);
		$this->db->where($column." <> ",$id);
		$query=$this->db->get();
		
		if($query->num_rows())
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}

	public function insert_table_lastid($table_name,$data)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
		
	}
	public function permission_check($url)
	{
		$this->db->select('b.permission_id');
		$this->db->from('page as a');
		$this->db->join('permission as b','b.page_id=a.page_id');
		$this->db->where('page_url',$url);
		$query = $this -> db -> get();
		//var_dump($this->db->last_query());
	    if($query -> num_rows() >= 1)
	    {
		  return $query->result_array();
		 
	    }
	    else
	    {
		  return FALSE;
	    }
	}
	public function password_update($password,$forget_id,$user_id)
	{
		$this->db->trans_begin();
		$this->db->where('user_id',$user_id);
		$this->db->update('users',array('password'=>md5($password)));
		$this->db->where('reset_password_id',$forget_id);
		$this->db->update('reset_password',array('reset_completed'=>1));
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

	//Admin from city STATEMENT_TRACE
	public function state_list_all()
	{
	   $this->db->select('a.*,b.*');
	   $this->db->from('state as a');
	   $this->db->join('countries as b','a.country_id=b.country_id');
	   $this->db->where('a.state_removed','0');
	   $this->db->order_by('a.state_name', 'ASC');
	   
	   $query = $this -> db -> get();
	   //var_dump($this->db->last_query());
	   if($query -> num_rows())
	   {
	   	 return $query->result_array();
		 
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	public function state_list($coutry_id)
	{
	   $this->db->select('a.*,b.*');
	   $this->db->from('state as a');
	   $this->db->join('countries as b','a.country_id=b.country_id');
	   $this->db->where('a.country_id',$coutry_id);
	   $this->db->where('a.state_removed','0');
	   $this->db->order_by('a.state_name', 'ASC');
	   $query = $this -> db -> get();
	  
	   if($query -> num_rows())
	   {
	   	 
	   	 return $query->result_array();
	   	 
		 
		 
	   }
	   else
	   {
		 return false;
	   }
	}
	public function city_list_all()
	{
	   $this->db->select('a.*,b.*,c.*');
	   $this->db->from('city as a');
	   $this->db->join('state as b','a.state_id = b.state_id');
	   $this->db->join('countries as c','b.country_id = c.country_id');
	   $this->db->where('a.city_removed','0');
	   $this->db->order_by('city_name', 'ASC');
	   
	   $query = $this -> db -> get();
	   if($query -> num_rows())
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
	* @param string $table_name
	* @param array $array
	* 
	* @return
	*/
	public function insert_multiple($table_name,$array)
	{
		$this->db->trans_begin();
		$this->db->insert_batch($table_name,$array);
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
	public function city_list($state_id)
	{
	   $this->db->select('a.*,b.*,c.*');
	   $this->db->from('city as a');
	   $this->db->join('state as b','a.state_id = b.state_id');
	   $this->db->join('countries as c','b.country_id = c.country_id');
	   $this->db->where('a.state_id',$state_id);
	   $this->db->where('a.city_removed','0');
	   $this->db->order_by('a.city_name', 'ASC');
	   $query = $this -> db -> get();
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
