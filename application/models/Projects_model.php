<?php
Class Projects_model extends CI_Model
{
	public function list_projects()
	{
		$this->db->select('a.*');
		$this->db->from('projects as a');
		$this->db->where('project_removed',0);
		$this->db->where('project_blocked',0);
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
	public function list_location($project_id=0)
	{
		$this->db->select('a.*,b.project_title');
		$this->db->from('location as a');
		$this->db->join('projects as b','a.project_id=b.project_id');
		$this->db->where('location_removed',0);
		$this->db->where('location_blocked',0);
		if($project_id!=0)
		{
			$this->db->where('a.project_id',$project_id);	
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
	public function check_projects($project_title)
	{
		$this->db->select('a.*');
		$this->db->from('projects as a');
		$this->db->where('project_removed',0);
		$this->db->where('project_blocked',0);
		$this->db->where('project_title',$project_title);
		$query = $this -> db -> get();
	    if($query -> num_rows() >= 1)
	    {
			
			
		  return true;
		  
	    }
	    else
	    {
		  return false;
	    }
	}
	public function check_projects_edit($project_title,$project_id)
	{
		$this->db->select('a.*');
		$this->db->from('projects as a');
		$this->db->where('project_removed',0);
		$this->db->where('project_blocked',0);
		$this->db->where('project_id <>',$project_id);
		$this->db->where('project_title',$project_title);
		
		$query = $this -> db -> get();
		
	    if($query -> num_rows() >= 1)
	    {
			
			
		  return true;
		  
	    }
	    else
	    {
		  return false;
	    }
	}
	public function add_project($data)
	{
		$this->db->trans_begin();
		$this->db->insert('projects',$data);
		
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
	public function add_location($data_array)
	{
		$this->db->trans_begin();
		$status=0;
		foreach($data_array as $data)
		{
		$this->db->insert('location',$data);
		
		if ($this->db->trans_status() === FALSE)
		{
			$status=1;
		}
		}
		if($status==1)
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
	public function get_project_details($id)
	{
		$this->db->select('a.*');
		$this->db->from('projects as a');
		$this->db->where('a.project_id',$id);
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
	public function update_project_details($project_id,$data)
	{
		$this->db->trans_begin();
		$this->db->where('project_id',$project_id);
		$this->db->update('projects',$data);
		
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
	public function update_location($location_id_array,$data_array)
	{
		$this->db->trans_begin();
		$status=0;
		for($i=0;$i<count($location_id_array);$i++)
		{
		$this->db->where('location_id',$location_id_arrray[$i]);
		$this->db->update('location',$data_array[$i]);
		
		if ($this->db->trans_status() === FALSE)
		{
			$status=1;
		}
		}
		if($status==1)
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
	public function delete_location($location_id,$data)
	{
		$this->db->trans_begin();
		$this->db->where('location_id',$location_id);
		$this->db->update('location',$data);
		
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