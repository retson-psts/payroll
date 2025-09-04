<div id="loader"></div>
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
         <h1>
           Edit State
            <a href="<?php echo admin_path; ?>state"><small class="label label-warning "><i class="fa fa-arrow-circle-left"></i> Go Back<i class="fa fa-left-arrow"></i></small></a>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo admin_path; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo admin_path; ?>state">state</a></li>
            <li class="active">Edit State</li>
          </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
              <div class="box ">
                <div class="box-header">
                  <h3 class="box-title">Edit State</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $message_div; ?>
                  <form role="form" id="edit_state" action="<?php echo admin_path; ?>edit_state_process" method="post">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                  <div class="box-body">
                  <div class="form-group">
                      <label for="country_name">Country</label>
                      <select class="form-control" required name="country_id">
                      	<?php echo $country_list; ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="country_name">State Name</label>
                      <input type="text" required name="state_name" class="form-control" id="state_name" value="<?php echo $form_data['state_name'] ?>" placeholder="Enter state Name">
                    </div>
                    
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="state_id" value="<?php echo $form_data['state_id'] ?>" class="btn btn-primary">Submit</button>
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
