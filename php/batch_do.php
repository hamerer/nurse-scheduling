<?
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
$parm_error_log = '/tmp/batch_do.log';

// Set to 1 to turn on the log file
$parm_debug_on = 1;

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

$sql= "TRUNCATE TABLE bed ";
$result= mysql_query($sql,$link) or die(mysql_error());
$sql= "ALTER TABLE bed AUTO_INCREMENT = 1  ";
$result= mysql_query($sql,$link) or die(mysql_error());
$sql= "select id,name,device from bed  ";
$result= mysql_query($sql,$link) or die(mysql_error());
$number = mysql_num_rows($result);
$row=mysql_fetch_array($result);
$name = $row[1];
$device = $row[2];

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
    	$name = $ROW[0];
        $phone = $ROW[1] ;
        $mobile = $ROW[2] ;
        $device = $ROW[3] ;

        if($parm_debug_on) {
        	fputs($stdlog, "Exist name :  $name \n");
        	fputs($stdlog, "phone :  $phone \n");
        	fputs($stdlog, "mobile :  $mobile \n");
        	fputs($stdlog, "device :  $device \n");
        }

$sql = "INSERT INTO bed (name,phone,mobile,device) VALUES('$name','$phone','$mobile','$device') ";
        if($parm_debug_on) {
                fputs($stdlog, "insert  sql :  $sql \n");
        } 
        $result=mysql_query($sql);
$secret =  "0000" . $phone;
$sql = "INSERT INTO sipfriends (name,secret,defaultuser) VALUES('$phone','$secret','$phone') ";
        if($parm_debug_on) {
                fputs($stdlog, "insert  sql :  $sql \n");
        } 
        $result=mysql_query($sql);
  }
}

fclose($fp);

mysql_close($link);
header("Location: ./bed.php");
exit;

?>
