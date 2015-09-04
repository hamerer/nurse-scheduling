<html>
<head>
<title>派班狀態</title>
</head>
<body>
<Left><H2  align="middle"  class="style1">派班狀態</</H2>

</body>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />

<?php

session_start();
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

echo "<HR>";
echo "<table border=1 width=100% align='left'>";
echo "<tr>";
echo "<th width=8% align=middle>  工作車號 </th>";
echo "<th width=8% align=middle>  分機號碼 </th>";
echo "<th width=10% align=middle>  工作車狀態 </th>";
echo "<th width=10% align=middle>  手機號碼 </th>";
echo "</tr>";

$result = mysql_query("SELECT name,car,mobile FROM device  ") ;
while ($row=mysql_fetch_array($result)) {
echo "<tr>";
	$status_result= mysql_query("SELECT ipaddr FROM sipfriends  WHERE name=$row[0]") ;
	$rows=mysql_fetch_array($status_result);
        	if (($rows[0] == "0.0.0.0") or ($rows[0] == "")) {
            		$status="離線";
        	} else {
                	$status="上線";
        	}
    	echo "<td width=8% align=middle>  $row[1]  </td>";
    	echo "<td width=8% align=middle>  $row[0]  </td>";
    	echo "<td width=10% align=middle>  $status  </td>";
    	echo "<td width=10% align=middle>  $row[2]  </td>";

	$bed_result= mysql_query("SELECT name FROM bed  WHERE device=$row[1]") ;
	while ($row_bed=mysql_fetch_array($bed_result)) {
		echo "<td align=middle>  ";
		echo $row_bed[0];
		echo "</td>";
	}

	echo "</tr>";
}
echo "</table>";
echo "\n";

echo "<HR>";
echo "<table border=1 width=100% align='left'>";
echo "<tr>";
echo "<th width=8% align=middle>  工作車號 </th>";
echo "<th width=8% align=middle>  分機號碼 </th>";
echo "<th width=10% align=middle>  工作車狀態 </th>";
echo "<th width=10% align=middle>  手機號碼 </th>";
echo "</tr>";

$result = mysql_query("SELECT name,car,mobile FROM device  ") ;
while ($row=mysql_fetch_array($result)) {
echo "<tr>";
	$status_result= mysql_query("SELECT ipaddr FROM sipfriends  WHERE name=$row[0]") ;
	$rows=mysql_fetch_array($status_result);
        	if (($rows[0] == "0.0.0.0") or ($rows[0] == "")) {
            		$status="離線";
        	} else {
                	$status="上線";
        	}
    	echo "<td width=8% align=middle>  $row[1]  </td>";
    	echo "<td width=8% align=middle>  $row[0]  </td>";
    	echo "<td width=10% align=middle>  $status  </td>";
    	echo "<td width=10% align=middle>  $row[2]  </td>";

	$bed_result= mysql_query("SELECT phone FROM bed  WHERE device=$row[1]") ;
	while ($row_bed=mysql_fetch_array($bed_result)) {
		echo "<td align=middle>  ";
		echo $row_bed[0];
		echo "</td>";
	}

	echo "</tr>";
}
echo "</table>";


mysql_close($link);
?>

</html>

