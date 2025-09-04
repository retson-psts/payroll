
            
            
            <?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$user_info=$this->session->userdata['logged_in'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo  $page_title.page_title_after ?></title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link rel="shortcut icon" href="<?php echo  images_path?>fav.ico" />
        <!-- bootstrap 3.0.2 -->
        <link href="<?php echo  css_path?>bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="<?php echo  css_path?>font-awesome.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <?php /*?><link href="<?php echo  css_path?>onicons.min.css" rel="stylesheet" type="text/css" /><?php */?>
         <!-- bootstrap wysihtml5 - text editor -->
        <?php /*?><link href="<?php echo  css_path?>bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" /><?php */?>
        <!-- Theme style -->
        <link href="<?php echo  css_path?>AdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo  css_path?>styles.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo  css_path?>styles1.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo  css_path?>ionicons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo  css_path?>daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
         <!-- jQuery 2.0.2 -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
         <link href="https://demo.smarttutorials.net/jquery-autocomplete/css/jquery-ui-1.10.3.custom.min.css" type="text/css">
        
        <script src="https://demo.smarttutorials.net/jquery-autocomplete/js/jquery-ui-1.10.3.custom.min.js"></script>
                <!-- jQuery 2.0.2 -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="<?php echo  js_path?>jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="<?php echo  js_path?>bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
      
        <!-- Sparkline -->
        <script src="<?php echo  js_path?>plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo  js_path?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo  js_path?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="<?php echo  js_path?>plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo  js_path?>plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="<?php echo  js_path?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
 
        <!-- iCheck -->
        <script src="<?php echo  js_path?>plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="<?php echo  js_path?>AdminLTE/app.js" type="text/javascript"></script>
        
        
  
       
    </head>
    <body class="skin-blue fixed">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
        
            <a href="index.php" class="logo">
           
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                <?php echo  ''//$user_info['first_name'].'&nbsp;'.$user_info['last_name']; ?>
                DWZ
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="company_name">DWZ HR & Payroll</div>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo  $user_info['first_name'].'&nbsp;'.$user_info['last_name']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php echo  img_path ?>avatar04.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo  $user_info['first_name'].'&nbsp;'.$user_info['last_name'].'-'.$user_details->user_group_name; ?> 
                                        <!--<small>Member since Nov. 2012</small>-->
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <?php /*?><li class="user-body">
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Followers</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Sales</a>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <a href="#">Friends</a>
                                    </div>
                                </li><?php */?>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?php echo  site_path.'login/logout' ?>" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            