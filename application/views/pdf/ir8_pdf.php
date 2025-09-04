<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta name="" content="">

<link rel="stylesheet" href="<?php echo assest_path; ?>css/css/design.css" />

</head>
<body>
<div class="page">
<div class="subpage">


<div class="page_tp_box">
	
	<h5>Employee's Remuneration For the Year Ended 31 Dec <?php $year ?></h5>
	<h6>The income and deductions printed on this statement are NOT REQUIRED to be report ed
in your tax form.</h6>
	<h6>It will automatically be included in your Income Tax notice of assessment. This st atement
is for your retention.</h6>
	
</div><!--/.page_tp_box-->






<table class="set_tb_spc">
	
	<tbody>
		
		<tr>
			
			<td colspan="2">Employer's Tax Ref.No. :</td>
			<td colspan="2"><?php echo $authorised[0]['ir8a_authorised_roc']; ?></td>
			<td colspan="2">Employee's Tax Ref.No. :</td>
			<td colspan="2"></td>
			
		</tr>
		
		<tr>
			<td colspan="4">Full Name of Employee as per NRIC/FIN :</td>
			<td colspan="4"><?php  echo $res[0]['emp_firstname']." ".$res[0]['emp_lastname']; ?></td>			
		</tr>
		
		<tr>
			<td colspan="2">Residential Address :</td>
			<td colspan="6"><?php  echo $res[0]['emp_contact_temp_street1'].", ".$res[0]['emp_contact_temp_street2'].", ".$res[0]['city_name'].",".$res[0]['state_name']; ?></td>			
		</tr>
		
		<tr>
			<td colspan="2">Nationality :</td>
			<td colspan="1"><?php echo $res[0]['country_nationality']; ?></td>
			<td colspan="1">Sex :</td>
			<td colspan="1"><?php echo ($res[0]['emp_gender']==1)? "Male":"Female"; ?></td>
			<td colspan="1">Designation :</td>
			<td colspan="2"><?php echo $res[0]['job_title_name']; ?></td>			
		</tr>
		
		<tr>
			<td colspan="2">Date of Commencement :</td>
			<td colspan="2"><?php $date=new DateTime($res[0]['emp_job_start_date']); echo $date->format('d M Y'); ?></td>
			<td colspan="3">Date of Cessation/posted overseas :</td>
			<td colspan="1"><?php $date1=new DateTime($res[0]['emp_job_end_date']); if($date1->format('Y')==$year) { echo $date1->format('d M Y'); } ?></td>		
		</tr>
		
		<tr>
			<td colspan="4">Date of Birth :</td>
			<td colspan="4"><?php $date2=new DateTime($res[0]['emp_birthday']); echo $date2->format('d M Y'); ?></td>			
		</tr>
		
		<tr>
			<td colspan="4">Bank Salary is Credited to :</td>
			<td colspan="4"><?php echo $res[0]['employee_bank_name']; ?></td>			
		</tr>
		
		<tr>
			<td colspan="8" class="tbl_head_txt">INCOME</td>					
		</tr>
		
		
		<tr>
			<td colspan="7" ></td>					
			<td colspan="1" class="amt_text">$</td>					
		</tr>
		
		<tr>
			<td colspan="7">a) Gross Salary, Fees, Leave Pay, Wages and Overtime Pay :</td>					
			<td  colspan="1"> <span class="amt_text border_box"><?php echo $res[0]['emp_salary_amount']; ?></span></td>					
		</tr>
		
		<tr>
			<td colspan="7">b) Bonus(noncontractual bonus declared on and /or contractual bonus for service rendered in null):</td>					
			<td  colspan="1" ><span class="amt_text border_box">0.00</span></td>					
		</tr>
		
		
		<tr>
			<td colspan="7">c) Director's fees approved at the company's AGM/EGM on</td>	
			<td  colspan="1" ><span class="amt_text border_box">0.00</span></td>			
		</tr>
		
		<tr>
			<td colspan="8" class="tbl_head_txt">d) OTHERS :</td>					
		</tr>
		
		
		<tr>
			<td colspan="7">1. Gross Commission for period to</td>	
			<td  colspan="1" ><span class="amt_text ">0.00</span></td>			
		</tr>
		
		<tr>
			<td colspan="7">2. Pension</td>	
			<td  colspan="1" ><span class="amt_text">0.00</span></td>			
		</tr>
		
		<tr>
			<td colspan="7">3. Allowances :</td>	
			<td  colspan="1" ><span class="amt_text">0</span></td>			
		</tr>
		
		
		<tr>
			<td colspan="7">4a. Gratuity/Notice pay/Ex-gratia payments/Others</td>	
			<td  colspan="1" ><span class="amt_text">0.00</span></td>			
		</tr>
		
		<tr>
			<td colspan="7">4b. Compensation for loss of office (Approval obtained from IRAS : , Date of approval:)</td>	
			<td  colspan="1" ><span class="amt_text">0.00</span></td>			
		</tr>
		
		
		
		
		
	</tbody>
	
	
	
</table>

</div><!--/.subpage-->
</div><!--/.page-->

<div class="page">
<div class="subpage">
	
