<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>病床</title>
<style>
.select {
    bottom: 0;
    left: 220px;
	top: 180px;
    position: absolute;
    width: 100px;
	height: 100px;
    z-index: 7;
	display:block;
	height:100%;
	top:0px;
}
</style>
</head>

<body>
<img src="images/10F_select.jpg" WIDTH="1000">

<?php
session_start();
$station=$_SESSION[account];
?>

<Left><H2  align="middle"  class="style1">病床使用病患資訊</H2>

<?php

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
// mysql_query("SET NAMES 'BIG5' ");
mysql_select_db($dbName,$link) or die( "Unable to select database");

$page_count=30;

// $result = mysql_query("SELECT name,nurse,password FROM nurse WHERE station='$station' ");
echo "<HR>";
echo "<center>";
echo "<table border=1  width=50%>";
echo "<tr>";
echo "<td width=20%>  病例編號  </td>";
echo "<th width=20%>  姓名  </th>";
echo "<th width=10%>  生日</th>";
echo "<th width=10%>  病徵 </th>";
echo "<td width=20%>  所需用藥  </td>";
echo "</tr>";

// $result = mysql_query("SELECT nurse,name,password FROM nurse  WHERE station='$station'  order by name limit $move,$page_count") ;
$result = mysql_query("SELECT num,name,birth,sympton,medicine FROM patient") ;

$i=0;
while ($row=mysql_fetch_array($result)){
  	echo "<tr>";
    	echo "<td width=20%> $row[0] </td>";
    	echo "<td width=20%>  $row[1]  </td>";
    	echo "<td width=20%>  $row[2]  </td>";
		echo "<td width=20%>  $row[3]  </td>";
		echo "<td width=20%>  $row[4]  </td>";
  	echo "</tr>";
}

echo "</table>";
echo "</center>";

mysql_close($link);
?>
</form>  
</body>
</html>
