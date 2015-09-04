<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>日班護理站換班系統</title>

<link rel=stylesheet href="button.css" type="text/css">
</head>

<body>

<HR>
<?php

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/change_day_bed.log';

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

<form name="form" method="post" action="change_day_do_bed.php">
<input type=hidden name=schedule value="day">

<?php
echo "<table border=1 width=100%>";
echo "<tr>";

$sql = "SELECT  nurse  FROM schedule WHERE schedule = 'day' AND date LIKE '$now_like'  ";
if($parm_debug_on) {
	fputs($stdlog, "SELECT  SQL :  $sql \n");
} 
$result= mysql_query($sql);

while ($rows=mysql_fetch_array($result)){
echo "<td>";
	$color_sql = "SELECT  color  FROM nurse WHERE nurse = '$rows[0]' ";
	if($parm_debug_on) {
        	fputs($stdlog, "Color  SQL :  $color_sql \n");
	}
	$color_result= mysql_query($color_sql);
	$color=mysql_fetch_array($color_result);

if($parm_debug_on) {
	fputs($stdlog, "Nurse :  $rows[0] \n");
	fputs($stdlog, "Color :  $color[0] \n");
} 
	$id="press-button" . $color[0];
   	echo  "<div id='$id'><label><input type=checkbox  name=nurse[]  value=$rows[0]><span>$rows[0]</span></label></div>";
echo "</td>";

}
//}
echo "</tr>";
echo "</table>";

?>
<?php

echo "<table border=1 width=100% align='center'>";

$j=1;
$result = mysql_query("select id,bed,name,day,day_nurse from bed  ") ;
while ($row=mysql_fetch_array($result)){
	if (($j % 8) == 1){
		echo "<tr>";     
	}
	if($parm_debug_on) {
		fputs($stdlog, "Enable :  $row[3] \n");
		fputs($stdlog, "Bed :  $row[1] \n");
	} 
if ($row[3]) {
	$color_result = mysql_query("SELECT color FROM nurse WHERE nurse='$row[4]' ") ;
	$crow=mysql_fetch_array($color_result);
	if($parm_debug_on) {
		fputs($stdlog, "Enable :  $row[3] \n");
		fputs($stdlog, "Color :  $crow[0] \n");
	} 

	echo "<td width=10% align='center'>";
	$id="press-button" . $crow[0];
	echo  "<div id='$id'><label><input type=hidden  name=ints[]  value='' ><span>$row[1]</span></label></div>";
//	echo  "<div id='$id'><label><input type=checkbox name=ints[]  value=$row[1] ><span>$row[1]</span></label></div>";
	echo " </td>";
} else {
	echo "<td width=10% align='center'> "; 
	echo  "<div id='ck-button'><label><input type=hidden name=ints[] value=''><span>$row[1]</span></label></div>";
	echo "</td>";
}
	$j++;
}

echo "</tr>";
echo "</table>";
mysql_close($link);
?>
<input type="submit" name="Submit" value="換班"><input type=reset value="取消"></th>
</form>  
</body>
</html>
