<?php
ob_start();
if (!defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH."/third_party/pdf/tcpdf1/tcpdf.php";
class Pdf
{
    private $byzero;
    public function __construct()
    {
	 $this->byzero = & get_instance();
    }
}
