<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<?php
include('db.inc');

GLOBAL $dbName, $link;

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

$start = $year1 . "-" . $month1 . "-" . $day1;
$end = $year2 . "-" . $month2 . "-" . $day2;

if($_SESSION['username'] != null)
{
	$account = $_SESSION['account'];
}

$sql= "select * from user where account='$account' ";
$result= mysql_query($sql,$link) or die(mysql_error());
$number = mysql_num_rows($result);
if($number == 0){
    echo   "<script>alert('�S���o�ӱb���A�Э��s��J�I');</script>";
    echo   "<script>history.back();</script>";
    exit;
}

$sql= "select account,name from user where account='$account' ";
$result= mysql_query($sql,$link) or die(mysql_error());
$number = mysql_num_rows($result);
if($number == 0){
    echo   "<script>alert('�S���o�ӱb���A�Э��s��J�I');</script>";
    echo   "<script>history.back();</script>";
    exit;
}
$rows = mysql_fetch_array($result);
$number=$row[1];

$sql_sip= "select  cid_number from sipfriends where name='$number' ";
$result_sip= mysql_query($sql_sip);
$rows_sip = mysql_fetch_array($result_sip);

$sql = "select  balance_available,balance_used from user where account='$account' ";
//$result= mysql_query($sql,$link) or die(mysql_error());
$result= mysql_query($sql);
$rows = mysql_fetch_array($result);
echo "�b���G $account <br> ";
//echo "²�X�G $rows_sip[0] <br>";
echo "�w�g�ϥΪ��B�G $rows[1] <br>";
echo "�i�H�ϥΪ��B�G $rows[0] ";


$sql = "SELECT calldate,answer,callend,src,dst,dst_six,billsec,charge,balance_available FROM outbound_cdr where account='$account' AND calldate >= '$start' AND calldate <= '$end' ";
$conn= mysql_query($sql) or die(mysql_error());
$number = mysql_num_rows($conn);

mysql_close($link);
?>

<html>
<head>
<title></title>
</head>
<body>
<HR>
<table border=1 width=100%>
<?
echo "<tr>";
echo "<td>" . "�����ɶ�" . "</td>";
echo "<td>" . "���q�ɶ�" . "</td>";
echo "<td>" . "���ܮɶ�" . "</td>";
echo "<td>" . "�D�s���X" . "</td>";
echo "<td>" . "�Q�s���X" . "</td>";
echo "<td>" . "�Q�s²�X" . "</td>";
echo "<td>" . "�q�ܬ��" . "</td>";
echo "<td>" . "�p�O���B" . "</td>";
echo "<td>" . "�i�ξl�B" . "</td>";
echo "</tr>";

while ($datalist=mysql_fetch_array($conn)){
  echo "<tr>";
/* 
 for ($x=0;$x<$number;$x++){
    echo "<td>" . $datalist[$x] . "</td>";
  }
*/
    echo "<td>" . $datalist[0] . "</td>";
    echo "<td>" . $datalist[1] . "</td>";
    echo "<td>" . $datalist[2] . "</td>";
    echo "<td>" . $datalist[3] . "</td>";
    echo "<td>" . $datalist[4] . "</td>";
    echo "<td>" . $datalist[5] . "</td>";
    echo "<td>" . $datalist[6] . "</td>";
    echo "<td>" . $datalist[7] . "</td>";
    echo "<td>" . $datalist[8] . "</td>";
  echo "</tr>";
}

?>

<table></body>
</html>
