<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="">
    <link rel="shortcut icon" href="<?php echo  images_path?>fav.ico" />

    <title>Login</title>

    <link href="<?php echo  assest_path?>css/login/style.css" rel="stylesheet">
    <link href="<?php echo  assest_path?>css/login/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
    
	
    .style1
    {
    	  margin-bottom: 15px;
		  border-radius: 5px;
		  -webkit-border-radius: 5px;
		  border: 1px solid #eaeaec;
		  background: #eaeaec;
		  box-shadow: none;
		  margin-left: 86px;
		  width: 220px;
		  font-size: 12px;
		  padding: 8px;
    	}</style>
</head>

<body class="login-body" style="   background: #fff;">
<img src="<?php echo  assest_path?>images/hr.jpg"  style="  margin: 0 auto; display: block;  margin-top: 20px; width: 500px;">

<div class="container" style="background: url('<?php echo  assest_path?>images/login1.png') no-repeat center; position: relative;   top: -123px;" >

       <form action="<?php echo  site_path ?>login/login_val" id="login" name="login" role="form" class="form-horizontal form-signin" method="post" autocomplete="off">
   <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>

       <!-- <div class="form-signin-heading text-center">
            <h1 class="sign-title">Sign In</h1>
            <img src="<?php echo  assest_path?>images/login-logo.png" alt=""/>
        </div>-->
        <div class="errors">
        <?php  
		  if(isset($login_error))
			{
				echo $login_error;
			}
          ?>
        </div>
        
        <div class="clearfix"></div>
        <div class="login-wrap" >
        
            <input type="text" class="form-control style1" style=" margin-top: 118px;  margin-left: 86px; width: 220px;" placeholder="User ID" autofocus name="username" value="<?php echo $username; ?>">
            <input type="password" class="form-control st" placeholder="Password" name="password">

            <button class="btn btn-lg btn-login btn-block" style="  width: 200px; margin-left: 87px; height: 30px;" type="submit">
                <i class="fa fa-check"></i>Login
            </button>
            <a style="display: block;text-align:center;text-decoration: underline;color: #688AC2;margin-left: 85px;" href="<?php echo site_path; ?>forget_password">Forget Password</a>

            

        </div>
		<div class="clearfix"></div>
<div class="login-errors" style="position: absolute;position: absolute;top: 157px;margin: 0px auto 0px 90px;">
<?php if(isset($error)) { echo $error;  } ?></div>

    </form>
    <div class="clearfix"></div>
    <div class="copy-right" style="text-align: center">
    	<p>HR & payroll management system <br>
    	<!--© 2015 <a href="http://www.dreamwerkztechnologies.com/" class="comp"> DWZ </a>, Inc. All rights reserved.<br>--></p>
    	<div style="margin: 0 auto; width:132px;">
    	<!--<a href="https://www.facebook.com/pages/Dreamwerkz-Technologies/765732066846766"><i class="social fb"></i></a>
    	<a href="https://plus.google.com/100858742625179614554/videos"><i class="social gp"></i></a>
    	<a href="https://twitter.com/DWZTech"><i class="social tw"></i></a>-->
    	<div class="clear"></div>
    	</div>
    </div>
    
</div>
</body>
</html>
