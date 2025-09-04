
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add Employee
                        <small>Employee Dependents</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Employee</a></li>
                        <li class="active">add Employee</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                            	
                                <div class="col-md-12 ">
								  <?php echo  $message_div ?>
                                  <?php echo  $nav_steps ?>
                                  <div class="add_panel">
                                    <div class="box-header">
                                        <h3 class="box-title">Dependents</h3>
                                    </div><!-- /.box-header -->
                                    <form role="form"  action="<?php echo  site_path.'add_employee_process/employee_dependents/'.$employee_id?>" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                    <div id="add_form" style="display:none">
                                      <div class="box-body">
                                        <div class="form-group col-md-4">
                                           <label for="eec_name">Name *</label>
                                           <input type="text" class="form-control" name="ed_name" id="ed_name" value="<?php echo  $form_data['ed_name'] ?>">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-4">
                                           <label for="eec_relationship">Relationship *</label>
                                           <select class="form-control" name="ed_relationship_type" id="ed_relationship_type" onchange="relation(this.id);">
                                           <option value="child">Child</option>
                                           <option value="Spouse">Spouse</option>
                                           <option value="others">Others</option>
                                           </select>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-4" id="specify" style="display:none;">
                                           <label for="specify">Please Specify *</label>
                                           <input type="text" class="form-control" name="specify" id="specify" value="<?php echo  $form_data['specify'] ?>">
                                        </div>
                                        <div class="clearfix"></div>
                                        
                                        <div class="form-group col-md-4">
                                          <label for="ed_date_of_birth">Date of Birth</label>
                                          <div class="input-group">
                                             <div class="input-group-addon">
                                                  <i class="fa fa-calendar"></i>
                                             </div>
                                             <input type="text" class="form-control date" name="ed_date_of_birth" id="ed_date_of_birth"  placeholder="" value="<?php echo  $form_data['ed_date_of_birth'] ?>">
                                             </div>
                                        </div>
                                        
                                        
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="box-footer text-center">
                                            <button type="submit" name="save" class="btn btn-warning text-center">Save</button>
                                            <button type="submit" name="cancel" class="btn btn-primary text-center" id="cancel_form3" onclick="cancel_add();return false;">Cancel</button>
                                      </div>
                                    </div>
                                   <div id="add_button">
                                        <button name="add_data" onclick="add_form();return false;" type="submit" class="btn btn-warning text-center">Add</button>
                                        <button name="next" type="submit" class="btn btn-info text-center">Next</button>
                                    </div>
                                    </form>
                                  </div><!-- Add Panel Ends-->
                                  <div class="edit_panel" style="display:none">
                                  	     <div class="box-header">
                                              <h3 class="box-title">Edit Dependents</h3>
                                          </div><!-- /.box-header -->
                                          <form role="form"  action="<?php echo  site_path.'edit_employee_process/emp_dependent_edit/'.$employee_id?>" method="post">
                                          <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>" />
                                          <input type="hidden" name="ed_id" id="edit_ed_id" value="<?php echo  $form_data['ed_id'] ?>" />
                                          <div id="edit_form">
                                            <div class="box-body">
                                             <div class="box-body">
                                              <div class="form-group col-md-4">
                                                 <label for="eec_name">Name *</label>
                                                 <input type="text" class="form-control" name="ed_name" id="edit_ed_name" value="<?php echo  $form_data['ed_name'] ?>">
                                              </div>
                                              <div class="clearfix"></div>
                                              <div class="form-group col-md-4">
                                                 <label for="eec_relationship">Relationship *</label>
                                                 <select class="form-control" name="ed_relationship_type" id="edit_ed_relationship_type" onchange="relation(this.id);">
                                                 <option value="child">Child</option>
                                                 <option value="Spouse">Spouse</option>
                                                 <option value="others">Others</option>
                                                 </select>
                                              </div>
                                              <div class="clearfix"></div>
                                              <div class="form-group col-md-4" id="edit_specify_box" style="display:none;">
                                                 <label for="specify">Please Specify *</label>
                                                 <input type="text" class="form-control" name="specify" id="edit_specify" value="<?php echo  $form_data['specify'] ?>">
                                              </div>
                                              <div class="clearfix"></div>
                                              
                                              <div class="form-group col-md-4">
                                                <label for="ed_date_of_birth">Date of Birth</label>
                                                <div class="input-group">
                                                   <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                   </div>
                                                   <input type="text" class="form-control date" name="ed_date_of_birth" id="ed_date_of_birth_edit"  placeholder="" value="<?php echo  $form_data['ed_date_of_birth'] ?>">
                                                   </div>
                                              </div>
                                              
                                            </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="box-footer text-center">
                                                  <button type="submit" name="save" class="btn btn-warning text-center">Save</button>
                                                  <button type="submit" name="cancel" class="btn btn-primary text-center" id="cancel_form3" onclick="cancel_edit();return false;">Cancel</button>
                                            </div>
                                          </div>
                                          </form>                               	
                                  </div><!-- Edit Panel-->
                                  <div class="clearfix"></div>
                                  <div class="list_results">
                                  	  <div class="added_data">
                                      	 <div class="box-header">
                                             <h3 class="box-title">Assigned Dependents</h3>
                                         </div><!-- /.box-header -->
                                         <?php
										 if($emp_dependents!=false)
									     {
										 ?>
                                          <div class="box-body table-responsive">
                                          <table id="example1" class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                    <th>Name</th>
                                                    <th>Relationship Type</th>
                                                    <th>Relationship</th>
                                                    <th>Date of Birth</th>
                                                    <th>Options</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              <?php
											  foreach($emp_dependents as $emp_dependent)
											  {
												  $name='<a href="#" onclick="enable_edit('.$emp_dependent->ed_id.',\''.$emp_dependent->ed_date_of_birth.'\'); return false;" id="rel_'.$emp_dependent->ed_id.'">'.$emp_dependent->ed_name.'</a>';
												  echo '<tr id="ed_'.$emp_dependent->ed_id.'"><td>'.$name.'</td>
														<td>'.$emp_dependent->ed_relationship_type.'</td>
														<td>'.$emp_dependent->ed_relationship.'</td>
														<td>'.$emp_dependent->ed_date_of_birth.'</td>
														<td></td></tr>';
											  }
											  ?>
                                              </tbody>
                                               <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Relationship Type</th>
                                                    <th>Relationship</th>
                                                    <th>Date of Birth</th>
                                                    <th>Options</th>
                                                </tr>
                                        	  </tfoot>
                                          </table>
                                      </div> 
                                      <?php
										}
										else
										{
											echo 'No Results Found';
										}
									  ?>                                    
                                  </div>
                              </div><!-- /.list-results -->
                              <div class="attachments">
                              	   <div class="box-header">
                                       <h3 class="box-title">Attachments</h3>
                                   </div><!-- /.box-header -->
                                   <div class="attachment_add">
                                       <form role="form"  action="<?php echo  site_path.'add_employee_process/upload_attachment/'.$employee_id?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                        <input type="hidden" name="ed_id" id="edit_ed_id" value="<?php echo  $form_data['ed_id'] ?>"/>
                                        <input type="hidden" name="screen" value="ed" />
                                        <div id="add_attach_form" style="display:none">
                                          <div class="box-body">
                                            <div class="form-group col-md-4">
                                               <label for="attach_file">Select File *</label>
                                               <input type="file" name="attach_file" id="attach_file" class="form-control"/>
                                               <p class="help-block">File should be jpeg,gif, pdf, png, doc, docx or excel format (file size not more than 1 MB)</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="form-group col-md-4">
                                               <label for="attach_comment">Comment</label>
                                               <textarea class="form-control" name="attach_comment" id="attach_comment" ></textarea>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="box-footer text-center">
                                                  <button type="submit" name="save" class="btn btn-warning text-center">Save</button>
                                                  <button type="submit" name="cancel" class="btn btn-primary text-center" id="cancel_form3" onclick="cancel_attach_add();return false;">Cancel</button>
                                            </div>
                                        </div>
                                        </div>
                                       <div id="add_attach_button">
                                            <button name="add_data" onclick="add_attach_form();return false;" type="submit" class="btn btn-warning text-center">Add</button>
                                        </div>
                                        </form>
                                   </div><!-- attachment_add end-->
                              </div>
                                    <div class="list_results">
                                  	  <div class="added_data">
                                      	 <div class="box-header">
                                             <h3 class="box-title">Assigned Attachments</h3>
                                         </div><!-- /.box-header -->
                                         <?php
										 if($attachments!=false)
									     {
										 ?>
                                          <div class="box-body table-responsive">
                                          <table id="example1" class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                      <th>File Name</th>
                                                      <th>Description</th>
                                                      <th>Size</th>
                                                      <th>File Type</th>
                                                      <th>Attached At</th>
                                                      <th>Options</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              
                                              <?php
											  foreach($attachments as $attachment)
											  {
												  $name='<a href="'.attachments_folder.'/'.$attachment->eattach_filename.'" target="_blank">'.$attachment->eattach_filename.'</a>';
												  echo '<tr><td>'.$name.'</td>
														<td>'.$attachment->eattach_desc.'</td>
														<td>'.$attachment->eattach_size.'</td>
														<td>'.$attachment->eattach_type.'</td>
														<td>'.$attachment->attached_time.'</td>
														<td></td></tr>';
											  }
											  ?>
                                              </tbody>
                                               <tfoot>
                                                <tr>
                                                    <th>File Name</th>
                                                    <th>Description</th>
                                                    <th>Size</th>
                                                    <th>File Type</th>
                                                    <th>Attached At</th>
                                                    <th>Options</th>
                                                </tr>
                                        	  </tfoot>
                                          </table>
                                      </div> 
                                      <?php
										}
										else
										{
											echo 'No Results Found';
										}
									  ?>                                    
                                  </div>
                              </div><!-- /.list-results -->

                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            <?php
			if(!isset($add_form))
			{
			?>
				<script>
                function add_form()
                {
                    $("#add_form").css("display","block");
                    $("#add_button").css("display","none");
                }
                function cancel_add()
                {
                    $("#add_form").css("display","none");
                    $("#add_button").css("display","block");
                }
                </script>
            <?php
			}
			else
			{
				echo '<script>$("#add_form").css("display","block");$("#add_button").css("display","none");</script>';
			}
			if(isset($edit_form))
			{
				echo '<script>$(".add_panel").css("display","none");$(".edit_panel").css("display","block");</script>';
			}
			?>
			<script>
			$('#ed_date_of_birth').datepicker({
					format: "yyyy-mm-dd"
				});
			$('#ed_date_of_birth_edit').datepicker({
					format: "yyyy-mm-dd"
				});
			function enable_edit(val,date)
			{
				var row='#example1 #ed_'+val;
				var relation_type = $('#ed_'+val).find("td").eq(1).html();
				var relation = $('#ed_'+val).find("td").eq(2).html();
				var dob=$('#ed_'+val).find("td").eq(3).html().split('-');
				var name=$('a#rel_'+val).text();
				$("#edit_ed_id").val(val);
				$("#edit_ed_name").val(name);$("#edit_ed_relationship_type").val(relation_type);$("#edit_specify").val(relation);
				$("#ed_date_of_birth_edit").val(date);
				if(relation_type=='others')
				{
					$("#edit_specify_box").css('display','block');
				}
				else
				{
					$("#edit_specify_box").css('display','none');
				}
				$(".add_panel").css("display","none");
				$(".edit_panel").css("display","block");
			}
			function cancel_edit()
			{
				$(".add_panel").css("display","block");
				$(".edit_panel").css("display","none");
			}
			function add_attach_form()
			{
				 $("#add_attach_form").css("display","block");
                 $("#add_attach_button").css("display","none");
			}
			function add_form()
			{
				$("#add_form").css("display","block");
				$("#add_button").css("display","none");
			}
			function cancel_add()
			{
				$("#add_form").css("display","none");
				$("#add_button").css("display","block");
			}
			function relation(id)
			{
				var val=$('#'+id).val();
				if(val=='others')
				{
					$("#specify").css("display","block");
					$("#edit_specify_box").css("display","block");
				}
				else
				{
					$("#specify").css("display","none");
					$("#edit_specify_box").css("display","none");
				}
			}
			</script>