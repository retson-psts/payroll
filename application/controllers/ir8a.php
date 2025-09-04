<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ir8a extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('leave_lib'));
    }
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['page_title']="IR8A Submission";
		$data['message_div']='';
		
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('ir8a-view',$data);
		$this->load->view('footer');
	}
	public function search_employees()
	{
		if ($this->input->is_ajax_request())
   		{
   			$get=$this->input->get(NULL,TRUE);
   			$term=$get['term'];
   			//$month=$get['month']."-01";
   			$month=$get['month'];
   			$emp_list=$this->leave_model->fixed_salary_employees1($term,$month);
   			$list_array=array();
   			if(!empty($emp_list))
   			{
				foreach($emp_list as $key=>$item)
				{
					$list_array[]=array('data'=>$item['employee_id'],'value'=>$item['emp_firstname']." ".$item['emp_lastname']);
				}
			}
			echo json_encode($list_array);
    	
    	
	    }
	     else
	    {
	      show_error("No direct access allowed");
	      //or redirect to wherever you would like
	    }
	}
	public function add_dates()
	{
		if ($this->input->is_ajax_request())
		{
			$this->load->library('form_validation');
			if($this->form_validation->run('add_dates_for_ot')!==false)
			{
				
				$data=$this->input->post();
				$emp_id=$data['employee_id'];
				$begin =DateTime::createFromFormat( 'Y-m-d',$data['month']."-01" );
				$end = DateTime::createFromFormat( 'Y-m-d',$data['month']."-01" );
				$end->modify("+1 month");
				$interval = new DateInterval('P1D');
				$daterange = new DatePeriod($begin, $interval ,$end);
				$arrray=array();
				$i=0;
				foreach($daterange as $date){
					
				$array[$i]['date']=$date->format('d M, Y');
				$array[$i]['date2']=$date->format('Y-m-d');
				$array[$i]['date1']=$date->format('d');
				$leave=$this->common_model->__fetch_contents('employee_leave',array('employee_id'=>$emp_id,'leave_date'=>$date->format('Y-m-d'),'leave_request'=>1),'leave_id');
				$jobsheet=$this->common_model->__fetch_contents('jobsheet',array('employee_id'=>$emp_id,'jobsheet_date'=>$date->format('Y-m-d'),'jobsheet_removed'=>0),'*');
				$array[$i]['absent']=0;
				$array[$i]['otf']=0;
				$array[$i]['ot1']=0;
				$array[$i]['ot2']=0;
				$array[$i]['jobsheet_id']=0;
			
				if($leave!==FALSE)
				{
					$array[$i]['absent']=1;	
				}
				if($jobsheet!==FALSE)
				{
					$array[$i]['otf']=$jobsheet[0]['jobsheet_otfixed'];
					$array[$i]['ot1']=$jobsheet[0]['jobsheet_ot15'];
					$array[$i]['ot2']=$jobsheet[0]['jobsheet_ot2'];
					$array[$i]['jobsheet_id']=$jobsheet[0]['jobsheet_id'];
					
				}
				
				$i++;
				}
				
				echo json_encode(array('status'=>1,'result'=>$array,'emp_id'=>$emp_id,'month'=>$begin->format('Y-m')));
		}
		else
		{
			    $message=validation_errors();
			   	$report=array('status'=>0,'message'=>$message);
				echo json_encode($report);
		}
			
			
		}
		else{
			redirect(site_path,'refresh');
		}
	}
	public function emp_validate($emp_id)
  	{
  		$month=$this->input->post('month');
 	 	if(!empty($month))
 	 	{
 	 		$res=$this->leave_model->employee_available_month($emp_id,$month);
		  	if($res===FALSE)
		    {
				
					$this->form_validation->set_message('emp_validate', 'Employee Not available for this month');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
			
		}
		else
		{
			$this->form_validation->set_message('emp_validate', 'Please select month');
			return FALSE;
		}
 	 	
  		
    
  }
	
	public function submit_ot()
	{
		if ($this->input->is_ajax_request())
		{
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$this->load->library('form_validation');
			if($this->form_validation->run('submit_ot')!==false)
			{
				$data=$this->input->post();
				$date=$data['date'];
				$ot15=$data['ot15'];
				$ot2=$data['ot2'];
				$otf=$data['otf'];
				$job=$data['jobsheet_id'];
				$emp_id=$data['emp_id1'];
				$jobsheet_array=array();
				$jobsheet_id=array();
				foreach($date as $item)
				{
					$jobsheet_array[]=array('jobsheet_date'=>$data['month'].'-'.$item,'jobsheet_entered'=>date('Y-m-d H:i:s'),'jobsheet_entered_by'=>$user_id,'jobsheet_otfixed'=>$otf[$item],'jobsheet_ot15'=>$ot15[$item],'jobsheet_ot2'=>$ot2[$item],'employee_id'=>$emp_id);
					$jobsheet_id[]=$job[$item];
				}
				$emp_id=$this->leave_model->submit_ot($jobsheet_id,$jobsheet_array);
				if($emp_id!==false)
				{
					$message='Ot added Successfully';
					$report = array('status' => 1,'message' => $message);
			        echo json_encode($report);
			        exit;
				}
				else
				{
					$message = 'Something wrong please try again';
		        	$report  = array('status' => 0,'message' => $message);
		        	echo json_encode($report);
		        	exit;
					
				}
				
			}
			else
			{
				    $message=validation_errors();
				   	$report=array('status'=>0,'message'=>$message);
					echo json_encode($report);
			}
			
			
		}
		else{
			redirect(site_path,'refresh');
		}
	}
	
	public function datechecked($emp_id)
  	{
  		$post=$this->input->post();
  		if(!isset($post['date']))
  		{
			$this->form_validation->set_message('datechecked', 'Please select atleast one date');
			return FALSE;
		}
		else 
		{
			$stat=0;
			foreach($post['date'] as $item)
			{
				if(!is_numeric($item))
				{
					$stat=1;
				}
			}
			if($stat==1)
			{
				$this->form_validation->set_message('datechecked', 'All date field must be numeric');
			return FALSE;
			}
		}
 	 
 	 	
  		
    
  }



	public function ir8a_print()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		
		$data['page_title']="IR8A Submission";
		$data=$this->input->get(NULL,TRUE);
		if(isset($data['year']) && isset($data['emp_id']) && is_numeric($data['year']) && is_numeric($data['emp_id']))
		{
			$year=$data['year'];
			$emp_id=$data['emp_id'];
			$this->load->model('salary_model');
			$data['authorised']=$this->common_model->__fetch_contents('ir8a_authorised',array(),'*','','ir8a_authorised_id desc');
			$data['res']=$this->salary_model->ir8a($year,$emp_id);
			$data['message_div']='';
			$this->load->view('pdf/ir8_pdf',$data);
		}
		else
		{
			echo "Please Select valid Data";
			echo '<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>';
			echo "<script>$('#loader',opener.document).hide(); setTimeout (window.close, 1000);</script>";
		}
		
			/*	$data=$this->input->get();
				$date=$data['month'];
				$ot15=$data['employee_id'];
				$emp_id=$this->leave_model->submit_ot($jobsheet_id,$jobsheet_array);
				if($emp_id!==false)
				{
					$message='Ot added Successfully';
					$report = array('status' => 1,'message' => $message);
			        echo json_encode($report);
			        exit;
				}
				else
				{
					$message = 'Something wrong please try again';
		        	$report  = array('status' => 0,'message' => $message);
		        	echo json_encode($report);
		        	exit;
					
				}
				*/
			
			
			
		
	
 }

	
	
}
?>