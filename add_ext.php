<html>
<head><title>設定分機</title></head>
<body>
<form name="form" method="post" action="ext_do.php"><tr><table border=1 width="100%">  

<tr>     
<td  width="10%"><Span class="style1">企業名稱</span></td>     
<td  width="25%">      

<?php

session_start();

$account = $_SESSION['account'];

include('db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("資料庫開啟錯誤！");
mysql_select_db($dbName,$link) or die( "無法選取資料庫");

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
    echo   "<script>alert('本帳號可用分機數已滿，如欲新增分機號碼，請洽雲端語音服務公司處理');</script>";
    echo   "<script>history.back();</script>";
//    header("Location: ./number.php");
    
     exit;
}

$result= mysql_query("select realname,account,phone from user where account='$account' ") or die(mysql_error());
$rows = mysql_fetch_array($result);
echo " $rows[0] " ;
?>

</td>
<td  width="10%"><Span class="style1">企業帳號</span></td> 
<td  width="15%">      

<?php
echo " $rows[1] ";  
?>

</td>

<td width="15%"><span class="style1">電話代表號</span></td>        
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
<input type="submit" name="Submit" value="新增">
<input type=reset value="取消">
</tr>
</form>
</body>
</html>
