<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=big5" >
<title>�R���@�z�v���</title>
</head>
<body>

<?php
session_start();
$station=$_SESSION[account];
?>

<Left><H2  align="middle"  class="style1">�R���@�z�v���</H2>
<table border=1 width="30%">
  <tr>
     <td  width="50%">�@�z���G</td>
     <td  width="50%">
<?php
	echo $station;
?>
    </td>
</tr>
</table>
<HR>
<form name="form" method="post" action="del_do_station.php">
<tr>
<table border=1 width="90%">
  <tr>
     <td  width="10%">�@�z�v�b��</td>
     <td  width="20%">
      <input type="text" name="name" size="20">
    </td>
  
</tr>
</table>

<table>
<tr>
<td><input type="submit" name="Submit" value="�R��"><input type=reset value="����"></td>
</tr>
</table>
</form>

<?php

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
//mysql_query("SET NAMES 'BIG5' ");
mysql_select_db($dbName,$link) or die( "Unable to select database");

$page_count=30;

// $result = mysql_query("SELECT name,nurse,password FROM nurse WHERE station='$station' ") or die(mysql_error());
$result = mysql_query("SELECT name,nurse,password FROM nurse ") or die(mysql_error());
$rows = mysql_num_rows($result);

$page_total=intval($rows/$page_count);

if ($rows % $page_count){
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
echo "<table border=1 width=50%>";
echo "<tr>";
echo "<th width=20%>  �@�z�v�m�W  </th>";
echo "<th width=20%>  �@�z�v�b��  </th>";
echo "<th width=20%>  �@�z�v�K�X </th>";
echo "</tr>";

// $result = mysql_query("SELECT nurse,name,password FROM nurse WHERE station ='station' ORDER BY name LIMIT  $move,$page_count") ;
$result = mysql_query("SELECT nurse,name,password FROM nurse ORDER BY name LIMIT  $move,$page_count") ;
$i=0;
while ($row=mysql_fetch_array($result)){
  	echo "<tr>";
    	echo "<td width=20%>  $row[0]  </td>";
    	echo "<td width=20%>  $row[1]  </td>";
    	echo "<td width=20%>  $row[2]  </td>";
  	echo "</tr>";
}
echo "<tr>";
echo "<td align='right'>";
for ($i=$$page_total+1;$i<=$page_total;$i++)
	echo "<a href='del_nurse.php?page=".$i."'>[".$i ."]</a> "; 
echo "</tr>";
echo "</table>";
mysql_close($link);
?>

</body>
</html>

