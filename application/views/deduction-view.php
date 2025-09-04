<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<link href="<?php echo  css_path?>jQueryUI/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
<div id="loader"></div>
           <aside class="right-side  <?php if(isset($left_menu) && $left_menu==0){ echo "strech"; }?>">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Add Deduction To Employee
                        <small>Deduction Add</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i> Deduction</a></li>
                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <div id="error"></div>
                    <div class="row">
                     
					  <form style="width: 100%;overflow-x: scroll;" role="form" id="form_add" action="#" method="post">
                                 <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                             <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Deduction </h3>   
                                    <div class="clearfix"></div>
                                     </div><!-- /.box-header -->
                                <div class="box-body" id="sss" >
                                <div id="error_add"></div>
                                             <div class="form-group col-md-4">
							                    <label>Month</label>
							                    <div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-calendar"></i>
							                      </div>
							                      <input type="text" id="datepicker"  name="salary_month" class="form-control  pull-right" value="<?php echo date('Y-m'); ?>"  />
							                    </div><!-- /.input group -->
							                  </div>
							                  <div class="form-group col-md-4">
							                    <label>Employee</label>
							                      <input type="text" id="tags"  name="employee_name" class="form-control  pull-right"  />
							                      <input type="hidden" id="emp_id" class="form-control"  name="employee_id"/>
							                    </div>
                                <div class="clear-fix"></div>
                                <div class="col-md-4">
                                <label>&nbsp;</label>
                               
                                <a href="javascript:void(0);" style="margin-top: 26px;  margin-bottom: 15px;" class="btn btn-primary" id="show-dates">Show previous</a>
                               <div class="clearfix"></div>
                                </div>
                                 <div class="clear-fix"></div>
                                 <div class="form-group col-md-4">
							                    <label>Deduction Category</label>
							                    
							                    <select class="form-control" name="sld_dec_id">
							                    	<option value="">Select</option>
							                    	<?php if(!empty($deduction_category))
							                    	{
							                    		foreach($deduction_category  as $key=>$item)
							                    		{
															echo "<option value='".$item['dec_id']."' >".$item['dec_name']."</option>";
														}
							                    		
							                    	} ?>
							                    </select> 
							                    
							                  </div>
							                   <div class="form-group col-md-4">
							                    <label>Amount</label>
							                      <input type="text"   name="sld_amount" class="form-control" value=""  />
							                  </div>
							                   <div class="form-group col-md-4">
							                    <label>Date Given</label>
							                    <div class="input-group">
							                    <div class="input-group-addon">
							                        <i class="fa fa-calendar"></i>
							                      </div>
							                      <input type="text"   name="sld_from" class="form-control  pull-right datepicker" value="<?php echo date('Y-m-d'); ?>"  />
							                    </div><!-- /.input group -->
							                  </div>
							                  <div class="form-group col-md-4">
							                    <label>Description</label>
							                      <textarea class="form-control" name="sld_notes"></textarea>
							                    </div>							                  
                                <input  type="submit" name="submit" class="btn btn-success" style="margin-top: 26px; margin-left: 50px;" value="Add Deduction"/>
                                
                         
                            <div class="table-responsive">
                            <table  id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                       <th>#</th>
                                       
                                        	<th>Month</th>
                                            <th>Amount</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Remarks</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                                                                                                   				</tbody>
                                 </table>
                            </div>
                            
                            </div><!-- /.box-body -->
                                
                            </div><!-- /.box -->
                            </form>
                        </div>
                       
                    

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
         <div id="myModal" class="modal fade" role="dialog"  tabindex='-1'>
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
       		
            
		
         <script>
         	function remove_my(e,id)
         	{
				$('#loader').show();
        		 $.ajax({
				type: "GET",
				url: "<?php echo site_path; ?>deduction/remove/"+id,
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
    					});
				}
				
				},
				complete: function (data) {
     			$('#loader').hide();
     				},
     			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
				
			});
			}
         	
         	
           	function display_previous_added(array)
         	{
         		var txt='';
         		var i=1;
         		$.each(array,function(key,value){
					
						absent='<span class="label label-success">present</span>';
						txt+='<tr><td>'+i+'</td><td>'+value['salary_month']+'</td><td>'+value['sld_amount']+'</td><td>'+value['dec_name']+'</td><td>'+value['sld_from']+'</td><td>'+value['sld_notes']+'</td><td><a href="javascript:void(0);" class="label label-warning" onclick="remove_my(this,\''+value['sld_id']+'\')">Remove</a></td></tr>';
					i++;
					
				});
				$('tbody').html(txt);
			}
         	$(document).ready(function(){
         		
         		
         		//Datepicker
	         		$("#datepicker").datepicker( {
					    format: "yyyy-mm",
					    viewMode: "months", 
					    minViewMode: "months",
					    endDate: '0d'
					});
					$(".datepicker").datepicker( {
					    format: "yyyy-mm-dd",
					    endDate: '0d'
					});


				//Employee Autcomplete
				$('#tags').autocomplete({   
					
  					source: function(request, response) {
					        $.ajax({
					            url: "<?php echo site_path ?>deduction/search_employees/",
					            dataType: "json",
					            data: {
					                term : request.term,
					                month : $("#datepicker").val()
					            },
					            success: function(data) {
					                response(data);
					            }
					        });
    				},
					select: function (suggestion,ui) 
					{
			        	$('#emp_id').val(ui.item.data);
			        		
					},
					search: function( event, ui ) 
					{
					 	if($("#datepicker").val()=="")
					 	{
							alert('Please select month');
						}
					 	$('#emp_id').val(ui.data);
					}			
      			 });
				
				
				//Show Previous added	
				$('#show-dates').click(function(){
					$('#loader').show();
					$('tbody').html('');
					$('#error').html('');
					$('.form-control').removeClass('error');
					 $.ajax({
						type: "POST",
						url: "<?php echo site_path; ?>deduction/previous_added",
						dataType: "json",
						data:$( "#form_add" ).serialize() ,
						success: function(html){
							
						if(html.status==0)
						{
							
								
						
							var err='';
							var s=0;
							$.each(html.message, function(k,v){
			       				err+='<p>'+v+'</p>';
			       				if(k=='employee_id')
								{
									k='employee_name';
								}
			       				if(s<1)
			       				{
									$("#"+k).focus();
									s++;
								}
								$("#form_add [name='"+k+"']").addClass( "error" );	
           			
       
    						});  
							$('#error').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>'+err+'</div>');	
								
							 
						}
						else
						{
							display_previous_added(html.result);
							
								
						}
						
						},
						complete: function (data) {
		     			$('#loader').hide();
		     				},
		     			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
				
			});
				});	
				
				
				//form submit
         		$( "#form_add" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>deduction/add_deduction",
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
						$("#"+k).focus();
						s++;
					}
					if(k=='employee_id')
					{
						k='employee_name';
					}
					
           			 $("#form_add [name='"+k+"']").addClass( "error" );	
           			
       
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
     						$('#loader').hide();
     				},
     			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
				
			});
			
			return false;
  			
  			
  
});
         	});
         	
         </script>