<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title></title>
</head>
<body>

<?php
session_start();
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

$date=$_POST[date];
$_SESSION[date]=$date;
//$date=$_SESSION[date];
$date_like = $date . "%";

$sql="DELETE FROM schedule WHERE date LIKE '$date_like' ";
$result = mysql_query($sql) ;
//$sql="UPDATE nurse  set enable='0' ";
//$result = mysql_query($sql) ;

mysql_close($link);
header("Location: ./nurse_schedule.php");
?>
