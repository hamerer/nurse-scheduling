<?PHP
session_start();
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/del.log';

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


$sql="SELECT name FROM bed ";
if($parm_debug_on) {
        fputs($stdlog, "SQL :  $sql \n");
}
$result = mysql_query($sql) ;
while ($row=mysql_fetch_array($result)){
	$bed_sql = "DELETE FROM bed where name='$row[0]' ";
if($parm_debug_on) {
        fputs($stdlog, "SQL :  $bed_sql \n");
}
	$bed_result = mysql_query($bed_sql) ;

	$sip_sql="DELETE FROM sipfriends where name='$row[0]' ";
if($parm_debug_on) {
        fputs($stdlog, "SQL :  $sip_sql \n");
}
	$sip_result = mysql_query($sip_sql) ;
}
mysql_close($link);
header("Location: ./all_bed.php");

?>
