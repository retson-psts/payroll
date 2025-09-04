           <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Leave Reports 
                        <small>Leave reports</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i> Reports</a></li>
                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <?php echo $message_div ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-warning">
                                <div class="box-header">
                                 <?php
								if(!isset($project_id))
								{
								?>
                                <h3 class="box-title">Add Project</h3>                                    
                                </div><!-- /.box-header -->
                                <form role="form" action="<?php echo  site_path?>projects/add" method="post">
                                      <div class="box-body">
                                         <div class="add_form" <?php if($status==1){ ?> style="display:none" <?php  } ?>>
                                            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                            <div class="form-group col-md-4">
                                                <label for="project_title">Project Title *</label>
                                                <input type="text" class="form-control" value="<?php echo  $form_data['project_title'] ?>" name="project_title" id="project_title" placeholder="Enter Project Title">
                                            </div>
                                             <div class="form-group col-md-4">
                                                <label for="project_description">Project Description</label>
                                                <textarea name="project_description" class="form-control" ><?php echo  $form_data['project_description'] ?></textarea>
                                            </div>
                                           
                                            <div class="clearfix"></div>
                                         </div>
                                      </div><!-- /.box-body -->
                                    <div class="box-footer">
                                    	<div id="add_cat" <?php if($status==0){ ?> style="display:none" <?php  } ?>>
                                            <button type="submit" name="submit" class="btn btn-primary text-center" id="add" onclick="add_cat(); return false;">Add Projects</button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="cat_save" <?php if($status==1){ ?> style="display:none" <?php  } ?>>
                                        	<button type="submit" name="submit" class="btn btn-primary text-center" id="save">Save Project</button>
                                            <button type="submit" name="submit" class="btn btn-danger text-center" id="cancel" onclick="cancel_btn(); return false;">Cancel</button>
                                        </div>
                                    </div>
                               </form>
                               <?php
								}
								else
								{
								?>
								<h3 class="box-title">Edit Project Details</h3>                                    
                                </div><!-- /.box-header -->
                                <form role="form" action="<?php echo  site_path?>projects/update_job" method="post">
                                      <div class="box-body">
                                         <div class="add_form" >
                                            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                            <input type="hidden" value="<?php echo  $form_data['project_id'] ?>" id="project_id" name="project_id"/>
                                            <div class="form-group col-md-4">
                                                <label for="job_title">Project Title *</label>
                                                <input type="text" class="form-control" name="project_title" id="project_title" placeholder="project title" value="<?php echo  $form_data['project_title'] ?>">
                                            </div>
                                             <div class="form-group col-md-4">
                                                <label for="project_description">Project Description</label>
                                                <textarea name="project_description" class="form-control" ><?php echo  $form_data['project_description'] ?></textarea>
                                            </div>
                                            <div class="clearfix"></div>
                                      </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <div class="clearfix"></div>
                                        <div class="cat_save">
                                        	<button type="submit" name="submit" class="btn btn-primary text-center" id="save">Save Projects</button>
                                            <button type="submit" name="submit" class="btn btn-danger text-center" id="cancel">Cancel</button>
                                        </div>
                                    </div>
                               </form>
								<?php
								}
                               ?>
                             </div>
                             <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Projects List</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Projects</th>
                                                <th>Project Description</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											if($project_list!=false)
											{
												$i=1;
												foreach($project_list as $project)
												{
													echo '<tr><td>'.$i.'</td><td>'.$project->project_title.'</td><td>'.$project->project_description.'</td>';
													  echo '<td><a href="'.site_path.'projects/edit/'.$project->project_id.'"><span class="label label-primary"><i class="fa fa-edit"> </i> View / Edit</span></a> <a href="'.site_path.'projects/location/'.$project->project_id.'"><span class="label label-default"><i class="fa fa-plus"> </i> Add location</span></a>  <a href="#"><span class="label label-warning"><i class="fa fa-trash-o"> </i> Delete</a></span></td></tr>';
													$i++;
												}
											}
										?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Projects</th>
                                                <th>Project Description</th>
                                                <th>Options</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        
		<script src="<?php echo  js_path?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo  js_path?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>      
        
         <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
			$("#enable_login").change(function() {
				var enable_login=$("#enable_login").val();
				if(enable_login==1)
				{
					$("#login_details").css("");
					$("#login_details").css("display","block");
				}
				else
				{
					$("#login_details").css("");
					$("#login_details").css("display","none");
				}
			});
			function add_cat()
			{
				$(".add_form").css("display","block");$(".cat_save").css("display","block");$("#add_cat").css("display","none");
				return false;
			}
			function cancel_btn()
			{
				$(".add_form").css("display","none");$(".cat_save").css("display","none");$("#add_cat").css("display","block");
				return false;
			}
			</script>