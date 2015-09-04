<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<?php

session_start(); 
$station=$_SESSION[account];

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

$name=$_POST[name];
$name=trim($name);
$_SESSION[name] = $name;
if (empty($name) ){
    	echo   "<script>alert('護理師帳號不能為空白，請重新輸入！');</script>";
	exit;
}

// $sql= "SELECT name FROM nurse WHERE station='$station' AND name='$name' ";
$sql= "SELECT name FROM nurse WHERE name='$name' ";
$result= mysql_query($sql,$link) or die(mysql_error());
$number = mysql_num_rows($result);
if($number == 0){
    	echo   "<script>alert('沒有這個護理師帳號，請重新輸入！');</script>";
	exit;
}

// $sql = "SELECT  nurse,name,password  FROM nurse WHERE station='$station' AND name='$name' ";
$sql = "SELECT  nurse,name,password  FROM nurse WHERE name='$name' ";
$result= mysql_query($sql);
$rows = mysql_fetch_array($result);

echo "<table border=0 width=65%>";

echo "<form name=form method=post action=modify_do_nurse.php>";

  echo "<tr>";
  echo "<td  width=20%><span class=style1> ";
  echo "護理師姓名";
  echo "</span></td>";
  echo " <td  width=25%>";
  echo " $rows[0]";
  echo "</td>";
  echo " <td  width=20%>";
  echo  "<input type=text name=nurse size=20 >";
  echo "</td>";
  echo "</tr>";


  echo "<tr>";
  echo "<td  width=20%><span class=style1> ";
  echo "護理師帳號";
  echo "</span></td>";
  echo " <td  width=25%>";
  echo " $rows[1]";
  echo "</td>";
  echo " <td  width=20%>";
  echo  "";
  echo "</td>";
  echo "<tr>";


  echo "<tr>";
  echo "<td  width=20%><span class=style1> ";
  echo "護理師密碼";
  echo "</span></td>";
  echo " <td  width=25%>";
  echo " $rows[2]   ";
  echo "</td>";
  echo " <td  width=20%>";
  echo  "<input type=text name=mypass size=20 >";
  echo "</td>";
  echo "</tr>";

echo "</table>";

mysql_close($link);

echo "<tr>";
echo "<input type=submit name=Submit value=確定><input type=reset value=取消>";
echo "</tr>";
echo "</form>";

?>

