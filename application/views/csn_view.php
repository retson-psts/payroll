<div id="loader"></div>
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
                     CSN Setup
                        
            <small>CSN Setup</small>
        </h1>
      <ol class="breadcrumb">
         <li>
            <a href="#"> <i class="fa fa-dashboard"></i> Home </a>
         </li>
         <li> <a href="#">Settings</a> </li>
         <li class="active">CSN Setup</li>
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
                  	<div class="form-group ">
                 	<label class="left11">CSN </label>
                     <input type="text"  class="form-control left1 " name="csn_roc" id="csn_roc" value=""><span class="spe"> - </span>
                     <input type="text"  class="form-control left2" name="csn_type" id="csn_type" value=""><span class="spe"> - </span>
                     <input type="text"  class="form-control left3" name="csn_sno" id="csn_sno" value="">
                  </div>
                  
                  
                     <div class="clearfix"></div>
                  <div class="clearfix"></div>
               </div>
               <div class="modal-footer">
                  <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Add CSN</button>
               </div>
            </div>
         </form>
         <!-- /.box -->
      </div>
      <div class="list_results box">
                                  	  <div class="added_data">
                                      <div class="box-header">
                                             <h3 class="box-title">CSN Lists</h3>
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
                                                      <th>CSN</th>
                                                      <th>Options</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              
                                              <?php
                                              $sno=0;
											  foreach($contents as $item)
											  {
											  	$sno++;
												  $name='<a href="javascript:void(0);" onclick="enable_edit(\''.$item['csn_id'].'\',\''.$item['csn_roc'].'\',\''.$item['csn_type'].'\',\''.$item['csn_sno'].'\'); return false;" id="rel_'.$item['csn_id'].'">'.$item['csn_roc'].' - '.$item['csn_type'].' - '.$item['csn_sno'].'</a>';
												  $remove='<a href="javascrip:void(0);" onclick="remove_data('.$item['csn_id'].')" class="btn btn-danger">Remove</a>';
												  echo '<tr id="eec_'.$item['csn_id'].'"><td>'.$sno.'</td><td>'.$name.'</td><td>'.$remove.'</td></tr>';
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
        <h4 class="modal-title">Edit CSN Setup</h4>
      </div>
				      <div class="modal-body">
				       
                                    <div id="error_edit"></div>
                                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>" />
                                     <input  type="hidden" name="id" id="id" value=""/>
                                        <div id="add_form" >
                                      <div class="box-body">
                                        <div class="form-group ">
                 	<label class="left11">CSN </label>
                     <input type="text"  class="form-control left1 " name="csn_roc" id="csn_roc" value=""><span class="spe"> - </span>
                     <input type="text"  class="form-control left2" name="csn_type" id="csn_type" value=""><span class="spe"> - </span>
                     <input type="text"  class="form-control left3" name="csn_sno" id="csn_sno" value="">
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
					url: "<?php echo site_path; ?>company/csn_remove/"+id,
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
         		function enable_edit(id,roc,type,sno)
            	{
					$("#form_edit [name='csn_roc']").val(roc);
					$("#form_edit [name='csn_type']").val(type);
					$("#form_edit [name='csn_sno']").val(sno);
					
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
				url: "<?php echo site_path; ?>company/csn_add",
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
				url: "<?php echo site_path; ?>company/csn_edit",
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
						$('#result').html('CSN updated success fully');
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