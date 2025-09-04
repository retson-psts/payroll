<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Html_lib {
  private $CI;
  public function __construct()
   {
	 $this->CI = & get_instance();
   }
   public function alert_div($message)
   {
	   return "<div class='alert alert-danger alert-dismissable'>
				<i class='fa fa-info'></i>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>x</button>
				<b>Alert! </b>".$message."
			</div>";
   }
   public function success_div($message)
   {
	   return '<div class="alert alert-success alert-dismissable">
				<i class="fa fa-check"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
				<b>Alert! </b>'.$message.'
			</div>';
   }
}