<?php
class MY_Form_validation extends CI_Form_validation
{
  function __construct($config = array())
  {
    parent::__construct($config);
  }

  function error_array()
  {
    if (count($this->_error_array) === 0)
      return FALSE;
    else
      return $this->_error_array;
  }
  function decrypt_validate($id)
  {
	$id=encryptor('decrypt',$id);
	if(!empty($id) && is_numeric($id) )
    {
    	return TRUE;
    		
	}
	else
	{
		$this->set_message('decrypt_validate', 'Passing Value not correct');
		return FALSE;
		
	}
  }
  function validateDate($date, $format = 'Y-m-d')
{
	    $d = DateTime::createFromFormat($format, $date);
    	return $d && $d->format($format) == $date;
}
function datevalidate($date, $format = 'Y-m-d')
{
	    $d = DateTime::createFromFormat($format, $date);
    	if( $d && $d->format($format) == $date)
    	{
			
		}
		else
		{
			$this->form_validation->set_message('datevalidate', 'Not Valid date');
			return FALSE;
			
		}
}
	  function month_validate($date)
	  {
	  	
	  	
			if($this->validateDate($date,'Y-m'))
			{
			$date = DateTime::createFromFormat('Y-m', $date);
			$date2=new DateTime();
			if($date<=$date2)
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('month_validate', 'Given month not valid');
				return FALSE;
			}
			}
			else
			{
					$this->form_validation->set_message('month_validate', 'month not valid');
					return FALSE;
				
			}
		
		
	}
	function date_range_validator($str,$format='Y-m-d')
	{
		if(!empty($str))
		{
			$dates=explode(' - ',$str);
		    if(!empty($dates) && (count($dates)==2))
		    {
				$status=(DateTime::createFromFormat($format, $dates[0]) !== false);
				$status1=(DateTime::createFromFormat($format, $dates[1]) !== false);
				if($status1 && $status)
				{
					return TRUE;
				}
				else
				{
					$this->set_message('date_range_validator', 'Date Range Not valid');
					return FALSE;
				}
			}
			else
			{
				$this->set_message('date_range_validator', 'Date Range Not valid');
				return FALSE;
			}
		
		}
		else
		{
			return TRUE;
		}
	}
}