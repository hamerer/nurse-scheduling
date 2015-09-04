<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>換班</title>
<link rel=stylesheet href="button.css" type="text/css">
</head>

<body>

<Left><H2  align="middle"  class="style1">換班</H2>
<HR>
<form name="form" method="post" action="change_do_bed.php">
<table border=1 width="100%">
<tr>

<?php
session_start();
include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("資料庫開啟錯誤！");
mysql_select_db($dbName,$link) or die( "無法選取資料庫！");

echo "<table border=1 width=100%>";
echo "<tr>";
$sql = "SELECT  car,color,enable  FROM device ";
$result= mysql_query($sql);
$num = mysql_num_rows($result);
while ($rows=mysql_fetch_array($result)){
	echo " <td  width=10% align='center' >";
	
	if ($rows[2]) { 
		$id="press-button" . $rows[1];
		//$device="device" . $rows[0];
		echo  "<div id='$id'><label><input type=checkbox  name=device[]  value=$rows[0]><span>護理師 $rows[0]</span></label></div>";
  	} else {
		echo  "<div id='ck-button'><label><input type=hidden   name='$device'  value=$rows[0]><span>護理師 $rows[0]</span></label></div>";
	}
	echo "</td>";
}
echo "</tr>";
echo "</table>";

?>

<?php

echo "<table border=1 width=100% align='center'>";

$j=1;
$result = mysql_query("select id,name,phone,enable,device from bed  ") ;
while ($row=mysql_fetch_array($result)){
	if (($j % 8) == 1){
		echo "<tr>";     
	}
if (!$row[3]) {
	echo "<td width=10% align='center'> "; 
	echo  "<div id='ck-button'><label><input type=hidden  name=ints[] value=$row[2]><span>$row[1]</span></label></div>";
	echo "</td>";
} else {
	$color_result = mysql_query("SELECT color FROM device WHERE car=$row[4] ") ;
	$crow=mysql_fetch_array($color_result);
	echo "<td width=10% align='center'>";
	$id="press-button" . $crow[0];
	echo  "<div id='$id'><label><input type=hidden   name=ints[]  value='' ><span>$row[1]</span></label></div>";
	echo " </td>";
}
	$j++;
}

echo "</tr>";
echo "</table>";
mysql_close($link);
?>
<input type="submit" name="Submit" value=換班><input type=reset value="取消"></th>
</form>  
</body>
</html>
