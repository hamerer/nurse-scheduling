<?php

session_start(); 
// $today = date("Y-m-d H:i:s");
date_default_timezone_set('Asia/Taipei');
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
if ($link) { 
	mysql_select_db($dbName,$link) or die( "Unable to select database");
}else{
	echo "connect error";
}

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/nurse_do_manual.log';

// Set to 1 to turn on the log file
$parm_debug_on = 0;

$stdin = fopen('php://stdin', 'r');
$stdout = fopen('php://stdout', 'w');

if ($parm_debug_on) {
        $stdlog = fopen($parm_error_log, 'w');
        fputs($stdlog, "---Start---\n");
}

while(!feof($stdin)) {
        $temp = fgets($stdin);
        if ($parm_debug_on)
                fputs($stdlog, $temp);

        $temp = str_replace("\n", "", $temp);

        $s = explode(":", $temp);
        $agivar[$s[0]] = trim($s[1]);
        if (($temp == "") || ($temp == "\n")) {
                break;
       }
}

if(($_POST[ptime] != "1") and ($_POST[ptime] != "2") and ($_POST[ptime] != "3")){
    echo   "<script>alert('請使用點選方選取一種班別！');</script>";   
    echo   "<script>history.back();</script>";  
    exit;
    //header("Location: ./manual.php"); 
}            

if ($_POST[nurse1]=="-" ){
    echo   "<script>alert('請使用下拉點選方選取開始床位！');</script>";   
    echo   "<script>history.back();</script>";  
}            

if ($_POST[nurse2]=="-" ){
    echo   "<script>alert('請使用下拉點選方選取結束床位！');</script>";   
    echo   "<script>history.back();</script>";  
}            

$date=$_SESSION[date];
$date_like = $date . "%";
$nurse1=$_POST[nurse1];
$nurse2=$_POST[nurse2];
$schedule=$_POST[ptime];

/*
$sql="SELECT name FROM schedule WHERE date LIKE '$date_like' ";
$result=mysql_query($sql);
$num = mysql_num_rows($result);
if ($num) {
}
else {
	$sql="UPDATE nurse SET enable='0' ";
	$result=mysql_query($sql);
}
*/

if ($schedule=="1") {
	$schedule="day";
}
elseif ($schedule=="2") {
	$schedule="night";
}
elseif ($schedule=="3") {
	$schedule="mid_night";
}
// $ints=$_POST[ints];
if($parm_debug_on) {
 	fputs($stdlog, "Schedule :  $schedule \n");	
 	fputs($stdlog, "Nurse1 :  $nurse1 \n");	
 	fputs($stdlog, "Nurse2 :  $nurse2 \n");	
 	fputs($stdlog, "Date :  $date \n");	

}

$sql="SELECT num FROM nurse WHERE nurse='$nurse1' ";
fputs($stdlog, "Select start SQL :  $sql \n");	
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$start=$row['num'];

$sql="SELECT num FROM nurse WHERE nurse='$nurse2' ";
fputs($stdlog, "Select start SQL :  $sql \n");	
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$end=$row['num'];
if ($start > $end){
	$temp=$start;
	$start=$end;
	$end=$temp;
}
fputs($stdlog, "Select start :  $start \n");	
fputs($stdlog, "Select end :  $end \n");	
$sql="SELECT name,nurse,enable FROM nurse WHERE num>='$start' AND num <= '$end' ";
$result=mysql_query($sql);
while ($rows=mysql_fetch_array($result)) {
	fputs($stdlog, "Select bed :  $rows[0] , $rows[1] \n");
	if (!$rows[2]) {	
	$insert_sql = "INSERT INTO schedule (name,nurse,schedule,date) VALUES('$rows[0]','$rows[1]','$schedule','$date') "; 
	$insert_result=mysql_query($insert_sql);
	if($parm_debug_on) {
     		fputs($stdlog, "Insert sql :  $insert_sql \n");
	} 

	$update_sql = "UPDATE nurse SET  enable ='1'  WHERE name='$rows[0]' "; 
	$update_result=mysql_query($update_sql);
	if($parm_debug_on) {
     		fputs($stdlog, "update sql :  $update_sql \n");
	} 
/*	
	} else {
		echo "這個護理師 ： "；
		echo $rows[1];
		echo " 已經排班了";
		echo "<cr>";
		echo   "<script>history.back();</script>";  
	}
*/
	}
}

if(isset($_POST[ints])){
 	if (is_array($_POST[ints])) {
    		foreach($_POST[ints] as $value) {
			fputs($stdlog, "nurse :  $value \n");
			$select_sql="SELECT name,enable FROM nurse WHERE nurse='$value' ";
			fputs($stdlog, "Select start SQL :  $select_sql \n");	
			$select_result=mysql_query($select_sql);
			$srow=mysql_fetch_array($select_result);
	if ((!$srow[1]) and ($value != NULL)) {
	$insert_sql = "INSERT INTO schedule (name,nurse,schedule,date) VALUES('$srow[0]','$value','$schedule','$date_like') "; 
	$insert_result=mysql_query($insert_sql);
	$update_sql="Update nurse SET enable='1' WHERE nurse='$value' ";
	$update_result=mysql_query($update_sql);
			if($parm_debug_on) {
     				fputs($stdlog, "check  sql :  $update_sql \n");
			} 
	}
	}
	} else {
    		$value = $_POST[ints];
    		echo $value;
  	}
}

mysql_close($link);
	
 //exec("/usr/bin/sudo asterisk -rx 'extension reload' ");
header("Location: ./manual.php"); 

?>
