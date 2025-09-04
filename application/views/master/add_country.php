<div id="loader"></div>
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
       <h1>
           Add Country
            <a href="<?php echo admin_path; ?>country"><small class="label label-warning "><i class="fa fa-arrow-circle-left"></i> Go Back<i class="fa fa-left-arrow"></i></small></a>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo admin_path; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo admin_path; ?>country">country</a></li>
            <li class="active">Add Country</li>
          </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
              <div class="box ">
                <div class="box-header">
                  <h3 class="box-title">Add Country</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $message_div; ?>
                  <form role="form" id="add_country" action="<?php echo admin_path; ?>add_country_process" method="post">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="country_name">Country Name</label>
                      <input type="text" required name="country_name" class="form-control" id="country_name" value="<?php echo $form_data['country_name'] ?>" placeholder="Enter Country Name">
                    </div>
                    <div class="form-group">
                      <label for="">Country Code</label>
                      <input type="text" name="country_code" class="form-control"  value="<?php echo $form_data['country_code'] ?>" id="country_code" placeholder="Country Code">
                    </div>
                    <div class="form-group">
                      <label for="">Country Nationality</label>
                      <input type="text" name="country_nationality" class="form-control"  value="<?php echo $form_data['country_nationality'] ?>" id="country_nationality" placeholder="Country Code">
                    </div>
                    <div class="form-group">
                      <label for="">Country Govt Code</label>
                      <input type="text" name="country_gov_code" class="form-control"  value="<?php echo $form_data['country_gov_code'] ?>" id="country_gov_code" placeholder="Country Code">
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

