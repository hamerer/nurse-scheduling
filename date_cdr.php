<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<html>
<head>
<title>�϶��q�ܶq�έp</title>
</head>

<body>
<table border=1 width=100%>

<?
include('db.inc');

$account=$_SESSION[account];

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

$year1=$_POST[year1];
$month1=$_POST[month1];
$day1=$_POST[day1];
$year2=$_POST[year2];
$month2=$_POST[month2];
$day2=$_POST[day2];

if (($month1 == "4") or ($month1 == "6") or ($month1 == "9") or ($month1 == "11")) {
	if ($day1 > "30"){
    		echo   "<script>alert('�}�l�d�ߪ��Ӥ���S����31�ѡA�Э��s��J�I');</script>";
    		echo   "<script>history.back();</script>";
    		exit;
	}
}

if($month1 == "2"){

	if ((($year1 % 4) > 0) and ($day1 > "28")){
    		echo   "<script>alert('�}�l�d�ߪ��Ӧ~�A�G����S����29�ѡA�Э��s��J�I');</script>";
    		echo   "<script>history.back();</script>";
    		exit;
	} else if ($day1 > "29"){
    		echo   "<script>alert('�}�l�d�ߪ��Ӧ~�A�G����S����30�ѡA�Э��s��J�I');</script>";
    		echo   "<script>history.back();</script>";
    		exit;
	}
}

if (($month2 == "4") or ($month2 == "6") or ($month2 == "9") or ($month2 == "11")) {
	if ($day1 > "30"){
    		echo   "<script>alert('�I��d�ߪ��Ӥ���S����31�ѡA�Э��s��J�I');</script>";
    		echo   "<script>history.back();</script>";
    		exit;
	}
}

if($month2 == "2"){

	if ((($year2 % 4) > 0) and ($day2 > "28")){
    		echo   "<script>alert('�I��d�߸Ӧ~�A�G����S����29�ѡA�Э��s��J�I');</script>";
    		echo   "<script>history.back();</script>";
    		exit;
	} else if ($day2 > "29"){
    		echo   "<script>alert('�I��d�߸Ӧ~�A�G����S����30�ѡA�Э��s��J�I');</script>";
    		echo   "<script>history.back();</script>";
    		exit;
	}
}

if($year1 > $year2){
	echo   "<script>alert('�}�l�d�ߪ��~������j��I��d�ߪ��~���A�Э��s��J�I');</script>";
	echo   "<script>history.back();</script>";
	exit;
}

if($month1 > $month2){
	echo   "<script>alert('�}�l�d�ߪ��������j��I��d�ߪ�����A�Э��s��J�I');</script>";
	echo   "<script>history.back();</script>";
	exit;
}

if($day1 > $day2){
        echo   "<script>alert('�}�l�d�ߪ��������j��I��d�ߪ�����A�Э��s��J�I');</script>";
        echo   "<script>history.back();</script>";
        exit;
}

$start = $year1 . "-" . $month1 . "-" . $day1 . " 00:00:00";
$end = $year2 . "-" . $month2 . "-" . $day2 . " 23:59:59";

$start_date = $year1 . "-" . $month1 . "-" . $day1 ;
$end_date = $year2 . "-" . $month2 . "-" . $day2 ;

echo "�}�l�d�ߤ���G $start_date <br> ";
echo "�I��d�ߤ���G $end_date <br> ";
echo "<br> ";

$sql = "select sum(billsec),count(billsec)  from outbound_cdr WHERE calldate >= '$start' AND calldate <= '$end'  AND src = '$name' ";
$result= mysql_query($sql);
$rows = mysql_fetch_array($result);
if ($rows[0] == "") {
	$rows[0] ='0';
	$rows[1] ='0';
}
echo "�b�ḹ�X�G $account <br> ";
echo "�������X�G $name <br> ";
echo "������ơG $rows[0] <br> ";
echo "�����q�ơG $rows[1] <br> ";
echo "<br> ";
?>

<HR>

<?php
$page_count=50;

$page_total=intval($rows[1]/$page_count);

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

echo "<td align='middle' width=30%>  ������� </td>";
echo "<td align='middle' width=15%>  �D�s���X </td>";
echo "<td align='middle' width=15%>  �Q�s���X </td>";
echo "<td align='middle' width=10%>  �����ɶ� </td>";
echo "<td align='middle' width=10%>  �q�ܮɶ� </td>";
echo "<br> ";

$result= mysql_query("SELECT calldate,src,dst,duration,billsec FROM outbound_cdr WHERE calldate >= '$start' AND calldate <= '$end'  AND  src='$name'   limit $move,$page_count ") ;
$i=0;
while ($rows=mysql_fetch_array($result)){
  	echo "<tr>";
	echo "<td align='middle' width=30%>  $rows[0]  </td>";
	echo "<td align='middle' width=15%>  $rows[1]  </td>";
    	echo "<td align='middle' width=15%>  $rows[2]  </td>";
    	echo "<td align='middle' width=10%>  $rows[3]  </td>";
    	echo "<td align='middle' width=10%>  $rows[4]  </td>";
  	echo "</tr>";
}

mysql_close($link);
?>



</table></body>
</html>
