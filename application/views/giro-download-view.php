<div id="loader"></div>
<aside class="right-side">


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            GIRO Download For may bank 
            <small>GIRO Download </small>
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
                        <h3 class="box-title">Select month</h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" id="frm" action="<?php echo  site_path?>giro_download/process" method="post">
                        <div class="box-body">
                            <div id="error"></div>
                            <div class="add_form" >
                                <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                <div class="form-group col-md-3">
                                    <label>Select Month to submit GIRO</label>
                                    <div class="input-group ">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text"  required id="datepicker"  name="month" class="form-control  pull-right"  />
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                
                                <div class="form-group col-md-3">
                                    <label>&nbsp;</label>
                                    <div class="input-group ">
                                        <button type="submit" name="submit" class="btn btn-primary text-center" id="save">Show GIRO</button>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="clearfix"></div>
                            <div class="cat_save">
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <div class="clearfix"></div>
             <div class="col-md-12">
                <div class="list_results box">
                    <div class="added_data">
                        <div class="box-header">
                            <h3 class="box-title">CPF Employee details</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                        <form id="append" method="post" action="<?php echo site_path; ?>giro_download/download_excel">
                        <input type="hidden" name="mn" class="month">
                         <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <th>Bank</th>
                                    <th>Branch</th>
                                    <th>A/C No</th>
                                    <th>Amount</th>
                                    <th>Name</th>
                                    <th>Remarks</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>


</form>
                        </div>
                    </div>
                </div>
            </div>
            
           
        </div>
    </section>
    <!-- /.content -->
 
</aside>
<!-- /.right-side -->
<script src="<?php echo  js_path?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>  
<script type="text/javascript">


var myForm = document.getElementById('append');
myForm.onsubmit = function() {
    var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=300,left = 312,top = 234');
    this.target = 'Popup_Window';
};
    $(function() {
    	
    	 $("#datepicker").datepicker( {
    format: "yyyy-mm",
    viewMode: "months", 
    minViewMode: "months",
    endDate: '0d'
    });
    $( "#frm" ).on( "submit", function( event ) {
    var x=0;
    var err='';
    $('#loader').show();
    $.ajax({
    type: "POST",
    url: "<?php echo site_path; ?>giro_download/process",
    dataType: "json",
    data:$( "#frm" ).serialize() ,
    success: function(data){
	    $('.form-control').removeClass('error');
	    $('.download').remove();
	    $('.month').val('');
	    $('#error').html('');
	    $('#op_form').trigger("reset");
		$('#example2 tbody').html('');
	    if(data.status==0)
	    {
		    var s=0;
	    	$('#loader').hide();
	    	if($.type(data.message)=='object')
	    	{
				$.each(data.message,function(k,v){
					err+='<p>'+v+'</p>';
					$("#frm [name='"+k+"']").addClass('error');
					$("#frm [name='"+k+"']").focus();
				});
			}
			else
			{
				err=data.message;
			}
	    	$('#error').html('<div id="msg" class="alert alert-danger alert-dismissable"><i class="fa fa-ban"></i>'+err+'</div>');
	    	
	    }
	    else
	    {   
	    	
	      var tbody='';
	      $.each(data.message,function(k,v){
	      	tbody+='<tr><td>'+v['employee_bank_name']+'</td><td></td><td>'+v['employee_bank_acc']+'</td><td><input type="text" name="amount['+k+']" value="'+v['net_pay']+'" ></td><td>'+v['emp_firstname']+' '+v['emp_lastname']+'</td><td><textarea name="remarks['+k+']" > Salary Pay to '+v['employee_bank_name']+' </textarea> </td></tr>';
	      	
	      });
	    
		   $('#append').prepend('<button  class="btn btn-success download"><i class="fa fa-file-excel-o"></i>Download</button>')
			$('#example2 tbody').html(tbody);
			$('.month').val(data.month);
		
	    }
	    
    },
    complete: function (data) {	
    $('#loader').hide();
    },
    error: function(jqXHR, textStatus, errorThrown) { 
        $('#loader').hide();
	    alert('Please try again'); 
    }
    
    });
    
    return false;
    });
 });
   
    
</script>