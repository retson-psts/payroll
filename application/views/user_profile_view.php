<div id="loader"></div>
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
       <h1>
           User Profile
            </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo admin_path; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">User Profile</li>
          </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
              <div class="box ">
                <div class="box-header">
                  <h3 class="box-title">Update Profile</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $message_div; ?>
                  <form role="form" id="add_country" action="<?php echo site_path; ?>user_profile/user_profile_update" method="post">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="country_name">User Name</label>
                      <input type="text" required readonly="readonly" name="username" class="form-control" id="username" value="<?php echo $form_data['username'] ?>" placeholder="Enter Country Name">
                    </div>
                    <div class="form-group">
                      <label for="">Old Password *</label>
                      <input type="password" name="opassword" class="form-control"  value="<?php echo $form_data['opassword'] ?>" id="opassword" placeholder="Old Password">
                    </div>
                    <div class="form-group">
                      <label for="">New Passwrod</label>
                      <input type="password" name="npassword" class="form-control"  value="<?php echo $form_data['npassword'] ?>" id="npassword" placeholder="New Password">
                    </div>
                    <div class="form-group">
                      <label for="">Confirm Password</label>
                      <input type="password" name="cpassword" class="form-control"  value="<?php echo $form_data['cpassword'] ?>" id="cpassword" placeholder="Confirm Password">
                    </div>
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="country_id" value="" class="btn btn-primary">Submit</button>
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

