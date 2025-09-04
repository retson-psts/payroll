<div id="loader"></div>
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
                      IR8A Information
                        
            <small>IR8A Settings</small>
        </h1>
      <ol class="breadcrumb">
         <li>
            <a href="#"> <i class="fa fa-dashboard"></i> Home </a>
         </li>
         <li> <a href="#">Settings</a> </li>
         <li class="active">IR8A setting</li>
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
                     <label for="ir8a_authorised_person">Authorised Person</label>
                     <input type="text" required class="form-control" name="ir8a_authorised_person" id="ir8a_authorised_person" value="<?php echo $contents['ir8a_authorised_person'] ?>"> </div>
                     
                  <div class="form-group col-md-4 pull-right">
                     <label for="ir8a_authorised_designation">Authorised Designation</label>
                     <input type="text" required class="form-control" name="ir8a_authorised_designation" id="ir8a_authorised_designation" value="<?php echo $contents['ir8a_authorised_designation'] ?>">
                  </div>
                  <div class="clearfix"></div>
                  <div class="form-group col-md-4">
                     <label for="ir8a_authorised_email">Authorised Email *</label>
                     <input type="text" required class="form-control" name="ir8a_authorised_email" id="ir8a_authorised_email" value="<?php echo $contents['ir8a_authorised_email'] ?>">
                  </div>
                  <div class="clearfix"></div>
                   <div class="form-group col-md-4">
                     <label for="ir8a_authorised_roc">Company ROC</label>
                     <input type="text" required class="form-control" name="ir8a_authorised_roc" id="ir8a_authorised_roc" value="<?php echo $contents['ir8a_authorised_roc'] ?>">
                  </div>   
                  <div class="form-group col-md-4 pull-right">
                     <label for="employer_lastname">Company Type</label>
                     <select class="form-control" name="ir8a_authorised_company_type">
                     	<option value="">Select Type</option>
                     	<option <?php if($contents['ir8a_authorised_company_type']==1) { echo 'selected="selected"'; } ?> value="1">UEN - Business Registration Number</option>
                     	<option <?php if($contents['ir8a_authorised_company_type']==2) { echo 'selected="selected"'; } ?> value="2">NRIC - </option>
                     	<option <?php if($contents['ir8a_authorised_company_type']==3) { echo 'selected="selected"'; } ?> value="3">FIN - Foreign Registration Number </option>
                     	
                     	
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
         <!-- /.box -->
      </div>
   </section>
   <!-- /.content -->
</aside>

<!-- /.right-side -->
<!-- Modal -->
<div id="myModal" class="modal modal1 fade" role="dialog">
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
<script type="text/javascript">
   $( "#frm" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>company/ir8a_add",
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
				
				},
				complete: function (data) {
					
						$('#loader').hide();		
					
     				},
     			error: function(jqXHR, textStatus, errorThrown) {$('#loader').hide(); alert('Please try again'); }
				
			});
			
			return false;
  			
  			
  
});
</script>