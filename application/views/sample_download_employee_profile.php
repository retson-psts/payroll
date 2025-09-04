<style>
@media all {
	.page-break	{ display: none; }
}

@media print {
	.page-break	{ display: block;page-break-before: always; }
}
table tr td, table tr th 
{
        page-break-inside: avoid;
}
.mainhead
{	
	font-size: 18px!important;
    font-weight: 600;
    color: #FF015F;                
    text-align: center; 
    text-transform: uppercase!important;
    padding-bottom: 10px;
}
.subhead
{
	font-size: 16px!important;
    font-weight: 600;
    color: #0089CD;                
    text-align:left; 
    text-transform: uppercase!important;
    padding-right:10px;   
    min-width: 200px; 
}

.subhead2
{
	font-size: 15px!important;
    font-weight: 600;
    color: #57D3F1;                
    text-align:left; 
    text-transform: uppercase!important;    
    padding-bottom: 10px;  
    
}
.norspc
{
	min-width: 150px;
}
td
{
	padding-left: 20px;
	font-size: 14px;
	font-weight: 400;
	
}
td.subhead
{
	border-right:2px solid #333;	
	margin-right:10px;
	
}	
.txtformat
{
	text-align:right;	
    font-weight: 600!important;
    color: #000;                
    padding-right:10px;      
}
.etyspc
{
	height:20px;	
}
.empimg
{
	border-radius: 50%;
    text-align: center;    
    display: inline-block;
}
.emptxt
{
	width: 75%;	
	display: inline-block;
}
.empimgh1
{
	text-align:left;	
    font-weight: 600!important;
    font-size: 23px;
    color:#3555A5;            
    padding-right:10px;  
    
}
.empimgh2
{
	text-align:left;	
    font-weight: 600!important;
    font-size: 18px;
    color:#FF015F;            
    padding-right:10px;  
    
}
.empimgh3
{
	text-align:left;	
    font-weight: 600!important;
    font-size: 16px;
    color:#333;            
    padding-right:10px;  
    
}

.part2
{
	width:100%;	
}
.part2 img
{
	width: 150px;
	border-radius: 50%;
	display: inline-block;
}
</style>


<?php 


$phead='<h1 class="mainhead">Employee profile</h1>';

$stbl="<table><tbody>";
$etbl="</tbody></table>";


