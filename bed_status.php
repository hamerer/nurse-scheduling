<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>護理站派班狀態</title>

<link rel=stylesheet href="button.css" type="text/css">
</head>

<body>
<Left><H2  align="middle"  class="style1">護理站派班狀態</H2>
<HR>
<?php
session_start();
include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("資料庫開啟錯誤！");
mysql_select_db($dbName,$link) or die( "無法選取資料庫！");
?>


<?php
echo "<table border=1 width=100%>";
echo "<tr>";
$sql = "SELECT  car,color  FROM device ";
$result= mysql_query($sql);
$num = mysql_num_rows($result);
while ($rows=mysql_fetch_array($result)){
	echo " <td  width=10% align='center' >";
	$id="press-button" . $rows[1];
	echo  "<div id='$id'><label><input type=radio  name=device  value=$rows[0]><span>護理 師 $rows[0]</span></label></div>";
  	echo "</td>";
}
echo "</tr>";
echo "</table>";

?>
<HR>

<?php

echo "<table border=1 width=100% align='center'>";

$j=1;
$result = mysql_query("select id,bed,name,enable,device from bed  ") ;
while ($row=mysql_fetch_array($result)){
	if (($j % 8) == 1){
		echo "<tr>";     
	}
if ($row[3]) {
	$color_result = mysql_query("SELECT color FROM device WHERE car=$row[4] ") ;
	$crow=mysql_fetch_array($color_result);
	echo "<td width=10% align='center'>";
	$id="press-button" . $crow[0];
	echo  "<div id='$id'><label><input type=hidden   name=ints[]  value='' ><span>$row[1]</span></label></div>";
	echo " </td>";
} else {
	echo "<td width=10% align='center'> "; 
	echo  "<div id='ck-button'><label><input type=checkbox  name=ints[] value=$row[2]><span>$row[1]</span></label></div>";
	echo "</td>";
}
	$j++;
}

echo "</tr>";
echo "</table>";
mysql_close($link);
?>
</body>
</html>
