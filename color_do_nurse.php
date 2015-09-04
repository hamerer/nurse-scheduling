<?php
session_start();
include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/color_do_nurse.log';

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

$nurse_no = $_SESSION['nurse_no'];
if($parm_debug_on) {
	fputs($stdlog, "Number :  $nurse_no \n");
}

for ($i=1;$i<=$nurse_no;$i++) {
$nurse="nurse" .$i;
	fputs($stdlog, "Nurse :  $nurse \n");
$nurse=$_POST['$nurse'];
	fputs($stdlog, "nurse :  $nurse \n");
if(($nurse != NULL) or ($nurse !='') or ($nurse !="")) {
//        $sql="UPDATE nurse set color=$i where nurse=$nurse";
        $sql="UPDATE nurse set color=$i where num=$nurse";
	if($parm_debug_on) {
		fputs($stdlog, "SQL :  $sql \n");
	}
        $result= mysql_query($sql);
}
}

mysql_close($link);
header("Location: ./assign_bed.php");
exit;

?>