$binfo='
		 <tr class="etyspc"></tr>
			 <tr class="etyspc"></tr>
			 
		<tr><td rowspan="6" class="subhead">PERSONAL DETAILS </td></tr>
		
		
		<tr><td class="txtformat">Name: </td><td class="norspc">'.$employee['emp_firstname'].' </td><td  class="txtformat">Employee Number: </td><td class="norspc">'.$employee['emp_number'].'</td></tr>
		
		<tr><td  class="txtformat">Other Id: </td><td class="norspc">'.$employee['emp_other_id'].' </td><td  class="txtformat">Licence No: </td><td class="norspc">'.$employee['emp_dri_lice_num'].'</td></tr>
		
		<tr><td  class="txtformat">Licence Type: </td><td class="norspc">'.$employee['licence'].' </td><td  class="txtformat">Licence Expire Date: </td><td class="norspc">'.$employee['licence_exp'].'</td></tr>
		
		<tr><td  class="txtformat">Gender: </td><td class="norspc">'.$employee['gender'].' </td><td class="txtformat">Nationality: </td><td class="norspc">'.$employee['nationality'].'</td></tr>
		
		<tr><td class="txtformat">Date of birth: </td><td class="norspc">'.$employee['dob'].' </td><td class="txtformat">Marital status: </td><td class="norspc">'.$employee['marital'].'</td></tr>
		
		
		
					
		';
	
	
	$emptyrow='<tr class="etyspc"></tr>';
	
	$cinfo='<tr><td rowspan="13" class="subhead">CONTACT DETAILS </td></tr>
			
			<tr><td class="subhead2">BASIC DETAILS</td></tr>
			
			<tr><td class="txtformat">Home Phone: </td><td class="norspc">'.$contact['emp_hm_telephone'].' </td><td  class="txtformat">Mobile Phone: </td><td class="norspc">'.$contact['emp_mobile'].'</td></tr>
			<tr><td class="txtformat">Work Phone: </td><td class="norspc">'.$contact['emp_work_telephone'].' </td><td  class="txtformat">Work Email: </td><td class="norspc">'.$contact['emp_work_email'].'</td></tr>
			<tr><td class="txtformat">Person Email: </td><td class="norspc">'.$contact['emp_oth_email'].' </td></tr>
			
			<tr class="etyspc"></tr>
			<tr><td class="subhead2">CURRENT ADDRESS</td><td class="subhead2">PERMENANT ADDRESS</td><td class="subhead2">OTHER ADDRESS</td></tr>
										
			
			<tr><td>'.$contact['emp_contact_temp_street1'].'</td><td>'.$contact['emp_contact_perma_street1'].'</td><td>'.$contact['emp_contact_other_street1'].'</td></tr>
			<tr><td>'.$contact['emp_contact_temp_street2'].'</td><td>'.$contact['emp_contact_perma_street2'].'</td><td>'.$contact['emp_contact_other_street2'].'</td></tr>
			
			<tr><td>'.$contact['emp_contact_temp_city_name'].'</td><td>'.$contact['emp_contact_perma_city_name'].'</td><td>'.$contact['emp_contact_other_city_name'].'</td></tr>
			
			<tr><td>'.$contact['emp_contact_temp_provience_name'].'</td><td>'.$contact['emp_contact_perma_provience_name'].'</td><td>'.$contact['emp_contact_other_provience_name'].'</td></tr>
			
			<tr><td>'.$contact['emp_contact_temp_country_name'].'</td><td>'.$contact['emp_contact_perma_country_name'].'</td><td>'.$contact['emp_contact_other_country_name'].'</td></tr>
			
				<tr><td>'.$contact['emp_contact_temp_pincode'].'</td><td>'.$contact['emp_contact_perma_pincode'].'</td><td>'.$contact['emp_contact_other_pincode'].'</td></tr>
			
		<tr class="etyspc"></tr>

	';

$emrinfo_head="";
$emrinfo="";

if(!empty($emergency))
{ 
  $i=0;
  foreach($emergency as $key => $value)
  {  
  	$i+=4;
  	
      $emrinfo.='<tr><td class="subhead2">'.$value['eec_name'].' - '.$value['eec_relationship'].' </td></tr>
      
      			<tr><td class="txtformat">Home Phone: </td><td class="norspc">'.$value['eec_home_no'].' </td></tr>
      			<tr><td class="txtformat">Mobile Phone: </td><td class="norspc">'.$value['eec_mobile_no'].' </td></tr>
      			<tr><td class="txtformat">Work Phone: </td><td class="norspc">'.$value['eec_office_no'].' </td></tr>
      
		';
	}
	$i=$i+1;
	
	$emrinfo.=' <tr class="etyspc"></tr>';
$emrinfo_head='<tr><td rowspan='.$i.' class="subhead">EMERGENCY CONTACT DETAILS </td></tr>';	
}



$depend_head="";
$dependinfo="";

if($dependents!==FALSE)
{ 
  $i=0;
  foreach($dependents as $key => $value)
  {  
  	$i+=5;
  	

$dependinfo.='<tr><td class="subhead2">DEPENDENTS</td></tr>
			
		<tr><td class="txtformat">Name: </td><td class="norspc">'.$value['ed_name'].' </td></tr>
		
		<tr><td class="txtformat">DOB: </td><td class="norspc">'.$value['ed_date_of_birth'].' </td></tr>
		<tr><td class="txtformat">Relationship: </td><td class="norspc">'.$value['ed_relationship_type'].' </td></tr>
		
		
		';
	}
	$dependinfo.=' <tr class="etyspc"></tr>';
$depend_head='<tr><td rowspan='.$i.' class="subhead">DEPENDENTS </td></tr>';	
}


