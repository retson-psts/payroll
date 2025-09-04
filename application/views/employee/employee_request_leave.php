            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Request Leave
                        <small>Add Leave Request</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Leaves</a></li>
                        <li class="active">add Leave Request</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                           
                                <div class="box-header">
                                    <h3 class="box-title">Leave Request Details</h3>
                                </div><!-- /.box-header -->
                                <!-- form start -->
                                <form role="form" action="<?php echo  site_path?>employee_request_leave/request_leave_add" method="post" id="frm">
                                <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                    <div class="box-body" >
                                    	<!--<div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-info"></i> Notification</h4>
                    Please Change Weekly holidays in listing dates.
                  </div>-->
                   <div id="error"></div>
                                        <div class="form-group col-md-4">
                                            <label for="leave_type">Leave Type</label>
                                            <select class="form-control" name="leave_type" id="leave_type">
                                            <option value="">Select Leave Type</option>
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
                                        
                                        <div class="form-group col-md-4">
                                        <label>Date range:</label>
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="reservation" name="date_range"/>
                                        </div><!-- /.input group -->
                                       
                                      </div><!-- /.form group -->
                                        <div class="form-group col-md-2 ">
                                      <label>&nbsp;</label>
                                       <a href="javascript:void(0);" class="btn btn-primary form-control" id="btn">Show Dates</a>
                                       </div>
                                        <div class="form-group col-md-2 ">
                                      <label>&nbsp;</label>
                                       <a href="#" onclick="return windowpop('http://www.mom.gov.sg/employment-practices/leave','1000','500')" class="btn btn-success form-control">Leave Reference</a>
                                       </div>
                                      <div class="clearfix"></div>
                                      <div class="app">
                                        <div class="col-md-12">
                                        <div class="col-xs-2 "><span class="others">Allowed Days</span> </div><div class="col-xs-1"><span class="others" id="available">0</span></div>
                                        	<div class="col-xs-2 "><span class="others">Approved Days</span> </div><div class="col-xs-1"><span class="others" id="approve">0</span></div>
                                        	<div class="col-xs-2 "><span class="others">Disapproved Days</span> </div><div class="col-xs-1"><span class="others" id="disap">0</span></div>
                                        	<div class="col-xs-2 "><span class="others">waiting for approve</span> </div><div class="col-xs-1 "><span class="others" id="wait">0</span></div>
                                        	</div>
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="">
                                      	<ul class="dates">
                                      		<!--<li>
                                      		<div class="date-head">12 Jun, 2015</div>
                                      		<div class="day-head">Sun</div>
                                      		<div class="select-control">
                                      			<select class="form-control dateselect" name="leave_type" id="leave_type">
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
                                      		</li>-->
                                      	</ul>
                                      	
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="form-group col-md-4">
                                            <label for="leave_notes">Notes</label>
                                            <textarea name="leave_notes" id="leave_notes" class="form-control"></textarea>
                                            <input type="hidden" id="leave_available" value="">
                                        </div>
                                        <div class="clearfix"></div>
                                         
                                    </div><!-- /.box-body -->
									<div class="clearfix"></div>
                                    <div class="box-footer text-center">
                                        <button type="submit" name="submit" class="btn btn-primary text-center">Submit</button>
                                    </div>
                                </form>
                            </div><!-- /.box -->

                            <!-- Form Element sizes -->
                           
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            <script src="<?php echo  js_path?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
            
             <script type="text/javascript">
                var leavejson=<?php echo json_encode($leave_request_types); ?>;
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
					//Date range picker
					$('#reservation').daterangepicker({format: 'YYYY/MM/DD',       
					 minDate: '<?php echo date("Y-m-d"); ?>',
       				});
					$('#leave_type').change(function(){
						var id=$('#leave_type').val();
						$('#loader').show();
						$('.dateselect ').val($('#leave_type').val());
						var url='http://www.mom.gov.sg/employment-practices/leave';
						var days=0;
						$.each(leavejson, function(k, v) {
						if(v.leave_type_id==$('#leave_type').val())
						{
							url=v.leave_type_url;
							days=v.leave_type_days;
						}	
						});
						$.ajax({
								url: '<?php echo site_path; ?>employee_request_leave/check_leave',
					            type: 'POST',
					            data: 'id='+id+'&<?php echo  $this->security->get_csrf_token_name(); ?>=<?php echo  $this->security->get_csrf_hash(); ?>',
					            dataType: 'json',
					            success: function(data, textStatus, jqXHR)
					            {
					            	$('#wait').html('0');
					            	$('#disap').html('0');
					            	$('#approve').html('0');
					            	
					            	
					            	if(data.status==0)
					            	{
										
									}
									else if(data.status==1)
									{ 
										
										$('#leave_available').val(days);
										$.each(data.leave_array,function(k,v){
											if(v.leave_status==0)
											{
												$('#wait').html(v.leaves);
											}
											if(v.leave_status==1)
											{
												$('#approve').html(v.leaves);
											}
											if(v.leave_status==1)
											{
												$('#disap').html(v.leaves);
											}
											
											
										});
										$('#available').html(data.leave_array.leave_allowed);
									}
									else
									{
										alert('Something wrong');
									}
					            },
								complete: function (data) {
				     			$('#loader').hide();
				     				}
            
            });
						
						// window.open(url, "Leave", "width=800,height=500,scrollbars=yes");
					});
					$('#btn').click(function(){
						$('#loader').show();
						$.ajax({
								url: '<?php echo site_path; ?>employee_request_leave/leave_list',
					            type: 'POST',
					            data: 'range='+$('#reservation').val()+'&<?php echo  $this->security->get_csrf_token_name(); ?>=<?php echo  $this->security->get_csrf_hash(); ?>',
					            cache: false,
					            dataType: 'json',
					            success: function(data, textStatus, jqXHR)
					            {
					            	if(data.status==0)
					            	{
										alert('Please select correct Date');
									}
									else
									{
										var txt='';
										$.each(data, function(k, v) {
											txt+='<li><div class="date-head">'+v.date+'<input type="hidden" name="dates[]" value="'+v.date1+'"></div><div class="day-head">'+v.day+'</div><div class="select-control"><select class="form-control dateselect" name="leave_types1[]" ><?php if($leave_request_types!=false){ foreach($leave_request_types as $leave_type){ echo '<option value="'.$leave_type->leave_type_id.'">'.$leave_type->leave_type_name.'</option>';}}?></select></div></li>';
										});
										$('.dates').html(txt);
										$('.dateselect').val($('#leave_type').val());
									}
					            },
								complete: function (data) {
				     			$('#loader').hide();
				     				}
            
            });
					});
					
					$( "#frm" ).on( "submit", function( event ) {
        		 		event.preventDefault();
        		  $('#loader').show();
		        		 $('#error').html("");
		        		var id=$('#hidden_uid').val();
		        		
		        		   $.ajax({
						type: "POST",
						url: "<?php echo site_path; ?>employee_request_leave/employee_leave_add",
						dataType: "json",
						data:$( "#frm" ).serialize() ,
						success: function(html){
						if(html.status==0)
						{
							window.scrollTo(0, 0);
							$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+html.message+'</div>');
							
						}
						else if(html.status==1)
						{
							alert('Leave has been added successfully');
							/*location.reload();*/
							//window.location="employee_leave_requests";
						}
						else
						{
							alert('Dates already Requested or added');
							var date=html.dates;
							txt='';
							$.each(date, function(k, v) {
								txt+='<p>'+v+'</p>';
								});
								$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+txt+'</div>')
							
						}
							
						},
						complete: function (data) {
		     			$('#loader').hide();
		     				}
						});
				});
					
				});
			</script>