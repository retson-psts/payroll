<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	 $this->load->library('form_validation');
	  // $this->load->model();
    }
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$contents=$this->common_model->fetch_contents('company_config',array('company_id'=>1));
		$data['contents']=$contents[0];
		$this->load->model('employer_model');
		$data['employer']=$this->employer_model->list_employers();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['page_title']="Company Settings";
		$this->load->view('header',$data);
	    $this->load->view('side_menu_admin',$data);
	    $this->load->view('company_view',$data);
	    $this->load->view('footer');
	}
	public function add_company()
	{
		$actual_image_name='';
		$uploaddir = upload_path . 'uploads/temp/';
        if ($this->input->is_ajax_request())
        {
            if (isset($_GET['files']))
            {
                $error = false;
                $files = array();
                $msg1  = "";
                $files=array();
                
                foreach ($_FILES as $file)
                {
                    $txt = "logo";
                    
                    $valid_formats = array(
                        "jpg",
                        "png",
                        "gif",
                        "bmp",
                        "jpeg",
                        "PNG",
                        "JPG",
                        "JPEG",
                        "GIF",
                        "BMP"
                        
                    );
                    $name          = $file['name'];
                    $size=filesize($file['tmp_name']);
                    if (strlen($name))
                    {
                        $ext = $this->getExtension($name);
                        if (in_array($ext, $valid_formats))
                        {
                            if ($size < (1024 * 1024))
                            {
                                $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 0) . "." . $ext;
                                $tmp               = $file['tmp_name'];
                                
                                if (move_uploaded_file($tmp, $uploaddir . $actual_image_name))
                                {
                                    $files[] = $actual_image_name;
                                }
                                else
                                {
                                    $error = true;
                                    $msg1  = "Uploading File Error";
                                }
                            }
                            else
                            {
                                $error = true;
                                $msg1  = "Size Exceeded than 1 mb";
                            }
                        }
                        else
                        {
                            $error = true;
                            $msg1  = "Invalid Format";
                        }
                    }
                    else
                    {
						
					}
                    /*if(move_uploaded_file($file['tmp_name'], $uploaddir .basename($file['name'])))
                    {
                    $files[] = $file['name'];
                    }
                    else
                    {
                    $error = true;
                    }*/
                    
                }
                $data = ($error) ? array( 'error' => $msg1,'upload'=> '' ) : array('files' => $files,'upload'=> $actual_image_name );
                echo json_encode($data);
                exit;
            }
            if ($this->form_validation->run('company') !== false)
            {
                
                
                	$data = $this->input->post();
                	if(isset($data['filenames']))
                	{
						$data['company_logo']=$data['filenames'][0];
	                	unset($data['filenames']);
    	            	rename($uploaddir.$data['company_logo'],upload_path.'images/'.$data['company_logo']);

					}
                	$insert_table = $this->common_model->update_table_custom('company_config', $data,array('company_id'=>1));
                    if ($insert_table === true)
                    {
                        $message = 'Company updated successfully';
                         $company_details=$this->common_model->__fetch_contents('company_config',array(),'*');
                        $this->session->set_userdata('company',$company_details[0]);
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
                $message = validation_errors();
                $report  = array(
                    'status' => 0,
                    'message' => $message
                );
                echo json_encode($report);
            }
            
            
        }
        else
        {
            $message = "Direct Access not allowed";
            
            $report = array(
                'status' => 0,
                'message' => $message
            );
            echo json_encode($report);
        }
	
	}
	public function ir8asettings()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$form=array('ir8a_authorised_person'=>'','ir8a_authorised_designation'=>'','ir8a_authorised_roc'=>'','ir8a_authorised_email'=>'','ir8a_authorised_company_type'=>'');
		$contents=$this->common_model->__fetch_contents('ir8a_authorised',array('ir8a_authorised_removed'=>0),'*','','ir8a_authorised_id desc');
		$data['menu']=12;
		$data['menu1']=123;
		$data['contents']=$form;
		if(!empty($contents))
		{
		$data['contents']=$contents[0];	
		}
		
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['page_title']="IR8A";
		$this->load->view('header',$data);
	    $this->load->view('side_menu_admin',$data);
	    $this->load->view('ir8asetting_view',$data);
	    $this->load->view('footer');
	}
	public function ir8a_add()
	{
		if ($this->input->is_ajax_request())
    {
    	if($this->form_validation->run('company/ir8a_add'))
		{
			$data=$this->input->post();
			$emp_id=$this->common_model->insert_table('ir8a_authorised',$data);
			//$emp_id=$this->employee_model->add_contact($data);
    		if($emp_id!==false)
			{
				$message='IR8A Setting updated successfully';
				
				$url="";
		        $report = array('status' => 1,'message' => $message,'url'=>$url);
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

	public function giro_setup()
	{
		$this->load->model('settings_model');
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$contents=$this->settings_model->giro_list();
		$data['bank_list']=$this->common_model->__fetch_contents('bank_list',array('bank_list_removed'=>0));
		$data['menu']=12;
		$data['menu1']=124;
		$data['contents']=$contents;
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['page_title']="GIRO Setup";
		$this->load->view('header',$data);
	    $this->load->view('side_menu_admin',$data);
	    $this->load->view('giro_setup_view',$data);
	    $this->load->view('footer');
	}
	
	public function giro_add()
	{
	if ($this->input->is_ajax_request())
    {
    	if($this->form_validation->run('company/giro_add'))
		{
			$data=$this->input->post();
			$emp_id=$this->common_model->insert_table('giro_setup',$data);
			//$emp_id=$this->employee_model->add_contact($data);
    		if($emp_id!==false)
			{
				$message='GIRO Setting added successfully';
				
				$url="";
		        $report = array('status' => 1,'message' => $message,'url'=>$url);
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
	
	public function giro_edit()
	{
	if ($this->input->is_ajax_request())
    {
    	if($this->form_validation->run('company/giro_edit'))
		{
			$data=$this->input->post();
			$where_data['giro_setup_id']=$data['id'];
			unset($data['id']);
			$emp_id=$this->common_model->update_table_custom('giro_setup',$data,$where_data);
			//$emp_id=$this->employee_model->add_contact($data);
    		if($emp_id!==false)
			{
				$message='GIRO setup updated successfully';
				
				$url="";
		        $report = array('status' => 1,'message' => $message,'url'=>$url);
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

	

	public function remove_giro($id=0)
  	{
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->update_table('giro_setup',array('giro_setup_removed'=>1),$id);
  		if($result!==false)
  		{
			
			$message = 'GIRO Setup Removed Successfully';
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
	else
	{
		 show_error("No direct access allowed");
	}
  	
  }

	
	public function csn_setup()
	{
		$this->load->model('settings_model');
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['contents']=$this->common_model->__fetch_contents('csn',array('csn_removed'=>0));
		$data['menu']=12;
		$data['menu1']=125;
		
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		$data['page_title']="CSN Setup";
		$this->load->view('header',$data);
	    $this->load->view('side_menu_admin',$data);
	    $this->load->view('csn_view',$data);
	    $this->load->view('footer');
	}
	
	
	public function csn_add()
	{
	if ($this->input->is_ajax_request())
    {
    	if($this->form_validation->run('company/csn_add'))
		{
			$data=$this->input->post();
			$emp_id=$this->common_model->insert_table('csn',$data);
			//$emp_id=$this->employee_model->add_contact($data);
    		if($emp_id!==false)
			{
				$message='CSN Setup added successfully';
				
				$url="";
		        $report = array('status' => 1,'message' => $message,'url'=>$url);
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
	
	public function csn_edit()
	{
	if ($this->input->is_ajax_request())
    {
    	if($this->form_validation->run('company/csn_edit'))
		{
			$data=$this->input->post();
			$where_data['csn_id']=$data['id'];
			unset($data['id']);
			$emp_id=$this->common_model->update_table_custom('csn',$data,$where_data);
			//$emp_id=$this->employee_model->add_contact($data);
    		if($emp_id!==false)
			{
				$message='GIRO setup updated successfully';
				
				$url="";
		        $report = array('status' => 1,'message' => $message,'url'=>$url);
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

	public function csn_remove($id=0)
  	{
  
    if ($this->input->is_ajax_request())
    {
  	if(!empty($id) && is_numeric($id))
  	{
  		
  		
  		$result=$this->common_model->update_table('csn',array('csn_removed'=>1),$id);
  		if($result!==false)
  		{
			
			$message = 'CSN Setup Removed Successfully';
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
	else
	{
		 show_error("No direct access allowed");
	}
  	
  }
	
	
	protected function getExtension($str)
    {
        
        $i = strrpos($str, ".");
        if (!$i)
        {
            return "";
        }
        
        $l   = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }
	public function existgiro($id,$type)
  	{
  	
  		$acc=$this->input->post('giro_setup_account');
  		$branch=$this->input->post('giro_setup_branch_code');
  		$value=$this->input->post('giro_setup_valuedate');
  		$bank=$this->input->post('giro_setup_bank');
  	if($type==0)
  	{
  		$where_data=array('giro_setup_account'=>$acc,'giro_setup_branch_code'=>$branch,'giro_setup_valuedate'=>$value,'giro_setup_bank'=>$bank,'giro_setup_removed'=>0);
  		
  		
		
	}
	else
	{
		$id=$this->input->post('id');
		$where_data=array('giro_setup_account'=>$acc,'giro_setup_branch_code'=>$branch,'giro_setup_valuedate'=>$value,'giro_setup_bank'=>$bank,'giro_setup_id <>'=>$id,'giro_setup_removed'=>0);
		
		
	}
	$list=$this->common_model->__fetch_contents('giro_setup',$where_data);
    if($list!==FALSE)
    {
    		$this->form_validation->set_message('existgiro', 'Already added');
			return FALSE;
	}
	else
	{
			return TRUE;
	}
    
  }
	public function csnexist($id,$type)
  	{
  	
  		$roc=$this->input->post('csn_roc');
  		$type=$this->input->post('csn_type');
  		$sno=$this->input->post('csn_sno');
  	if($type==0)
  	{
  		$where_data=array('csn_roc'=>$roc,'csn_type'=>$type,'csn_sno'=>$sno,'csn_removed'=>0);
  		
  		
		
	}
	else
	{
		$id=$this->input->post('id');
		$where_data=array('csn_roc'=>$roc,'csn_type'=>$type,'csn_sno'=>$sno,'csn_id <>'=>$id,'csn_removed'=>0);
		
		
	}
	$list=$this->common_model->__fetch_contents('csn',$where_data);
    if($list!==FALSE)
    {
    		$this->form_validation->set_message('csnexist', 'Already added');
			return FALSE;
	}
	else
	{
			return TRUE;
	}
    
  }	
  
}
