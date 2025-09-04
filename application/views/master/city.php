            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                      <h1>
           City
            <a href="<?php echo admin_path; ?>add_city"><small class="label bg-aqua small">Add City <i class="fa fa-plus"></i></small></a>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo admin_path; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">City</li>
          </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">City List   <?php if(isset($state_id)){ echo '<span class="label label-success">'.$country_name.'/ '.$state_name.'</span>'; } ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>City</th>
                        <th>State Name</th>
                        <th>Country Name</th>
                        <th>Option</th>
                       </tr>
                    </thead>
                     <tbody>
                   <?php
                    if(!empty($city_list))
                   {
                   	$i=1;
				   	foreach($city_list as  $city)
				   	{
				   		
						?>
						<tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $city['city_name']; ?></td>
                        <td><?php echo $city['state_name']; ?></td>
                        <td><?php echo $city['country_name']; ?></td>
                        <td><a href="<?php echo admin_path."edit_city/".$city['city_id']; ?>"><span class="label label-primary"><i class="fa fa-edit"> </i> View / Edit</span> </a> <a href="<?php echo admin_path."delete_city/".$city['city_id']; ?>"><span class="label label-danger"><i class="fa fa-trash-o"> </i> Delete</span></a> </td>
                        
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
                        <th>City</th>
                        <th>State Name</th>
                        <th>Country Name</th>
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
