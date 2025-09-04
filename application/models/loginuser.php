<?php
Class Loginuser extends CI_Model
{
 public function login($username, $password)
 {
   $this -> db -> select('*');
   $this -> db -> from('users');
   $this -> db -> where('username', $this->db->escape_str($username));
   $this -> db -> where('password', $this->db->escape_str(md5($password)));
   $this -> db -> where('verified', 1);
    $this -> db -> where('uac', '255');
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
   $this -> db -> where('id', $this->db->escape_str($id));
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
  public function user_detail($id)
  {
	  $this -> db -> select('*');
	  $this -> db -> from('users');
	  $this -> db -> where('id', $id);
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
	  $this -> db ->where('id',$user_id);
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
}


