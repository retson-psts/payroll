			 <div id="loader"></div>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
               <section class="content-header">
                   <h1>
                    <?php if(!isset($edit))
                    { ?>
                        Add Employee
                        <small>Salary Details</small>
                        <?php } else { echo "Edit Employee<small>Salary Details</small>";  } ?>
                        
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
                                        <h3 class="box-title"> <?php if(!isset($edit))
                    { ?>
                        Add Salary Details
                        <?php } else { echo "Manage Salary Details";  } ?></h3>
                                    </div><!-- /.box-header -->
                                    <div id="collapseExample">
                                    <form role="form"  action="#" method="post" enctype="multipart/form-data" id="form_add">
                                    <div id="error_add"></div>
                                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                  
                                   
                                        <input  type="hidden" name="employee_id" value="<?php echo $employee_id ?>"/>
                                        <input type="hidden" name="id" value="">
                                     <div class="box-body" id="form_field">
                                      
                                      <div class="col-md-12" style="background:#DDD; padding:10px 0;margin-bottom:20px;">
                                           <div class="form-group col-md-4">
                                             <label for="emp_salary_amount">Salary Amount *</label>
                                             <input type="text" class="form-control" name="emp_salary_amount" id="emp_salary_amount"  value="<?php echo  $form_data['emp_salary_amount']?>">
                                          </div>
                                           
                                         <!-- <div class="form-group col-md-4">
                                             <label for="emp_salary_currency_id">Currency *</label>
                                             <select id="emp_salary_currency_id" name="emp_salary_currency_id" class="form-control">
                                             <option value="">Select</option>
                                              <?php
                                                  if($curriencies!=false)
                                                  {
                                                      foreach($curriencies as $currency)
                                                      {
														  $select='';
														  if($form_data['emp_salary_currency_id']==$currency->code)
														  {
															  $select='selected="selected"';
														  }
                                                          echo '<option value="'.$currency->code.'" '.$select.'>'.$currency->currency_name.'</option>';
                                                      }
                                                  }
                                                  else
                                                  {
                                                      echo '<option>Please Add Currency</option>';
                                                  }
                                              ?>
                                              </select>
                                          </div>-->
                                           
                                          <div class="form-group col-md-4">
                                             <label for="emp_salary_pay_period">Pay Frequency</label>
                                             
                                             <select class="form-control" name="emp_salary_pay_period" id="emp_salary_pay_period" value="<?php echo  $form_data['emp_salary_pay_period']?>">
                                             <option value="">Select</option>
                                             <?php
											 foreach($pay_periods as $pay_period)
											 {
												  $select='';
												  if($form_data['emp_salary_pay_period']==$pay_period->payperiod_code)
												  {
													  $select='selected="selected"';
												  }
												  echo '<option value="'.$pay_period->payperiod_code.'" '.$select.'>'.$pay_period->payperiod_name.'</option>';
											 }
											 ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="emp_salary_pay_period">Weekly Working Days</label>
                                             
                                             <select class="form-control" name="emp_weekly_days" id="emp_weekly_days">
                                             <option value="">Select</option>
                                             <?php
											 foreach($weekly_days as $item)
											 {
												  $select='';
												  if($form_data['emp_weekly_days']==$item)
												  {
													  $select='selected="selected"';
												  }
												  echo '<option  '.$select.'>'.$item.'</option>';
											 }
											 ?>
                                             </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="emp_salary_per_day_hour">Per Day Hour</label>
                                             <input type="text" class="form-control" name="emp_salary_per_day_hour" id="emp_salary_per_day_hour"  value="<?php echo  $form_data['emp_salary_per_day_hour']?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                             <div class="checkbox" style="margin-left: 20px"> <label> <input type="checkbox" name="emp_salary_fixed" id="emp_salary_fixed" <?php if($form_data['emp_salary_fixed']==1) { echo 'checked="checked"';}?>> Salary Fixed </label> </div>
                                           </div>
                                           
                                          <div class="form-group col-md-4">
                                             <label for="emp_salary_pay_period">Comments</label>
                                             <textarea name="emp_salary_comments" class="form-control" id="emp_salary_comments"><?php echo  $form_data['emp_salary_comments']?></textarea>
                                          </div>
                                          </div>
                                         
                                          
                                          <div class="col-md-12">
                                          <!-- <div class="form-group col-md-4">
                                             <div class="checkbox"> <label> <input type="checkbox" name="emp_salary_cpf" id="emp_salary_emp_salary_cpf" <?php if($form_data['emp_salary_cpf']==1) { echo 'checked="checked"';}?> > CPF(Central Provident Fund) </label> </div>
                                           </div>-->
                                            
                                           <div class="form-group col-md-4">
                                             <div class="checkbox"> <label> <input type="checkbox" name="emp_salary_cdac" id="emp_salary_cdac" <?php if($form_data['emp_salary_cdac']==1) { echo 'checked="checked"';}?>> CDAC </label> </div>
                                           </div>
                                           
                                            <div class="form-group col-md-4">
                                             <div class="checkbox"> <label> <input type="checkbox" name="emp_salary_mbmf" id="emp_salary_mbmf" <?php if($form_data['emp_salary_mbmf']==1) { echo 'checked="checked"';}?>> MBMF </label> </div>
                                           </div>
                                           
                                           
                                           <div class="form-group col-md-4">
                                             <div class="checkbox"> <label> <input type="checkbox" name="emp_salary_sinda" id="emp_salary_sinda" <?php if($form_data['emp_salary_sinda']==1) { echo 'checked="checked"';}?>> SINDA </label> </div>
                                           </div>
                                           
                                           
                                           <div class="form-group col-md-4">
                                             <div class="checkbox"> <label> <input type="checkbox" name="emp_salary_ecf" id="emp_salary_ecf" <?php if($form_data['emp_salary_ecf']==1) { echo 'checked="checked"';}?>> ECF </label> </div>
                                           </div>
                                           
                                           
                                           <div class="form-group col-md-4">
                                             <div class="checkbox"> <label> <input type="checkbox" name="emp_salary_share" id="emp_salary_share" <?php if($form_data['emp_salary_share']==1) { echo 'checked="checked"';}?>> SHARE </label> </div>
                                           </div>
										   
										   
                                           
                                           
                                           <div class="form-group col-md-4">
                                             <div class="checkbox"> <label> <input type="checkbox" name="emp_salary_sdl" id="emp_salary_sdl" <?php if($form_data['emp_salary_sdl']==1) { echo 'checked="checked"';}?>> SDL </label> </div>
                                           </div>
                                           
                                           
                                           <div class="form-group col-md-4">
                                             <div class="checkbox"> <label> <input type="checkbox" name="emp_allowance" id="emp_salary_share" <?php if($form_data['emp_allowance']==1) { echo 'checked="checked"';}?>> Allowance Available </label> </div>
                                           </div>
                                           <div class="form-group col-md-4">
                                             <div class="checkbox"> <label> <input type="checkbox" name="emp_salary_levy" id="emp_salary_levy" <?php if($form_data['emp_salary_levy']==1) { echo 'checked="checked"';}?>> LEVY </label> </div>
                                           </div>
                                           <div class="form-group col-md-4">
                                             <label for="emp_salary_levy_amt">Levy Payable</label>
                                             <input type="text" class="form-control" name="emp_salary_levy_amt" id="emp_salary_levy_amt"  value="<?php echo  $form_data['emp_salary_levy_amt']?>">
                                          </div>
                                            </div>
                                           
                                           
                                           
                                           <div class="col-md-12">
                                           <!-- <div class="form-group col-md-4">
                                             <label for="emp_salary_per_hour">Per Hour ($) </label>
                                             <input type="text" class="form-control" name="emp_salary_per_hour" id="emp_salary_per_hour"  value="<?php echo  $form_data['emp_salary_per_hour']?>">
                                          </div>-->
                                          
                                           <!-- <div class="form-group col-md-4">
                                             <label for="emp_salary_per_day_hour">Per Day Hour</label>
                                             <input type="text" class="form-control" name="emp_salary_per_day_hour" id="emp_salary_per_day_hour"  value="<?php echo  $form_data['emp_salary_per_day_hour']?>">
                                          </div>-->
                                           
                                           <!--<div class="form-group col-md-4">
                                             <label for="emp_salary_weekly_hour">Weekly Hour($)</label>
                                             <input type="text" class="form-control" name="emp_salary_weekly_hour" id="emp_salary_weekly_hour"  value="<?php echo  $form_data['emp_salary_weekly_hour']?>">
                                          </div>-->
                                          
                                          <!-- <div class="form-group col-md-4">
                                             <label for="emp_salary_weekly_pay">Weekly Pay($)</label>
                                             <input type="text" class="form-control" name="emp_salary_weekly_pay" id="emp_salary_weekly_pay"  value="<?php echo  $form_data['emp_salary_weekly_pay']?>">
                                          </div>-->
                                          
                                         <!-- <div class="form-group col-md-4">
                                             <label for="emp_salary_monthly_hour">Monthly Hour($)</label>
                                             <input type="text" class="form-control" name="emp_salary_monthly_hour" id="emp_salary_monthly_hour"  value="<?php echo  $form_data['emp_salary_monthly_hour']?>">
                                          </div>-->
                                          
                                           <!--<div class="form-group col-md-4">
                                             <label for="emp_salary_monthly_pay">Monthly Pay($)</label>
                                             <input type="text" class="form-control" name="emp_salary_monthly_pay" id="emp_salary_monthly_pay"  value="<?php echo  $form_data['emp_salary_monthly_pay']?>">
                                          </div>-->
                                           
                                          <div class="form-group col-md-4">
                                             <label for="emp_salary_over_time">Over Time</label>
                                             <select class="form-control" name="emp_salary_over_time" id="emp_salary_over_time" value="<?php echo  $form_data['emp_salary_over_time']?>">
                                             <option value="">Select</option>
                                             <option <?php  if($form_data['emp_salary_over_time']==1){ echo 'selected="selected"';} ?> value="1">OT 1.5</option>
                                             <option <?php  if($form_data['emp_salary_over_time']==2){ echo 'selected="selected"';} ?> value="2">OT 2</option>
                                              <option <?php  if($form_data['emp_salary_over_time']==2){ echo 'selected="selected"';} ?> value="3">OT fixed</option>
                                             </select>
                                            </div>
                                            
                                            
                                           <div class="form-group col-md-4">
                                             <label for="emp_ot_base_amount">OT Base Amount($)</label>
                                             <input type="text" class="form-control" name="emp_ot_base_amount" id="emp_ot_base_amount"  value="<?php echo  $form_data['emp_ot_base_amount']?>">
                                             <p class="help-block">For Only OT Fixed Employees</p>
                                          </div>
                                            
                                            
                                          <!-- <div class="form-group col-md-4">
                                             <label for="emp_ot_per_hour_amount">OT Per Hour Amount($)</label>
                                             <input type="text" class="form-control" name="emp_ot_per_hour_amount" id="emp_ot_per_hour_amount"  value="<?php echo  $form_data['emp_ot_per_hour_amount']?>">
                                          </div>-->
                                          
                                          
                                          
                                     
                                      
                                      </div>
                                      </div>
                                      <div class="clearfix"></div>
                                     <div class="box-footer" id="save_panel" style="display:none;">
                                          <button type="submit" name="submit" class="btn btn-success text-center">Save</button>
                                          <button type="submit" name="cancel" class="btn btn-warning text-center" onclick="cancel_edit();return false;">Cancel</button>
                                          
                                      </div>
                                      <div class="box-footer" id="edit_panel">
                                          <button type="submit" name="save" class="btn btn-primary text-center" onclick="enable_edit();return false;">Edit</button>
                                          <?php if(!isset($edit))
                    			{ ?>
                     		 <a href="<?php echo site_path ?>add_employee/employee_report/<?php echo $employee_id; ?>" class="btn btn-info text-center">Next</a>
                       
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
                                        <input type="hidden" name="screen" value="es" />
                                        <input type="hidden" name="emp_id" value="<?php echo $employee_id; ?>"/>
                                       
                                        <div id="add_attach_form" >
                                          <div class="box-body">
                                            <div class="form-group col-md-4">
                                               <label for="attach_file">Select File *</label>
                                               <input type="file"  required="" name="attach_file" id="attach_file" class="form-control"/>
                                               <p class="help-block">File should be jpeg,gif, pdf, png, doc, docx or excel format (file size not more than 2 MB)</p>
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
			<div id="editModal" class="modal fade" role="dialog">
  				<div class="modal-dialog">
 <form role="form"  action="#" method="post" enctype="multipart/form-data" id="form_edit">
    				<!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Employee Dependent </h4>
      </div>
				      <div class="modal-body">
				       
                                    <div id="error_edit"></div>
                                    
                                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>" />
                                     <input  type="hidden" name="id"  value=""/>
                                        <input  type="hidden" name="employee_id" value="<?php echo $employee_id; ?>"/>
                                    <div id="add_form" >
                                      <div class="box-body">
                                         <div class="form-group col-md-8">
                                           <label for="">Name *</label>
                                           <input type="text" class="form-control" name="ed_name" id="ed_name" value="">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-8">
                                           <label for="eec_relationship">Relationship *</label>
                                           <select class="form-control" name="ed_relationship_type" id="ed_relationship_type1" onchange="relation1(this.id);">
                                           <option value="">Select Relationship</option>
                                           <option value="Parents">Parents</option>
                                           <option value="Child">Child</option>
                                           <option value="Spouse">Spouse</option>
                                           <option value="Others">Others</option>
                                           
                                           </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-8" id="specify1" style="display:none;">
                                           <label for="specify">Please Specify *</label>
                                           <input type="text" class="form-control" name="specify" id="specify" value="">
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                        <div class="form-group col-md-8">
                                          <label for="ed_date_of_birth">Date of Birth</label>
                                          <div class="input-group">
                                             <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                             </div>
                                             <input type="text" class="form-control date" name="ed_date_of_birth" id="ed_date_of_birth"  placeholder="" value="">
                                             </div>
                                        </div>
                                        
                                        
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="box-footer text-center">
                                          
                                            
                                      </div>
                                    </div>
                                  
                                   
				      </div>
				      <div class="modal-footer">
				         <button type="submit" name="save" class="btn btn-primary text-center">Save changes</button>
                         <button type="reset" class="btn btn-danger text-center" data-dismiss="modal" aria-label="Close">Cancel</button>
                                            
				      </div>
				       
				    </div>
				    </form>

  </div>
			</div>
			<script src="<?php echo  js_path?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        	<script src="<?php echo  js_path?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>      
        
         <script type="text/javascript">
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
				if($('#emp_salary_pay_period').val()==4)
            			{
							$('#emp_salary_fixed').attr("disabled", false);
						}
						else
						{
							$('#emp_salary_fixed').attr("disabled", true);
						}
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
            		
            		
            		$('#emp_salary_pay_period').change(function(){
            			
            			if($(this).val()==4)
            			{
							$('#emp_salary_fixed').attr("disabled", false);
						}
						else
						{
							$('#emp_salary_fixed').attr("disabled", true);
						}
            			
            			
            		});
            		$("#form_field :input").attr("disabled", true);
            		$("#emp_joined_date,#emp_job_start_date,#emp_job_end_date").each(function(){
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
				url: "<?php echo site_path; ?>validation/step7",
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
				
				
            		
            	});
            	
            </script>