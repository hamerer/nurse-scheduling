<html>
<head>
<title>�]�w�@�z�H���C��</title>
</head>
<body>
<Left><H2  align="middle"  class="style1">�]�w�@�z�H���C��</H2>

<meta http-equiv="Content-Type" content="text/html; charset=big5" />

<?php 
session_start(); 
include('../db.inc');

echo "<form name=form method=post action=color_do_device.php>";

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

echo "<table border=1 width=40%>";
$j=1;
$sql = "SELECT  color,type,name  FROM color ";
$result= mysql_query($sql);
$num = mysql_num_rows($result);
$_SESSION['num']=$num;

while ($rows=mysql_fetch_array($result)){
 
  echo "<tr>";
  echo "<td width=10%> "; 
  echo "�C��";
  echo "</td>";
  echo " <td  width=10%>";
  echo "<font color=#$rows[1]>$rows[2]</font>";
  echo "</td>";
  echo "<td  width=10%> ";
  echo "�@�z�H��";
  echo "</td>";
 $device="device" . $j;
  echo "<td width=10%><select name=$device>";
  echo '<option value="  ">'. '�]�w�@�z�H��' .'</option>';
  for ($i=1;$i<=8;$i++) {
        echo "<option value=";
        echo $i;
        echo ">";
        echo  "�@�h ";
        echo $i;
        echo  "</option>";
   }
   echo "</select>";
   echo "</tr>";
   $j=$j+1; 
}
echo "</table>";

for ($i=1;$i<=$num;$i++) {
$device="device" .$i;
if(($device != NULL) or ($device !="")) {        
	$sql="UPDATE device set color=$i where car=$device";
	$result= mysql_query($sql);
}
}

mysql_close($link);

echo "<tr>";
echo "<input type=submit name=Submit value=�]�w><input type=reset value=����>";
echo "</tr>";
echo "</form>";

?>

</body>
</html>
