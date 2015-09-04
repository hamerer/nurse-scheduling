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
date_default_timezone_set('Asia/Taipei');
$now  = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+$k, date("Y")));
$date=$_SESSION[date];
$date_like = $date . "%";
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
echo "<th width=20%><font color=\"RED\">  病房編號 </font> </th>";
echo "<th width=20%>  早班護理師  </th>";
echo "<th width=10%>  夜班護理師 </th>";
echo "<th width=10%>  大夜班護理師 </th>";
echo "</tr>";

// $result = mysql_query("SELECT nurse,name,password FROM nurse  WHERE station='$station'  order by name limit $move,$page_count") ;
$result = mysql_query("SELECT id,day_nurse,night_nurse,mid_nurse FROM bed WHERE id='1001' ") ;
while ($row=mysql_fetch_array($result)){
  	echo "<tr>";
		echo "<th width=20%>  $row[0] </th>";
    	echo "<td width=20%>  $row[1]  </td>";
    	echo "<td width=20%>  $row[2]  </td>";
    	echo "<td width=20%>  $row[3]  </td>";
  	echo "</tr>";
}
$result = mysql_query("SELECT id,day_nurse,night_nurse,mid_nurse FROM bed WHERE id='1002'") ;
while ($row=mysql_fetch_array($result)){
  	echo "<tr>";
		echo "<th width=20%>  $row[0] </th>";
    	echo "<td width=20%>  $row[1]  </td>";
    	echo "<td width=20%>  $row[2]  </td>";
    	echo "<td width=20%>  $row[3]  </td>";
  	echo "</tr>";
}
$result = mysql_query("SELECT id,day_nurse,night_nurse,mid_nurse FROM bed WHERE id!='1002'&& id!='1001'") ;
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

