<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Allowance extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	   $this->load->model(array('allowance_model'));
    }
	public function index()
	{
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['user_details']=$this->users_lib->get_logged_user_details($user_id);
	  $data['employees_list']=$this->allowance_model->allowance_list();
	  $data['allowance_list']=$this->allowance_model->allowance_types();
	  $data['page_title']="Allowance";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	  $this->load->view('allowance_list',$data);
	  $this->load->view('footer');
	}
	public function add_allowance()
	{
		if ($this->input->is_ajax_request()) {
		if($this->form_validation->run('allowance')!==false)
		{
			
			$user_id=$this->session->userdata['logged_in']['user_id'];
			$datetime=date('Y-m-d H:i:s');
			$data=$this->input->post();
			$x=explode('-',$data['emp_allowance_month']);
			
			$data['emp_allowance_month']=$x[1]."-".$x[0]."-01";
			if(!empty($data['emp_allowance_date']))
			{
				$x1=explode('-',$data['emp_allowance_date']);
				$data['emp_allowance_date']=$x1[2]."-".$x1[1]."-".$x1[0];
			}
			else
			{
				$data['emp_allowance_date']='0000-00-00';
			}
			$data1=$data;
			
			$range=$data['range'];
			$rr=explode(' - ',$range);
			if(!empty($rr) && count($rr)==2)
			{
				$data['emp_allowance_from']=$rr[0];
				$data['emp_allowance_to']=$rr[1];
					
			}
			
			
			
			unset($data['range']);
			
			$data['emp_allowance_added']=$datetime;
			$data['emp_allowance_added_by']=$user_id;
			$data['emp_allowance_approved']=1;
			unset($data1['emp_allowance_reason']);
			unset($data1['range']);
			unset($data1['emp_allowance_date']);
			$dublicate_check=$this->common_model->dublicate_check('emp_allowance',$data1);
			if($dublicate_check===false)
			{
				$insert_table=$this->common_model->insert_table('emp_allowance',$data);
			if($insert_table===true)
			{
				$message='Allowance added successfully';
				$report=array('status'=>1,'message'=>$message);
				echo json_encode($report);
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'message'=>$message);
				echo json_encode($report);
			}
				
			}
			else
			{
				$message='Already Marked';
				$report=array('status'=>2,'message'=>$message);
				echo json_encode($report);
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
	public function report($id)
	{
		if(is_numeric($id))
		{
	      $user_id=$this->session->userdata['logged_in']['user_id'];
		  $page_name=$this->router->fetch_class();
		  $data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		  $data['allowance_list']=$this->allowance_model->allowance_report($id);
		 /* $data['employees_list']=$this->allowance_model->allowance_list();
		  $data['allowance_list']=$this->allowance_model->allowance_types();*/
		  $data['page_title']="Allowance Reports";
		  $data=$this->messages('allowance_report',$data);
		  $this->load->view('header',$data);
		  $this->load->view('side_menu_admin',$data);
		  $this->load->view('allowance_report',$data);
		  $this->load->view('footer');
		}
	    else
	    {
			
		}
	}
	
	public function rejected($id)
	{
		if(is_numeric($id))
		{
	      $user_id=$this->session->userdata['logged_in']['user_id'];
		  $page_name=$this->router->fetch_class();
		  $data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		  $data['allowance_list']=$this->allowance_model->allowance_rejected($id);
		 /* $data['employees_list']=$this->allowance_model->allowance_list();
		  $data['allowance_list']=$this->allowance_model->allowance_types();*/
		  $data['page_title']="Allowance Reports";
		  $data=$this->messages('allowance_report',$data);
		  $this->load->view('header',$data);
		  $this->load->view('side_menu_admin',$data);
		  $this->load->view('allowance_rejected',$data);
		  $this->load->view('footer');
		}
	    else
	    {
			
		}
	}
	public function allowance_request()
	{
		
	      $user_id=$this->session->userdata['logged_in']['user_id'];
		  $page_name=$this->router->fetch_class();
		  $data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		  $data['allowance_list']=$this->allowance_model->allowance_report_request();
		  $data['page_title']="Allowance Reports";
		  $data=$this->messages('allowance_report',$data);
		  $this->load->view('header',$data);
		  $this->load->view('side_menu_admin',$data);
		  $this->load->view('allowance_report_request',$data);
		  $this->load->view('footer');
		
	}
	public function remove($id)
	{
		if(is_numeric($id))
		{
			$data=array('emp_allowance_removed'=>'1');
			$insert_table=$this->common_model->update_table('emp_allowance',$data,$id);      
			if($insert_table===true)
			{
				$message='Deleted Successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('allowance_report'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
			else
			{
				$message='Deleting Failed';
				$report=array('status'=>0,'message'=>$message);
				$this->session->set_userdata('form',array('allowance_report'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
			
		}
		else
		{
			redirect(admin_path,'refresh');
		}
	}
	public function get_allowance()
	{
		if ($this->input->is_ajax_request())
    	{
    		if($this->form_validation->run('get_allowance')!==false)
			{
	    		$id=$_POST['id'];
	    		if(isset($_POST['type']) && $_POST['type']==1)
	    		{
					$result=$this->allowance_model->get_allowance('emp_allowance',array("emp_allowance_id"=>$id,"emp_allowance_approved"=>2));
				}
				elseif(isset($_POST['type']) && $_POST['type']==2)
				{
					$result=$this->allowance_model->get_allowance('emp_allowance',array("emp_allowance_id"=>$id,"emp_allowance_approved"=>1));
				}
				else
				{
				
	    		$result=$this->allowance_model->get_allowance('emp_allowance',array("emp_allowance_id"=>$id,"emp_allowance_approved"=>0));
	    		}
	    		$array=array();
	    		if($result!==false)
	    		{
	    			$from=$result[0]['emp_allowance_from'];
	    			$to=$result[0]['emp_allowance_to'];
	    			unset($result[0]['emp_allowance_from']);
	    			unset($result[0]['emp_allowance_to']);
	    			$result[0]['range']="";
	    			if($from!="0000-00-00")
	    			{
						$result[0]['range']=$from."-".$to;	
					}
					if($result[0]['emp_allowance_month']!='0000-00-00')
					{
						$result[0]['emp_allowance_month']=str_replace("-01","",$result[0]['emp_allowance_month']);	
					}
					else
					{
						$result[0]['emp_allowance_month']='';
					}
					// $this->load->library('encrypt');
					$result[0]['emp_allowance_id']=md5($result[0]['emp_allowance_id']);
					$array=array("status"=>1,"result"=>$result[0]);
				}
				else
				{
					$array=array("status"=>0,"error"=>"No data found to be approved/ May be approved by other user");
				}
				echo json_encode($array);
				exit;
	    	}
	    	else
	    	{
	    		 $message=validation_errors();
				$array=array("status"=>0,"error"=>$message);
				echo json_encode($array);
				exit;
			}
	    }
	    else
	    {
	    	
			$array=array("status"=>0,"error"=>"Wrongly access here");
			echo json_encode($array);
			exit;
		}
	}
	public function approve_allowance()
	{
		if ($this->input->is_ajax_request()) 
		{
			if($this->form_validation->run('approve_allowance')!==false)
			{
				
				$user_id=$this->session->userdata['logged_in']['user_id'];
				$datetime=date('Y-m-d H:i:s');
				$data=$this->input->post();
				if($data['emp_allowance_month']!='0000-00-00' && $data['emp_allowance_month']!='')
				{
				  $data['emp_allowance_month']=$data['emp_allowance_month']."-01";	
				}
				else
				{
					$data['emp_allowance_month']=date('Y-m')."01";
				}
				
				
				if(!empty($data['emp_allowance_date']))
				{
					$x1=explode('-',$data['emp_allowance_date']);
					$data['emp_allowance_date']=$x1[2]."-".$x1[1]."-".$x1[0];
				}
				else
				{
					$data['emp_allowance_date']='0000-00-00';
				}
				$data1=$data;
				$range=$data['range'];
				$rr=explode(' - ',$range);
				if(!empty($rr) && count($rr)==2)
				{
					$data['emp_allowance_from']=$rr[0];
					$data['emp_allowance_to']=$rr[1];
						
				}
				unset($data['range']);
				$data['emp_allowance_approved_by']=$user_id;
				$where_data=array('md5(emp_allowance_id)'=>$data['emp_allowance_id']);
				unset($data['emp_allowance_id']);
				$insert_table=$this->common_model->update_table_custom('emp_allowance',$data,$where_data);
				if($insert_table===true)
				{
					$message='Allowance added successfully';
					$report=array('status'=>1,'message'=>$message);
					echo json_encode($report);
					
				}
				else
				{
					$message='Something Wrong';
					$report=array('status'=>0,'message'=>$message);
					echo json_encode($report);
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
	protected function messages($form,$data)
	{
		
		$data['message_div']='';
	
		if(isset($this->session->userdata['form'][$form]['message']))
		{
			$status=$this->session->userdata['form'][$form]['status'];
			$message=$this->session->userdata['form'][$form]['message'];
			if(isset($this->session->userdata['form'][$form]['step']))
			{
				$data['step']=$this->session->userdata['form'][$form]['step'];
			}
			if($status==1)
			{
				$data['message_div']='<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">*</button>'.$message.'</div>';
				
			}
			else
			{
				if(isset($this->session->userdata['form'][$form]['form_data']))
				{
					$data['form_data']=$this->session->userdata['form'][$form]['form_data'];
				}
				if(isset($this->session->userdata['form'][$form]['form_data1']))
				{
					$data['form_data1']=$this->session->userdata['form'][$form]['form_data1'];
				}
				if(isset($this->session->userdata['form'][$form]['form_data2']))
				{
					$data['form_data2']=$this->session->userdata['form'][$form]['form_data2'];
				}
				
				
				$data['message_div']='<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">*</button>'.$message.'</div>';
				
			}
		}
		$this->session->unset_userdata('form');
		return $data;
	}
}
?>