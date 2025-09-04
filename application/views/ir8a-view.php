<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<link href="<?php echo  css_path?>jQueryUI/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css"/>
<div id="loader"></div>
           <aside class="right-side  <?php if(isset($left_menu) && $left_menu==0){ echo "strech"; }?>">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      IR8A
                        <small>IR8A </small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i>IR8A</a></li>
                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <div id="error"></div>
                    <div class="row">
                     
					  <form  role="form" id="form_add" action="#" method="post">
                                 <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                             <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">IR8A Print </h3>   
                                    <div class="clearfix"></div>
                                     </div><!-- /.box-header -->
                                <div class="box-body" id="sss" >
                                <div id="error_add"></div>
                                <div class="col-md-4 col-md-offset-3">
                                             <div class="form-group">
							                    <label>Year</label>
							                    <div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-calendar"></i>
							                      </div>
							                      <input type="text" id="datepicker"  name="month" class="form-control  pull-right" value=""  />
							                    </div><!-- /.input group -->
							                  </div>
							                  <div class="form-group">
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
                                <input  type="submit" name="submit" class="btn btn-success" style="margin-top: 26px; margin-left: 50px;" value="Print IR8A"/>
                                </div>
                                </div><!-- /.box-body -->
                                
                            </div><!-- /.box -->
                            
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
         	 function windowpop(url, width, height) {
						    var leftPosition, topPosition;
						    //Allow for borders.
						    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
						    //Allow for title and status bars.
						    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
						    //Open the window.
						    /*window.open(url, "Leave", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,");*/
						    window.open(url, "Leave", "width=800,height=500,scrollbars=yes");
				}
         	$(document).ready(function(){
         		
         		$("#datepicker").datepicker( {
				    format: "yyyy",
				    viewMode: "years", 
				    minViewMode: "years"
				});
				$('#tags').autocomplete({   
					
  					source: function(request, response) {
					        $.ajax({
					            url: "<?php echo site_path ?>ir8a/search_employees/",
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
				
         		$( "#form_add" ).on( "submit", function( event ) {
				var x=0;
				var err='';
				$('#loader').show();
				var emp_id=$('#emp_id').val();
				var year=$('#datepicker').val();
        		 windowpop('<?php echo site_path; ?>ir8a/ir8a_print?emp_id='+emp_id+'&year='+year,1200,600);
			return false;
  			
  			
  
});
         	
         	});
         	
         </script>