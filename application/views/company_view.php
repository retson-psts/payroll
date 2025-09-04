<div id="loader"></div>
           <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Company Profile
                        <small>Company</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#">Settings</a></li>
                        <li class="active">Company</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                
                    <div class="row">
                        
                             <div class="box box-primary">
                                <div class="box-body"> 
                                	<div class="col-sm-3 text-right"><img style="max-width: 150px;float: right;" src="<?php echo site_path; ?>assets/images/<?php echo $contents['company_logo'] ?>" class="img-responsive"></div>
                                	<div class="col-sm-9 border">
                                		<h3><?php echo $contents['company_name'] ?><a  href="#"  data-toggle="modal" data-target="#myModal">
  <i class="ion ion-edit"></i>
</a></h3>
                                		<hr style="margin:0;border-width: 1px 0px 0px;border-style: solid none none;border-color: #535353 -moz-use-text-color ">
                                		<h4><?php echo $contents['company_slogan'] ?></h4>
                                		
                                		<p><?php echo $contents['company_other_details'] ?></p>
                                		<?php if($employer!==false)
                                		{ 
                                		foreach($employer as $key => $value){
                                			echo "<h5>".$value->employer_designation."</h5>";
											echo "<p>".$value->employer_firstname." ".$value->employer_lastname."</p>";
											echo "<p>".$value->employer_mobile."</p>";
											
										}
										}
										 ?>
                                		<h5>Address</h5>
                                		<p>
                                			<?php echo $contents['company_addressline1'] ?>,<br>
                                			<?php echo $contents['company_addressline2'] ?>,<br>
                                			<?php echo $contents['company_city'] ?>,<br>
                                			<?php echo $contents['company_pincode'] ?>
                                			
                                			
                                		</p>
                                		<h5>Mobile</h5>
                                		<p>
                                			<?php echo $contents['company_phone'] ?><br>
                                			<?php echo $contents['company_mobile'] ?>
                                			
                                			
                                		</p>
                                		<h5>Email</h5>
                                		<p>
                                			<?php echo $contents['company_email'] ?><br>
                                			
                                			
                                			
                                		</p>
                                		
                                	</div>
                                	
                                	
                                </div>
                                <!-- /.box-body -->
                            </div><!-- /.box -->
                     </div>
                    
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <form action="" method="POST" id="absent" enctype="multipart/form-data">
   <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
   
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Company</h4>
      </div>
      <div class="modal-body">
      <div id="error"></div>
        <div class="form-group col-md-12">
                                            <label for="company_name">Company Name</label>
                                            <input type="text" required class="form-control" name="company_name" id="emp_hm_telephone" value="<?php echo $contents['company_name'] ?>">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="logo">Company Logo</label>
                                            <input type="file" class="form-control" name="logo" id="logo" value="">
                                            <p class="help-block">Please Choose small image size not more than 600*800 png or jpeg or gif image</p>
                                        </div>
                                        <div class="clearfix"></div>
                                       <div class=" form-group col-md-3"> <img style="max-width: 100px;" src="<?php echo site_path; ?>assets/images/<?php echo $contents['company_logo'] ?>" class="img-responsive"></div>
                                       <div class="clearfix"></div>
                                        <div class="form-group col-md-12">
                                            <label for="company_slogan">Slogan</label>
                                            <input type="text" class="form-control" name="company_slogan" id="company_slogan" value="<?php echo $contents['company_slogan'] ?>">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-12">
                                            <label for="company_other_details">Description</label>
                                            <textarea class="form-control" name="company_other_details"><?php echo $contents['company_other_details'] ?></textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="company_registration_id">Registration No</label>
                                            <input type="text" required class="form-control" name="company_registration_id" id="company_registration_id" value="<?php echo $contents['company_registration_id'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="company_registration_date">Date of Registration</label>
                                            <input type="text" class="form-control date" name="company_registration_date" id="company_registration_date" value="<?php if($contents['company_registration_date']!='0000-00-00') { echo $contents['company_registration_date']; } ?>">
                                        </div>
                                         <div class="form-group col-md-4">
                                            <label for="company_mobile">Mobile</label>
                                            <input type="text" class="form-control" name="company_mobile" id="company_mobile" required value="<?php echo $contents['company_mobile'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="company_phone">Landline</label>
                                            <input type="text" class="form-control" name="company_phone" id="company_phone" value="<?php echo $contents['company_phone'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="company_email">Email Id</label>
                                            <input type="text" class="form-control" name="company_email" id="company_email" value="<?php echo $contents['company_email'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="company_addressline1">Address Line1</label>
                                            <input type="text" class="form-control" name="company_addressline1" id="company_addressline1"  required value="<?php echo $contents['company_addressline1'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="company_addressline2">Address Line2</label>
                                            <input type="text" class="form-control" name="company_addressline2" id="company_addressline2" value="<?php echo $contents['company_addressline2'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="company_city">City</label>
                                            <input type="text" class="form-control" name="company_city" id="company_city" value="<?php echo $contents['company_city'] ?>" required>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="company_pincode">Pincode</label>
                                            <input type="text" class="form-control" name="company_pincode" required id="company_pincode" value="<?php echo $contents['company_pincode'] ?>">
                                        </div>
                                        <div class="clearfix"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
</form>
  </div>
</div>
		<style>h5, .h5 {
    font-size: 15px;
    font-weight: 800;
    color: #333;
    border-bottom: 1px solid #A22D26;
    padding-bottom: 10px;
    max-width: 564px;
    text-transform: uppercase;
    margin-top: 37px;
}</style>
        
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
            url: '<?php echo site_path; ?>company/add_company?files',
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
			url: '<?php echo site_path; ?>company/add_company',
            type: 'POST',
            data: formData,
            cache: false,
            dataType: 'json',
            success: function(data, textStatus, jqXHR)
            {
            	if(typeof data.error === 'undefined')
            	{
            		$('#loader').hide();
            		if(data.status==0)
					{
						$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+data.message+'</div>');
						
					}
					else if(data.status==1)
					{
						alert('Company updated successfuly');
						
						//alert($('#check_'+id).val());
						/*$( "#absent .form-control" ).val('');*/
						$("#error").html("");
						location.reload();
						
						
					}
					else
					{
						alert('Not Updated');
						//alert($('#check_'+id).val());
						/*$( "#absent .form-control" ).val('');*/
						$("#error").html("");
						
					}
            	}
            	else
            	{
            		// Handle errors here
            		
            		$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Some Errors occured</div>');
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	// Handle errors here
            	$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Wrong</div>');
            },
            complete: function()
            {
            	// STOP LOADING SPINNER
            }
		});
	}
            $(function() {
            	$('.date').datepicker({endDate: '0d',format:'dd-mm-yyyy'});
            	 
               
            });
			</script>