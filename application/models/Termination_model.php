<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 class Termination_model extends CI_Model
{
	public function terminate_employee($data)
	{
		$this->db->trans_begin();
		$this->db->insert('termination',$data);
		$id=$this->db->insert_id();
		$data1['termination_id']=$id;
		$data2['emp_job_end_date']=$data['termination_date'];
		$this->db->where('employee_id',$data['termination_emp_id']);
		$this->db->update('employee',$data1);
		$this->db->where('employee_id',$data['termination_emp_id']);
		$this->db->update('employee_job_details',$data2);
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