<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_profile extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	 $this->load->library('form_validation');
	  // $this->load->model();
    }
	public function index()
	{
		$data= array(
            'page_title' =>'User Profile',
          );
        $data['user_details']=$this->session->userdata('user');
        $data['form_data']=array('username'=>$data['user_details']['username'],'opassword'=>'','npassword'=>'','cpassword'=>'');
        
        $data=$this->messages('user_profile',$data);
        $this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('user_profile_view',$data);
		$this->load->view('footer',$data);
		
	}
	public function user_profile_update()
	{
		if($this->form_validation->run('user_profile')!==false)
		{
			$array['password']=md5($this->input->post('npassword'));
			$where_array['user_id']=$this->session->userdata['user']['user_id'];
			$insert_table=$this->common_model->update_table_custom('users',$array,$where_array);
			if($insert_table===true)
			{
				$message='Password Updated Successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('user_profile'=>$report));
				redirect(site_path.'user_profile','refresh');
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('user_profile'=>$report));
				redirect(site_path.'user_profile','refresh');	
			}
		
			
			
			
			
		}
		else
		{
			    $message=validation_errors();
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('user_profile'=>$report));
			redirect(site_path.'user_profile','refresh');
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
				$data['message_div']='<div class="alert alert-success alert-dismissable"><i class="fa fa-check"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'.$message.'</div>';
				
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
				
				
				$data['message_div']='<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>'.$message.'</div>';
				
			}
		}
		$this->session->unset_userdata('form');
		return $data;
	}
   
    public function password_check($password)
	{
		$array['user_id']=$this->session->userdata['user']['user_id'];
		$array['password']=md5($password);
		$fetch_content=$this->common_model->__fetch_contents('users',$array);
		if($fetch_content===FALSE)
		{
			
				$this->form_validation->set_message('password_check', 'Please check entered password');
				return false;
			
		}
		/*$this->form_validation->set_message('password_check', 'Please check entered password');
				return false;*/
	} 	
	
  
}
