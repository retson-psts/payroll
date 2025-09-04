<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Job_lib 
{
   private $byzero;
   public function __construct()
   {
	 $this->byzero = & get_instance();
	 $this->byzero->load->model(array('job_model'));
   }
   public function job_cat_list()
   {
	   return $this->job_model->list_job_cat();
   }
}