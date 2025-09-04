<?php
Class User extends CI_Model
{
	public function username_check($username)
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('username',$username);
		$query= $this -> db -> get();
		if($query -> num_rows() == 0)
	    {
		  return true;
	    }
	    else
	    {
		  return false;
	    }
	}
		public function user_id_check($user_id)
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('user_id',$user_id);
		$query= $this -> db -> get();
		if($query -> num_rows() == 0)
	    {
		  return false;
	    }
	    else
	    {
		  return true;
	    }
	}

	public function email_check($email)
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('email',$email);
		$query= $this -> db -> get();
		if($query -> num_rows() == 0)
	    {
		  return true;
	    }
	    else
	    {
		  return false;
	    }
	}
	public function register_user($user_name,$f_name,$l_name,$email,$password,$dob,$country,$state,$city,$activation_key)
	{
		$date=date('Y-m-d');
		$data=array('username'=>$this->db->escape_str($user_name),
				    'password'=>$this->db->escape_str(md5($password)),
				    'fname'=>$this->db->escape_str($f_name),
				    'lname'=>$this->db->escape_str($l_name),
				    'email'=>$this->db->escape_str($email),
					'dob'=>$this->db->escape_str($dob),
					'country'=>$this->db->escape_str($country),
					'state'=>$this->db->escape_str($state),
					'city'=>$this->db->escape_str($city),
				    'verified'=>'0',
				    'uac'=>'255',
				    'reset_key'=>$activation_key,
				    'joined_date'=>$this->db->escape_str($date));
	   $this->db->trans_begin();
	   $insert=$this->db->insert('users', $data); 
	   if ($this->db->trans_status() === FALSE)
	   {
		  $this->db->trans_rollback();
		  return false;
	   }
	   else
	   {
		  if($this->db->trans_commit())
		  {
			  return true;
		  }
		  else
		  {
			  return false;
		  }
	   }
	}
    public function register_other_portal_user($email,$fname,$lname,$gender,$portal,$user_portal_id)
	{
		$date=date('Y-m-d');
		$data=array('username'=>$this->db->escape_str($email),
				    'fname'=>$this->db->escape_str($fname),
				    'lname'=>$this->db->escape_str($lname),
				    'email'=>$this->db->escape_str($email),
					'gender'=>$this->db->escape_str($gender),
					'portal'=>$this->db->escape_str($portal),
					'user_portal_id'=>$this->db->escape_str($user_portal_id),
				    'verified'=>'1',
				    'uac'=>'255',
				    'joined_date'=>$this->db->escape_str($date));
	   $this->db->trans_begin();
	   $insert=$this->db->insert('users', $data); 
	   if ($this->db->trans_status() === FALSE)
	   {
		  $this->db->trans_rollback();
		  return false;
	   }
	   else
	   {
		  if($this->db->trans_commit())
		  {
			  return true;
		  }
		  else
		  {
			  return false;
		  }
	   }
	}
   public function login($username, $password)
   {
	 $this -> db -> select('*');
	 $this -> db -> from('users');
	 $this -> db -> where('username', $this->db->escape_str($username));
	 $this -> db -> where('password', $this->db->escape_str(md5($password)));
	 $this -> db -> where('verified', '1');
	 //$this -> db -> where('uac', '255');
	 $query = $this -> db -> get();
	 /*var_dump($this->db->last_query());
	 die();*/
	 if($query -> num_rows() == 1)
	 {
	   return $query->result();
	 }
	 else
	 {
	   return false;
	 }
   }
   public function portal_login($email)
   {
	 $this -> db -> select('*');
	 $this -> db -> from('users');
	 $this -> db -> where('email', $this->db->escape_str($email));
	 //$this -> db -> where('verified', 1);
	 //$this -> db -> where('uac', '255');
	 $query = $this -> db -> get();
	 if($query -> num_rows() == 1)
	 {
	   return $query->result();
	 }
	 else
	 {
	   return false;
	 }
   }
   public function insert_portal_id($user_id,$portal_id)
   {
	   $data=array('user_portal_id'=>$portal_id);
	   $this->db->trans_begin();
	   $this->db->where('id',$user_id); 
	   $this->db->update('users',$data);  
	   if ($this->db->trans_status() === FALSE)
	   {
		  $this->db->trans_rollback();
		  return false;
	   }
	   else
	   {
		  if($this->db->trans_commit())
		  {
			  return true;
		  }
		  else
		  {
			  return false;
		  }
	   }
   }
   public function admin_login($username, $password)
   {
	 $this -> db -> select('*');
	 $this -> db -> from('users');
	 $this -> db -> where('username', $this->db->escape_str($username));
	 $this -> db -> where('password', $this->db->escape_str(md5($password)));
	 $this -> db -> where('verified', 1);
	 $this -> db -> where('uac', '777');
	 $query = $this -> db -> get();
	 if($query -> num_rows() == 1)
	 {
	   return $query->result();
	 }
	 else
	 {
	   return false;
	 }
   }
   public function update_admin_session($id,$username)
   {
	   $this -> db -> select('*');
	   $this -> db -> from('users');
	   $this -> db -> where('user_id', $this->db->escape_str($id));
	   $this -> db -> where('username', $this->db->escape_str($username));
	   $this -> db -> where('uac', '777');
	   $query = $this -> db -> get();
	   if($query -> num_rows() == 1)
	   {
		 return $query->result();
	   }
	   else
	   {
		 return false;
	   }
   }
   public function update_user($fname,$lname,$mobile,$gender,$email,$address,$password,$image,$id)
   {
	   $pwd=array();
	   if($password!='') $pwd=array('password'=>$this->db->escape_str(md5($password)));
	   $data=array('fname'=>$this->db->escape_str($fname),
				   'lname'=>$this->db->escape_str($lname),
				   'email'=>$this->db->escape_str($email),
				   'mobile'=>$this->db->escape_str($mobile),
				   'gender'=>$this->db->escape_str($gender),
				   'address'=>$this->db->escape_str($address),
				   'photo_url'=>$this->db->escape_str($image)
				   );
	  $update_array=array_merge($data,$pwd);
	  $this->db->where('id',$id);
	  $this->db->update('users', $update_array);
	  if($this->db->affected_rows() == 1)
	   {
		 return true;
	   }
	   else
	   {
		 return false;
	   } 
   }
   public function enable_user($key)
   {
	   $key1=$this->db->escape_str($key);
	   $data=array('reset_id'=>'',
				   'verified'=>'1',
				   'status'=>'1');
	   $this->db->where('reset_id', $key1);
	   $this->db->update('users', $data); 
	   if($this->db->affected_rows() == 1)
	   {
		 return true;
	   }
	   else
	   {
		 return false;
	   }
   }
   
   //fetch user & user group informations 
    public function get_user_info($user_id)
	{
		$this->db->select('a.*,b.*');
		$this->db->from('users as a');
		$this -> db -> join('user_groups as b', 'a.group_id = b.user_group_id', 'left');
		$this->db->where('a.user_id',$user_id); 
		$query = $this -> db -> get();
		//echo $this -> db -> last_query();
		
		if($query -> num_rows() == 1)
		{
			return $query->result(); 
		}
		else
		{
			return false;
		}
	}
	public function get_user_info_by_username($username)
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('username',$username);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return $query->result(); 
		}
		else
		{
			return false;
		}
	}
    public function get_address($user_id)
    {
		$this -> db -> select(array('address','address2','city','state','country'));
		$this -> db -> from('users');
		$this -> db -> where('user_id',$user_id);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return $query->result(); 
		}
		else
		{
			return false;
		}
    }
	public function users_list()
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('uac', '255');
		$query = $this -> db -> get();
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function user_detail()
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('user_id', '1');
		$query = $this -> db -> get();
		if($query -> num_rows() >= 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	public function check_session($session_id)
	{
		$this->db->select('*');
		$this->db->from('sessions');
		$this->db->where('session_id',$session_id);
		$query = $this -> db -> get();
		if($query -> num_rows() >= 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function insert_session($portal='1')
	{
		//insert in db
		$uniqueId = uniqid($this->session->userdata['ip_address'], TRUE);
		$this->session->set_userdata("my_session_id", md5($uniqueId));
		$ip_address=$this->session->userdata['ip_address'];
		$last_activity=$this->session->userdata['last_activity'];
		$user_agent=$this->session->userdata['user_agent'];
		$logged_in=$this->session->userdata['logged_in'];
		$logged_in1=serialize($logged_in);
		$start_time=time();
		$data=array('session_id'=>md5($uniqueId),'ip_address'=>$ip_address,'start_time'=>$start_time,'last_activity'=>$last_activity,'user_agent'=>$user_agent,'user_data'=>$logged_in1,'portal'=>$portal);
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
	public function delete_session()
	{
		$session_id=$this->session->userdata['my_session_id'];
		$data=array('session_id'=>$session_id);
		$this->db->delete('sessions', $data);
	}
	public function insert_key($key,$email)
	{
		$data=array('reset_id'=>$key);
		$this->db->where('email',$email);
		$this->db->update('users', $data); 
		if($this->db->affected_rows() == 1)
		 {
		   return true;
		 }
		 else
		 {
		   return false;
		 }
	}
	public function valid_user_key($key)
	{
		$this -> db -> select('id');
		$this -> db -> from('users');
		$this -> db -> where('reset_id', $key);
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return $query -> result();
		}
		else
		{
			return false;
		}
	}
	public function update_password($password,$user_id)
	{
		$data=array('password'=>md5($password),
					'reset_id'=>'');
		$this -> db ->where('user_id',$user_id);
		$this -> db ->update('users',$data);
		if($this->db->affected_rows() == 1)
		{
		  return true;
		}
		else
		{
		  return false;
		}
	}
	public function admin_details()
	{
		$this -> db -> select('*');
		$this -> db -> from('company_config');
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return $query -> result();
		}
		else
		{
			return false;
		}
	}
}