<?php

session_start(); 

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("��Ʈw�}�ҿ��~�I");
mysql_select_db($dbName,$link) or die( "�L�k�����Ʈw�I");


$name=$_POST[name];
$password=$_POST[password];

$_SESSION[account]=$name;

if (empty($name) or empty($password)){
    echo   "<script>alert('�޲z�b���P�K�X���o���ťաA�Э��s��J�I');</script>";
    echo   "<script>history.back();</script>";
    exit;
}

$result= mysql_query("select name,password,level from manager where name='$name' ") or die(mysql_error());
$rows = mysql_fetch_array($result);
$number = mysql_num_rows($result);
if($number == 0){
echo "�S���o�Ӻ޲z�b���A�Э��s��J�I";
exit;
}

//$password_sha1 = sha1($_POST['password']);
$password_sha1 = sha1($password);


if ($rows[1] != $password_sha1){
echo "�K�X���~�A�Э��s��J�I";
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
