<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Iras extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	  // $this->load->model();
    }
	public function index()
	{
		if(isset($this->session->userdata['cpfsumbit']))
		{
			$this->session->unset_userdata('cpfsubmit');	
		}
		
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['csn']=$this->common_model->__fetch_contents('csn');
		$data['message_div']="";
		$data['menu']=15;
		$data['menu1']=152;
		$data['page_title']="CPF eSubmit Monthly Submitting";
		$this->load->model('employer_model');
		
		$this->load->view('header',$data);
	    $this->load->view('side_menu_admin',$data);
	    $this->load->view('iras-view',$data);
	    $this->load->view('footer');
	}
	public function display_iras()
	{
		$this->load->library('form_validation');
		if ($this->input->is_ajax_request())
    	{
    		
    	if($this->form_validation->run('iras/iras_display'))
		{
			$data=$this->input->post();
			$csn=$data['CSN'];
			$this->load->model('settings_model');
			$month=$data['month']."-01";
			$salary=$this->settings_model->salary_list_cpf($month);
			/*$salary_all=$this->settings_model->salary_list_all($month);*/
			/*$salary=$salary_all;*/
			//$salary=array();
			if($salary!==FALSE)
			{
				$result['cpf_total']=0;
				$result['mbmf_total']=0;
				$result['sinda_total']=0;
				$result['cdac_total']=0;
				$result['ecf_total']=0;
				$result['mbmf_count']=0;
				$result['sinda_count']=0;
				$result['cdac_count']=0;
				$result['ecf_count']=0;
				$result['cc_count']=0;
				$result['cc_total']=0;
				$result['sdl_total']=0;
				$result['levy_total']=0;
				$low_sdl_count=0;
				$high_sdl_count=0;
				$medium_sdl_total=0;
			foreach($salary as $key=>$item)
			{
				
				$test_t=0;
				
				$salary[$key]['employee_id']=$item['employee_id'];
				$salary[$key]['emp_number']=$item['emp_number'];
				$salary[$key]['emp_firstname']=$item['emp_firstname'];
				$salary[$key]['emp_lastname']=$item['emp_lastname'];
				$salary[$key]['cpf_employee']=$item['cpf_employee'];
				$salary[$key]['cpf_employer']=$item['cpf_employer'];
				$salary[$key]['net_pay']=$item['net_pay'];
				$salary[$key]['cdac']=$item['cdac'];
				$salary[$key]['sinda']=$item['sinda'];
				$salary[$key]['mbmf']=$item['mbmf'];
				$salary[$key]['ecf']=$item['ecf'];
				$salary[$key]['share']=$item['share'];
				$result['cpf_total']+=($item['cpf_employee']+$item['cpf_employer']);
				$test_array=array();
				$test_array1=array();
				if($item['cdac']!=0)
				{
					$result['cdac_count']++;
					$result['cdac_total']+=$item['cdac'];
					$test_array[]='cdac';
					$test_array1[]=$item['cdac'];
					
					$test_t+=$item['cdac'];
					
					
					
				}
				if($item['sinda']!=0)
				{
					$result['sinda_count']++;
					$result['sinda_total']+=$item['sinda'];
					$test_array[]='sinda';
					$test_array1[]=$item['sinda'];
					$test_t+=$item['sinda'];
					
				}
				if($item['mbmf']!=0)
				{
					$result['mbmf_count']++;
					$result['mbmf_total']+=$item['mbmf'];
					
					$test_array[]='mbmf';
					$test_array1[]=$item['mbmf'];
					$test_t+=$item['mbmf'];
				}
				if($item['ecf']!=0)
				{
					$result['ecf_count']++;
					$result['ecf_total']+=$item['ecf'];
					$test_array1[]=$item['ecf'];
					$test_array[]='ecf';
					$test_t+=$item['ecf'];
					
					
				}
				if($item['share']!=0)
				{
					$result['cc_count']++;
					$result['cc_total']+=$item['share'];
					$test_array1[]=$item['share'];
					$test_array[]='cc';
					$test_t+=$item['cc'];
					
					
				}


				//SDL Calculation
				if($item['total_wage1']<800)
				{
					$low_sdl_count++;
					$salary[$key]['sdl_emp']=2;
				}
				else if($item['total_wage1']>=800 && $item['total_wage1']<4500)
				{
					$medium_sdl_total+=$item['total_wage1'];
					$sdl_emp=($item['total_wage1']*0.25)/100;
					$salary[$key]['sdl_emp']=round($sdl_emp,2);
					
				}
				else if( $item['total_wage1']>=4500)
				{
					$high_sdl_count++;
					$salary[$key]['sdl_emp']=11.25;
				}
				
				$result['levy_total']+=$item['emp_salary_levy_amt'];
				
				$salary[$key]['levy_amt']=$item['emp_salary_levy_amt'];
				$salary[$key]['contri']=strtoupper(implode(',',$test_array));
				$salary[$key]['contriamt']=strtoupper(implode(',',$test_array1));
				$salary[$key]['contri_t']=$test_t;
				
				
			}
			
			$result['gtotal']=$result['cpf_total']+$result['mbmf_total']+$result['sinda_total']+$result['cdac_total']+$result['ecf_total'];
			$result['sdl_total']=($low_sdl_count*2)+(($medium_sdl_total*0.25)/100)+($high_sdl_count*11.25);
			$report  = array('status' => 1,'s'=>$salary,'t'=>$result,'csn'=>$csn);
			$session=array('s'=>$salary,'t'=>$result);
			$this->session->set_userdata('cpfsubmit',$session);
			echo json_encode($report);
			}
			else
			{
				$message = "Salary not generated or No employee available for cpf";
				$report  = array('status' => 0,'message' => $message);
				echo json_encode($report);
				exit;
			}
			
			
		}
		else
		{
			$message = $this->form_validation->error_array();
			$report  = array('status' => 0,'message' => $message);
			echo json_encode($report);
			exit;
		}
    	
    }
    else
    {
      show_error("No direct access allowed");
      //or redirect to wherever you would like
    }
	}
	public function download_iras()
	{
		$this->load->library('form_validation');
		if ($this->input->is_ajax_request())
    	{
		if ($this->form_validation->run('iras/download') !== false && isset($this->session->userdata['cpfsubmit']))
        {
        	$message ='';
        	$data=$this->session->userdata['cpfsubmit'];
        	$data['f']=$this->input->post();
        	$this->session->set_userdata('cpfsubmit',$data);
			$report  = array('status' => 1,'message' => $message,'url'=>site_path.'iras/download?csn='.$this->input->post('csn'));
			echo json_encode($report);
			exit;
        	
           
        }
        else
        {
        
       	$message = $this->form_validation->error_array();
		$report  = array('status' => 0,'message' => $message);
		echo json_encode($report);
		exit;
        }
		}
		else
		{
			
		}
	}
	
	public function validateDate($date, $format = 'Y-m-d')
	{
	    $d = DateTime::createFromFormat($format, $date);
	    return $d && $d->format($format) == $date;
	}
	public function month_validate($date)
  	{
  	
	if($date=='')
	{
	    return TRUE;	
	}
	else
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
	
}
	
	
	public function download()
	{
		   $this->load->helper('custom_helper');
           $csnid=$this->input->get('csn');
           $csnarray=$this->common_model->__fetch_contents('csn',array('csn_id'=>$csnid));
           $csn=$csnarray[0]['csn_roc'];
           $payemnt_type="PTE";//3 character
           $uen=$csn;//10 character
           $sno="01";
           $download_type="F";
           $advice_code="04";
           $dateh=date('YmdHis');
           $datem=date('Ym');
           $datet=date('YM');
           $sno='01';
           $total_records=3;
           $data=$this->session->userdata('cpfsubmit');
           $s='';
           $emp_type='E';
          
           $filename=strtoupper($csn).strtoupper($datet).$advice_code.'.txt';
           $txtheader=$download_type.' '.$csn.$payemnt_type.$sno.' '.$advice_code.$dateh.'FTP.TXT'.str_pad($s, 103, " ", STR_PAD_LEFT);
           $txtsummary=$download_type.'0'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'01'.str_pad(($data['t']['cpf_total']*100), 12, "0", STR_PAD_LEFT).'0000000'.str_pad($s, 103, " ", STR_PAD_LEFT); 
           if($data['t']['mbmf_total']!=0)
           {
		   	$txtsummary.=$download_type.'0'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'02'.str_pad(($data['t']['mbmf_total']*100), 12, "0", STR_PAD_LEFT).str_pad(($data['t']['mbmf_count']), 7, "0", STR_PAD_LEFT).str_pad($s, 103, " ", STR_PAD_LEFT); 
		   	$total_records++;
		   }
           if($data['t']['sinda_total']!=0)
           {
		   	$txtsummary.=$download_type.'0'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'03'.str_pad(($data['t']['sinda_total']*100), 12, "0", STR_PAD_LEFT).str_pad(($data['t']['sinda_count']), 7, "0", STR_PAD_LEFT).str_pad($s, 103, " ", STR_PAD_LEFT); 
		   		$total_records++;
		   }
		   if($data['t']['cdac_total']!=0)
           {
		   	$txtsummary.=$download_type.'0'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'04'.str_pad(($data['t']['cdac_total']*100), 12, "0", STR_PAD_LEFT).str_pad(($data['t']['cdac_count']), 7, "0", STR_PAD_LEFT).str_pad($s, 103, " ", STR_PAD_LEFT); 
		   		$total_records++;
		   }
		   if($data['t']['ecf_total']!=0)
           {
		   	$txtsummary.=$download_type.'0'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'05'.str_pad(($data['t']['ecf_total']*100), 12, "0", STR_PAD_LEFT).str_pad(($data['t']['ecf_count']), 7, "0", STR_PAD_LEFT).str_pad($s, 103, " ", STR_PAD_LEFT); 
		   		$total_records++;
		   }
		   if($data['f']['cpf_late']!=0)
           {
		   	$txtsummary.=$download_type.'0'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'09'.str_pad(($data['f']['cpf_late']*100), 12, "0", STR_PAD_LEFT).'0000000'.str_pad($s, 103, " ", STR_PAD_LEFT); 
		   		$total_records++;
		   }
		   if($data['t']['levy_total']!=0)
           {
		   	$txtsummary.=$download_type.'0'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'08'.str_pad(($data['t']['levy_total']*100), 12, "0", STR_PAD_LEFT).'0000000'.str_pad($s, 103, " ", STR_PAD_LEFT); 
		   		$total_records++;
		   }
		   if($data['f']['fwl_late']!=0)
           {
		   	$txtsummary.=$download_type.'0'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'09'.str_pad(($data['f']['fwl_late']*100), 12, "0", STR_PAD_LEFT).'0000000'.str_pad($s, 103, " ", STR_PAD_LEFT);
		   		$total_records++; 
		   }
		   if($data['t']['cc_total']!=0)
           {
		   $txtsummary.=$download_type.'0'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'10'.str_pad(($data['t']['cc_total']*100), 12, "0", STR_PAD_LEFT).str_pad(($data['t']['cc_count']), 7, "0", STR_PAD_LEFT).str_pad($s, 103, " ", STR_PAD_LEFT); 
		   }
		   $txtsummary.=$download_type.'0'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'11'.str_pad(($data['t']['sdl_total']*100), 12, "0", STR_PAD_LEFT).'0000000'.str_pad($s, 103, " ", STR_PAD_LEFT); 
		   $txtdetails='';
		   
		   
		   foreach($data['s'] as $key=>$item)
		   {
		   	$employement_status='E';
		   	$cpf=$item['cpf_employee']+$item['cpf_employer'];
		   	$txtdetails.=$download_type.'1'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'01'.$item['emp_number'].str_pad(($cpf*100), 13, "0", STR_PAD_LEFT).str_pad(($item['ordinary_wage']*100), 8, "0", STR_PAD_LEFT).str_pad(($item['additional_wages']*100), 8, "0", STR_PAD_LEFT).$emp_type.substr(strtoupper($item['emp_firstname'].' '.$item['emp_lastname']),0,22).'N'.str_pad($s, 54, " ", STR_PAD_LEFT); 
			   	if($item['mbmf']!=0)
	           {
			   $txtdetails.=$download_type.'1'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'02'.$item['emp_number'].str_pad(($item['mbmf']*100), 13, "0", STR_PAD_LEFT).'0000000000000000 '.substr(strtoupper($item['emp_firstname'].' '.$item['emp_lastname']),0,22).' '.str_pad($s, 54, " ", STR_PAD_LEFT);
			   	$total_records++;
			   }
	           if($item['sinda']!=0)
	           {
			   	 $txtdetails.=$download_type.'1'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'03'.$item['emp_number'].str_pad(($item['sinda']*100), 13, "0", STR_PAD_LEFT).'0000000000000000 '.substr(strtoupper($item['emp_firstname'].' '.$item['emp_lastname']),0,22).' '.str_pad($s, 54, " ", STR_PAD_LEFT); 
			   		$total_records++;
			   }
			   if($item['cdac']!=0)
	           {
			   	$txtdetails.=$download_type.'1'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'04'.$item['emp_number'].str_pad(($item['cdac']*100), 13, "0", STR_PAD_LEFT).'0000000000000000 '.substr(strtoupper($item['emp_firstname'].' '.$item['emp_lastname']),0,22).' '.str_pad($s, 54, " ", STR_PAD_LEFT); 
			   		$total_records++;
			   }
			   if($item['ecf']!=0)
	           {
			   $txtdetails.=$download_type.'1'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'05'.$item['emp_number'].str_pad(($item['ecf']*100), 13, "0", STR_PAD_LEFT).'0000000000000000 '.str_pad(substr(strtoupper($item['emp_firstname'].' '.$item['emp_lastname']),0,22),22," ",STR_PAD_RIGHT).' '.str_pad($s, 54, " ", STR_PAD_LEFT); 
			   		$total_records++;
			   }
		   	
		   }
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   	
		  $txttrailer=$download_type.'9'.$csn.$payemnt_type.$sno.' '.$advice_code.$datem.'11'.str_pad(($data['t']['sdl_total']*100), 12, "0", STR_PAD_LEFT).'0000000'.str_pad($s, 108, " ", STR_PAD_LEFT);
           
           
          /* var_dump($txtdetails);
           var_dump($total_records);*/
           /*$filename=strtoupper($csn).strtoupper(format_date_custom($month,'MY','m-Y')).'01.txt';
           $txtheader="F ".$uen.$payemnt_type.$sno." ".date('mYdHis')."FTP.txt/r/n";
           $txtsummary1="F0".$uen.$payemnt_type.$sno.date('mY')."01".
           
           $finaltxt="F ".$uen.$payemnt_type.$sno." 0420080129183315FTP.DTL/r/nF0".$uen.$payemnt_type.$sno." 04200801010000004000000000000/r/nF0".$uen.$payemnt_type.$sno." 04200801020000000000500000001/r/nF0".$uen.$payemnt_type.$sno." 04200801030000000001000000001/r/nF0".$uen.$payemnt_type.$sno." 04200801040000000000500000001/r/nF0".$uen.$payemnt_type.$sno." 04200801050000000001000000001/r/nF0".$uen.$payemnt_type.$sno." 04200801080000000100000000000/r/nF0".$uen.$payemnt_type.$sno." 04200801090000000100000000000/r/nF0".$uen.$payemnt_type.$sno." 04200801100000000000000000000/r/nF0".$uen.$payemnt_type.$sno." 04200801110000000000000000000 /r/nF1".$uen.$payemnt_type.$sno." 0420080101S8600001F00000010000000003333000000000000/r/nF1".$uen.$payemnt_type.$sno." 0420080104S8600001F00000000005000000000000000000000/r/nF1".$uen.$payemnt_type.$sno." 0420080101S7336114A00000010000000003333000000000000N/r/nF1".$uen.$payemnt_type.$sno." 0420080105S7336114A00000000010000000000000000000000/r/nF1".$uen.$payemnt_type.$sno." 0420080101S7523759F00000010000000003333000000000000E/r/nF1".$uen.$payemnt_type.$sno." 0420080103S7523759F00000000010000000000000000000000 /r/nF1".$uen.$payemnt_type.$sno." 0420080101S7523759F00000010000000003333000000000000E/r/nF1".$uen.$payemnt_type.$sno." 0420080102S7523759F00000000005000000000000000000000/r/nF9".$uen.$payemnt_type.$sno." 040000019000000000420300";*/
           
			$this->load->helper('download');
			$data = 'Here is some text!';
			$name = 'mytext.txt';
			$finaltxt=$txtheader.$txtsummary.$txtdetails.$txttrailer;
			force_download($filename, $finaltxt); 
	}
	
	
}
