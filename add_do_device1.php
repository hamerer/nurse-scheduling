<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=big5">
<title></title>
</head>

<body>

<?
session_start();
$station=$_SESSION[account];
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
if ($link) {
        mysql_select_db($dbName,$link) or die( "Unable to select database");
}else{
        echo "connect error";
}

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/add_do_nurse.log';

// Set to 1 to turn on the log file
$parm_debug_on = 0;

GLOBAL $stdin, $stdout, $stdlog, $result, $parm_debug_on, $parm_test_mode;

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

$name=$_POST['name'];
$car=$_POST['car'];
$mobile=$_POST['mobile'];

if($parm_debug_on) {
	fputs($stdlog, "Device account :  $name \n");
        fputs($stdlog, "Device Car :  $car \n");
        fputs($stdlog, "Device Mobile :  $mobile \n");
}

$sql = "INSERT INTO device (name,car,mobile) VALUES('$name','$car','$mobile') ";
if($parm_debug_on) {
	fputs($stdlog, "insert  sql :  $sql \n");
} 
$result=mysql_query($sql);

mysql_close($link);
header("Location: ./device.php");

?>

</body>
</html>
