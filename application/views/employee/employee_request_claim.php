<div id="loader"></div>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Request Claim
                        <small>Add Claim Request</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Claim</a></li>
                        <li class="active">add Claim Request</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Claim Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" enctype="multipart/form-data" id="absent" action="<?php echo  site_path?>jobsheet/absent" method="post">
                                 <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                  <div class="">
                  <div id="error"></div>
                  <div class="form-group col-md-6">
                    <label>Allowance Amount $</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        $
                      </div>
                      
                      <input type="text" required class="form-control pull-right" name="emp_allowance_amount"/>
                    </div><!-- /.input group -->
                  </div>
                  <!--<div class="form-group col-md-6">
                    <label>Salary Month</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" required name="emp_allowance_month" class="form-control pull-right" id="datepicker" />
                    </div>
                  </div>-->
                  <div class="form-group col-md-6">
                    <label>Period</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="range" class="form-control pull-right" id="reservation"/>
                    </div><!-- /.input group -->
                  </div>
                  <div class="form-group col-md-12">
                  <label for="leave_type">Allowance Type</label>
                     <!--<input type="hidden" name="employee_id" id="hidden_uid" value="">-->
                     
                  <select class="form-control" required name="allownce_type_id" id="allownce_type_id">
                                                    <option value="">None</option>
                                            <?php
												if($allowance_list!=false)
												{
													foreach($allowance_list as $allowance)
													{
													  echo '<option value="'.$allowance->allowance_types_id.'">'.$allowance->allowance_type_name.'</option>';
													  
													}
												}
											?>
                                            </select>
                                            </div>
                  <div class="form-group col-md-12">
                                                <label for="jobsheet_date">Reason</label>
                                                <textarea class="form-control" name="emp_allowance_reason"></textarea>
                                            </div>
 		 		  
                  <div class="form-group col-md-6">
                    <label>File</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-file"></i>
                      </div>
                      <input type="file" name="emp_allowance_file" id="file" class="form-control pull-right" />
                      
                    </div>
                    <p class="help-block">Choose file in pdf, doc, docx, jpeg, png, gif or bmp types only size with not more than 1 mb</p>
                  </div>
				  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit"  class="submit btn btn-primary">Save changes</button>
                  </div>
                  </form>
                            </div><!-- /.box -->

                            <!-- Form Element sizes -->
                           
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
             <script src="<?php echo  js_path?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
            <script type="text/javascript">
            
         function allowance(id)
         {
         	$( "#absent .form-control" ).val('');
		 	$('#modal').modal('show');
			$('#hidden_uid').val(id);
		 }
            $(function() {
                /*$("#example1").dataTable({"bPaginate": false});*/
                $('#reservation').daterangepicker({format:'YYYY-MM-DD'});
                $('.date').datepicker({endDate: '0d',format:'dd-mm-yyyy'});
                $("#datepicker").datepicker( {
    	format: "mm-yyyy",
    viewMode: "months", 
    minViewMode: "months",
    endDate: '0d'
});

/**
* upload file ajax
*/

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
            url: '<?php echo site_path; ?>employee_request_claim/add_allowance?files',
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
            		//console.log('ERRORS: ' + data.error);
            	}
            },
            error: function(jqXHR, textStatus, errorThrown)
            {
            	$('#loader').hide();
            	// Handle errors here
            	$('#file').addClass( "error" );
            	$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Wrong</div>');
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
			url: '<?php echo site_path; ?>employee_request_claim/add_allowance',
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
						alert('Allowance added successfuly');
						
						//alert($('#check_'+id).val());
						$( "#absent .form-control" ).val('');
						$("#error").html("");
						window.location="<?php echo site_path; ?>employee_claim_requests";
						
						
					}
					else
					{
						alert('Allowance already added');
						//alert($('#check_'+id).val());
						$( "#absent .form-control" ).val('');
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






               /* $( "#absent" ).on( "submit", function( event ) {
        		  event.preventDefault();
        		  
        		 $('#error').html("");
        		var id=$('#hidden_uid').val();
        		
        		   $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>employee_request_claim/add_allowance",
				dataType: "json",
				data:$( "#absent" ).serialize() ,
				success: function(html){
				if(data.status==0)
				{
					$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+data.message+'</div>');
					
				}
				else if(data.status==1)
				{
					alert('Allowance added successfuly');
					$('#modal').modal('hide');
					//alert($('#check_'+id).val());
					$( "#absent .form-control" ).val('');
					
					
				}
				else
				{
					alert('Allowance already marked');
					$('#modal').modal('hide');
					//alert($('#check_'+id).val());
					$( "#absent .form-control" ).val('');
					
				}
					
				}
				});
			});*/
            });
        </script>