$res="";

if($immigration['ei_permit_type']!='Other') 
{
	$res=$immigration['ei_id'];  
} 
else 
{
	$res=$immigration['ei_specify_permit_type']; 
}


	$immig_info='<tr><td rowspan="11" class="subhead">IMMIGRATION DETAILS</td></tr>
			
			<tr><td colspan="2" class="subhead2">PASSPORT DETAILS</td><td  colspan="2" class="subhead2">IMMIGRATION DETAILS</td></tr>
			
			<tr><td class="txtformat">Passport No: </td><td class="norspc">'.$passport['ep_passport_number'].'</td><td  class="txtformat">Permit Type: </td><td class="norspc">'.$res.'</td></tr>
			
			
			<tr><td class="txtformat">Issued Date: </td><td class="norspc">'.$passport['ep_permit_issuedate'].'</td><td  class="txtformat">Quota: </td><td class="norspc">'.$immigration['ei_quota'].'</td></tr>
			
			
			<tr><td class="txtformat">Expiry Date: </td><td class="norspc">'.$passport['ep_permit_expirydate'].'</td><td  class="txtformat">Yard: </td><td class="norspc">'.$immigration['ei_yard'].'</td></tr>
			
			<tr><td class="txtformat">Issued By: </td><td class="norspc">'.$passport['ep_issued_by'].'</td><td  class="txtformat">Permit Number: </td><td class="norspc">'.$immigration['ei_permit_number'].'</td></tr>
			
			<tr><td class="txtformat">Place Issued: </td><td class="norspc">'.$passport['ep_provience'].'</td><td  class="txtformat">Issued Date: </td><td class="norspc">'.$immigration['ei_permit_issuedate'].'</td></tr>
			
			<tr><td class="txtformat">Comments: </td><td class="norspc">'.$passport['ep_passport_number'].'</td><td  class="txtformat">Expiry Date: </td><td class="norspc">'.$immigration['ei_permit_expirydate'].'</td></tr>
			
			<tr><td colspan="2"></td><td  class="txtformat">Review Date: </td><td class="norspc">'.$immigration['ei_review_date'].'</td></tr>
			
			<tr><td colspan="2"></td><td  class="txtformat">Comments: </td><td class="norspc">'.$immigration['ei_comments'].'</td></tr>
			<tr class="etyspc"></tr>			
			';

$job_info='<tr class="etyspc"></tr>			
			<tr><td rowspan="10" class="subhead">JOB DETAILS </td></tr>
			
			<tr><td class="subhead2">JOB DETAILS</td></tr>
			
			<tr><td class="txtformat">Joined Date: </td><td class="norspc">'.$job_details['emp_joined_date'].'</td></tr>
			
			<tr><td class="txtformat">Job Title: </td><td class="norspc">'.$job_details['job_title_name'].'</td></tr>
			
			<tr><td class="txtformat">Unit: </td><td class="norspc">'.$job_details['project_title'].'</td></tr>
			
			<tr><td class="txtformat">Location: </td><td class="norspc">'.$job_details['location_name'].'</td></tr>
			
			<tr><td class="txtformat">Annual Leave: </td><td class="norspc">'.$job_details['annual_leave'].'</td></tr>
			
			<tr><td class="txtformat">Sick Leave: </td><td class="norspc">'.$job_details['sick_leave'].'</td></tr>
			
			<tr><td class="txtformat">Employement Contract: </td><td class="norspc">'.$job_details['emp_job_start_date'].' / '.$job_details['emp_job_end_date'].'</td></tr>					
			
			';

$sal="";
if($salary['emp_salary_cpf']==1){ $sal="Yes"; }else{ $sal="No"; }

$mbmf="";
if($salary['emp_salary_mbmf']==1){ $mbmf="Yes"; }else{ $mbmf="No"; }

