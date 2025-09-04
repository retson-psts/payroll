<div id="loader"></div>
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
                      GIRO SETUP
                        
            <small>GIRO Setup</small>
        </h1>
      <ol class="breadcrumb">
         <li>
            <a href="#"> <i class="fa fa-dashboard"></i> Home </a>
         </li>
         <li> <a href="#">Settings</a> </li>
         <li class="active">GIRO SETUP</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <form action="" method="POST" id="frm" enctype="multipart/form-data">
            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>" />
            
            <div class="">
               <div class="modal-body">
                  <div id="error"></div>
                  <div class="form-group col-md-4">
                     <label for="giro_setup_bank">Bank Name</label>
                     <select class="form-control" name="giro_setup_bank">
                     <option value="">Select Bank</option>
                     <?php if(!empty($bank_list))
                     {
                     	foreach($bank_list as $item)
                     	{
							?>
							<option value="<?php echo $item['bank_list_id'] ?>"><?php echo $item['bank_name'] ?></option>
							<?php
						}
                     	} ?>
                     	</select>
                      </div>
                      <div class="col-md-8">
                      	
                      </div>
                     <div class="clearfix"></div>
                  <div class="form-group col-md-4">
                     <label for="giro_setup_valuedate">Value Date</label>
                     <input type="text"  class="form-control" name="giro_setup_valuedate" id="giro_setup_valuedate" value="">
                  </div>
                  <div class="col-md-8">
                      	<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Cannot Sunday or public holiday
</div>
                      </div>
                     <div class="clearfix"></div>
                 
                  <div class="form-group col-md-4">
                     <label for="giro_setup_branch_code">Branch Branch Code</label>
                     <input type="text"  class="form-control" name="giro_setup_branch_code" id="giro_setup_branch_code" value="">
                  </div>
                  <div class="col-md-8">
                      	
                      </div>


                     <div class="clearfix"></div>
                 
                   <div class="form-group col-md-4">
                     <label for="ir8a_authorised_roc">Bank Acc No</label>
                     <input type="text"  class="form-control" name="giro_setup_account" id="giro_setup_account" value="">
                  </div>
                  <div class="col-md-8">
                      	
                      </div>

                     <div class="clearfix"></div>
                     <div class="form-group col-md-4">
                     <label for="ir8a_authorised_roc">Bank Acc Name</label>
                     <input type="text"  class="form-control" name="giro_setup_account_name" id="giro_setup_account_name" value="">
                  </div>  
                  <div class="col-md-8">
                      	
                      </div>
                     <div class="clearfix"></div>
                   <div class="form-group col-md-4">
                     <label for="giro_setup_company_code">Company Code Provided by bank</label>
                     <input type="text"  class="form-control" name="giro_setup_company_code" id="giro_setup_company_code" value="">
                  </div>  
                  <div class="col-md-8">
                      	<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Applicable for DBS Bank only
</div>
                      </div>
                     <div class="clearfix"></div>
                   <div class="form-group col-md-4">
                     <label for="giro_setup_approver_code">Approver Provided by bank</label>
                     <input type="text"  class="form-control" name="giro_setup_approver_code" id="giro_setup_approver_code" value="">
                  </div>  
                  <div class="col-md-8">
                      	<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Applicable for Mizuho Bank only
                      </div>
                      </div>
                     <div class="clearfix"></div>
                   <div class="form-group col-md-4">
                     <label for="giro_setup_operator_code">Opertaor Code Provided by bank</label>
                     <input type="text"  class="form-control" name="giro_setup_operator_code" id="giro_setup_operator_code" value="">
                  </div>  
                  <div class="col-md-8">
                      	<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Applicable for Mizuho Bank only
