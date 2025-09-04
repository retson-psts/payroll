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
                                    <h3 class="box-title">Employees List</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Department</th>
                                                <th>Email</th>
                                                <th>Mobile Phone</th>
                                                <th>Complete Percent</th>
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
														$span='<span class="label label-success"><i class="fa fa-eye"> </i> View Profile</span>';
														if($employee['percent']<100)
														{
															$span='<span class="label label-primary"><i class="fa fa-edit"> </i> Complete profile</span>';
														}
														
														if($employee['percent']!=100)
														{
															$link=site_path.'add_employee/'.$employee['complete'].'/'.$employee['emp_id'];	
														}
														else
														{
															$link=site_path.$employee['complete'].'/'.$employee['emp_id'];
														}
														
														$login='<span class="label label-warning">No Login Created</span>';
														if($employee['username']!='')
														{
															$login='<span class="label label-primary">'.$employee['username'].'</span>';
														}
														echo '<tr><td>'.$employee['emp_firstname'].' '.$employee['emp_lastname'].'</td>
															  <td>'.$employee['joined_date'].'</td>
															  <td>'.$employee['emp_work_email'].'</td>
															  <td>'.$employee['emp_mobile'].'</td>
															  <td>'.$employee['percent'].'% </td>
															  <td>'.$login.'</td>
															  <th><a href="'.$link.'">'.$span.'</a> <a href="#" onclick="return windowpop(\''.site_path.'employee_profile/download_employee/'.$employee['emp_id'].'\',\'1000\',\'500\')"> <span class=""><i class="fa fa-download"></i>Download</span> </a>
															  </th></tr>';
															 /* '.site_path.'employee_profile/download_employee/'.$employee['emp_id'].'*/
															 /*  '<a href="#" onclick="return windowpop(\'http://www.mom.gov.sg/employment-practices/leave\',\'1000\',\'500\')" class="btn btn-success form-control">Leave Reference</a>'*/
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
                                                <th>Logion Details</th>
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
        
		<script src="<?php echo  js_path?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo  js_path?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>      
        
         <script type="text/javascript">
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
            $(function() {
                // $("#example1").dataTable();
                // $('#example2').dataTable({
                //     "bPaginate": true,
                //     "bLengthChange": false,
                //     "bFilter": false,
                //     "bSort": true,
                //     "bInfo": true,
                //     "bAutoWidth": false
                // });
            });
        </script>