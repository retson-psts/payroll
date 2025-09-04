
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
               <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6"> 
                            <!-- Box (with bar chart) -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Quick Actions</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                	<ul class="todo-list">
                                    	<li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>                                          
                                            <span class="text"><a href="<?php echo  site_path?>employee_leave_requests">View Leave Requests</a></span>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>                                          
                                            <span class="text"><a href="<?php echo  site_path?>employee_request_leave">Request Leave</a></span>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>                                          
                                            <span class="text"><a href="<?php echo  site_path?>employee_claim_requests">View Claim Requests</a></span>
                                        </li>
                                        <li>
                                            <span class="handle">
                                                <i class="fa fa-ellipsis-v"></i>
                                                <i class="fa fa-ellipsis-v"></i>
                                            </span>                                          
                                            <span class="text"><a href="<?php echo  site_path?>employee_request_claim">Request a Claim</a></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                           

                        </section><!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    </div>
					</div>
        </section>
        </aside>