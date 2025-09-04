<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_employer extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	   $this->load->library(array('form_validation'));
	   $this->load->model(array('employer_model'));
    }
	public function index()
	{
	  $user_id=$this->session->userdata['logged_in']['user_id'];
	  $page_name=$this->router->fetch_class();
	  $data['menu']=13;
	  $data['menu1']=132;
	  $data['user_details']=$this->users_lib->get_logged_user_details($user_id);
	  $data['employees_list']=$this->employer_model->list_employers();
	  $data['page_title']="List Employers";
	  $this->load->view('header',$data);
	  $this->load->view('side_menu_admin',$data);
	  $this->load->view('list_employer',$data);
	  $this->load->view('footer');
	}
	public function edit($id)
	{
		if(isset($id)&&(is_numeric($id)))
		{
			  $user_id=$this->session->userdata['logged_in']['user_id'];
			  $page_name=$this->router->fetch_class();
			  $data['menu']=13;
			  $data['menu1']=132;
			  $data['user_details']=$this->users_lib->get_logged_user_details($user_id);
			  $data['employer_detail']=$this->employer_model->employer_details($id);
			  $data['page_title']="Edit Employer";
			  $this->load->view('header',$data);
			  $this->load->view('side_menu_admin',$data);
			  $this->load->view('edit_employer',$data);
			  $this->load->view('footer');
		}
		else
		{
			redirect(site_path,'refresh');
		}
	}
	public function edit_employer1()
	{
		$actual_image_name='';
		$uploaddir = upload_path . 'uploads/temp/';
        if ($this->input->is_ajax_request())
        {
        	$this->load->library('form_validation');
            if (isset($_GET['files']))
            {
                $error = false;
                $files = array();
                $msg1  = "";
                $files=array();
                
                foreach ($_FILES as $file)
                {
                    $txt = "profile";
                    
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
            if ($this->form_validation->run('edit_employer') !== false)
            {
                
                	$employer_id=$this->input->post('employer_id');
					$user_id=$this->input->post('user_id');
                	$data = $this->input->post();
                	if(isset($data['filenames']))
                	{
						$data['employer_photo']=$data['filenames'][0];
	                	unset($data['filenames']);
    	            }
					if($data['employer_password']==$data['employer_cpassword'])
					{
						
					$this->load->model('employer_model');
                	$insert_table = $this->employer_model->edit_employer($data,$user_id,$employer_id);
                    if ($insert_table === true)
                    {
                    	if(isset($data['employer_photo']))
                		{
                    	rename($uploaddir.$data['employer_photo'],upload_path.'images/user_profile/'.$data['employer_photo']);
                    	}
                        $message = 'Employer added successfully';
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
						$message = array('employer_password'=>'Employer Password Not Matched with confirm password','employer_cpassword'=>'');
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
            $message = "Direct Access not allowed";
            
            $report = array(
                'status' => 0,
                'message' => $message
            );
            echo json_encode($report);
        }
	
	}
	public function usernamecheck()
	{
		$username=$this->input->post('employer_username');
		$employer_id=$this->input->post('employer_id');
		$user_id=$this->input->post('user_id');
		$array=array('username'=>$username);
		$valid_username=$this->common_model->__edit_dublicate_check('users',$array,'user_id',$user_id);
		if($valid_username==FALSE)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('usernamecheck','Invalid Username');
			return false;
		}
	}
	public function emailmecheck()
	{
		$email=$this->input->post('employer_email');
		$employer_id=$this->input->post('employer_id');
		$user_id=$this->input->post('user_id');
		$array=array('email'=>$email);
		$array1=array('employer_email'=>$email);
		$valid_email=$this->common_model->__edit_dublicate_check('users',$array,'user_id',$user_id);
		$valid_email1=$this->common_model->__edit_dublicate_check('employer',$array1,'employer_id',$employer_id);
		if(($valid_email==FALSE)&&($valid_email1==FALSE))
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('emailmecheck','Invalid Email');
			return false;
		}
	}
	public function passcheck()
	{
		$pass=$this->input->post('employer_password');
		$cpass=$this->input->post('employer_cpassword');
		if((empty($pass))&&(empty($cpass)))
		{
			return TRUE;
		}
		else
		{
			if($pass==$cpass)
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('passcheck','Employer Password Not Matched with confirm password');
				return FALSE;
			}
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
}
?>