<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
$user_info=$this->session->userdata['logged_in'];
$company_info=$this->session->userdata['company'];
if(!isset($menu))
{
	$menu=0;
	$menu1=0;
}

?>
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