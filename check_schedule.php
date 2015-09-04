<?php

session_start(); 

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
if ($link) { 
	mysql_select_db($dbName,$link) or die( "Unable to select database");
}else{
	echo "connect error";
}

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/check_schedule.log';

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

if(($_POST[schedule] == "") or ($_POST[schedule] == NULL)){
    echo   "<script>alert('請使用點選方選取一種派床方式！');</script>";   
    echo   "<script>history.back();</script>";  
}            

date_default_timezone_set('Asia/Chongqing');
$now = date("Y-m-d");
$now_like = date("Y-m-d") . "%";

$schedule=$_POST[schedule];
if ($schedule=="reload") {
	$sql="update bed set day='0',night='0',mid_night='0'  WHERE date LIKE '$now_like' ";
	fputs($stdlog, "Select start SQL :  $sql \n");
	$result=mysql_query($sql);
	$sql="update bed set  date = '$now_like',day_nurse='',night_nurse='',mid_nurse=''  ";
	fputs($stdlog, "Select start SQL :  $sql \n");
	$result=mysql_query($sql);
}
header("Location: ./day.php"); 

?>
