           <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Projects
                        <small>Job Title</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i> Job</a></li>
                        <li class="active">Job Title</li>
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
								if(!isset($job_id))
								{
								?>
                                <h3 class="box-title">Add Project</h3>                                    
                                </div><!-- /.box-header -->
                                <form role="form" action="<?php echo  site_path?>job_titles/add" method="post">
                                      <div class="box-body">
                                         <div class="add_form" style="display:none">
                                            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                            <div class="form-group col-md-4">
                                                <label for="project_title">Project Title *</label>
                                                <input type="text" class="form-control" name="project_title" id="project_title" placeholder="Enter Project Title">
                                            </div>
                                             <div class="form-group col-md-4">
                                                <label for="project_description">Project Description</label>
                                                <textarea name="project_description" class="form-control" ></textarea>
                                            </div>
                                           
                                            <div class="clearfix"></div>
                                         </div>
                                      </div><!-- /.box-body -->
                                    <div class="box-footer">
                                    	<div id="add_cat">
                                            <button type="submit" name="submit" class="btn btn-primary text-center" id="add" onclick="add_cat(); return false;">Add Job Title</button>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="cat_save" style="display:none">
                                        	<button type="submit" name="submit" class="btn btn-primary text-center" id="save">Save Job Title</button>
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
                                <form role="form" action="<?php echo  site_path?>job_titles/update_job" method="post">
                                      <div class="box-body">
                                         <div class="add_form" >
                                            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                            <input type="hidden" value="<?php echo  $job_details['0']->job_title_id ?>" id="job_id" name="job_id"/>
                                            <div class="form-group col-md-4">
                                                <label for="job_title">Job Title Name *</label>
                                                <input type="text" class="form-control" name="job_title" id="job_title" placeholder="Job Title Name" value="<?php echo  $job_details['0']->job_title_name; ?>">
                                            </div>
                                            <div class="form-group col-md-4">
                                            <label for="employement_status">Enable Login</label>
                                             <select class="form-control" name="job_cat" id="job_cat">
                                                  <?php
												  if($cat_job_list!=false)
												  {
													  //print_r($cat_job_list);
													  foreach($cat_job_list as $cat)
													  {
														  $select="";
														  if($cat->job_category_id==$job_details['0']->job_title_category)
														  {
															   $select="selected='selected'";
														  }
														  echo '<option value="'.$cat->job_category_id.'" '.$select.'>'.$cat->job_category_name.'</option>';
													  }
												  }
												  else
												  {
													  echo '<option>Please Add A Category</option>';
												  }
												  ?>
                                              </select>
                                           </div>
                                            <div class="clearfix"></div>
                                      </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <div class="clearfix"></div>
                                        <div class="cat_save">
                                        	<button type="submit" name="submit" class="btn btn-primary text-center" id="save">Save Category</button>
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
                                    <h3 class="box-title">Job Category List</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Job Name</th>
                                                <th>Category Name</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											if($job_title_list!=false)
											{
												$i=1;
												foreach($job_title_list as $job_title)
												{
													echo '<tr><td>'.$i.'</td><td>'.$job_title->job_title_name.'</td><td>'.$job_title->job_category_name.'</td>';
													  echo '<td><a href="'.site_path.'job_titles/edit/'.$job_title->job_title_id.'"><span class="label label-primary"><i class="fa fa-edit"> </i> View / Edit</span></a>  <a href="#"><span class="label label-warning"><i class="fa fa-trash-o"> </i> Delete</a></span></td></tr>';
													$i++;
												}
											}
										?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Job Name</th>
                                                <th>Category Name</th>
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