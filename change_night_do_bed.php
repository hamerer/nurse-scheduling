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
$parm_error_log = '/tmp/change_day_night_bed.log';

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
$j=0;
if(isset($_POST[nurse])){
 	if (is_array($_POST[nurse])) {
    		foreach($_POST[nurse] as $value) {
			if (($value != NULL) or ($value != "")) {
				fputs($stdlog, "nurse :  $value \n");
				$second=$first;
				$first=$value;
			if ((($first != NULL) or ($first != "")) and (($second != NULL) or ($second != "")))  {
				$temp1=101;
				$temp2=102;
				$sql_nurse="UPDATE bed SET night_nurse='$temp1' WHERE night_nurse='$first' ";
				$result_nurse=mysql_query($sql_nurse);
				$sql_nurse="UPDATE bed SET night_nurse='$temp2' WHERE night_nurse='$second' ";
				$result_nurse=mysql_query($sql_nurse);
				$sql_nurse="UPDATE bed SET night_nurse='$second' WHERE night_nurse='$temp1' ";
				$result_nurse=mysql_query($sql_nurse);
				$sql_nurse="UPDATE bed SET night_nurse='$first' WHERE night_nurse='$temp2' ";
				$result_nurse=mysql_query($sql_nurse);
				}
			}
		} //for each			
  	} else {
    		$values= $_POST[nurse];
    		echo $values;
  	}
        
} //isset
header("Location: ./change_night_bed.php"); 
?>
