			 <div id="loader"></div>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add Employee
                        <small>Report To</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Employee</a></li>
                        <li class="active">add Employee</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                            	
                                <div class="col-md-12 " >
								  <?php echo  $nav_steps ?>
                                  <div class="add_panel">
                                    <div class="box-header">
                                        <h3 class="box-title">Add Supervisors</h3>
                                    </div><!-- /.box-header -->
                                    <div id="collapseExample">
                                    <form role="form"  action="#" method="post" enctype="multipart/form-data" id="form_add">
                                    <div id="error_add"></div>
                                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                  
                                   
                                        <input  type="hidden" name="employee_id" value="<?php echo $employee_id ?>"/>
                                        <input type="hidden" name="id" value="">
                                    <div id="add_form" >
                                      <div class="box-body">
                                        
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-4">
                                                 <label for="emp_reporting_method">Supervisor name *</label>
                                                 <select name="emp_sub_id" class="form-control select" id="emp_reporting_method">
                                                 <option value="">Select</option>
                                                 	<?php
													foreach($other_employee as $item)
													{
														echo '<option value="'.$item['emp_id'].'">'.$item['emp_firstname'].' '.$item['emp_lastname'].'</option>';
													}
													?>
                                                 </select>
                                              </div>
                                        <div class="clearfix"></div>
                                      	 <div class="form-group col-md-4">
                                                 <label for="emp_reporting_method">Reporting Method *</label>
                                                 <select name="emp_reporting_method" class="form-control" id="emp_reporting_method">
                                                 <option value="">Select</option>
                                                 	<?php
													foreach($reporting_methods as $reporting_method)
													{
														echo '<option value="'.$reporting_method->reporting_method_id.'">'.$reporting_method->reporting_method_name.'</option>';
													}
													?>
                                                 </select>
                                              </div>
                                        <div class="clearfix"></div>
                                        
                                      </div>
                                      <div class="clearfix"></div>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="box-footer text-center">
                                            <button type="submit" name="save" class="btn btn-warning text-center">Save</button>
                                            <button type="reset" name="cancel" class="btn btn-primary text-center"  onclick="">Cancel</button>
                                            <a href="<?php echo site_path ?>add_employee/employee_qualification/<?php echo $employee_id; ?>" class="btn btn-info text-center">Next</a>
                                            
                                      </div>
                                   
                                  
                                    </form>
