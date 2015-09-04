<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title></title>
</head>

<?php
session_start();
include('../db.inc');
// date_default_timezone_set('Asia/Taipei');
// $today = date("Y-m-d") . "%";
$date=$_SESSION[date];

$today=$date . "%";
echo $date;
echo "<cr>";

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("資料庫開啟錯誤！");
mysql_select_db($dbName,$link) or die( "無法選取資料庫！");

echo "<table border=1 width=100% align='left'>";
echo "<tr>";
echo "<td width=8% align=middle>  班   別 </td>";
echo "<td align=middle>  值班護士號碼 </td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "日  班";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM schedule  WHERE schedule='day' AND date LIKE '$today' ") ;
while ($row=mysql_fetch_array($result)) {
        echo "<td width=8% align=middle>  $row[1]  </td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "小夜班";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM schedule  WHERE schedule='night' AND date LIKE '$today' ") ;
while ($row=mysql_fetch_array($result)) {
        echo "<td width=8% align=middle>  $row[1]  </td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "大夜班";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM schedule  WHERE schedule='mid_night' AND date LIKE '$today' ") ;
while ($row=mysql_fetch_array($result)) {
        echo "<td width=8% align=middle>  $row[1]  </td>";
}
echo "</tr>";

echo "</table>";
?>
<HR>
<?php
echo "<table border=1 width=100% align='left'>";
echo "<tr>";
echo "<td width=8% align=middle>  班   別 </td>";
echo "<td align=middle>  值班護士號碼 </td>";
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "日  班";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM schedule  WHERE schedule='day' AND date LIKE '$today' ") ;
while ($row=mysql_fetch_array($result)) {
        echo "<td width=8% align=middle>  $row[0]  </td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "小夜班";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM schedule  WHERE schedule='night' AND date LIKE '$today' ") ;
while ($row=mysql_fetch_array($result)) {
        echo "<td width=8% align=middle>  $row[0]  </td>";
}
echo "</tr>";

echo "<tr>";
echo "<td>";
echo "大夜班";
echo "</td>";
$result = mysql_query("SELECT name,nurse FROM schedule  WHERE schedule='mid_night' AND date LIKE '$today' ") ;
while ($row=mysql_fetch_array($result)) {
        echo "<td width=8% align=middle>  $row[0]  </td>";
}
echo "</tr>";

echo "</table>";

mysql_close($link);
?>

</body>
</html>
