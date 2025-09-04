            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        List Employers
                        <small>List All Employers</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Employer</a></li>
                        <li class="active">list Employers</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Employers</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Employer Name</th>
                                                <th>Designation</th>
                                                <th>Email</th>
                                                <th>Mobile Phone</th>
                                                <th>Username</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												if($employees_list!=false)
												{
													foreach($employees_list as $employee)
													{
														
														/*if($employee->employement_status=='2')
														{
															$job_type='Part Time';
														}*/
														$link=site_path.'manage_employer/edit/'.$employee->employer_id;
														$login='<span class="label label-warning">'.$employee->username.'</span>';
														echo '<tr><td>'.$employee->employer_firstname.' '.$employee->employer_lastname.'</td>
															  <td>'.$employee->employer_designation.'</td>
															  <td>'.$employee->email.'</td>
															  <td>'.$employee->employer_mobile.'</td>
															  <td>'.$login.'</td>
															  <th><a href="'.$link.'"><span class="label label-primary"><i class="fa fa-edit"> </i> View / Edit</span></a> <a href="#"><span class="label label-warning"><i class="fa fa-trash-o"> </i> Delete</a></span></a>
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
                                                 <th>Employer Name</th>
                                                <th>Designation</th>
                                                <th>Email</th>
                                                <th>Mobile Phone</th>
                                                <th>Username</th>
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
        </script>