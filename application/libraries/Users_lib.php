<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_lib 
{
   private $byzero;
  public function __construct()
   {
	 $this->byzero = & get_instance();
	 $this->byzero->load->model(array('user'));
	 $this->byzero->load->library(array('send_email'));
   }
   
   
   public function register_user($user_name,$f_name,$l_name,$email,$password,$dob,$country,$state,$city)
   {
	   $activation_key=$this->generate_link($email);
	   $activation_link=$this->generate_activation_link($activation_key,1);
	   $dob1=$dob['year'].'-'.$dob['month'].'-'.$dob['date'];
	   $inser_user=$this->byzero->user->register_user($user_name,$f_name,$l_name,$email,$password,$dob1,$country,$state,$city,$activation_key);
	   if($inser_user==TRUE)
	   {
		   $subject="Registration Succesful";
		   $message="Congrulations! Account has succesfully Created. <br/>Your username is <strong>".$user_name."</strong>.<br/>Please ".anchor($activation_link,' Click this activation link')." to activate your account";
		   $send_mail=$this->byzero->send_email->send_emails($email,$subject,$message);
		   if($send_mail==TRUE)
		   {
			   return array(true,true);
		   }
		   else
		   {
			   return array(true,false);
		   }
	   }
	   else
	   {
		   return array(false,false);
	   }
   }

	 
	public function get_user_id()
	{
		return $this->session->userdata['logged_in']['user_id'];
	}
	
	
//	
	public function get_logged_user_details($user_id)
	{
		$user_data=$this->byzero->session->userdata['logged_in'];
	    if(!empty($user_data))
	    {
		    $user_info=$this->byzero->user->get_user_info($user_id);
			if($user_info!=false)
			{
				$generate_profile_pic=array('user_portal_profile_photo'=>$user_info['0']->photo_url);
				return (object)array_merge((array)$user_info['0'],(array)$generate_profile_pic);
			}
			return false;
	    }
	    else
	    {
		    return FALSE;
	    }
	}
	 
	 
	 
	public function login_portal_user($portal,$email,$profile_id)
	{
		// create a session and insert the session in db
		$user_details=$this->byzero->user->portal_login($email);
		if($user_details==TRUE)
		{
			$sess_array = array();
			foreach($user_details as $row)
			{
			   $sess_array = array('user_id' => $row->user_id,'username' => $row->username,'first_name'=> $row->fname,'last_name'=> $row->lname,'email'=> $row->email,'group_id'=>$row->group_id,'uac'=> $row->uac,'mobile'=> $row->mobile,'photo_url'=>$row->photo_url,'joined_date'=>$row->joined_date,'gender'=>$row->gender,'address'=>$row->address,'portal'=>$portal);
			}
			$this->byzero->session->set_userdata('logged_in', $sess_array);
			if($this->byzero->user->insert_session($portal)==TRUE)
			{
				// session created and instered in the session
				// we check for profile picture in local db. if no photo is uploaded, it will fetch the users portal id ..
				if($user_details['0']->user_portal_id=='')
				{
					$insert_portal_id=$this->byzero->user->insert_portal_id($user_details['0']->id,$profile_id);
				}
				die();
				return true;
			}
			else
			{
				//if insert into session failed in db
				// logout will be initiated for session (loogge_in) values
				$this->insert_session_failed();
				return false;
			}
		}
		else
		{
			return false;
		}
	}
   public function generate_activation_link($activation_key,$type)
   {
	  $this->byzero->load->helper(array('url','html'));
	  // $type=1 - Creating the user
	  // $type=2 - Forgetteen password link
	  if($type==2)
	  {
		  return  $url=site_url("forgot_password/change_pass/$activation_key");
	  }
	  else
	  {
		  return  $url=site_url("register/activate_user/$activation_key");
	  }
   }
   public function generate_link($email)
   {
	   $activation_key=sha1(mt_rand(10000,99999).time().$email);
	   return $activation_key;
   }
   public function profile_picture($user_id)
   {
	   if($photo_url!='')
		{
			return user_profile_photo_url.$photo_url;
		}
		elseif($gender=='male')
		{
			return user_profile_photo_url.'boy.png';
		}
		elseif($gender=='famale')
		{
			return user_profile_photo_url.'girl.png';
		}
		else
		{
			return user_profile_photo_url.'boy.png';
		}
   }
   public function insert_session_failed()
   {
	  $this->session->sess_destroy();
	  redirect(site_path.'login', 'refresh');   
   }
   public function logout()
   {
	  // $this->byzero->user->delete_session();
	   $this->byzero->session->unset_userdata('logged_in');
	   $this->byzero->session->sess_destroy();
	   redirect(site_path.'login', 'refresh');
   }
}