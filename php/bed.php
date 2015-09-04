<html>
<head>
<title>護理站病床狀態</title>
</head>
<body>
<?php
session_start();
include('../db.inc');
$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
if ($link) {
        mysql_select_db($dbName,$link) or die( "Unable to select database");
}else{
        echo "connect error";
}
?>

<Left><H2  align="middle"  class="style1">護理站病床狀態</H2>
<HR>
<form name="form" method="post" action="insert_context.php">
</body>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />

<?php

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

echo "<HR>";
echo "<table border=1 width=100% align='center'>";
echo "<tr>";
echo "<th width=5%>  序號  </th>";
echo "<th width=5%>  床號  </th>";
echo "<th width=8%>  分機號碼 </th>";
echo "<th width=10%>  手機號碼 </th>";
echo "<th width=8%>  工作車號 </th>";
echo "<th width=10%>  工作車狀態 </th>";

echo "<th width=5%>  序號  </th>";
echo "<th width=5%>  床號  </th>";
echo "<th width=8%>  分機號碼 </th>";
echo "<th width=10%>  手機號碼 </th>";
echo "<th width=8%>  工作車號 </th>";
echo "<th width=10%>  工作車狀態 </th>";

echo "</tr>";

$j=1;
$result = mysql_query("select id,name,phone,mobile,device from bed  ") ;
while ($row=mysql_fetch_array($result)){
	if (($j % 2) == 1){
		echo "<tr>";     
	}

    	echo "<td width=5%>  $row[0]  </td>";
    	echo "<td width=5%>  $row[1]  </td>";
    	echo "<td width=8%>  $row[2]  </td>";
    	echo "<td width=10%>  $row[3]  </td>";
    	echo "<td width=8%>  $row[4]  </td>";
	$status_result= mysql_query("SELECT ipaddr FROM sipfriends  WHERE name=$row[1]") ;
	$rows=mysql_fetch_array($status_result);
        	if (($rows[0] == "0.0.0.0") or ($rows[0] == "")) {
            		$status="離線";
        	} else {
                	$status="上線";
        	}
    	echo "<td width=10%>  $status  </td>";
	$j++;
}

echo "</table>";
mysql_close($link);
?>

</html>

