<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=big5">
<title></title>
</head>

<body>

<?
session_start();
setlocale(LC_ALL, "zh_TW");
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
if ($link) {
        mysql_select_db($dbName,$link) or die( "Unable to select database");
}else{
        echo "connect error";
}

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/nurse_do_file.log';

// Set to 1 to turn on the log file
$parm_debug_on = 0;

//GLOBAL $stdin, $stdout, $stdlog, $result, $parm_debug_on, $parm_test_mode;

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

if($parm_debug_on) {

if ($_FILES["file"]["error"] > 0){
fputs($stdlog,  "Error: " . $_FILES["file"]["error"] . "\n");
}else{
fputs($stdlog,  "檔案名稱: " . $_FILES["file"]["name"] ."\n");
fputs($stdlog,  "檔案類型: " . $_FILES["file"]["type"] . "\n");
fputs($stdlog,  "檔案大小: " . ($_FILES["file"]["size"] / 1024) ."\n");
fputs($stdlog,  "暫存名稱: " . $_FILES["file"]["tmp_name"] . "\n");

move_uploaded_file($_FILES["file"]["tmp_name"],"./uploads/".$_FILES["file"]["name"]);
}
} 
$file = "./uploads/" . $_FILES["file"]["name"];

        if($parm_debug_on) {
                fputs($stdlog, "csv file :  $file \n");
        } 
$fp = fopen($file, "r");
while ( $ROW = fgetcsv($fp, $file_size) ) {
  if ( strlen($ROW[0]) ) {
        $station = $ROW[0];
        $name = $ROW[1] ;
        $nurse = $ROW[2] ;
        $schedule = $ROW[3] ;
        $date = $ROW[4] ;

        if($parm_debug_on) {
        	fputs($stdlog, "Station :  $station \n");
        	fputs($stdlog, "Name :  $name \n");
        	fputs($stdlog, "Nurse :  $nurse \n");
        	fputs($stdlog, "Schedule :  $schedule \n");
        	fputs($stdlog, "Date :  $date \n");
        }
if (($schedule != NULL) or ($schedule != "")) {
//$sql = "INSERT INTO schedule  (station,name,nurse,schedule,date) VALUES('$station','$name','$nurse','$schedule','$date') ";
$sql = "INSERT INTO schedule  (name,nurse,schedule,date) VALUES('$name','$nurse','$schedule','$date') ";

        if($parm_debug_on) {
                fputs($stdlog, "insert  sql :  $sql \n");
        } 
        $result=mysql_query($sql);
 
 }
}
}

fclose($fp);

mysql_close($link);
header("Location: ./nurse.php");

?>
</body>
</html>
