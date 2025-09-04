           <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       Leave Request Report
                        <small>Leave Request Reports</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                         <li><a href="#"><i class="fa fa-briefcase"></i> Reports</a></li>
                       
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <?php echo $message_div ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-warning">
                                <div class="box-header">
                                 
                                <h3 class="box-title">Filter By Following</h3>                                    
                                </div><!-- /.box-header -->
                                <form role="form" id="frm" action="<?php echo  site_path?>projects/add" method="post">
                                      <div class="box-body">
                                         <div class="add_form" >
                                            <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                           <!-- <div class="form-group col-md-3">
                                                <label >OT Type</label>
                                               <select class="form-control" name="ot_type">
                                               	<option value="">All</option>
                                               	 <option value="1">OT Fixed</option>
                                               	 <option value="2">OT 1.5</option>
                                               	 <option value="3">OT 2</option>
                                               	
                                               </select>
                                            </div>-->
                                             <div class="form-group col-md-3">
							                    <label>Period</label>
							                    <div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-calendar"></i>
							                      </div>
							                      <input type="text"  name="range" class="form-control date_range pull-right" id="" />
							                    </div>
							                  </div>
                                             <div class="form-group col-md-3">
							                    <label>Month</label>
							                    <div class="input-group">
							                      <div class="input-group-addon">
							                        <i class="fa fa-calendar"></i>
							                      </div>
							                      <input type="text" id="datepicker"  name="month" class="form-control  pull-right"  />
							                    </div><!-- /.input group -->
							                  </div>
                                            <div class="clearfix"></div>
                                         </div>
                                      </div><!-- /.box-body -->
                                    <div class="box-footer">
                                    
                                        <div class="clearfix"></div>
                                        <div class="cat_save">
                                        	<button type="submit" name="submit" class="btn btn-primary text-center" id="save">Searh</button>
                                            <button type="submit" name="submit" class="btn btn-danger text-center" id="cancel" onclick="cancel_btn(); return false;">Cancel</button>
                                        </div>
                                    </div>
                               </form>
                              
                             </div>
                             <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Leave Request Reports</h3>                                    
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <a href="#" id="excel"  >Download <i class="ico ico-excel "></i></a>
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th>Employee No</th>
                                                <th>Employee Name</th>
                                                <th>Period</th>
                                                <th>Request Date</th>
                                                <th>Approved by</th>
                                                <th>Approved Date</th>
                                                <th>Day Count</th>
                                                <th>Leave Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="ajax">
                                        
                                        </tbody>
                                        <!--<tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Leave Count</th>
                                                <th>Month</th>
                                            </tr>
                                        </tfoot>-->
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        
		
        
        <script src="<?php echo  js_path?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>  
        
         <script type="text/javascript">
            $(function() {
            	$('.date_range').daterangepicker({format: 'YYYY/MM/DD'});
            	 $("#datepicker").datepicker( {
				    format: "yyyy-mm-dd",
				    viewMode: "months", 
				    minViewMode: "months",
				    endDate: '0d'
				});
				$( "#frm" ).on( "submit", function( event ) {
        		  event.preventDefault();
					$('#ajax').html('');
					$.ajax({
				type: "POST",
				url: "<?php echo site_path; ?>reports/ajax_leave",
				dataType: "json",
				data:$( "#frm" ).serialize() ,
				success: function(html){
				if(html.status==0)
				{
					alert('No results found');
					
				}
				else if(html.status==1)
				{
					
					var res=html.result;
					var txt='';
					i1=1;
					for(var i=0;i<res.length;i++)
					{
						
						txt+='<tr><td>'+i1+'</td><td>'+res[i].leave_date+'</td><td>'+res[i].leaves+'</td><td>'+res[i].month+'</td></tr>';
						i1++;
					}
					
					$('#ajax').html(txt);
					$("#excel").attr("href", html.link1);
				}
				else
				{
				
					
				}
					
				}
				});
					
					
				});
            });
			
			</script>