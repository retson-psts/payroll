<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<link href="<?php echo  css_path?>jQueryUI/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
<div id="loader"></div>
           <aside class="right-side  <?php if(isset($left_menu) && $left_menu==0){ echo "strech"; }?>">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Add OT Fixed salary
                        <small>OT Fixed add salary</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i> Add OT for Month</a></li>
                       
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
                                    <h3 class="box-title">Adding OT </h3>   
                                    <div class="clearfix"></div>
                                     </div><!-- /.box-header -->
                                <div class="box-body" id="sss" >
                                <div id="error_add"></div>
                                             <div class="form-group col-md-3">
							                    <label>Month</label>
							                    <div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-calendar"></i>
							                      </div>
							                      <input type="text" id="datepicker"  name="month" class="form-control  pull-right" value="<?php echo date('Y-m'); ?>"  />
							                    </div><!-- /.input group -->
							                  </div>
							                  <div class="form-group col-md-3">
							                    <label>Employee</label>
							                    <div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-calendar"></i>
							                      </div>
							                      <input type="text" id="tags"  name="employee_name" class="form-control  pull-right"  />
							                       <input type="hidden" id="emp_id" class="form-control"  name="employee_id"/>
							                    </div><!-- /.input group -->
							                  </div>
                                <div class="clear-fix"></div>
                                <a href="javascript:void(0);" style="margin-top: 26px;" class="btn btn-primary" id="show-dates">Show dates</a>
                                <input  type="submit" name="submit" class="btn btn-success" style="margin-top: 26px; margin-left: 50px;" value="Submit OT"/>
                                </div><!-- /.box-body -->
                                
                            </div><!-- /.box -->
                            <div class="table-responsive">
                            <input type="hidden" name="month1" id="month1" value="">
                            <input type="hidden" name="emp_id1" id="emp_id1" value="">
                        	<table style="overflow-x: scroll !important; min-width: 1300px;" id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                       <th><!--<input type="checkbox" class="selectall">--></th>
                                        	<th>Date</th>
                                            <th>Absent</th>
                                            <th>OT Fixed</th>
                                            <th>OT 1.5</th>
                                            <th>OT 2</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                                                                                                   				</tbody>
                                 </table>
                            </div>
                            </form>
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
       		
            
		
         <script>
         	function display_ot(array)
         	{
         		var txt="";
         		var absent="";
         		var disab="";
         		var date="";
				$.each(array,function(key,value){
					if(value.absent==1)
					{
					 absent='<span class="label label-warning">Absent</span>';	
					 disab="disabled='disabled'";
					}
					else
					{
						absent='<span class="label label-success">present</span>';
						disab="";
					}
					txt+='<tr><td><input class="checkbox1" type="checkbox" '+disab+' name="date['+value.date1+']" value="'+value.date1+'"><input type="hidden" name="jobsheet_id['+value.date1+']" value="'+value.jobsheet_id+'" ></td><td>'+value.date+'</td><td>'+absent+'</td><td><input '+disab+' type="text" name="otf['+value.date1+']" class="form-control"  value="'+value.otf+'"></td><td><input type="text" '+disab+' name="ot15['+value.date1+']" class="form-control" value="'+value.ot1+'"></td><td><input type="text" '+disab+' name="ot2['+value.date1+']" class="form-control" value="'+value.ot2+'"></td><td></td></tr>';
					
					
				});
				$('tbody').html(txt);
			}
         	$(document).ready(function(){
         		
         		$("#datepicker").datepicker( {
				    format: "yyyy-mm",
				    viewMode: "months", 
				    minViewMode: "months",
				    endDate: '0d'
				});
				$('#tags').autocomplete({   
					
  					source: function(request, response) {
					        $.ajax({
					            url: "<?php echo site_path ?>ot_add/search_employees/",
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
				$('#show-dates').click(function(){
					$('#emp_id1').val('');
					$('#month1').val('');
					$('#loader').show();
					$('tbody').html('');
					$('#error_add').html('');
					 $.ajax({
						type: "POST",
						url: "<?php echo site_path; ?>ot_add/add_dates",
						dataType: "json",
						data:$( "#form_add" ).serialize() ,
						success: function(html){
							
						if(html.status==0)
						{
							$('.form-control').removeClass('error');
							var s=0;
							$('#error_add').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>'+html.message+'</div>');
							 
						}
						else
						{
							display_ot(html.result);
							$('#emp_id1').val(html.emp_id);
							$('#month1').val(html.month);
								
						}
						
						},
						complete: function (data) {
		     			$('#loader').hide();
		     				},
		     			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
				
			});
				});	
         		$( "#form_add" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>ot_add/submit_ot",
				dataType: "json",
				data:$( "#form_add" ).serialize() ,
				success: function(html){
					
				if(html.status==0)
				{
					//event.preventDefault();
					$('#error_add').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>'+html.message+'</div>');
					 
           			 
					
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