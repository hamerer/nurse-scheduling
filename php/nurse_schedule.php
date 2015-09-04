<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>護理站護士排班系統</title>

<link rel=stylesheet href="button.css" type="text/css">
</head>

<body>
<Left><H2  align="middle"  class="style1">護理站護士排班系統</H2>
<HR>
<table align=center  border=0 width="40%">
<tr>
<td>
<a href="#" onclick="window.open('./backward.php', 'Backward', config='height=500,width=500');"><img src="./backward.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>
<td>
<a href="#" onclick="window.open('./yestoday.php', 'Yestoday', config='height=500,width=500');">
<img src="./yestoday.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>
<td>
<a href="#" onclick="window.open('./today.php', 'Today', config='height=500,width=500');">
<img src="./today.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>
<td>
<a href="#" onclick="window.open('./tommorow.php', 'Tommorow', config='height=500,width=500');">
<img src="./tommorow.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>
<td>
<a href="#" onclick="window.open('./forward.php', 'Forward', config='height=500,width=500');">
<img src="./forward.jpg" alt="Smiley face" width="84" height="30">
</a>
</td>

</tr>
</table>

<HR>
<?php
session_start();
include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("資料庫開啟錯誤！");
mysql_select_db($dbName,$link) or die( "無法選取資料庫！");

echo "<table border=1 width=100% align='left'>";
echo "<tr>";
echo "<th width=8% align=middle>  班別 </th>";
echo "<th width=90% align=middle>  值班護士 </th>";
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "日  班";
echo "</td>";
$result = mysql_query("SELECT name,car,mobile FROM nurse  ") ;
while ($row=mysql_fetch_array($result)) {
	$status_result= mysql_query("SELECT ipaddr FROM sipfriends  WHERE name=$row[0]") ;
    	echo "<td width=8% align=middle>  $row[0]  </td>";
	$bed_result= mysql_query("SELECT name FROM bed  WHERE device=$row[1]") ;
	while ($row_bed=mysql_fetch_array($bed_result)) {
		echo "<td align=middle>  ";
		echo $row_bed[0];
		echo "</td>";
	}
}
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "小夜班";
echo "</td>";
$result = mysql_query("SELECT name,car,mobile FROM nurse  ") ;
while ($row=mysql_fetch_array($result)) {
	$status_result= mysql_query("SELECT ipaddr FROM sipfriends  WHERE name=$row[0]") ;
    	echo "<td width=8% align=middle>  $row[0]  </td>";
	$bed_result= mysql_query("SELECT name FROM bed  WHERE device=$row[1]") ;
	while ($row_bed=mysql_fetch_array($bed_result)) {
		echo "<td align=middle>  ";
		echo $row_bed[0];
		echo "</td>";
	}
}
echo "</tr>";
echo "<tr>";
echo "<td>";
echo "大夜班";
echo "<td>";
$result = mysql_query("SELECT name,car,mobile FROM nurse  ") ;
while ($row=mysql_fetch_array($result)) {
	$status_result= mysql_query("SELECT ipaddr FROM sipfriends  WHERE name=$row[0]") ;
    	echo "<td width=8% align=middle>  $row[0]  </td>";
	$bed_result= mysql_query("SELECT name FROM bed  WHERE device=$row[1]") ;
	while ($row_bed=mysql_fetch_array($bed_result)) {
		echo "<td align=middle>  ";
		echo $row_bed[0];
		echo "</td>";
	}
}
echo "</tr>";

echo "</table>";

?>
</body>
</html>
