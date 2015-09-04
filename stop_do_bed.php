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
$parm_error_log = '/tmp/stop_do_bed.log';

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

$bed1=$_POST[bed1];
$bed2=$_POST[bed2];

$sql="SELECT id FROM bed WHERE name='$bed1' ";
fputs($stdlog, "Select start SQL :  $sql \n");	
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$start=$row['id'];
$sql="SELECT id FROM bed WHERE name='$bed2' ";
fputs($stdlog, "Select end SQL :  $sql \n");	
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$end=$row['id'];

if ($start > $end){
	$temp=$start;
	$start=$end;
	$end=$temp;
}

fputs($stdlog, "Select start :  $start \n");	
fputs($stdlog, "Select end :  $end \n");	
        
$sql="SELECT name,phone FROM bed WHERE id>='$start' AND id <= '$end' ";
$result=mysql_query($sql);

while ($rows=mysql_fetch_array($result)) {
	fputs($stdlog, "Select bed :  $rows[0] , $rows[1] \n");	
	$update_sql = "UPDATE bed set device='0',enable='0'  WHERE   name='$rows[0]' AND phone='$rows[1]' "; 
	$update_result=mysql_query($update_sql);
	if($parm_debug_on) {
     		fputs($stdlog, "update  sql :  $update_sql \n");
	} 
	$device_sql = "SELECT  car  FROM device ";
	$device_result= mysql_query($device_sql);
	while ($drows=mysql_fetch_array($device_result)){
		$bed_sql="SELECT device from bed where device=$drows[0]";
		$bed_result= mysql_query($bed_sql);
		$num = mysql_num_rows($bed_result);
		if ($num == 0) {
			$sql_device="UPDATE device SET enable='0' WHERE car=$drows[0]";
			$result_device=mysql_query($sql_device);

		}
	}
}

if(isset($_POST[device])){
 	if (is_array($_POST[device])) {
    		foreach($_POST[device] as $value) {
			if (($value != NULL) or ($value != "")) {
				fputs($stdlog, "device :  $value \n");
				$sql_device="UPDATE device SET enable='0' WHERE car='$value' ";
				$result_device=mysql_query($sql_device);

				fputs($stdlog, "Select start SQL :  $sql_device \n");	
				$update_sql = "UPDATE bed SET device='0' ,enable='0'  WHERE   device='$value' "; 
				$update_result=mysql_query($update_sql);
				if($parm_debug_on) {
     					fputs($stdlog, "update sql :  $update_sql \n");
				}
			}
		} //for each			
  	} else {
    		$values= $_POST[ints];
    		echo $values;
  	}
        
} //isset
header("Location: ./stop_bed.php"); 
?>
