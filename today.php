<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title></title>
<link rel=stylesheet href="button.css" type="text/css">
</head>

<?php
session_start();
include('../db.inc');
date_default_timezone_set('Asia/Chongqing');
$now = date("Y-m-d") ;
$today = $now . "%";

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("��Ʈw�}�ҿ��~�I");
mysql_select_db($dbName,$link) or die( "�L�k�����Ʈw�I");

echo "<tr>";
echo "<td width=10% align=middle>����G </td>";
echo "<td align=middle>  $now </td>";
echo "</tr>";

echo "<HR>";

echo "<table border=1 width=100% align='left'>";
echo "<tr>";
echo "<td width=8% align=middle>  �Z   �O </td>";
echo "<td align=middle>  �ȯZ�@�h���X </td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "��  �Z";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM schedule  WHERE schedule='day' AND date LIKE '$today' ") ;
while ($row=mysql_fetch_array($result)) {
        echo "<td width=8% align=middle>  $row[1]  </td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "�p�]�Z";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM schedule  WHERE schedule='night' AND date LIKE '$today' ") ;
while ($row=mysql_fetch_array($result)) {
        echo "<td width=8% align=middle>  $row[1]  </td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "�j�]�Z";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM schedule  WHERE schedule='mid_night' AND date LIKE '$today' ") ;
while ($row=mysql_fetch_array($result)) {
        echo "<td width=8% align=middle>  $row[1]  </td>";
}
echo "</tr>";

echo "</table>";

mysql_close($link);
?>
</body>
</html>