$sinda="";
if($salary['emp_salary_sinda']==1){ $sinda="Yes"; }else{ $sinda="No"; }

$ecf="";
if($salary['emp_salary_ecf']==1){ $ecf="Yes"; }else{ $ecf="No"; }

$share="";
if($salary['emp_salary_share']==1){ $share="Yes"; }else{ $share="No"; }

$sdl="";
if($salary['emp_salary_sdl']==1){ $sdl="Yes"; }else{ $sdl="No"; }

$allow="";
if($salary['emp_allowance']==1){ $allow="Yes"; }else{ $allow="No"; }


$levy="";
if($salary['emp_salary_levy']==1){ $levy="Yes"; }else{ $levy="No"; }




$sal_info='<tr class="etyspc"></tr>	
			<tr class="etyspc"></tr>			
			<tr><td rowspan="11" class="subhead">SALARY DETAILS </td></tr>
			
			<tr><td class="subhead2">SALARY DETAILS</td></tr>		
			
			<tr><td class="txtformat">Salary Amount: </td><td class="norspc">'.$salary['emp_salary_amount'].'</td><td  class="txtformat">Weekly Days: </td><td class="norspc">'.$salary['emp_weekly_days'].'</td><td  class="txtformat">Pay Frequency: </td><td class="norspc">'.$salary['emp_salary_pay_period'].'</td></tr>
			
			
			<tr><td class="txtformat">Comments: </td><td class="norspc">'.$salary['emp_salary_comments'].'</td><td  class="txtformat">CDAC: </td><td class="norspc">'.$sal.'</td><td  class="txtformat">MBMF: </td><td class="norspc">'.$mbmf.'</td></tr>
			
			
			<tr><td class="txtformat">SINDA: </td><td class="norspc">'.$sinda.'</td><td  class="txtformat">ECF: </td><td class="norspc">'.$ecf.'</td><td  class="txtformat">SHARE: </td><td class="norspc">'.$share.'</td></tr>
			
			
			<tr><td class="txtformat">SDL: </td><td class="norspc">'.$sdl.'</td><td  class="txtformat">Allowance Available: </td><td class="norspc">'.$allow.'</td><td class="txtformat">LEVY: </td><td class="norspc">'.$levy.'</td>
			</tr>			
			
			
			<tr><td  class="txtformat">LEVY Payable: </td><td class="norspc">'.$salary['emp_salary_levy_amt'].'</td><td  class="txtformat">Per Hour ($): </td><td class="norspc">'.$salary['emp_salary_per_hour'].'</td><td class="txtformat">Per Day: </td><td class="norspc">'.$salary['emp_salary_per_day_hour'].'</td></tr>
			
			<tr><td  class="txtformat">Weekly Hour: </td><td class="norspc">'.$salary['emp_salary_weekly_hour'].'</td><td  class="txtformat">Weekly Pay ($): </td><td class="norspc">'.$salary['emp_salary_weekly_pay'].'</td><td class="txtformat">Monthly (Hour): </td><td class="norspc">'.$salary['emp_salary_monthly_hour'].'</td></tr>
			
			<tr><td  class="txtformat">Monthly Pay ($): </td><td class="norspc">'.$salary['emp_salary_monthly_pay'].'</td><td  class="txtformat">Overtime Type: </td><td class="norspc">'.$salary['emp_salary_over_time'].'</td><td class="txtformat">OT BASE Amount: </td><td class="norspc">'.$salary['emp_ot_base_amount'].'</td></tr>
			
			<tr><td  class="txtformat">OT per hour amount: </td><td class="norspc">'.$salary['emp_ot_per_hour_amount'].'</td></tr>
			
			
			
			
			<tr class="etyspc"></tr>
			
			';


