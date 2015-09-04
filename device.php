<html>
<head>
<title>工作車</title>
</head>
<body>
<Left><H2  align="left"  class="style1">工作車</H2>

</body>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />

<?php

session_start();
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

echo "<HR>";
echo "<table border=1 width=50% align='left'>";
echo "<tr>";
echo "<th width=5%>  序號  </th>";
echo "<th width=10%>  工作車帳號 </th>";
echo "<th width=10%>  工作車車號 </th>";
echo "<th width=10%>  手機號碼 </th>";
echo "<th width=10%>  工作車狀態 </th>";
echo "</tr>";

$result = mysql_query("SELECT id,name,car,mobile FROM device  ") ;
while ($row=mysql_fetch_array($result)) {
echo "<tr>";
    	echo "<td width=5%>  $row[0]  </td>";
    	echo "<td width=10%>  $row[1]  </td>";
    	echo "<td width=10%>  $row[2]  </td>";
    	echo "<td width=10%>  $row[3]  </td>";

	$status_result= mysql_query("SELECT ipaddr FROM sipfriends") ;

	 $rows=mysql_fetch_array($status_result);
                if (($rows[0] == "0.0.0.0") or ($rows[0] == "")) {
                        $status="離線";
                } else {
                        $status="上線";
                }
        echo "<td width=10%>  $status  </td>";
        echo "</tr>";
}

echo "</table>";
mysql_close($link);
?>

</html>

