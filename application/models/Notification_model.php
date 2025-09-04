<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Notification_model extends CI_Model
{
	/**
	* @author U1
	* @abstact To find the number of employees passport will be expiring next three months
	* @param date $start(current_date)
	* @param date $end(Current_date+ 3months)
	* 
	* @return array of employee list with expiry date
	*/
	public function passport_expiry($start,$end)
	{
		$this->db->select('*');
		$this->db->from('employee_passport as a');
		$this->db->join('employee as b','a.ep_employee_id=b.employee_id');
		$this->db->where('b.employee_deleted',0);
		$this->db->where('ep_permit_expirydate >=', $start);
		$this->db->where('ep_permit_expirydate <=', $end);
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
	/**
	* @author U1
	* @abstract To find expired passport list from 
	* @param date $current_date
	* 
	* @return
	*/
	public function passport_expired($current_date)
	{
		$this->db->select('*');
		$this->db->from('employee_passport as a');
		$this->db->join('employee as b','a.ep_employee_id=b.employee_id');
		$this->db->where('b.employee_deleted',0);
		$this->db->where('ep_permit_expirydate <=', $current_date);
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
	
}
