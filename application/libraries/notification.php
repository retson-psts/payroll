<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Notification 
{
   private $byzero;
   public function __construct()
   {
	 $this->byzero = & get_instance();
   }
  public function get_birthdays($month,$year)
  {
  	$res=$this->byzero->common_model->__fetch_contents('employee',array('month(emp_birthday)'=>$month,'employee_deleted'=>0));
  	$res_array=array();
  	if(!empty($res))
  	{	
	  	foreach($res as $key=>$row)
	  	{
			$res_array[$key]['title']=$row['emp_firstname']." ".$row['emp_lastname']."'s Birthday";
			$date=new dateTime($row['emp_birthday']);
			$res_array[$key]['start']=date('Y').$date->format('-m-d');
			$res_array[$key]['description']="21 year completed";
			$res_array[$key]['backgroundColor']="#f39c12";
			$res_array[$key]['borderColor']="#f39c12";
			$res_array[$key]['id']="b";
			$res_array[$key]['allDay']=1;
		}
	}
	return $res_array;
	  	
  }
  public function passport_expiry($month,$year)
  {
  	$this->byzero->load->model('notification_model');
  	$start=date('Y-m-d');
  	$end=$year."-".$month."-".date('d');
  	$end=new dateTime($end);
  	$end->modify('+3 MONTH');
  	$end1=$end->format('Y-m-d');
  	$res=$this->byzero->notification_model->passport_expiry($start,$end1);
  	$res_array=array();
  	if(!empty($res))
  	{	
	  	foreach($res as $key=>$row)
	  	{
			$res_array[$key]['title']=$row['emp_firstname']." ".$row['emp_lastname']."'s Passport Expiring ";
			$date=new dateTime($row['ep_permit_expirydate']);
			$res_array[$key]['start']=$date->format('Y-m-d');
			$res_array[$key]['description']="Passport Will Expired on ".$date->format('d M, Y');
			$res_array[$key]['backgroundColor']="#f39c12";
			$res_array[$key]['borderColor']="#f39c12";
			$res_array[$key]['id']="pe";
			$res_array[$key]['allDay']=1;
		}
	}
	return $res_array;
  }
   public function passport_expired($month,$year)
  {
  	$this->byzero->load->model('notification_model');
  	$start=date('Y-m-d');
  	$end=$year."-".$month."-".date('d');
  	$end=new dateTime($end);
  	$end->modify('+3 MONTH');
  	$end1=$end->format('Y-m-d');
  	$res=$this->byzero->notification_model->passport_expiry($start,$end1);
  	$res_array=array();
  	if(!empty($res))
  	{	
	  	foreach($res as $key=>$row)
	  	{
			$res_array[$key]['title']=$row['emp_firstname']." ".$row['emp_lastname']."'s Passport Expiring ";
			$date=new dateTime($row['ep_permit_expirydate']);
			$res_array[$key]['start']=$date->format('Y-m-d');
			$res_array[$key]['description']="Passport  Expired at ".$date->format('d M, Y');
			$res_array[$key]['backgroundColor']="#f39c12";
			$res_array[$key]['borderColor']="#f39c12";
			$res_array[$key]['id']="pex";
			$res_array[$key]['allDay']=1;
		}
	}
	return $res_array;
  }
   
}