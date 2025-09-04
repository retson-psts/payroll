           <aside class="right-side">                
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
                     
                        <div class="col-xs-6 col-md-offset-3">
                       
                        <div class="box-header">
                        <h3 class="box-title">Select Date</h3>                                    
                                </div>
                                <form role="form" action="<?php echo  site_path?>employee_jobsheet/date_jobsheet" method="post">
                                 <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                      <div class="box-body">
                                         <div class="add_form" >
                                            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                            <div class="form-group col-md-6">
                                                <label for="jobsheet_date">Please Give the date *</label>
                                                <input type="text" class="form-control date" value="<?php echo  $form_data['jobsheet_date'] ?>" name="jobsheet_date" id="jobsheet_date" placeholder="Please Fill Date">
                                            </div>
                                           
                                           
                                            <div class="clearfix"></div>
                                         </div>
                                      </div><!-- /.box-body -->
                                    
                                        <div class="cat_save" >
                                        	<button type="submit" name="submit" class="btn btn-primary text-center" id="save">Set Date</button>
                                            <button type="reset" name="submit" class="btn btn-danger text-center" id="cancel">Cancel</button>
                                        </div>
                                    
                               </form>
                           </div>
                           
                           
            </div>
	
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
		<script src="<?php echo  js_path?>plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo  js_path?>plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>      
        
         <script type="text/javascript">
         
         $(document).ready(function(){
         	$('.date').datepicker({
					format: "yyyy-mm-dd",
					minDate: '0'
				});
			});
			</script>