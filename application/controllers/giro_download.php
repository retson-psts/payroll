<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Giro_download extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	  // $this->load->model();
    }
	public function index()
	{
		
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['csn']=$this->common_model->__fetch_contents('csn');
		$data['message_div']="";
		$data['menu']=23;
		$data['menu1']=23;
		$data['page_title']="GIRO Download for MAY Bank";
		$this->load->view('header',$data);
	    $this->load->view('side_menu_admin',$data);
	    $this->load->view('giro-download-view',$data);
	    $this->load->view('footer');
	}
	public function process()
	{
		
		if ($this->input->is_ajax_request())
    	{
    		$this->load->library('form_validation');
    		$this->form_validation->set_rules('month', 'Month', 'required|month_validate');
    		
    	if($this->form_validation->run())
		{
			$data=$this->input->post();
			$this->load->library('giro_lib');
			$salary=$this->giro_lib->giro_preview($data['month']);
			if($salary!==FALSE)
			{
			$report  = array('status' => 1,'message' => $salary,'month'=>$data['month']);
			echo json_encode($report);
			exit;
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
	public function download_excel()
	{
		
		$this->load->library('form_validation');
    	$this->form_validation->set_rules('mn', 'Month', 'required|month_validate');
    	if($this->form_validation->run())
		{
			$data=$this->input->post();
			$this->load->library('giro_lib');
			$amount=$data['amount'];
			$remarks=$data['remarks'];
			$salary=$this->giro_lib->giro_preview($data['mn']);
			$time=date('Y-m-d H:i:s');
			$user=$this->session->userdata['logged_in']['user_id'];
			if($salary!==FALSE)
			{
				$insert_batch=array();
				foreach($salary as $key=>$item)
				{
					$insert_batch[$key]['giro_down_month']=$data['mn'].'-01';
					$insert_batch[$key]['giro_down_bank']=$item['employee_bank_name'];
					$insert_batch[$key]['giro_down_branch']='';
					$insert_batch[$key]['giro_down_acc']=$item['employee_bank_acc'];
					$insert_batch[$key]['giro_down_amount']=$amount[$key];
					$insert_batch[$key]['giro_down_name']=$item['emp_firstname']." ".$item['emp_lastname'];
					
					$insert_batch[$key]['giro_down_remarks']=$remarks[$key];
					$insert_batch[$key]['giro_down_time']=$time;
					$insert_batch[$key]['giro_down_user']=$user;
					
				}
				$res=$this->common_model->insert_multiple('giro_downloaded',$insert_batch);
				if(!empty($res))
				{
					 header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=\"downlad_giro".date('Ymdhis').".csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");

            $handle = fopen('php://output', 'w');

            foreach ($insert_batch as $key=>$data) {
            	unset($insert_batch[$key]['giro_down_time']);
            	unset($insert_batch[$key]['giro_down_user']);
            	unset($insert_batch[$key]['giro_down_month']);
            	fputcsv($handle, $insert_batch[$key]);
            }
                fclose($handle);
            	exit;
				}
			   
			}
			else
			{
				$message = "<h2>Salary not generated or No employee available for cpf<h2>";
				echo $message;
			}
			
			
		}
		else
		{
			$message = validation_errors();
			echo $message;
			exit;
		}
    	
	   
	}
	
	
	
}
