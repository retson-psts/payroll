<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Validate_login {
  private $byzero;
  public function __construct()
   {
	 $this->byzero = & get_instance();
	$this->byzero->load->model(array('common_model'));
	/*date_default_timezone_set('Asia/Kolkata');*/
	$this->login_validate();
   }
   
   public function login_not_using_pages()
   {
   	$array=array('login','ApiDataController');
   	return $array;
   }
   
  /**
  *  login validate function
  *  this method works every page loads and it wllvalidate the every page realoding
  * 
  * @return
  */
   public function login_validate()
   {
   	//var_dump($this->byzero->session->userdata[user_id]);
   
   	  if(!isset($this->byzero->session->userdata[user_id]))
   	  {
   	  		
   	  	$varx=explode('/',uri_string());
   	  	if(in_array($varx[0],$this->login_not_using_pages()))
   	  	{
   	  		//redirect('login', 'refresh');
			
		}
		else
		{
			$this->byzero->session->set_userdata('url_login',uri_string());
			redirect(site_path.'login', 'refresh');
			
		}
   	     	
	  	
	  }
	  else
	  {
	  	if(uri_string()=='login')
	  	{
	  		$this->update_session();
			redirect(site_path, 'refresh');
		}
		else
		{
			$result=$this->check_permission();
			
			if($result==FALSE)
			{
				redirect(site_path, 'refresh');
			}
			else
			{
				$this->update_session();	
			}
			
		}
	  	
	  }
   }
   
   /**
   * update session will check that current session and change it into 
   * current time and validtill
   * 
   * @return true or redirect to login page
   */
   public function update_session()
   {
   	$log_details=$this->byzero->common_model->fetch_contents('log',array('log_id'=>$this->byzero->session->userdata[user_id]));
   $valid_till=$log_details[0]['log_valid_till']+valid_till;
    if($valid_till>=time())
   {
   	$id=$this->byzero->session->userdata(user_id);
   	$data=array('log_valid_till'=>$valid_till,'log_time_of_sec'=>date('Y-m-d H:i:s'),'log_last_accessed'=>time());
   	 $this->byzero->common_model->update_table('log',$data,$id);
   	
   }
   else
   {
   	  	$this->byzero->session->unset_userdata(user_id);
   		$message="<p>Your Session Expired</p>";
		$report=array('status'=>0,'form_data'=>'','message'=>$message);
		$this->byzero->session->unset_userdata('user');
		$this->byzero->session->set_userdata('url_login',uri_string());
		$this->byzero->session->set_userdata('form',array('login'=>$report));
		redirect(site_path.'login','refresh');
   }
   
   	
   	
   }
   
   
  
  	/**
	  * 
	  * 
	  * @return 
	  */
  	public function check_permission()
  	{
  		
		$url=$this->byzero->router->fetch_class();
		//var_dump($url);
		$user=$this->byzero->session->userdata('user');
		if($user['group_id']==1)
		{
			return TRUE;
		}
		else
		{
			$allowed=$this->byzero->common_model->permission_check($url);
			if($allowed!=FALSE)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
			
		}
	}
  /* public function is_logged()
   {
	   if(!empty($this->byzero->session->userdata['logged_in']))
	   {
		   if($this->check_session()==true)
		   {
			   return TRUE;
		   }
		   else
		   {   
		       $this->byzero->session->unset_userdata('logged_in');
			   return false;
		   }
	   }
	   else
	   {
		   $this->byzero->session->userdata('login_error');
		   return FALSE;
	   }
   }
   public function check_session()
   {
	   $session_id=$this->byzero->session->userdata['my_session_id'];
	   $session=$this->byzero->user->check_session($session_id);
	   if($session!=FALSE)
	   {
		   return TRUE;
	   }
	   else
	   {
		   return false;
	   }
   }
   public function is_admin()
   {
	   $dir=$this->byzero->uri->segment(1);
	   if($dir==admin_folder)
	   {
		   $session_data = $this->byzero->session->userdata('logged_in');
		   if($session_data['uac']=='777')
		   {
			   return TRUE;
		   }
		   else
		   {
			   return false;
		   }
	   }
	   else
	   {
		   return TRUE;
	   }
   }
   public function validate_login()
   {
	  if($this->is_logged()==TRUE)
	  { 
		$session_id=$this->byzero->session->userdata['my_session_id'];
		$this->byzero->db->select('last_activity,user_data');
		$this->byzero -> db -> from('sessions');
		$this->byzero->db->where('session_id',$session_id);
		$this->byzero -> db -> limit(1);
		$query = $this->byzero -> db -> get();
		if($query -> num_rows() == 1)
		{
		  $results=$query->result();
  		  $active_session=$this->session_alive($results[0]->last_activity,$session_id);
		  if($active_session==TRUE)
		  {
			  return TRUE;
		  }
		  else
		  {
			  $this->logout();
		  }
		}
		else
		{
		  return false;
		}
	  }
	  else
	  {
		  return false;
	  }
   }
   public function session_alive($valid_till,$session_id)
   {
	   $time_limit=$this->byzero->config->item('sess_expiration');
	   if (time() - $valid_till > $time_limit) 
		{
			print "<script type=\"text/javascript\">alert('Sorry, Your Session Ends. Please Login Again');</script>";
			return FALSE;
		}
		else
		{
			if($this->update_session($session_id)==TRUE)
			{
				return TRUE;
			}
			else
			{
				return FALSE;
			}
		}
   }
   public function update_session($session_id)
   {
	   $new_time=time();
	   $this->byzero->session->set_userdata('last_activity', $new_time);
	   $data=array('last_activity'=>$new_time);
	   $this->byzero->db->where('session_id', $session_id);
	   $this->byzero->db->update('sessions', $data); 
	   return TRUE;	   
   }
   public function logout()
   {
	   $this->byzero->users_lib->logout();
   }*/
}