			 <div id="loader"></div>
			   <aside class="right-side">   
			 <!-- Right side column. Contains the navbar and content of the page -->
          <section class="content-header">
                    <h1>
                       Job Title
                        <small>Job Title</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i> Job</a></li>
                        <li class="active">Job Title</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
               
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-warning">
                                <div class="box-header">
                                 
								  <h3 class="box-title">Add Job Title</h3>                                    
                                </div><!-- /.box-header -->
                                <form id="form_add" action="<?php echo  site_path?>job_category/update_cat" method="post">
                                      <div class="box-body">
                                         <div class="add_form" >
                                         <div id="error_add"></div>
                                            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                           
                                            <div class="form-group col-md-4">
                                                <label for="job_title_name">Job Title Name *</label>
                                                <input type="text" class="form-control" name="job_title_name" id="job_title_name" placeholder="Job Title Name">
                                            </div>
                                            <div class="form-group col-md-4">
                                            <label for="employement_status">Job Category</label>
                                             <select class="form-control" name="job_title_category" id="job_title_category">
                                                  <?php
												  if($cat_job_list!=false)
												  {
												  	 echo '<option>Please Select Category</option>';
													  foreach($cat_job_list as $cat)
													  {
														  echo '<option value="'.$cat->job_category_id.'">'.$cat->job_category_name.'</option>';
													  }
												  }
												  else
												  {
													  echo '<option>Please Add A Category</option>';
												  }
												  ?>
                                              </select>
                                           </div>
                                            <div class="clearfix"></div>
                                         </div>
                                      </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <div class="clearfix"></div>
                                        <div class="cat_save">
                                        	<button type="submit" name="submit" class="btn btn-primary text-center" id="save">Save Category</button>
                                            <button type="reset" name="submit" class="btn btn-danger text-center" id="cancel">Cancel</button>
                                        </div>
                                    </div>
                               </form>
                               </div>
								
                             
                             <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Job Title List</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Job Name</th>
                                                <th>Category Name</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											if($job_title_list!=false)
											{
												$i=1;
												foreach($job_title_list as $job_title)
												{
													echo '<tr><td>'.$i.'</td><td>'.$job_title->job_title_name.'</td><td>'.$job_title->job_category_name.'</td>';
													   echo '<td><a href="#" onclick="enable_edit('.$job_title->job_title_id.',\''.$job_title->job_title_name.'\','.$job_title->job_category_id.');" ><span class="label label-primary"><i class="fa fa-edit"> </i> View / Edit</span></a>  <a href="#" onclick="delete_my(this,'.$job_title->job_title_id.');" ><span class="label label-warning"><i class="fa fa-trash-o"> </i> Delete</a></span></td></tr>';
													$i++;
												}
											}
										?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Job Name</th>
                                                <th>Category Name</th>
                                                <th>Options</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
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
                                    <div id="add_form" >
                                      <div class="box-body">
                                            <div class="form-group col-md-6">
                                                <label for="job_title_name">Job Title Name *</label>
                                                <input type="text" class="form-control" name="job_title_name" id="job_title_name" placeholder="Job Title Name">
                                            </div>
                                            <div class="form-group col-md-6">
                                            <label for="employement_status">Job Category</label>
                                             <select class="form-control" name="job_title_category" id="job_title_category">
                                                  <?php
												  if($cat_job_list!=false)
												  {
												  	 echo '<option>Please Select Category</option>';
													  foreach($cat_job_list as $cat)
													  {
														  echo '<option value="'.$cat->job_category_id.'">'.$cat->job_category_name.'</option>';
													  }
												  }
												  else
												  {
													  echo '<option>Please Add A Category</option>';
												  }
												  ?>
                                              </select>
                                           </div>
                                            <div class="clearfix"></div>
                                         
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
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
            function enable_edit(id,name,login)
        	{
				$("#form_edit [name='job_title_name']").val(name);
				$("#form_edit [name='id']").val(id);
				$("#form_edit [name='job_title_category']").val(login);
				$('#editModal').modal('show');
				
			
			}
			function delete_my(e,id)
        	{
        	
        		$('#loader').show();
        		 $.ajax({
				type: "GET",
				url: "<?php echo site_path; ?>job_titles/remove/"+id,
				dataType: "json",
				success: function(html){
				if(html.status==0)
				{
					//event.preventDefault();
						
					$('#result').html(html.message);
						$('#myModal').modal('show');
						$('#myModal').on('hidden.bs.modal', function () {
    						
						});				 
           			 
					
				}
				else
				{
						$(e).parent().parent().remove();
						$('#result').html(html.message);
						$('#myModal').modal('show');
						$('#myModal').on('hidden.bs.modal', function () {
    						location.reload();
						});
				}
				
				},
				complete: function (data) {
     			$('#loader').hide();
     				},
     			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
				
			});
				
			}
			</script>
			<script>
				$(document).ready(function(){
			$('#editModal').on('hidden.bs.modal', function () {		 
				$("#form_edit [name='job_title_name']").val('');
				$("#form_edit [name='id']").val('');
				$("#form_edit [name='job_title_category']").val('');
			});
					
					
				$( "#form_add" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>job_titles/add",
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
				$( "#form_edit" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>job_titles/edit",
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
						$('#result').html(html.message);
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