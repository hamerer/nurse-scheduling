<?

function __fgetcsv(&$handle, $length = null, $d = ",", $e = '"') {
	$d = preg_quote($d);
	$e = preg_quote($e);
	$_line = "";
	$eof=false;
	while ($eof != true) {
		$_line .= (empty ($length) ? fgets($handle) : fgets($handle, $length));
		$itemcnt = preg_match_all('/' . $e . '/', $_line, $dummy);
		if ($itemcnt % 2 == 0){
			$eof = true;
		}
	}
 
	$_csv_line = preg_replace('/(?: |[ ])?$/', $d, trim($_line));
 
	$_csv_pattern = '/(' . $e . '[^' . $e . ']*(?:' . $e . $e . '[^' . $e . ']*)*' . $e . '|[^' . $d . ']*)' . $d . '/';
	preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
	$_csv_data = $_csv_matches[1];
 
	for ($_csv_i = 0; $_csv_i < count($_csv_data); $_csv_i++) {
		$_csv_data[$_csv_i] = preg_replace("/^" . $e . "(.*)" . $e . "$/s", "$1", $_csv_data[$_csv_i]);
		$_csv_data[$_csv_i] = str_replace($e . $e, $e, $_csv_data[$_csv_i]);
	}
 
	return empty ($_line) ? false : $_csv_data;
}

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
$parm_error_log = '/tmp/batch_do_color.log';

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

//$line = count(file('$CSVfile'));  
//$CSVfile = "number.csv";
$file = "color.csv";

        if($parm_debug_on) {
                fputs($stdlog, "csv file :  $file \n");
        } 
$fp = fopen($file, "r");
while ( $ROW = __fgetcsv($fp, $file_size) ) {
  if ( strlen($ROW[0]) ) {
    	$color = $ROW[0];
        	$type = $ROW[1] ;
        	$name = $ROW[2] ;

        if($parm_debug_on) {
        	fputs($stdlog, "Color :  $color \n");
        	fputs($stdlog, "type :  $type \n");
        	fputs($stdlog, "name :  $name \n");
       }

$sql = "INSERT INTO color (color,type,name) VALUES('$color','$type','$name') ";
        if($parm_debug_on) {
                fputs($stdlog, "insert  sql :  $sql \n");
        }
        $result=mysql_query($sql);
  }
}

fclose($fp);

mysql_close($link);
header("Location: ./device_color.php");
exit;

?>
