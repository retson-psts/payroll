<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Giro_lib 
{
   private $byzero;
   public function __construct()
   {
	 $this->byzero = & get_instance();
	
   }
   /**
   * @method function giro_preview(month,$bank)
   * @author BYZ0004
   * @tutorial It will return array of values accessible from bank
   * 
   * @param date $month - yyyy-mm
   * 
   * @return mixed array or boolean
   */
   public function giro_preview($month,$bank=4)
   {
   	$this->byzero->load->model('giro_model');
   	switch($bank)
   	{
		case 4:
		  return $this->byzero->giro_model->giro_month($month);
		default;
		  return false;
		  
	}
   	
   }
}