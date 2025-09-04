<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Add_employer extends CI_Controller {
	public function __construct()
	 {
	   parent::__construct();
	  // $this->load->library();
	  // $this->load->model();
    }
	public function index()
	{
		$user_id=$this->session->userdata['logged_in']['user_id'];
		$page_name=$this->router->fetch_class();
		$data['user_details']=$this->users_lib->get_logged_user_details($user_id);
		//$data['message_div']=$this->messages();
		$data['menu']=13;
	  $data['menu1']=131;
		$data['page_title']="Add Employer";
		$this->load->view('header',$data);
	    $this->load->view('side_menu_admin',$data);
	   $this->load->view('employer_add',$data);
	    $this->load->view('footer');
	}
	public function add_employer1()
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
            if ($this->form_validation->run('employer') !== false)
            {
                
                
                	$data = $this->input->post();
                	if(isset($data['filenames']))
                	{
						$data['employer_photo']=$data['filenames'][0];
	                	unset($data['filenames']);
    	            	

					}
					if($data['employer_password']==$data['employer_cpassword'])
					{
						
					$this->load->model('employer_model');
                	$insert_table = $this->employer_model->add_employer($data);
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
