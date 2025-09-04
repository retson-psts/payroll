<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Common_lib 
{
   private $byzero;
   public function __construct()
   {
	 $this->byzero = & get_instance();
	 //Yuvi added
/*	 date_default_timezone_set('Asia/Kolkata');*/
	 //$this->byzero->load->model(array('uac_model'));
   }
   public function check_user_permission($user_id=0,$page_name='')
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
   }
   public function unset_specific_userdata($userdata_name,$userdata_array_name)
   {
	  $shortlist = $this->byzero->session->userdata($userdata_name);
	  unset($shortlist[$userdata_array_name]);
	  $this->byzero->session->set_userdata($userdata_name,$shortlist);
   }
   public function dispaly_error_msg($message_type,$message)
   {
	   //$message_type 1 = success , 2 = fail
	     
   }
   public function format_time($date_time,$format,$rformat)
   {
		$value='';
		if($date_time!='0000-00-00' || $date_time!='0000-00-00 00:00:00')
		{
			$date = DateTime::createFromFormat($format, $date_time);
			$value=$date->format($rformat);
		}
		return $value;
		
		
   }
    public function options($id_value,$value,$array)
   {
   	$string="<option value=''>Select</option>";
   	$none="<option value=''>None</option>";
   	if(empty($array))
   	{
		return $none;
	}
	else
	{
		foreach($array as $item)
   	{
		$string.="<option value='".$item[$id_value]."'>".$item[$value]."</option>";
	}
	  return $string;
	}
   	
   }

   /**
   * 
   * @param int $id
   * @param string $value
   * @param array $array
   * @param  int $value
   * 
   * @return string contains  filloption
   */
   public function options_select($id_value,$value,$array,$match_id)
   {
   	$string="<option value=''>Select</option>";
   	$none="<option value=''>None</option>";
   	if(empty($array))
   	{
		return $none;
	}
	else
	{
		foreach($array as $item)
   	{
   		if($item[$id_value]==$match_id)
   		{
			$string.="<option selected='selected' value='".$item[$id_value]."'>".$item[$value]."</option>";	
		}
		else
		{
			$string.="<option  value='".$item[$id_value]."'>".$item[$value]."</option>";	
		}
		
	}
	  return $string;
	}
   	
   }
   
   
}