</div>
                                  </div><!-- Add Panel Ends-->
                                  <div class="clearfix"></div>
                                  <div class="list_results">
                                  	  <div class="added_data">
                                         <?php
										 if($emp_supervisors!=false)
									     {
									     	
										 ?>
                                          <div class="box-header">
                                             <h3 class="box-title">Assigned Supervisors</h3>
                                          </div><!-- /.box-header -->
                                          <table id="example1" class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                  	<th>EmpNumber</th>
                                                    <th>Name</th>
                                                    <th>Reporting Method</th>
                                                     <th>option</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              <?php
											  foreach($emp_supervisors as $emp_supervisor)
											  {
												  $name='<a href="#" onclick="" >'.$emp_supervisor->emp_number.'</a>';
												  $url='<a href="javascript:void(0);" onclick="remove_report('.$emp_supervisor->report_id.')">Remove</a>';
												  echo '<tr id="ed_'.$emp_supervisor->emp_sup_employeee_id.'"><td>'.$name.'</td><td>'.$emp_supervisor->emp_firstname.' '.$emp_supervisor->emp_lastname.'</td><td>'.$emp_supervisor->reporting_method_name.'</td><td>'.$url.'</td></tr>';
											  }
											  ?>
                                              </tbody>
                                               <tfoot>
                                                <tr>
                                                	<th>EmpNumber</th>
                                                    <th>Name</th>
                                                    <th>Reporting Method</th>
                                                    <th>option</th>
                                                </tr>
                                        	  </tfoot>
                                          </table> 
                                      <?php
										}
										else
										{
											echo 'No Results Found';
										}
									  ?>                                    
                                  </div>
                              </div><!-- /.list-results -->
                              <div class="add_panel">
                                    <div class="box-header">
                                        <h3 class="box-title">Add Sub ordinates</h3>
                                    </div><!-- /.box-header -->
                                    <div id="collapseExample">
                                    <form role="form"  action="#" method="post" enctype="multipart/form-data" id="form_edit">
                                    <div id="error_edit"></div>
                                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                  
                                   
                                        <input  type="hidden" name="employee_id" value="<?php echo $employee_id ?>"/>
                                        <input type="hidden" name="id" value="">
                                    <div id="add_form" >
                                      <div class="box-body">
                                        
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-4">
                                                 <label for="emp_reporting_method">Subordinate name *</label>
                                                 <select name="emp_sub_id" class="form-control select" id="emp_reporting_method">
                                                 <option value="">Select</option>
                                                 	<?php
													foreach($other_employee as $item)
													{
														echo '<option value="'.$item['emp_id'].'">'.$item['emp_firstname'].' '.$item['emp_lastname'].'</option>';
													}
													?>
                                                 </select>
                                              </div>
                                        <div class="clearfix"></div>
                                      	 <div class="form-group col-md-4">
                                                 <label for="emp_reporting_method">Reporting Method *</label>
                                                <select name="emp_reporting_method" class="form-control" id="emp_reporting_method">
                                                 <option value="">Select</option>
                                                 	<?php
													foreach($reporting_methods as $reporting_method)
													{
														echo '<option value="'.$reporting_method->reporting_method_id.'">'.$reporting_method->reporting_method_name.'</option>';
													}
													?>
                                                 </select>
                                              </div>
                                        <div class="clearfix"></div>
                                        
                                      </div>
                                      <div class="clearfix"></div>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="box-footer text-center">
                                            <button type="submit" name="save" class="btn btn-warning text-center">Save</button>
                                            <button type="reset" name="cancel" class="btn btn-primary text-center"  onclick="">Cancel</button>
                                            <a href="<?php echo site_path ?>add_employee/employee_qualification/<?php echo $employee_id; ?>" class="btn btn-info text-center">Next</a>
                                            
                                      </div>
                                   
                                  
                                    </form>
