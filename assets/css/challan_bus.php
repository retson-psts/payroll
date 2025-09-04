<?php 
include('base.php');
$home=new main();
if(isset($_GET['id']))
{
	
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Challan Report</title>
<link href="css/report.css" rel="stylesheet" type="text/css" />
<!--<link href="css/admission.css" type="text/css" rel="stylesheet">-->
</head>

<body>
<div class="print"><a href="#" onclick="window.print()"><img src="images/print.png"></a><a href="chellan-generate.php" onclick=""><img src="images/back.png"></a></div>
<?php 
$no=$home->sanitize($_GET['id'],"numeric",10);
	$array=array();
	$queryappend="";
	if(isset($_GET['course']))
	{
		$course=$home->sanitize($_GET['course'],"numeric",10);
		$queryappend="AND Sno IN(select StuId from student where CourseName=?)";
		$array[0]=$course;
		
	}
	if(isset($_GET['group']))
	{
		$group=$home->sanitize($_GET['group'],"numeric",10);
		$queryappend="AND Sno IN(select StuId from student where GroupId=?)";
		$array[0]=$group;
		
	}
	if(isset($_GET['section']))
	{
		$section=$home->sanitize($_GET['section'],"numeric",10);
		$queryappend="AND Sno IN(select StuId from student where Section=?)";
		$array[0]=$section;
		
	}
	if(isset($_GET['term']))
	{
		$term=$home->sanitize($_GET['term'],"numeric",10);
		$queryappend.="  And Term=?";
		$array[]=$term;
		
	}
	if(isset($_GET['challan']))
	{
		$challan=$home->sanitize($_GET['challan'],"numeric",10);
		$queryappend.="  And ChellanType=?";	
		
		$array[]=$challan;
	}
	if(isset($_GET['stu_id']))
	{
		$challan=$home->sanitize($_GET['stu_id'],"numeric",10);
		$queryappend.="  And Sno=?";	
		
		$array[]=$challan;
	}

$query="select Distinct BankChellanNo,ChellanType,Term from FeeFixed where FeeFixedId<>0 ".$queryappend;
$stmt=$home->db->prepare($query);
$stmt->execute($array);
//echo $query;
 ?>
<div class="container">
<?php 
$i=0;


foreach($stmt as $cid)
{
	$termv=$cid['Term'];
	$i++;
	$chellan=$cid['BankChellanNo'];
	
	$querychellan="select PrintName,sum(FeesDueAmount) as fee from FeeFixed where BankChellanNo=? group by PrintName";
	$arraychellan=array($chellan);
	$sid=$home->stuid_chellan($chellan);
	//echo $querychellan;
	echo $chellan."--".$cid['Term']."--".$cid['ChellanType'];
	/*$stmtchellan=$home->db->prepare($querychellan);
    $stmtchellan->execute($arraychellan);
	foreach($stmtchellan as $row)
	{*/
	
	 ?>
<?php if($cid['ChellanType']==1)
{?>



<div class="box">
<div class="head">


<div class="logo"><img src="images/axis-logo.png" /></div> 
<div class="no-box"><?php echo $chellan; ?></div>

<div class="clear"></div>
<div class="branch">Sathyamangalam</div>
<div class="copytype">(Bank Copy)</div>
<div class="clear"></div>
<div class="date"><span class="">Date</span> <span>___ /___ / 201</span></div>
<div class="clear"></div>
<div class="credit">For credit of SB A/c No. <span class="account">36801010004991</span></div>
<div class="clear"></div>
<div class="Acname">
<span class="ac">A/c Name:</span><span class="name" style="width: 229px;font-size: 10.6px;">BANNARI AMMAN VIDYA NIKETAN MATRICULATION<br/>
HIGHER SECONDARY SCHOOL, ALATHUKOMBAI</span>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="details">
<div class="admissionno">Admission No: <span ><b><?php echo $home->__admissionno($sid); ?></b></span></div>
<div class="admissionno">Name:  <span><b><?php echo $home->name_student($sid); ?></b></span></div>
<div class="admissionno">Class:  <span><b><?php echo $home->groupsection($sid); ?></b></span></div>

</div>
<div class="clear">
</div>
<table>
<tr>
<th width="150px">Details</th><th>Amount<br />
(?)</th>
</tr>
<?php 
	$stmtchellan1=$home->db->prepare($querychellan);
    $stmtchellan1->execute($arraychellan);
    $stmtchellan=$stmtchellan1->fetchAll();
	$total=0;
	$print="";
	$total1=0;
	$i=0;
	$count=count($stmtchellan);
	$tutionfee=0;
	$busfees=0;
	$omfees=0;
	$costbook=0;
	$costnote=0;
	$termv=1;
	foreach($stmtchellan as $row)
	{
		if($row['PrintName']=='Tution Fee')
		{
			$tutionfee=$row['fee'];
		}
		if($row['PrintName']=='Bus Fee')
		{
			$busfees=$row['fee'];	
		}
		if($row['PrintName']=='Other Miscellaneous Fee')
		{
			$omfees=$row['fee'];
		}
		if($row['PrintName']=='Cost of Books')
		{
			$costbook=$row['fee'];	
		}
		if($row['PrintName']=='Cost of Note Books')
		{
			$costnote=$row['fee'];	
		}
		
		 $total+=$row['fee'];
		 $i++;
 } ?>

<tr><td>Tuition Fee - Term <?php echo $termv; ?> </td><td><?php echo  number_format($tutionfee,2); ?></td></tr>
<tr><td>Bus fee</td><td><?php echo  number_format($busfees,2); ?></td></tr>
<tr><td>Other / Miscellaneous Fee</td><td><?php echo  number_format($omfees,2); ?></td></tr>
<tr><td>Cost of Books</td><td><?php echo  number_format($costbook,2); ?></td></tr>
<tr><td>Cost of Note Books</td><td><?php echo  number_format($costnote,2); ?></td></tr>
<!--<tr><td>Fees 2</td><td></td></tr>
<tr><td>Fees 3</td><td></td></tr>
<tr><td>Fees 4</td><td></td></tr>-->
<tr><td>Total ?</td><td><?php echo number_format($total,2); ?></td></tr>
</table>

<div class="clear"></div>
<div class="admissionno">Received (Rupees <b><?php echo $home->convert_number($total); ?></b> only)</div>
<div class="admissionno">Contact Phone/Mobile No _______________</div>
<br />

<div class="admissionno" >institution Authentication </div>
<div class="border-div"></div>



  
</div>

</div>

<div class="box">
<div class="head">


<div class="logo"><img src="images/axis-logo.png" /></div> 
<div class="no-box"><?php echo $chellan; ?></div>

<div class="clear"></div>
<div class="branch">Sathyamangalam</div>
<div class="copytype">(Institution Copy)</div>
<div class="clear"></div>
<div class="date"><span class="">Date</span> <span>___ /___ / 201</span></div>
<div class="clear"></div>
<div class="credit">For credit of SB A/c No. <span class="account">36801010004991</span></div>
<div class="clear"></div>
<div class="Acname">
<span class="ac">A/c Name:</span><span class="name" style="width: 229px;font-size: 10.6px;">BANNARI AMMAN VIDYA NIKETAN MATRICULATION<br/>
HIGHER SECONDARY SCHOOL, ALATHUKOMBAI</span>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="details">
<div class="admissionno">Admission No: <span ><b><?php echo $home->__admissionno($sid); ?></b></span></div>
<div class="admissionno">Name:  <span><b><?php echo $home->name_student($sid); ?></b></span></div>
<div class="admissionno">Class:  <span><b><?php echo $home->groupsection($sid); ?></b></span></div>

</div>
<div class="clear">
</div>
<table>
<tr>
<th width="150px">Details</th><th>Amount<br />
(?)</th>
</tr>
<?php 
	$stmtchellan1=$home->db->prepare($querychellan);
    $stmtchellan1->execute($arraychellan);
    $stmtchellan=$stmtchellan1->fetchAll();
	$total=0;
	$print="";
	$total1=0;
	$i=0;
	$count=count($stmtchellan);
	$tutionfee=0;
	$busfees=0;
	$omfees=0;
	$costbook=0;
	$costnote=0;
	$termv=1;
	foreach($stmtchellan as $row)
	{
		if($row['PrintName']=='Tution Fee')
		{
			$tutionfee=$row['fee'];
		}
		if($row['PrintName']=='Bus Fee')
		{
			$busfees=$row['fee'];	
		}
		if($row['PrintName']=='Other Miscellaneous Fee')
		{
			$omfees=$row['fee'];
		}
		if($row['PrintName']=='Cost of Books')
		{
			$costbook=$row['fee'];	
		}
		if($row['PrintName']=='Cost of Note Books')
		{
			$costnote=$row['fee'];	
		}
		
		 $total+=$row['fee'];
		 $i++;
 } ?>

<tr><td>Tuition Fee - Term <?php echo $termv; ?>  </td><td><?php echo  number_format($tutionfee,2); ?></td></tr>
<tr><td>Bus fee</td><td><?php echo  number_format($busfees,2); ?></td></tr>
<tr><td>Other / Miscellaneous Fee</td><td><?php echo  number_format($omfees,2); ?></td></tr>
<tr><td>Cost of Books</td><td><?php echo  number_format($costbook,2); ?></td></tr>
<tr><td>Cost of Note Books</td><td><?php echo  number_format($costnote,2); ?></td></tr>
<!--<tr><td>Fees 2</td><td></td></tr>
<tr><td>Fees 3</td><td></td></tr>
<tr><td>Fees 4</td><td></td></tr>-->
<tr><td>Total ?</td><td><?php echo number_format($total,2); ?></td></tr>
</table>


<div class="clear"></div>
<div class="admissionno">Received (Rupees <b><?php echo $home->convert_number($total); ?></b> only)</div>
<div class="admissionno">Contact Phone/Mobile No _______________</div>
<br />

<div class="admissionno" >institution Authentication </div>
<div class="border-div"></div>



  
</div>

</div>

<div class="box">
<div class="head">


<div class="logo"><img src="images/axis-logo.png" /></div> 
<div class="no-box"><?php echo $chellan; ?></div>

<div class="clear"></div>
<div class="branch">Sathyamangalam</div>
<div class="copytype">(Student Copy)</div>
<div class="clear"></div>
<div class="date"><span class="">Date</span> <span>___ /___ / 201</span></div>
<div class="clear"></div>
<div class="credit">For credit of SB A/c No. <span class="account">36801010004991</span></div>
<div class="clear"></div>
<div class="Acname">
<span class="ac">A/c Name:</span><span class="name" style="width: 229px;font-size: 10.6px;">BANNARI AMMAN VIDYA NIKETAN MATRICULATION<br/>
HIGHER SECONDARY SCHOOL, ALATHUKOMBAI</span>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div class="details">
<div class="admissionno">Admission No: <span ><b><?php echo $home->__admissionno($sid); ?></b></span></div>
<div class="admissionno">Name:  <span><b><?php echo $home->name_student($sid); ?></b></span></div>
<div class="admissionno">Class:  <span><b><?php echo $home->groupsection($sid); ?></b></span></div>

</div>
<div class="clear">
</div>
<table>
<tr>
<th width="150px">Details</th><th>Amount<br />
(?)</th>
</tr>
<?php 
	$stmtchellan1=$home->db->prepare($querychellan);
    $stmtchellan1->execute($arraychellan);
    $stmtchellan=$stmtchellan1->fetchAll();
	$total=0;
	$print="";
	$total1=0;
	$i=0;
	$count=count($stmtchellan);
	$tutionfee=0;
	$busfees=0;
	$omfees=0;
	$costbook=0;
	$costnote=0;
	$termv=1;
	foreach($stmtchellan as $row)
	{
		if($row['PrintName']=='Tution Fee')
		{
			$tutionfee=$row['fee'];
		}
		if($row['PrintName']=='Bus Fee')
		{
			$busfees=$row['fee'];	
		}
		if($row['PrintName']=='Other Miscellaneous Fee')
		{
			$omfees=$row['fee'];
		}
		if($row['PrintName']=='Cost of Books')
		{
			$costbook=$row['fee'];	
		}
		if($row['PrintName']=='Cost of Note Books')
		{
			$costnote=$row['fee'];	
		}
		
		 $total+=$row['fee'];
		 $i++;
 } ?>

<tr><td>Tuition Fee - Term <?php echo $termv; ?> </td><td><?php echo  number_format($tutionfee,2); ?></td></tr>
<tr><td>Bus fee</td><td><?php echo  number_format($busfees,2); ?></td></tr>
<tr><td>Other / Miscellaneous Fee</td><td><?php echo  number_format($omfees,2); ?></td></tr>
<tr><td>Cost of Books</td><td><?php echo  number_format($costbook,2); ?></td></tr>
<tr><td>Cost of Note Books</td><td><?php echo  number_format($costnote,2); ?></td></tr>
<!--<tr><td>Fees 2</td><td></td></tr>
<tr><td>Fees 3</td><td></td></tr>
<tr><td>Fees 4</td><td></td></tr>-->
<tr><td>Total ?</td><td><?php echo number_format($total,2); ?></td></tr>
</table>


<div class="clear"></div>
<div class="admissionno">Received (Rupees <b><?php echo $home->convert_number($total); ?></b> only)</div>
<div class="admissionno">Contact Phone/Mobile No _______________</div>
<br />

<div class="admissionno" >institution Authentication </div>
<div class="border-div"></div>



  
</div>

</div>
<div class="clear"></div>
<div class="divider1"></div>


<?php } 
else if($cid['ChellanType']=2)
{
			?>
<div class="box">
<div class="head">


<div class="logo"><img src="images/axis-logo.png" /></div> 
<div class="no-box"><?php echo $chellan; ?></div>

<div class="clear"></div>
<div class="branch">Sathyamangalam</div>
<div class="copytype">(Bank Copy)</div>
<div class="clear"></div>
<div class="date"><span class="">Date</span> <span>___ /___ / 201</span></div>
<div class="clear"></div>
<div class="credit">For credit of SB A/c No. <span class="account">913010022608145</span></div>
<div class="clear"></div>
<div class="Acname">
<span class="ac">A/c Name:</span><span class="name">BANNARI AMMAN EDUCATIONAL TRUST</span>
<span class="optional">OPTIONAL FEE ACCOUNT</span>

</div>
<div class="clear"></div>
<div class="details">
<div class="admissionno">Admission No: <span ><b><?php echo $home->__admissionno($sid); ?></b></span></div>
<div class="admissionno">Name:  <span><b><?php echo $home->name_student($sid); ?></b></span></div>
<div class="admissionno">Class:  <span><b><?php echo $home->groupsection($sid); ?></b></span></div>

</div>
<div class="clear">
</div>
<table>
<tr>
<th width="150px">Details</th><th>Amount<br />
(?)</th>
</tr>
<?php 
$stmtchellan=$home->db->prepare($querychellan);
    $stmtchellan->execute($arraychellan);
   $total=0;
	$print="";
	$total1=0;
	$i=0;
	$count=count($stmtchellan);
	$stmtchellan12=$stmtchellan->fetchAll();
	foreach($stmtchellan12 as $row)
	{
		
		/*echo "<tr><td>".$row['PrintName']."</td><td>".number_format($row['fee'],2)."</td></tr>";*/
		/*if($print!=$row['PrintName'])
		{
			
			$print=$row['PrintName'];
			if($i==0)
			{
				echo "<tr><td>".$row['PrintName']."</td>";			
			}
			else
			{
				if($i!=($count-1))
				{
				  	echo "<td>$total1</td></tr>";
				}
				else
				{
					echo "<td>$total1</td></tr><tr><td>".$row['PrintName']."</td>";
				  	
				}
			}
			$total1+=$row['FeesDueAmount'];
			
		}
		else
		{
			
			$total1+=$row['FeesDueAmount'];
		}
		 */
		 
		 $total+=$row['fee'];
		 $i++;
 } ?>

<!--<tr><td>Fees 2</td><td></td></tr>
<tr><td>Fees 3</td><td></td></tr>
<tr><td>Fees 4</td><td></td></tr>-->
<tr><td>Optional fee for value added courses like I.L.M, Karate, Computer, Digi classes Dance, Skating, Silambam, Yoga etc., Term <?php echo $termv; ?></td><td><?php echo number_format($total,2); ?></td></tr>
<tr><td>Total ?</td><td><?php echo number_format($total,2); ?></td></tr>
</table>

<div class="clear"></div>
<div class="admissionno">Received (Rupees <b><?php echo $home->convert_number($total); ?></b> only)</div>
<div class="admissionno">Contact Phone/Mobile No _______________</div>
<br />

<div class="admissionno" >institution Authentication </div>
<div class="border-div"></div>



  
</div>

</div>

<div class="box">
<div class="head">


<div class="logo"><img src="images/axis-logo.png" /></div> 
<div class="no-box"><?php echo $chellan; ?></div>

<div class="clear"></div>
<div class="branch">Sathyamangalam</div>
<div class="copytype">(Institution Copy)</div>
<div class="clear"></div>
<div class="date"><span class="">Date</span> <span>___ /___ / 201</span></div>
<div class="clear"></div>
<div class="credit">For credit of SB A/c No. <span class="account">913010022608145</span></div>
<div class="clear"></div>
<div class="Acname">
<span class="ac">A/c Name:</span><span class="name">BANNARI AMMAN EDUCATIONAL TRUST</span>
<span class="optional">OPTIONAL FEE ACCOUNT</span>

</div>
<div class="clear"></div>
<div class="details">
<div class="admissionno">Admission No: <span ><b><?php echo $home->__admissionno($sid); ?></b></span></div>
<div class="admissionno">Name:  <span><b><?php echo $home->name_student($sid); ?></b></span></div>
<div class="admissionno">Class:  <span><b><?php echo $home->groupsection($sid); ?></b></span></div>
</div>
<div class="clear">
</div>
<table>
<tr>
<th width="150px">Details</th><th>Amount<br />
(?)</th>
</tr>


 <?php 

	$total=0;
	foreach($stmtchellan12 as $row)
	{
?>	
<!--<tr><td><?php echo $row['PrintName'] ?></td><td><?php echo number_format($row['fee'],2); ?></td></tr>-->

<?php  $total+=$row['fee'];
 } ?>
<!--<tr><td>Fees 2</td><td></td></tr>
<tr><td>Fees 3</td><td></td></tr>
<tr><td>Fees 4</td><td></td></tr>-->
<tr><td>Optional fee for value added courses like I.L.M, Karate, Computer, Digi classes Dance, Skating, Silambam, Yoga etc.,  Term <?php echo $termv; ?></td><td><?php echo number_format($total,2); ?></td></tr>
<tr><td>Total ?</td><td><?php echo number_format($total,2); ?></td></tr>
</table>


<div class="clear"></div>
<div class="admissionno">Received (Rupees <b><?php echo $home->convert_number($total); ?></b> only)</div>
<div class="admissionno">Contact Phone/Mobile No _______________</div>
<br />

<div class="admissionno" >institution Authentication </div>
<div class="border-div"></div>



  
</div>

</div>

<div class="box">
<div class="head">


<div class="logo"><img src="images/axis-logo.png" /></div> 
<div class="no-box"><?php echo $chellan; ?></div>

<div class="clear"></div>
<div class="branch">Sathyamangalam</div>
<div class="copytype">(Student Copy)</div>
<div class="clear"></div>
<div class="date"><span class="">Date</span> <span>___ /___ / 201</span></div>
<div class="clear"></div>
<div class="credit">For credit of SB A/c No. <span class="account">913010022608145</span></div>
<div class="clear"></div>
<div class="Acname">
<span class="ac">A/c Name:</span><span class="name">BANNARI AMMAN EDUCATIONAL TRUST</span>
<span class="optional">OPTIONAL FEE ACCOUNT</span>

</div>
<div class="clear"></div>
<div class="details">
<div class="admissionno">Admission No: <span ><b><?php echo $home->__admissionno($sid); ?></b></span></div>
<div class="admissionno">Name:  <span><b><?php echo $home->name_student($sid); ?></b></span></div>
<div class="admissionno">Class:  <span><b><?php echo $home->groupsection($sid); ?></b></span></div>
</div>
<div class="clear">
</div>
<table>
<tr>
<th width="150px">Details</th><th>Amount<br />
(?)</th>
</tr>
<?php 

	$total=0;
	foreach($stmtchellan12 as $row)
	{
?>	
<!--<tr><td><?php echo $row['PrintName'] ?></td><td><?php echo number_format($row['fee'],2); ?></td></tr>-->

<?php  $total+=$row['fee'];
 } ?>


<!--<tr><td>Fees 2</td><td></td></tr>
<tr><td>Fees 3</td><td></td></tr>
<tr><td>Fees 4</td><td></td></tr>-->
<tr><td>Optional fee for value added courses like I.L.M, Karate, Computer, Digi classes Dance, Skating, Silambam, Yoga etc.,  Term <?php echo $termv; ?></td><td><?php echo number_format($total,2); ?></td></tr>
<tr><td>Total ?</td><td><?php echo number_format($total,2); ?></td></tr>
</table>

<div class="clear"></div>
<div class="admissionno">Received (Rupees <b><?php echo $home->convert_number($total); ?></b> only)</div>
<div class="admissionno">Contact Phone/Mobile No _______________</div>
<br />

<div class="admissionno" >institution Authentication </div>
<div class="border-div"></div>



  
</div>

</div>
<div class="clear"></div>
<div class="divider1"></div>

            
            <?php
		}
?>


<?php }
for($y=0;$y<$i;$y++)
{
	
 ?>
 <!--<div class="box1">
 <table class="table1">
<tr>
<th width="85px">Notes</th><th width="130px">Rs<br />
(?)</th><th>P</th>

</tr>
<tr>
<td>1000 * </td><td></td><td></td>
</tr>
<tr>
<td>500 * </td><td></td><td></td>
</tr>
<tr>
<td>100 * </td><td></td><td></td>
</tr>
<tr>
<td>50 * </td><td></td><td></td>
</tr>
<tr>
<td>20 * </td><td></td><td></td>
</tr>
<tr>
<td>10 * </td><td></td><td></td>
</tr>
<tr>
<td>Coins </td><td></td><td></td>
</tr>
<tr>
<td>Total </td><td></td><td></td>
</tr>
</table>
</div>
<div class="clear"></div>
<div class="divider1"></div>
<div class="clear"></div>-->
 <?php  } 
 if($i==0)
 {
	 echo "<h2>No Challan available this criteria</h2>";
 }
?>


</div>
</body>
</html>

<?php }

?>