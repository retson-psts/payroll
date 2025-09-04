            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Leave Requests
                        <small>Recent Leave Requests</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Leave Requests</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Leave Requests</h3>                                    
                                </div><!-- /.box-header -->
                                <?php echo  $message_div ?>
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Employee Name</th>
                                                <th>Type</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Total Days</th>
                                                <th>Notes</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	 <?php
											  if($leave_requests!=false)
											  {
												  $i=1;
												  foreach($leave_requests as $leave_req)
												  {
													  $status=$leave_req->leave_request_approve_status;
													  if($status==0)
													  {
														  $stat='<span class="label label-warning">Pending</span>';
													  }
													  elseif($status==1)
													  {
														  $stat='<span class="label label-primary">Approved</span>';
													  }
													  elseif($status==2)
													  {
														  $stat='<span class="label label-danger">Cancelled</span>';
													  }
													  $from=date_create($leave_req->leave_request_from);
													  $to=date_create($leave_req->leave_request_to);
													  $total_days=date_diff($from,$to);
                                                      
													  echo '<tr>
															  <td>'.$i.'</td>
															  <td>'.$leave_req->emp_firstname.'</td>
															  <td>'.$leave_req->leave_type_name.'</td>
															  <td>'.$leave_req->leave_request_from.'</td>
															  <td>'.$leave_req->leave_request_to.'</td>
															  <td>'.($total_days->format("%a")+1).'</td>
															  <td>'.$leave_req->leave_notes.'</td>
															  <td>'.$stat.'</td>
															  <td>'.'<span class="text">
															 <a href="'.site_path.'leave_requests/view/'.$leave_req->leave_request_id.'"><span class="label label-primary"><i class="fa fa-edit"> </i> Approve / Reject</span></a> </td>
															</tr>';
															$i++;
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
                                                <th>#</th>
                                                <th>Employee Name</th>
                                                <th>Type</th>
                                                <th>From</th>
                                                <th>To</th>
                                                <th>Total Days</th>
                                                <th>Notes</th>
                                                <th>Status</th>
                                                <th>Actions</th>
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