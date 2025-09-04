<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class settings_model extends CI_Model
{
	public function giro_list()
	{
		$this->db->select('a.*,b.*');
		$this->db->from('giro_setup as a');
		$this->db->join('bank_list as b','a.giro_setup_bank = b.bank_list_id','LEFT');
		$this->db->where('giro_setup_removed',0);
		$query=$this->db->get();
		if($query -> num_rows() >= 1)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}
	public function salary_list_cpf($month)
	{
		$this->db->select('s.*,a.*,c.ei_permit_type,c.ei_permit_number,b.emp_salary_levy_amt');
		$this->db->from('salary_master as s');
	   	$this->db->join('employee as a','s.employee_id=a.employee_id');
	   	$this->db->join('employee_immigration as c','s.employee_id=c.employee_id');
	   	$this->db->join('employee_salary as b','s.employee_id=b.employee_id');
	   	$this->db->where('a.employee_deleted','0');
	   	$this->db->where('a.add_stat >=','1');
	  	$where="(`c`.`ei_permit_type`=".singapore_citizen." OR `c`.`ei_permit_type`=".permenant_resitent.")";
	  	 $this->db->where($where);
	  	 $this->db->where('s.salary_master_removed',0);
	   $this->db->where('s.salary_master_month',$month);
	  
	   /*$this->db->or_where('c.ei_permit_type',permenant_resitent);*/
	   $query = $this -> db -> get();
	 //var_dump($this->db->last_query());
	   if($query -> num_rows() >= 1)
	   {
		 return $query->result_array();
	   }
	   else
	   {
		 return false;
	   }
	}
	public function salary_list_all($month)
	{
		$this->db->select('s.*,a.*,c.ei_permit_type,c.ei_permit_number,b.emp_salary_levy_amt');
		$this->db->from('salary_master as s');
	   $this->db->join('employee as a','s.employee_id=a.employee_id');
	   $this->db->join('employee_immigration as c','s.employee_id=c.employee_id');
	   $this->db->join('employee_salary as b','s.employee_id=b.employee_id');
	   $this->db->where('a.employee_deleted','0');
	   $this->db->where('a.add_stat >=','1');
	   $where="(`c`.`ei_permit_type`=".singapore_citizen." OR `c`.`ei_permit_type`=".permenant_resitent.")";
	  /* $this->db->where($where);*/
	   $this->db->where('s.salary_master_removed',0);
	   $this->db->where('s.salary_master_month',$month);
	  
	   /*$this->db->or_where('c.ei_permit_type',permenant_resitent);*/
	   $query = $this -> db -> get();
	 //var_dump($this->db->last_query());
	   if($query -> num_rows() >= 1)
	   {
		 return $query->result_array();
	   }
	   else
	   {
		 return false;
	   }
	}
	
}