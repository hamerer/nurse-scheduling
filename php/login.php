<?php

session_start(); 

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("資料庫開啟錯誤！");
mysql_select_db($dbName,$link) or die( "無法選取資料庫！");


$name=$_POST[name];
$password=$_POST[password];

$_SESSION[account]=$name;

if (empty($name) or empty($password)){
    echo   "<script>alert('管理帳號與密碼不得為空白，請重新輸入！');</script>";
    echo   "<script>history.back();</script>";
    exit;
}

$result= mysql_query("select name,password,level from manager where name='$name' ") or die(mysql_error());
$rows = mysql_fetch_array($result);
$number = mysql_num_rows($result);
if($number == 0){
echo "沒有這個管理帳號，請重新輸入！";
exit;
}

//$password_sha1 = sha1($_POST['password']);
$password_sha1 = sha1($password);


if ($rows[1] != $password_sha1){
echo "密碼錯誤，請重新輸入！";
exit;
}

setcookie("user",$name, time()+3600);

mysql_close($link);
if ($name=="nurse") {
	header("Location: ./nurse.php");
} else {
	header("Location: ./main.php");
}

exit;
?>
