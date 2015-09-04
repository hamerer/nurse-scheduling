<html>
<head>
<title>修改護理師資料</title>
</head>
<body>
<Center><H2>修改護理師資料</H2><HR>
<form name="form" method="post" action="modify_nurse.php">
<tr>
<th><label for="user name"> 請輸入護理師帳號</label></th>
<td>
<input type="text" name="name" size="25" >
</td>
</tr>
<br>
<br><br>
<input type="submit" name="Submit" value="確定">
<input type=reset value=取消>
</form>

<?php 

session_start(); 
include('../db.inc');

$page_count=50;

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

//$result= mysql_query("SELECT name FROM nurse WHERE station='$station'  ") or die(mysql_error());
$result= mysql_query("SELECT name FROM nurse ") or die(mysql_error());
$number = mysql_num_rows($result);

$page_total=intval($number/$page_count);

if ($number % $page_count){
	$page_total++;
}

if (isset($_GET['page'])){
	$page=intval($_GET['page']);
}
else{
	$page=1;
}

$move=$page_count * ($page - 1);

echo "<HR>";
echo "<table border=1 width=100%>";
echo "<tr>";
echo "<th width=20%>  護理師名稱  </th>";
echo "<th width=20%>  護理師帳號  </th>";
echo "<th width=20%>  護理師密碼 </th>";
echo "</tr>";

// $result = mysql_query("SELECT nurse,name,password FROM nurse WHERE station='$station'  ORDER BY name limit $move,$page_count") ;
$result = mysql_query("SELECT nurse,name,password FROM nurse ORDER BY name limit $move,$page_count") ;
$i=0;
while ($row=mysql_fetch_array($result)){
  	echo "<tr>";
    	echo "<th width=10%>  $row[0]  </th>";
    	echo "<th width=20%>  $row[1]  </th>";
    	echo "<th width=8%>  $row[2]  </th>";
  	echo "</tr>";
}
echo "<tr>";
echo "<td align='right'>";
for ($i=$$page_total+1;$i<=$page_total;$i++)
	echo "<a href='nurse_modify.php?page=".$i."'>[".$i ."]</a> "; 
echo "</tr>";
echo "</table>";
mysql_close($link);

?>
</body>
</html>