</div>
                      </div>
                     <div class="clearfix"></div>
                  <div class="clearfix"></div>
               </div>
               <div class="modal-footer">
                  <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Add GIRO setup</button>
               </div>
            </div>
         </form>
         <!-- /.box -->
      </div>
      <div class="list_results box">
                                  	  <div class="added_data">
                                      <div class="box-header">
                                             <h3 class="box-title">GIRO SETUPS</h3>
                                         </div><!-- /.box-header -->
                                         <?php
										 if($contents!=false)
									     {
										 ?>
                                          <div class="box-body table-responsive">
                                          <table id="example1" class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                  	<th>Sno</th>
                                                      <th>Bank</th>
                                                      <th>Value Date</th>
                                                      <th>Branch</th>
                                                      <th>Account No</th>
                                                      <th>Account Name</th>
                                                      <th>Company Code</th>
                                                      <th>Approver Code</th>
                                                      <th>Operator Code</th>
                                                      <th>Options</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              
                                              <?php
                                              $sno=0;
											  foreach($contents as $item)
											  {
											  	$sno++;
												  $name='<a href="javascript:void(0);" onclick="enable_edit(\''.$item['giro_setup_id'].'\',\''.$item['giro_setup_bank'].'\',\''.$item['giro_setup_valuedate'].'\',\''.$item['giro_setup_branch_code'].'\',\''.$item['giro_setup_account'].'\',\''.$item['giro_setup_account_name'].'\',\''.$item['giro_setup_company_code'].'\',\''.$item['giro_setup_approver_code'].'\',\''.$item['giro_setup_operator_code'].'\'); return false;" id="rel_'.$item['giro_setup_id'].'">'.$item['bank_name'].'</a>';
												  $remove='<a href="javascrip:void(0);" onclick="remove_data('.$item['giro_setup_id'].')" class="btn btn-danger">Remove</a>';
												  echo '<tr id="eec_'.$item['giro_setup_id'].'"><td>'.$sno.'</td><td>'.$name.'</td><td>'.$item['giro_setup_valuedate'].'</td><td>'.$item['giro_setup_branch_code'].'</td><td>'.$item['giro_setup_account'].'</td><td>'.$item['giro_setup_account_name'].'</td><td>'.$item['giro_setup_company_code'].'</td><td>'.$item['giro_setup_approver_code'].'</td><td>'.$item['giro_setup_operator_code'].'</td><td>'.$remove.'</td></tr>';
											  }
											  ?>
                                              </tbody>
                                               
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
                              </div>
   </section>
   <!-- /.content -->
</aside>

<!-- /.right-side -->
<!-- Modal -->
<div id="myModal" class="modal  modal1 fade" role="dialog">
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

<div id="editModal" class="modal  fade bs-example-modal-lg" role="dialog">
  				<div class="modal-dialog modal-lg">
 <form role="form"  action="#" method="post" enctype="multipart/form-data" id="form_edit">
    				<!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit GIRO Setup</h4>
      </div>
				      <div class="modal-body">
				       
                                    <div id="error_edit"></div>
                                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>" />
                                     <input  type="hidden" name="id" id="id" value=""/>
                                        <div id="add_form" >
                                      <div class="box-body">
                                        <div class="form-group col-md-6">
                     <label for="giro_setup_bank">Bank Name</label>
                     <select class="form-control" name="giro_setup_bank">
                     <option value="">Select Bank</option>
                     <?php if(!empty($bank_list))
                     {
                     	foreach($bank_list as $item)
                     	{
							?>
							<option value="<?php echo $item['bank_list_id'] ?>"><?php echo $item['bank_name'] ?></option>
							<?php
						}
                     	} ?>
                     	</select>
                      </div>
                      <div class="col-md-6">
                      	
                      </div>
                     <div class="clearfix"></div>
                  <div class="form-group col-md-6">
                     <label for="giro_setup_valuedate">Value Date</label>
                     <input type="text"  class="form-control" name="giro_setup_valuedate" id="giro_setup_valuedate" value="">
                  </div>
                  <div class="col-md-6">
                      	<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Cannot Sunday or public holiday
</div>
                      </div>
                     <div class="clearfix"></div>
                 
                  <div class="form-group col-md-6">
                     <label for="giro_setup_branch_code">Branch Branch Code</label>
                     <input type="text"  class="form-control" name="giro_setup_branch_code" id="giro_setup_branch_code" value="">
                  </div>
                  <div class="col-md-6">
                      	
                      </div>


                     <div class="clearfix"></div>
                 
                   <div class="form-group col-md-6">
                     <label for="ir8a_authorised_roc">Bank Acc No</label>
                     <input type="text"  class="form-control" name="giro_setup_account" id="giro_setup_account" value="">
                  </div>
                  <div class="col-md-6">
                      	
                      </div>

                     <div class="clearfix"></div>
                     <div class="form-group col-md-6">
                     <label for="ir8a_authorised_roc">Bank Acc Name</label>
                     <input type="text"  class="form-control" name="giro_setup_account_name" id="giro_setup_account_name" value="">
                  </div>  
                  <div class="col-md-6">
                      	
                      </div>
                     <div class="clearfix"></div>
                   <div class="form-group col-md-6">
                     <label for="giro_setup_company_code">Company Code Provided by bank</label>
                     <input type="text"  class="form-control" name="giro_setup_company_code" id="giro_setup_company_code" value="">
                  </div>  
                  <div class="col-md-6">
                      	<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Applicable for DBS Bank only
</div>
                      </div>
                     <div class="clearfix"></div>
                   <div class="form-group col-md-6">
                     <label for="giro_setup_approver_code">Approver Provided by bank</label>
                     <input type="text"  class="form-control" name="giro_setup_approver_code" id="giro_setup_approver_code" value="">
                  </div>  
                  <div class="col-md-6">
                      	<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Applicable for Mizuho Bank only
                      </div>
                      </div>
                     <div class="clearfix"></div>
                   <div class="form-group col-md-6">
                     <label for="giro_setup_operator_code">Opertaor Code Provided by bank</label>
                     <input type="text"  class="form-control" name="giro_setup_operator_code" id="giro_setup_operator_code" value="">
                  </div>  
                  <div class="col-md-6">
                      	<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   Applicable for Mizuho Bank only
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
         		function remove_data(id)
	        	{
	        		$('#loader').show();
	        		
	        		 $.ajax({
					type: "GET",
					url: "<?php echo site_path; ?>company/remove_giro/"+id,
					dataType: "json",
					success: function(html){
					if(html.status==0)
					{
						//event.preventDefault();
						alert('Removing giro Failed');	
										 
	           			 
						
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
				//enable_edit(\''.$item['giro_setup_id'].'\',\''.$item['giro_setup_bank'].'\',\''.$item['giro_setup_valuedate'].'\',\''.$item['giro_setup_branch_code'].'\',\''.$item['giro_setup_account'].'\',\''.$item['giro_setup_account_name'].'\',\''.$item['giro_setup_company_code'].'\',\''.$item['giro_setup_approver_code'].'\',\''.$item['giro_setup_operator_code'].'\');
         		function enable_edit(id,bank,valueDate,branch,account,name,companyCode,approver,operator)
            	{
					$("#form_edit [name='giro_setup_bank']").val(bank);
					$("#form_edit [name='giro_setup_valuedate']").val(valueDate);
					$("#form_edit [name='giro_setup_branch_code']").val(branch);
					$("#form_edit [name='giro_setup_account']").val(account);
					$("#form_edit [name='giro_setup_account_name']").val(name);
					$("#form_edit [name='giro_setup_operator_code']").val(operator);
					$("#form_edit [name='giro_setup_approver_code']").val(approver);
					$("#form_edit [name='giro_setup_company_code']").val(companyCode);
					$("#form_edit [name='id']").val(id);
					
					$('#editModal').modal('show');
					
				
				}
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable();
            });
            
        </script>
<script type="text/javascript">
   $( "#frm" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>company/giro_add",
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
    						location.reload();
						});
				}
				
				},
				complete: function (data) {
					if(data.status!=1)
					{
						$('#loader').hide();		
					}
     			
     				},
     			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
				
			});
			
			return false;
  			
  			
  
});
	
	
   $( "#form_edit" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>company/giro_edit",
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
						$('#result').html('GIRO Settings updated success fully');
						$('#editModal').modal('hide');
						$('#myModal').modal('show');
						$("#form_edit .form_control").val('');
						$('#myModal').on('hidden.bs.modal', function () {
    						location.reload();
						});
				}
				
				},
				complete: function (data) {
					if(data.status!=1)
					{
					 $('#loader').hide();	
					}
     			
     				},
     			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
				
			});
			
			return false;
  			
  			
  
});		
</script>