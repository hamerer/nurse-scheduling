<html>
<head>
<title>新增工作車</title>
</head>
<body>
<Left><H2  align="left"  class="style1">新增工作車</H2>

</body>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<HR>
<form name="form" method="post" action="add_do_device.php">
<table border=1 width="90%">
  <tr>

     <td  width="15%">工作車帳號</td>
     <td  width="15%">
      <input type="text" name="name" size="20">
    </td>

     <td  width="15%">工作車車號</td>
     <td  width="15%">
      <input type="text" name="car" size="20">
    </td>
    

    <td width="10%">手機號碼</td>
     <td  width="20%">
      <input type="text" name="mobile" size="20">
    </td>
  
</tr>
</table>

<table>
<tr>
<td><input type="submit" name="Submit" value="新增"><input type=reset value="取消"></td>
</tr>
</table>
</form>


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
	$status_result= mysql_query("SELECT ipaddr FROM sipfriends  WHERE name=$row[1]") ;

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

