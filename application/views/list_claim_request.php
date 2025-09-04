            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Claim Requests
                        <small>Recent Claim Requests</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Claim Requests</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Claim Requests</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Claim Type</th>
                                                <th>Claim Amount</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>John Deo</td>
                                                <td>Travel</td>
                                                <td>400 $</td>
                                                <td>Approved</td>
                                                <th><a href=""><i class="fa fa-edit"> </i> View</a></th>
                                            </tr>
                                            <tr>
                                                <td>Rio Wang</td>
                                                <td>Mobile</td>
                                                <td>200 $</td>
                                                <td>Approved</td>
                                                <th><a href=""><i class="fa fa-edit"> </i> View</a></th>
                                            </tr><tr>
                                                <td>Emily Jackson</td>
                                                <td>Medical</td>
                                                <td>2,000 $</td>
                                                <td>Rejected</td>
                                                <th><a href=""><i class="fa fa-edit"> </i> View</a></th>
                                            </tr>
                                            <tr>
                                                <td>Samantha</td>
                                                <td>Phone</td>
                                                <td>450 $</td>
                                                <td>Rejected</td>
                                                <th><a href=""><i class="fa fa-edit"> </i> View</a></th>
                                            </tr>
                                            <tr>
                                                <td>Jonathan Smith</td>
                                                <td>Travel</td>
                                                <td>300 $</td>
                                                <td>Approved</td>
                                                <th><a href=""><i class="fa fa-edit"> </i> View</a></th>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Claim Type</th>
                                                <th>Claim Amount</th>
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