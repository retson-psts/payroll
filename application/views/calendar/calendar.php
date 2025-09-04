<link href="<?php echo  css_path;?>fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo  css_path?>fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
    <link href="<?php echo  assest_path?>plugin/datetime/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
     <div id="loader"></div>
<!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
          <h1>
            Calendar
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Calendar</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-12">
            	<div class="col-md-12">
                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#editModal">Add Event</button>
                </div>
              <div class="box box-primary">
                <div class="box-body no-padding">
                
                
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div><!-- /.box-body -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
            </aside><!-- /.right-side -->
            
            
            <div id="myModal" class="modal fade" role="dialog">
  				<div class="modal-dialog">

    				<!-- Modal content-->
				    <div class="modal-content">
				      
				      <div class="modal-body">
				        <p id="result"></p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
				      </div>
				    </div>

  </div>
			</div>
			<div id="editModal" class="modal fade" role="dialog">
  				<div class="modal-dialog">
 <form role="form"  action="#" method="post" enctype="multipart/form-data" id="form_edit">
    				<!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Events Add/Edit</h4>
      </div>
				      <div class="modal-body">
				       
                                    <div id="error_edit"></div>
                                    <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>" />
                                     <input  type="hidden" id="id" name="id" value="0"/>
                                        
                                    <div id="add_form" >
                                      <div class="box-body">
                                        <div class="form-group col-md-8">
                                           <label for="">Event Title *</label>
                                           <input type="text" class="form-control" name="title" id="title" value="">
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="form-group col-md-8">
                                           <label for="">Description</label>
                                           <textarea class="form-control" name="description" id="description" ></textarea>
                                        </div>
                                       
                                        <div class="clearfix"></div>
                                         <div class="form-group col-md-4">
                                           <label for="">All Day Event</label>
                                            <div class="clearfix"></div>
                                           <input type="checkbox" class="allday" name="allday1" value="1">
                                        </div>
                                        <div class="form-group col-md-4">
                                           <label for="">Start *</label>
                                           <input type="text" class="form-control start date" name="start" id="eec_home_no" value="">
                                        </div>
                                        <div class="form-group col-md-4">
                                           <label for="">End </label>
                                           <input type="text" class="form-control end date" name="end" id="eec_mobile_no" value="">
                                        </div>
                                        <div class="clearfix"></div><div class="clearfix"></div>
                                        <div class="form-group col-md-8">
                                           <label for="">Type</label>
                                           <select name="status" class="form-control">
                                           	<option value="1">Important</option>
                                           	<option value="2">Normal</option>
                                           	<option value="3">Ordinary</option>
                                           	<option value="4">Reference</option>
                                           </select>
                                        </div>
                                       
                                      </div>
                                      <div class="clearfix"></div>
                                      <div class="box-footer text-center">
                                          
                                            
                                      </div>
                                    </div>
                                  
                                   
				      </div>
				      <div class="modal-footer">
				         <button type="submit" name="save" class="btn btn-primary text-center">Submit</button>
                         <button type="reset" class="btn btn-danger text-center" data-dismiss="modal" aria-label="Close">Cancel</button>
                          <a href="javascript:void(0);"  class="btn btn-warning text-center" id="remove_my" onclick="delete_my();" style="display:none;" >Delete</a>
                                            
				      </div>
				       
				    </div>
				    </form>

  </div>
			</div>
        	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.7.0/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo js_path; ?>plugins/fullcalendar/fullcalendar.js" type="text/javascript"></script>
    <script src="<?php echo assest_path; ?>plugin/datetime/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <!-- Page specific script -->
    <script type="text/javascript">
      $(function () {
      	
      
      	
      	
      	$('.allday').change(function(){
      		
      	var x=$(this).prop('checked');
      	if(x!=true)
      	{
			$('.date').each(function() {
				$(this).datetimepicker('remove');
				$(this).datepicker('remove');
				$(this).val('');
    $(this).datetimepicker({autoclose:true, viewMode: 'days',format: "yyyy-mm-dd  hh:ii"});
});	
		}
		else
		{
			$('.date').each(function() {
				$(this).datetimepicker('remove');
				$(this).datepicker('remove');
				$(this).val('');
    $(this).datepicker({autoclose:true, viewMode: 'days',format: "yyyy-mm-dd"});
});	
		}
      	
      	});
       
       $('.date').each(function() {
    $(this).datetimepicker({autoclose:true, viewMode: 'days',format: "yyyy-mm-dd hh:ii"});
});
        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
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
          events: '<?php echo site_path; ?>event_list/events',
          eventClick: function(event) {
		fixvalues(event);
		
	
    	}
         
        });
			
        /* ADDING EVENTS */
        
        
        $( "#form_edit" ).on( "submit", function( event ) {
				var x=0;
				console.log(event);
				var err='';
				$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>event_list/add_event",
				dataType: "json",
				data:$( "#form_edit" ).serialize() ,
				success: function(html){
					
				if(html.status==0)
				{
					//event.preventDefault();
					$('.form-control').removeClass('error');
					var s=0;
					$.each(html.message, function(k,v) {
       				err+='<p>'+v+'</p>';
       				
       				if(s<1)
       				{
						$("#form_edit [name='"+k+"']").focus();
						s++;
					}
					
           			 $("#form_edit [name='"+k+"']").addClass( "error" );	
           			
       
    			});  
					$('#error_edit').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>'+err+'</div>');
					 
           			 
					
				}
				else
				{
					$('#calendar').fullCalendar( 'removeEventSource','<?php echo site_path; ?>event_list/events');
					$('#calendar').fullCalendar( 'addEventSource', '<?php echo site_path; ?>event_list/events' );
					$('#result').html(html.message);
					$('#editModal').modal('hide');
					$('#myModal').modal('show');
					$('#form_edit')[0].reset();
					$('#id').val('0');
					$('#myModal').on('hidden.bs.modal', function () {
						
					});
					
						
				}
				
				},
				complete: function (data) {
     			$('#loader').hide();
     				},
     			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
				
			});
			
			return false;
  			
  			
  
});	
     
      });
      function fixvalues(event)
      {
      	var s=0;
      		$('#loader').show();
        		  $.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>event_list/fetch1",
				dataType: "json",
				data:'id='+event.id+'&<?php echo  $this->security->get_csrf_token_name(); ?>=<?php echo  $this->security->get_csrf_hash(); ?>' ,
				success: function(html){
					
				if(html.status==0)
				{
					//event.preventDefault();
					$('#result').html(html.message);
					$('#myModal').modal('show');
					$('#form_edit')[0].reset();
				}
				else if(html.status==1)
				{
					content=html.message;
					if(content.allday==1)
					{
						$('.allday').prop('checked',true);
					}
					else
					{
						$('.allday').prop('checked',false);
					}
				     $("#form_edit [name='id']").val( content.event_id ); 
						$.each(html.message, function(k,v) {
							
       						if(s<1)
		       				{
								$("#form_edit [name='"+k+"']").focus();
								s++;
							}
					
           			 		$("#form_edit [name='"+k+"']").val( v );	
           			
       
    					});  
    					$('#editModal').modal('show');
    					$('#remove_my').show();
    						$('#editModal').on('hidden.bs.modal', function () {
      		
									$('#form_edit')[0].reset();
									$('#remove_my').show();
						});
				}
				else
				{
					alert('Please try again');	
				}
				
				},
				complete: function (data) {
     			$('#loader').hide();
     				},
     			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
				
			});
	  	
	  }
	  function delete_my()
    	{
    		id=$('#id').val();
    		$('#loader').show();
    		 $.ajax({
			type: "GET",
			url: "<?php echo site_path; ?>event_list/remove_event/"+id,
			dataType: "json",
			success: function(html){
			if(html.status==0)
			{
				//event.preventDefault();
					
				    $('#error_edit').html(html.message);
					
				
			}
			else
			{
					$('#result').html(html.message);
					$('#myModal').modal('show');
					$('#editModal').modal('hide');
					$('#calendar').fullCalendar( 'removeEventSource','<?php echo site_path; ?>event_list/events');
					$('#calendar').fullCalendar( 'addEventSource', '<?php echo site_path; ?>event_list/events' );
					$('#myModal').on('hidden.bs.modal', function () {
						
					});
			}
			
			},
			complete: function (data) {
 			$('#loader').hide();
 				},
 			error: function(jqXHR, textStatus, errorThrown) { $('#loader').hide(); alert('Please try again'); }
			
		});
			
		}
    </script>

		