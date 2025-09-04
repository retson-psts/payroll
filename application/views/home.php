<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
?>
<link href="<?php echo  css_path;?>fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  css_path?>fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
               <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
               <section class="content">

                    <!-- Small boxes (Stat box) -->
                    		<div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php if($employees_list!==false){ echo count($employees_list); } else { echo "0"; }?>
                                    </h3>
                                    <p>
                                        Total Employees
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                       <?php 
									   if($pending_leave_request!=false)
									   {
									   	echo count($pending_leave_request);
									   }
									   else
									   {
										   echo '0';
									   }
									   ?>
                                    </h3>
                                    <p>
                                        Pending Leave Requests
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $allowance_request; ?>
                                    </h3>
                                    <p>
                                        Allowance Requests
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $today_leave_req['0']->leave_count; ?>
                                    </h3>
                                    <p>
                                        Today Leave Request
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        
                        
                    </div><!-- /.row -->
					<!-- Box (with bar chart) -->
                            <div class="col-md-4">
                            <div class="box">
                                 <div class="box-header">
                                     <i class="fa  fa-bar-chart-o"></i>
                                        <h3 class="box-title">Total Leaves</h3>
                                      </div>
                                      <div class="box-body">
                                    <div id="graph"></div>
                                    </div>
                                     
                            </div></div>
							<!--<div class="col-md-4">
                            <div class="box box-primary">
                                <div class="clearfix"></div>
                                 <div class="box-header">
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Leave Requests & Leaves</h3>
                                </div>
                            	<div class="box-body">
                                <div id="area-example"></div>
                                </div>
                                </div> </div>-->
							<div class="col-md-4">
							<div class="box box-primary">
                            <div class="box-header">
                                    <i class="fa fa-bullseye"></i>
                                    <h3 class="box-title">Employees Percentage</h3>
                                </div><!-- /.box-header -->
							<div class="box-body">
                                <div id="graphT"></div>
                            </div>
                            </div></div>
                            <div class="col-md-4">
                            <div class="box box-primary">
                            <!-- TO DO List -->
                                <div class="box-header">
                                
                                    <i class="ion ion-clipboard"></i>
                                    <h3 class="box-title">Reminders</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body" id="pending_leave_req">
                                	<h4>Pending Leave Request</h4>
                                    <ul class="todo-list">
                                    	<?php
										if($pending_leave_request!=false)
										{
											foreach($pending_leave_request as $leave_request)
											{
											  echo '<li>
														<span class="handle">
															<i class="fa fa-ellipsis-v"></i>
															<i class="fa fa-ellipsis-v"></i>
														</span>                                          
														<span class="text"><a href="'.site_path.'leave_requests/view/'.$leave_request->leave_request_id.'"> '.$leave_request->emp_firstname.' '.$leave_request->emp_lastname.'</a></span>
													</li>';
											}
										}
										else
										{
											echo 'No Pending request';
										}
										?>
                                    </ul>
                                    
                                </div>
                            </div></div>
							<div class="col-md-6">
                            <div class="box box-primary">
                                    <div class="box-header">
                                        <i class="ion ion-caledar"></i>
                                        <h3 class="box-title">To Do</h3>
                                	</div><!-- /.box-header -->
                                	<div class="box-body" >
                                	<div class="col-sm-3" style="margin-bottom:10px;margin-top:-28px"><a href="<?php echo site_path; ?>event_list" class="btn btn-primary">Manage To do</a></div>
                                	
                                		<div id="calendar"></div>
                                	</div>
                                </div></div>
							<div class="clearfix"></div>
							
                           
                       
			   		
                    </section>
                   
               
               
        </aside>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
		<script src="<?php echo  js_path?>morris.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.js"></script> 
        <link rel="stylesheet" href="<?php echo  css_path?>morris.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo js_path; ?>plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>
    <script src="<?php echo assest_path; ?>plugin/datetime/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
		<script>
		
		
$(function () {
  var day_data = <?php echo $leaves; ?>;
 
Morris.Line({
  element: 'graph',
  data: day_data,
  xkey: 'elapsed',
  ykeys: ['value'],
  labels: ['Total Leave'],
  parseTime: false
});
Morris.Donut({
    element: 'graphT',
    data: <?php echo $employee_pie; ?>,
    labelColor: '#000',
    colors: [
    '#ae1c1c',
    '#000',
    '#cc9a00'
    ],
    formatter: function (x) { return x + "Person"}
  }).on('click', function(i, row){
    console.log(i, row);
  });
    var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        $('#calendar').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },
          events: '<?php echo site_path; ?>home/events',
          eventClick: function(event) {
		fixvalues(event);
		
	
    	}
         
        });
        
});
function fixvalues(event)
      {
        if(!isNaN(event.id))
        {
			window.location='<?php echo "site_path"; ?>event_list';
		}
		else if(event.id=='pe')
		{
			window.location='<?php echo "site_path"; ?>reminders/passport_expire';
			
		}
		else if(event.id=='pex')
		{
			window.location='<?php echo "site_path"; ?>reminders/passport_expired';
			
		}
        
	  	
	  }
</script>
