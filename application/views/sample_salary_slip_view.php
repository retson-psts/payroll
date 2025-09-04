 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Salary Slip
                        <small>#007612</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Salary Slip</li>
                    </ol>
                </section>

                <div class="pad margin no-print">
                    <div class="alert alert-info" style="margin-bottom: 0!important;">
                        <i class="fa fa-info"></i>
                        <b>Note:</b> Please click th print button to print the salary slip
                    </div>
                </div>

                <!-- Main content -->
                <section class="content invoice">                    
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <img src="http://demo.getln.com/hr_payroll10/assets/images/login-logo.png" style="width: 50px;"> Sunlight Steel Engineering. 
                                <small class="pull-right">Date: 2/10/2014</small>
                            </h2>                            
                        </div><!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>Sunlight Steel Engineering.</strong><br>
                                Singapore 94107<br>
                                Phone: (804) 123-5432<br/>
                                Email: info@company.com
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong>John Doe</strong><br>
                                Singapore<br>
                                Phone: (555) 539-1037<br/>
                                Email: john.doe@example.com
                            </address>
                        </div><!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #007612</b><br/>
                            <b>Days Worked: 30/31 (Including Week Holidays)</b><br/>
                            <b>Employee ID:</b> 4F3S8J<br/>
                            <b>Payment Period:</b> 2/01/2015 - 31/01/2015<br/>
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
                                        <th>Amount</th>
                                        <th> Total</th>
                                    </tr>                                    
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Basic Salary</td>
                                        <td>Addition</td>
                                        <td>$ 1,500</td>
                                        <td>$ 1,500</td>
                                    </tr>
                                    <tr>
                                        <td>CPF</td>
                                        <td>Deduction</td>
                                        <td>5%</td>
                                        <td>$ 75</td>
                                    </tr>
                                    <tr>
                                        <td>Travel Allowance</td>
                                        <td>Addition</td>
                                        <td>$ 100</td>
                                        <td>$ 100</td>
                                    </tr>
                                    <tr>
                                        <td>Mediacal Allowance</td>
                                        <td>Addition</td>
                                        <td>$ 500</td>
                                        <td>$ 500</td>
                                    </tr>
                                </tbody>
                            </table>                            
                        </div><!-- /.col -->
                    </div><!-- /.row -->

                    <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                        	
                        </div><!-- /.col -->
                        <div class="col-xs-6">
                            <p class="lead">This Period (2/01/2015 - 31/01/2015)</p>
                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th>Net Pay:</th>
                                        <td>$2,025</td>
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