<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>日班護理站派床系統</title>

<link rel=stylesheet href="button.css" type="text/css">
</head>

<body>

<HR>
<?php

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/assign_day_bed.log';

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

session_start();
date_default_timezone_set('Asia/Chongqing');
$now = date("Y-m-d");
$now_like = date("Y-m-d") . "%";
include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("資料庫開啟錯誤！");
mysql_select_db($dbName,$link) or die( "無法選取資料庫！");
?>

<form name="form" method="post" action="assign_day_do_bed.php">
<input type=hidden name=schedule value="day">
<table border=1 width="70%">
<tr>
		 
</tr></table>

<img src="images/10F_select.jpg" WIDTH="1000"><br>


<HR>
是否確認清除此病房派班?
<input type="submit" name="Submit" value="是"><input type=reset value="否"></th>
</form>  
</body>
</html>
