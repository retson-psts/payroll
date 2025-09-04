             <!-- Right side column. Contains the navbar and content of the page -->
             <div id="loader"></div>
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    <?php if(!isset($edit))
                    { ?>
                        Add Employee
                        <small>Add Employee's Contact Details</small>
                        <?php } else { echo "Edit Employee<small>Employee's Contact Details</small>";  } ?>
                        
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
                            	  
                                <div class="col-md-12 ">
                                	<?php
									echo $nav_steps;
									?>
                                  <!-- form start -->
                                    <div id="form1" class="tab-pane active add_panel">
                                    
                                <form id="frm" role="form" action="<?php echo  site_path.'add_employee_process/employee_contact/'.$employee_id?>" method="post">
                                 <div id="error"><?php echo  $message_div ?></div>
                                <input type="hidden" name="employee_id" value="<?php echo  $form_data['employee_id']?>" id="employee_id"/>
                                <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                    <div class="box-body" >
                                        <div class="box-header">
                                          <h4 class="box-title">Employee's Contact Details (Step 2)</h4>
                                         </div>  
                                        <div class="form-group col-md-4">
                                            <label for="emp_hm_telephone">Home Phone *</label>
                                            <input type="text" class="form-control" name="emp_hm_telephone" id="emp_hm_telephone" value="<?php echo  $form_data['emp_hm_telephone'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="em p_mobile">Mobile Phone</label>
                                            <input type="text" class="form-control" name="emp_mobile" id="emp_mobile" value="<?php echo  $form_data['emp_mobile'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="emp_work_telephone">Work  Phone</label>
                                            <input type="text" class="form-control" name="emp_work_telephone" id="emp_work_telephone" value="<?php echo  $form_data['emp_work_telephone'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="emp_work_email">Work Email</label>
                                            <input type="text" class="form-control" name="emp_work_email" id="emp_work_email" value="<?php echo  $form_data['emp_work_email'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="emp_oth_email">Personal Email</label>
                                            <input type="text" class="form-control" name="emp_oth_email" id="emp_oth_email" value="<?php echo  $form_data['emp_oth_email'] ?>">
                                        </div>
                                        <!-- Current Address Bar Starts-->
                                        <hr>
                                        <div class="box-header">
                                          <h4 class="box-title">Current Address</h4>
                                         </div>  
                                         <div class="form-group col-md-4 warning">
                                            <label for="emp_contact_temp_street1">Address Line1 *</label>
                                            <input type="text" class="form-control" name="emp_contact_temp_street1" id="emp_contact_temp_street1" value="<?php echo  $form_data['emp_contact_temp_street1'] ?>">
                                         </div>
                                        <div class="form-group col-md-4">
                                           <label for="emp_contact_temp_street2">Address Line2</label>
                                             <input type="text" class="form-control" name="emp_contact_temp_street2" id="emp_contact_temp_street2" value="<?php echo  $form_data['emp_contact_temp_street2'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="emp_contact_temp_country">Country</label>
                                            
                                            
                                             <select class="form-control select"  name="emp_contact_temp_country" id="emp_contact_temp_country">
                                                  
                                                  <option value="">-Please Select a Country-</option>
	  <?php
      
		  //print_r($nationality_list);
		foreach($nationality_list as $country)
		{
		  $select='';
		  if($form_data['emp_contact_temp_country']==$country->country_id)
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$country->country_id.'" '.$select.'>'.$country->country_name.'</option>';
		}
      
      
      ?>
                                                   </select>
                                                   
                                                   
                                                   
                                         
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-4">
                                            <label for="emp_contact_temp_provience">Province</label>
                                            <select class="form-control select"  name="emp_contact_temp_provience" id="emp_contact_temp_provience">
                                                  
                                                  <option value="">-Please Select a Province-</option>
	  <?php
      
		  //print_r($nationality_list);
		foreach($state as $item)
		{
		  $select='';
		  if($form_data['emp_contact_temp_provience']==$item['state_id'])
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$item['state_id'].'" '.$select.'>'.$item['state_name'].'</option>';
		}
      
      
      ?>
                                                   </select>
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label for="emp_contact_temp_city">City</label>
                                            <select class="form-control select"  name="emp_contact_temp_city" id="emp_contact_temp_city">
                                                  
                                                  <option value="">-Please Select a City-</option>
	  <?php
      
		  //print_r($nationality_list);
		foreach($city as $item)
		{
		  $select='';
		  if($form_data['emp_contact_temp_city']==$item['city_id'])
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$item['city_id'].'" '.$select.'>'.$item['city_name'].'</option>';
		}
      
      
      ?>
                                                   </select>
                                            </div>
                                        
                                        
                                        
                                       
                                       
                                        <div class="form-group col-md-4">
                                           <label for="emp_contact_temp_pincode">Pin Code *</label>
                                             <input type="text" class="form-control" name="emp_contact_temp_pincode" id="emp_contact_temp_pincode" value="<?php echo  $form_data['emp_contact_temp_pincode'] ?>">
                                        </div>                                           
                                        <div class="clearfix"></div>
                                        <!-- Temporary Address Bar Ends-->
                                        <!-- Permanent Address Bar Starts-->
                                        <hr>
                                        <div class="form-group col-md-4">
                                        	<label for="emp_contact_curr_perma_address">Same as Current Address </label>
                                           
                                            <input type="checkbox" name="emp_contact_curr_perma_address" id="emp_contact_curr_perma_address" <?php if($form_data['emp_contact_curr_perma_address']==1){ echo 'checked="checked"';}?>  value="1" class="form-control" style="height:15px;"/>
                                            
                                            
                                        </div>
                                        <div class="clearfix"></div>
                                        <div id="permanent_address">
                                            <div class="box-header">
                                              <h4 class="box-title">Permanent Address</h4>
                                             </div>  
                                             <div class="form-group col-md-4 warning">
                                                <label for="emp_contact_perma_street1">Address Line1</label>
                                                <input type="text" class="form-control" name="emp_contact_perma_street1" id="emp_contact_perma_street1" <?php if($form_data['emp_contact_curr_perma_address']==1){ echo "disabled";}?> value="<?php echo  $form_data['emp_contact_perma_street1'] ?>">
                                             </div>
                                            <div class="form-group col-md-4">
                                               <label for="emp_contact_perma_street2">Address Line2</label>
                                                 <input type="text" class="form-control" name="emp_contact_perma_street2" id="emp_contact_perma_street2" <?php if($form_data['emp_contact_curr_perma_address']==1){ echo "disabled";}?> value="<?php echo  $form_data['emp_contact_perma_street2'] ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                            <label for="emp_contact_perma_country">Country</label>
                                            
                                            
                                             <select class="form-control select" <?php if($form_data['emp_contact_curr_perma_address']==1){ echo "disabled";}?> name="emp_contact_perma_country" id="emp_contact_perma_country">
                                                  
                                                  <option value="">-Please Select a Country-</option>
	  <?php
      
		  //print_r($nationality_list);
		foreach($nationality_list as $country)
		{
		  $select='';
		  if($form_data['emp_contact_perma_country']==$country->country_id)
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$country->country_id.'" '.$select.'>'.$country->country_name.'</option>';
		}
      
      
      ?>
                                                   </select>
                                                   
                                                   
                                                   
                                         
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-4">
                                            <label for="emp_contact_perma_provience">Province</label>
                                            <select class="form-control select" <?php if($form_data['emp_contact_curr_perma_address']==1){ echo "disabled";}?> name="emp_contact_perma_provience" id="emp_contact_perma_provience">
                                                  
                                                  <option value="">-Please Select a Province-</option>
	  <?php
      
		  //print_r($nationality_list);
		foreach($state as $item)
		{
		  $select='';
		  if($form_data['emp_contact_perma_provience']==$item['state_id'])
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$item['state_id'].'" '.$select.'>'.$item['state_name'].'</option>';
		}
      
      
      ?>
                                                   </select>
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label for="emp_contact_perma_city">City</label>
                                            <select class="form-control select" <?php if($form_data['emp_contact_curr_perma_address']==1){ echo "disabled";}?> name="emp_contact_perma_city" id="emp_contact_perma_city">
                                                  
                                                  <option value="">-Please Select a City-</option>
	  <?php
      
		  //print_r($nationality_list);
		foreach($city as $item)
		{
		  $select='';
		  if($form_data['emp_contact_perma_city']==$item['city_id'])
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$item['city_id'].'" '.$select.'>'.$item['city_name'].'</option>';
		}
      
      
      ?>
                                                   </select>
                                            </div>
                                            
                                            
                                            
                                           
                                            <div class="form-group col-md-4">
                                               <label for="emp_contact_perma_pincode">Pin Code</label>
                                                 <input type="text" class="form-control" name="emp_contact_perma_pincode" id="emp_contact_perma_pincode"  <?php if($form_data['emp_contact_curr_perma_address']==1){ echo "disabled";}?> value="<?php echo  $form_data['emp_contact_perma_pincode'] ?>">
                                            </div>                                           
                                            <div class="clearfix"></div>
                                        </div>
                                        <!-- Permanent Address Bar Ends-->
                                        <!-- Other Address Bar Starts-->
                                        <hr>
                                        <div class="box-header">
                                          <h4 class="box-title">Other Address</h4>
                                         </div>  
                                         <div class="form-group col-md-4 warning">
                                            <label for="emp_contact_other_street1">Address Line1</label>
                                            <input type="text" class="form-control" name="emp_contact_other_street1" id="emp_contact_other_street1" value="<?php echo  $form_data['emp_contact_other_street1'] ?>">
                                         </div>
                                        <div class="form-group col-md-4">
                                           <label for="emp_contact_other_street2">Address Line2</label>
                                             <input type="text" class="form-control" name="emp_contact_other_street2" id="emp_contact_other_street2" value="<?php echo  $form_data['emp_contact_other_street2'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="emp_contact_other_country">Country</label>
                                            
                                            
                                             <select class="form-control select" name="emp_contact_other_country" id="emp_contact_other_country">
                                                  
                                                  <option value="">-Please Select a Country-</option>
	  <?php
      
		  //print_r($nationality_list);
		foreach($nationality_list as $country)
		{
		  $select='';
		  if($form_data['emp_contact_other_country']==$country->country_id)
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$country->country_id.'" '.$select.'>'.$country->country_name.'</option>';
		}
      
      
      ?>
                                                   </select>
                                                   
                                                   
                                                   
                                         
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-4">
                                            <label for="emp_contact_other_provience">Province</label>
                                            <select class="form-control select" name="emp_contact_other_provience" id="emp_contact_other_provience">
                                                  
                                                  <option value="">-Please Select a Province-</option>
	  <?php
      
		  //print_r($nationality_list);
		foreach($state as $item)
		{
		  $select='';
		  if($form_data['emp_contact_other_provience']==$item['state_id'])
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$item['state_id'].'" '.$select.'>'.$item['state_name'].'</option>';
		}
      
      
      ?>
                                                   </select>
                                            
                                        </div>
                                        
                                        <div class="form-group col-md-4">
                                            <label for="emp_contact_other_city">City</label>
                                            <select class="form-control select" name="emp_contact_other_city" id="emp_contact_other_city">
                                                  
                                                  <option value="">-Please Select a City-</option>
	  <?php
      
		  //print_r($nationality_list);
		foreach($city as $item)
		{
		  $select='';
		  if($form_data['emp_contact_other_city']==$item['city_id'])
		  {
		  $select='selected="selected"';
		  }
		  echo '<option value="'.$item['city_id'].'" '.$select.'>'.$item['city_name'].'</option>';
		}
      
      
      ?>
                                                   </select>
                                            </div>
                                        
                                        
                                       
                                        <div class="form-group col-md-4">
                                           <label for="emp_contact_other_pincode">Pin Code</label>
                                             <input type="text" class="form-control" name="emp_contact_other_pincode" id="emp_contact_other_pincode" value="<?php echo  $form_data['emp_contact_other_pincode'] ?>">
                                        </div>                                           
                                        <div class="clearfix"></div>
                                        <!-- Other Address Bar Ends-->
                                    </div><!-- /.box-body -->
									<div class="clearfix"></div>
                                    <div class="box-footer text-center">
                                       <a href="<?php echo  site_path."add_employee/index/".$employee_id?>" class="btn btn-warning">Back</a> <button type="submit" name="submit" class="btn btn-primary text-center">Submit</button>
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
			<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
			 
           <script>
           	var city=<?php echo json_encode($city); ?>;
           	var state=<?php echo json_encode($state); ?>;
           	function state_list(country_id)
           	{
           	
           		var txt='<option value="">Select</option>';
           		$.each(state,function(key,value)
           		{
           			
           			
					if(value.country_id==country_id)
					{
						
						txt+="<option value="+value.state_id+">"+value.state_name+"</option>";
					}
					
				});
				return txt;	
			}
			function city_list(state_id)
			{
				
				var txt='<option value="">Select</option>';
				$.each(city,function(key,value)
           		{
           			
           			
           			if(value.state_id==state_id)
					{
						txt+="<option value="+value.city_id+">"+value.city_name+"</option>";
						
					}
					
					
				});
				
				 return txt;
			}
			
             $(document).ready(function(){
             	$('.select').select2();
             	
             	
             	$("#emp_contact_other_country").on("change", function (e) { 
             	 $("#emp_contact_other_provience").select2("destroy");
             	 $("#emp_contact_other_city").select2("val", ""); 
             	 $('#emp_contact_other_provience').html( state_list($('#emp_contact_other_country').val()));
             	 $('#emp_contact_other_provience').select2();
             	  });
             	
             	
             	$("#emp_contact_other_provience").on("change", function (e) { 
             	$("#emp_contact_other_city").select2("destroy");
             	 $('#emp_contact_other_city').html( city_list($('#emp_contact_other_provience').val()));
             	 $('#emp_contact_other_city').select2();
             	 });
             	 
             	 
             	 $("#emp_contact_perma_country").on("change", function (e) { 
             	 $("#emp_contact_perma_provience").select2("destroy");
             	 $("#emp_contact_perma_city").select2("val", ""); 
             	 $('#emp_contact_perma_provience').html( state_list($('#emp_contact_perma_country').val()));
             	 $('#emp_contact_perma_provience').select2();
             	  });
             	
             	
             	$("#emp_contact_perma_provience").on("change", function (e) { 
             	$("#emp_contact_perma_city").select2("destroy");
             	 $('#emp_contact_perma_city').html( city_list($('#emp_contact_perma_provience').val()));
             	 $('#emp_contact_perma_city').select2();
             	 });
             	 
             	 
             	 
             	 $("#emp_contact_temp_country").on("change", function (e) { 
             	 $("#emp_contact_temp_provience").select2("destroy");
             	 $("#emp_contact_temp_city").select2("val", ""); 
             	 $('#emp_contact_temp_provience').html( state_list($('#emp_contact_temp_country').val()));
             	 $('#emp_contact_temp_provience').select2();
             	  });
             	
             	
             	$("#emp_contact_temp_provience").on("change", function (e) { 
             	$("#emp_contact_temp_city").select2("destroy");
             	 $('#emp_contact_temp_city').html( city_list($('#emp_contact_temp_provience').val()));
             	 $('#emp_contact_temp_city').select2();
             	 });
             	
             	$( "#frm" ).on( "submit", function( event ) {
				var x=0;
				$('#loader').show();
				var err='';
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>validation/step2",
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
				$('#emp_contact_curr_perma_address').change(function(){
					if($("#emp_contact_curr_perma_address").prop('checked'))
					{
						$("#permanent_address :input").attr("disabled", true);
						
					}
					else
					{
						$("#permanent_address :input").attr("disabled", false);
						
					}
					
					});

			});
			</script>