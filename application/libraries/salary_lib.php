<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_lib 
{
   private $byzero;
   public function __construct()
   {
	 $this->byzero = & get_instance();
	 $this->byzero->load->model(array('salary_model'));
   }
   public function per_hour_salary($salary_for_month)
   {
	   return $salary_for_month;
   }
   
}