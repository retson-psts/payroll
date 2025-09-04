             <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                         Employee Details
                        <small>Bank details</small>
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
                                    <div id="form1" class="tab-pane active add_panel">
                                    
                                <form id="frm" role="form" action="<?php echo  site_path.'add_employee_process/employee_contact/'.$employee_id?>" method="post">
                                 <div id="error"><?php echo  $message_div ?></div>
                                <input type="hidden" name="employee_id" value="<?php echo  $form_data['employee_id']?>" id="employee_id"/>
                                <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                    <div class="box-body" >
                                        <div class="box-header">
                                          <h4 class="box-title">Employee's Bank Details (Step 12)</h4>
                                         </div>  
                                        
                                         <div class="form-group col-md-4">
                                            <label for="employee_bank_name">Bank Name *</label>
                                            <input type="text" class="form-control" name="employee_bank_name" id="employee_bank_name" value="<?php echo  $form_data['employee_bank_name'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="employee_bank_branch">Bank Branch *</label>
                                            <input type="text" class="form-control" name="employee_bank_branch" id="employee_bank_branch" value="<?php echo  $form_data['employee_bank_branch'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="employee_bank_city">City</label>
                                            <input type="text" class="form-control" name="employee_bank_city" id="employee_bank_city" value="<?php echo  $form_data['employee_bank_city'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="employee_bank_acc">Account Number</label>
                                            <input type="text" class="form-control" name="employee_bank_acc" id="employee_bank_acc" value="<?php echo  $form_data['employee_bank_acc'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="employee_bank_ifsc">IFSC Code</label>
                                            <input type="text" class="form-control" name="employee_bank_ifsc" id="employee_bank_ifsc" value="<?php echo  $form_data['employee_bank_ifsc'] ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="employee_bank_code">Other Code</label>
                                            <input type="text" class="form-control" name="employee_bank_code" id="employee_bank_code" value="<?php echo  $form_data['employee_bank_code'] ?>">
                                        </div>
                                        <!-- Current Address Bar Starts-->
                                        <hr>
                                                                                
                                        <div class="clearfix"></div>
                                        <!-- Other Address Bar Ends-->
                                    </div><!-- /.box-body -->
									<div class="clearfix"></div>
                                    <div class="box-footer text-center">
                                       <button type="submit" name="submit" class="btn btn-primary text-center">Finish</button>
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
            $( "#frm" ).on( "submit", function( event ) {
				var x=0;
				var err='';
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>validation/step12",
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
    						window.location=html.url;
						});
				}
				
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