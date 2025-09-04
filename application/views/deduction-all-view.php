<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<link href="<?php echo  css_path?>jQueryUI/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
<div id="loader"></div>
           <aside class="right-side  <?php if(isset($left_menu) && $left_menu==0){ echo "strech"; }?>">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                     All Deduction
                        <small>Deduction List</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i> Deduction List</a></li>
                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <div id="error"></div>
                    <div class="row">
                     
					  <form style="width: 100%;" role="form" id="form_add" action="#" method="post">
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
							                      <input type="text" id="datepicker"  name="salary_month" class="form-control  pull-right"   />
							                    </div><!-- /.input group -->
							                  </div>
							                  <div class="form-group col-md-4">
							                    <label>Employee</label>
							                      <input type="text" id="tags"  name="employee_name" class="form-control  pull-right"  />
							                      <input type="hidden" id="emp_id" class="form-control"  name="employee_id"/>
							                    </div>
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
                                <div class="clear-fix"></div>
                                
                                <div class="col-md-4 col-md-offset-3">
                                <label>&nbsp;</label>
                               
                                <a href="javascript:void(0);" style="margin-top: 26px;  margin-bottom: 15px;" class="btn btn-primary" id="show-dates">Fetch Results</a>
                               <div class="clearfix"></div>
                                </div>
                                 <div class="clear-fix"></div>
                                
                                
                         
                            <div class="">
                            <table  id="table" class="table table-bordered table-striped">
                                   <!-- <thead>
                                        <tr>
                                       <th>#</th>
                                       <th>Employee Id</th>
                                       <th>Employee Name</th>
                                        	<th>Month</th>
                                            <th>Amount</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                            <th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                                                                                                   				</tbody>-->
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
       		
            <link rel="stylesheet" href="<?php echo site_path; ?>assets/plugin/bootstrap-table/bootstrap-table.css"/>
<link rel="stylesheet" href="<?php echo site_path; ?>assets/plugin/bootstrap-table/bootstrap-table-fixed-columns.css"/>
<link rel="stylesheet" href="<?php echo site_path; ?>assets/plugin/bootstrap-table/extensions/reorder-rows/bootstrap-table-reorder-rows.css"/>



<!-- Latest compiled and minified JavaScript -->


<!-- Latest compiled and minified Locales -->

<!--common scripts for all pages-->

<script src="<?php echo site_path; ?>assets/plugin/bootstrap-table/bootstrap-table.js"></script>
<script src="<?php echo site_path; ?>assets/plugin/bootstrap-table/bootstrap-table-fixed-columns.js"></script>
<script src="<?php echo site_path; ?>assets/plugin/bootstrap-table/jquery.tablednd.js"></script>
<script src="<?php echo site_path; ?>assets/plugin/bootstrap-table/extensions/reorder-columns/bootstrap-table-reorder-columns.js"></script>
<script src="<?php echo site_path; ?>assets/plugin/bootstrap-table/extensions/export/bootstrap-table-export.js"></script>
    <script src="<?php echo site_path; ?>assets/plugin/bootstrap-table/tableExport.js"></script>

		
         <script>
         
         // remove
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
						$('#table').bootstrapTable('refresh');
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
						txt+='<tr><td>'+i+'</td><td>'+value['salary_month']+'</td><td>'+value['sld_amount']+'</td><td>'+value['dec_name']+'</td><td>'+value['sld_from']+'</td><td>'+value['sld_notes']+'</td></tr>';
					i++;
					
				});
				$('tbody').html(txt);
			}
         	$(document).ready(function(){
         		
         		$('#tags').keydown(function(){
				 		var key = event.keyCode || event.charCode;

					    if( key == 8 || key == 46 )
					    {
							$('#tags').val('');	
							$('#emp_id').val('');	
						}
	
 				});
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
					 $.ajax({
						type: "get",
						url: "<?php echo site_path; ?>deduction/fetch_deduction",
						dataType: "json",
						data:$( "#form_add" ).serialize() ,
						success: function(html){
							
						if(html.status==0)
						{
							var err='';
							$('.form-control').removeClass('error');
					var s=0;
					$.each(html.message, function(k,v) {
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
							if(html)
							{
								$('#table').bootstrapTable('load',html);	
							}
							else
							{
								$('#table').bootstrapTable('removeAll');
							}
							//$('#table').bootstrapTable('load',html.result);
							
								
						}
						
						},
						complete: function (data) {
		     			$('#loader').hide();
		     				},
		     			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
				
			});
				});	
				
				
				$('#table').bootstrapTable({
								method: 'get',
								url: '<?php echo site_path; ?>deduction/fetch_deduction',
								cache: false,
                                striped: true,
                                pagination: true,
                                pageSize: 10,
                                pageList: [10, 25, 50, 100, 200],
                                search: true,
                                showColumns: true,
                                showRefresh: true,
                                minimumCountColumns: 2,
                                clickToSelect: true,
                                showExport: true,
                                columns: [
                                    {
                                        "field": "sno",
                                        "title": "#",
                                        "align": "center",
                                        "valign": "bottom",
                                        "sortable": true,
                                        "visible": true
                                    },
                                    {
                                        "field": "emp_number",
                                        "title": "Employee Id",
                                        "align": "center",
                                        "valign": "bottom",
                                        "sortable": true,
                                        "visible": true
                                    },
                                    {
                                        "field": "emp_name",
                                        "title": "Employee Name",
                                        "align": "center",
                                        "valign": "bottom",
                                        "sortable": true,
                                        "visible": true
                                    },
                                    {
                                        "field": "salary_month",
                                        "title": "Month",
                                        "align": "center",
                                        "valign": "bottom",
                                        "sortable": true,
                                        "visible": true
                                    },
                                    {
                                        "field": "sld_amount",
                                        "title": "AMOUNT",
                                        "align": "center",
                                        "valign": "bottom",
                                        "sortable": true,
                                        "visible": true
                                    },
                                    {
                                        "field": "dec_name",
                                        "title": "CATEGORY",
                                        "align": "center",
                                        "valign": "bottom",
                                        "sortable": true,
                                        "visible": true
                                    },
                                    {
                                        "field": "sld_from",
                                        "title": "Date Given",
                                        "align": "center",
                                        "valign": "bottom",
                                        "sortable": true,
                                        "visible": true
                                    },
                                    {
                                        "field": "sld_notes",
                                        "title": "Notes",
                                        "align": "center",
                                        "valign": "bottom",
                                        "sortable": true,
                                        "visible": true
                                    },
                                    {
                                        "field": "remove",
                                        "title": "Option",
                                        "align": "center",
                                        "valign": "bottom",
                                        "visible": true
                                    }
                                    ]

		
		});

         		
         	});
         	
         </script>