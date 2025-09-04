            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                     <h1>
           Country
            <a href="<?php echo admin_path; ?>add_country"><small class="label bg-aqua small">Add Country <i class="fa fa-plus"></i></small></a>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo admin_path; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Countries</li>
          </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Country list</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $message_div; ?>
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Country Name</th>
                        <th>Country Code</th>
                        <th>Option</th>
                       </tr>
                    </thead>
                     <tbody>
                   <?php if(!empty($country_list))
                   {
                   	$i=1;
				   	foreach($country_list as  $country)
				   	{
				   		
						?>
						<tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $country['country_name']; ?></td>
                        <td><?php echo $country['country_code']; ?></td>
                        <td><a href="<?php echo admin_path."edit_country/".$country['country_id']; ?>"><span class="label label-primary"><i class="fa fa-edit"> </i> View / Edit</span> </a> <a href="<?php echo admin_path."delete_country/".$country['country_id']; ?>"><span class="label label-danger"><i class="fa fa-trash-o"> </i> Delete</span></a> <a href="<?php echo admin_path."state/".$country['country_id']; ?>"><span class="label label-success"><i class="fa fa-tag"> </i> View States</span></a></td>
                        
                      </tr>
						<?php
						$i++;
					}
				   }
                    ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Country Name</th>
                        <th>Country Code</th>
                        <th>Option</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div>


    </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        
		<script src="<?php echo  js_path?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo  js_path?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>      
        
         <script type="text/javascript">
            $(function() {
                $("#example2").dataTable();
                
            });
        </script>