			 <div id="loader"></div>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    <?php if(!isset($edit))
                    { ?>
                        Add Employee
                        <small>Job Details</small>
                        <?php } else { echo "Edit Employee<small>Job Details</small>";  } ?>
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_path; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_path; ?>list_employee/">Employee</a></li>
                        <?php if(!isset($edit))
                    			{ ?>
                     		 <li class="active">add Employee</li>
                       
                        <?php } else { echo "<li class='active'>Edit Employee</li>";  } ?>
                        
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
                                       
                                        <?php if(!isset($edit))
                    			{ ?>
                     		  <h3 class="box-title">Add Job details</h3>
                       
                        <?php } else { echo "<h3 class='box-title'>Edit Job details</h3>";  } ?>
                                    </div><!-- /.box-header -->
                                    <div id="collapseExample">
                                    <form role="form"  action="#" method="post" enctype="" id="form_add">
                                    <div id="error_add"></div>
                                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                  
                                   
                                        <input  type="hidden" name="employee_id" value="<?php echo $employee_id ?>"/>
                                        <input type="hidden" name="id" value="">
                                     <div class="box-body" id="form_field" >
                                           <div class="form-group col-md-4">
                                             <label for="emp_joined_date">Joined Date</label>
                                             <input type="text" class="form-control date" name="emp_joined_date" id="emp_joined_date" placeholder="yyyy-mm-dd" value="<?php if($form_data['emp_joined_date']!='0000-00-00') { echo  $form_data['emp_joined_date']; }?>">
                                           </div>
                                          <div class="form-group col-md-4">
                                             <label for="emp_job_title">Job Title</label>
                                             <select id="emp_job_title" name="emp_job_title" class="form-control">
                                             <option value="">Select</option>
                                              <?php
                                                  if($list_job_titles!=false)
                                                  {
                                                  	 
                                                      foreach($list_job_titles as $job_title)
                                                      {
                                                      	$select='';
														 
														  if($form_data['emp_job_title']==$job_title->job_title_id)
														  {
															  $select='selected="selected"';
														  }
                                                          echo '<option value="'.$job_title->job_title_id.'" '.$select.'>'.$job_title->job_title_name.'</option>';
                                                      }
                                                  }
                                                  else
                                                  {
                                                      echo '<option>Please Select add Job Title</option>';
                                                  }
                                              ?>
                                              </select>
                                          </div>
                                          <!--<div class="form-group col-md-4">
                                             <label for="emp_job_status">Employment Status</label>
                                               <input type="text" class="form-control" name="emp_job_status" id="emp_job_status" placeholder="" value="<?php echo  $form_data['emp_job_status']?>">
                                          </div>-->
                                          <div class="form-group col-md-4">
                                             <label for="emp_sub_unit">Sub Unit <?php echo $form_data['emp_sub_unit']; ?></label>
                                             <select class="form-control" onchange="change_project(this);" name="emp_sub_unit" id="emp_sub_unit">
                                             <option value="">Select</option>
                                             <?php
                                            $string='';
												if($project_list!=false)
												{
													
													foreach($project_list as $project)
													{
														$select="";
														if($form_data['emp_sub_unit']==$project->project_id)
														{
															$select='selected="selected"';
														}
													  echo '<option '.$select.' value="'.$project->project_id.'">'.$project->project_title.'</option>';
													}
												}
											?>
                                                  
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="emp_job_location">Location</label>
                                             <select class="form-control" name="emp_job_location" id="emp_job_location">
                                             <option value="">Select</option>
                                              <?php
                                            $string='';
												if($locations!=false)
												{
													
													
													foreach($locations as $project)
													{
														$select="";
														if($form_data['emp_job_location']==$project['location_id'])
														{
															$select='selected="selected"';
														}
													  echo '<option '.$select.' value="'.$project['location_id'].'">'.$project['location_name'].'</option>';
													}
												}
											?>
                                                  
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="Annual_Leave">Annual Leave</label>
                                             <input type="text" class="form-control" name="annual_leave" id="annual_leave" placeholder="" value="<?php  echo  $form_data['annual_leave']; ?>">
                                          </div>
                                           <div class="form-group col-md-4">
                                             <label for="Sick leave">Sick Leave</label>
                                             <input type="text" class="form-control" name="sick_leave" id="sick_leave" placeholder="" value="<?php  echo  $form_data['sick_leave']; ?>">
                                          </div>
                                          <div class="clearfix"></div>
                                          <h4 class="box-title">Employment Contract</h4>
                                           <div class="form-group col-md-4">
                                             <label for="emp_job_start_date">Start Date</label>
                                             <input type="text" class="form-control date" name="emp_job_start_date" id="emp_job_start_date" placeholder="" value="<?php if($form_data['emp_job_start_date']!='0000-00-00') { echo  $form_data['emp_job_start_date']; }?>">
                                          </div>
                                           <div class="form-group col-md-4">
                                             <label for="emp_job_end_date">End Date</label>
                                             <input type="text" class="form-control date" name="emp_job_end_date" id="emp_job_end_date" placeholder="" value="<?php if($form_data['emp_job_end_date']!='0000-00-00') { echo  $form_data['emp_job_end_date']; }?>">
                                          </div>
                                      <div class="clearfix"></div>
                                      </div>
                                      <div class="clearfix"></div>
                                     <div class="box-footer" id="save_panel" style="display:none;">
                                          <button type="submit" name="submit" class="btn btn-success text-center">Save</button>
                                          <button type="submit" name="cancel" class="btn btn-warning text-center" onclick="cancel_edit();return false;">Cancel</button>
                                          <a href="javascript:void(0);"  class="btn btn-danger text-center" onclick="terminate_employment(this);" >Terminate Employment</a>
                                      </div>
                                      <div class="box-footer" id="edit_panel">
                                          <button type="submit" name="save" class="btn btn-primary text-center" onclick="enable_edit();return false;">Edit</button>
                                          <button type="submit" name="terminate_employment" class="btn btn-danger text-center" onclick="terminate_employment();return false;" disabled="disabled">Terminate Employment</button>
                                          <?php if(!isset($edit))
                    			{ ?>
                     		<a href="<?php echo site_path ?>add_employee/employee_salary/<?php echo $employee_id; ?>" class="btn btn-info text-center">Next</a>
                       
                        <?php } else { ?>
                        
                        <a href="<?php echo site_path ?>employee_profile/<?php echo $employee_id; ?>" class="btn btn-info text-center">Finish</a>
                        <?php   } ?> 
                                          
                                           
                                      </div>
                                   
                                  
                                    </form>
