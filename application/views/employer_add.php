<div id="loader"></div>
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
                       Add Employer
                        
            <small>Employer</small>
        </h1>
      <ol class="breadcrumb">
         <li>
            <a href="#"> <i class="fa fa-dashboard"></i> Home </a>
         </li>
         <li> <a href="#">Settings</a> </li>
         <li class="active">Employer</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <form action="" method="POST" id="absent" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>" />
            
            <div class="">
               <div class="modal-body">
                  <div id="error"></div>
                  <div class="form-group col-md-4">
                     <label for="employer_firstname">First Name *</label>
                     <input type="text" required class="form-control" name="employer_firstname" id="employer_firstname" value=""> </div>
                  <div class="form-group col-md-4">
                     <label for="employer_lastname">Last Name *</label>
                     <input type="text" required class="form-control" name="employer_lastname" id="employer_lastname" value="">
                  </div>
                  <div class="form-group col-md-4">
                     <label for="employer_email">Email *</label>
                     <input type="text" required class="form-control" name="employer_email" id="employer_email" value="">
                  </div>
                   <div class="form-group col-md-4">
                     <label for="employer_username">Username *</label>
                     <input type="text" required class="form-control" name="employer_username" id="employer_username" value="">
                  </div>   
                   <div class="form-group col-md-4">
                     <label for="employer_password">Password *</label>
                     <input type="password" required class="form-control" name="employer_password" id="employer_password" value="">
                  </div> 
                  <div class="form-group col-md-4">
                     <label for="employer_cpassword">Confirm Password *</label>
                     <input type="password" required class="form-control" name="employer_cpassword" id="employer_cpassword" value="">
                  </div>
                   <div class="form-group col-md-4">
                     <label for="employer_designation">Designation *</label>
                     <input type="text" required class="form-control" name="employer_designation" id="employer_designation" value="">
                  </div>                    
                     
                  <div class="form-group col-md-4">
                     <label for="employer_photo">Photo</label>
                     <input type="file" class="form-control" name="employer_photo" id="employer_photo" value="">
                     <p class="help-block">Please Choose small image size not more than 400*400 png or jpeg or gif image</p>
                  </div>
                  
                  <div class=" form-group col-md-3"> <img style="max-height: 60px;" src="
                                            <?php echo site_path; ?>assets/images/user_profile/7_3335548575564b77329306.png" class="img-responsive"> </div>
                  <div class="clearfix"></div>
                  <div class="form-group col-md-12">
                     <label for="employer_about">About</label>
                     <textarea class="form-control" name="employer_about"></textarea>
                  </div>
                  
                  <div class="form-group col-md-4">
                     <label for="employer_mobile">Mobile</label>
                     <input type="text" class="form-control" name="employer_mobile" id="employer_mobile" value=""> </div>
                  
                  <div class="clearfix"></div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
               </div>
            </div>
         </form>
         <!-- /.box -->
      </div>
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog"></div>
</div>
<script type="text/javascript">
   var files;
	// Add events
	$('input[type=file]').on('change', prepareUpload);
	$('#absent').on('submit', uploadFiles);

	// Grab the files and set them to our variable
	function prepareUpload(event)
	{
		files = event.target.files;
	}

	// Catch the form submit and upload the files
	function uploadFiles(event)
	{
		event.stopPropagation(); // Stop stuff happening
        event.preventDefault(); // Totally stop stuff happening
		// START A LOADING SPINNER HERE
		$('#loader').show();
        // Create a formdata object and add the files
		var data = new FormData();
		if(files)
		{
			
		
		$.each(files, function(key, value)
		{
			data.append(key, value);
		});
		}
		data.append('<?php echo  $this->security->get_csrf_token_name(); ?>','<?php echo  $this->security->get_csrf_hash(); ?>');
        $.ajax({
            url: '<?php echo site_path; ?>add_employer/add_employer1?files',
            type: 'POST',
            data: data,
            cache: false,
            dataType: 'json',
            processData: false, // Don't process the files
            contentType: false, // Set content type to false as jQuery will tell the server its a query string request
            success: function(data, textStatus, jqXHR)
            {
            	if(typeof data.error === 'undefined')
            	{
            		
            		// Success so call function to process the form
            		submitForm(event, data);
            	}
            	else
            	{
            		$('#loader').hide();
            		// Handle errors here
            		$('#file').addClass( "error" );
            		$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+data.error+'</div>');
            		$('#error').focus();
            		//console.log('ERRORS: ' + data.error);
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	$('#loader').hide();
            	// Handle errors here
            	$('#file').addClass( "error" );
            	$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Wrong</div>');
            	$('#error').focus();
            	// STOP LOADING SPINNER
            }
        });
		
    }

    function submitForm(event, data)
	{
		// Create a jQuery object from the form
		$form = $(event.target);
		
		// Serialize the form data
		var formData = $form.serialize();
		
		// You should sterilise the file names
		$.each(data.files, function(key, value)
		{
			formData = formData + '&filenames[]=' + value;
		});

		$.ajax({
			url: '<?php echo site_path; ?>add_employer/add_employer1',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR)
            {
            	if(typeof data.error === 'undefined')
            	{
            		var err='';
            		$('#loader').hide();
            		if(data.status==0)
					{
						var s=0;
						
						$.each(data.message, function(k,v) {
							
	       				err+='<p>'+v+'</p>';
	       				
	       				if(s<1)
	       				{
							$("#"+k).focus();
							s++;
						}
						
	           			 $("#absent [name='"+k+"']").addClass( "error" );	
	           			
	       
	    				});  
	    				$('#error').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>'+err+'</div>');
						
					}
					else if(data.status==1)
					{
						alert('Employer added successfully');
						
						//alert($('#check_'+id).val());
						/*$( "#absent .form-control" ).val('');*/
						$("#error").html("");
						$('#loader').hide();
						window.location='<?php echo site_path; ?>manage_employer';
						
						
					}
					else
					{
						alert('Not Updated');
						//alert($('#check_'+id).val());
						/*$( "#absent .form-control" ).val('');*/
						$("#error").html("");
						$('#loader').hide();
						
					}
            	}
            	else
            	{
            		// Handle errors here
            		
            		$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Some Errors occured</div>');
            		$('#loader').hide();
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            	$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Wrong</div>');
            	$('#loader').hide();
            },
            complete: function()
            {
            	$('#loader').hide();
            	// STOP LOADING SPINNER
            }
		});
	}
            $(function() {
            	$('.date').datepicker({endDate: '0d',format:'dd-mm-yyyy'});
            	 
               
            });
</script>