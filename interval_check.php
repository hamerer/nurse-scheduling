<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<html>
<head>
<title>區間日期時間確認</title>
</head>

<body>
<table border=1 width=100%>

<?

$account=$_SESSION[account];

$year1=$_POST[year1];
$month1=$_POST[month1];
$day1=$_POST[day1];
$year2=$_POST[year2];
$month2=$_POST[month2];
$day2=$_POST[day2];



$_SESSION[year1]=$year1;
$_SESSION[month1]=$month1;
$_SESSION[day1]=$day1;
$_SESSION[year2]=$year2;
$_SESSION[month2]=$month2;
$_SESSION[day2]=$day2;

header("Location: ./interval_cdr.php");

?>



</table></body>
</html>
