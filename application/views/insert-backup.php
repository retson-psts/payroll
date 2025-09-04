<?php 
include('process.php');
$home=new process1();
if(isset($_GET['msg']))
{
	
	$msg=$home->sanitize($_GET['msg'],'string',100);
	//echo $msg;
	$msgarray=explode('!',$msg);
	$home->insertmsg($msg);
	$completed=0;
	$insert_datetime=date('Y-m-d H:i:s');
	//var_dump($msgarray);
	/**
	* 
	* @var msg receive contains A0
	* @method Motor On
	* 
	*/
	if($home->endsWith1($msg,'A0'))
	{
		try
		{
			$home->db->beginTransaction();
			$date=$home->format_time($msgarray[3],'H:i-d/m/y','Y-m-d H:i:s');
			
			$by=explode('-',$msgarray[6]);
			$by1=$by[1];
			$time=$msgarray[5];
			$dev_id=trim($msgarray[7]);
			$v=explode('/',$msgarray[8]);
			$v1=explode('-',$v[0]);
			$c1=explode('-',$v[1]);
			$c2=explode('-',$v[2]);
			$notification="Motor On at ".$msgarray[3]." by ".$by1;
			$query = "UPDATE DevData set PhaseAvailable='3',MotorStatus=1,LastUpdateTime=?,LastOn=?,v1=?,v2=?,v3=?,TV=?,C1=?,C2=?,C3=?,TC=?,notification=?,msgrectime=?,OnOffBy=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($time,$date,substr($v1[0],2),$v1[1],$v1[2],trim($c1[0],'A'),$c1[1],$c1[2],$c1[3],$v[2],$notification,$time,$by1,$insert_datetime,$dev_id);
	       	$stmt->execute($array);
	        $date1=$home->format_time($msgarray[3],'H:i-d/m/y','Y-m-d');
	        $q1_select="select id from current_voltage where `serial_no`=? AND `change_date`=?";
	        $s1_state=$home->db->prepare($q1_select);
	        $array2=array($dev_id,$date1);
	        $s1_state->execute($array2);
	        $res=$s1_state->fetchAll();
	        if($s1_state->rowCount())
	        {
				
				$q_insert="update current_voltage set `insert_date`=?,`c1`=?,`c2`=?,`c3`=?,`v1`=?,`v2`=?,`v3`=?,`tv`=?,`tc`=? where id=?";
				$q_state=$home->db->prepare($q_insert);
		        $array1=array(date('Y-m-d H:i:s'),$c1[1],$c1[2],$c1[3],substr($v1[0],2),$v1[1],$v1[2],trim($c1[0],'A'),$v[0],$res[0]['id']);
		        
		        $q_state->execute($array1);
		       
			}
			else
			{
				
				$q_insert="insert into current_voltage(`insert_date`,`change_date`,`serial_no`,`c1`,`c2`,`c3`,`v1`,`v2`,`v3`,`tv`,`tc`) values(?,?,?,?,?,?,?,?,?,?,?)";
		        $q_state=$home->db->prepare($q_insert);
		       $array1=array(date('Y-m-d H:i:s'),$date1,$dev_id,$c1[1],$c1[2],$c1[3],substr($v1[0],2),$v1[1],$v1[2],trim($c1[0],'A'),$v[0]);
		        $q_state->execute($array1);
	        }
	        
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	       
	        $home->db->commit();
	       
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			
			echo "Error".$e;
			$home->db->rollBack();
			
		}
		
	}
	/**
	* 
	* @var Msg recieve contains A1
	* @method motor Off
	*/
	if($home->endsWith1($msg,'A1'))
	{
		try
		{
			$home->db->beginTransaction();
			
			$dateon=$home->format_time($msgarray[5],'H:i-d/m/y','Y-m-d H:i:s');
			$dateoff=$home->format_time($msgarray[3],'H:i-d/m/y','Y-m-d H:i:s');
			$by=explode('-',$msgarray[8]);
			$by1=$by[1];
			$time=$msgarray[7];
			$dev_id=trim($msgarray[9]);
			$v=explode('/',$msgarray[10]);
			$v1=explode('-',$v[0]);
			$c1=explode('-',$v[1]);
			$c2=explode('-',$v[2]);
			$notification="Motor Off at ".$msgarray[3]." by ".$by1;
			$query = "UPDATE DevData set PhaseAvailable='3',MotorStatus=0,LastUpdateTime=?,LastOn=?,LastOff=?,v1=?,v2=?,v3=?,TV=?,C1=?,C2=?,C3=?,TC=?,notification=?,msgrectime=?,OnOffBy=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($time,$dateon,$dateoff,substr($v1[0],2),$v1[1],$v1[2],trim($c1[0],'A'),$c1[1],$c1[2],$c1[3],$v[2],$notification,$time,$by1,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	       /* $home->insertmsg($msg);  */
	        $date1=$home->format_time($msgarray[3],'H:i-d/m/y','Y-m-d');
	        $q1_select="select id from current_voltage where `serial_no`=? AND `change_date`=?";
	        $s1_state=$home->db->prepare($q1_select);
	        $array2=array($dev_id,$date1);
	        $s1_state->execute($array2);
	        $res=$s1_state->fetchAll();
	        if($s1_state->rowCount())
	        {
				
				$q_insert="update current_voltage set `insert_date`=?,`c1`=?,`c2`=?,`c3`=?,`v1`=?,`v2`=?,`v3`=?,`tv`=?,`tc`=? where id=?";
				$q_state=$home->db->prepare($q_insert);
		        $array1=array(date('Y-m-d H:i:s'),$c1[1],$c1[2],$c1[3],substr($v1[0],2),$v1[1],$v1[2],trim($c1[0],'A'),$v[2],$res[0]['id']);
		        
		        $q_state->execute($array1);
		       
			}
			else
			{
				
				$q_insert="insert into current_voltage(`insert_date`,`change_date`,`serial_no`,`c1`,`c2`,`c3`,`v1`,`v2`,`v3`,`tv`,`tc`) values(?,?,?,?,?,?,?,?,?,?,?)";
		        $q_state=$home->db->prepare($q_insert);
		       $array1=array(date('Y-m-d H:i:s'),$date1,$dev_id,$c1[1],$c1[2],$c1[3],substr($v1[0],2),$v1[1],$v1[2],trim($c1[0],'A'),$v[2]);
		       
		        $q_state->execute($array1);
	        }
	       
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	/**
	* 
	* @var A4
	* @method fix current time
	* 
	*/
	if($home->endsWith1($msg,'A4'))
	{
		try
		{
			$home->db->beginTransaction();
			//var_dump($msgarray);
			$current=$home->format_time($msgarray[1],'H:i:s d/m/y','Y-m-d H:i:s');
			$dev_id=$msgarray[3];
			$query = "UPDATE DevData set currenttime=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($current,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
		
	}
	/**
	* 
	* @var A6 AUTO ON TIME and remaining
	* 
	*/
	if($home->endsWith1($msg,'A6'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=8)
  0 => string 'TIMER MODE ENABLEDON @ ' (length=23)
  1 => string '14:59' (length=5)
  2 => string 'RUN TIME - ' (length=11)
  3 => string '00:05' (length=5)
  4 => string 'Time-' (length=5)
  5 => string '14:57:06' (length=8)
  6 => string '1504MS200000' (length=12)
  7 => string 'A608' (length=4)*/
			$current=$home->format_time($msgarray[1],'H:i','H:i:s');
			$runtime=$home->format_time($msgarray[3],'H:i','H:i:s');
			$msg_time=$msgarray[5];
			$dev_id=$msgarray[6];
			$enabled=0;
			if(strpos($msgarray[0],'ENABLED') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set  	ATONTime=?,ATRunTime=?,msgrectime=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($current,$runtime,$msg_time,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	/**
	* 
	* @var B0
	* 
	*/
	if($home->endsWith1($msg,'B0'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=6)
  0 => string 'MOTOR ON in ONTREMAINING ONTIME= ' (length=33)
  1 => string '00:06' (length=5)
  2 => string '*Timer and Auto ON disabled*Time-' (length=33)
  3 => string '14:28:58' (length=8)
  4 => string '1504MS200000' (length=12)
  5 => string 'B025' (length=4)*/
			$current=$home->format_time($msgarray[1],'H:i','H:i:s');
			$msg_time=$msgarray[3];
			$dev_id=$msgarray[4];
			$enabled=0;
			if(strpos($msgarray[0],'ENABLED') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set ONTRemaining=?,msgrectime=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($current,$msg_time,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	/**
	* 
	* @var 
	* 
	*/
	if($home->endsWith1($msg,'B1'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=7)
  0 => string 'MOTOR ON IN TIMER MODEON - ' (length=27)
  1 => string '16:50' (length=5)
  2 => string 'REMAINING RUN TIME - ' (length=21)
  3 => string '00:05Time-' (length=10)
  4 => string '16:51:41' (length=8)
  5 => string '1504MS200000' (length=12)
  6 => string 'B114' (length=4)*/
			$current=$home->format_time($msgarray[1],'H:i','H:i:s');
			$msg_time=substr($msgarray[3],0,5);
			$receivetime=$msgarray[4];
			$dev_id=$msgarray[5];
			/*$enabled=0;
			if(strpos($msgarray[0],'ENABLED') !== false)
			{
				$enabled=1;
			}*/
			
			$query = "UPDATE DevData set ATONTime=?,ATONRemTime=?,msgrectime=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($current,$msg_time,$receivetime,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
		
		
	}
 	/**
	 * 
	 * @var 
	 * 
	 */
	if($home->endsWith1($msg,'B2'))
	{
		try
		{
			$home->db->beginTransaction();
			
			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'ENABLED') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set TimerMode=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'B4'))
	{
		try
		{
			$home->db->beginTransaction();
			
			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'ON') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set AUTOTimer=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
		
	}
	if($home->endsWith1($msg,'B5'))
	{
		try
		{
			$home->db->beginTransaction();
			
			$dev_id=$msgarray[1];
			/*$enabled=0;*/
			if(strpos($msgarray[0],'OFF') !== false)
			{
				$enabled=0;
				$query = "UPDATE DevData set AUTOTimer=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	         $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
			}
			else
			{
				
			}
			
	       
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'B6'))
	{
		try
		{
			$home->db->beginTransaction();
			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
				
			}
			$query = "UPDATE DevData set DRS=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'B9'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=7)
  0 => string 'Light on/off EnabledON@-' (length=24)
  1 => string '15:18' (length=5)
  2 => string 'OFF@-' (length=5)
  3 => string '15:22' (length=5)
  4 => string 'TO-' (length=3)
  5 => string '1504MS200000' (length=12)
  6 => string 'B927' (length=4)*/
			$on=$home->format_time($msgarray[1],'H:i','H:i:s');
			$off=$home->format_time($msgarray[3],'H:i','H:i:s');
			$dev_id=$msgarray[5];
			$enabled=0;
			if(strpos($msgarray[0],' Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set LightEnable=?,LightON=?,LightOFF=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$on,$off,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'D1'))
	{
		try
		{
			$home->db->beginTransaction();
			
			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set SMSReply=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if(strpos($msgarray[0],'FLOAT Sensing') !== false)
	{
		/*FloatSensing*/
		/*array (size=3)
		  0 => string 'FLOAT SensingEnabled TO-' (length=24)
		  1 => string '1504MS200000' (length=12)
		  2 => string '48' (length=2)*/
		try
		{
			$home->db->beginTransaction();
			
			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
				
			}
			
			$query = "UPDATE DevData set FloatSensing=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
		  
  
  
  
	}

	if($home->endsWith1($msg,'D8'))
	{
		/*
		array (size=11)
  0 => string '' (length=0)
  1 => string '918870346164' (length=12)
  2 => string ' ADDED SUCCESSFULLY AS ' (length=23)
  3 => string 'ADMIN-1' (length=7)
  4 => string ' TO- ' (length=5)
  5 => string '1504MS200000' (length=12)
  6 => string 'OP:' (length=3)
  7 => string '        ' (length=8)
  8 => string 'RF: ' (length=4)
  9 => string '16 - 1' (length=6)
  10 => string 'D871' (length=4)
		
		*/
		try
		{
			
			$home->db->beginTransaction();
			$mobile=$msgarray[1];
			if($msgarray[3]!='MASTER')
			{
			$admin1=explode('-',$msgarray[3]);
			$admin=$admin1[1];
			$operator=$msgarray[7];
			$dev_id=$msgarray[5];
			
			$query = "UPDATE DevData set A".$admin."NO=?,A".$admin."Operator=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($mobile,$operator,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
			}
			else
			{
			$operator=$msgarray[7];
			$dev_id=$msgarray[5];
			$query = "UPDATE DevData set MrNo=?,MrOperator=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($mobile,$operator,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
			}
			
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
		
	}
	if($home->endsWith1($msg,'D6'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=3)
  0 => string 'A6 - NumberDeleted To - ' (length=24)
  1 => string '1504MS200000' (length=12)
  2 => string 'D607' (length=4)
*/			
			$admin1=explode('-',$msgarray[0]);
			
			$admin=trim($admin1[0]);
			if($admin=='MR')
			{
				$admin='Mr';
				
			}
			if($admin=='ALL')
			{
				$str="A1NO='',A1Operator='',A2NO='',A2Operator='',A3NO='',A3Operator='',A4NO='',A4Operator='',A5NO='',A5Operator='',A6NO='',A6Operator='',A7NO='',A7Operator='',A8NO='',A8Operator='',A9NO='',A9Operator='',A0NO='',A0Operator='',MrNo='',MrOperator=''";
			}
			else
			{
				$str=$admin."NO='',".$admin."Operator=''";
			}
			$dev_id=$msgarray[1];
			
			$s='';
			$query = "UPDATE DevData set ".$str.",insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'D7'))
	{
		
	}
	if($home->endsWith1($msg,'E3'))
	{
		/*array (size=3)
  0 => string 'Enabled Network Time UpdateTo-' (length=30)
  1 => string '1504MS200000' (length=12)
  2 => string 'E326' (length=4)*/
  		try
		{
			$home->db->beginTransaction();
			
			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
				
			}
			$query = "UPDATE DevData set NetworkTime=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	         $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
  
  
  
	}
	if($home->endsWith1($msg,'E5'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=3)
  0 => string '*MWS-MS2*MOTOR WILL START AFTER00:10(mm:ss)TO- ' (length=47)
  1 => string '1504MS200000' (length=12)
  2 => string 'E501' (length=4)*/
  			$time=substr($msgarray[0],-16,5);
  			
  			$time1=$home->format_time($time,'i:s','H:i:s');
  			
  			
			$dev_id=$msgarray[1];
			$query = "UPDATE DevData set POD=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($time1,$insert_datetime,$dev_id);
	         $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'E6'))
	{
		
	}
	if($home->endsWith1($msg,'E7'))
	{
		
	}
	
	if($home->endsWith1($msg,'F1'))
	{
		
	}
	if($home->endsWith1($msg,'E8'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=7)
  0 => string 'STARTER ON and OFF DELAY STOREDON- ' (length=35)
  1 => string '2' (length=1)
  2 => string ' secOFF- ' (length=9)
  3 => string '2' (length=1)
  4 => string ' secTO- ' (length=8)
  5 => string '1504MS200000' (length=12)
  6 => string 'E846' (length=4)*/
  			$on=$msgarray[1];
  			$off=$msgarray[3];
  			
  			
			$dev_id=$msgarray[5];
			$query = "UPDATE DevData set SDLOn=?,SDLOff=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($on,$off,$insert_datetime,$dev_id);
	         $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'E9'))
	{
		try
		{
			$home->db->beginTransaction();
			
			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set FeedbackSensing=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	
	if($home->endsWith1($msg,'F1'))
	{
		try
		{
			$home->db->beginTransaction();
			
			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set EPS=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}

	if($home->endsWith1($msg,'F3'))
	{
		try
		{
			/*array (size=2)
  0 => string '*1504MS200000*250515*1438*0000*0000*' (length=36)
  1 => string 'F306' (length=4)*/
			$home->db->beginTransaction();
			$split=explode('*',$msgarray[0]);
			$dev_id=$split[1];
			//$date=$home->format_time($msgarray[1],'H:i-d/m/y','Y-m-d H:i:s');
			$date=substr_replace($split[2], '/', 2, 0);
			$date=substr_replace($date, '/', 5, 0);
			var_dump($date);
			$date=$home->format_time($date,'d/m/y','Y-m-d');
			
			$power_avail=substr_replace($split[3], ':', 2, 0);
			$motorrun=substr_replace($split[4], ':', 2, 0);
			$generator_run=substr_replace($split[5], ':', 2, 0);
			
			$device=$home->serialtoid($dev_id);
			
			$query = "UPDATE DevData set LogDate=?,MotorRunTime=?,GenRunTime=?,PowerAvailableTime=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($date,$power_avail,$motorrun,$generator_run,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	        $query_log="INSERT INTO `data` ( `PSno`, `Date`, `Power`, `Motor1`, `Motor2`, `UserID`) VALUES(?,?,?,?,?,?) ";			
	        $user_id=1;
	        $stmt_log=$home->db->prepare($query_log);
	        $array_log=array($device,$date,$power_avail,$motorrun,$generator_run,$user_id);
	        $stmt_log->execute($array_log);
	        /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo $e;
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'F6'))
	{
		
	}
	if($home->endsWith1($msg,'F7'))
	{
		
  		try
		{
			$home->db->beginTransaction();
			/*array (size=5)
  0 => string '2 phase to 3 phase converter Function EnabledDelay- ' (length=52)
  1 => string '5' (length=1)
  2 => string 'TO-' (length=3)
  3 => string '1504MS200000' (length=12)
  4 => string 'F774' (length=4)*/
  			$delay=$msgarray[1];
  			$dev_id=$msgarray[3];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set PhaseChange2to3=?,PhaseChange2to3Delay=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$delay,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
  		
  
  	
	}
	if($home->endsWith1($msg,'F9'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=3)
  0 => string 'Star Delta FunctionEnabled TO-' (length=30)
  1 => string '1504MS200000' (length=12)
  2 => string 'F977' (length=4)*/
  			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set StarDelta=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
  		
	}
	if($home->endsWith1($msg,'G1'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=3)
  0 => string 'ON RELAY PERMANENT ON MODE EnabledTO-' (length=37)
  1 => string '1504MS200000' (length=12)
  2 => string 'G179' (length=4)*/
  			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set EONRelay=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}	
	}
	if($home->endsWith1($msg,'G3'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=3)
  0 => string 'Power Back SMS sendingEnabled TO-' (length=33)
  1 => string '1504MS200000' (length=12)
  2 => string 'G304' (length=4)*/
  			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set PowerBackSMS=?,insert_datetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$insert_datetime,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}	
	}
	if($home->endsWith1($msg,'G5'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=3)
  0 => string 'LOG SMS sendingEnabled TO-' (length=26)
  1 => string '1504MS200000' (length=12)
  2 => string 'G502' (length=4)*/
  			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set LOGSMS=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}	
	}
	if($home->endsWith1($msg,'G7'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=3)
  0 => string 'LOG SMS sendingEnabled TO-' (length=26)
  1 => string '1504MS200000' (length=12)
  2 => string 'G502' (length=4)*/
  			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set SinglePhase=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
		
	}
	if($home->endsWith1($msg,'G9'))
	{
		
		
	}
	if(strpos($msgarray[0],'Tank Overflow') !== false)
	{
		try
		{$home->db->beginTransaction();
			/*array (size=3)
  0 => string 'Tank Overflow SensingEnabled TO-' (length=32)
  1 => string '1504MS200000' (length=12)
  2 => string '65' (length=2)*/
  			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'Enabled') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set TANKOVERFLOW=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
		
	}
	if(strpos($msgarray[0],'MISSED CALL POWERBACK ALERT') !== false)
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=3)
  0 => string 'ENABLED - MISSED CALL POWERBACK ALERT' (length=37)
  1 => string '1504MS200000' (length=12)
  2 => string '11' (length=2)*/
  			$dev_id=$msgarray[1];
			$enabled=0;
			if(strpos($msgarray[0],'ENABLED') !== false)
			{
				$enabled=1;
			}
			
			$query = "UPDATE DevData set MissedCallAlert=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($enabled,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
		
	}
	if($home->endsWith1($msg,'H2'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=3)
  0 => string 'Field Name - RaD MS2 TEST storedTO-' (length=35)
  1 => string '1504MS200000' (length=12)
  2 => string 'H215' (length=4)*/
  			$dev_id=$msgarray[1];
  			$fieldname1=explode('-',$msgarray[0]);
  			$fieldname=$fieldname1[0];
			
			$query = "UPDATE DevData set LocationName=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($fieldname,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'H3'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=2)
  0 => string 'LatLong: ' (length=9)
  1 => string 'H310' (length=4)*/
  			$dev_id=$msgarray[1];
  			$fieldname1=explode(':',$msgarray[0]);
  			$fieldname=$fieldname1[1];
			
			$query = "UPDATE DevData set LATLONG=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($fieldname,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'H7'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=3)
  0 => string 'A6 - NumberDeleted To - ' (length=24)
  1 => string '1504MS200000' (length=12)
  2 => string 'D607' (length=4)
*/			
			
				$str="A1NO='',A1Operator='',A2NO='',A2Operator='',A3NO='',A3Operator='',A4NO='',A4Operator='',A5NO='',A5Operator='',A6NO='',A6Operator='',A7NO='',A7Operator='',A8NO='',A8Operator='',A9NO='',A9Operator='',A0NO='',A0Operator='',MrNo='',MrOperator=''";
			$dev_id=$msgarray[1];
			$query = "UPDATE DevData set ".$str." where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'H8'))
	{
		
	}
	if($home->endsWith($msg,'H9'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=18)
  0 => string 'V' (length=1)
  1 => string '1505MS200000' (length=12)
  2 => string 'I' (length=1)
  3 => string '865904022538414' (length=15)
  4 => string 'C' (length=1)
  5 => string '404421823494541' (length=15)
  6 => string 'H' (length=1)
  7 => string 'WMCMS1V4' (length=8)
  8 => string 'S' (length=1)
  9 => string 'MS2V330VI' (length=9)
  10 => string '270515' (length=6)
  11 => string '' (length=0)
  12 => string 'AIRCEL  ' (length=8)
  13 => string 'RF' (length=2)
  14 => string '22,0' (length=4)
  15 => string '1' (length=1)
  16 => string '' (length=0)
  17 => string 'H9' (length=2)*/
  			$dev_id=$msgarray[1];
  			$Vi=$msgarray[3];
  			$Vc=$msgarray[5];
  			$Vh=$msgarray[7];
  			$Vs=$msgarray[9].$msgarray[10];
  			$rf=$msgarray[14];
  			
  			$notification="Version=".$msgarray[1]."; I=".$Vi."; H=".$Vc."; S=".$Vs."; RF=".$rf;
			$query = "UPDATE DevData set Version=?,VC=?,VS=?,VH=?,RF=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($Vi,$Vc,$Vs,$Vh,$rf,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
		
	}
	if($home->endsWith1($msg,'I0'))
	{
		
	}
	if($home->endsWith1($msg,'I1'))
	{
		
	}
	if($home->endsWith1($msg,'I2'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=8)
  0 => string 'POWER - OFFMOTOR - OFFON @ ' (length=27)
  1 => string '14:25-22/05/15' (length=14)
  2 => string 'OFF @ ' (length=6)
  3 => string '14:35-22/05/15' (length=14)
  4 => string 'Time-' (length=5)
  5 => string '15:34:07' (length=8)
  6 => string '1504MS200000' (length=12)
  7 => string 'I232' (length=4)*/
  			$dev_id=$msgarray[6];
  			$on=$home->format_time($msgarray[1],'H:i-d/m/y','Y-m-d H:i:s');
  			$off=$home->format_time($msgarray[3],'H:i-d/m/y','Y-m-d H:i:s');
  			$time=$msgarray[5];
  			$phase=0;
  			$motor=0;
  			$notification="Power Off Motor off @".$msgarray[1]."Off @".$msgarray[3];
			$query = "UPDATE DevData set MotorStatus=?,LastOn=?,LastOff=?,LastUpdateTime=?,PhaseAvailable=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$on,$off,$time,$phase,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'I3'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=5)
  0 => string 'POWER BACK.TO START MOTORMAKE A CALLTime-' (length=41)
  1 => string '15:37:11' (length=8)
  2 => string '' (length=0)
  3 => string '1504MS200000' (length=12)
  4 => string 'I333' (length=4)*/
  			$dev_id=$msgarray[3];
  			
  			$time=$msgarray[1];
  			$phase=3;
  			
  			$notification="Power Back. To start motor make a call";
			$query = "UPDATE DevData set LastUpdateTime=?,PhaseAvailable=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($time,$phase,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'I4'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=9)
  0 => string 'POWER Back.1-PHASE Fail' (length=23)
  1 => string 'Time-' (length=5)
  2 => string '15:47:31' (length=8)
  3 => string '' (length=0)
  4 => string '' (length=0)
  5 => string 'Err2' (length=4)
  6 => string '' (length=0)
  7 => string '1504MS200000' (length=12)
  8 => string 'I437' (length=4)*/
  			$dev_id=$msgarray[7];
  			$error=$msgarray[5];
  			$time=$msgarray[2];
  			$phase=2;
  			
  			$notification="Power Back 1 Phase Failure";
			$query = "UPDATE DevData set ErrorStatus=?,LastUpdateTime=?,PhaseAvailable=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($error,$time,$phase,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'I5'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=7)
  0 => string 'POWER BACK.1-PHASE FAILMAKE A CALL TO ON THE MOTOR IN 2PHASE' (length=60)
  1 => string 'Err2' (length=4)
  2 => string 'Time-' (length=5)
  3 => string '12:19:30' (length=8)
  4 => string '' (length=0)
  5 => string '1504MS200000' (length=12)
  6 => string 'I510' (length=4)*/
  			$dev_id=$msgarray[5];
  			$error=$msgarray[1];
  			$time=$msgarray[3];
  			$phase=2;
  			
  			$notification="Power Back 1 Phase Failure. Make a call to on the motor in 2phase";
			$query = "UPDATE DevData set ErrorStatus=?,LastUpdateTime=?,PhaseAvailable=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($error,$time,$phase,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'I6'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=6)
  0 => string 'POWER BACK.MOTOR ON IN AUTO-ON MODEON@ ' (length=39)
  1 => string '11:26-22/05/15' (length=14)
  2 => string 'Time-' (length=5)
  3 => string '11:26:50' (length=8)
  4 => string '1504MS200000' (length=12)
  5 => string 'I609' (length=4)*/
  			$dev_id=$msgarray[4];
  			$on=$home->format_time($msgarray[1],'H:i-d/m/y','Y-m-d H:i:s');
  			$time=$msgarray[3];
  			$phase=3;
  			$motor=1;
  			
  			$notification="Power back. Motor on in auto on mode; ON @".$msgarray[1];
			$query = "UPDATE DevData set MotorStatus=?,LastOn=?,LastUpdateTime=?,PhaseAvailable=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$on,$time,$phase,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'I7'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=8)
  0 => string 'POWER Back.MOTOR ON IN 2PHASE AUTO-ON MODEON@ ' (length=46)
  1 => string '12:54' (length=5)
  2 => string 'Time-' (length=5)
  3 => string '12:54:29' (length=8)
  4 => string '' (length=0)
  5 => string '' (length=0)
  6 => string '1504MS200000' (length=12)
  7 => string 'I728' (length=4)*/
  			$dev_id=$msgarray[6];
  			$on=$home->format_time($msgarray[1],'H:i','Y-m-d H:i:s');
  			$time=$msgarray[3];
  			$phase=2;
  			$motor=1;
  			
  			$notification="Power back. Motor on in 2 Phase auto on mode;Off @".$msgarray[1];
			$query = "UPDATE DevData set MotorStatus=?,LastOn=?,LastUpdateTime=?,PhaseAvailable=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$on,$time,$phase,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'I9'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=8)
  0 => string 'MOTOR OFF IN TIMER MODEOFF - ' (length=29)
  1 => string '15:04' (length=5)
  2 => string 'ON - ' (length=5)
  3 => string '14:59' (length=5)
  4 => string 'Time-' (length=5)
  5 => string '15:04:00' (length=8)
  6 => string '1504MS200000' (length=12)
  7 => string 'I911' (length=4)*/
  			$dev_id=$msgarray[6];
  			$on=$home->format_time($msgarray[1],'H:i','Y-m-d H:i:s');
  			$off=$home->format_time($msgarray[3],'H:i','Y-m-d H:i:s');
  			$time=$msgarray[5];
  			/*$phase=2;*/
  			$motor=0;
  			
  			$notification="Motor Off in  Timer Mode Off @".$msgarray[1];
			$query = "UPDATE DevData set MotorStatus=?,LastOff=?,LastOn=?,LastUpdateTime=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$on,$off,$time,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'J0'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=9)
  0 => string 'MOTOR OFFBy ONT TIMEROFF @' (length=26)
  1 => string '17:12-22/05/15' (length=14)
  2 => string 'ON @ ' (length=5)
  3 => string '17:01-22/05/15' (length=14)
  4 => string 'Time-' (length=5)
  5 => string '17:12:01' (length=8)
  6 => string '' (length=0)
  7 => string '1504MS200000' (length=12)
  8 => string 'J019' (length=4)*/
  			$dev_id=$msgarray[6];
  			$on=$home->format_time($msgarray[1],'H:i-d/m/y','Y-m-d H:i:s');
  			$off=$home->format_time($msgarray[3],'H:i-d/m/y','Y-m-d H:i:s');
  			$time=$msgarray[5];
  			/*$phase=2;*/
  			$motor=0;
  			
  			$notification="Motor Off in  ONT Timer  Off @".$msgarray[1];
			$query = "UPDATE DevData set MotorStatus=?,LastOff=?,LastOn=?,LastUpdateTime=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$on,$off,$time,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'J3'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=5)
  0 => string 'ERROR-PHASE FAILUREMOTOR OFF' (length=28)
  1 => string 'Err2' (length=4)
  2 => string '' (length=0)
  3 => string '1504MS200000' (length=12)
  4 => string 'J333' (length=4)*/
  			$dev_id=$msgarray[3];
  			$error=$msgarray[1];
  			$phase=2;
  			$motor=0;
  			
  			
  			$notification="Error Phase Failure motor off";
			$query = "UPDATE DevData set PhaseAvailable=?,MotorStatus=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($phase,$motor,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'J4'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=4)
  0 => string 'LIGHT 'ON'Time-' (length=15)
  1 => string '15:18:01' (length=8)
  2 => string '1504MS200000' (length=12)
  3 => string 'J428' (length=4)*/
  			$dev_id=$msgarray[2];
  			$lighton=1;
  			$time=$msgarray[1];
  			
  			
  			//$notification="Error Phase Failure motor off";
			$query = "UPDATE DevData set LightON=?,LightEnable=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($time,$lighton,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'J5'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=4)
  0 => string 'LIGHT 'OFF'Time-' (length=16)
  1 => string '15:22:00' (length=8)
  2 => string '1504MS200000' (length=12)
  3 => string 'J529' (length=4)*/
  			$dev_id=$msgarray[2];
  			$lighton=0;
  			$time=$msgarray[1];
  			
  			
  			//$notification="Error Phase Failure motor off";
			$query = "UPDATE DevData set LightOFF=?,LightEnable=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($time,$lighton,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'J6'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=11)
  0 => string 'TANK FULLMOTOR - OFFOFF @ ' (length=26)
  1 => string '17:24-26/05/15' (length=14)
  2 => string 'ON @ ' (length=5)
  3 => string '17:23-26/05/15' (length=14)
  4 => string 'Time-' (length=5)
  5 => string '17:24:04' (length=8)
  6 => string '' (length=0)
  7 => string '1504MS200000' (length=12)
  8 => string '' (length=0)
  9 => string 'Err6' (length=4)
  10 => string 'J666' (length=4)*/
  			$dev_id=$msgarray[7];
  			$off=$home->format_time($msgarray[1],'H:i-d/m/y','Y-m-d H:i:s');
  			$on=$home->format_time($msgarray[3],'H:i-d/m/y','Y-m-d H:i:s');
  			$time=$msgarray[5];
  			$error=$msgarray[6];
  			/*$phase=2;*/
  			$motor=0;
  			
  			$notification="Tank Full Motor Off; Off @".$msgarray[1];
			$query = "UPDATE DevData set MotorStatus=?,LastOn=?,LastOff=?,ErrorStatus=?,LastUpdateTime=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$on,$off,$error,$time,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'J7'))
	{
		
	}
	if($home->endsWith1($msg,'J9'))
	{
		
	}
	if($home->endsWith1($msg,'K4'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=5)
  0 => string '*MWS-MS2*MOTOR NOT- ONCHECK THE CONNECTION' (length=42)
  1 => string '1505MS200000' (length=12)
  2 => string '' (length=0)
  3 => string 'Err4' (length=4)
  4 => string 'K407' (length=4)*/
  			$dev_id=$msgarray[1];
  			$error=$msgarray[3];
  			$motor=0;
  			
  			$notification="MOtor Is no ON Check the connection ";
			$query = "UPDATE DevData set MotorStatus=?,ErrorStatus=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$error,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'K5'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=5)
  0 => string '*MWS-MS2*MOTOR NOT- OFFCHECK THE CONNECTION' (length=43)
  1 => string '1505MS200000' (length=12)
  2 => string '' (length=0)
  3 => string 'Err5' (length=4)
  4 => string 'K504' (length=4)*/
  			$dev_id=$msgarray[1];
  			$error=$msgarray[3];
  			$motor=1;
  			
  			$notification="MOtor Is not OFF Check the connection ";
			$query = "UPDATE DevData set MotorStatus=?,ErrorStatus=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$error,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'J8'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=4)
  0 => string '*MWS-MS2*V=231-228-234/231A-0.0-0.0-0.0/0.0A1504MS200000' (length=56)
  1 => string 'Time-' (length=5)
  2 => string '15:03:00' (length=8)
  3 => string 'J810' (length=4)*/
  			$dev_id=$msgarray[1];
  			$error=$msgarray[3];
  			$motor=1;
  			
  			$notification="MOtor Is not OFF Check the connection ";
			$query = "UPDATE DevData set MotorStatus=?,ErrorStatus=?,notification=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$error,$notification,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'J9'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=10)
  0 => string 'RandD MS2 TESTOVER LOAD (3.2 A)MOTOR - OFFOFF @ ' (length=48)
  1 => string '17:19-26/05/15' (length=14)
  2 => string 'ON @ ' (length=5)
  3 => string '17:18-26/05/15Time-' (length=19)
  4 => string '17:19:34' (length=8)
  5 => string '' (length=0)
  6 => string '1504MS200000' (length=12)
  7 => string '' (length=0)
  8 => string 'Err3' (length=4)
  9 => string 'J963' (length=4)*/
  			$dev_id=$msgarray[6];
  			$off=$home->format_time($msgarray[1],'H:i-d/m/y','Y-m-d H:i:s');
  			$on=$home->format_time(substr($msgarray[3],0,14),'H:i-d/m/y','Y-m-d H:i:s');
  			$time=$msgarray[4];
  			$error=$msgarray[8];
  			$motor=0;
  			
  			$notification="andD MS2 TESTOVER LOAD (3.2 A)MOTOR - OFF ";
			$query = "UPDATE DevData set MotorStatus=?,ErrorStatus=?,notification=?,LastOn=?,LastOff=?,Lastupdatetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$error,$notification,$on,$off,$time,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($home->endsWith1($msg,'K0'))
	{
		try
		{
			$home->db->beginTransaction();
			/*array (size=10)
  0 => string 'DRY RUN (3.1 A)MOTOR - OFFOFF @ ' (length=32)
  1 => string '17:14-26/05/15' (length=14)
  2 => string 'ON @ ' (length=5)
  3 => string '17:13-26/05/15Time-' (length=19)
  4 => string '17:14:33' (length=8)
  5 => string '' (length=0)
  6 => string '1504MS200000' (length=12)
  7 => string '' (length=0)
  8 => string 'Err1' (length=4)
  9 => string 'K059' (length=4)*/
  			$dev_id=$msgarray[6];
  			$off=$home->format_time($msgarray[1],'H:i-d/m/y','Y-m-d H:i:s');
  			$on=$home->format_time(substr($msgarray[3],0,14),'H:i-d/m/y','Y-m-d H:i:s');
  			$time=$msgarray[4];
  			$error=$msgarray[8];
  			$motor=0;
  			
  			$notification="DRY Run Motor Off ";
			$query = "UPDATE DevData set MotorStatus=?,ErrorStatus=?,notification=?,LastOn=?,LastOff=?,Lastupdatetime=? where Dev_ID=?";
			$stmt  = $home->db->prepare($query);
	        $array = array($motor,$error,$notification,$on,$off,$time,$dev_id);
	        $stmt->execute($array);
	       /*  echo $stmt->rowCount(); */
	        /* $home->insertmsg($msg);  */
	        $home->db->commit();
	       $completed=1;
	        
		}
		catch(Exception $e)
		{
			echo "Error";
			$home->db->rollBack();
			
		}
	}
	if($completed==1)
	{
		echo "Success";
	}
	else
	{
		echo "Failed";
	}
	
}
else
{
	
	echo "Failed no message received";
}

?>