</div>
                                  </div><!-- Add Panel Ends-->
                                  <div class="clearfix"></div>
                                  <div class="list_results">
                                  	  <div class="added_data">
                                         <?php
										 if($emp_subordinates!=false)
									     {
										 ?>
                                          <div class="box-header">
                                             <h3 class="box-title">Assigned Subordinates</h3>
                                          </div><!-- /.box-header -->
                                          <div class="box-body table-responsive">
                                          <table id="example1" class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                  	<th>EmpNumber</th>
                                                    <th>Name</th>
                                                    <th>Reporting Method</th>
                                                     <th>option</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              <?php
											  foreach($emp_subordinates as $emp_supervisor)
											  {
												  $name='<a href="#" onclick="" >'.$emp_supervisor->emp_number.'</a>';
												  $url='<a href="javascript:void(0);" onclick="remove_report('.$emp_supervisor->report_id.')">Remove</a>';
												  echo '<tr id="ed_'.$emp_supervisor->emp_sup_employeee_id.'"><td>'.$name.'</td><td>'.$emp_supervisor->emp_firstname.' '.$emp_supervisor->emp_lastname.'</td><td>'.$emp_supervisor->reporting_method_name.'</td><td>'.$url.'</td></tr>';
											  }
											  ?>
                                              </tbody>
                                               <tfoot>
                                                <tr>
                                                	<th>EmpNumber</th>
                                                    <th>Name</th>
                                                    <th>Reporting Method</th>
                                                    <th>option</th>
                                                </tr>
                                        	  </tfoot>
                                          </table>
                                      </div> 
                                      <?php
										}
										else
										{
											echo 'No Results Found';
										}
									  ?>                                    
                                  </div>
                              </div><!-- /.list-results -->
                              <div class="attachments">
                              	   <div class="box-header">
                                       <h3 class="box-title">Attachments</h3>
                                   </div><!-- /.box-header -->
                                   <div class="attachment_add">
                                       <form role="form" id="attachment_add"  action="" method="post" enctype="multipart/form-data">
                                       <div id="error_file"></div>
                                       
                                        <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                        <input type="hidden" name="screen" value="rt" />
                                        <input type="hidden" name="emp_id" value="<?php echo $employee_id; ?>"/>
                                       
                                        <div id="add_attach_form" >
                                          <div class="box-body">
                                            <div class="form-group col-md-4">
                                               <label for="attach_file">Select File *</label>
                                               <input type="file"  required="" name="attach_file" id="attach_file" class="form-control"/>
                                               <p class="help-block">File should be jpeg,gif, pdf, png, doc, docx or excel format (file size not more than 1 MB)</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group col-md-4">
                                               <label for="attach_comment">Comment</label>
                                               <textarea class="form-control" name="attach_comment" id="attach_comment" ></textarea>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="box-footer text-center">
                                                  <button type="submit" name="save" class="btn btn-warning text-center">Save</button>
                                                  <button type="reset" name="cancel" class="btn btn-primary text-center" id="cancel_form3" onclick="">Cancel</button>
                                            </div>
                                        </div>
                                        </div>
                                      
                                        </form>
                                   </div><!-- attachment_add end-->
                              </div>
                                    <div class="list_results">
                                  	  <div class="added_data">
                                      	 <div class="box-header">
                                             <h3 class="box-title">Attachments Emergency Contacts</h3>
                                         </div><!-- /.box-header -->
                                         <?php
										 if($attachments!=false)
									     {
										 ?>
                                          <div class="box-body table-responsive">
                                          <table id="example2" class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>File Name</th>
                                                      <th>Description</th>
                                                      <th>Size</th>
                                                      <th>File Type</th>
                                                      <th>Attached At</th>
                                                      <th>Options</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              
                                              <?php
											  foreach($attachments as $attachment)
											  {
												  $name='<a href="'.attachments_folder.'/'.$attachment->eattach_filename.'" target="_blank">'.$attachment->eattach_filename.'</a>';
												  $url='<a href="javascript:void(0);" onclick=" remove_data('.$attachment->emp_attach_id.')" onclick="return confirm(\'Are you sure to remove?\');" >Remove</a>';
												  echo '<tr><td>'.$name.'</td>
														<td>'.$attachment->eattach_desc.'</td>
														<td>'.$attachment->eattach_size.'</td>
														<td>'.$attachment->eattach_type.'</td>
														<td>'.$attachment->attached_time.'</td>
														<td>'.$url.'</td></tr>';
											  }
											  ?>
											  </tbody>
                                               <tfoot>
                                                <tr>
                                                    <th>File Name</th>
                                                    <th>Description</th>
                                                    <th>Size</th>
                                                    <th>File Type</th>
                                                    <th>Attached At</th>
                                                    <th>Options</th>
                                                </tr>
                                        	  </tfoot>
                                          </table>
                                      </div> 
                                      <?php
										}
										else
										{
											echo 'No Results Found';
										}
									  ?>                                    
                                  </div>
                              </div><!-- /.list-results -->

                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
						</div>
					</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            <div id="myModal" class="modal fade" role="dialog">
  				<div class="modal-dialog">

    				<!-- Modal content-->
				    <div class="modal-content">
				      
				      <div class="modal-body">
				        <p id="result"></p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
				      </div>
				    </div>

  </div>
			</div>
			<script src="<?php echo  js_path?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        	<script src="<?php echo  js_path?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>      
        <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
         <script type="text/javascript">
         		
            $(function() {
                $(".table").dataTable();
                $('#example2').dataTable();
            });
        </script>
        <script>
        	function remove_data(id)
        	{
        		
        		$('#loader').show();
        		
        		 $.ajax({
				type: "GET",
				url: "<?php echo site_path; ?>validation/remove_attachment/"+id,
				dataType: "json",
				success: function(html){
				if(html.status==0)
				{
					//event.preventDefault();
					alert('Removing Attachment Failed');	
									 
           			 
					
				}
				else
				{
						alert('Removed Successfully');
						location.reload();
				}
				
				},
				complete: function (data) {
     			$('#loader').hide();
     				}
				
			});
				
			}
			function remove_report(id)
        	{
        		
        		$('#loader').show();
        		
        		 $.ajax({
				type: "GET",
				url: "<?php echo site_path; ?>validation/remove_report/"+id,
				dataType: "json",
				success: function(html){
				if(html.status==0)
				{
					//event.preventDefault();
					alert('Removing Report Failed');	
									 
           			 
					
				}
				else
				{
						alert('Removed report Successfully');
						location.reload();
				}
				
				},
				complete: function (data) {
     			$('#loader').hide();
     				}
				
			});
				
			}
        	var files;
			// Add events
			$('input[type=file]').on('change', prepareUpload);
			$('#attachment_add').on('submit', uploadFiles);
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
		            url: '<?php echo site_path; ?>validation/attachment_add?files',
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
		            		$('#error_file').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+data.error+'</div>');
		            		//console.log('ERRORS: ' + data.error);
		            	}
		            },
		            error: function(jqXHR, textStatus, errorThrown)
		            {
		            	$('#loader').hide();
		            	// Handle errors here
		            	
		            	$('#error_file').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Wrong</div>');
		            	// STOP LOADING SPINNER
		            }
		        });
				
		    }

		    function submitForm(event, data)
			{
				// Create a jQuery object from the form
				$form = $(event.target);
				
				// Serialize the form data
				var formData = $('#attachment_add').serialize();
				//alert(formData);
				// You should sterilise the file names
				$.each(data.files, function(key, value)
				{
					formData = formData + '&filenames[]=' + value;
				});

				$.ajax({
					url: '<?php echo site_path; ?>validation/attachment_add',
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
								$('#error_file').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+data.message+'</div>');
								
							}
							else if(data.status==1)
							{
								alert('Attachment added successfuly');
								
								//alert($('#check_'+id).val());
								$( "#attachment_add .form-control" ).val('');
								$("#error").html("");
								/*window.location="<?php echo site_path; ?>employee_claim_requests";*/
								location.reload();
								
								
							}
							
		            	}
		            	else
		            	{
		            		// Handle errors here
		            		
		            		$('#error_file').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Some Errors occured</div>');
		            	}
		            },
		            error: function(jqXHR, textStatus, errorThrown)
		            {
		            	// Handle errors here
		            	$('#error_file').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Something Wrong</div>');
		            },
		            complete: function()
		            {
		            	// STOP LOADING SPINNER
		            }
				});
			}

        	
        </script>
            <script>
            	
            	$(document).ready(function(){
            		$('.select').select2();
            		
            	$( "#form_add" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>validation/step81",
				dataType: "json",
				data:$( "#form_add" ).serialize() ,
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
						$("#form_add [name='"+k+"']").focus();
						s++;
					}
					
           			 $("#form_add [name='"+k+"']").addClass( "error" );	
           			
       
    			});  
					$('#error_add').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>'+err+'</div>');
					 
           			 
					
				}
				else
				{
						$('#result').html(html.message);
						$('#myModal').modal('show');
						$('#myModal').on('hidden.bs.modal', function () {
    						location.reload();
						});
				}
				
				},
				complete: function (data) {
     			$('#loader').hide();
     				}
				
			});
			
			return false;
  			
  			
  
});
				$( "#form_edit" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>validation/step82",
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
						$('#result').html('Sub ordnates added successfully');
						$('#editModal').modal('hide');
						$('#myModal').modal('show');
						$("#form_edit .form_control").val('');
						$('#myModal').on('hidden.bs.modal', function () {
    						location.reload();
						});
				}
				
				},
				complete: function (data) {
     			$('#loader').hide();
     				}
				
			});
			
			return false;
  			
  			
  
});	
				
            		
            	});
            	
            </script>