$rept_head="";
$rept_info="";
if($emp_supervisors!==FALSE)
{ 
  $i=0; 
  foreach($emp_supervisors as $value)
  {  
  	$i+=4;  	
$rept_info.='<tr><td class="subhead2">Supervisors</td></tr>		
			
			<tr><td class="txtformat">Supervisor Name: </td><td class="norspc">'.$value->emp_firstname." ".$value->emp_lastname."(".$value->emp_number.")".'</td></tr>
			
			<tr><td class="txtformat">Reporting Method: </td><td class="norspc">'.$value->reporting_method_name.'</td></tr>
			
			';			
	}
	$rept_info.='<tr class="etyspc"></tr>';	
}	
	
 $i=0;
if($emp_subordinates!==FALSE)
{  
 $i=0;  
  foreach($emp_subordinates as $value)
  {  
  	$i+=4;  	
$rept_info.='<tr><td class="subhead2">Subordinates</td></tr>		
			
			<tr><td class="txtformat">Subordinate Name: </td><td class="norspc">'.$value->emp_firstname." ".$value->emp_lastname."(".$value->emp_number.")".'</td></tr>
			
			<tr><td class="txtformat">Reporting Method: </td><td class="norspc">'.$value->reporting_method_name.'</td></tr>
			
			';			
	}
	$rept_info.='<tr class="etyspc"></tr>';
	
}

$rept_head='<tr class="etyspc"></tr>	
			<tr><td rowspan="'.$i.'" class="subhead">REPORT TO </td></tr>';



$exp_head="";
$expinfo="";

if($experience!==FALSE)
{ 
  $i=0;
  foreach($experience as $key => $value)
  {  
  	$i+=6;
  	
      $expinfo.='<tr><td class="subhead2">Experience</td></tr>
      
      			<tr><td class="txtformat">Company Name: </td><td class="norspc">'.$value['eexp_employer'].' </td></tr>
      			<tr><td class="txtformat">Title: </td><td class="norspc">'.$value['eexp_jobtit'].' </td></tr>
      			<tr><td class="txtformat">Duration: </td><td class="norspc">'.$value['eexp_from_date'].' </td></tr>
      			
      			<tr><td class="txtformat">Comments: </td><td class="norspc">'.$value['eexp_comments'].' </td></tr>
      
     
      
		';
	}
	
	$expinfo.=' <tr class="etyspc"></tr>';
	$exp_head='<tr><td rowspan='.$i.' class="subhead">WORK EXPERIENCE </td></tr>';	
}


$qua_head="";
$quainfo="";

if($education!==FALSE)
{ 
  $i=0;
  foreach($education as $key => $value)
  {  
  	$i+=7;
  	
      $quainfo.='<tr><td class="subhead2">Qualification</td></tr>
      
      			<tr><td class="txtformat">Institution Name: </td><td class="norspc">'.$value['emp_edu_institute'].' </td></tr>
      			<tr><td class="txtformat">Major / Specialization: </td><td class="norspc">'.$value['emp_edu_major'].' </td></tr>
      			<tr><td class="txtformat">Year: </td><td class="norspc">'.$value['emp_edu_year'].' </td></tr>
      			
      			<tr><td class="txtformat">GPA/Score: </td><td class="norspc">'.$value['emp_edu_score'].' </td></tr>
      			
      			<tr><td class="txtformat">Duration: </td><td class="norspc">'.$value['emp_edu_start_date'].' / '.$value['emp_edu_end_date'].' </td></tr>
      
		';
	}
	
	$quainfo.=' <tr class="etyspc"></tr>';
	$qua_head='<tr><td rowspan='.$i.' class="subhead">Educational Qualification</td></tr>';	
}




$skill_head="";
$skillinfo="";

if($skills!==FALSE)
{ 
  $i=0;
  foreach($skills as $key => $value)
  {  
  	$i+=4;
  	
      $skillinfo.='<tr><td class="subhead2">SKILL</td></tr>
      
      			<tr><td class="txtformat">Skill name: </td><td class="norspc">'.$value['skill_name'].' </td></tr>
      			<tr><td class="txtformat">Comments: </td><td class="norspc">'.$value['esk_skill_comment'].' </td></tr>
      
		';
	}
	
	$skillinfo.=' <tr class="etyspc"></tr>';
	$skill_head='<tr><td rowspan='.$i.' class="subhead">SKILLS </td></tr>';	
}


