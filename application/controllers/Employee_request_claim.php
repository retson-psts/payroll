<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Employee_request_claim extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'form_validation'
        ));
        $this->load->model('allowance_model');
    }
    public function index()
    {
        $user_id              = $this->session->userdata['logged_in']['user_id'];
        $page_name            = $this->router->fetch_class();
        $data['user_details'] = $this->users_lib->get_logged_user_details($user_id);
        $data['page_title']   = "Claim Request";
        $data['allowance_list'] = $this->allowance_model->allowance_types();
        $this->load->view('header', $data);
        $this->load->view('employee/side_menu_employee', $data);
        $this->load->view('employee/employee_request_claim', $data);
        $this->load->view('footer');
    }
    public function add_allowance()
    {
    	$uploaddir = upload_path . 'uploads/temp/';
        if ($this->input->is_ajax_request())
        {
        	$actual_image_name="";
            if (isset($_GET['files']))
            {
                $error = false;
                $files = array();
                $msg1  = "";
                $files=array();
                
                foreach ($_FILES as $file)
                {
                    $txt = "allowancefile";
                    
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
                        "BMP",
                        'doc',
                        'docx',
                        'pdf',
                        'PDF',
                        'DOC',
                        'DOCX'
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
            if ($this->form_validation->run('emp_allowance') !== false)
            {
                
                $user_id                     = $this->session->userdata['logged_in']['user_id'];
                $employee_id              = $this->session->userdata['logged_in']['employee_id'];
                $datetime                    = date('Y-m-d H:i:s');
                $data                        = $this->input->post();
                $data['employee_id']         = $employee_id;
                $data['emp_allowance_month'] = date('Y-m') . "-01";
                if (!empty($data['emp_allowance_date']))
                {
                    $x1                         = explode('-', $data['emp_allowance_date']);
                    $data['emp_allowance_date'] = $x1[2] . "-" . $x1[1] . "-" . $x1[0];
                }
                else
                {
                    $data['emp_allowance_date'] = '0000-00-00';
                }
                if (isset($data['filenames']))
                {
                    $data['emp_allowance_filename'] = implode($data['filenames']);
                    rename($uploaddir.$data['emp_allowance_filename'],upload_path . 'uploads/attachment/'.$data['emp_allowance_filename']);
                    unset($data['filenames']);
                }
                $data1 = $data;
                $range = $data['range'];
                $rr    = explode(' - ', $range);
                if (!empty($rr) && count($rr) == 2)
                {
                    $data['emp_allowance_from'] = $rr[0];
                    $data['emp_allowance_to']   = $rr[1];
                    
                }
                unset($data['range']);
                $data['emp_allowance_added']    = $datetime;
                $data['emp_allowance_added_by'] = $user_id;
                
                unset($data1['emp_allowance_reason']);
                unset($data1['emp_allowance_amount']);
                unset($data1['range']);
                unset($data1['emp_allowance_date']);
                /*var_dump($data1);*/
                $dublicate_check = $this->common_model->dublicate_check('emp_allowance', $data1);
                if ($dublicate_check === false)
                {
                    $insert_table = $this->common_model->insert_table('emp_allowance', $data);
                    if ($insert_table === true)
                    {
                        $message = 'Allowance added successfully';
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
                    $message = 'Already Added';
                    $report  = array(
                        'status' => 2,
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