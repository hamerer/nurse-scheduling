<html>
<head>
<title>�@�z���f�ɪ��A</title>
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

<Left><H2  align="middle"  class="style1">�@�z���f�ɪ��A</H2>
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
echo "<th width=5%>  �Ǹ�  </th>";
echo "<th width=5%>  �ɸ�  </th>";
echo "<th width=8%>  �������X </th>";
echo "<th width=10%>  ������X </th>";
echo "<th width=8%>  �u�@���� </th>";
echo "<th width=10%>  �u�@�����A </th>";

echo "<th width=5%>  �Ǹ�  </th>";
echo "<th width=5%>  �ɸ�  </th>";
echo "<th width=8%>  �������X </th>";
echo "<th width=10%>  ������X </th>";
echo "<th width=8%>  �u�@���� </th>";
echo "<th width=10%>  �u�@�����A </th>";

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
            		$status="���u";
        	} else {
                	$status="�W�u";
        	}
    	echo "<td width=10%>  $status  </td>";
	$j++;
}

echo "</table>";
mysql_close($link);
?>

</html>

