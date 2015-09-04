<html>
<meta http-equiv="Content-Type" content="text/html; charset=big5" />
<head>
<title></title>
</head>
<body>

<?php
session_start();
$date=$_POST[date];
$_SESSION[date]=$date;
//$date=$_SESSION[date];
//$date_like = $date . "%";

header("Location: ./manual.php");
?>
