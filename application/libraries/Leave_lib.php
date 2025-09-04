<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Leave_lib 
{
   private $byzero;
   public function __construct()
   {
	 $this->byzero = & get_instance();
	 $this->byzero->load->library(array('send_email'));
	 $this->byzero->load->model(array('leave_model','employee_model'));
   }
   public function add_leave_request($leave_type,$date_range,$leave_notes='')
   {
	   $user_id=$this->byzero->session->userdata['logged_in']['employee_id'];
	   $dates=explode('-',$date_range);
	   $date=date('Y-m-d H:i:s');
	   $data=array('leave_request_user_id'=>$user_id,'leave_request_type'=>$leave_type,'leave_request_from'=>str_replace('/','-',$dates['0']),'leave_request_to'=>str_replace('/','-',$dates['1']),'leave_requested_at'=>$date,'leave_request_status'=>'1','leave_notes'=>$leave_notes);
	   $insert_leave_request=$this->byzero->leave_model->add_leave($data);
	   if($insert_leave_request==true)
	   {
		   $admin_details=$this->byzero->user->admin_details();
		   $employee_details=$this->employee_details($user_id);
		   $subject="Leave Requets";
		   $message="New Leave Request from : ".$employee_details->employee_fname." ".$employee_details->empoyee_lname." <br/>";
		   $message.="Leave Days : ";
		   $send_mail=$this->byzero->send_email->send_emails($admin_details->company_admin_email,$subject,$message);
		   return true;
	   }
	   else
	   {
		   return false;
	   }
   }
   public function list_leave_request()
   {
	   $user_id=$this->byzero->session->userdata['logged_in']['employee_id'];
	   return $this->byzero->leave_model->list_leave_request($user_id);
   }
   public function leave_request_types()
   {
	   return $this->byzero->leave_model->leave_types();
   }
   public function all_leave_request()
   {
	   return $this->byzero->leave_model->all_leave_request();
   }
   public function employee_details($employee_id)
   {
	   return $this->byzero->employee_model->employee_details($employee_id);
   }
   public function get_leave_req_details($request_id)
   {
	   return $this->byzero->leave_model->get_leave_req_details($request_id);
   }
   public function update_req_status($request_id,$data,$update_array,$leave_ids)
   {
	    $update_status=$this->byzero->leave_model->update_req_status($request_id,$data,$update_array,$leave_ids);
		if($update_status==true)
		{
			
			$employee_details=$this->byzero->leave_model->get_leave_req_details($request_id);
			$email='jey.ss10@gmail.com';
			if($employee_details['0']->emp_work_email!='')
			{
				$email=$employee_details['0']->emp_work_email;
			}
			elseif($employee_details['0']->emp_oth_email!='')
			{
				$email=$employee_details['0']->emp_oth_email;
			}
			if(filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				$message='Dear,'.$employee_details['0']->emp_firstname.' <br/>';
				if($data['leave_request_approve_status']=='1')
				{
					$subject='Leave Request Approved';
					$message.='This mail is to inform you that leave Request submitted by you was <b>Processed</b> from '.$employee_details['0']->leave_request_from.' to '.$employee_details['0']->leave_request_to.'<br/>';
				}
				elseif($data['leave_request_approve_status']=='2')
				{
					$subject='Leave Request Rejected';
					$message.='This mail is to inform you that leave Request submitted by you was <b>Rejected</b>. Request Date starts from '.$employee_details['0']->leave_request_from.' to '.$employee_details['0']->leave_request_to.'<br/>';
				}
				$message.='<b>Request Update Notes </b>'.$employee_details['0']->leave_request_process_notes.'<br/>';
				$message.='The Request Submitted on '.$employee_details['0']->leave_requested_at;
				$email.=",yuvarajjcse@gmail.com";
				$send_mail=$this->byzero->send_email->send_emails($email,$subject,$message);
			}
		}
		return $update_status;
		
   }
}