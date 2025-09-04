<div id="loader"></div>
<aside class="right-side">


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            CPF Monthly Submission 
            <small>CPF </small>
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
                        <h3 class="box-title">Select CPF</h3>
                    </div>
                    <!-- /.box-header -->
                    <form role="form" id="frm" action="<?php echo  site_path?>iras/download" method="post">
                        <div class="box-body">
                            <div id="error"></div>
                            <div class="add_form" >
                                <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                <div class="form-group col-md-3">
                                    <label>Select Month to submit CPF</label>
                                    <div class="input-group ">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text"  required id="datepicker"  name="month" class="form-control  pull-right"  />
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <div class="form-group col-md-4">
                                    <label>CSN No</label>
                                    <select class="form-control" name="CSN">
                                        <option value="">Select CPF</option>
                                        <?php if(!empty($csn)) {
                                            foreach($csn as $row)
                                            {
                                            ?>
                                        <option value="<?php echo $row['csn_id']; ?>"><?php echo $row['csn_roc'].'-'.$row['csn_type'].'-'.$row['csn_sno']; ?></option>
                                        <?php
                                            }
                                                          	
                                                          } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>&nbsp;</label>
                                    <div class="input-group ">
                                        <button type="submit" name="submit" class="btn btn-primary text-center" id="save">Show CPF</button>
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
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <th>Employee Id</th>
                                    <th>Employee Name</th>
                                    <th>FUND TYPE</th>
                                    <th>Total Contribution</th>
                                    <th>Employee CPF</th>
                                    <th>Employer CPF</th>
                                    <th>CPF Amount</th>
                                    <th>Gross Pay</th>
                                    <th>SDL</th>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-12">
                <div class="list_results box">
                    <div class="added_data">
                        <div class="box-header">
                            <h3 class="box-title">CPF Summary details</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body table-responsive">
                            <form id="op_form" method="POST" action="<?php echo site_path; ?>iras/download_iras">
                             <input type="hidden" name="<?php echo  $this->security->get_csrf_token_name(); ?>" id="csrf_token" value="<?php echo  $this->security->get_csrf_hash(); ?>"/>
                                <table id="example1" class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <td width="20%">Total CPF Contributions:</td>
                                            <td width="30%">
                                                <div class="input-group ">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control change add" name="cpf_total">
                                                </div>
                                            </td>
                                            <td width="20%" ></td>
                                            <td width="30%"></td>
                                        </tr>
                                        <tr>
                                            <td>CPF Late Payment Interests:</td>
                                            <td>
                                                <div class="input-group ">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control change add" name="cpf_late">
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Foreign Workers Levy:</td>
                                            <td>
                                                <div class="input-group ">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control change add" name="fwl_total">
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>FWL Late Payment Interest :</td>
                                            <td>
                                                <div class="input-group ">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" class="form-control change add" name="fwl_late">
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Skill Development Levy(SDL):</td>
                                            <td>
                                                <div class="input-group ">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text"  readonly="readonly" class="form-control change add" name="sdl_total">
                                                </div>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Donation to community chest:</td>
                                            <td>
                                                <div class="input-group ">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" readonly="readonly" class="form-control add change add" name="cc_total">
                                                </div>
                                            </td>
                                            <td>Donar Count</td>
                                            <td>
                                                <div class="input-group ">
                                                    <input type="text" readonly="readonly" class="form-control add change add" name="cc_count">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total MPMF Contributions:</td>
                                            <td>
                                                <div class="input-group ">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" readonly="readonly" class="form-control add change add" name="mbmf_total">
                                                </div>
                                            </td>
                                            <td>MPMF Count</td>
                                            <td>
                                                <div class="input-group ">
                                                    <input type="text" readonly="readonly" class="form-control" name="mbmf_count">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total SINDA Contributions:</td>
                                            <td>
                                                <div class="input-group ">
                                                    <span class="input-group-addon">$</span> 
                                                    <input type="text" readonly="readonly" class="form-control add change add" name="sinda_total">
                                                </div>
                                            </td>
                                            <td>SINDA Count</td>
                                            <td>
                                                <div class="input-group ">
                                                    <input type="text" readonly="readonly" class="form-control " name="sinda_count">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total CDAC Contributions:</td>
                                            <td>
                                                <div class="input-group ">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" readonly="readonly" class="form-control add change" name="cdac_total">
                                                </div>
                                            </td>
                                            <td>CDAC Count</td>
                                            <td>
                                                <div class="input-group ">
                                                    <input type="text" readonly="readonly" class="form-control  " name="cdac_count">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Total ECF Contributions:</td>
                                            <td>
                                                <div class="input-group ">
                                                    <span class="input-group-addon">$</span>
                                                    <input type="text" readonly="readonly" class="form-control add change" name="ecf_total">
                                                </div>
                                            </td>
                                            <td>ECF Count</td>
                                            <td>
                                                <div class="input-group ">
                                                    <input type="text" readonly="readonly" class="form-control " name="ecf_count">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Grand Total</td>
                                            <td colspan="3">
                                                <div class="input-group ">
                                                    <input type="text" readonly="readonly" class="form-control total" name="gtotal">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr ><td colspan="5" class="text-center"><button type="submit" name="submit" class="btn btn-success text-center" id="save">Download CPF File</button></td></tr>
                                    </tbody>
                                </table>
                                <input type="hidden" name="code" value="">
                                <input type="hidden" name="csn" value="">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="claerfix"></div>
           
        </div>
    </section>
    <!-- /.content -->
 
