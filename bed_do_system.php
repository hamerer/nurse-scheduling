<?php

session_start(); 

include('../root.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
if ($link) { 
	mysql_select_db($dbName,$link) or die( "Unable to select database");
}else{
	echo "connect error";
}

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/bed_do_system.log';

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

if(($_POST[name] == "") or ($_POST[name] == NULL)){
    echo   "<script>alert('請輸入主機的IP！');</script>";   
    echo   "<script>history.back();</script>";  
}            

$ip=$_POST[name];
$info = explode(".", $ip);
$ip1=$info[0];
$ip2=$info[1];
$ip3=$info[2];
$ip4=$info[3];

if(($ip1 == "") or ($ip1 > 255) or ($ip1 < 0)){
    echo   "<script>alert('IP格式錯誤，請重新輸入！');</script>";   
    echo   "<script>history.back();</script>";  
}            

if(($ip2 == "") or ($ip2 > 255) or ($ip2 < 0)){
    echo   "<script>alert('IP格式錯誤，請重新輸入！');</script>";   
    echo   "<script>history.back();</script>";  
}            

if(($ip3 == "") or ($ip3 > 255) or ($ip3 < 0)){
    echo   "<script>alert('IP格式錯誤，請重新輸入！');</script>";   
    echo   "<script>history.back();</script>";  
}            

if(($ip4 == "") or ($ip4 > 255) or ($ip4 < 0)){
    echo   "<script>alert('IP格式錯誤，請重新輸入！');</script>";   
    echo   "<script>history.back();</script>";  
}            

if($parm_debug_on) {
 	fputs($stdlog, "IP :  $ip \n");	
}

$sql="GRANT SELECT,INSERT on asterisk.assign to root@'$ip' identified by 'comproadmin' ";
fputs($stdlog, "Select start SQL :  $sql \n");	
$result=mysql_query($sql);

$sql="flush privileges ";
fputs($stdlog, "Select start SQL :  $sql \n");	
$result=mysql_query($sql);

header("Location: ./bed_system.php"); 

?>
