<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?> 
<div id="loader"></div>
           <aside class="right-side  <?php if(isset($left_menu) && $left_menu==0){ echo "strech"; }?>">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Employee Job Sheet
                        <small>Projects Desciption</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i> Projects</a></li>
                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <?php echo $message_div ?>
                    <div class="row">
                     
					  <form style="width: 100%;overflow-x: scroll;" role="form" id="jobsheet_full" action="<?php echo  site_path?>jobsheet/jobsheet_complete" method="post">
                                 <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                 <input type="hidden" name="jobsheet_master_id" value="<?php echo $jobsheet_master_id; ?>" >
                                 <input type="hidden" name="jobsheet_date"  value="<?php echo  $dateold; ?>"/>
                          
                             <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Jobsheet - <span class="label label-success"><?php if($jobsheet_master_id!=0){ echo "Updating Date - "; } ?> <?php echo  $date ?></span> </h3>   
                                    <div class="clearfix"></div>
                                    <div class="form-group col-md-3">
                                     <label for="Day Type">
                                     	Type of day
                                     </label>
                                     <select name="day-type" class="form-control" id="day_type">
                                     	<option value="">Select</option>
                                     	<option value="1">Normal day</option>
                                     	<option value="2">Week Off</option>
                                     	<option value="3">Holiday</option>
                                     </select>
                                    </div>
                                                         
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive" id="sss" >
                                <div id="error_log"></div>
                              <!-- <input style="margin:10px auto; display: block;width:100px;" type="submit" name="job_sheet" class="btn btn-success small " value="Submit" >-->
                                <div class="clear-fix"></div>
                                    <table style="overflow-x: scroll !important; min-width: 1300px;" id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Emp No</th>
                                                <th>Emp Name</th>
                                                <th>Absent</th>
                                                
                                                <th>Normal Hour</th>
                                                <th>OT Fixed</th>
                                                <th>OT 1.5</th>
                                                <th>OT 2</th>
                                                <th>Total Hours</th>
                                                <th width="13%">Working Time</th>
                                                <th width="33%">Project & site</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
										//print_r($total_list);
											if($total_list!=false)
											{
												$i=1;
												
												//var_dump($total_list);
												foreach($total_list as $list)
												{
													
													//var_dump($list['jobsheet']);
													$leave_status1="";
													$leave_disabled="";
													$leave_display="";
													$normal_hour=$list['emp_salary_per_day_hour'];
													$fixed_hours="";
													$ot1="";
													$ot2="";
													$totalhours="";
													$working_time="";
													$remarks="";
													$jobsheet_id="";
													$ot1_disabled="readonly='readonly'";
													$ot2_disabled="readonly='readonly'";
													$otf_disabled="readonly='readonly'";
													switch($list['emp_salary_over_time'])
													{
														case 1:
														$ot1_disabled="";
														break;
														case 2:
														$ot2_disabled="";
														break;
														case 2:
														$otf_disabled="";
														break;
														
													}
													
													if($list['jobsheet']!==false)
													{
														foreach($list['jobsheet'] as $items)
														{
															$jobsheet_id=$items['jobsheet_id'];
															if($items['employee_id']==$list['emp_id'])
															{
																
																$normal_hour=$items['jobsheet_normalhour'];
																$fixed_hours=$items['jobsheet_otfixed'];
																$ot1=$items['jobsheet_ot15'];
																$ot2=$items['jobsheet_ot2'];
																$totalhours=$normal_hour+$fixed_hours+$ot1+$ot2;
																$working_time=$items['jobsheet_workhours'];
																$remarks=$items["jobsheet_notes"];
																
															}
															
														}
														
													}
													if($list['leave']!==false)
													{
														$leave_status1="checked='checked'";	
														$leave_disabled="disabled='disabled'";
														$leave_display="style='display:none;'";
														$ot1_disabled="disabled='disabled'";
													$ot2_disabled="disabled='disabled'";
													$otf_disabled="disabled='disabled'";
													$normal_hour="";
													}
													else
													{
														
													}
													echo "<tr id='emp_".$list['emp_id']."'>";
													echo "<td><input type='hidden' value='".$list['emp_id']."' name='employees[]'><input type='hidden' name='jobsheet_id[]' value='".$jobsheet_id."'>".$i."</td>";
													echo "<td>".$list['emp_number']."</td>";
													echo "<td><a href='javascript:void(0);'  onclick=\"show_employee('".$list['emp_id']."')\"; class='' >".$list['emp_firstname']." ".$list['emp_middle_name']."".$list['emp_lastname']."</a></td>";
													echo "<td><input type='checkbox' ".$leave_status1." class='leave' id='check_".$list['emp_id']."' value='".$list['emp_id']."' name=\"leave[".$list['emp_id']."]\"></td>";
													?>
                                                    
                                                    <?php
													
													echo "<td><input ".$leave_disabled." type='input' class='form-control normal' onkeyup='calculate_total(this);' value='".$normal_hour."' required id='normal_".$list['emp_id']."' name=\"normal_hours[".$list['emp_id']."]\"  readonly='readonly'></td>";
													echo "<td><input value='".$fixed_hours."' type='input'  ".$otf_disabled."  class='form-control' onkeyup='calculate_total(this);' id='otf_".$list['emp_id']."' name=\"otf[".$list['emp_id']."]\"></td>";
													
													echo "<td><input value='".$ot1."'  ".$ot1_disabled."  type='input' class='form-control'  onkeyup='calculate_total(this);' id='ot1_".$list['emp_id']."' name=\"ot15[".$list['emp_id']."]\"></td>";
													
													echo "<td><input  value='".$ot2."' ".$ot2_disabled."  type='input' class='form-control' onkeyup='calculate_total(this);' id='ot2_".$list['emp_id']."'  name=\"ot2[".$list['emp_id']."]\"></td>";
													
													echo "<td id='total_".$list['emp_id']."'>".$totalhours."<input type='hidden' class='form-control tt' name=\"total_hours[".$list['emp_id']."]\"></td>";
													?>
                                             <td><input  <?php echo $leave_disabled; ?>  value="<?php echo $working_time; ?>" type="text" class="form-control in-out" required  name="in-out[<?php echo $list['emp_id']; ?>]"/></td>   
                                                 
                                            <td id="projecttd_<?php echo $list['emp_id']; ?>">
                                           <?php if($list['jobsheet']!==false)
													{ 
													$ilist=0;
													//var_dump($list['jobsheet']);
													foreach($list['jobsheet'] as $jobsheet_list)
													{
														//var_dump($jobsheet_list);
													?>
													<div class="remove1" style="margin-top:4px;">
											<div class="col-md-5">
                                            
                                            <select class="form-control col-md-6 project" <?php echo $leave_disabled; ?>  onchange="change_project(this);" name="project_list[][<?php echo $list['emp_id']; ?>]" required id="project_list_<?php echo $list['emp_id']; ?>">
                                                    <option value="">None</option>
                                            <?php
                                            $string='';
												if($project_list!=false)
												{
													$selected_project="";
													
													foreach($project_list as $project)
													{
														if($project->project_id==$jobsheet_list['working_projects'])
														{
															$selected_project="selected='selected'";
														}
													  echo '<option '.$selected_project.' value="'.$project->project_id.'">'.$project->project_title.'</option>';
													  $string.='<option value="'.$project->project_id.'">'.$project->project_title.'</option>';
													}
												}
											?>
                                            </select>
                                            </div>
                                    		<div class="col-md-5">
                                            <select class="form-control col-md-6 location" <?php echo $leave_disabled; ?> name="location_list[][<?php echo $list['emp_id']; ?>]"  id="location_list_<?php echo $list['emp_id']; ?>">
                                                    <option value="">None</option>
                                                    <option selected="selected" value="<?php echo $jobsheet_list['working_location'] ?>"><?php echo $jobsheet_list['location_name']; ?></option>
                                            
                                            </select></div>
                                    		<div class="col-md-2">
                                            <?php if($ilist!=0){ ?>
                                            <a href="javascript:void(0);" id="remove_button_<?php echo $ilist; ?>" onclick="remove1(this)" class="label label-danger">x</a>
                                             <?php }else{ ?>
                                            	<a href="javascript:void(0);" <?php echo $leave_display; ?> <?php echo $leave_disabled; ?> onclick="add_more('<?php echo $list['emp_id']; ?>')" class="label label-success">+</a>
                                            	<?php } ?>
                                            </div>
                                            <div class="clearfix"></div></div>
													<?php
													$ilist++;
													}  
													 } else 
													{ ?>
													<div class="remove1" style="margin-top:4px;">
                                            <div class="col-md-5">
                                            
                                            <select class="form-control col-md-6 project" <?php echo $leave_disabled; ?>  onchange="change_project(this);" name="project_list[][<?php echo $list['emp_id']; ?>]" required id="project_list_<?php echo $list['emp_id']; ?>">
                                                    <option value="">None</option>
                                            <?php
                                            $string='';
												if($project_list!=false)
												{
													foreach($project_list as $project)
													{
													  echo '<option value="'.$project->project_id.'">'.$project->project_title.'</option>';
													  $string.='<option value="'.$project->project_id.'">'.$project->project_title.'</option>';
													}
												}
											?>
                                            </select>
                                            </div>
                                            <div class="col-md-5">
                                            <select class="form-control col-md-6 location" <?php echo $leave_disabled; ?> name="location_list[][<?php echo $list['emp_id']; ?>]"  id="location_list_<?php echo $list['emp_id']; ?>">
                                                    <option value="">None</option>
                                            
                                            </select></div>
                                            <div class="col-md-2">
                                            	<a href="javascript:void(0);" <?php echo $leave_display; ?> <?php echo $leave_disabled; ?> onclick="add_more('<?php echo $list['emp_id']; ?>')" class="label label-success">+</a>
                                            </div>

											<div class="clearfix"></div>
											</div>
												<?php } ?>
											
                                            </td>
                                                    <?php
													
													echo "<td><textarea ".$leave_disabled."  class='form-control' name=\"remarks[".$list['emp_id']."]\">".$remarks."</textarea></td>";
													
													
													echo "</tr>";
													$i++;
												}
											}
										?>
                                        </tbody>
                                        <tfoot>
                                           
                                            <tr>
                                            		<th>#</th>
                                                <th>Emp No</th>
                                                <th>Emp Name</th>
                                                <th>Absent</th>
                                                
                                                <th>Normal Hour</th>
                                                <th>OT Fixed</th>
                                                <th>OT 1.5</th>
                                                <th>OT 2</th>
                                                <th>Total Hours</th>
                                                <th width="13%">Working Time</th>
                                                <th width="33%">Project & site</th>
                                                <th>Remarks</th>
                                            </tr>
                                       
                                        </tfoot>
                                    </table>
                                 <input style="margin:10px auto; display: block;width:100px;" type="submit" name="job_sheet" class="btn btn-success small " value="Submit" >
                                </div><!-- /.box-body -->
                                
                            </div><!-- /.box -->
                            </form>
                        </div>
                       
                    

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            <div class="modal" id="modal1">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    <h4 class="modal-title">Employee Details</h4>
                  </div>
                  
                  <div class="modal-body" id="employee_modal">
                 
                 
                 
                       
                 
                    
                 

                  
               
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                   
                  </div>

                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
       		<div class="modal" id="modal">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
                    <h4 class="modal-title">Absent details- <div id="emp"></div></h4>
                  </div>
                  <form role="form" id="absent" action="<?php echo  site_path?>jobsheet/absent" method="post">
                                 <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                  <div class="modal-body">
                  <div id="error"></div>
                  <div class="form-group col-md-9">
                  <label for="leave_type">Leave type</label>
                     <input type="hidden" name="employee_id" id="hidden_uid" value="">
                     <input type="hidden" name="leave_date" value="<?php echo  $dateold; ?>">
                  <select class="form-control" name="leave_type" id="leave_type">
                                                    <option value="">None</option>
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
                  <div class="form-group col-md-9">
                                                <label for="jobsheet_date">Reason</label>
                                                <textarea class="form-control" name="leave_reason"></textarea>
                                            </div>
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <button type="submit"  class="submit btn btn-primary">Save changes</button>
                  </div>
                  </form>

                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
            
		<script src="<?php echo  js_path?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo  js_path?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>  
        <script src="<?php echo js_path; ?>plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?php echo js_path; ?>plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?php echo js_path; ?>plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>    
        
         <script type="text/javascript">
         var locations=<?php echo $locations; ?>;
         var employees=<?php echo json_encode($total_list); ?>;
         var pay_period=<?php echo json_encode($pay_periods); ?>;
         $(document).ready(function(){
         	
         	
         	$(".in-out").inputmask({
         		 mask: "h:s - h:s",
            placeholder: "hh:mm - hh:mm",
            alias: "datetime",
            hourFormat: "24"

         	});
         	
         	$( "#absent" ).on( "submit", function( event ) {
        		  event.preventDefault();
        		  
        		 $('#error').html("");
        		var id=$('#hidden_uid').val();
        		
        		   $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>jobsheet/absent",
				dataType: "json",
				data:$( "#absent" ).serialize() ,
				success: function(html){
				if(html.status==0)
				{
					$('#error').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+html.message+'</div>');
					
				}
				else if(html.status==1)
				{
					alert('absent added successfuly');
					$('#modal').modal('hide');
					//alert($('#check_'+id).val());
					$('#check_'+id).prop('checked',true);
					$('#emp_'+id+' .form-control').prop('disabled',true);
					$('#emp_'+id).find('.label').css('display','none');
					//$('#emp_'+id+' .form-control').css('border-color','red','color','red');
					$( "#absent .form-control" ).val('');
					$(this).parent().parent().find('.label').hide();
					
					
				}
				else
				{
					alert('Absent already marked');
					$('#modal').modal('hide');
					//alert($('#check_'+id).val());
					$('#check_'+id).prop('checked',true);
					$('#emp_'+id+' .form-control').prop('disabled',true);
					$('#emp_'+id+' .form-control').css('border-color','red','color','red');
					
					$( "#absent .form-control" ).val('');
					
				}
					
				}
				});
			});
  			$('#modal').on('hidden.bs.modal', function () {
  					var val1=$('#hidden_uid').val();
  					$('#check_'+val1).attr('checked',false);
  					$('#emp_'+val1).css('color',"#333");
					$( "#absent .form-control" ).val('');
					//$('#emp_'+val1+' .form-control').attr('disabled',false);
});
			$('.leave').change(function(){
					
				    var id=$(this).val();
				    //alert($(this).parent().parent().find('.label').hide());
					if($(this).prop('checked'))
					{
						$('#modal').modal('show');
						$('#hidden_uid').val($(this).val());
						emp_details($(this).val());
						
					}
					else
					{
						
						var s=confirm('Are you sure to mark present');
						if(s)
						{
							
						 $.ajax({
								type: "GET",
								url: "<?php echo site_path; ?>jobsheet/reabsent",
								dataType: "json",
								data:'employee_id='+id+'&leave_date=<?php echo $dateold; ?>' ,
								success: function(html){
								if(html.status==0)
								{
									alert("failed mark present");
									$(this).prop('checked',true);
									
								}
								else if(html.status==1)
								{
									$('#emp_'+id+' .form-control').prop('disabled',false);
									//$('#emp_'+id+' .form-control').css('border-color','#ccc','color','#333');
									$('#emp_'+id).find('.label').css('display','inline');
									
									//alert('ok');
									
								}
								else
								{
									$(this).prop('checked',true);
								}
								
						}
				});
						}
						else
						{
							$(this).prop('checked',true);
						}
						
					}
					
					});
			$( "#jobsheet_full" ).on( "submit", function( event ) {
        		  event.preventDefault();
        		 /* alert('ok');*/
        		 $('#loader').show();
        		 $('#error_log').html("");
        		   $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>jobsheet/jobsheet_complete",
				dataType: "json",
				data:$( "#jobsheet_full" ).serialize() ,
				success: function(html){
				if(html.status==0)
				{
					$('#error_log').html('<div class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'+html.message+'</div>');
					
				}
				else if(html.status==1)
				{
					alert('Job Sheet successfuly');
					window.location.href='<?php  echo site_path; ?>jobsheet/';
					
					
				}
				
					
				},
				complete: function (data) {
     			$('#loader').hide();
     				}
				});
			});
			$('#day_type').change(function(){
			var dtype=$('#day_type').val();
			if(dtype==2 || dtype==3)
			{
				$('.normal').val('0');
			}
			else
			{
				$('.normal').val('');
			}
				
				
			});
			});
			function change_project(e)
			{
				
				var project=$(e).val();
				
				var id=$(e).attr('id');
				var arr=id.split('_');
				u='<option value="">select</option>';
			    for(var i=0;i<locations.length;i++)
			    {
			    	if(locations[i].project_id==project)
			    	{
			    		u+='<option value='+locations[i].location_id+'>'+locations[i].location_name+'</option>';
			    	}
				 
				}
				$(e).parent().next().children('.location').html(u);
				
				
				
			}
			function calculate_total(e)
			{
				if(isNaN(e.value))
				{
					//alert('numeric values 24 please');
					$('#'+e.id).val('');
					
				}
				else
				{
						var id=e.id;
						var s=id.split('_');
						var val=s['1'];
						var ot1=0;
						var nt=0;
						var otf=0;
						var ot2=0;
						if(!isNaN($('#otf_'+val).val()) && ($('#otf_'+val).val()!=''))
						{
							otf=parseInt($('#otf_'+val).val());
						}
						if(!isNaN($('#ot1_'+val).val()) && ($('#ot1_'+val).val()!=''))
						{
							ot1=parseInt($('#ot1_'+val).val());
						}
						if(!isNaN($('#ot2_'+val).val()) && ($('#ot2_'+val).val()!=''))
						{
							ot2=parseInt($('#ot2_'+val).val());
						}
						if(!isNaN($('#normal_'+val).val()) && ($('#normal_'+val).val()!=''))
						{
							nt=parseInt($('#normal_'+val).val());
						}
						tt=otf+ot1+ot2+nt;
						if(tt>24)
						{
								alert('Time less than 24 please');
								$('#'+id).val('');
								
								calculate_total(e);
						}
						else
						{
								$('#total_'+val).html(tt);	
						}
						
					
				}
				       
						
						
					
			}
			function find_period(period_code)
			{
				for(var i=0;i<pay_period.length;i++)
			    {
			    	if(pay_period[i].payperiod_code==period_code)
			    	{
			    		return pay_period[i].payperiod_name;
			    	}
			    }
			    return '';
			}
			function show_employee(id)
			{
				$('#employee_modal').html('');
				for(var i=0;i<employees.length;i++)
			    {
			    	if(employees[i].emp_id==id)
			    	{
			    		$('#employee_modal').html('<p><strong>'+employees[i].emp_lastname+''+employees[i].emp_firstname+''+employees[i].emp_middle_name+'</strong> ('+employees[i].emp_number+')</p><p><strong>Contact</strong> :  '+employees[i].emp_mobile+'</p><p><strong>Basic</strong>: '+employees[i].emp_salary_amount+'('+find_period(employees[i].emp_salary_pay_period)+')</p><p><strong>Per Hour</strong>: $ '+employees[i].emp_salary_per_hour+'</p><p><strong>Per OT Hour</strong>: $ '+employees[i].emp_ot_base_amount+'</p>');
			    		$('#modal1').modal('show');
			    	}
			    }
				
			}
			function emp_details(id)
			{
				$('#emp').html('');
				for(var i=0;i<employees.length;i++)
			    {
			    	if(employees[i].emp_id==id)
			    	{
			    		$('#emp').html('<p><strong>'+employees[i].emp_lastname+''+employees[i].emp_firstname+''+employees[i].emp_middle_name+'</strong> ('+employees[i].emp_number+')</p>');
			    		
			    	}
			    }
				
			}
			function add_more(id)
			{
				$('#projecttd_'+id).append('<div class="remove1" style="margin-top:4px;"><div class="col-md-5"><select required class="form-control col-md-6 project" onchange="change_project(this);" name="project_list[]['+id+']" id="project_list_'+id+'"><option value="">None</option><?php echo $string; ?></select></div><div class="col-md-5"><select class="form-control col-md-6 location"  name="location_list[]['+id+']" id="location_list_'+id+'"><option value="">None</option></select></div><div class="col-md-2"><a href="javascript:void(0);" id="remove_button_'+id+'" onclick="remove1(this)" class="label label-danger">x</a></div><div class="clearfix"></div></div>');
			}
			function remove1(e)
			{
			   /*id=e.id;
			   $('#'+id).parents('.remove1').remove();*/
			   $(e).parents('.remove1').remove();
				
			}
			</script>