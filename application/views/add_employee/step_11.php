             <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add Employee
                        <small>Add new Employee</small>
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
                            	  
                                <div class="col-md-12 ">
                                	<?php
									echo $nav_steps;
									?>
                                  <!-- form start -->
                                    <div class="col-md-3">
                                    <div class="employee_photo">
                                    
                                    	<?php
                                    		
											if($employee_photo=='')
											{
												$photo='boy.png';
											}
											else
											{
												$photo=$employee_photo['0']->eattach_filename;
											}
										?>
                                        <img src="<?php echo  user_profile_photo_url.$photo?>" class="profile_img" id="employee_photo"/>
                                        <form  action="<?php echo  site_path?>add_employee_process/add_photo" enctype="multipart/form-data" method="post" id="change_photo">
                                        <input type="hidden" name="employee_id" id="employee_id" value="<?php echo  $employee_id ?>"/>
                                        	<div class="form-group">
                                             <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                        	  <input type="file" name="employee_photo" id="employee_photo" class="form-control"/>
                                        	  <p class="help-block">Size less than 1 MB and file must jpeg, png, gif format</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="box-footer text-center">
                                                <button type="submit" name="save" class="btn btn-primary text-center" id="update_photo" >Add Photo</button>
                                                 <?php if(!isset($edit))
                    			{ ?>
                     		 <a href="<?php echo site_path ?>edit_employee/employee_bank/<?php echo $employee_id; ?>" class="btn btn-info text-center">Next</a>
                       
                        <?php } else { ?>
                        
                        <a href="<?php echo site_path ?>employee_profile/<?php echo $employee_id; ?>" class="btn btn-info text-center">Finish</a>
                        <?php   } ?> 
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- form 1 ends -->
                             </div>
                            </div><!--.box Ends-->
                        </div><!--.col-md-12  Ends-->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            <script>
				/*$('#checkboxes .iCheck-helper').click(function(evt) {
				  var $this = $(this);
				  var element = $this.prev('input[type="checkbox"]');
				  var parent = $this.parents('.control');
				  if (element.length)
				  {
					alert('222');
				  }
				});*/
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
			</script>