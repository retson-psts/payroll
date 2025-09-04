<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Deduction_model extends CI_Model
{
	/**
	*
	*  @author BYZ0004
	*  find Previously added Deduction with given condition
	* 
	*  @param int $emp_id  Employee_id
	* @param string $month with exact date format Y-m-d(2015-09-29)
 	* @param int $deduction_category Optional Numeric value
	* 
	* @return mixed FALSE OR ARRAY
	*/
	public function previous_deducted($emp_id,$month,$deduction_category=0)
	{
		$this->db->select('a.sld_id,a.sld_amount,a.sld_from,a.salary_month,b.dec_name,a.sld_notes');
		$this->db->from('salary_deduction as a');
		$this->db->join('deduction_category as b','a.sld_dec_id = b.dec_id');
		if(!empty($deduction_category))
		{
			$this->db->where('a.sld_dec_id',$deduction_category);		
		}
		if(!empty($month))
		{
			$this->db->where('a.salary_month',$month);			
		}
		if(!empty($emp_id))
		{
			$this->db->where('a.employee_id',$emp_id);		
		}
		$this->db->where('a.sld_removed',0);	
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
	/**
	*  @author BYZ0004
	*  List details for datatable
	* 
	*  @param int $emp_id  Employee_id
	* @param string $month with exact date format Y-m-d(2015-09-29)
 	* @param int $deduction_category Optional Numeric value
	* 
	* @return mixed FALSE OR ARRAY
	*/
	public function previous_list($emp_id=0,$month='',$deduction_category=0)
	{
		$this->db->select('a.sld_id,a.sld_amount,a.sld_from,a.salary_month,b.dec_name,a.sld_notes,c.emp_number,c.emp_lastname,c.emp_firstname');
		$this->db->from('salary_deduction as a');
		$this->db->join('deduction_category as b','a.sld_dec_id = b.dec_id');
		$this->db->join('employee as c','a.employee_id = c.employee_id');
		if(!empty($deduction_category))
		{
			$this->db->where('a.sld_dec_id',$deduction_category);		
		}
		if(!empty($month))
		{
			$this->db->where('a.salary_month',$month);			
		}
		if(!empty($emp_id))
		{
			$this->db->where('a.employee_id',$emp_id);		
		}
		$this->db->where('a.sld_removed',0);	
		$this->db->order_by('a.sld_id desc');	
		$query=$this->db->get();
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
	public function compare_total_deduction($data)
	{
		$this->db->select('sum(sld_amount) as total,emp_salary_amount');
		$this->db->from('salary_deduction as a');
		$this->db->join('employee_salary as b','a.employee_id = b.employee_id');
		$this->db->where('a.employee_id',$data['employee_id']);		
		$this->db->where('a.salary_month',$data['salary_month']."-01");			
		$this->db->where('a.sld_removed',0);	
		$this->db->group_by('salary_month');
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
	
}