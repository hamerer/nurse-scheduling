<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>護理站手動護士排班</title>

<link rel=stylesheet href="button.css" type="text/css">
</head>

<body>
<form name="form" method="post" action="nurse_tmp.php">
<Left><H2  align="middle"  class="style1">護理站手動護士排班</H2>
<HR>
<?php
setlocale(LC_ALL, 'zh_TW.Big5');
session_start();
// $today = date("Y-m-d H:i:s");
date_default_timezone_set('Asia/Taipei');

echo "<table border=1 width=50%>";
echo "<tr>";
echo "<td>";
echo "<select size=1 name=date>";
for ($k=7;$k>=0;$k--){
$now  = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+$k, date("Y")));

	echo "<option value=$now selected>$now</option>'";
}
echo "</td>";
echo "</tr>";
echo "</table>";

?>

<input type="submit" name="Submit" value="排班"><input type=reset value="取消"></th>
</form>
<form name="form" method="post" action="nurse_do_manual.php">

<HR>
<?php
session_start(); 
$date=$_SESSION[date];
$date_like = $date . "%";

include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("資料庫開啟錯誤！");
mysql_select_db($dbName,$link) or die( "無法選取資料庫！");

// If the application is having problems you can log to this file
$parm_error_log = '/tmp/manual.log';

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


echo "<table border=1 width=50%>";
echo "<tr>";

echo " <td  width=30% align='center' >";
$id="press-button" . 1;
echo  "<div id='$id'><label><input type=radio  name=ptime  value='1'><span>日班</span></label></div>";
echo "</td>";
echo " <td  width=30% align='center' >";
$id="press-button" . 2;
echo  "<div id='$id'><label><input type=radio  name=ptime  value='2'><span>夜班</span></label></div>";
echo "</td>";
echo " <td  width=30% align='center' >";
$id="press-button" . 4;
echo  "<div id='$id'><label><input type=radio  name=ptime  value='3'><span>大夜班</span></label></div>";
echo "</td>";

echo "</tr>";
echo "</table>";

?>

<table border=1 width="50%">

  <tr>
     <td  width="10%"><span class="style1">護理師選取</span></td>
     <td  width="20%">
<font face="標楷體" size="4">從：</font>

<?php


        $query_RsCourse = "SELECT nurse FROM nurse where enable='0' ";
        $RsCourse = mysql_query($query_RsCourse) or die(mysql_error());
        $totalRows_RsCourse = mysql_num_rows($RsCourse);
        if($totalRows_RsCourse) {
        echo '<select name=nurse1>';
   echo '<option value="-">'. '--' .'</option>';
      while ($row = mysql_fetch_array($RsCourse, MYSQL_ASSOC))
      {
            echo '<option value="'.$row['nurse'].'">'.$row['nurse'].'</option>';
       }
            echo '</select>';
        }
        else
        {
        echo '所有可用護理師分配完畢'; // no rows in tbl_course
        }
        echo '</td>';

?>
<td  width="20%">
<font face="標楷體" size="4">到：</font>
<?php

        $query_RsCourse = "SELECT nurse FROM nurse where enable='0' ";
        $RsCourse = mysql_query($query_RsCourse) or die(mysql_error());
        $totalRows_RsCourse = mysql_num_rows($RsCourse);
        if($totalRows_RsCourse) {
        echo '<select name=nurse2>';
   echo '<option value="-">'. '--' .'</option>';
            while ($row = mysql_fetch_array($RsCourse, MYSQL_ASSOC))
            {
            echo '<option value="'.$row['nurse'].'">'.$row['nurse'].'</option>';
            }
            echo '</select>';
        }
        else
        {
        echo '所有可用護理師分配完畢'; // no rows in tbl_course
        }
        echo '</td>';
?>

</tr>
</table>
<?php

echo "<table border=1 width=100% align='center'>";

$sql="SELECT name FROM schedule WHERE date LIKE '$date_like' ";
$result=mysql_query($sql);
$num = mysql_num_rows($result);
if($parm_debug_on) {
	fputs($stdlog, "sql :  $sql \n");
	fputs($stdlog, "Num :  $num \n");
}
if ($num == '0') {
	$sql="UPDATE nurse SET enable='0' ";
	$result=mysql_query($sql);
}

$j=1;
$sql="select num,name,nurse,enable,duty from nurse  " ;
if($parm_debug_on) {
	fputs($stdlog, "sql :  $sql \n");
}
$result = mysql_query($sql) ;
while ($row=mysql_fetch_array($result)){
	if (($j % 5) == 1){
		echo "<tr>";     
	}
//if ($row[3]) {
	$nurse_sql = "SELECT schedule FROM schedule WHERE name='$row[1]' AND date like '$date_like' " ;
	$nurse_result = mysql_query($nurse_sql) ;
	$nrow=mysql_fetch_array($nurse_result);
if (($nrow[0] != "") or ($nrow[0] != NULL)) {
	if ($nrow[0] == "day") {
		$color="1";
	} else if ($nrow[0] == "night") {
		$color="2";
	} else if ($nrow[0] == "mid_night") {
		$color="4";
	}
if($parm_debug_on) {
	fputs($stdlog, "Nurse sql :  $nurse_sql \n");
	fputs($stdlog, "Schedule :  $nrow[0] \n");
	fputs($stdlog, "Color :  $color \n");
}
	echo "<td width=10% align='center'>";
	$id="press-button" . $color;
	echo  "<div id='$id'><label><input type=hidden   name=ints[]  value='' ><span>$row[2]</span></label></div>";
	echo " </td>";
} else {
	echo "<td width=10% align='center'> "; 
	echo  "<div id='ck-button'><label><input type=checkbox  name=ints[] value=$row[2]><span>$row[2]</span></label></div>";
	echo "</td>";
}
	$j++;
}

echo "</tr>";
echo "</table>";
mysql_close($link);
?>

<input type="submit" name="Submit" value="排班"><input type=reset value="取消"></th>
</form>

<HR>


</body>
</html>
