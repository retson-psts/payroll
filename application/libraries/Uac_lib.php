<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Uac_lib
{
   private $byzero;
   function __construct()
   {
	 $this->byzero = & get_instance();
	 $this->byzero->load->model(array('uac_model'));
   }
   /*public function check_user_permission($user_id=0,$page_name='')
   {
	   if($this->byzero->user->user_id_check($user_id)==TRUE)
	   {
		  $permission_info=$this->byzero->uac_model->page_permission($user_id,$page_name); 
		  if($permission_info==TRUE)
		  {
			  return true;
		  }
		  else
		  {
			  return false;
		  }
	   }
	   else
	   {
		   return false;
	   }
   }*/
   
   
}