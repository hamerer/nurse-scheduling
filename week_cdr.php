<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8" >
<title>���g�@�z���I�s�O��</title>
</head>
<body>

<Left><H2  align="middle"  class="style1">���g�@�z���I�s�O��</H2>

<?php

include('../db.inc');
$t=time();

$week_start=date("Y-m-d H:i:s",mktime(0, 0 , 0,date("m"),date("d")-date("w")+1,date("Y")));
$week_end=date("Y-m-d H:i:s",mktime(23,59,59,date("m"),date("d")-date("w")+7,date("Y")));


$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
// mysql_query("SET NAMES 'BIG5' ");
mysql_select_db($dbName,$link) or die( "Unable to select database");

$page_count=30;

$result = mysql_query("SELECT count(src),sum(duration),sum(billsec) FROM cdr WHERE calldate >= '$week_start' AND calldate <= '$week_end' "); 
$row=mysql_fetch_array($result);
echo "<table border=1  width=100%>";
echo "<tr>";
echo "<th width=20%>  �`�I�s��</th>";
echo "<th width=13%>  $row[0] </th>";
echo "<th width=20%>  �`�I�s���</th>";
echo "<th width=13%>  $row[1] </th>";
echo "<th width=20%>  �`�q�ܬ��</th>";
echo "<th width=13%>  $row[2] </th>";
echo "</tr>";
echo "</table>";

$result = mysql_query("SELECT calldate,src,dst FROM cdr WHERE calldate >= '$week_start' AND calldate <= '$week_end' "); 
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
echo "<center>";
echo "<table border=1  width=100%>";
echo "<tr>";
echo "<th width=20%>  �I�s�}�l�ɶ�  </th>";
echo "<th width=15%>  �I�s�f��  </th>";
echo "<th width=15%>  �Q�I�s�@�z�v </th>";
echo "<th width=15%>  �B�z���� </th>";
echo "<th width=15%>  ���ݮɶ� </th>";
echo "<th width=15%>  �q�ܮɶ� </th>";

echo "</tr>";

$result = mysql_query("SELECT calldate,src,dst,duration,billsec,disposition FROM cdr WHERE  calldate >= '$week_start' AND calldate <= '$week_end' order by calldate limit $move,$page_count") ;

$i=0;
while ($row=mysql_fetch_array($result)){
  	echo "<tr>";
    	echo "<td width=20%>  $row[0]  </td>";
    	echo "<td width=15%>  $row[1]  </td>";
    	echo "<td width=15%>  $row[2]  </td>";
    	echo "<td width=15%>  $row[5]  </td>";
	$wait=$row[3]-$row[4];
    	echo "<td width=15%>  $wait  </td>";
    	echo "<td width=15%>  $row[4]  </td>";
  	echo "</tr>";
}
echo "<tr>";
echo "<td align='right'>";
for ($i=$$page_total+1;$i<=$page_total;$i++)
	echo "<a href='week_cdr.php?page=".$i."'>[".$i ."]</a> "; 
echo "</tr>";
echo "</table>";

mysql_close($link);

?>

</body>
</html>