<table class="set_tb_spc">
	
	<tbody>	
		
		
		
		
		<tr>
			<td colspan="7">5. Retirement benefits including gratuities/pension/commutation of pension/lump sum payments, etc fro</td>	
			<td  colspan="1" ><span class="amt_text"></span></td>			
		</tr>
		
		
		<tr>
			<td colspan="7">Pension/ProvidentFund</td>	
			<td  colspan="1" ><span class="amt_text"></span></td>			
		</tr>
		
		<tr>
			<td colspan="8" class="tbl_head_txt">Name of Fund :</td>					
		</tr>
		
		<tr>
			<td colspan="7">( Amount accrued up to 31 Dec 1992 : $0.00 ) Amount accrued from 1993 :</td>	
			<td  colspan="1" ><span class="amt_text">0.00</span></td>			
		</tr>
		
		
		<tr>
			<td colspan="7">6. Contributions made by employer to any Pension/Provident Fund constituted outside Singapore :</td>	
			<td  colspan="1" ><span class="amt_text">0.00</span></td>			
		</tr>
		
		
		<tr>
			<td colspan="7">7. Excess/Voluntary contribution to CPF by employer</td>	
			<td  colspan="1" ><span class="amt_text"><?php echo $res[0]['cpf_employer']; ?></span></td>			
		</tr>
		
		
		<tr>
			<td colspan="7">8. Gains and profits from share options S10(1)(b)</td>	
			<td  colspan="1" ><span class="amt_text">0.00</span></td>			
		</tr>
		
		
		<tr>
			<td colspan="7">9. Value of Benefitsinkind</td>	
			<td  colspan="1" ><span class="amt_text">0.00</span></td>			
		</tr>
		
		
		<tr>
			<td colspan="7">TOTAL of items d1 to d9 (excluding 4b)</td>	
			<td  colspan="1" ><span class="amt_text border_box text_right">0.00</span></td>	
		</tr>
		
		<tr>
			<td colspan="7">e) Gains and Profit for share Options granted before 01/01/2003 (S
10(1)(g)) :</td>	
			<td  colspan="1" ><span class="amt_text">0.00</span></td>			
		</tr>
		
		
		<tr>
			<td colspan="7">f) Employee's Income Tax borne by employer : Not applicable</td>	
			<td  colspan="1" ><span class="amt_text"></span></td>			
		</tr>
		
		<tr>
			<td colspan="7">g) Exempt Income/Income subject to Tax Remission : Not applicable</td>	
			<td  colspan="1" ><span class="amt_text"></span></td>			
		</tr>
		
		
		
		<tr>
			<td colspan="8" class="tbl_head_txt">DEDUCTIONS</td>					
		</tr>
		
		<tr>
			<td colspan="7">EMPLOYEE'S COMPULSORY contribution to CPF</td>	
			<td  colspan="1" ><span class="amt_text"><?php echo $res[0]['cpf_employee']; ?> </span></td>			
		</tr>
		
		<tr>
			<td colspan="7"><span class="tbl_head_txt">Donations </span>deducted through salaries for Yayasan Mendaki Fund/Community Chest of Singapore/ SINDA/ CDAC/ ECF/ Other tax exempt donations</td>	
			<td  colspan="1" ><span class="amt_text"><?php echo $res[0]['sum_value']; ?> </span></td>			
		</tr>
		
		<tr>
			<td colspan="7"><span class="tbl_head_txt">Contributions </span>deducted through salaries for Mosque Building Fund</td>	
			<td  colspan="1" ><span class="amt_text">0</span></td>			
		</tr>
		
		
		<tr>
			<td colspan="7"><span class="tbl_head_txt">Life Insurance premiums </span>deducted through salaries</td>	
			<td  colspan="1" ><span class="amt_text">0.00</span></td>			
		</tr>
		
</tbody>
	
	
	
</table>
		
<table class="set_tb_spc">
	
	<tbody>	
		<tr>
			<td colspan="8" class="tbl_head_txt">DECLARATION</td>					
		</tr>
	
		<tr>
			<td colspan="1" >Name of Employer :</td>	
			<td colspan="7"><?php echo $authorised[0]['ir8a_authorised_person'] ?></td>	
		
		</tr>
		
		
		<tr>
			<td colspan="1">Name of division/branch :</td>	
			<td colspan="7"><?php echo $authorised[0]['ir8a_authorised_designation'] ?></td>	
			<td></td>
			<td></td>		
		</tr>
		
		
		<tr>
			<td colspan="1">Address of Employer :</td>	
			<td colspan="7">site 64 sahibabad ghaziabvad India 201010</td>			
		</tr>
		
		<tr>
			<td colspan="1">Name of Authorised Person <br> making the declaration :</td>	
			<td colspan="7"><?php echo $authorised[0]['ir8a_authorised_person'] ?></td>			
		</tr>
		
		<tr>
			<td colspan="1">Designation :</td>	
			<td colspan="7"><?php echo $authorised[0]['ir8a_authorised_designation'] ?></td>			
		</tr>
		
		
		<tr>
			<td colspan="1">Telephone :</td>	
			<td colspan="7"><?php echo $authorised[0]['ir8a_authorised_designation'] ?></td>			
		</tr>
		
		
		
		
		
	</tbody>
	
	
	
</table>

</div><!--/.subpage-->
</div><!--/.page-->
<script>
window.print();
    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.reload();
    }
</script>

</body>
</html>