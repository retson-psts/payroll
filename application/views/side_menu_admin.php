<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
$user_info=$this->session->userdata['logged_in'];
$company_info=$this->session->userdata['company'];
//var_dump($this->session->userdata('logged_in'));
if(!isset($menu))
{
	$menu=0;
	$menu1=0;
}
if($user_info=$this->session->userdata['logged_in']['group_id']==1 || $user_info=$this->session->userdata['logged_in']['group_id']==3)
{
	
	



?>
<aside class="left-side sidebar-offcanvas <?php if(isset($left_menu) && $left_menu==0){ echo "collapse-left";  } ?>">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <!--- yuvaraj edited hidden userpanel -->
                    <!--<div class="user-panel">
                    
                        <div class="pull-left image">
                            <img src="<?php echo  img_path ?>avatar04.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, Admin<?php $user_info['first_name'] ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                        
                     
                    </div>-->
                    <div class="clearfix"></div>
                    <!--- yuvaraj edited hidden Company logo here -->
                         <div class="company_logo"><img src="<?php echo  images_path ?><?php echo $company_info['company_logo']; ?>" class="side-logo" style="margin:0 auto; padding: 11px;width:150px; "/>
                         <!--Dream werkz Technologies--></div>
                    <!-- search form -->
                    <!--- yuvaraj edited hidden Search Not needed for this -->
                    <!--<form action="#" method="get" class="sidebar-form">					
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                   <ul class="sidebar-menu">
                        <li class="<?php if($menu==1){ echo 'active'; } ?>">
                            <a href="<?php echo  site_path?>">
                                <i class="ico ico-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview <?php if($menu==2){ echo 'active'; } ?>">
                            <a href="#">
                                <i class="ico  ico-employee"></i>
                                <span>Employees</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php if($menu1==21){ echo 'active'; } ?>"><a href="<?php echo  site_path?>add_employee/"><i class="ico ico-add-employee"></i>Add Employees</a></li>
                                <li class="<?php if($menu1==22){ echo 'active'; } ?>"><a href="<?php echo  site_path?>list_employee/"><i class="ico ico-employees"></i>Employee List</a></li>
                            </ul>
                        </li>
                        <li class="treeview <?php if($menu==3){ echo 'active'; } ?>">
                            <a href="#">
                                <i class="ico ico-jobsheet"></i>
                                <span>Job sheets</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php if($menu1==31){ echo 'active'; } ?>"><a href="<?php echo  site_path?>jobsheet/"><i class="ico ico-add-jobsheet"></i>Add Job sheets</a></li>
                                <li class="<?php if($menu1==32){ echo 'active'; } ?>"><a href="<?php echo  site_path?>ot_add/"><i class="ico ico-add-jobsheet"></i>Add OT for fixed salary</a></li>
                               <!-- <li><a href="<?php echo  site_path?>veiew_jobsheet/"><i class="fa fa-list-alt"></i>View Job Sheet</a></li>-->
                            </ul>
                        </li>
                        <li class="treeview <?php if($menu==4){ echo 'active'; } ?>">
                            <a href="#">
                                <i class="ico ico-allowance"></i>
                                <span>Allowances</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php if($menu1==41){ echo 'active'; } ?>"><a href="<?php echo  site_path?>allowance/"><i class="ico ico-allowances"></i>Allowances</a></li>
                                <li class="<?php if($menu1==42){ echo 'active'; } ?>"><a href="<?php echo  site_path?>allowance/allowance_request"><i class="ico ico-allowance"></i>Requests</a></li>
                            </ul>
                        </li>
                         <li class="treeview <?php if($menu==20){ echo 'active'; } ?>">
                            <a href="#">
                                <i class="ico ico-allowance"></i>
                                <span>Deductions</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                            	 <li class="<?php if($menu1==202){ echo 'active'; } ?>"><a href="<?php echo  site_path?>deduction/all_deduction"><i class="ico ico-allowance"></i> Deductions</a></li>
                                <li class="<?php if($menu1==201){ echo 'active'; } ?>"><a href="<?php echo  site_path?>deduction"><i class="ico ico-allowances"></i>Add Deductions</a></li>
                               
                            </ul>
                        </li>
                        <li class="treeview<?php if($menu==5){ echo 'active'; } ?>">
                            <a href="#">
                                <i class="ico ico-allowance"></i>
                                <span>Leaves</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php if($menu1==5){ echo 'active'; } ?>"><a href="<?php echo  site_path?>leave_requests/"><i class="ico ico-leave"></i>Leave Request</a></li>
                                <li class="<?php if($menu1==52){ echo 'active'; } ?>"><a href="<?php echo  site_path?>leave_for_fixed_salary"><i class="ico ico-leave"></i>Add leave fixed salary</a></li>
                            </ul>
                        </li>
                        <!--<li class="<?php if($menu==5){ echo 'active'; } ?>">
                            <a href="<?php echo  site_path?>leave_requests">
                                <i class="ico ico-leave"></i> <span>Leave Request</span>
                            </a>
                        </li>-->
                        <li class="treeview <?php if($menu==6){ echo 'active'; } ?>">
                            <a href="#">
                                <i class="ico ico-report"></i>
                                <span>Reports</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php if($menu1==61){ echo 'active'; } ?>"><a href="<?php echo  site_path?>reports/salary/"><i class="fa fa-plus"></i>Employee Salary Reports</a></li>
                                <li class="<?php if($menu1==62){ echo 'active'; } ?>"><a href="<?php echo  site_path?>reports/leave/"><i class="fa fa-plus"></i>Leave Reports</a></li>
                                <li class="<?php if($menu1==63){ echo 'active'; } ?>"><a href="<?php echo  site_path?>reports/day_leave"><i class="fa fa-plus"></i>Day wise Leave Reports</a></li>
                                <li class="<?php if($menu1==64){ echo 'active'; } ?>"><a href="<?php echo  site_path?>reports/Ot_report"><i class="fa fa-plus"></i>OT Report</a></li>
                                <li class="<?php if($menu1==65){ echo 'active'; } ?>"><a href="<?php echo  site_path?>reports/allowance/"><i class="fa fa-plus"></i>Allowance Report</a></li>
                                <!--<li class="<?php if($menu1==66){ echo 'active'; } ?>"><a href="<?php echo  site_path?>reports/leave_request"><i class="fa fa-plus"></i>Leave Request Report</a></li>-->
                                <li class="<?php if($menu1==67){ echo 'active'; } ?>"><a href="<?php echo  site_path?>reports/project_wise"><i class="fa fa-plus"></i>Project Wise Report</a></li>
                              <!--  <li class="<?php if($menu1==68){ echo 'active'; } ?>"><a href="<?php echo  site_path?>reports/expense"><i class="fa fa-plus"></i>Expense Reports</a></li>-->
                               <!-- <li><a href="<?php echo  site_path?>veiew_jobsheet/"><i class="fa fa-list-alt"></i>View Job Sheet</a></li>-->
                            </ul>
                        </li>
                        <!--<li class"<?php if($menu==7){ echo 'active'; } ?>">
                            <a href="<?php echo  site_path?>claim_requests">
                                <i class="fa ion-pull-request"></i> <span>Claim Request</span>
                            </a>
                        </li>-->
                        <li class="<?php if($menu==8){ echo 'active'; } ?>">
                            <a href="<?php echo  site_path?>monthly_salary_slip">
                                <i class="ico ico-salary-slip"></i> <span>Salary Slips</span>
                            </a>
                        </li>
						<li class="treeview <?php if(($menu>8 && $menu < 16) || $menu==21 || $menu==23 ){ echo 'active'; }  ?>">
                            <a href="#">
                                <i class="ico ico-setting"></i>
                                <span>Settings</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview <?php if($menu==10){ echo 'active'; } ?>">
                            <a href="#">
                                <i class="ico ico-job"></i>
                                <span>Job</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php if($menu1==101){ echo 'active'; } ?>"><a href="<?php echo  site_path?>job_titles/"><i class="ico ico-job1"></i>Job Titles</a></li>
                                <li class="<?php if($menu1==102){ echo 'active'; } ?>"><a href="<?php echo  site_path?>job_category/"><i class="ico ico-job2"></i>Job Category</a></li>
                            </ul>
                        </li>
								<li class="treeview <?php if($menu==11){ echo 'active'; } ?>">
		                            <a href="#">
		                                <i class="ico ico-project"></i>
		                                <span>Project</span>
		                                <i class="fa fa-angle-left pull-right"></i>
		                            </a>
		                            <ul class="treeview-menu">
		                                <li class="<?php if($menu1==111){ echo 'active'; } ?>"><a href="<?php echo  site_path?>projects/"><i class="ico ico-projects"></i>Projects</a></li>
		                                <li class="<?php if($menu1==112){ echo 'active'; } ?>"><a href="<?php echo  site_path?>locations/"><i class="ico ico-projects"></i>Location</a></li>
		                            </ul>
                        		</li>
                        		<li class="treeview <?php if($menu==12){ echo 'active'; } ?>">
		                            <a href="#">
		                                <i class="ico ico-company"></i>
		                                <span>Company Profile</span>
		                                <i class="fa fa-angle-left pull-right"></i>
		                            </a>
		                            <ul class="treeview-menu">
		                             <!--   <li class="<?php if($menu1==121){ echo 'active'; } ?>"><a href="<?php echo  site_path?>company/"><i class="ico ico-company1"></i>Company</a></li>-->
		                                <li class="<?php if($menu1==122){ echo 'active'; } ?>"><a href="<?php echo  site_path?>bank/"><i class="ico ico-government1"></i>Bank</a></li>
		                                 <li class="<?php if($menu1==123){ echo 'active'; } ?>"><a href="<?php echo  site_path?>company/ir8asettings"><i class="ico ico-company1"></i>IR8A Settings</a></li>
		                                 <li class="<?php if($menu1==124){ echo 'active'; } ?>"><a href="<?php echo  site_path?>company/giro_setup"><i class="ico ico-company1"></i>GIRO Setup</a></li>
		                                 <li class="<?php if($menu1==125){ echo 'active'; } ?>"><a href="<?php echo  site_path?>company/csn_setup"><i class="ico ico-company1"></i>CSN Setup</a></li>
		                                 
		                            </ul>
                        		</li>
                        		<li class="treeview <?php if($menu==13){ echo 'active'; } ?>">
		                            <a href="#">
		                                <i class="ico ico-employee"></i>
		                                <span>Employer Profile</span>
		                                <i class="fa fa-angle-left pull-right"></i>
		                            </a>
		                            <ul class="treeview-menu">
		                                <li class="<?php if($menu1==131){ echo 'active'; } ?>"><a href="<?php echo  site_path?>add_employer/"><i class="ico ico-add-employee"></i>Add Employer</a></li>
		                                <li class="<?php if($menu1==132){ echo 'active'; } ?>"><a href="<?php echo  site_path?>manage_employer/"><i class="ico ico-employees"></i>Manage Employer</a></li>
		                            </ul>
                        		</li>
                        		<li class="<?php if($menu==21){ echo 'active'; } ?>"><a href="<?php echo  site_path?>deduction_category/"><i class="ico ico-allowances"></i>Deduction Category</a></li>
                        		<li class="<?php if($menu==23){ echo 'active'; } ?>"><a href="<?php echo  site_path?>giro_download/"><i class="ico ico-bank"></i>GIRO Download</a></li>
                        		<li class="treeview <?php if($menu==15){ echo 'active'; } ?>">
		                            <a href="#">
		                                <i class="ico ico-government1"></i>
		                                <span>Government <br>Sector</span>
		                                <i class="fa fa-angle-left pull-right"></i>
		                            </a>
		                            <ul class="treeview-menu">
		                               <!-- <li class="<?php if($menu1==151){ echo 'active'; } ?>"><a href="<?php echo  site_path?>GIRO/"><i class="ico ico-government1"></i>GIRO</a></li>-->
		                                <li class="<?php if($menu1==152){ echo 'active'; } ?>"><a href="<?php echo  site_path?>iras/"><i class="ico ico-government"></i>CPF esubmit</a></li>
		                                <li class="<?php if($menu1==153){ echo 'active'; } ?>"><a href="<?php echo  site_path?>ir8a/"><i class="ico ico-government"></i>IRAS</a></li>
		                            </ul>
                        		</li>
								<!--<li class="treeview <?php if($menu==14){ echo 'active'; } ?>">
		                            <a href="#">
		                                <i class="ico ico-calendar"></i>
		                                <span>Calendar</span>
		                                <i class="fa fa-angle-left pull-right"></i>
		                            </a>
		                            <ul class="treeview-menu">
		                                <li class="<?php if($menu1==141){ echo 'active'; } ?>"><a href="<?php echo  site_path?>add_leave/"><i class="ico ico-add-leaves"></i>Add Leave</a></li>
		                                <li class="<?php if($menu1==142){ echo 'active'; } ?>"><a href="<?php echo  site_path?>manage_leave/"><i class="ico ico-leaves"></i>Manage Leave</a></li>
		                            </ul>
                        		</li>
								<li class="treeview <?php if($menu==15){ echo 'active'; } ?>">
		                            <a href="#">
		                                <i class="ico ico-government1"></i>
		                                <span>Government <br>Sector</span>
		                                <i class="fa fa-angle-left pull-right"></i>
		                            </a>
		                            <ul class="treeview-menu">
		                                <li class="<?php if($menu1==151){ echo 'active'; } ?>"><a href="<?php echo  site_path?>GIRO/"><i class="ico ico-government1"></i>GIRO</a></li>
		                                <li class="<?php if($menu1==152){ echo 'active'; } ?>"><a href="<?php echo  site_path?>iras/"><i class="ico ico-government"></i>IRAS</a></li>
		                            </ul>
                        		</li>-->
                            </ul>
                        </li>
                        <li class="treeview <?php if($menu>15 && $menu<20 ){ echo 'active'; }  ?>">
                            <a href="#">
                                <i class="ico ico-setting"></i>
                                <span>Other Settings</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="treeview <?php if($menu==16){ echo 'active'; } ?>">
	                            <a href="#">
	                                <i class="ico ico-job"></i>
	                                <span>Country</span>
	                                <i class="fa fa-angle-left pull-right"></i>
	                            </a>
	                            <ul class="treeview-menu">
	                                <li class="<?php if($menu1==162){ echo 'active'; } ?>"><a href="<?php echo  site_path?>setting_master/add_country"><i class="ico ico-job1"></i>Add Country</a></li>
	                                <li class="<?php if($menu1==161){ echo 'active'; } ?>"><a href="<?php echo  site_path?>setting_master/country"><i class="ico ico-job2"></i>Country List</a></li>
	                            </ul>
                        		</li>
                        		<li class="treeview <?php if($menu==17){ echo 'active'; } ?>">
	                            <a href="#">
	                                <i class="ico ico-job"></i>
	                                <span>State</span>
	                                <i class="fa fa-angle-left pull-right"></i>
	                            </a>
	                            <ul class="treeview-menu">
	                                <li class="<?php if($menu1==172){ echo 'active'; } ?>"><a href="<?php echo  site_path?>setting_master/add_state"><i class="ico ico-job1"></i>Add State</a></li>
	                                <li class="<?php if($menu1==171){ echo 'active'; } ?>"><a href="<?php echo  site_path?>setting_master/state"><i class="ico ico-job2"></i>State List</a></li>
	                            </ul>
                        		</li>
                        		<li class="treeview <?php if($menu==18){ echo 'active'; } ?>">
	                            <a href="#">
	                                <i class="ico ico-job"></i>
	                                <span>City</span>
	                                <i class="fa fa-angle-left pull-right"></i>
	                            </a>
	                            <ul class="treeview-menu">
	                                <li class="<?php if($menu1==182){ echo 'active'; } ?>"><a href="<?php echo  site_path?>setting_master/add_city"><i class="ico ico-job1"></i>Add City</a></li>
	                                <li class="<?php if($menu1==181){ echo 'active'; } ?>"><a href="<?php echo  site_path?>setting_master/city"><i class="ico ico-job2"></i>City List</a></li>
	                            </ul>
                        		</li>
                        		<li class="treeview <?php if($menu==19){ echo 'active'; } ?>">
	                            <a href="#">
	                                <i class="ico ico-job"></i>
	                                <span>Skills</span>
	                                <i class="fa fa-angle-left pull-right"></i>
	                            </a>
	                            <ul class="treeview-menu">
	                                <li class="<?php if($menu1==192){ echo 'active'; } ?>"><a href="<?php echo  site_path?>setting_master/add_skill"><i class="ico ico-job1"></i>Add Skill</a></li>
	                                <li class="<?php if($menu1==191){ echo 'active'; } ?>"><a href="<?php echo  site_path?>setting_master/skills"><i class="ico ico-job2"></i>Skill List</a></li>
	                            </ul>
                        		</li>
                        		
                        </ul>
                    	
                    </li>
</ul>
                </section>
                <!-- /.sidebar -->
            </aside>

<?php }
else
{ ?>

<aside class="left-side sidebar-offcanvas <?php if(isset($left_menu) && $left_menu==0){ echo "collapse-left";  } ?>">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <!--<div class="pull-left image">
                            <img src="<?php echo  img_path ?>avatar04.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo  $user_info['first_name'] ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>-->
                    </div>
                     <div class="clearfix"></div>
                         <div class="company_logo"><img src="<?php echo  images_path ?><?php echo $company_info['company_logo']; ?>" class="side-logo" style="margin:0 auto; padding: 11px;width:150px; "/>
                         <!--Dream werkz Technologies--></div>
                    <!-- search form -->
                   <!-- <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                   <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo  site_path?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="ico ico-add-leaves"></i>
                                <span>Leaves</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo  site_path?>employee_leave_requests"><i class="ico ico-add-leaves"></i>View Leave Requests</a></li>
                                <li><a href="<?php echo  site_path?>employee_request_leave"><i class="ico ico-add-leaves"></i>Request Leave</a></li>
                            </ul>
                        </li>
                         <li class="treeview">
                            <a href="#">
                                <i class="fa  fa-share"></i>
                                <span>Claims</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="<?php echo  site_path?>employee_claim_requests"><i class="fa fa-user"></i>View Claim Requests</a></li>
                                <li><a href="<?php echo  site_path?>employee_request_claim"><i class="fa fa-list-alt"></i>Request a Claim</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo  site_path?>employee_salary_slip">
                                <i class="ico ico-salary-slip"></i> <span>My Salary Slips</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo  site_path?>employee_jobsheet">
                                <i class="ico ico-jobsheet"></i> <span>Jobsheet</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
<?php
	
}
 ?>