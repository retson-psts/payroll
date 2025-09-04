           <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Employee Salary Report 
                        <small>Salary Report</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i> Reports</a></li>
                         <li class="active"> Salary</li>
                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <?php echo $message_div ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-warning">
                                <div class="box-header">
                                 
                                <h3 class="box-title">Filter By Following</h3>                                    
                                </div><!-- /.box-header -->
                                <form role="form" id="frm" action="<?php echo  site_path?>projects/add" method="post">
                                      <div class="box-body">
                                         <div class="add_form" >
                                         <div id="error"></div>
                                            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                           <!-- <div class="form-group col-md-3">
                                                <label >Leave Type</label>
                                               <select class="form-control" name="leave_type">
                                               	<option value="">All</option>
                                               	 <?php
												if($leave_request_types!=false)
												{
													foreach($leave_request_types as $leave_type)
													{
													  echo '<option value="'.$leave_type->leave_type_id.'">'.$leave_type->leave_type_name.'</option>';
													  
													}
												}
											?>
                                               	
                                               </select>
                                            </div>
                                             <div class="form-group col-md-3">
							                    <label>Period</label>
							                    <div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-calendar"></i>
							                      </div>
							                      <input type="text"  name="range" class="form-control date_range pull-right" id="" />
							                    </div>
							                  </div>-->
                                             <div class="form-group col-md-3">
							                    <label>Month</label>
							                    <div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-calendar"></i>
							                      </div>
							                      <input type="text" id="datepicker"  name="month" class="form-control  pull-right"  />
							                    </div><!-- /.input group -->
							                  </div>
                                            <div class="clearfix"></div>
                                         </div>
                                      </div><!-- /.box-body -->
                                    <div class="box-footer">
                                    
                                        <div class="clearfix"></div>
                                        <div class="cat_save">
                                        	<button type="submit" name="submit" class="btn btn-primary text-center" id="save">Searh</button>
                                            <button type="submit" name="submit" class="btn btn-danger text-center" id="cancel" onclick="cancel_btn(); return false;">Cancel</button>
                                        </div>
                                    </div>
                               </form>
                              
                             </div>
                             <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Employee salary Report</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <a href="#" id="excel"  >Download <i class="ico ico-excel "></i></a>
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
            $(function() {
            	$('.date_range').daterangepicker({format: 'YYYY/MM/DD'});
            	 $("#datepicker").datepicker( {
				    format: "yyyy-mm",
				    viewMode: "months", 
				    minViewMode: "months",
				    endDate: '0d'
				});
				$( "#frm" ).on( "submit", function( event ) {
        		  event.preventDefault();
        		  $('#loader').show();
        		  $('#error').html('');
					$('#ajax').html('');
					$.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>reports/ajax_salary",
				dataType: "json",
				data:$( "#frm" ).serialize() ,
				success: function(html){
					
					if(html.status==0)
					{
						$('#error').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>'+html.message+'</div>');
						window.scrollTo(0, 0);
						
					}
					else if(html.status==1)
					{
						
							var res=html.result_array;
							var txt='';
							i1=1;
							for(var i=0;i<res.length;i++)
							{
								var link1='<a href="<?php echo site_path; ?>salary_slip/view/'+res[i].salary_master_id+'"> View Salary Slip</a>';
								txt+='<tr><td>'+i1+'</td><td>'+res[i].emp_number+'</td><td>'+res[i].emp_firstname+' '+res[i].emp_lastname+'</td><td>'+res[i].job_title_name+'</td><td>'+res[i].month+'-'+res[i].year+'</td><td>'+res[i].net_pay+'</td><td>'+link1+'</td></tr>';
								i1++;
							}
							
							$('#ajax').html(txt);
						
					}
					else
					{
						alert('Please try again');
					}
				
					
				},
				complete: function (data) {
     $('#loader').hide();
     				}
				});
					
					
				});
            });
			
			</script>