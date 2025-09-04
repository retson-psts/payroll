<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<link href="<?php echo css_path ?>profile-style.css" type="text/css" rel="stylesheet"/>
<div id="loader"></div>
<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Employee profile
         <small>Employee</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="<?php echo site_path; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
         <li><a href="<?php echo site_path; ?>list_employee">Employee</a></li>
         <li class="active">Employee profile</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="profile">
         <div class="col-md-12 segment">
            <div class="col-md-8">
            <a href="<?php echo site_path; ?>edit_employee/employee_photo/<?php echo $employee['employee_id']; ?>" style="    font-size: 20px;  color: #ABA7A7; position: absolute;left: 150px;"><i class="fa fa-pencil-square-o"></i></a>
               <div class="img-profile" <?php if($img!=FALSE){ ?> style="background-image: url('<?php echo site_path; ?>assets/images/user_profile/<?php echo $img['eattach_filename']; ?>')" <?php } ?>></div>
               <div >
                  <h2><?php  echo $employee['emp_firstname']."   ".$employee['emp_middle_name']." ".$employee['emp_lastname']; ?> </h2>
                  <h4><?php echo $employee['emp_number']; ?></h4>
                  <h3><?php  echo $job_details['job_title_name']; ?></h3>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="col-md-4"><?php echo $contact['emp_hm_telephone'] ?>,<br>
               <?php echo $contact['emp_mobile'] ?>&nbsp;<br>
               <?php echo $contact['emp_work_email'] ?>&nbsp;<br>
               <?php echo $contact['emp_contact_temp_street1'] ?>&nbsp;<br>
               <?php echo $contact['emp_contact_temp_street2'] ?>&nbsp;<br>
               <?php echo $contact['emp_contact_temp_city_name'].", ".$contact['emp_contact_temp_provience_name'].", ".$contact['emp_contact_temp_country_name']; ?>&nbsp;<br>
            </div>
         </div>
         <div class="col-md-12 segment">
            <h1>Personal Details <a href="<?php echo  site_path; ?>edit_employee/index/<?php echo $employee_id; ?>" ><i class="fa fa-pencil-square-o"></i></a></h1>
            <div class="btn-group">
               <button type="button" disabled="" class="btn btn-primary">Name</button>
               <button type="button" disabled="" class="btn btn-default">&nbsp;<?php  echo $employee['emp_firstname']."   ".$employee['emp_middle_name']." ".$employee['emp_lastname']; ?></button>
            </div>
            <div class="btn-group">
               <button type="button" disabled="" class="btn btn-primary">Employee Number</button>
               <button type="button" disabled="" class="btn btn-default">&nbsp;<?php echo $employee['emp_number'] ?></button>
            </div>
            <div class="btn-group">
               <button type="button" disabled="" class="btn btn-primary">Other Id</button>
               <button type="button" disabled="" class="btn btn-default">&nbsp;<?php echo $employee['emp_other_id'] ?></button>
            </div>
            <div class="btn-group">
               <button type="button" disabled="" class="btn btn-primary">Licence No</button>
               <button type="button" disabled="" class="btn btn-default">&nbsp;<?php echo $employee['emp_dri_lice_num'] ?></button>
            </div>
            <div class="btn-group">
               <button type="button" disabled="" class="btn btn-primary">Licence Type</button>
               <button type="button" disabled="" class="btn btn-default">&nbsp;<?php echo $employee['licence'] ?></button>
            </div>
            <div class="btn-group">
               <button type="button" disabled="" class="btn btn-primary">Licence Expire Date</button>
               <button type="button" disabled="" class="btn btn-default">&nbsp;<?php echo $employee['licence_exp'] ?></button>
            </div>
            <div class="btn-group">
               <button type="button" disabled="" class="btn btn-primary">Gender</button>
               <button type="button" disabled="" class="btn btn-default">&nbsp;<?php echo $employee['gender'] ?></button>
            </div>
            <div class="btn-group">
               <button type="button" disabled="" class="btn btn-primary">Nationality</button>
               <button type="button" disabled="" class="btn btn-default">&nbsp;<?php echo $employee['nationality'] ?></button>
            </div>
            <div class="btn-group">
               <button type="button" disabled="" class="btn btn-primary">Date of birth</button>
               <button type="button" disabled="" class="btn btn-default">&nbsp;<?php echo $employee['dob'] ?></button>
            </div>
            <div class="btn-group">
               <button type="button" disabled="" class="btn btn-primary">Marital status</button>
               <button type="button" disabled="" class="btn btn-default">&nbsp;<?php echo $employee['marital'] ?></button>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-12 segment">
            <h1>Contact Details <a href="<?php echo  site_path; ?>edit_employee/employee_contact/<?php echo $employee_id; ?>" ><i class="fa fa-pencil-square-o"></i></a></h1>
            <div class="contact">
               <div class="col-md-6">
                  <h3>Basic Details</h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Home Phone</div>
                     <div class="col-xs-8"><?php echo $contact['emp_hm_telephone']; ?>&nbsp;</div>
                     <div class="col-xs-4">Mobile Phone</div>
                     <div class="col-xs-8"><?php echo $contact['emp_mobile']; ?>&nbsp;</div>
                     <div class="col-xs-4">Work Phone</div>
                     <div class="col-xs-8"><?php echo $contact['emp_work_telephone']; ?>&nbsp;</div>
                     <div class="col-xs-4">Work Email</div>
                     <div class="col-xs-8"><?php echo $contact['emp_work_email']; ?>&nbsp;</div>
                     <div class="col-xs-4">Person Email</div>
                     <div class="col-xs-8"><?php echo $contact['emp_oth_email']; ?>&nbsp;</div>
                  </div>
               </div>
               <div class="col-md-6">
                  <h3>Current Address</h3>
                  <div class="">
                     <?php echo $contact['emp_contact_temp_street1']; ?>&nbsp;<br>
                     <?php echo $contact['emp_contact_temp_street2']; ?>&nbsp;<br>
                     <?php echo $contact['emp_contact_temp_city_name']; ?>, <?php echo $contact['emp_contact_temp_provience_name']; ?>, <?php echo $contact['emp_contact_temp_country_name']; ?>&nbsp;<br>
                     <?php echo $contact['emp_contact_temp_pincode']; ?>
                  </div>
               </div>
               <div class="clearfix"></div>
               <div class="col-md-6">
                  <h3>Permenant Address</h3>
                  <div class="">
                     <?php echo $contact['emp_contact_perma_street1']; ?>&nbsp;<br>
                     <?php echo $contact['emp_contact_perma_street2']; ?>&nbsp;<br>
                     <?php echo $contact['emp_contact_perma_city_name']; ?>, <?php echo $contact['emp_contact_temp_provience_name']; ?>, <?php echo $contact['emp_contact_perma_country_name']; ?>&nbsp;<br>
                     <?php echo $contact['emp_contact_perma_pincode']; ?>
                  </div>
               </div>
               <div class="col-md-6">
                  <h3>Other Address</h3>
                  <div class="">
                     <?php echo $contact['emp_contact_other_street1']; ?>&nbsp;<br>
                     <?php echo $contact['emp_contact_other_street2']; ?>&nbsp;<br>
                     <?php echo $contact['emp_contact_other_city_name']; ?>, <?php echo $contact['emp_contact_temp_provience_name']; ?>, <?php echo $contact['emp_contact_other_country_name']; ?>&nbsp;<br>
                     <?php echo $contact['emp_contact_other_pincode']; ?>
                  </div>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-12 segment">
            <h1>Emergency Contact Details  <a href="<?php echo  site_path; ?>edit_employee/employee_emergency/<?php echo $employee_id; ?>" ><i class="fa fa-pencil-square-o"></i></a> </h1>
            <div class="contact eec">
               <?php if($emergency!==FALSE){ 
                  $i=0;
                  foreach($emergency as $key => $value){
                  
                  $i++;
                  
                  ?>
               <div class="col-md-6">
                  <h3> <?php echo $value['eec_name'] ?> - <?php echo $value['eec_relationship'] ?> </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Home Phone</div>
                     <div class="col-xs-8"><?php echo $value['eec_home_no'] ?>&nbsp;</div>
                     <div class="col-xs-4">Mobile Phone</div>
                     <div class="col-xs-8"><?php echo $value['eec_mobile_no'] ?>&nbsp;</div>
                     <div class="col-xs-4">Work Phone</div>
                     <div class="col-xs-8"><?php echo $value['eec_office_no'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <?php
                  if($i%2==0)
                  {
                  ?>
               <div class="clearfix"></div>
               <?php
                  }
                           		 } 
                           		 
                           		 
                           		 } ?>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-12 segment">
            <h1>Dependents <a href="<?php echo  site_path; ?>edit_employee/employee_dependents/<?php echo $employee_id ?>" ><i class="fa fa-pencil-square-o"></i></a></h1>
            <div class="contact eec">
               <?php if($dependents!==FALSE){ 
                  $i=0;
                  foreach($dependents as $key => $value){
                  
                  $i++;
                  
                  ?>
               <div class="col-md-6">
                  <h3> Dependents  </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Name</div>
                     <div class="col-xs-8"><?php echo $value['ed_name']; ?>&nbsp;</div>
                     <div class="col-xs-4">DOB</div>
                     <div class="col-xs-8"><?php echo $value['ed_date_of_birth']; ?>&nbsp;</div>
                     <div class="col-xs-4">Relationship</div>
                     <div class="col-xs-8"><?php echo $value['ed_relationship_type']; ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <?php
                  if($i%2==0)
                  {
                  ?>
               <div class="clearfix"></div>
               <?php
                  }
                           		 } 
                           		 
                           		 
                           		 } ?>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-12 segment">
            <h1>Immigration Details <a href="<?php echo  site_path; ?>edit_employee/employee_immigration/<?php echo $employee_id; ?>" ><i class="fa fa-pencil-square-o"></i></a></h1>
            <div class="contact eec">
               <div class="col-md-6">
                  <h3> Passport Details  </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Passport No</div>
                     <div class="col-xs-8"><?php echo $passport['ep_passport_number'] ?>&nbsp;</div>
                     <div class="col-xs-4">Issued Date</div>
                     <div class="col-xs-8"><?php echo $passport['ep_permit_issuedate'] ?>&nbsp;</div>
                     <div class="col-xs-4">Expiry Date</div>
                     <div class="col-xs-8"><?php echo $passport['ep_permit_expirydate'] ?>&nbsp;</div>
                     <div class="col-xs-4">Issued By</div>
                     <div class="col-xs-8"><?php echo $passport['ep_issued_by'] ?>&nbsp;</div>
                     <div class="col-xs-4">Place Issued</div>
                     <div class="col-xs-8"><?php echo $passport['ep_provience'] ?>&nbsp;</div>
                     <div class="col-xs-4">Comments</div>
                     <div class="col-xs-8"><?php echo $passport['ep_provience'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <div class="col-md-6">
                  <h3> Immigration Details  </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Permit Type</div>
                     <div class="col-xs-8"><?php if($immigration['ei_permit_type']!=8) {echo $immigration['ei_permit_type'];  } else {echo $immigration['ei_specify_permit_type']; }?>&nbsp;</div>
                     <div class="col-xs-4">Quota</div>
                     <div class="col-xs-8"><?php echo $immigration['ei_quota'] ?>&nbsp;</div>
                     <div class="col-xs-4">Yard</div>
                     <div class="col-xs-8"><?php echo $immigration['ei_yard'] ?>&nbsp;</div>
                     <div class="col-xs-4">Permit Number</div>
                     <div class="col-xs-8"><?php echo $immigration['ei_permit_number'] ?>&nbsp;</div>
                     <div class="col-xs-4">Issued Date</div>
                     <div class="col-xs-8"><?php echo $immigration['ei_permit_issuedate'] ?>&nbsp;</div>
                     <div class="col-xs-4">Expiry Date</div>
                     <div class="col-xs-8"><?php echo $immigration['ei_permit_expirydate'] ?>&nbsp;</div>
                     <div class="col-xs-4">Review Date</div>
                     <div class="col-xs-8"><?php echo $immigration['ei_review_date'] ?>&nbsp;</div>
                     <div class="col-xs-4">Comments</div>
                     <div class="col-xs-8"><?php echo $immigration['ei_comments'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-12 segment">
            <h1>Job Details  <a href="<?php echo  site_path; ?>edit_employee/employee_job_details/<?php echo $employee_id; ?>" ><i class="fa fa-pencil-square-o"></i></a></h1>
            <div class="contact eec">
               <div class="col-md-6">
                  <h3> Job Details  </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Joined Date</div>
                     <div class="col-xs-8"><?php echo $job_details['emp_joined_date'] ?>&nbsp;</div>
                     <div class="col-xs-4">Job Title</div>
                     <div class="col-xs-8"><?php echo $job_details['job_title_name']; ?>&nbsp;</div>
                     <div class="col-xs-4">Unit</div>
                     <div class="col-xs-8"><?php echo $job_details['project_title'] ?>&nbsp;</div>
                     <div class="col-xs-4">Location</div>
                     <div class="col-xs-8"><?php echo $job_details['location_name'] ?>&nbsp;</div>
                     <div class="col-xs-4">Annual Leave</div>
                     <div class="col-xs-8"><?php echo $job_details['annual_leave'] ?>&nbsp;</div>
                     <div class="col-xs-4">Sick Leave</div>
                     <div class="col-xs-8"><?php echo $job_details['sick_leave'] ?>&nbsp;</div>
                     <div class="col-xs-4">Employement Contract</div>
                     <div class="col-xs-8"><?php echo $job_details['emp_job_start_date'] ?>&nbsp;- <?php echo $job_details['emp_job_end_date'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-12 segment">
            <h1>Salary Details <a href="<?php echo  site_path; ?>edit_employee/employee_salary/<?php echo $employee_id; ?>" ><i class="fa fa-pencil-square-o"></i></a></h1>
            <div class="contact eec">
               <div class="col-md-6">
                  <h3> Salary details  </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Salary Amount</div>
                     <div class="col-xs-8"><?php echo $salary['emp_salary_amount'] ?>&nbsp;</div>
                     <div class="col-xs-4">Pay Frequency</div>
                     <div class="col-xs-8"><?php echo $salary['emp_salary_pay_period'] ?>&nbsp;</div>
                     <div class="col-xs-4">Comments</div>
                     <div class="col-xs-8"><?php echo $salary['emp_salary_comments'] ?>&nbsp;</div>
                     <div class="col-xs-4">CDAC</div>
                     <div class="col-xs-8"><?php if($salary['emp_salary_cpf']==1){ echo "Yes"; }else{ echo "No"; } ?>&nbsp;</div>
                     <div class="col-xs-4">MBMF</div>
                     <div class="col-xs-8"><?php if($salary['emp_salary_mbmf']==1){ echo "Yes"; }else{ echo "No"; } ?>&nbsp;</div>
                     <div class="col-xs-4">SINDA</div>
                     <div class="col-xs-8"><?php if($salary['emp_salary_sinda']==1){ echo "Yes"; }else{ echo "No"; } ?>&nbsp;</div>
                     <div class="col-xs-4">ECF</div>
                     <div class="col-xs-8"><?php if($salary['emp_salary_ecf']==1){ echo "Yes"; }else{ echo "No"; } ?>&nbsp;</div>
                     <div class="col-xs-4">SHARE</div>
                     <div class="col-xs-8"><?php if($salary['emp_salary_share']==1){ echo "Yes"; }else{ echo "No"; } ?>&nbsp;</div>
                     <div class="col-xs-4">SDL</div>
                     <div class="col-xs-8"><?php if($salary['emp_salary_sdl']==1){ echo "Yes"; }else{ echo "No"; } ?>&nbsp;</div>
                     <div class="col-xs-4">Allowance Available</div>
                     <div class="col-xs-8"><?php if($salary['emp_allowance']==1){ echo "Yes"; }else{ echo "No"; } ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">LEVY</div>
                     <div class="col-xs-8"><?php if($salary['emp_salary_levy']==1){ echo "Yes"; }else{ echo "No"; } ?>&nbsp;</div>
                     <div class="col-xs-4">LEVY Payable</div>
                     <div class="col-xs-8"><?php echo $salary['emp_salary_levy_amt'] ?>&nbsp;</div>
                     <div class="col-xs-4">Per Day</div>
                     <div class="col-xs-8"><?php echo $salary['emp_salary_per_day_hour'] ?>&nbsp;</div>
                     <div class="col-xs-4">Weekly Days</div>
                     <div class="col-xs-8"><?php echo $salary['emp_weekly_days'] ?>&nbsp;</div>
                     
                     <div class="col-xs-4">Overtime Type</div>
                     <div class="col-xs-8"><?php echo $salary['emp_salary_over_time'] ?>&nbsp;</div>
                      <div class="clearfix"></div>
                     <div class="col-xs-4">OT BASE Amount</div>
                     <div class="col-xs-8"><?php echo $salary['emp_ot_base_amount'] ?>&nbsp;</div>
                    
                     <div class="clearfix"></div>
                      <div class="col-xs-4">Fixed Salary</div>
                     <div class="col-xs-8"><?php echo $salary['emp_salary_fixed']?'Yes':'No'; ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-12 segment">
            <h1>Report To <a href="<?php echo  site_path; ?>edit_employee/employee_report/<?php echo $employee_id; ?>" ><i class="fa fa-pencil-square-o"></i></a></h1>
            <div class="contact eec">
            <?php 
             if($emp_supervisors!==FALSE){ 
                  $i=0;
                 
                  foreach($emp_supervisors as $value){
                  
                  $i++;
                  
                  ?>
               <div class="col-md-6">
                  <h3> Supervisors  </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Supervisor Name</div>
                     <div class="col-xs-8"><?php echo $value->emp_firstname." ".$value->emp_lastname."(".$value->emp_number.")"; ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Reporting Method</div>
                     <div class="col-xs-8"><?php echo $value->reporting_method_name; ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
               </div>
                <?php
                  if($i%2==0)
                  {
                  ?>
               <div class="clearfix"></div>
               <?php
                  }
                           		 } 
                           		 
                           		 
                           		 } ?>


				<div class="clearfix"></div>
				<?php
				if($emp_subordinates!==FALSE){ 
                  $i=0;
                 
                  foreach($emp_subordinates as $value){
                  
                  $i++;
                  
                  ?>
               <div class="col-md-6">
                  <h3> Subordinates </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Subordinate Name</div>
                     <div class="col-xs-8"><?php echo $value->emp_firstname." ".$value->emp_lastname."(".$value->emp_number.")"; ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Reporting Method</div>
                     <div class="col-xs-8"><?php echo $value->reporting_method_name; ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
               </div>
                <?php
                  if($i%2==0)
                  {
                  ?>
               <div class="clearfix"></div>
               <?php
                  }
                           		 } 
                           		 
                           		 
                           		 } ?>
               
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-12 segment">
            <h1>Qualification <a href="<?php echo  site_path; ?>edit_employee/employee_qualification/<?php echo $employee_id; ?>" ><i class="fa fa-pencil-square-o"></i></a></h1>
            <div class="contact eec">
             <?php 
            // var_dump($experience);
             if($experience!==FALSE){ 
                  $i=0;
                  
                  foreach($experience as $key => $value){
                  
                  $i++;
                  
                  ?>
               <div class="col-md-6">
               
                  <h3> Experience  </h3>
                  <div class="col-md-12">
                   <div class="col-xs-4">Company Name</div>
                     <div class="col-xs-8"><?php echo $value['eexp_employer'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Title</div>
                     <div class="col-xs-8"><?php echo $value['eexp_jobtit'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Duration</div>
                     <div class="col-xs-8"><?php echo $value['eexp_from_date'] ?> - <?php echo $value['eexp_to_date'] ?> - &nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Comments</div>
                     <div class="col-xs-8"><?php echo $value['eexp_comments'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                    
                  </div>
               </div>
               <?php
                  if($i%2==0)
                  {
                  ?>
               <div class="clearfix"></div>
               <?php
                  }
                           		 } 
                           		 
                           		 
                           		 } ?>
            
            
               <div class="clearfix"></div>
                <?php 
            // var_dump($experience);
             if($education!==FALSE){ 
                  $i=0;
                  
                  foreach($education as $key => $value){
                  
                  $i++;
                  
                  ?>
               <div class="col-md-6">
                  <h3> Educational Qualification  </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Institution Name</div>
                     <div class="col-xs-8"><?php echo $value['emp_edu_institute'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Major / Specialization</div>
                     <div class="col-xs-8"><?php echo $value['emp_edu_major'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Year</div>
                     <div class="col-xs-8"><?php echo $value['emp_edu_year'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">GPA/Score</div>
                     <div class="col-xs-8"><?php echo $value['emp_edu_score'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Duration</div>
                     <div class="col-xs-8"><?php echo $value['emp_edu_start_date'] ?> - <?php echo $value['emp_edu_end_date'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
               </div>
				<?php
                  if($i%2==0)
                  {
                  ?>
               <div class="clearfix"></div>
               <?php
                  }
                           		 } 
                           		 
                           		 
                           		 } ?>
            
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-12 segment">
            <h1>Skills <a href="<?php echo  site_path; ?>edit_employee/employee_skills/<?php echo $employee_id; ?>" ><i class="fa fa-pencil-square-o"></i></a></h1>
            <div class="contact eec">
            
            <?php if($skills!==FALSE){ 
                  $i=0;
                  //var_dump($skills);
                  foreach($skills as $key => $value){
                  
                  $i++;
                  
                  ?>
               <div class="col-md-6">
                  <h3> Skill  </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Skill name</div>
                     <div class="col-xs-8"><?php echo $value['skill_name']; ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Comments</div>
                     <div class="col-xs-8"><?php echo $value['esk_skill_comment']; ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <?php
                  if($i%2==0)
                  {
                  ?>
               <div class="clearfix"></div>
               <?php
                  }
                           		 } 
                           		 
                           		 
                           		 } ?>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="col-md-12 segment">
            <h1>Bank Details  <a href="<?php echo  site_path; ?>edit_employee/employee_bank/<?php echo $employee_id; ?>" ><i class="fa fa-pencil-square-o"></i></a></h1>
            <div class="contact eec">
               <div class="col-md-6">
                  <h3> Bank </h3>
                  <div class="col-md-12">
                     <div class="col-xs-4">Bank Name</div>
                     <div class="col-xs-8"><?php echo $bank['employee_bank_name'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Bank Branch</div>
                     <div class="col-xs-8"><?php echo $bank['employee_bank_branch'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">City</div>
                     <div class="col-xs-8"><?php echo $bank['employee_bank_city'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Account Number</div>
                     <div class="col-xs-8"><?php echo $bank['employee_bank_acc'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">IFSC Code</div>
                     <div class="col-xs-8"><?php echo $bank['employee_bank_ifsc'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                     <div class="col-xs-4">Other Code</div>
                     <div class="col-xs-8"><?php echo $bank['employee_bank_code'] ?>&nbsp;</div>
                     <div class="clearfix"></div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="clearfix"></div>
      </div>
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->
