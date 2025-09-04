<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



/*

|--------------------------------------------------------------------------

| File and Directory Modes

|--------------------------------------------------------------------------

|

| These prefs are used when checking and setting modes when working

| with the file system.  The defaults are fine on servers with proper

| security, but you may wish (or even need) to change the values in

| certain environments (Apache running a separate process for each

| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should

| always be used to set the mode correctly.

|

*/

define('FILE_READ_MODE', 0644);

define('FILE_WRITE_MODE', 0666);

define('DIR_READ_MODE', 0755);

define('DIR_WRITE_MODE', 0777);



/*

|--------------------------------------------------------------------------

| File Stream Modes

|--------------------------------------------------------------------------

|

| These modes are used when working with fopen()/popen()

|

*/



define('FOPEN_READ',							'rb');

define('FOPEN_READ_WRITE',						'r+b');

define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care

define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care

define('FOPEN_WRITE_CREATE',					'ab');

define('FOPEN_READ_WRITE_CREATE',				'a+b');

define('FOPEN_WRITE_CREATE_STRICT',				'xb');

define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('site_title',' HRM & Payroll System');

define('page_title_after',' :: HR & Payroll System');

//define('site_path','http://'.$_SERVER['SERVER_NAME'].'/demo/shipping/');

// define('site_path','http://'.$_SERVER['SERVER_NAME'].'/');

// define('upload_path',$_SERVER['DOCUMENT_ROOT'].'/assets/');





define('site_path','https://'.$_SERVER['SERVER_NAME'].'/');

define('upload_path',$_SERVER['DOCUMENT_ROOT'].'/');



define('valid_till',1440);

define('user_id',	'f3882328d783d4b67fb7462e8a8d9d3f');

define('assest_path',site_path.'assets/');// assets folder constant

define('css_path',assest_path.'css/');// style folder constant

define('admin_path',site_path.'setting_master/');// style folder constant



define('js_path',assest_path.'js/'); // javascript folder constant

define('ajax_path',assest_path.'ajax/'); // ajax folder constant

define('fonts_path',assest_path.'fonts/');// font folder constant

define('img_path',assest_path.'img/'); // image folder constant

define('tb_prefix','c1202'); // table constant

define('images_path',assest_path.'images/');

define('db_prefix','cj6063_');

define('user_profile_photo_url',images_path.'user_profile/');

define('images_tmp_path',images_path.'tmp/');

define('uploads_dir','assets/images/user_profile');

define('default_mail_id','admin@getln.com');

define('home_controller','home');

define('attachments_path','assets/attachments');

define('attachments_folder',assest_path.'attachments');

/**

* Keys Position

*/ 

define('singapore_citizen','3');

define('permenant_resitent','4');



define('SALARY_CAP',6000);

define('SALARY_CAP_OLD',5000);

define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');