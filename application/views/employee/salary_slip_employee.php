           <div id="loader"></div>
           <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Salary Slip
                        <small>Salary Slip</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i> Reports</a></li>
                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                           
                             <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">salary Details</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <div id="error"></div>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Employee No</th>
                                                <th>Employee Name</th>
                                                <th>JOB TYPE</th>
                                                <th>Salary Month</th>
                                                <th>Salary Amount</th>
                                                <th>Action</th>
                                             </tr>
                                        </thead>
                                        <tbody id="ajax">
                                        <?php if($salary_slips!==false){
                                        	$i=1;
                                        	foreach($salary_slips as $key => $value)
                                        	{
                                        		$link1='<a href="'.site_path.'salary_slip/view/'.$value['salary_master_id'].'"> View Salary Slip</a>';
											echo '<tr><td>'.$i.'</td><td>'.$value['emp_number'].'</td><td>'.$value['emp_firstname'].' '.$value['job_title_name'].'</td><td>'.$value['job_title_name'].'</td><td>'.$value['month'].'-'.$value['year'].'</td><td>'.$value['net_pay'].'</td><td>'.$link1.'</td></tr>';
											$i++;
											}
											
                                        } ?>
                                        </tbody>
                                        <!--<tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Leave Count</th>
                                                <th>Month</th>
                                            </tr>
                                        </tfoot>-->
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        
		
        
        <script src="<?php echo  js_path?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>  
        
         <script type="text/javascript">
            
			
			</script>