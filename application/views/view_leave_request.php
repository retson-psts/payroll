            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Leave Requests Details
                        <small>Leave Requests</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-dashboard"></i> Leave Request</a></li>
                        <li class="active">Leave Requests Details</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                            <?php echo  $message_div; ?>
                                <div  id="process_request">
                               
                                <!-- form start -->
                                <?php /*var_dump($leaves_array);
                                	  var_dump($current_groups);
                                	  var_dump($leaves_array_total);
                                	  var_dump($all_groups);*/
                                	  	 ?>
                                <form role="form"  method="post" id="frm">
                                <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                
                                    <div class="box-body" >
                                        <div class="box-header">
                                            <h3 class="box-title">Leave Requests</h3>                                    
                                        </div><!-- /.box-header -->
                                        <div class="form-group col-md-4">
                                            <?php echo '<b>Employee Name</b> '.$leave_requests_details->emp_firstname.' '.$leave_requests_details->emp_lastname ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <?php echo '<b>Employee Number</b> '.$leave_requests_details->emp_number; ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-4">
                                            <?php echo '<b>Leave Request From</b> '.$leave_requests_details->leave_request_from.'<b> to </b>'.$leave_requests_details->leave_request_to ?>
                                        </div>
                                        <div class="form-group col-md-4">
                                        <?php
                                               /*$from=date_create($leave_requests_details->leave_request_from);
											   $to=date_create($leave_requests_details->leave_request_to);
											   $total_days=date_diff($from,$to);*/
											   echo '<b>Toal Leave Days</b> - '.count($leave_list);
										?>
                                        </div>
                                        <div class="clearfix"></div>
                                         <div class="form-group col-md-4">
                                            <?php echo '<b>Notes </b> '.$leave_requests_details->leave_notes; ?>
                                        </div>
                                        
                                        <div class="clearfix"></div>
                                         <div class="refer">
                                         <div class="leaves">
			                                	<h4>Total Report (<small> Including This Request </small>)</h4>
			                                	<?php
			                                	//var_dump($leaves_array_total); 
			                                	foreach($leaves_array_total as $item1)
			                                	{
			                                		$leave_status="Rejected";
			                                		if($item1->leave_status==0)
			                                		{
														$leave_status="Pending Approve";
													}
													elseif($item1->leave_status==1)
													{
														$leave_status="Approved";
													}
			                                		?>
			                                		<span class=""><?php echo $leave_status; ?></span><span class="count"><?php echo $item1->leaves." Day(s) "; ?></span>
			                                		<?php
			                                	} ?>
			                                	</div>
			                                	<div class="clearfix"></div>
                                         		<div class="leaves">
			                                	<h4>History of leaves (<small> Including This Request </small>)</h4>
			                                	<table class="table">
			                                	<tr><th>Leave Type</th><th>Approved Status</th><th>Leave Days</th></tr>
			                                	<?php foreach($all_groups as $item)
			                                	{
			                                		$leave_status="Rejected";
			                                		if($item['leave_request']==0)
			                                		{
														$leave_status="Pending Approve";
													}
													else if($item['leave_request']==1)
													{
														$leave_status="Approved";
													}
			                                		?>
			                                		<tr><td><?php echo $item['leave_type_name']; ?></td><td><?php echo $leave_status; ?></td><td><?php echo $item['leaves']; ?></td></tr>
			                                		<?php
			                                	} ?>
			                                	</table>
			                                	</div>
			                                	<div class="clearfix"></div>
			                                	<div class="leaves">
			                                	<h4>Current Leave Request Shows</h4>
			                                	<?php foreach($current_groups as $item)
			                                	{
			                                		?>
			                                		<span class="">Leave</span><span class="count"><?php echo $item['leave_type_name']." (".$item['leaves']." Day(s) )"; ?></span>
			                                		<?php
			                                	} ?>
			                                	</div>
                                		
                                		<div class="clearfix"></div>
                                		
                                		</div>
                                		<div class="clearfix"></div>
                                         <div>
                                        
                                    	<ul class="dates">
                                    	<?php if(isset($leave_list)){ foreach($leave_list as $item) { ?>
                                      		<li>
                                      		<div class="date-head"><?php echo $item['date'] ?></div>
                                      		<div class="day-head"><?php echo $item['day'] ?><input type="hidden" name="leave_dates[]" value="<?php echo $item['leave_date'] ?>"/><input type="hidden" name="leave_ids[]" value="<?php echo $item['leave_id'] ?>"/></div>
                                      		<div class="select-control">
                                      			<select class="form-control dateselect" name="leave_types1[]" id="leave_type">
		                                        <?php
													if($leave_request_types!=false)
													{
														foreach($leave_request_types as $leave_type)
														{
															$selected="";
															if($item['leave_type']==$leave_type->leave_type_id)
															{
																$selected='selected="selected"';
															}
														  echo '<option value="'.$leave_type->leave_type_id.'" '.$selected.' >'.$leave_type->leave_type_name.'</option>';
														}
													}
													
												?>
                                            </select>
                                      		</div>	
                                      		</li>
                                      		<?php } } ?>
                                      	</ul>
                                    </div>
                                        <div class="clearfix"></div>
                                         <div class="form-group col-md-4">
                                            <label for="leave_request_approve_notes">Admin Leave Process Notes</label>
                                            <textarea class="form-control" name="leave_request_approve_notes" id="leave_request_approve_notes" placeholder="Add some notes"></textarea>
                                        </div>
                                    </div><!-- /.box-body -->
                                   
									<div class="clearfix"></div>
                                    <div class="box-footer text-center">
                                    	  <input type="hidden" name="request_id" value="<?php echo $leave_requests_details->leave_request_id;?>"/>
                                          <input type="hidden" name="employee_id" value="<?php echo $leave_requests_details->employee_id;?>"/>
                                          <?php if(($leave_requests_details->leave_request_approve_status==2) || ($leave_requests_details->leave_request_approve_status==0)){ ?>
                                          <button type="submit" name="approve" class="btn btn-primary text-center approve"  id="approve">Approve</button>
                                          <?php } if(($leave_requests_details->leave_request_approve_status==1) || ($leave_requests_details->leave_request_approve_status==0)){ ?>
                                          <button type="submit" name="unapprove" class="btn btn-danger text-center reject" id="unapprove" >Reject</button>
                                          <?php } ?>
                                          <a href="<?php echo  site_path?>leave_requests" class="btn btn-warning text-center" id="cancel" >Cancel</a>
                                      </div>
                                </form>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            <script>
            	$(document).ready(function(){
            		
            		$('.approve').click(function(event){
        		 		event.preventDefault();
        		  
		        		 $('#error').html("");
		        		var id=$('#hidden_uid').val();
		        		
		        		   $.ajax({
						type: "POST",
						url: "<?php echo site_path; ?>leave_requests/process_request",
						dataType: "json",
						data:$( "#frm" ).serialize()+'&approve=1' ,
						success: function(html){
						if(html.status==0)
						{
							window.scrollTo(0, 0);
							$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+html.message+'</div>');
							
						}
						else if(html.status==1)
						{
							alert('Leave Approved');
							/*location.reload();*/
							window.location="<?php echo site_path; ?>leave_requests";
						}
						else
						{
							alert('Please reload and try again');
							
						}
							
						}
						});
				});
				$('.reject').click(function(event){
        		 		event.preventDefault();
        		  
		        		 $('#error').html("");
		        		var id=$('#hidden_uid').val();
		        		
		        		   $.ajax({
						type: "POST",
						url: "<?php echo site_path; ?>leave_requests/process_request",
						dataType: "json",
						data:$( "#frm" ).serialize()+'&approve=2' ,
						success: function(html){
						if(html.status==0)
						{
							window.scrollTo(0, 0);
							$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+html.message+'</div>');
							
						}
						else if(html.status==1)
						{
							alert('Leave  Rejected');
							/*location.reload();*/
							window.location="<?php echo site_path; ?>leave_request";
						}
						else
						{
							alert('Please reload and try again');
							
						}
							
						}
						});
				});
            		
            		
            	});
            	
            </script>
