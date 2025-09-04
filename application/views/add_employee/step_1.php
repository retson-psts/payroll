            <div id="loader"></div>
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    <?php if(!isset($edit))
                    { ?>
                        Add Employee
                        <small>Add New Employee</small>
                        <?php } else { echo "Edit Employee<small>Edit Employee</small>";  } ?>
                        
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo site_path; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="<?php echo site_path; ?>list_employee/">Employee</a></li>
                        <?php if(!isset($edit))
                    			{ ?>
                     		 <li class="active">Add Employee</li>
                       
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
                                <div class="col-md-12 ">
                                	<?php
									echo $nav_steps;
									//print_r($form_data);
									?>
                                  <!-- form start -->
                                    <div id="form1" class="tab-pane active add_panel">
                                    
                                      <div class="box-header">
                                        <h3 class="box-title">Employee's Personal Details (Step 1)</h3>
                                      </div><!-- /.box-header -->
                                      <!-- form start -->
                                       
                                      
                                      
                                      
                                          <form autocomplete="off" role="form" id="frm" action="<?php echo  site_path."edit_employee_process/employee_personal/".$employee_id?>" method="post">
                                      
									  <div id="error"><?php echo  $message_div ?></div>
									  	  <input type="hidden" name="employee_id" value="<?php echo $employee_id; ?>">	
                                          <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                          <div class="box-body" >
                                               <div class="form-group col-md-4">
                                                  <label for="emp_firstname">First Name *</label>
                                                  <input type="text" class="form-control" name="emp_firstname" id="emp_firstname" value="<?php echo  $form_data['emp_firstname'] ?>">
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="emp_middle_name">Middle Name</label>
                                                  <input type="text" class="form-control" name="emp_middle_name" id="emp_middle_name" value="<?php echo  $form_data['emp_middle_name'] ?>">
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="emp_lastname">Last Name *</label>
                                                  <input type="text" class="form-control" name="emp_lastname" id="emp_lastname"  value="<?php echo  $form_data['emp_lastname'] ?>">
                                              </div>
                                              <hr>
                                              <div class="form-group col-md-4">
                                                  <label for="emp_number">Employee Number/ID *</label>
                                                  <input type="text" class="form-control" name="emp_number" id="emp_number"  value="<?php echo  $form_data['emp_number'] ?>">
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="emp_other_id">Other ID</label>
                                                  <input type="text" class="form-control" name="emp_other_id" id="emp_other_id"  value="<?php echo  $form_data['emp_other_id'] ?>">
                                              </div>
                                              <div class="clearfix"></div>
                                              <div class="form-group col-md-4">
                                                  <label for="emp_dri_lice_num">Driving License No</label>
                                                  <input type="text" class="form-control" name="emp_dri_lice_num" id="emp_dri_lice_num" placeholder="" value="<?php echo  $form_data['emp_dri_lice_num'] ?>">
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="emp_licence_type">License Type</label>
                                                  <select class="form-control" name="emp_licence_type" id="emp_licence_type">
                                                  <option value="">Select Licence Type</option>
                                                    <option <?php if($form_data['emp_licence_type']==1){ echo "selected='selected'"; } ?> value="1">Class 1</option>
                                                    <option <?php if($form_data['emp_licence_type']==2){ echo "selected='selected'"; } ?> value="2">Class 2B</option>
                                                    <option <?php if($form_data['emp_licence_type']==3){ echo "selected='selected'"; } ?> value="3">Class 2A</option>
                                                    <option <?php if($form_data['emp_licence_type']==4){ echo "selected='selected'"; } ?> value="4">Class 2</option>
                                                    <option <?php if($form_data['emp_licence_type']==5){ echo "selected='selected'"; } ?> value="5">Class 3</option>
                                                    <option <?php if($form_data['emp_licence_type']==6){ echo "selected='selected'"; } ?> value="6">Class 3A</option>
                                                    <option <?php if($form_data['emp_licence_type']==7){ echo "selected='selected'"; } ?> value="7">Class 4A</option>
                                                    <option <?php if($form_data['emp_licence_type']==8){ echo "selected='selected'"; } ?> value="8">Class 4</option>
                                                    <option <?php if($form_data['emp_licence_type']==9){ echo "selected='selected'"; } ?> value="9">Class 5</option>
                                                    
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="emp_dri_lice_exp_date">Licence Expiry Date</label>
                                                  <div class="input-group">
                                                     <div class="input-group-addon">
                                                          <i class="fa fa-calendar"></i>
                                                     </div>
                                                  	 <input type="text" class="form-control date" name="emp_dri_lice_exp_date" id="emp_dri_lice_exp_date"  placeholder="" value="<?php if($form_data['emp_dri_lice_exp_date']!='0000-00-00'){ echo  $form_data['emp_dri_lice_exp_date']; } ?>">
                                                     </div>
                                              </div>
                                              <hr>
                                              <div class="form-group col-md-4">
                                                  <label for="emp_gender">Gender *</label>
                                                  <select class="form-control" name="emp_gender" id="emp_gender">
                                                  <option value="">Select Gender</option>
                                                    <option <?php if($form_data['emp_gender']==1){ echo "selected='selected'"; } ?> value="1">Male</option>
                                                    <option <?php if($form_data['emp_gender']==2){ echo "selected='selected'";} ?> value="2">Female</option>
                                                    <option <?php if($form_data['emp_gender']==3){ echo "selected='selected'"; } ?> value="3">Others</option>
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="nation_code">Nationality *</label>
                                                
                                                  <select class="form-control" name="nation_code" id="nation_code">
                                                  
                                                  <option value="">-Please Select a Nationality-</option>
	  <?php
      if($update_panel==false) 
	  {
		foreach($nationality_list as $country)
		{
		  $select='';
		  if($form_data['nation_code']==$country->country_id)
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$country->country_id.'" '.$select.'>'.$country->country_nationality.'</option>';
		}
      }
      
      else
      {
		  //print_r($nationality_list);
		foreach($nationality_list as $country)
		{
		  $select='';
		  if($form_data['nation_code']==$country->country_id)
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$country->country_id.'" '.$select.'>'.$country->country_nationality.'</option>';
		}
      
      }
      ?>
                                                   </select>
                                              </div>
                                              <div class="clearfix"></div>
                                              <div class="form-group col-md-4">
                                              	<label for="emp_birthday">Date of Birth *</label>
                                                  <div class="input-group">
                                                     <div class="input-group-addon">
                                                          <i class="fa fa-calendar"></i>
                                                     </div>
                                                  	 <input type="text" class="form-control date" name="emp_birthday" id="emp_birthday"  placeholder=""  value="<?php echo  $form_data['emp_birthday'] ?>">
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-4">
                                                  <label for="emp_marital_status">Marital Status</label>
                                                  <select class="form-control" name="emp_marital_status" id="emp_marital_status">
                                                  <option value="">select Marital Status</option>
                                                      <option <?php if($form_data['emp_marital_status']==1){ echo "selected='selected'"; } ?> value="1">Married</option>
                                                      <option <?php if($form_data['emp_marital_status']==2){ echo "selected='selected'"; } ?> value="2">Single</option>
                                                      <option <?php if($form_data['emp_marital_status']==3){ echo "selected='selected'"; } ?> value="3">Divorced</option>
                                                      <option <?php if($form_data['emp_marital_status']==4){ echo "selected='selected'"; } ?> value="4">Widow</option>
                                                      <option <?php if($form_data['emp_marital_status']==5){ echo "selected='selected'"; } ?> value="5">Widower</option>
                                                  </select>
                                              </div>
                                              <div class="form-group col-md-4">
                                              <?php
                                                $login=$form_data['username'];
                                              ?>
                                              <label for="employement_status">Enable Login *</label>
                                               <select class="form-control" name="enable_login" id="enable_login">
                                                    <option value="0" <?php if($login=='') { echo "selected='selected'";}?>>No</option>
                                                    <option value="1" <?php if($login!='') { echo "selected='selected'";}?>>Yes</option>
                                                </select>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-6" id="login_details" <?php if($login=='') { echo 'style="display:none"';}?> >
                                                <div class="box-header">
                                                    <h3 class="box-title">Login Details</h3>
                                                </div><!-- /.box-header -->
                                                <div class="form-group col-md-4">
                                                   <label for="username">Username *</label>
                                                   <input type="text" class="form-control" name="username" id="username" value="<?php echo  $form_data['username'] ?>">
                                                </div>
                                                <div class="form-group col-md-4">
                                                   <label for="employement_status">Password *</label>
                                                   <input type="password" class="form-control" name="password" id="password">
                                                </div>
                                            </div>
                                            </div><!-- /.box-body -->
                                            <div class="clearfix"></div>
                                            <div class="box-footer text-center">
                                                <button type="submit" name="submit" class="btn btn-primary text-center">Save</button><?php if($employee_id!=0){ ?>  <?php if(!isset($edit))
                    			{ ?>
                     		<a href="<?php echo  site_path."add_employee/employee_contact/".$employee_id?>" class="btn btn-warning">Next</a>
                       
                        <?php } else { ?>
                        
                        <a href="<?php echo site_path ?>employee_profile/<?php echo $employee_id; ?>" class="btn btn-info text-center">Cancel</a>
                        <?php   } ?>   <?php } ?>
                                            </div>
                                          </form>
                                    </div><!-- form 1 ends -->
                             </div>
                            </div><!--.box Ends-->
                        </div><!--.col-md-12  Ends-->
                    </div>   <!-- /.row -->
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
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				      </div>
				    </div>

  </div>
			</div>
            <script>
            $(document).ready(function(){
            	
            	
            	$('.date').datepicker({
					format: "yyyy-mm-dd"
				});
				
				$('#emp_birthday').datepicker({
					format: "yyyy-mm-dd"
				});

				$("#enable_login").change(function() {
					
					var enable_login=$("#enable_login").val();
					if(enable_login==1)
					{
						$("#login_details").css("");
						$("#login_details").css("display","block");
					}
					else
					{
						$("#login_details").css("");
						$("#login_details").css("display","none");
					}
				});

				$( "#frm" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>validation/step1",
				dataType: "json",
				data:$( "#frm" ).serialize() ,
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
						$("#"+k).focus();
						s++;
					}
					
           			 $("#frm [name='"+k+"']").addClass( "error" );	
           			
       
    			});  
					$('#error').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>'+err+'</div>');
					 
           			 
					
				}
				else
				{
						$('#result').html(html.message);
						$('#myModal').modal('show');
						$('#myModal').on('hidden.bs.modal', function () {
							<?php if(isset($edit))
							{
								echo "window.location='".site_path."employee_profile/".$employee_id."';";
							}
							else
							{
								echo "window.location=html.url;";
							} ?>
								
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