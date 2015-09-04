<?php

session_start(); 
$station=$_SESSION[account];

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
if ($link) { 
	mysql_select_db($dbName,$link) or die( "Unable to select database");
}else{
	echo "connect error";
}

$name = $_SESSION['name'];
$mypass=$_POST[mypass];
$nurse=$_POST[nurse];

// $sql = "SELECT name FROM nurse WHERE station='$station' AND name='$name' ";
$sql = "SELECT name FROM nurse WHERE name='$name' ";
$result = mysql_query($sql);
$rows=mysql_fetch_array($result);
$row_no = mysql_num_rows($result);
if($row_no == 0) {
	echo   "<script>alert('您輸入的護理師帳號不存在，請重新輸入！');</script>";
	header("Location: ./modify_station.php"); 
}

// $check_sql="SELECT nurse ,password FROM nurse WHERE station='$station' AND  name='$name' ";
$check_sql="SELECT nurse ,password FROM nurse WHERE name='$name' ";
$check_result = mysql_query($check_sql);
$crows=mysql_fetch_array($check_result);

if (($nurse == NULL) or ($nurse == "")) {
	$nurse=$crows[0];
} 
if(($mypass==NULL) or ($mypass=="")) {
	$mypass=$crows[1];
}
/*
$home="/home/" . $telephone ;
exec("/usr/bin/sudo /bin/mkdir $home ");

$home_in=$home . "/in" ;
exec("/usr/bin/sudo /bin/mkdir $home_in ");

$home_out=$home . "/out" ;
exec("/usr/bin/sudo /bin/mkdir $home_out ");
*/

//$sql = "UPDATE nurse SET password='$mypass', nurse='$nurse'    WHERE  station='$station' AND  name='$name' ";
$sql = "UPDATE nurse SET password='$mypass', nurse='$nurse'  WHERE name='$name' ";
$result=mysql_query($sql);

mysql_close($link);
/*
$myFile = "/etc/asterisk/cloud.conf";
$fh = fopen($myFile, 'a') or die("can't open file");
$stringData = "[" . $telephone . "]" . "\n";
fwrite($fh, $stringData);
$stringData = "include => " . $context ."\n";
fwrite($fh, $stringData);
$stringData = "switch => Realtime/@extensions \n\n";
fwrite($fh, $stringData);
fclose($fh);

exec("/usr/bin/sudo asterisk -rx 'extension reload' ");
*/
header("Location: ./nurse.php"); 

?>