$bankinfo='<tr><td rowspan="8" class="subhead">BANK DETAILS </td></tr>
		<tr><td class="subhead2">BANK</td></tr>
		
		<tr><td class="txtformat">Bank Name: </td><td class="norspc">'.$bank['employee_bank_name'].' </td></tr>
		
		<tr><td class="txtformat">Bank Branch: </td><td class="norspc">'.$bank['employee_bank_branch'].' </td></tr>
		
		<tr><td class="txtformat">City: </td><td class="norspc">'.$bank['employee_bank_city'].' </td></tr>
		
		<tr><td class="txtformat">Account Number: </td><td class="norspc">'.$bank['employee_bank_acc'].' </td></tr>
		
		<tr><td class="txtformat">IFSC Code: </td><td class="norspc">'.$bank['employee_bank_ifsc'].' </td></tr>
		
		<tr><td class="txtformat">Other Code: </td><td class="norspc">'.$bank['employee_bank_code'].' </td></tr>
		
';


/*if($img!=FALSE)
{
	style=site_path;'assets/images/user_profile/'.$img['eattach_filename'];';
}*/
$emp_image=' <tr class="etyspc"></tr>
				 <tr><td  rowspan="10" colspan="5" style="min-width: 300px;"></td></tr>
				<tr><td rowspan="10"><img class="empimg"  src="'.site_path.'assets/images/1435200145allowancefile.png"alt="employee photo" style="width:150px"/></td></tr>
			<tr><td class="norspc"><h1 class="empimgh1">'.$employee['emp_firstname']."   ".$employee['emp_middle_name']." ".$employee['emp_lastname'].' </h1></td></tr>
			
			<tr><td><h1 class="empimgh2">'.$employee['emp_number'].' </h1></td></tr>
			<tr><td><h1 class="empimgh3">'.$job_details['job_title_name'].' </h1></td></tr>
			
			
	';

if($img!=FALSE)
{
	
	$emp_image=' <tr class="etyspc"></tr>
				 <tr><td  rowspan="10" colspan="5" style="min-width: 300px;"></td></tr>
				<tr><td rowspan="10"><img class="empimg"  src="'.site_path.'assets/images/user_profile/'.$img["eattach_filename"].'"alt="employee photo" style="width:150px"/></td></tr>
			<tr><td class="norspc"><h1 class="empimgh1">'.$employee['emp_firstname']."   ".$employee['emp_middle_name']." ".$employee['emp_lastname'].' </h1></td></tr>
			
			<tr><td><h1 class="empimgh2">'.$employee['emp_number'].' </h1></td></tr>
			<tr><td><h1 class="empimgh3">'.$job_details['job_title_name'].' </h1></td></tr>
			
			
	';
	
}

	$lbreak="<br/><br/>";
	
	
	/*echo $phead.$stbl.$emp_image.$etbl.$stbl.$binfo.$emptyrow.$cinfo.$emrinfo_head.$emrinfo.$depend_head.$dependinfo.$immig_info.$job_info.$sal_info.$rept_head.$rept_info.$exp_head.$expinfo.$qua_head.$quainfo.$skill_head.$skillinfo.$bankinfo.$etbl;
	
	$page_break
	*/
$page_break='<div class="page-break"></div>';	
	
	echo $phead.$stbl.$emp_image.$etbl.$stbl.$binfo.$emptyrow.$cinfo.$emrinfo_head.$emrinfo.$depend_head.$dependinfo.$immig_info.$job_info.$sal_info.$rept_head.$rept_info.$exp_head.$expinfo.$qua_head.$quainfo.$skill_head.$skillinfo.$bankinfo.$etbl;
	
	
	
	


?>




<script>
	
	window.print();
	

</script>
