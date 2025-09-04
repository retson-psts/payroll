<div id="loader"></div>
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
         <h1>
           Add City
            <a href="<?php echo admin_path; ?>city"><small class="label label-warning "><i class="fa fa-arrow-circle-left"></i> Go Back<i class="fa fa-left-arrow"></i></small></a>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo admin_path; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo admin_path; ?>city">city</a></li>
            <li class="active">Add City</li>
          </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
              <div class="box ">
                <div class="box-header">
                  <h3 class="box-title">Add City</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $message_div; ?>
                  <form role="form" id="add_city" action="<?php echo admin_path; ?>add_city_process" method="post">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                  <div class="box-body">
                  <div class="form-group">
                      <label for="country_name">State</label>
                      <select class="form-control" required name="state_id">
                      	<?php echo $state_list; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="country_name">City Name</label>
                      <input type="text" required name="city_name" class="form-control" id="city_name" value="<?php echo $form_data['city_name'] ?>" placeholder="Enter city Name">
                    </div>
                    
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="city_id" value="" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-warning">Cancel</button>
                  </div>
                </form>
                </div><!-- /.box-body -->
              </div>


    </div>
   </div>
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
<!-- Modal -->
