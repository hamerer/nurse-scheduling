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
$parm_error_log = '/tmp/stop_day_do_bed.log';

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

/*
if(($_POST[nurse] == "") or ($_POST[nurse] == NULL)){
    echo   "<script>alert('請使用點選方選取一種通訊裝置！');</script>";   
    echo   "<script>history.back();</script>";  
}            

if ($_POST[bed1]=="-" ){
    echo   "<script>alert('請使用下拉點選方選取開始床位！');</script>";   
    echo   "<script>history.back();</script>";  
}            

if ($_POST[bed2]=="-" ){
    echo   "<script>alert('請使用下拉點選方選取結束床位！');</script>";   
    echo   "<script>history.back();</script>";  
}            
*/

$bed1=$_POST[bed1];
$bed2=$_POST[bed2];
$nurse=$_POST[nurse];
$schedule=$_POST[schedule];
$ints=$_POST[ints];
if($parm_debug_on) {
 	fputs($stdlog, "Nurse :  $nurse \n");	
 	fputs($stdlog, "Schedule :  $schedule \n");	
 	fputs($stdlog, "bed1 :  $bed1 \n");	
 	fputs($stdlog, "bed2 :  $bed2 \n");	

}

if ($bed1!="--") {
$sql="SELECT id FROM bed WHERE bed='$bed1' ";
fputs($stdlog, "Select start SQL :  $sql \n");	
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$start=$row['id'];
}
if ($bed2!="--")  {
$sql="SELECT id FROM bed WHERE bed='$bed2' ";
fputs($stdlog, "Select start SQL :  $sql \n");	
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
$sql="SELECT name,bed,day FROM bed WHERE id>='$start' AND id <= '$end' ";
$result=mysql_query($sql);
while ($rows=mysql_fetch_array($result)) {
	fputs($stdlog, "Select bed :  $rows[0] , $rows[1] \n");
	if ($rows[2]) {	
	$update_sql = "UPDATE bed set day_nurse='',day='0'  WHERE   name='$rows[0]' AND bed='$rows[1]' "; 
	$update_result=mysql_query($update_sql);
	if($parm_debug_on) {
     		fputs($stdlog, "update  sql :  $update_sql \n");
	} 
	}
}
}
if ($nurse!="") {
	$update_sql = "UPDATE bed set day_nurse='',day='0'  WHERE  day_nurse='$nurse'  "; 
	$update_result=mysql_query($update_sql);
	if($parm_debug_on) {
     		fputs($stdlog, "update  sql :  $update_sql \n");
	} 
}
fputs($stdlog, "nurse :  $nurse \n");
if(isset($_POST[ints])){
 	if (is_array($_POST[ints])) {
    		foreach($_POST[ints] as $value) {
			fputs($stdlog, "bed :  $value \n");
			$select_sql="SELECT name,bed,day FROM bed WHERE bed='$value' ";
			fputs($stdlog, "Select start SQL :  $seletc_sql \n");	
			$select_result=mysql_query($select_sql);
			$srow=mysql_fetch_array($select_result);
		if ($srow[2]) {
			$update_sql = "UPDATE bed set day_nurse='' ,day='0'  WHERE   bed='$srow[1]'  "; 
			$update_result=mysql_query($update_sql);
			if($parm_debug_on) {
     				fputs($stdlog, "check  sql :  $update_sql \n");
			} 
		}
    	} //foreach
  	} else {
    			$value = $_POST[ints];
    			echo $value;
  	}
}
	


 //exec("/usr/bin/sudo asterisk -rx 'extension reload' ");
//header("Location: ./assign_day_bed.php"); 
header("Location: ./stop_day_bed.php"); 

?>
