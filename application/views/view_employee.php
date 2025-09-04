
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        <?php echo  $employee_details['0']->employee_fname?>'s Details
                        <small> Employee Details</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Employee</a></li>
                        <li class="active">add Employee</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-12">
                            <!-- general form elements -->
                            <div class="box box-primary">
                            	<div class="ajax_reply"></div>
                                <?php echo  $message_div;?>
                                <div class="col-md-2">
                                <?php
									$employee_detail=$employee_details['0'];
									if($employee_details['0']->employee_photo!='')
									{
										$photo_url=user_profile_photo_url.$employee_details['0']->employee_photo;
									}
									elseif($employee_details['0']->gender=='1')
									{
										$photo_url= user_profile_photo_url.'boy.png';
									}
									elseif($employee_details['0']->gender=='2')
									{
										$photo_url=user_profile_photo_url.'girl.png';
									}
									else
									{
										$photo_url=user_profile_photo_url.'boy.png';
									}
								?>
                                    <div class="employee_photo">
                                        <img src="<?php echo $photo_url?>" class="profile_img" id="employee_photo"/>
                                        <form  action="<?php echo  site_path?>employee_profile/add_photo" enctype="multipart/form-data" method="post" id="change_photo">
                                        <input type="hidden" name="employee_id" id="employee_id" value="<?php echo  $employee_detail->emp_id?>"/>
                                        	<div class="form-group">
                                             <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                        	  <input type="file" name="employee_photo" id="employee_photo" class="form-control"/>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="box-footer text-center">
                                                <button type="submit" name="save" class="btn btn-primary text-center" id="update_photo" >Change Photo</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="user_menus vertical-tabs">
                                    	<ul class="nav nav-tabs">
                                            <li class="active"><a href="#form1" data-toggle="tab">Personal Details ></a></li>
                                            <li><a href="#form2" data-toggle="tab">Contact Details ></a></li>
                                            <li><a href="#form3" data-toggle="tab">Job Details ></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                <div class="tab-content">
                                 
                                  <!-- form start -->
                                  <div id="form1" class="tab-pane active">
                                   <div class="box-header">
                                      <h3 class="box-title">Employee's Personal Details</h3>
                                      <?php  //print_r($employee_detail);?>
                                  </div><!-- /.box-header -->
                                  <form role="form" action="<?php echo  site_path?>employee_profile/update_employee_details1" method="post" id="form1">
                                  <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                  <input type="hidden" name="employee_id" id="employee_id" value="<?php echo  $employee_detail->emp_id; ?>"/>
                                      <div class="box-body" >
                                          <div class="form-group col-md-4">
                                              <label for="employee_number">Employee Number/ID *</label>
                                              <input type="text" class="form-control" name="employee_number" id="employee_number" placeholder="Employee Number" value="<?php echo $employee_detail->employee_number ?>">
                                          </div>
                                          <div class="clearfix"></div>
                                           <div class="form-group col-md-4">
                                              <label for="employee_fname">First Name *</label>
                                              <input type="text" class="form-control" name="employee_fname" id="employee_fname" placeholder="Employee First Name" value="<?php echo $employee_detail->employee_fname ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="employee_mname">Middel Name</label>
                                              <input type="text" class="form-control" name="employee_mname" id="employee_mname" placeholder="Employee Middel Name" value="<?php echo $employee_detail->employee_mname ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="employee_lname">Last Name *</label>
                                              <input type="text" class="form-control" name="employee_lname" id="employee_lname" placeholder="Employee Last Name" value="<?php echo $employee_detail->employee_lname ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="gender">Gender</label>
                                              <select class="form-control" name="gender" id="gender">
                                              <?php
											  $gender=$employee_detail->gender;
											  ?>
                                                <option value="1" <?php if($gender==1){ echo "selected='selected'"; } ?>>Male</option>
                                                <option value="2" <?php if($gender==2){ echo "selected='selected'"; } ?>>Female</option>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="nationality">Nationality</label>
                                              <select class="form-control" name="nationality" id="nationality">
                                              <option value="0">-Please Select a Nationality-</option>
                                              <?php
                                              foreach($nationality_list as $country)
                                              {
												  $selected='';
												  if($country->country_id==$employee_detail->nationality)
												  {
													  $selected="selected='selected'";
												  }
                                                  echo '<option value="'.$country->country_id.'" '.$selected.'>'.$country->country_nationality.'</option>';
                                              }
                                              ?>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                          <label id="dob">Date of Birth</label>
                                          <div class="input-group col-md-12">
                                          <div class="col-md-3 full">
                                          	<?php
												$dob=explode('-',$employee_detail->dob);
											?>
                                              <select id="dob_date" name="dob[date]" class="form-control">
                                                  <?php
                                                      for($i=01;$i<=31;$i++)
                                                      {
														  $selected='';
														  if($dob['2']==$i)
														  {
															  $selected="selected='selected'";
														  }
                                                          echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                                                      }
                                                  ?>
                                                </select>
                                                </div>
                                                 <div class="col-md-3 full">
                                                <select id="dob_month" name="dob[month]" class="form-control">
                                                  <?php
                                                      for($j=01;$j<=12;$j++)
                                                      {
														  $selected='';
														  if($dob['1']==$j)
														  {
															  $selected="selected='selected'";
														  }
                                                          echo '<option value="'.$j.'" '.$selected.'>'.$j.'</option>';
                                                      }
                                                  ?>
                                                </select>
                                                </div>
                                                 <div class="col-md-5 full">
                                                <select id="dob_year" name="dob[year]" class="form-control">
                                                  <?php
                                                      for($k=1970;$k<=date('Y');$k++)
                                                      {
														  $selected='';
														  if($dob['0']==$k)
														  {
															  $selected="selected='selected'";
														  }
                                                          echo '<option value="'.$k.'" '.$selected.'>'.$k.'</option>';
                                                      }
                                                  ?>
                                                </select>
                                                </div>
                                               </div>
                                              </div>
                                          <div class="form-group col-md-4">
                                              <label for="employee_mstatus">Marital Status</label>
                                              <select class="form-control" name="employee_mstatus" id="employee_mstatus">
                                                  <option value="1"  <?php if($gender==1){ echo "selected='selected'"; } ?>>Married</option>
                                                  <option value="2"  <?php if($gender==2){ echo "selected='selected'"; } ?>>Single</option>
                                                  <option value="3"  <?php if($gender==3){ echo "selected='selected'"; } ?>>Divorced</option>
                                                  <option value="4"  <?php if($gender==4){ echo "selected='selected'"; } ?>>Widow</option>
                                                  <option value="5"  <?php if($gender==5){ echo "selected='selected'"; } ?>>Widower</option>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="ssn_nric">SSN/NRIC</label>
                                              <input type="text" class="form-control" name="ssn_nric" id="ssn_nric" placeholder="" value="<?php echo $employee_detail->ssn_nric ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="nic">NIC</label>
                                              <input type="text" class="form-control" name="nic" id="nic" placeholder="" value="<?php echo $employee_detail->nic ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="other_id">Other ID</label>
                                              <input type="text" class="form-control" name="other_id" id="other_id" placeholder="" value="<?php echo $employee_detail->other_id ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="driving_liscence">Driving Liscence No</label>
                                              <input type="text" class="form-control" name="driving_liscence" id="driving_liscence" placeholder="" value="<?php echo $employee_detail->driving_liscence ?>">
                                          </div>
                                      </div><!-- /.box-body -->
                                      <div class="clearfix"></div>
                                      <div class="box-footer text-center">
                                          <button type="submit" name="edit" class="btn btn-warning text-center" onclick="edit_form(this);return false;" id="form1">Edit</button>
                                          <button type="submit" name="save" class="btn btn-primary text-center" id="save_form1" onclick="update_user(this.id);return false;">Save</button>
                                      </div>
                                </form>
                                </div>
                                <!--- Form 1 Ends-->
                                <div id="form2" class="tab-pane">
                                <!-- form start -->
                                <form role="form" action="<?php echo  site_path?>employee_profile/update_employee_details2" method="post" id="form2">
                                <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                <input type="hidden" name="employee_id" id="employee_id" value="<?php echo  $employee_detail->employee_id?>"/>
                                    <div class="box-body" >
                                    <?php echo  $message_div ?>
                                        <div class="box-header">
                                          <h3 class="box-title">Employee's Contact Details</h3>
                                         </div>  
                                        <div class="form-group col-md-4">
                                            <label for="home_phone">Home Phone *</label>
                                            <input type="text" class="form-control" name="home_phone" id="home_phone" placeholder="" value="<?php echo $employee_detail->home_phone ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="mobile_phone">Mobile Phone</label>
                                            <input type="text" class="form-control" name="mobile_phone" id="mobile_phone" placeholder="" value="<?php echo $employee_detail->mobile_phone ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="work_phone">Work  Phone</label>
                                            <input type="text" class="form-control" name="work_phone" id="work_phone" placeholder="" value="<?php echo $employee_detail->work_phone ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="work_email">Work Email</label>
                                            <input type="email" class="form-control" name="work_email" id="work_email" placeholder="" value="<?php echo $employee_detail->work_email ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="personal_email">Personal Email</label>
                                            <input type="email" class="form-control" name="personal_email" id="personal_email" placeholder="" value="<?php echo $employee_detail->personal_email ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control" name="city" id="city" placeholder="" value="<?php echo $employee_detail->city ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control" name="country" id="country" placeholder="" value="<?php echo $employee_detail->country ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="provience">Province</label>
                                            <input type="text" class="form-control" name="provience" id="provience" placeholder="" value="<?php echo $employee_detail->provience ?>">
                                        </div>
                                        <div class="form-group col-md-5 warning">
                                            <label for="address1">Address Line1</label>
                                            <input type="text" class="form-control" name="address1" id="address1" placeholder="" value="<?php echo $employee_detail->address1 ?>">
                                         </div>
                                        <div class="form-group col-md-5">
                                           <label for="address2">Address Line2</label>
                                             <input type="text" class="form-control" name="address2" id="address2" placeholder="" value="<?php echo $employee_detail->address2 ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                           <label for="pin_code">Pin Code</label>
                                             <input type="text" class="form-control" name="pin_code" id="pin_code" placeholder="" value="<?php echo $employee_detail->pin_code ?>">
                                        </div>                                           
                                        <div class="clearfix"></div>
                                    </div><!-- /.box-body -->
									<div class="clearfix"></div>
                                    <div class="box-footer text-center">
                                          <button type="submit" name="edit" class="btn btn-warning text-center" onclick="edit_form(this);return false;" id="form2">Edit</button>
                                          <button type="submit" name="save" class="btn btn-primary text-center" id="save_form2" onclick="update_user(this.id);return false;">Save</button>
                                      </div>
                                </form>
                                </div>
                                <div id="form3" class="tab-pane">
                                 <div class="box-header">
                                    <h3 class="box-title">Employee's Job Details</h3>
                                </div>
                                 <!-- form start -->
                                  <form role="form" action="<?php echo  site_path?>employee_profile/update_employee_details3" method="post" id="form3">
                                  <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                  <input type="hidden" name="employee_id" id="employee_id" value="<?php echo  $employee_detail->employee_id?>"/>
                                      <div class="box-body" >
                                           <div class="form-group col-md-4">
                                             <label for="joined_date">Joined Date</label>
                                             <div class="input-group col-md-12">
                                               <div class="col-md-3 full">
                                               <?php
												$joined_date=explode('-',$employee_detail->join_date);
												?>
                                               <select id="joined_date_date" name="joined_date[date]" class="form-control">
                                                    <?php
                                                        for($i=01;$i<=31;$i++)
                                                      	{
														  $selected='';
														  if($joined_date['2']==$i)
														  {
															  $selected="selected='selected'";
														  }
                                                          echo '<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
                                                      	}
                                                    ?>
                                                  </select>
                                                  </div>
                                                   <div class="col-md-3 full">
                                                  <select id="joined_date_month" name="joined_date[month]" class="form-control">
                                                    <?php
                                                        for($j=01;$j<=12;$j++)
														{
															$selected='';
															if($joined_date['1']==$j)
															{
																$selected="selected='selected'";
															}
															echo '<option value="'.$j.'" '.$selected.'>'.$j.'</option>';
														}
                                                    ?>
                                                  </select>
                                                  </div>
                                                   <div class="col-md-5 full">
                                                  <select id="joined_date_year" name="joined_date[year]" class="form-control">
                                                    <?php
                                                        for($k=1970;$k<=date('Y');$k++)
														{
															$selected='';
															if($joined_date['0']==$k)
															{
																$selected="selected='selected'";
															}
															echo '<option value="'.$k.'" '.$selected.'>'.$k.'</option>';
														}
                                                    ?>
                                                  </select>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="department">Department</label>
                                               <input type="text" class="form-control" name="department" id="department" placeholder="" value="<?php echo $employee_detail->department ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="suprevisor">Suprevisor</label>
                                               <input type="text" class="form-control" name="suprevisor" id="suprevisor" placeholder="" value="<?php echo $employee_detail->suprevisor ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="annual_salary">Annual Salary *</label>
                                               <input type="text" class="form-control" name="annual_salary" id="annual_salary" placeholder="" value="<?php echo $employee_detail->annual_salary ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="cpf_status">CPF</label>
                                             <select class="form-control" name="cpf_status" id="cpf_status">
                                                  <option value="1" <?php if($employee_detail->cpf_status==1){ echo "selected='selected'"; } ?>>YES</option>
                                                  <option value="2" <?php if($employee_detail->cpf_status==2){ echo "selected='selected'"; } ?>>NO</option>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="insurance">Insurance</label>
                                             <input type="text" class="form-control" name="insurance" id="insurance" placeholder="" value="<?php echo $employee_detail->insurance ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="levy_status">LEVY</label>
                                             <select class="form-control" name="levy_status" id="levy_status">
                                                  <option value="1" <?php if($employee_detail->levy_status==1){ echo "selected='selected'"; } ?>>YES</option>
                                                  <option value="2" <?php if($employee_detail->levy_status==2){ echo "selected='selected'"; } ?>>NO</option>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="employement_status">Employment Status</label>
                                             <select class="form-control" name="employement_status" id="employement_status">
                                                  <option value="1" <?php if($employee_detail->employement_status==1){ echo "selected='selected'"; } ?>>Full Time</option>
                                                  <option value="2" <?php if($employee_detail->employement_status==2){ echo "selected='selected'"; } ?>>Part Time</option>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-4">
                                            <label for="employement_status">Enable Login</label>
                                             <select class="form-control" name="enable_login" id="enable_login">
                                                  <option value="0" <?php  if($employee_detail->username==NULL) { echo "selected='selected'"; } ?>>No</option>
                                                  <option value="1" <?php  if($employee_detail->username!=NULL) { echo "selected='selected'"; } ?>>Yes</option>
                                              </select>
                                          </div>
                                      <div class="clearfix"></div>
                                      <?php
									  if($employee_detail->username==NULL)
									  {
										  $login='style="display:none"';
									  }
									  else
									  {
										  $login='style="display:block"';
									  }
									  ?>
                                      <div class="col-md-6" id="login_details" <?php echo  $login;?>>
                                          <div class="box-header">
                                              <h3 class="box-title">Login Details</h3>
                                          </div><!-- /.box-header -->
                                          <div class="form-group col-md-4">
                                             <label for="employement_status">Username *</label>
                                             <input type="text" class="form-control" name="username" id="username" placeholder="" value="<?php echo $employee_detail->username ?>">
                                          </div>
                                          <div class="form-group col-md-4">
                                             <label for="employement_status">Password *</label>
                                             <input type="password" class="form-control" name="password" id="password" placeholder="" >
                                          </div>
                                      </div>
                                      <div class="clearfix"></div>
                                      </div><!-- /.box-body -->
                                     <div class="box-footer text-center">
                                          <button type="submit" name="edit" class="btn btn-warning text-center" onclick="edit_form(this);return false;" id="form3">Edit</button>
                                          <button type="submit" name="save" class="btn btn-primary text-center" id="save_form3" onclick="update_user(this.id);return false;">Save</button>
                                      </div>
                                  </form>
								</div>
                                </div>
                                </div>
                            </div><!-- /.box -->

                            <!-- Form Element sizes -->
                           
                        </div><!--/.col (left) -->
                        <!-- right column -->
                        <!--/.col (right) -->
                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
            <script type="text/javascript">
				$('.tab-content').find('input, textarea, select').attr('disabled','disabled');
				$("#save_form").attr('disabled','disabled');
				function edit_form(button)
				{
					//alert(button.id);
					$("#"+button.id).find('input, textarea, select').removeAttr('disabled');
					//$("#"+button.id+"#save").attr('disabled','disabled');
					$("#save_form").removeAttr('disabled');
					//.removeAttr()
				}
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
			function update_user(form_id)
			{
				var id=form_id.substr(form_id.length - 1);
				 var form_name = "#form"+id;
				 var url = "<?php echo site_path;?>employee_profile/update_employee_details"+id;
				 $.ajax({
				   type: "post",
				   url: url,
				   data: $('form'+form_name).serialize(),
				   dataType: "json",
				   success: function(msg){
					  if(msg.status=="1")
					  {
						  $(".ajax_reply").html(msg.message);
					  }
					  else
					  {
						  $(".ajax_reply").html("Oops! Somethoing Went Wrong.Please Try Again");
					  }
					  return false;
					},
			  });
			}
			</script>