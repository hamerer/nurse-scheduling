<html>
<head><title>�]�w����</title></head>
<body>
<form name="form" method="post" action="ext_do.php"><tr><table border=1 width="100%">  

<tr>     
<td  width="10%"><Span class="style1">���~�W��</span></td>     
<td  width="25%">      

<?php

session_start();

$account = $_SESSION['account'];

include('db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("��Ʈw�}�ҿ��~�I");
mysql_select_db($dbName,$link) or die( "�L�k�����Ʈw");

//Check can add extensions or NOT"
$sql = "SELECT exten from user WHERE account='$account' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$user_exten = $row[0];

$sql = "SELECT count(name) from sipfriends WHERE account='$account' ";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$sip_exten = $row[0];
if ($sip_exten >= $user_exten) {
    echo   "<script>alert('���b���i�Τ����Ƥw���A�p���s�W�������X�A�Ь����ݻy���A�Ȥ��q�B�z');</script>";
    echo   "<script>history.back();</script>";
//    header("Location: ./number.php");
    
     exit;
}

$result= mysql_query("select realname,account,phone from user where account='$account' ") or die(mysql_error());
$rows = mysql_fetch_array($result);
echo " $rows[0] " ;
?>

</td>
<td  width="10%"><Span class="style1">���~�b��</span></td> 
<td  width="15%">      

<?php
echo " $rows[1] ";  
?>

</td>

<td width="15%"><span class="style1">�q�ܥN��</span></td>        
<td width="25%">         

<?php
echo " $rows[2] ";  
?>

</td>
</tr>  

</table>


<table border=1 width="100%">  

<?php

$result= mysql_query("select exten from user where account='$account' ") or die(mysql_error());
$rows = mysql_fetch_array($result);
$k=$rows[0];
include('ext_no.php');

?>

</table>

<tr>
<input type="submit" name="Submit" value="�s�W">
<input type=reset value="����">
</tr>
</form>
</body>
</html>
