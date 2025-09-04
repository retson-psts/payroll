<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Salary Slip
                       <!-- <small>#007612</small>-->
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Salary Slip</li>
                    </ol>
                </section>

                

                <!-- Main content -->
                <section class="content invoice">                    
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <img src="<?php echo site_path."assets/images/".$company_details['company_logo']; ?>" style="width: 50px;"> <?php echo $company_details['company_name']; ?> 
                                <small class="pull-right">Date: <?php echo date('d M, Y') ?></small>
                            </h2>                            
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong><?php echo $company_details['company_name']; ?> .</strong><br>
                                <?php echo $company_details['company_addressline1']; ?>,
                                <?php echo $company_details['company_addressline2']; ?><br>
                                <?php echo $company_details['company_city']; ?> <?php echo $company_details['company_pincode']; ?><br>
                               Phone: <?php echo $company_details['company_phone']; ?><br>
                               Email: <?php echo $company_details['company_admin_email']; ?><br>
                               
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong><?php echo $total_details['emp_firstname']." ".$total_details['emp_lastname'];  ?></strong><br>
                                <?php echo $total_details['emp_contact_temp_city'];  ?><br>
                                Phone: <?php echo $total_details['emp_hm_telephone'];  ?><br/>
                                Email: <?php echo $total_details['emp_work_email'];  ?><br/>
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                        <?php $date1=new DateTime($total_details['salary_period_from']);
                        	  $date2=new DateTime($total_details['salary_period_to']);
                        	  $total_dates=$date1->diff($date2)->d+1;
                        	  $leave_days=$total_details['leave_days'];
                        	  $total_attend=$total_dates-$leave_days;
                         ?>
                            <b>Days Worked: <?php echo $total_attend." / ".$total_dates; ?> (Including Week Holidays)</b><br/>
                            <b>Employee ID:</b> <?php echo $total_details['emp_number'];  ?><br/>
                            <b>Payment Period:</b> <?php echo $date1->format('d-M-Y')." - ".$date2->format('d-M-y'); ?><br/>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th> Total</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Basic Salary</td>
                                        <td>Addition</td>
                                        <td>$ <?php echo $total_details['ordinary_wage']; ?></td>
                                    </tr>
                                    <?php if($total_details['cpf_employee']!=0){ ?>
                                    <tr>
                                        <td>CPF</td>
                                        <td>Deduction</td>
                                        <td>$ <?php echo $total_details['cpf_employee']; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($total_details['allowance_cpf_deduct']!=0){ ?>
                                    <tr>
                                        <td>CPF Deduction allowance</td>
                                        <td>Addition</td>
                                        <td>$ <?php echo $total_details['allowance_cpf_deduct']; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php if($total_details['allowance_cpf_ndeduct']!=0){ ?>
                                    <tr>
                                        <td>CPF Non Deduction allowance</td>
                                        <td>Addition</td>
                                        <td>$ <?php echo $total_details['allowance_cpf_ndeduct']; ?></td>
                                    </tr>
                                    <?php } ?>
                                    <?php $ot_total= $total_details['otfixed_pay']+$total_details['ot15_pay']+$total_details['ot2_pay'];
                                    if($ot_total>0){ ?>
                                    <tr>
                                        <td>Overtime Salary</td>
                                        <td>Addition</td>
                                        <td>$ <?php echo number_format($ot_total,2); ?></td>
                                    </tr>
                                    <?php } ?> 
                                    <?php if($total_details['cdac']!=0){ ?>
                                    <tr>
                                        <td>Chinese Development Assistance Council</td>
                                        <td>Deduction</td>
                                        <td>$ <?php echo $total_details['cdac']; ?></td>
                                    </tr>
                                    <?php } ?> 
                                    <?php if($total_details['mbmf']!=0){ ?>
                                    <tr>
                                        <td>Mosque Building and Mendaki Fund (MBMF)</td>
                                        <td>Deduction</td>
                                        <td>$ <?php echo $total_details['mbmf']; ?></td>
                                    </tr>
                                    <?php } ?>  
                                    <?php if($total_details['sinda']!=0){ ?>
                                    <tr>
                                        <td>Singapore Indian Development Association (SINDA)</td>
                                        <td>Deduction</td>
                                        <td>$ <?php echo $total_details['sinda']; ?></td>
                                    </tr>
                                    <?php } ?>  
                                    <?php if($total_details['ecf']!=0){ ?>
                                    <tr>
                                        <td> Eurasian Community Fund (ECF)</td>
                                        <td>Deduction</td>
                                        <td>$ <?php echo $total_details['ecf']; ?></td>
                                    </tr>
                                    <?php } ?>  
                                                                     
                                </tbody>
                            </table>                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                        	
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead"><?php echo $date1->format('m/d/Y')." - ".$date2->format('m/d/Y'); ?></p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Net Pay:</th>
                                        <td>$ <?php echo number_format($total_details['net_pay'],2); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-xs-12">
                            <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        </div>
                    </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->