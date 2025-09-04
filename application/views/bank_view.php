<div id="loader"></div>
           <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Bank Detail
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
                                	<div class="col-sm-9 border" style="margin: 0 auto; float: none;">
                                		<h4><?php echo $bank_details['0']['bank_name']; ?><a  href="#"  data-toggle="modal" data-target="#myModal">
  <i class="ion ion-edit"></i>
</a></h4>
                                		<hr style="margin:0;border-width: 1px 0px 0px;border-style: solid none none;border-color: #535353 -moz-use-text-color ">
                                		
                                		<h5>Bank Details </h5>
                                		<p>
                                			Name - <?php echo $bank_details['0']['bank_name'] ?>,<br>
                                			Branch Name - <?php echo $bank_details['0']['bank_branch_name'] ?>,<br>
                                			Address - <?php echo $bank_details['0']['bank_branch_address'] ?>,<br>
                                			City - <?php echo $bank_details['0']['bank_city'] ?>
                                			
                                			
                                		</p>
                                		<h5>Account Info</h5>
                                		<p>
                                			Account Holder Name - <?php echo $bank_details['0']['bank_acc_holder_name'] ?><br>
                                			Branch IFSC Code - <?php echo $bank_details['0']['bank_ifsc'] ?>,<br>
                                			Account Type - <?php echo $bank_details['0']['bank_acc_type'] ?>
                                			
                                			
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
  <form action="" method="POST" id="bank_details" enctype="multipart/form-data">
   <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
   
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Bank</h4>
      </div>
      <div class="modal-body">
      <div id="error"></div>
        <div class="form-group col-md-12">
                                       <label for="bank_name">Bank Name *</label>
                                       <input type="text" required class="form-control" name="bank_name" id="bank_name" value="<?php echo $bank_details['0']['bank_name'] ?>">
                                        </div>
                                       <div class="clearfix"></div>
                                        <div class="form-group col-md-4">
                                            <label for="bank_branch_name">Bank Branch Name *</label>
                                            <input type="text" class="form-control" name="bank_branch_name" id="bank_branch_name" required value="<?php echo $bank_details['0']['bank_branch_name'] ?>">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label for="bank_branch_address">Bank Address </label>
                                            <textarea class="form-control" name="bank_branch_address" id="bank_branch_address"><?php echo $bank_details['0']['bank_branch_address'] ?></textarea>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="bank_city">City</label>
                                            <input type="text" class="form-control" name="bank_city" id="bank_city" value="<?php echo $bank_details['0']['bank_city'] ?>">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label for="bank_acc_no">Account Number *</label>
                                            <input type="text" class="form-control" name="bank_acc_no" id="bank_acc_no" required value="<?php echo $bank_details['0']['bank_acc_no'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="bank_acc_holder_name">Account Holder Name *</label>
                                            <input type="text" class="form-control" name="bank_acc_holder_name" id="bank_acc_holder_name" required value="<?php echo $bank_details['0']['bank_acc_holder_name'] ?>">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-6">
                                            <label for="bank_ifsc">Bank IFSC Code *</label>
                                            <input type="text" class="form-control" name="bank_ifsc" id="bank_ifsc" required value="<?php echo $bank_details['0']['bank_branch_name'] ?>">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="bank_acc_type">Accout Type *</label>
                                            <select class="form-control" name="bank_acc_type" id="bank_acc_type">
                                            <option <?php if($bank_details['0']['bank_branch_name']=='Current') ?>>Current</option>
                                            <option <?php if($bank_details['0']['bank_branch_name']=='Salary') ?>>Salary</option>
                                            <option <?php if($bank_details['0']['bank_branch_name']=='Savings') ?>>Savings</option>
                                            </select>
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
	//$('input[type=file]').on('change', prepareUpload);
	$('#bank_details').on('submit', submitForm);

	// Grab the files and set them to our variable
	function submitForm(event, data)
	{
		event.stopPropagation(); // Stop stuff happening
        event.preventDefault();
		// Create a jQuery object from the form
		$form = $(event.target);
		
		// Serialize the form data
		var formData = $form.serialize();
		
		// You should sterilise the file names
		/*$.each(data.files, function(key, value)
		{
			formData = formData + '&filenames[]=' + value;
		});*/

		$.ajax({
			url: '<?php echo site_path; ?>bank/update_bank',
            type: 'POST',
            data: formData,
           // cache: false,
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
						alert('Bank Details updated successfuly');
						
						//alert($('#check_'+id).val());
						/*$( "#absent .form-control" ).val('');*/
						$("#error").html("");
						location.reload();
						
						
					}
					else
					{
						alert('Not Updated. Please Try Again');
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
			</script>