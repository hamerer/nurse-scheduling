<?php

session_start(); 
declare(ticks=1);

include('../db.inc');
include('day.php');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
if ($link) { 
	mysql_select_db($dbName,$link) or die( "Unable to select database");
}else{
	echo "connect error";
}

for ($i=1; $i<=8; $i++) {
	$param1="name" . $i;
	$param2="mobile" . $i;

//	if($parm_debug_on) {
//     		fputs($stdlog, "name :  $param1 \n");
//     		fputs($stdlog, "mobile :  $param2 \n");
//	}
	$name = $_POST[$param1] ;
	$mobile = $_POST[$param2] ;
	
//	if($parm_debug_on) {
//     		fputs($stdlog, "name :  $name \n");
//     		fputs($stdlog, "mobile :  $mobile \n");
//	} 

 if ($name != ""){
	$select_sql = "SELECT name,mobile FROM device WHERE car=$i"; 
	$select_result=mysql_query($select_sql);
	$rows=mysql_fetch_array($select_result);
	$sql = "UPDATE sipfriens set name='$name',username='$name' WHERE name=$rows[0]"; 
	$result=mysql_query($sql);
	$sql = "UPDATE device set name='$name',mobile='$mobile' WHERE car=$i"; 
	$result=mysql_query($sql);
//	if($parm_debug_on) {
//     		fputs($stdlog, "check  sql :  $sql \n");
//	} 
	
}  else  if ($mobile != ""){
	$sql = "UPDATE device set mobile='$mobile' WHERE car=$i"; 
	$result=mysql_query($sql);
//	if($parm_debug_on) {
//     		fputs($stdlog, "check  sql :  $sql \n");
//	} 

} //if
}  //for

//exec("/usr/bin/sudo asterisk -rx 'extension reload' ");
header("Location: ./device.php"); 

?>
