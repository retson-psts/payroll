<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_master extends CI_Controller {

	public function __construct()
	{
	 	parent::__construct();
	 	$this->load->library('form_validation');
	 	
	 }
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function index()
	{
		
 		/*$data= array(
            'page_title' => 'Setting Master',
            'menu1'=>11,
            'menu'=>1
        );
		
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('home',$data);
		$this->load->view('footer',$data);*/
		
 	}
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function index1()
	{
		$data= array(
            'page_title' => 'Setting Master',
            'menu1'=>12,
            'menu'=>1
        );
		$data['user_details']=$this->session->userdata('user');
		
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('admin/index_job',$data);
		$this->load->view('footer',$data);
	}
	//--------------------------------------------------------------------------------------------------------****************** COUNTRY**********
	public function country()
	{
		$data= array(
            'page_title' =>'Countries',
            'menu1'=>161,
            'menu'=>16,
                       
        );
        $data['user_details']=$this->session->userdata('user');
		$data['custom_css']=array("plugins/datatables/dataTables.bootstrap.css");
		$data['custom_js']=array("plugins/datatables/jquery.dataTables.js","plugins/datatables/dataTables.bootstrap.js");
		$data['country_list']=$this->common_model->country_list1();
		$data=$this->messages('country',$data);
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('test/test_master',$data);
		$this->load->view('footer',$data);
	}
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function add_country()
	{
		$data= array(
            'page_title' =>'Countries',
            'menu1'=>162,
            'menu'=>16,
                       
        );
        $data['user_details']=$this->session->userdata('user');
        $data['form_data']=array('country_name'=>'','country_code'=>'','country_nationality'=>'','country_gov_code'=>'');
        
        $data=$this->messages('add_country',$data);
        $this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('master/add_country',$data);
		$this->load->view('footer',$data);
		
	}
	//-----------------------------------------------------------------------------------------------------------------------------------------	
	public function add_country_process()
	{
		if($this->form_validation->run('add_country')!==false)
		{
			$array['country_name']=$this->input->post('country_name');
			$data=$this->input->post();
			$dublicate=$this->common_model->dublicate_check('countries',$array);
			if($dublicate===false)
			{
				$insert_table=$this->common_model->insert_table('countries',$data);
			if($insert_table===true)
			{
				$message='Country added successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('add_country'=>$report));
				redirect(admin_path.'add_country','refresh');
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_country'=>$report));
				redirect(admin_path.'add_country','refresh');	
			}
				
			}
			else
			{
				$message='Dublicate Entry';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_country'=>$report));
				redirect(admin_path.'add_country','refresh');
			}
			
			
			
		}
		else
		{
			    $message=validation_errors();
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_country'=>$report));
			redirect(admin_path.'add_country','refresh');
		}
	}
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function edit_country($id)
	{
		if(is_numeric($id))
		{
		$data= array(
            'page_title' =>'Countries',
            'menu1'=>161,
            'menu'=>16,
                       
        );
        $data['user_details']=$this->session->userdata('user');
        $data['form_data']=array('country_name'=>'','country_code'=>'');
        $result=$this->common_model->fetch_contents('countries',array('country_id'=>$id));
        $data['form_data']=$result[0];
        $data=$this->messages('edit_country',$data);
        $this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('master/edit_country',$data);
		$this->load->view('footer',$data);
		}
		else
		{
			redirect(admin_path,'refresh');
		}
	}
	//------------------------------------------------------------------------------------------------------------------------------------------
	public function edit_country_process()
	{
		if($this->form_validation->run('edit_country')!==false)
		{
			$array['country_name']=$this->input->post('country_name');
			$id=$this->input->post('country_id');
			$data=$this->input->post();
			$dublicate=$this->common_model->__edit_dublicate_check('countries',$array,'country_id',$id);
			if($dublicate===false)
			{
				$where_data['country_id']=$id;
				$insert_table=$this->common_model->update_table_custom('countries',$data,$where_data);
			if($insert_table===true)
			{
				$message='Country Edited successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('edit_country'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_country'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
				
			}
			else
			{
				$message='Dublicate Entry';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_country'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			}
			else
		{
			    $message=validation_errors();
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_country'=>$report));
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}
	//---------------------------------------------------------------------------------------------------------************* STATE**********
	public function state($country_id=0)
	{
		if(is_numeric($country_id))
		{
		$data= array(
            'page_title' =>'State',
            'menu1'=>171,
            'menu'=>17,
                       
        );
        $data['user_details']=$this->session->userdata('user');
		$data['custom_css']=array("plugins/datatables/dataTables.bootstrap.css");
		$data['custom_js']=array("plugins/datatables/jquery.dataTables.js","plugins/datatables/dataTables.bootstrap.js");
		if($country_id==0)
		{
			$data['state_list']=$this->common_model->state_list_all();
				
		}
		else
		{
			$data['state_list']=$this->common_model->state_list($country_id);
			
			$data['country_id']=$data['state_list'][0]['country_id'];
			$data['country_name']=$data['state_list'][0]['country_name'];
		}
		
		$data=$this->messages('state',$data);
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('master/state',$data);
		$this->load->view('footer',$data);
		}
		else
		{
			redirect(admin_path,'refresh');
		}
	}
	
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function add_state($country_id=0)
	{
		if(is_numeric($country_id))
		{
		$data= array(
        'page_title' =>'State',
        'menu1'=>172,
        'menu'=>17,
                   
        );
        $data['user_details']=$this->session->userdata('user');
        if($country_id==0)
        {
			$data['form_data']=array('country_id'=>'','state_name'=>'');				
		}
		else
		{
			$data['form_data']=array('country_id'=>$country_id,'state_name'=>'');
			
		}
       	$data=$this->messages('add_state',$data);
		$data['country_list']=$this->common_lib->options_select('country_id','country_name',$this->common_model->country_list1(),$data['form_data']['country_id']);
        $this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('master/add_state',$data);
		$this->load->view('footer',$data);
		}	
		else
		{
			redirect(admin_path,'refresh');
		}
		
	}
	
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function edit_state($id)
	{
		if(is_numeric($id))
		{
		$data= array(
            'page_title' =>'Countries',
            'menu1'=>161,
            'menu'=>16,
                       
        );
        $data['user_details']=$this->session->userdata('user');
        $data['form_data']=array('state_name'=>'','country_id'=>'');
        $result=$this->common_model->fetch_contents('state',array('state_id'=>$id));
        
        $data['form_data']=$result[0];
        
        $data=$this->messages('edit_state',$data);
        $data['country_list']=$this->common_lib->options_select('country_id','country_name',$this->common_model->country_list1(),$data['form_data']['country_id']);
        $this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('master/edit_state',$data);
		$this->load->view('footer',$data);
		}
		else
		{
			redirect(admin_path,'refresh');
		}
	}
	//-----------------------------------------------------------------------------------------------------------------------------------------
	
	public function edit_state_process()
	{
		if($this->form_validation->run('edit_state')!==false)
		{
			$array['state_name']=$this->input->post('state_name');
			$array['country_id']=$this->input->post('country_id');
			$id=$this->input->post('state_id');
			$data=$this->input->post();
			$dublicate=$this->common_model->edit_dublicate_check('state',$array,$id);
			if($dublicate===false)
			{
				$insert_table=$this->common_model->update_table('state',$data,$id);
			if($insert_table===true)
			{
				$message='State Edited successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('edit_state'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_state'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
				
			}
			else
			{
				$message='Dublicate Entry';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_state'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			}
			else
		{
			    $message=validation_errors();
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_state'=>$report));
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}
	//-----------------------------------------------------------------------------------------------------------------------------------------
	
	public function add_state_process()
	{
		if($this->form_validation->run('add_state')!==false)
		{
			$array['state_name']=$this->input->post('state_name');
			$array['country_id']=$this->input->post('country_id');
			$data=$this->input->post();
			$dublicate=$this->common_model->dublicate_check('state',$array);
			if($dublicate===false)
			{
				$insert_table=$this->common_model->insert_table('state',$data);
			if($insert_table===true)
			{
				$message="State added Successfully";
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('add_state'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
				
			}
			else
			{
				$message="Please try again";
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_state'=>$report));	
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
				
			}
			else
			{
				$message="Dublicate Entry";
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_state'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			
		}
		else
		{
			$message=validation_errors();
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_state'=>$report));
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

	//--------------------------------------------------------------------------------------------------------*************CITY**********
	public function city($state_id=0)
	{
		
		if(is_numeric($state_id))
		{
			$data= array(
            'page_title' =>'City',
            'menu1'=>181,
            'menu'=>18,
                       
        );
        $data['user_details']=$this->session->userdata('user');
		$data['custom_css']=array("plugins/datatables/dataTables.bootstrap.css");
		$data['custom_js']=array("plugins/datatables/jquery.dataTables.js","plugins/datatables/dataTables.bootstrap.js");
		if($state_id==0)
		{
			$data['city_list']=$this->common_model->city_list_all();
				
		}
		else
		{
			$data['city_list']=$this->common_model->city_list($state_id);
			
			$data['country_id']=$data['city_list'][0]['country_id'];
			$data['country_name']=$data['city_list'][0]['country_name'];
			$data['state_id']=$data['city_list'][0]['state_id'];
			$data['state_name']=$data['city_list'][0]['state_name'];
		}
		
		$data=$this->messages('city',$data);
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('master/city',$data);
		$this->load->view('footer',$data);
		}
		else
		{
			redirect(admin_path,'refresh');
		}
		
	}
	
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function add_city($state_id=0)
	{
		if(is_numeric($state_id))
		{
			$data= array(
	        'page_title' =>'State',
	        'menu1'=>182,
	        'menu'=>18,
	                   
	        );
	        $data['user_details']=$this->session->userdata('user');
	        if($state_id==0)
	        {
				$data['form_data']=array('state_id'=>'','city_name'=>'');				
			}
			else
			{
				$data['form_data']=array('state_id'=>$state_id,'city_name'=>'');
				
			}
			
	        $data=$this->messages('add_city',$data);
	        $data['state_list']=$this->common_lib->options_select('state_id','state_name',$this->common_model->state_list_all(),$data['form_data']['state_id']);
	        
	        $this->load->view('header',$data);
			$this->load->view('side_menu_admin',$data);
			$this->load->view('master/add_city',$data);
			$this->load->view('footer',$data);
		}	
		else
		{
			redirect(admin_path,'refresh');
		}
		
	}
	
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function edit_city($id)
	{
		if(is_numeric($id))
		{
		$data= array(
            'page_title' =>'City',
            'menu1'=>163,
            'menu'=>16,
                       
        );
        $data['user_details']=$this->session->userdata('user');
        $data['form_data']=array('city_name'=>'','state_id'=>'');
        $result=$this->common_model->fetch_contents('city',array('city_id'=>$id));
        
        $data['form_data']=$result[0];
         $data=$this->messages('edit_city',$data);
        $data['state_list']=$this->common_lib->options_select('state_id','state_name',$this->common_model->state_list_all(),$data['form_data']['state_id']);
       
        $this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('master/edit_city',$data);
		$this->load->view('footer',$data);
		}
		else
		{
			redirect(admin_path,'refresh');
		}
	}
	//-----------------------------------------------------------------------------------------------------------------------------------------
	
	public function edit_city_process()
	{
		if($this->form_validation->run('edit_city')!==false)
		{
			$array['city_name']=$this->input->post('city_name');
			$array['state_id']=$this->input->post('state_id');
			$id=$this->input->post('city_id');
			$data=$this->input->post();
			$dublicate=$this->common_model->edit_dublicate_check('city',$array,$id);
			if($dublicate===false)
			{
				$insert_table=$this->common_model->update_table('city',$data,$id);
			if($insert_table===true)
			{
				$message='State Edited successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('edit_city'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_city'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
				
			}
			else
			{
				$message='Dublicate Entry';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_city'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			}
		else
		{
			    $message=validation_errors();
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_city'=>$report));
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function add_city_process()
	{
		if($this->form_validation->run('add_city')!==false)
		{
			$array['city_name']=$this->input->post('city_name');
			$array['state_id']=$this->input->post('state_id');
			$data=$this->input->post();
			$dublicate=$this->common_model->dublicate_check('city',$array);
			if($dublicate===false)
			{
				$insert_table=$this->common_model->insert_table('city',$data);
			if($insert_table===true)
			{
				$message="Citry added successfully";
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('add_city'=>$report));
			redirect($_SERVER['HTTP_REFERER'],'refresh');
				
			}
			else
			{
				$message="Please try again";
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_city'=>$report));
			redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
				
			}
			else
			{
				$message="Dublicate Entry";
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_city'=>$report));
			redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			
			
			
		}
		else
		{
			
			$message=validation_errors();
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_city'=>$report));
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

public function skills()
	{
		$data= array(
            'page_title' =>'Skills',
            'menu1'=>191,
            'menu'=>19,
                       
        );
        $data['user_details']=$this->session->userdata('user');
		
		$data['skill_list']=$this->common_model->__fetch_contents('skills',array('skill_removed'=>0));
		$data=$this->messages('skills',$data);
		$this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('master/skills',$data);
		$this->load->view('footer',$data);
	}
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function add_skill()
	{
		$data= array(
            'page_title' =>'Add Skill',
            'menu1'=>192,
            'menu'=>19,
                       
        );
        $data['user_details']=$this->session->userdata('user');
        $data['form_data']=array('skill_name'=>'','skill_description'=>'');
        $data=$this->messages('add_skill',$data);
        $this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('master/add_skill',$data);
		$this->load->view('footer',$data);
		
	}
	//-----------------------------------------------------------------------------------------------------------------------------------------	
	public function add_skill_process()
	{
		if($this->form_validation->run('add_skill')!==false)
		{
			$array['skill_name']=$this->input->post('skill_name');
			$array['skill_removed']=0;
			$data=$this->input->post();
			$dublicate=$this->common_model->__dublicate_check('skills',$array);
			if($dublicate===false)
			{
				$insert_table=$this->common_model->insert_table('skills',$data);
			if($insert_table===true)
			{
				$message='Skill added successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('add_skill'=>$report));
				redirect(admin_path.'add_skill','refresh');
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_skill'=>$report));
				redirect(admin_path.'add_skill','refresh');	
			}
				
			}
			else
			{
				$message='Dublicate Entry';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_skill'=>$report));
				redirect(admin_path.'add_skill','refresh');
			}
			
			
			
		}
		else
		{
			    $message=validation_errors();
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('add_skill'=>$report));
			redirect(admin_path.'add_skill','refresh');
		}
	}
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function edit_skill($id)
	{
		if(is_numeric($id))
		{
		$data= array(
            'page_title' =>'Edit Skill',
            'menu1'=>191,
            'menu'=>19,
                       
        );
        $data['user_details']=$this->session->userdata('user');
        $data['form_data']=array('skill_name'=>'','skill_description'=>'');
        $result=$this->common_model->__fetch_contents('skills',array('skill_id'=>$id));
        $data['form_data']=$result[0];
        $data=$this->messages('edit_skill',$data);
        $this->load->view('header',$data);
		$this->load->view('side_menu_admin',$data);
		$this->load->view('master/edit_skill',$data);
		$this->load->view('footer',$data);
		}
		else
		{
			redirect(admin_path,'refresh');
		}
	}
	//------------------------------------------------------------------------------------------------------------------------------------------
	public function edit_skill_process()
	{
		if($this->form_validation->run('edit_skill')!==false)
		{
			$array['skill_name']=$this->input->post('skill_name');
			$id=$this->input->post('skill_id');
			$data=$this->input->post();
			$dublicate=$this->common_model->__edit_dublicate_check('skills',$array,'skill_id',$id);
			if($dublicate===false)
			{
				$where_data['skill_id']=$id;
				$insert_table=$this->common_model->update_table_custom('skills',$data,$where_data);
			if($insert_table===true)
			{
				$message='Skill Edited successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('edit_skill'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
				
			}
			else
			{
				$message='Something Wrong';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_skill'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
				
			}
			else
			{
				$message='Dublicate Entry';
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_skill'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');
			}
			}
			else
		{
			    $message=validation_errors();
				$report=array('status'=>0,'form_data'=>$this->input->post(),'message'=>$message);
				$this->session->set_userdata('form',array('edit_skill'=>$report));
			redirect($_SERVER['HTTP_REFERER'],'refresh');
		}
	}

















//-----------------------------------------------------------------------------------------------------------------*********** All Delete ***********

	
	public function delete_country($id)
	{
		if(is_numeric($id))
		{
			$data=array('countries_removed'=>'1');
			$insert_table=$this->common_model->update_table_custom('countries',$data,array('country_id'=>$id));      
			if($insert_table===true)
			{
				$message='Deleted Successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('country'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
			else
			{
				$message='Deleting Failed';
				$report=array('status'=>0,'message'=>$message);
				$this->session->set_userdata('form',array('country'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
			
		}
		else
		{
			redirect(admin_path,'refresh');
		}
	}
	
	
	public function delete_state($id)
	{
		if(is_numeric($id))
		{
			$data=array('state_removed'=>'1');
			$insert_table=$this->common_model->update_table('state',$data,$id);      
			if($insert_table===true)
			{
				$message='Deleted Successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('state'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
			else
			{
				$message='Deleting Failed';
				$report=array('status'=>0,'message'=>$message);
				$this->session->set_userdata('form',array('state'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
			
		}
		else
		{
			redirect(admin_path,'refresh');
		}
	}

	public function delete_city($id)
	{
		if(is_numeric($id))
		{
			$data=array('city_removed'=>'1');
			$insert_table=$this->common_model->update_table('city',$data,$id);      
			if($insert_table===true)
			{
				$message='Deleted Successfully';
				$report=array('status'=>1,'message'=>$message);
				$this->session->set_userdata('form',array('city'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
			else
			{
				$message='Deleting Failed';
				$report=array('status'=>0,'message'=>$message);
				$this->session->set_userdata('form',array('city'=>$report));
				redirect($_SERVER['HTTP_REFERER'],'refresh');	
			}
			
		}
		else
		{
			redirect(admin_path,'refresh');
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
	//-----------------------------------------------------------------------------------------------------------------------------------------
	public function alpha_with_space($str)
	{
		if (! preg_match("/^([-a-z_ +])+$/i", $str))
		{
			$this->form_validation->set_message('alpha_with_space', 'The %s should alphabeticals');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}

