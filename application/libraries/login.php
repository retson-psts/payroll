<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class login {
  private $byzero;
  function __construct()
   {
	 $this->byzero = & get_instance();
   }
   function check_databases($password)
   {
	 $username = $this->input->post('username');
	 $result = $this->loginuser->login($username, $password);
	 if($result)
	 {
	   $sess_array = array();
	   foreach($result as $row)
	   {
		 $sess_array = array('id' => $row->id,'username' => $row->username,'fname'=> $row->fname,'lname'=> $row->lname,'email'=> $row->email,'uac'=> $row->uac,'mobile'=> $row->mobile,'photo_url'=>$row->photo_url,'joined_date'=>$row->joined_date,'gender'=>$row->gender,'address'=>$row->address);
		 $this->session->set_userdata('logged_in', $sess_array);
	   }
	   $this->insert_session();
	   return TRUE;
	 }
	 else
	 {
	   $this->form_validation->set_message('check_database', 'Invalid username or password');
	   return false;
	 }
   }
   function insert_session()
   {
	 $uniqueId = uniqid($this->session->userdata['ip_address'], TRUE);
	 $this->session->set_userdata("my_session_id", md5($uniqueId));
	 $ip_address=$this->session->userdata['ip_address'];
	 $last_activity=$this->session->userdata['last_activity'];
	 $user_agent=$this->session->userdata['user_agent'];
	 $logged_in=$this->session->userdata['logged_in'];
	 $logged_in1=serialize($logged_in);
	 $start_time=time();
	 $data=array('session_id'=>md5($uniqueId),'ip_address'=>$ip_address,'start_time'=>$start_time,'last_activity'=>$last_activity,'user_agent'=>$user_agent,'user_data'=>$logged_in1);
	 $query=$this->db->insert('sessions', $data);  
	 if($query==TRUE)
	 {
		 return TRUE;   
	 }
	 else
	 {
		 return FALSE;
	 }
   }
   function delete_session()
   {
	 /*$session_id=$this->session->userdata['my_session_id'];*/
	 $data=array('session_id'=>$session_id);
	 $this->db->delete('sessions', $data);
   }
   function logout()
	{
		$this->delete_session();
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}
}