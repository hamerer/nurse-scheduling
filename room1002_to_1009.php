<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5" >
<title>當天病房護理師排班紀錄</title>
</head>
<body>

<?php
session_start();
$station=$_SESSION[account];
?>

<?php

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
// mysql_query("SET NAMES 'BIG5' ");
mysql_select_db($dbName,$link) or die( "Unable to select database");

$page_count=30;

$result = mysql_query("SELECT day_nurse,night_nurse,mid_nurse FROM bed WHERE bed='12'") ;
$result_switch = mysql_query("SELECT day_nurse,night_nurse,mid_nurse FROM bed WHERE bed='0B'") ;

$row = mysql_fetch_array($result);

$switch = mysql_query("UPDATE bed SET day_nurse='$row[0]',night_nurse='$row[1]',mid_nurse='$row[2]' WHERE bed='0B'");

$row = mysql_fetch_array($result_switch);
$switch = mysql_query("UPDATE bed SET day_nurse='$row[0]',night_nurse='$row[1]',mid_nurse='$row[2]' WHERE bed='12'");
header("Location: ./today_nurse_schedule1002to1009.php"); 
$link->close();
?>


</script>
</html>

