<?php
Class Job_model extends CI_Model
{
	public function add_job_cat($data)
	{
		$this->db->trans_begin();
		$this->db->insert('job_category',$data);
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
	public function add_job_title($data)
	{
		$this->db->trans_begin();
		$this->db->insert('job_titles',$data);
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
	public function list_job_cat()
	{
		$this->db->select('*');
		$this->db->from('job_category');
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
	public function list_job_titles()
	{
		$this->db->select('a.*,b.*');
		$this->db->from('job_titles as a');
		$this->db->join('job_category as b','b.job_category_id=a.job_title_category','LEFT');
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
	public function get_job_cat_details($id)
	{
		$this->db->select('*');
		$this->db->from('job_category');
		$this->db->where('job_category_id',$id);
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
	public function get_job_title_details($id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('job_titles as a');
		$this->db->join('job_category as b','b.job_category_id=a.job_title_category','LEFT');
		$this->db->where('a.job_title_id',$id);
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
	public function update_job_cat_details($cat_id,$data)
	{
		$this->db->trans_begin();
		$this->db->where('job_category_id',$cat_id);
		$this->db->update('job_category',$data);
		//echo $this->last_query();
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
	
	public function update_job_title_details($job_id,$data)
	{
		$this->db->trans_begin();
		$this->db->where('job_title_id',$job_id);
		$this->db->update('job_titles',$data);
		//echo $this->last_query();
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
	public function currency_list()
	{
		$this->db->select('*');
		$this->db->from('currency_type');
		$this->db->order_by('currency_name','asc');
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
	public function pay_period()
	{
		$this->db->select('*');
		$this->db->from('pay_period');
		//Added By This Line BYZ0004
		$this->db->where('payperiod_removed',0);
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
	public function reporting_methods()
	{
		$this->db->select('*');
		$this->db->from('emp_reporting_method');
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