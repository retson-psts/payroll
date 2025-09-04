<div id="loader"></div>
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
       <h1>
           Add Skill
            <a href="<?php echo admin_path; ?>skills"><small class="label label-warning "><i class="fa fa-arrow-circle-left"></i> Go Back<i class="fa fa-left-arrow"></i></small></a>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo admin_path; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo admin_path; ?>skills">skill</a></li>
            <li class="active">Add Skill</li>
          </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
              <div class="box ">
                <div class="box-header">
                  <h3 class="box-title">Add Skill</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                <?php echo $message_div; ?>
                  <form role="form" id="add_skill" action="<?php echo admin_path; ?>add_skill_process" method="post">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo $this->security->get_csrf_hash(); ?>"/>
                  <div class="box-body">
                    <div class="form-group">
                      <label for="skill_name">Skill Name</label>
                      <input type="text" required name="skill_name" class="form-control" id="skill_name" value="<?php echo $form_data['skill_name'] ?>" placeholder="Enter Skill Name">
                    </div>
                    <div class="form-group">
                      <label for="skill_description">Skill Description</label>
                      <textarea name="skill_description" class="form-control"><?php echo $form_data['skill_description'] ?></textarea>
                     
                    </div>
                    
                    
                  </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" name="skill_id" value="" class="btn btn-primary">Submit</button>
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

