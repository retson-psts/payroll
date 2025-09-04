<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class BYZERO_Send_email{
	 private $byzero;
	 private $config;
	 function __construct()
	 {
	   $this->byzero = & get_instance();
	   $this->config = array('smtp_host' => $_SERVER['HTTP_HOST'],
							 'mailtype' => 'html',
							 'mailpath' => '/usr/sbin/sendmail',
							 'wordwrap' => TRUE);
	   $this->byzero->load->library('email');					 
	 }
	 public function send_emails($to,$subject,$message)
	 {
		$host=$_SERVER['HTTP_HOST'];
		$this->byzero->email->initialize($this->config);
		$message="<html><body>".$message."</body></html>";
		$this->byzero->email->from(default_mail_id.$host, site_title);
		$this->byzero->email->to($to);
		$this->byzero->email->subject($subject);
		$this->byzero->email->message($message);
		if($this->byzero->email->send())
		{
			return true;
		}
		else
		{
			return false;
		}
	 }
}