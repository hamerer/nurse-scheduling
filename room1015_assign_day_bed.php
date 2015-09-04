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

<form name="form" method="post" action="assign_day_do_bed1015.php">
<input type=hidden name=schedule value="day">


<img src="images/room1015.jpg" WIDTH="1000"><br>
<?php
echo "<table border=1 >";

echo "<tr colspan=2>早班護理師指定</tr>";
echo "<tr>";

$sql = "SELECT  nurse  FROM schedule WHERE schedule = 'day' AND date LIKE '$now_like'  ";
if($parm_debug_on) {
	fputs($stdlog, "SELECT  SQL :  $sql \n");
} 
$result= mysql_query($sql);

//$num = mysql_num_rows($result);
while ($rows=mysql_fetch_array($result)){
	$color_sql = "SELECT  color  FROM nurse WHERE nurse = '$rows[0]' ";
	if($parm_debug_on) {
        	fputs($stdlog, "Color  SQL :  $color_sql \n");
	}
	$color_result= mysql_query($color_sql);
	$color=mysql_fetch_array($color_result);

if($parm_debug_on) {
	fputs($stdlog, "Nurse :  $rows[0] \n");
} 

	echo " <td   align='center' >";
	$id="press-button" . $color[0];
	echo  "<div id='$id'><label><input type=radio  name=nurse  value=$rows[0]><span> $rows[0]</span></label></div>";
  	echo "</td>";
}
//}
echo "</tr>";
echo "</table>";

?>

<br>
<?php
echo "<table border=1 >";
echo "<tr colspan=2>夜班護理師指定</tr>";
echo "<tr>";


$sql = "SELECT  nurse  FROM schedule WHERE schedule = 'night' AND date LIKE '$now_like'  ";
if($parm_debug_on) {
	fputs($stdlog, "SELECT  SQL :  $sql \n");
} 
$result= mysql_query($sql);

//$num = mysql_num_rows($result);
while ($rows=mysql_fetch_array($result)){
	$color_sql = "SELECT  color  FROM nurse WHERE nurse = '$rows[0]' ";
	if($parm_debug_on) {
        	fputs($stdlog, "Color  SQL :  $color_sql \n");
	}
	$color_result= mysql_query($color_sql);
	$color=mysql_fetch_array($color_result);

if($parm_debug_on) {
	fputs($stdlog, "Nurse :  $rows[0] \n");
} 

	echo " <td   align='center' >";
	$id="press-button" . $color[0];
	echo  "<div id='$id'><label><input type=radio  name=nurse_night  value=$rows[0]><span> $rows[0]</span></label></div>";
  	echo "</td>";
}
//}
echo "</tr>";
echo "</table>";

?>

<br>
<?php
echo "<table border=1 >";
echo "<tr colspan=2>大夜班護理師指定</tr>";
echo "<tr>";


$sql = "SELECT  nurse  FROM schedule WHERE schedule = 'mid_night' AND date LIKE '$now_like'  ";
if($parm_debug_on) {
	fputs($stdlog, "SELECT  SQL :  $sql \n");
} 
$result= mysql_query($sql);

//$num = mysql_num_rows($result);
while ($rows=mysql_fetch_array($result)){
	$color_sql = "SELECT  color  FROM nurse WHERE nurse = '$rows[0]' ";
	if($parm_debug_on) {
        	fputs($stdlog, "Color  SQL :  $color_sql \n");
	}
	$color_result= mysql_query($color_sql);
	$color=mysql_fetch_array($color_result);

if($parm_debug_on) {
	fputs($stdlog, "Nurse :  $rows[0] \n");
} 

	echo " <td   align='center' >";
	$id="press-button" . $color[0];
	echo  "<div id='$id'><label><input type=radio  name=nurse_midnight  value=$rows[0]><span> $rows[0]</span></label></div>";
  	echo "</td>";
}
//}
echo "</tr>";
echo "</table>";

?>
<HR>

<input type="submit" name="Submit" value="派班"><input type=reset value="取消"></th>
</form>  
</body>
</html>
