<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5" >
<title>當天病房護理師排班紀錄</title>
</head>
<body>

<?php
session_start();
$station=$_SESSION[account];
?>

<?php

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
// mysql_query("SET NAMES 'BIG5' ");
mysql_select_db($dbName,$link) or die( "Unable to select database");

$page_count=30;

// $result = mysql_query("SELECT name,nurse,password FROM nurse WHERE station='$station' ");
$result = mysql_query("SELECT id,day_nurse,night_nurse,mid_nurse FROM bed") ;

$rows = mysql_num_rows($result);

$page_total=intval($rows/$page_count);

if ($rows % $page_count){
	$page_total++;
}

if (isset($_GET['page'])){
	$page=intval($_GET['page']);
}
else{
	$page=1;
}

$move=$page_count * ($page - 1);

echo "<HR>";
echo "<center>";
echo "<table border=1  width=50%>";
echo "<tr>";
echo "<th width=20%>  病房編號  </th>";
echo "<th width=20%>  護理師姓名  </th>";
echo "<th width=10%>  護理師帳號  </th>";
echo "<th width=10%>  護理師密碼 </th>";
echo "</tr>";

// $result = mysql_query("SELECT nurse,name,password FROM nurse  WHERE station='$station'  order by name limit $move,$page_count") ;
$result = mysql_query("SELECT id,day_nurse,night_nurse,mid_nurse FROM bed WHERE id='1001'") ;
while ($row=mysql_fetch_array($result)){
  	echo "<tr>";
		echo "<th width=20%><font color=\"RED\">  $row[0]</font> </th>";
    	echo "<td width=20%><font color=\"RED\">  $row[1] </font> </td>";
    	echo "<td width=20%><font color=\"RED\">  $row[2] </font> </td>";
    	echo "<td width=20%><font color=\"RED\">  $row[3] </font> </td>";
  	echo "</tr>";
}
$result = mysql_query("SELECT id,day_nurse,night_nurse,mid_nurse FROM bed WHERE id BETWEEN '1002' AND '1010'") ;
while ($row=mysql_fetch_array($result)){
  	echo "<tr>";
		echo "<th width=20%>  $row[0] </th>";
    	echo "<td width=20%>  $row[1]  </td>";
    	echo "<td width=20%>  $row[2]  </td>";
    	echo "<td width=20%>  $row[3]  </td>";
  	echo "</tr>";
}

$result = mysql_query("SELECT id,day_nurse,night_nurse,mid_nurse FROM bed WHERE id='1011'") ;
while ($row=mysql_fetch_array($result)){
  	echo "<tr>";
		echo "<th width=20%><font color=\"RED\">  $row[0]</font> </th>";
    	echo "<td width=20%><font color=\"RED\">  $row[1] </font> </td>";
    	echo "<td width=20%><font color=\"RED\">  $row[2] </font> </td>";
    	echo "<td width=20%><font color=\"RED\">  $row[3] </font> </td>";
  	echo "</tr>";
}
$result = mysql_query("SELECT id,day_nurse,night_nurse,mid_nurse FROM bed WHERE id BETWEEN '1012' AND '1019'") ;
while ($row=mysql_fetch_array($result)){
  	echo "<tr>";
		echo "<th width=20%>  $row[0] </th>";
    	echo "<td width=20%>  $row[1]  </td>";
    	echo "<td width=20%>  $row[2]  </td>";
    	echo "<td width=20%>  $row[3]  </td>";
  	echo "</tr>";
}

echo "<tr>";
echo "<td align='right'>";
for ($i=$$page_total+1;$i<=$page_total;$i++)
	echo "<a href='add_nurse.php?page=".$i."'>[".$i ."]</a> "; 
echo "</tr>";
echo "</table>";
echo "</center>";

mysql_close($link);
?>

</body>
</html>

