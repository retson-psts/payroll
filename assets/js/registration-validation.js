$(document).ready(function(){
	$('input[autocomplete]').removeAttr('autocomplete');
  var url='register/';
  var csrf='&byzero='+$("#csrf_token").val();
	 $("#username").keyup(function(){
		if($("#username").val().length >= 4)
		{
			$.ajax({
				 type: "post",
				 url: url+"check_username_ajax",
				 data:'username='+$("#username").val()+csrf,
				 success: function(msg)
				 {
					if(msg=="true")
					{
					 $('#username').next('#val-errors').remove();
					 $("#username").removeClass("invalid").addClass( "valid" );
					}
					else
					{
					 $("#username").removeClass("valid").addClass( "invalid" );
					 $('#username').parent().append('<div id="username-errors">Username Already Taken</div>');
					}
				 },
			});
	 	}
	  else 
	  {
	   $("#username").removeClass("valid").addClass( "invalid" );
	  }
	 });
	 $("#password").keyup(function(){
        if($("#password").val().length >= 4)
        {
            if($("#password").val()!= $("#re-password").val())
            {
                $("#password").removeClass("valid").addClass( "invalid" ); 
                $("#re-password").removeClass("valid").addClass( "invalid" );
            }
            else{
				$('#password').next('#val-errors').remove();
				$('#re-password').next('#val-errors').remove();
                $("#password").removeClass("invalid").addClass( "valid" ); 
                $("#re-password").removeClass("invalid").addClass( "valid" );
            }
        }
		else
		{
			$("#password").removeClass("valid").addClass( "invalid" ); 
            $("#re-password").removeClass("valid").addClass( "invalid" );
		}
    });
    $("#re-password").keyup(function(){
        if($("#re-password").val().length >= 4)
        {
            if($("#password").val()!= $("#re-password").val())
            {
                $("#password").removeClass("valid").addClass( "invalid" ); 
                $("#re-password").removeClass("valid").addClass( "invalid" );
            }
            else{
				$('#password').next('#val-errors').remove();
				$('#re-password').next('#val-errors').remove();
                $("#password").removeClass("invalid").addClass( "valid" ); 
                $("#re-password").removeClass("invalid").addClass( "valid" );
            }
        }
    });
 	$("#email").change(function(){
        var email = $("#email").val();
        if(email != 0)
        {
            if(isValidEmailAddress(email))
            {
			  $.ajax({
				   type: "post",
				   url: url+"email_check_ajax",
				   data: "email="+$("#email").val()+csrf,
				   success: function(msg){
					if(msg=="true")
					{
					 $('#email').next('#val-errors').remove();
					 $("#email").removeClass("invalid").addClass( "valid" );
					 $('#email').parent().append('<div id="val-errors"></div>');
					 email_con=true;
					}
					else
					{
					 $('#email').next('#val-errors').remove();
					 $("#email").removeClass("valid").addClass( "invalid" );
					 $('#email').parent().append('<div id="val-errors">Email Already Registred</div>');
					}
				   },
			  });
            }
			else
			{
			   $('#email').next('#val-errors').remove();
			   $("#email").removeClass("valid").addClass( "invalid" );
			   $('#email').parent().append('<div id="val-errors">Please Enter a Valid Email</div>');
			}
        }
    });
	$("#country").change(function(){
        var country = $("#country").val();
		if($("#country").val().length != 0)
		{
			$.ajax({
				 type: "post",
				 url: url+"get_states",
				 data:'country='+$("#country").val()+csrf,
				 success: function(msg){
					if(msg!="Null")
					{
					 $('#state').html(msg);
					 $("#country").removeClass("invalid").addClass( "valid" );
					}
					else
					{
					 $('#states').append('<div id="val-errors"> Cannot Retreive Cities</div>');
					}
				 },
			});
	 	}
	});
	$("#state").change(function(){
        var state = $("#state").val();
		if($("#state").val().length != 0)
		{
			$.ajax({
				 type: "post",
				 url: url+"get_cities",
				 data:'state='+$("#state").val()+csrf,
				 success: function(msg){
					if(msg!="Null")
					{
					 $('#city').html(msg);
					 $("#state").removeClass("invalid").addClass( "valid" );
					}
					else
					{
					 $('#state').append('<div id="val-errors"> Cannot Retreive States</div>');
					}
				 },
			});
	 	}
	});
	$("#city").change(function(){
		if($("#city").val() != 0)
		{
			$("#city").removeClass("invalid").addClass( "valid" );
	 	}
		else
		{
			$("#city").removeClass("valid").addClass( "invalid" );
		}
	});
	$("#dob_year").change(function(){
        var year = $("#dob_year").val();
		var date = $("#dob_date").val();
		var month = $("#dob_month").val();
		$.ajax({
			    type: "post",
			    url: url+"calculate_age_ajax",
			    data:'year='+year+'&date='+date+'&month='+month+csrf,
			    dataType:'json',
	     	    success: function(data){
			    msg=data.status;
			if(msg=='1')
			{
				$("#dob_year").removeClass("invalid").addClass( "valid" );
				$("#dob_date").removeClass("invalid").addClass( "valid" );
				$("#dob_month").removeClass("invalid").addClass( "valid" );
			}
			else
			{
				alert(data.error);
				$("#dob_year").removeClass("valid").addClass( "invalid" );
				$("#dob_date").removeClass("valid").addClass( "invalid" );
				$("#dob_month").removeClass("valid").addClass( "invalid" );
			}
		},
	  });
	});
	$("#fname").keyup(function(){
		var fname = $("#fname").val();
		if($("#fname").val().length >= 2)
		{
			$('#fname').next('#val-errors').remove();
            $("#fname").removeClass("invalid").addClass( "valid" );
		}
		else
		{
			 $('#fname').next('#val-errors').remove();
			 $("#fname").parent().append("<div id='val-errors'>Please Enter Atleast 2 Characters</div>");
			 $("#fname").removeClass("valid").addClass( "invalid" );
		}
	});
function isValidEmailAddress(emailAddress) {
 		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
 		return pattern.test(emailAddress);
	}
 $(function(){
	$('#register').submit(function(evnt){
		evnt.preventDefault(); 
		$('div#sending_form').empty();
		$.post(url+'register_user', 
		$('form#register').serialize(),
		function (data) {
			$('div#sending_form').prepend(data);
		});
	});
  });
});
