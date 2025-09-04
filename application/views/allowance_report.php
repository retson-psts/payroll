            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Allowance Approved                       
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Allowance</a></li>
                        <li class="active">Allowance Approved</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Allowances Request</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <div id="error1"></div>
                                    <table id="example1" class="table table-bordered table-striped">
                                    <?php $total=0; ?>
                                        <thead>
                                            <tr>
                                                <th>Employee No</th>
                                                <th>Employee Name</th>
                                                <th>Type</th>
                                                <th>Amount($)</th>
                                                <th>Period</th>
                                                <th>For Month</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											
												if($allowance_list!=false)
												{
													foreach($allowance_list as $employee)
													{
														$total+=$employee->emp_allowance_amount;
														$link=site_path.'allowance/approve/'.$employee->emp_allowance_id;
														$cpf="<span class='label label-success'>No Deduction</label>";
														$employee_no=$employee->emp_number;
														$employee_name=$employee->emp_firstname." ".$employee->emp_lastname;
														
														if($employee->emp_allowance_from!='0000-00-00')
														{
															$date = DateTime::createFromFormat('Y-m-d',$employee->emp_allowance_from );
															$from=$date->format('d M, Y');
														}
														else
														{
															$from="";
														}
														if($employee->emp_allowance_to!='0000-00-00')
														{
															$date = DateTime::createFromFormat('Y-m-d',$employee->emp_allowance_to );
															$to=$date->format('d M, Y');
														}
														else
														{
															$to="";
														}
														if($employee->emp_allowance_date!='0000-00-00')
														{
															$date = DateTime::createFromFormat('Y-m-d',$employee->emp_allowance_date );
															$date1=$date->format('d M, Y');
														}
														else
														{
															$date1="";
														}
														if($employee->emp_allowance_month!='0000-00-00')
														{
															$date = DateTime::createFromFormat('Y-m-d',$employee->emp_allowance_month );
															$month=$date->format('M , Y');
														}
														else
														{
															$month="";
														}
														

														if($employee->allowance_cpf_detect==1)
														{
														$cpf="<span class='label label-danger'>Deduction </label>";	
														}
														
														echo '<tr><td>'.$employee_no.'</td><td>'.$employee_name.'</td><td>'.$employee->allowance_type_name.'</td><td>'.$employee->emp_allowance_amount.'</td><td>'.$from.' - '.$to.'</td><td>'.$month.'</td><td><a href="javascript:void(0);" onclick="open_modal('.$employee->emp_allowance_id.')"><span class="label label-success"><i class="fa fa-trash-o"> </i> Reject</a></span></a>&nbsp;<a href="'.site_path.'"allowance/remove/'.$employee->emp_allowance_id.'" ><span class="label label-warning"><i class="fa fa-trash-o"> </i> Remove Allowance</span></a></td>  </tr>';
													}
												}
												else
												{
													echo 'No Results Found';
												}
											?>
											
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Employee No</th>
                                                <th>Employee Name</th>
                                                <th>Type</th>
                                                <th>Amount($)</th>
                                                <th>Period</th>
                                                
                                                <th>For Month</th>
                                                
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
        	<div class="modal" id="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    <h4 class="modal-title">Allowance Approve or Reject <div id="emp"></div></h4>
                  </div>
                  <form role="form" id="absent" action="<?php echo  site_path?>jobsheet/absent" method="post">
                                 <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                 <input type="hidden" name="emp_allowance_id" id="emp_allowance_id" value="" >
                  <div class="modal-body">
                  <div id="error"></div>
                  <div class="form-group col-md-6">
                    <label>Allowance Amount $</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        $
                      </div>
                      
                      <input type="text" required class="form-control pull-right" name="emp_allowance_amount"/>
                    </div><!-- /.input group -->
                  </div>
                  <div class="form-group col-md-6">
                    <label>Salary Month</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" required name="emp_allowance_month" class="form-control pull-right" id="datepicker" />
                    </div><!-- /.input group -->
                  </div>
                  <div class="form-group col-md-12">
                  <label for="leave_type">Allowance Type</label>
                     
                  <select class="form-control" required name="allownce_type_id" id="allownce_type_id">
                                                    <option value="">None</option>
                                            <?php
												if($allowance_list!=false)
												{
													foreach($allowance_list as $allowance)
													{
													  echo '<option value="'.$allowance->allowance_types_id.'">'.$allowance->allowance_type_name.'</option>';
													  
													}
												}
											?>
                                            </select>
                                            </div>
                  <div class="form-group col-md-12">
                    <label for="jobsheet_date">Reason</label>
                    <textarea class="form-control" name="emp_allowance_reason"></textarea>
                 </div>
                 <div class="form-group col-md-12">
                    <label for="jobsheet_date">Notes by admin</label>
                    <textarea class="form-control" name="emp_approved_notes"></textarea>
                 </div>
 		 		  <div class="form-group col-md-6">
                    <label>Period</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="range" class="form-control pull-right" id="reservation"/>
                    </div><!-- /.input group -->
                  </div>
                  <div class="form-group col-md-6">
                    <label>Given date</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" name="emp_allowance_date" class="form-control date pull-right" />
                    </div><!-- /.input group -->
                  </div>
				  
                  <div class="form-group col-md-6">
                    <label>CPF Deduct</label>
                    <div class="input-group">
                      <input type="checkbox" name="allowance_cpf_detect" value="1" />
                    </div><!-- /.input group -->
                  </div>
                  
                  <div class="col-md-6"><a id="link" href="javascript:void(0);" onclick="">File</a></div>
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <!--<a href="javascript:void(0);" onclick="submit(0)" class="submit btn btn-success">Reject</a> -->
                   
                   
                    <a href="javascript:void(0);" onclick="submit(2)" class="submit btn btn-warning">Reject</a> 
                     <!--<button type="submit"  class="submit btn btn-success">Approve</button>
                    <button type="submit" class="btn btn-warning">Reject</button>-->
                   
                  </div>
                  </form>

                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>

		 
        <script src="<?php echo  js_path?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        
         <script type="text/javascript">
         function open_modal(id)
         {
         	$( "#absent .form-control" ).val('');
		 	
			$.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>allowance/get_allowance",
				dataType: "json",
				data:"type=2&id="+id+"&<?php echo  $this->security->get_csrf_token_name(); ?>=<?php echo  $this->security->get_csrf_hash(); ?>" ,
				success: function(html){
				if(html.status==0)
				{
					
					$('#error1').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+html.error+'</div>');
					
				}
				else if(html.status==1)
				{
					$.each(html.result, function(k,v) {
       				$("#absent [name='"+k+"']").val(v);	
           			});
           			
           			if(html.result.emp_allowance_filename!="")
           			{
           				//H:\wamp\www\projects\dwz\payroll\site\1\assets\uploads\attachment
						$("#link").html("File Download");
						$("#link").attr("onclick","return windowpop('<?php echo assest_path; ?>uploads/attachment/"+html.result.emp_allowance_filename+"','DWZ Payroll','directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=400,height=350')");
					}
           			else
           			{
						$("#link").attr("onclick","");
						$("#link").html("no file");
					}
					$('#modal').modal('show');
				}
				else
				{
					$('#error1').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Please Try Again</div>');
					/*alert('Allowance already marked');
					$('#modal').modal('hide');
					//alert($('#check_'+id).val());
					$( "#absent .form-control" ).val('');*/
					
				}
					
				}
				});
		 }


		 function submit(id)
		 {
		 	 $('#error').html("");
	    		   $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>allowance/approve_allowance",
				dataType: "json",
				data:$( "#absent" ).serialize()+'&emp_allowance_approved=' + id ,
				success: function(html){
				if(html.status==0)
				{
					$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+html.message+'</div>');
					
				}
				else if(html.status==1)
				{
					var res;
					if(id==1)
					{
						res="Approved";
					}
					else
					{
						res="Rejected";
					}
					alert('Allowance '+res+' successfuly');
					location.reload();
					
					
				}
				else
				{
					alert('Allowance already marked');
					$('#modal').modal('hide');
					//alert($('#check_'+id).val());
					$( "#absent .form-control" ).val('');
					
				}
					
				}
				});
		 }

		  
		  
		  function windowpop(url, width, height) {
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    //Open the window.
    window.open(url, "Window2", "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
}
		  
		  	
	     $(function() {
	        	$("#absent").bind("keypress", function (e) {
				    if (e.keyCode == 13) {
				        //add more buttons here
				        return false;
				    }
				});
	            $('#reservation').daterangepicker({format:'YYYY-MM-DD'});
	            $('.date').datepicker({endDate: '0d',format:'dd-mm-yyyy'});
	            $("#datepicker").datepicker( {
				    format: "mm-yyyy",
				    viewMode: "months", 
				    minViewMode: "months",
				    endDate: '0d'
				});
	           /* $( "#absent" ).on( "submit", function( event ) {
	    		  event.preventDefault();
	    		  
	    		 $('#error').html("");
	    		var id=$('#hidden_uid').val();
	    		
	    		   $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>allowance/add_allowance",
				dataType: "json",
				data:$( "#absent" ).serialize() ,
				success: function(html){
				if(html.status==0)
				{
					$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+html.message+'</div>');
					
				}
				else if(html.status==1)
				{
					alert('Allowance added successfuly');
					$('#modal').modal('hide');
					//alert($('#check_'+id).val());
					$( "#absent .form-control" ).val('');
					
					
				}
				else
				{
					alert('Allowance already marked');
					$('#modal').modal('hide');
					//alert($('#check_'+id).val());
					$( "#absent .form-control" ).val('');
					
				}
					
				}
				});
			});*/
            });
        </script>