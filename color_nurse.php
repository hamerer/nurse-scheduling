<html>
<head>
<title>設定護理人員顏色</title>
</head>
<body>
<Left><H2  align="middle"  class="style1">設定護理人員顏色</H2>

<meta http-equiv="Content-Type" content="text/html; charset=big5" />

<?php 
session_start(); 
include('../db.inc');

echo "<form name=form method=post action=color_do_nurse.php>";

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

echo "<table border=1 width=40%>";
$j=1;
$sql = "SELECT  color,type,name  FROM color ";
$result= mysql_query($sql);
$num = mysql_num_rows($result);

$nurse_sql = "SELECT  nurse  FROM nurse ";
$nurse_result= mysql_query($nurse_sql);
$nurse_no = mysql_num_rows($nurse_result);
$_SESSION['nurse_no']=$nurse_no;

while ($rows=mysql_fetch_array($result)){
 
  echo "<tr>";
  echo "<td width=10%> "; 
  echo "顏色";
  echo "</td>";
  echo " <td  width=10%>";
  echo "<font color=#$rows[1]>$rows[2]</font>";
  echo "</td>";
  echo "<td  width=10%> ";
  echo "護理人員";
  echo "</td>";
  $nurse="nurse" . $j;
  echo "<td width=10%><select name=$nurse>";
  echo '<option value="  ">'. '設定護理人員' .'</option>';
  $i=1;
  $nurse_sql = "SELECT  nurse  FROM nurse ";
  $nurse_result= mysql_query($nurse_sql);

  while ($row_nurse=mysql_fetch_array($nurse_result)){
        echo "<option value=";
        echo $i;
        echo ">";
        echo $row_nurse[0];
        echo  "</option>";
	$i++;
  }
/*
  for ($i=1;$i<=$nurse_no;$i++) {
        echo "<option value=";
        echo $i;
        echo ">";
        echo  "護士 ";
        echo $i;
        echo  "</option>";
   }
*/
   echo "</select>";
   echo "</tr>";
   $j=$j+1; 
}
echo "</table>";

/*
for ($i=1;$i<=$nurse_no;$i++) {
$nurse="nurse" .$i;
if(($nurse != NULL) or ($nurse !="")) {        
	$sql="UPDATE nurse set color=$i where nurse=$nurse";
	$result= mysql_query($sql);
}
}
*/

mysql_close($link);

echo "<tr>";
echo "<input type=submit name=Submit value=設定><input type=reset value=取消>";
echo "</tr>";
echo "</form>";

?>

</body>
</html>
