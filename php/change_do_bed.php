<?php

session_start(); 

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
if ($link) { 
	mysql_select_db($dbName,$link) or die( "Unable to select database");
}else{
	echo "connect error";
}

//date_default_timezone_set('Asia/Taipei');

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/change_do_bed.log';

// Set to 1 to turn on the log file
$parm_debug_on = 1;

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
$j=0;
if(isset($_POST[device])){
 	if (is_array($_POST[device])) {
    		foreach($_POST[device] as $value) {
			if (($value != NULL) or ($value != "")) {
				fputs($stdlog, "device :  $value \n");
				$second=$first;
				$first=$value;
			if ((($first != NULL) or ($first != "")) and (($second != NULL) or ($second != "")))  {
				$temp1=101;
				$temp2=102;
				$sql_device="UPDATE bed SET device='$temp1' WHERE device='$first' ";
				$result_device=mysql_query($sql_device);
				$sql_device="UPDATE bed SET device='$temp2' WHERE device='$second' ";
				$result_device=mysql_query($sql_device);
				$sql_device="UPDATE bed SET device='$second' WHERE device='$temp1' ";
				$result_device=mysql_query($sql_device);
				$sql_device="UPDATE bed SET device='$first' WHERE device='$temp2' ";
				$result_device=mysql_query($sql_device);
				}
			}
		} //for each			
  	} else {
    		$values= $_POST[ints];
    		echo $values;
  	}
        
} //isset
header("Location: ./change_bed.php"); 
?>
