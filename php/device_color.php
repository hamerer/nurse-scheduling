<html>
<head>
<title>�]�w�q�T�˸m�C��</title>
</head>
<body>
<Left><H2  align="middle"  class="style1">�]�w�q�T�˸m�C��</H2>

<meta http-equiv="Content-Type" content="text/html; charset=big5" />

<?php 
session_start(); 
include('../db.inc');

echo "<form name=form method=post action=modify_do_device.php>";

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

echo "<table border=1 width=40%>";

$sql = "SELECT  car,name,mobile  FROM device ";
$result= mysql_query($sql);
$i=1;
while ($rows=mysql_fetch_array($result)){
  $name="name" . $i;
  $mobile="mobile" . $i;
  
  echo "<td  width=10%> ";
  echo "�˸m���X";
  echo "</td>";
  echo " <td  width=10%>";
  echo " $rows[0]   ";
  echo "</td>";

  echo "<td  width=10%> ";
  echo "����C��";
  echo "</td>";
  echo " <td  width=10%>";
  echo "<select name=context>";
  echo  "<option value=1><font color=#FF0000>����</font></option>";
  echo  "<option value=2><font color=#00FF00>���</font></option>";

  echo  "</select></td>";  


  echo "</tr>";
  $i++;
}

echo "</table>";

mysql_close($link);

echo "<tr>";
echo "<input type=submit name=Submit value=�]�w><input type=reset value=����>";
echo "</tr>";
echo "</form>";

?>

</body>
</html>

