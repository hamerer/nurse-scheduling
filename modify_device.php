<html>
<head>
<title>修改工作車</title>
</head>
<body>
<Left><H2  align="middle"  class="style1">修改工作車</H2>

<meta http-equiv="Content-Type" content="text/html; charset=big5" />

<?php 
session_start(); 
include('../db.inc');

echo "<form name=form method=post action=modify_do_device.php>";

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

echo "<table border=1 width=100%>";

$sql = "SELECT  car,name,mobile  FROM device ";
$result= mysql_query($sql);
$i=1;
while ($rows=mysql_fetch_array($result)){
  $name="name" . $i;
  $mobile="mobile" . $i;
  
  echo "<td  width=8%> ";
  echo "工作車";
  echo "</td>";
  echo " <td  width=5%>";
  echo " $rows[0]   ";
  echo "</td>";

  echo "<td  width=8%> ";
  echo "工作車帳號";
  echo "</td>";
 echo " <td  width=5%>";
  echo " $rows[1]   ";
  echo "</td>";
  echo " <td  width=10%>";
  echo  "<input type=text name=$name size=5>";
  echo "</td>";

  echo "<td  width=8%> ";
  echo "手機號碼";
  echo "</td>";
  echo " <td  width=16%>";
  echo " $rows[2]   ";
  echo "</td>";
  echo " <td  width=10%>";
  echo  "<input type=text name=$mobile size=15 >";
  echo "</td>";

  echo "</tr>";
  $i++;
}

echo "</table>";

mysql_close($link);

echo "<tr>";
echo "<input type=submit name=Submit value=確定><input type=reset value=取消>";
echo "</tr>";
echo "</form>";

?>

</body>
</html>

