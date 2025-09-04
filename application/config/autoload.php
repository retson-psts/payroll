<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('session','validate_login','database','users_lib','uac_lib','common_lib','html_lib');
$autoload['helper'] = array('url');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('user','common_model');
