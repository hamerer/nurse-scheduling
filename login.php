<?php

session_start(); 

include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("��Ʈw�}�ҿ��~�I");
mysql_select_db($dbName,$link) or die( "�L�k�����Ʈw�I");


$name=$_POST[name];
$password=$_POST[password];

$_SESSION[account]=$name;

$file = file('/proc/cpuinfo');
$proc_details = $file[4];
$info1 = explode(")", $proc_details);
$cpu = explode("(", $info1[1]);
$core=$cpu[0];
$info2 = explode("@", $info1[2]);
$info3 = explode("U ", $info2[0]);
$type=$info3[1];
$frequency=$info2[1];
$core=trim($core);
$type=trim($type);
$frequency=trim($frequency);
system("/sbin/ifconfig eth0  > /tmp/mac ");
$file = file('/tmp/mac');
$proc_details = $file[0];
$info = explode(" ", $proc_details);
$mac=$info[10];
//echo $core;
//echo "<br>";
//echo $type;
//echo "<br>";
//echo $frequency;
//echo "<br>";
//echo $mac;


/*
$pc_result= mysql_query("SELECT core,type,frequency FROM pc ") or die(mysql_error());
$pc_rows = mysql_fetch_array($pc_result);

//echo "<br>";
//echo "<br>";
//echo sha1($core);
//echo "<br>";
//echo $pc_rows[0];
//echo "<br>";
//echo "<br>";
//echo sha1($type);
//echo "<br>";
//echo $pc_rows[1];
//echo "<br>";
//echo "<br>";
//echo sha1($frequency);
//echo "<br>";
//echo $pc_rows[2];

if ((sha1($core) != $pc_rows[0]) or (sha1($type) != $pc_rows[1]) or (sha1($frequency) != $pc_rows[2])) {
	exit;
}
*/

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
