<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Deduction extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('leave_lib'));
    }
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['menu']=20;
		$data['menu1']=201;
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['deduction_category']=$this->common_model->__fetch_contents('deduction_category',array('dec_removed'=>0));
		$data['page_title']="Deduction Adding";
		$data['message_div']='';
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('deduction-view',$data);
		$this->load->view('footer');
	}
	public function search_employees()
	{
		if ($this->input->is_ajax_request())
   		{
   			$get=$this->input->get(NULL,TRUE);
   			$term=$get['term'];
   			$month=$get['month']."-01";
   			$emp_list=$this->leave_model->fixed_salary_employees($term,$month);
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
	public function previous_added()
	{
		if ($this->input->is_ajax_request())
   		{
   			$this->load->library('form_validation');
   			$this->form_validation->set_rules('salary_month', 'Month', 'trim|xss_clean|required|datevalidate[Y-m]');
	    	$this->form_validation->set_rules('employee_id', 'Employee', 'trim|xss_clean|required|numeric');
	    	$this->form_validation->set_rules('sld_dec_id', 'Category', 'trim|xss_clean|numeric');
	    	$this->form_validation->set_rules('date_given', 'Given Date', 'trim|xss_clean|numeric|datevalidate[Y-m-d]');
   			if ($this->form_validation->run() !== false)
            {
		   		
    	
   			$data=$this->input->post(NULL,TRUE);
   			$emp_id=$data['employee_id'];
   			$month=$data['salary_month']."-01";
   			$deduction_category=$data['sld_dec_id'];
   			$this->load->model('deduction_model');
   			$emp_list=$this->deduction_model->previous_deducted($emp_id,$month,$deduction_category);
   			/*$list_array=array();
   			if(!empty($emp_list))
   			{
				foreach($emp_list as $key=>$item)
				{
					$list_array[]=array('data'=>$item['employee_id'],'value'=>$item['emp_firstname']." ".$item['emp_lastname']);
				}
			}*/
			echo json_encode(array('result'=>$emp_list));
    		}
    		else
            {
                $message = $this->form_validation->error_array();
                $report  = array(
                    'status' => 0,
                    'message' => $message
                );
                echo json_encode($report);
            }
    	
	    }
	     else
	    {
	      show_error("No direct access allowed");
	      //or redirect to wherever you would like
	    }
	}
	public function add_deduction()
	{
		if ($this->input->is_ajax_request())
   		{
   			$this->load->library('form_validation');
   			$this->form_validation->set_rules('salary_month', 'Month', 'trim|xss_clean|required|datevalidate[Y-m]');
	    	$this->form_validation->set_rules('employee_id', 'Employee', 'trim|xss_clean|required|numeric');
	    	$this->form_validation->set_rules('sld_dec_id', 'Category', 'trim|xss_clean|numeric|required');
	    	$this->form_validation->set_rules('sld_amount', 'Amount', 'trim|xss_clean|numeric|required|callback_totalsal');
	    	$this->form_validation->set_rules('date_given', 'Given Date', 'trim|xss_clean|numeric|datevalidate[Y-m-d]');
   			if ($this->form_validation->run() !== false)
            {
		   	$data=$this->input->post(NULL,TRUE);
		   	unset($data['employee_name']);
   			$data['salary_month']=$data['salary_month']."-01";
   			$data['sld_added']=date('Y-m-d H:i:s');
   			$data['sld_added_by']=$this->session->userdata['user']['user_id'];
   			
   			$insert_deduction=$this->common_model->insert_table('salary_deduction',$data);
   			if ($insert_deduction !== FALSE)
            {
            	$message = 'Deduction  added successfully';
                $report  = array(
                    'status' => 1,
                    'message' => $message
                );
                echo json_encode($report);
                
            }
            else
            {
                $message = 'Something Wrong';
                $report  = array(
                    'status' => 0,
                    'message' => $message
                );
                echo json_encode($report);
            }
   			
    		}
    		else
            {
                $message = $this->form_validation->error_array();
                $report  = array(
                    'status' => 0,
                    'message' => $message
                );
                echo json_encode($report);
            }
    	
	    }
	     else
	    {
	      show_error("No direct access allowed");
	      //or redirect to wherever you would like
	    }
	}
	public function all_deduction()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['menu']=20;
		$data['menu1']=202;
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['page_title']="Deduction List";
		$data['deduction_category']=$this->common_model->__fetch_contents('deduction_category',array('dec_removed'=>0));
		$data['deductions']=$this->common_model->__fetch_contents('salary_deduction',array('sld_removed'=>0));
		$data['message_div']='';
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('deduction-all-view',$data);
		$this->load->view('footer');
	}
	public function fetch_deduction()
	{
		if ($this->input->is_ajax_request())
   		{
   			
   			/*$this->load->library('form_validation');
   			$this->form_validation->set_rules('salary_month', 'Month', 'trim|xss_clean|datevalidate[Y-m]');
	    	$this->form_validation->set_rules('employee_id', 'Employee', 'trim|xss_clean|numeric');
	    	$this->form_validation->set_rules('sld_dec_id', 'Category', 'trim|xss_clean|numeric');
	    	if ($this->form_validation->run() !== false)
            {*/
		   	$data=$this->input->get(NULL,TRUE);
		   	$emp_id=0;
		   	$deduction_category='';
		   	$month='';
		   	if(isset($data['employee_id']))
		   	{
				$emp_id=$data['employee_id'];	
			}
			if(isset($data['salary_month']))
		   	{
		   		if(!empty($data['salary_month']))
		   		{
					$month=$data['salary_month']."-01";
				}
   				
   			}
   			if(isset($data['sld_dec_id']))
		   	{
   				$deduction_category=$data['sld_dec_id'];
   			}
   			//var_dump($data);
   			$this->load->model('deduction_model');
   			$emp_list=$this->deduction_model->previous_list($emp_id,$month,$deduction_category);
   			if(!empty($emp_list))
   			{
   				$i=0;
				foreach($emp_list as $key=>$item)
				{
					
					$emp_list[$key]['sno']=++$i;
					
					$emp_list[$key]['emp_name']=$item['emp_firstname']." ".$item['emp_lastname'];
					$date=new DateTime($item['salary_month']);
					$emp_list[$key]['salary_month']=$date->format('M Y');
					$date1=new DateTime($item['sld_from']);
					$emp_list[$key]['sld_from']=$date1->format('d M, Y');
					$emp_list[$key]['remove']='<a href="javascript:void(0);" class="label label-danger" onclick="remove_my(this,\''.$item['sld_id'].'\')">Remove</a>';
					
					unset($item['emp_firstname']);
					unset($item['emp_lastname']);
				}
			}
   			echo json_encode($emp_list);
    		/*}
    		else
            {
                $message = $this->form_validation->error_array();
                $report  = array(
                    'status' => 0,
                    'message' => $message
                );
                echo json_encode($report);
            }*/
    	
	    }
	     else
	    {
	      show_error("No direct access allowed");
	     
	    }
	}
   
    public function remove($id=0)
    {
		 if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->update_table_custom('salary_deduction',array('sld_removed'=>1),array('sld_id'=>$id));
  		if($result!==false)
  		{
			
			$message = 'Deduction Removed Successfully';
            $report  = array(
                'status' => 1,
                'message' => $message
            );
            echo json_encode($report);
		}
		else
		{
			
			$message = 'Not Removed';
            $report  = array(
                'status' => 0,
                'message' => $message
            );
            echo json_encode($report);
		}
		
	}
	else
	{
		
		$message = 'Access failed';
            $report  = array(
                'status' => 0,
                'message' => $message
            );
            echo json_encode($report);
	}
	}
	}
    
	
	function totalsal()
	{
		
		$data=$this->input->post(NULL,TRUE);
		$this->load->model('deduction_model');
		$total_list=$this->deduction_model->compare_total_deduction($data);
		/*var_dump($total_list);
		die();*/
		if($total_list!==FALSE)
		{
			$total=$total_list[0]['total']+$data['sld_amount'];
			if($total_list[0]['emp_salary_amount']<=$total)
			{
				$this->form_validation->set_message('totalsal', 'Total Salary Is less than deduction; Deduction = '.($total_list[0]['total']+$data['sld_amount']).'; Salary= '.$total_list[0]['emp_salary_amount']);
				return FALSE;
			}
				
			
		}
	
		
	}
	
}
?>