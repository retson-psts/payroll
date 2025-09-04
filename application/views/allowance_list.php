            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        List Employees
                        <small>List All Employees</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Employee</a></li>
                        <li class="active">list Employee</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Employee List</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Department</th>
                                                <th>Email</th>
                                                <th>Mobile Phone</th>
                                                <th>Job Type</th>
                                                <th>Login Details</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											
												if($employees_list!=false)
												{
													foreach($employees_list as $employee)
													{
														$job_type='Full Time';
														/*if($employee->employement_status=='2')
														{
															$job_type='Part Time';
														}*/
														$link=site_path.'allowance/report/'.$employee->emp_id;
														$link1=site_path.'allowance/rejected/'.$employee->emp_id;
														$login='<span class="label label-warning">No Login Created</span>';
														if($employee->username!='')
														{
															$login='<span class="label label-primary">'.$employee->username.'</span>';
														}
														echo '<tr><td>'.$employee->emp_firstname.' '.$employee->emp_lastname.'</td>
															  <td>'.$employee->joined_date.'</td>
															  <td>'.$employee->emp_work_email.'</td>
															  <td>'.$employee->emp_mobile.'</td>
															  <td>'.$job_type.'</td>
															  <td>'.$login.'</td>
															  <th><a href="#" onclick="allowance(\''.$employee->emp_id.'\')"><span class="label label-primary"  data-toggle="modal" data-target="#modal"><i class="fa fa-plus"> </i> Add Allowance</span></a> <a href="'.$link.'"><span class="label label-success"><i class="fa fa-dashboard"> </i> Approved Report</a></span></a> <a href="'.$link1.'"><span class="label label-warning"><i class="fa fa-dashboard"> </i> Rejected Report</a></span></a>
															  </th></tr>';
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
                                                <th>Employee Name</th>
                                                <th>Department</th>
                                                <th>Email</th>
                                                <th>Mobile Phone</th>
                                                <th>Job Type</th>
                                                <th>Login Details</th>
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
                    <h4 class="modal-title">Allowance Add <div id="emp"></div></h4>
                  </div>
                  <form role="form" id="absent" action="<?php echo  site_path?>jobsheet/absent" method="post">
                                 <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
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
                     <input type="hidden" name="employee_id" id="hidden_uid" value="">
                     
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
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit"  class="submit btn btn-primary">Save changes</button>
                  </div>
                  </form>

                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>

		<script src="<?php echo  js_path?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo  js_path?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>      
        <script src="<?php echo  js_path?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        
         <script type="text/javascript">
         function allowance(id)
         {
         	$( "#absent .form-control" ).val('');
		 	$('#modal').modal('show');
			$('#hidden_uid').val(id);
		 }
            $(function() {
                $("#example1").dataTable({"bPaginate": false});
                $('#reservation').daterangepicker({format:'YYYY-MM-DD'});
                $('.date').datepicker({endDate: '0d',format:'dd-mm-yyyy'});
                $("#datepicker").datepicker( {
    format: "mm-yyyy",
    viewMode: "months", 
    minViewMode: "months",
    endDate: '0d'
});
                $( "#absent" ).on( "submit", function( event ) {
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
			});
            });
        </script>