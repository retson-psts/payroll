<?php try
{
$db['default']['username'] = 'ps';
$db['default']['password'] = 'csi@12345';
$db['default']['database'] = 'fees_management1';
$serverName="115.42.175.118,1433";//
$conn = new PDO( "sqlsrv:server=$serverName ; Database=QR_TEST", "qrcodetest", "abqRc0de");
$name = 'NAMESER_'.time();
$time = date('d-m-Y h:i A');
$testquery = "INSERT INTO TEST_TABLE (NAME,TIME) VALUES (:NAME,:TIME);";
$result = $conn->prepare($testquery);
$result->bindvalue(':NAME',$name,PDO::PARAM_STR);
$result->bindvalue(':TIME',$time,PDO::PARAM_STR);
$result->execute();
$id = $conn->lastInsertId();
echo $id;
}

catch(Exception $e)
{
echo $e."Error in connect with mssql";
}
?>