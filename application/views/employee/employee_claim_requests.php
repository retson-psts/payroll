            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        List Claim Requests
                        <small>List All Claim Requests</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">List Claim Requests</li>
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
                                    <?php  $total=0; ?>
                                        <thead>
                                            <tr>
                                                <th>Type</th>
                                                <th>Amount($)</th>
                                                <th>Period</th>
                                                <th>Given Date</th>
                                                <th>For Month</th>
                                                <th>CPF Deduction</th>
                                                <th>Approved</th>
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
														$link=site_path.'allowance/remove/'.$employee->emp_allowance_id;
														$cpf="<span class='label label-success'>No Deduction</label>";
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
														if($employee->emp_allowance_approved==0)
														{
															$approved="Waiting for Approved";
															$remove='<a href="'.$link.'"><span class="label label-warning"><i class="fa fa-trash-o"> </i> Remove Allowance</a></span></a>';
														}
														else if($employee->emp_allowance_approved==1)
														{
															$approved="Approved";
															$remove='';
														}
														else
														{
															$approved="Rejected";
															$remove="";															
														}
														
														
														
														
														
														echo '<tr><td>'.$employee->allowance_type_name.'</td><td>'.$employee->emp_allowance_amount.'</td><td>'.$from.' - '.$to.'</td><td>'.$date1.'</td><td>'.$month.'</td><td>'.$cpf.'</td><td>'.$approved.'</td><td>'.$remove.'</td></tr>';
													}
												}
												else
												{
													echo 'No Results Found';
												}
											?>
											<td colspan="1"><b class="pull-right">Total</b></td><td colspan="6"><strong class="">$ <?php echo $total; ?></strong></td>
                                        </tbody>
                                        
                                    </table> 
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        
		