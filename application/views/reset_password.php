<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Login Page :: DWZ Payroll and management system </title>

    <!-- Bootstrap -->
    <link href="<?php echo css_path; ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo  assest_path?>css/login/login_final.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    	
    </style>
  </head>
  <body>
  <div id="loader"></div>
    <div class="container">
    
    	<div class="margin-center"><img src="<?php echo  assest_path?>images/hr.jpg"/></div>
    	<form action="<?php echo  site_path ?>login/reset_password" id="login" name="login" role="form" class="form-horizontal form-signin" method="post" autocomplete="off">
   <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
    	<div class="errors1">
        <?php  
		  if(isset($message))
			{
				echo $message;
			}
          ?>
        </div>
        
        <div class="img-conatainer1">
        <div class="wrap form-signin1">
        <label>New Password</label>
       
         <input type="password" value="<?php echo $password; ?>" class="form-control style1" placeholder="New Password"  name="password">
          <label>Confirm Password</label>
            <input type="password" value="<?php echo $cpassword; ?>" class="form-control st" placeholder="Confirm Password" name="cpassword">

            <button class="btn btn-lg btn-login btn-block" type="submit">
                <i class="fa fa-check"></i>Reset Password
            </button>
            <a class="forget" href="<?php echo site_path; ?>login">Goto Login</a>
        	</div>
        </div>
        </form>
    	<div class="copy-right text-center">
    	<p>HR & payroll management system <br>
    	<!--© 2015 <a href="http://www.dreamwerkztechnologies.com/" class="comp"> DWZ </a>, Inc. All rights reserved.<br>--></p>
    	<div class="text-center" >
    	<!--<a href="https://www.facebook.com/pages/Dreamwerkz-Technologies/765732066846766"><i class="social fb"></i></a>
    	<a href="https://plus.google.com/100858742625179614554/videos"><i class="social gp"></i></a>
    	<a href="https://twitter.com/DWZTech"><i class="social tw"></i></a>-->
    	<div class="clear"></div>
    	</div>
    </div>
    </div>
<div class="modal fade" id="myModal">
<form id="form_edit">
<input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Forget Password</h4>
      </div>
      <div class="modal-body">
      <div id="error_edit"></div>
        <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email">
  </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</form>
</div><!-- /.modal -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo js_path; ?>bootstrap.min.js"></script>
    <script>
    $(document).ready(function(){
    	$( "#form_edit" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>login/send",
				dataType: "json",
				data:$( "#form_edit" ).serialize() ,
				success: function(html){
					
				if(html.status==0)
				{
					//event.preventDefault();
					$('.form-control').removeClass('error');
					var s=0;
					$.each(html.message, function(k,v) {
       				err+='<p>'+v+'</p>';
       				
       				if(s<1)
       				{
						$("#form_edit [name='"+k+"']").focus();
						s++;
					}
					
           			 $("#form_edit [name='"+k+"']").addClass( "error" );	
           			
       
    			});  
					$('#error_edit').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>'+err+'</div>');
					 
           			 
					
				}
				else
				{
						alert(html.message);
						location.reload();
				}
				
				},
				complete: function (data) {
     			$('#loader').hide();
     				}
				
			});
			
			return false;
  			
  			
  
});	
    	
    })	
    </script>
  </body>
</html>