</div>
                                  </div><!-- Add Panel Ends-->
                                  <div class="clearfix"></div>
                                  <!-- /.list-results -->
                              <div class="attachments">
                              	   <div class="box-header">
                                       <h3 class="box-title">Attachments</h3>
                                   </div><!-- /.box-header -->
                                   <div class="attachment_add">
                                       <form role="form" id="attachment_add"  action="" method="post" enctype="multipart/form-data">
                                       <div id="error_file"></div>
                                       
                                        <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                        <input type="hidden" name="screen" value="ej" />
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
                                             <h3 class="box-title">Attachments Job details</h3>
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
			<div id="terminate" class="modal fade" role="dialog">
  				<div class="modal-dialog">
 <form role="form"  action="#" method="post" enctype="multipart/form-data" id="form_edit">
    				<!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Terminate Employement</h4>
      </div>
				      <div class="modal-body">
				       
                                    <div id="error_edit"></div>
                                    
                                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>" />
                                        <input  type="hidden" name="termination_emp_id" value="<?php echo $employee_id; ?>"/>
                                    <div id="add_form" >
                                      <div class="box-body">
                                         <div class="form-group col-md-8">
                                           <label for="">Terminate Date *</label>
                                          <div class="input-group">
                                             <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                             </div>
                                             <input type="text" class="form-control date" name="termination_date" id="terminate_date"  placeholder="" value="">
                                             </div>
                                        
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-8">
                                           <label for="specify">Description *</label>
                                           <textarea class="form-control" name="termination_description"></textarea>
                                           
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                        
                                        
                                        
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="box-footer text-center">
                                          
                                            
                                      </div>
                                    </div>
                                  
                                   
				      </div>
				      <div class="modal-footer">
				         <button type="submit" name="save" class="btn btn-primary text-center">Terminate Exployement</button>
                         <button type="reset" class="btn btn-danger text-center" data-dismiss="modal" aria-label="Close">Cancel</button>
                                            
				      </div>
				       
				    </div>
				    </form>

  </div>
			</div>
			<script src="<?php echo  js_path?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        	<script src="<?php echo  js_path?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>      
        
         <script type="text/javascript">
          var locations=<?php echo $locations?json_encode($locations):""; ?>;
         
           function terminate_employment(e)
         {
		 	$('#terminate').modal('show');
		 }
         		function change_project(e)
			{
				
				var project=$(e).val();
				
				var id=$(e).attr('id');
				var arr=id.split('_');
				u='<option value="">select</option>';
			    for(var i=0;i<locations.length;i++)
			    {
			    	if(locations[i].project_id==project)
			    	{
			    		u+='<option value='+locations[i].location_id+'>'+locations[i].location_name+'</option>';
			    	}
				 
				}
				$('#emp_job_location').html(u);
				
				
				
			}
         		function enable_edit(id,name,relationshiptype,relationship,dob)
            	{
					$("#form_edit [name='ed_name']").val(name);
					$("#form_edit [name='ed_relationship_type']").val(relationshiptype);
					$("#form_edit [name='ed_date_of_birth']").val(dob);
					if(relationshiptype=='Others')
					{
						$("#form_edit [name='specify']").val(dob);	
						$('#specify1').css('display','block');
					}
					
					$("#form_edit [name='id']").val(id);
					$('#editModal').modal('show');
					
				
				}
            $(function() {
                $("#example1").dataTable();
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

        	function enable_edit()
			{
				$('#edit_panel').css('display','none');
				$('#save_panel').css('display','block');
				$("#form_field :input").attr("disabled", false);
			}
			function cancel_edit()
			{
				$("#form_field :input").attr("disabled", "disabled");
				$('#save_panel').css('display','none');
				$('#edit_panel').css('display','block');
			}
        </script>
            <script>
            	
            	$(document).ready(function(){
            		$("#form_field :input").attr("disabled", true);
            		$(".date").each(function(){
				$(this).datepicker({
					 format: "yyyy-mm-dd",
    				 startView: "decade"
				});
			});
            		
            	$( "#form_add" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>validation/step6",
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
				else if(html.status==1)
				{
						$('#result').html(html.message);
						$('#myModal').modal('show');
						$('#myModal').on('hidden.bs.modal', function () {
    						location.reload();
						});
				}
				else
				{
					$('#result').html("something wrong please try again");
						$('#myModal').modal('show');
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
					url: "<?php echo site_path; ?>terminate/termination",
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
							$('#result').html('Employee Terminated Successfully');
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