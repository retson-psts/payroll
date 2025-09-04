<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Leave_Requests extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'form_validation',
            'leave_lib'
        ));
    }
    public function index()
    {
        $user_id                = $this->session->userdata['logged_in']['user_id'];
        $page_name              = $this->router->fetch_class();
        $data['user_details']   = $this->users_lib->get_logged_user_details($user_id);
        $data['page_title']     = "Leave Requests";
        $data['message_div']    = '';
        $data['leave_requests'] = $this->leave_lib->all_leave_request();
        if (isset($this->session->userdata['form']['process_request']['status']))
        {
            $data['message_div'] = $this->session->userdata['form']['process_request']['message'];
            $this->session->unset_userdata('form');
        }
        $this->load->view('header', $data);
        $this->load->view('side_menu_admin', $data);
        $this->load->view('list_leave_request', $data);
        $this->load->view('footer');
    }
    public function view($leave_request_id = '0')
    {
    	if(is_numeric($leave_request_id))
    	{
    		$data['leave_request_id']=$leave_request_id;
			$request_details = $this->leave_lib->get_leave_req_details($leave_request_id);
        $leave_list = $this->leave_model->get_leaves($leave_request_id);
        //var_dump($request_details);
        if ($request_details != false && $leave_list!=false)
        {
            $user_id                        = $this->session->userdata['logged_in']['user_id'];
            $data['user_details']           = $this->users_lib->get_logged_user_details($user_id);
            $data['page_title']             = "Leave Requests";
            $data['leave_requests_details'] = $request_details['0'];
            $data['leave_request_types']=$this->leave_lib->leave_request_types();
            $data['current_groups']=$this->leave_model->get_group_leave($leave_request_id);
            $data['all_groups']=$this->leave_model->get_group_leave_all($request_details[0]->employee_id);
            $leaves_array=$this->leave_model->leave_taken($request_details[0]->leave_request_type,$request_details[0]->employee_id);
            
            $total=0;
			foreach($leaves_array as $item)
			{
				$total+=$item->leaves;
				
			}
			
			$leaves_array['total']=$total;
			$data['leaves_array']=$leaves_array;
			$leaves_array_total=$this->leave_model->leave_taken_total($request_details[0]->employee_id);
			 $total_total=0;
			foreach($leaves_array_total as $item)
			{
				$total_total+=$item->leaves;
				
			}
			//$leaves_array_total['total']=$total_total;
			$data['leaves_array_total']=$leaves_array_total;
            foreach($leave_list as $key=>$item)
            {
            	$date=new DateTime($item['leave_date']);
            	$leave_list[$key]['date']=$date->format('d M, Y');
				$leave_list[$key]['day']=$date->format('D');
			}
            $data['leave_list']=$leave_list;
           //var_dump($data['leave_list']);
            $data['message_div']            = '';
            $this->load->view('header', $data);
            $this->load->view('side_menu_admin', $data);
            $this->load->view('view_leave_request', $data);
            $this->load->view('footer');
        }
        else
        {
            redirect(site_path . 'leave_requests', 'refresh');
        }
		}
		else
		{
			 redirect(site_path . 'leave_requests', 'refresh');
		}
        
    }
    public function process_request()
    {
		if ($this->input->is_ajax_request())
		{
			if($this->form_validation->run('emp_leave_approve')!==false)
			{
				$data=$this->input->post();
				$employee_id=$data['employee_id'];
				$request_id=$data['request_id'];
				$dates=$data['leave_dates'];
				$leave_types=$data['leave_types1'];
				$leave_ids=$data['leave_ids'];
				$leave_reason=$data['leave_request_approve_notes'];
				$user_id= $this->session->userdata['logged_in']['user_id'];
				$date= date('Y-m-d H:i:s');
				if($data['approve']==1)
				{
					$approve=1;
				}
				else
				{
					$approve=2;
				}
				$update_array=array('leave_request'=>$approve,'leave_accept_by'=>$user_id);
        		$data = array(
				            'leave_request_approve_status' => $approve,
				            'leave_request_update_at' => $date,
				            'leave_request_process_notes' => $leave_reason
				       		 );
        		$update_req_status           = $this->leave_lib->update_req_status($request_id, $data,$update_array,$leave_ids);
        		if($update_req_status===true)
        		{
					$report=array('status'=>1,'message'=>'Approved Success fully');
					echo json_encode($report);
					exit;
				}
				else
				{
					$report=array('status'=>0,'message'=>'Please try again');
					echo json_encode($report);
					exit;
				}
        
				
			}
			else
			{
				$message=validation_errors();
			   	$report=array('status'=>0,'message'=>$message);
				echo json_encode($report);
				exit;
			}
		}
		else
		{
			redirect(site_path,"refresh");
			exit;
		}
	}
    /*public function process_request()
    {
        $this->form_validation->set_rules('request_id', 'Invalid Request', 'trim|required|xss_clean');
        $this->form_validation->set_rules('leave_request_approve_notes', 'Leave Request Notes', 'trim|xss_clean');
        if ($this->form_validation->run() !== false)
        {
            if (isset($_POST['approve']))
            {
                $this->approve_leave();
            }
            elseif (isset($_POST['unapprove']))
            {
                $this->cancel_leave();
            }
        }
        else
        {
            $message = $this->html_lib->alert_div(validation_errors());
            $data    = array(
                'process_request' => array(
                    'status' => '0',
                    'message' => $message
                )
            );
            $this->session->set_userdata('form', $data);
        }
        redirect(site_path . 'leave_requests', 'refresh');
        
    }*/
    protected function approve_leave()
    {
        $request_id                  = $this->input->post('request_id');
        $leave_request_approve_notes = $this->input->post('leave_request_approve_notes');
        $date                        = date('Y-m-d H:i:s');
        $data                        = array(
            'leave_request_approve_status' => '1',
            'leave_request_update_at' => $date,
            'leave_request_process_notes' => $leave_request_approve_notes
        );
        $update_req_status           = $this->leave_lib->update_req_status($request_id, $data);
        if ($update_req_status == true)
        {
            $op  = $this->html_lib->success_div('Leave Request Approved Succesfully');
            $msg = array(
                'process_request' => array(
                    'status' => '0',
                    'message' => $op
                )
            );
            $this->session->set_userdata('form', $msg);
        }
        else
        {
            $op  = $this->html_lib->alert_div('Failed! Please Try Again');
            $msg = array(
                'process_request' => array(
                    'status' => '0',
                    'message' => $op
                )
            );
            $this->session->set_userdata('form', $msg);
        }
        
    }
    protected function cancel_leave()
    {
        $request_id                  = $this->input->post('request_id');
        $leave_request_approve_notes = $this->input->post('leave_request_approve_notes');
        $date                        = date('Y-m-d H:i:s');
        $data                        = array(
            'leave_request_approve_status' => '2',
            'leave_request_update_at' => $date,
            'leave_request_process_notes' => $leave_request_approve_notes
        );
        $update_req_status           = $this->leave_lib->update_req_status($request_id, $data);
        if ($update_req_status == true)
        {
            $op  = $this->html_lib->success_div('Leave Request Rejected Succesfully');
            $msg = array(
                'process_request' => array(
                    'status' => '0',
                    'message' => $op
                )
            );
            $this->session->set_userdata('form', $msg);
        }
        else
        {
            $op  = $this->html_lib->alert_div('Failed! Please Try Again');
            $msg = array(
                'process_request' => array(
                    'status' => '0',
                    'message' => $op
                )
            );
            $this->session->set_userdata('form', $msg);
        }
    }
	public function validate_date($date)
	{
		$dateTime = DateTime::createFromFormat('Y-m-d', $date);
		$errors = DateTime::getLastErrors();
		if (!empty($errors['warning_count'])) {
		    $this->form_validation->set_message('validate_date', 'Please Provide valid days');
			return FALSE;
		}
		else
		{
			$now = new DateTime();
			if($dateTime->diff($now)->days < 1 )
		    {
		    		$this->form_validation->set_message('validate_date', 'you can\'t choose date below today or today');
					return FALSE;
			}
			else
			{
					return TRUE;
			}
		}
	}
	
}
?>