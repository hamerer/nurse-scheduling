<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title>護理站手動護士排班</title>
</head>

<body>
<form name="form" method="post" action="nurse_tmp.php">
<Left><H2  align="middle"  class="style1">護理站手動護士排班</H2>
<HR>
<?php
setlocale(LC_ALL, 'zh_TW.Big5');
session_start();
// $today = date("Y-m-d H:i:s");
date_default_timezone_set('Asia/Taipei');

echo "<table border=1 width=50%>";
echo "<tr>";
echo "<td>";
echo "<select size=1 name=date>";
for ($k=7;$k>=0;$k--){
$now  = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+$k, date("Y")));

	echo "<option value=$now selected>$now</option>'";
}
echo "</td>";
echo "</tr>";
echo "</table>";

?>

<input type="submit" name="Submit" value="排班"><input type=reset value="取消"></th>
</form>

</body>
</html>
