           <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Location
                        <small>Location</small>
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
                        <div class="col-xs-12">
                            <div class="box box-warning">
                                <div class="box-header">
                                 <?php
								if(isset($project_id))
								{
								?>
                                <h3 class="box-title">Location</h3>                                    
                                </div><!-- /.box-header -->
                                <form role="form" action="<?php echo  site_path?>projects/location_add" method="post">
                               <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                <input type="hidden" name="project_id" value="<?php echo  $project_id ?>">
                                      <div class="box-body">
                                      <a class="btn btn-warning text-center"  href="javascript:void(0);" onclick="add_more()">Add more</a>
                                      <table  id="ddd" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	
                                                <th>Location</th>
                                                <th>Location Details</th>
                                                <th>Options</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
											if($location_list!=false)
											{
												$i=1;
												foreach($location_list as $location)
												{
													echo '<tr><td><input type="hidden" name="location_id[]" value="'.$location->location_id.'"><input type="text" class="form-control" required name="location_name[]" value="'.$location->location_name.'"/></td><td><input type="text" class="form-control" name="location_details[]" value="'.$location->location_details.'"/></td>';
													  echo '<td><a href="'.site_path.'projects/delete_location/'.$location->location_id.'/'.$project_id.'"><span class="label label-primary"><i class="fa fa-trash-o"> </i> delete</span></a> </td></tr>';
													$i++;
												}
											}
										?>
                                        <tr>
                                        <td><input type="text" name="location1_name[]" class="form-control" value="" required></td>
                                        <td><input type="text" name="location1_details[]" class="form-control" value="" ></td>
                                        <td><a href="#" onclick="" class="remove" ><span class="label label-danger"><i class="fa fa-trash-o"> </i> delete</span></a> </td></tr>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                
                                                 <th>Location</th>
                                                <th>Location Details</th>
                                                <th>Options</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                         <?php /*?><div class="add_form" >
                                            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                           <div class="form_location"> <div class="form-group col-md-4">
                                                <label for="location_title">Location Name*</label>
                                                <input type="text" required class="form-control" value="<?php echo  $form_data['project_title'] ?>" name="location_title[]"  placeholder="Enter Project Title">
                                            </div>
                                             <div class="form-group col-md-4">
                                                <label for="project_description">Location Details</label>
                                                <textarea name="location_details" class="form-control" ><?php echo  $form_data['project_description'] ?></textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                            <label for="project_description">&nbsp;</label>
                                            <a href="#" onclick="remove1(this)"><span class="label label-danger"><i class="fa fa-cross"> </i> Remove</span></a> 
                                            </div><?php */?>
                                            </div>
                                           
                                            <div class="clearfix"></div>
                                         
                                    <div class="box-footer">
                                    	
                                        <div class="clearfix"></div>
                                        <div class="cat_save" >
                                        	<button type="submit" name="submit" class="btn btn-primary text-center" id="save">Save location</button>
                                            <button type="submit" name="submit" class="btn btn-danger text-center" id="cancel" onclick="cancel_but(this)">Cancel</button>
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
			$('.remove').click(function(){
				$(this).parents('tr').remove();
				});
				function add_more()
				{
					$("#ddd").append('<tr><td><input type="text" name="location1_name[]" class="form-control" value="" required></td><td><input type="text" name="location1_details[]" class="form-control" value="" ></td><td><a href="#" onclick="" class="remove" ><span class="label label-danger"><i class="fa fa-trash-o"> </i> delete</span></a> </td></tr>');
					$('.remove').click(function(){
				$(this).parents('tr').remove();
				});
				}
				function cancel_but(e)
				{
					e.prevent_default();
					window.location="";
				}
			
			
			
			</script>