</aside>
<!-- /.right-side -->
<script src="<?php echo  js_path?>plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>  
<script type="text/javascript">
function popcenter(url, title, w, h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);

return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 
    $(function() {
    	$('.date_range').daterangepicker({format: 'YYYY/MM/DD'});
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
    url: "<?php echo site_path; ?>iras/display_iras",
    dataType: "json",
    data:$( "#frm" ).serialize() ,
    success: function(data){
	    $('.form-control').removeClass('error');
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
	    	$("#op_form [name='csn']").val('');
		    $("#op_form [name='csn']").val('');
	    }
	    else
	    {   
		    $("#op_form [name='cdac_count']").val(data.t.cdac_count);
		    $("#op_form [name='csn']").val(data.csn);
		    $("#op_form [name='csn']").val(1);
		    $("#op_form [name='fwl_total']").val(data.t.levy_total);
		    $("#op_form [name='sdl_total']").val(data.t.sdl_total);
		    $("#op_form [name='mbmf_count']").val(data.t.mbmf_count);
		    $("#op_form [name='sinda_count']").val(data.t.sinda_count);
		    $("#op_form [name='cc_count']").val(data.t.cc_count);
		    $("#op_form [name='ecf_count']").val(data.t.ecf_count);
		    $("#op_form [name='cdac_total']").val(data.t.cdac_total);
		    $("#op_form [name='mbmf_total']").val(data.t.mbmf_total);
		    $("#op_form [name='sinda_total']").val(data.t.sinda_total);
		    $("#op_form [name='cc_total']").val(data.t.cc_total);
		    $("#op_form [name='ecf_total']").val(data.t.ecf_total);
		    $("#op_form [name='gtotal']").val(data.t.gtotal);
		    $("#op_form [name='cpf_total']").val(data.t.cpf_total);
		    var tbody="";
		    var cpf_total=0;
		    if(data.s.length>=1)
		    {
				$.each(data.s, function(k,v) {
				cpf_total=parseFloat(v.cpf_employee)+parseFloat(v.cpf_employer);
				    tbody+='<tr id="emp_'+v.employee_id+'">';
				    tbody+='<td>'+v.emp_number+'</td>';
				    tbody+='<td>'+v.emp_firstname+' '+v.emp_lastname+'</td>';
				    tbody+='<td>'+v.contri+'</td>';
				    tbody+='<td>'+v.contri_t+'</td>';
				    tbody+='<td>'+v.cpf_employee+'</td>';
				    tbody+='<td>'+v.cpf_employer+'</td>';
				    tbody+='<td>'+cpf_total+'</td>';
				    tbody+='<td>'+v.net_pay+'</td>';
				    tbody+='<td>'+v.sdl_emp+'</td>';
				    tbody+='</tr>';
				 });
				 $('#example2 tbody').html(tbody);
			}
	    }
	    $('#loader').hide(); 
    },
    complete: function (data) {	
    $('#loader').hide();
    },
    error: function(jqXHR, textStatus, errorThrown) { 
     $("#op_form [name='csn']").val('');
		    $("#op_form [name='csn']").val('');
	    $('#loader').hide();
	    alert('Please try again'); 
    }
    
    });
    
    return false;
    
    
    
    });
		$('.change').keyup(function(){
	sum=0;
	 $(".change").each(function(){
	 	if($.isNumeric($(this).val()))
	 	{
			sum +=parseInt($(this).val());	
		}
        
    });
    
	$('.total').val(sum);
});
    });
     $( "#op_form" ).on( "submit", function( event ) {
     
     	 var cs=$("#op_form [name='csn']").val();
		 var co=$("#op_form [name='csn']").val();
     	if(cs!=1 && co!=1)
     	{
     		alert('No values available');
			return false;
		}
		else
		{
			 $('#loader').show();
		    $.ajax({
		    type: "POST",
		    url: "<?php echo site_path; ?>iras/download_iras",
		    dataType: "json",
		    data:$( "#op_form" ).serialize() ,
		    success: function(data){
			    $('.form-control').removeClass('error');
			    $('#error').html('');
				/*$('#op_form').trigger("reset");*/
				/*$('#example2 tbody').html('');*/
				var err='';
			    if(data.status==0)
			    {
			    	if($.type(data.message)=='object')
			    	{
						$.each(data.message,function(k,v){
							err+='<p>'+v+'</p>';
							$("#op_form [name='"+k+"']").addClass('error');
							$("#op_form [name='"+k+"']").focus();
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
			    	window.location=data.url;
			    }
	    
    },
    complete: function (data) {	
    $('#loader').hide();
    },
    error: function(jqXHR, textStatus, errorThrown) { 
     $("#op_form [name='csn']").val('');
		$("#op_form [name='csn']").val('');
	    $('#loader').hide();
	    alert('Please try again'); 
    }
    
    });
		}
     	return false;
     	
     });
    
</script>