<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('sanitize_display1'))
{
    function sanitize_display1($result)
	{
		if($result!==FALSE)
		{
		//	var_dump($result);
		
		foreach($result as $key=>$item)
		{
			if(is_array($item))
			{
				foreach($item as $key1=>$item1)
				{
					if(is_array($item1))
					{
						foreach($item1 as $key2=>$item2)
						{
							
							if(is_array($item1))
							{
								foreach($item2 as $key3=>$item3)
								{
									if(is_array($item2))
									{
										
									}
									else
									{
										$result[$key][$key1][$key2][$key3]=sanitize_input1($item3);
									}
									
								}
								
							}
							else
							{
								$result[$key][$key1][$key2]=sanitize_input1($item2);
								
							}
							
						}
						
					}
					else
					{
						$result[$key][$key1]=sanitize_input1($item1);
					}
				}
			}
			else
			{
				$result[$key]=sanitize_input1($item);
			}
		}
		return $result;
		}
		else
		{
			return $result;
		}
	}
}
if ( ! function_exists('sanitize_input1'))
{
	function sanitize_input1($input)
	{
		if($input=='0000-00-00')
		{
			return '';
		}
		if($input=='0')
		{
			return '';
		}
		if($input=='0000-00-00 00:00:00')
		{
			return '';
		}
		if($input==NULL)
		{
		 	return '';
		}
		else
		{
			//var_dump($input);
		   return $input;
		}
	}
}
if(! function_exists('licence_type'))
{
	function licence_type($id)
	{
		$array=array('1'=>'Class 1','2'=>'Class 2B','3'=>'Class 2A','4'=>'Class 2B','5'=>'Class 3','6'=>'Class 3A','7'=>'Class 4A','8'=>'Class 4','2'=>'Class 5');
		foreach($array as $key=>$item)
		{
			if($key==$id)
			{
				return $item;
			}
		}
		return '';
	}
}
/**
*  
* @param undefined $id
* 
* @return
*/
if(! function_exists('marital_status'))
{
	function marital_status($id)
	{
		$array=array('1'=>'Married','2'=>'Single','3'=>'Divorced','4'=>'Widow','5'=>'Widower');
		foreach($array as $key=>$item)
		{
			if($key==$id)
			{
				return $item;
			}
		}
		return '';
	}
}
if(! function_exists('format_date_custom'))
{
	function format_date_custom($date_time,$newformat='d-M-Y',$oldformat='Y-m-d')
	{
		 $value = '';
        if ($date_time != '0000-00-00' && $date_time != '0000-00-00 00:00:00' && $date_time!='')
        {
        	
            $date  = DateTime::createFromFormat($oldformat, $date_time);
            $value = $date->format($newformat);
        }
        return $value;
	}
}
if(! function_exists('gender_name'))
{
	function gender_name($id)
	{
		 switch($id)
		 {
		 	case 1: return 'Male';
		 	case 2: return 'Female';
		 	case 3: return 'Female';
		 }
		 return '';
	}
}

if(!function_exists('calculate_age'))
{
	/**
	* @author U1
	* @abstract to find the Age 
	* @param date $birth_date
	* @param date $current_date
	* 
	* @return
	*/
    function calculate_age($birth_date,$current_date='')
	{
		if(empty($current_date))
		{
			$current_date=date('Y-m-d');
		}
		$dob = new DateTime($birth_date);
		$now = new DateTime($current_date);
		return $now->diff($dob)->y;
	}
}

if(!function_exists('per_day_hour'))
{
	function per_day_hour($salary,$weekly_hours)
	{
		$data= array();
		$data['per_day']=(($salary*12)/52)/7;
		$data['per_hour']=(($salary*12)/52)/$weekly_hours;
		return $data;
		
		
	}
	
}