<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<script type="text/javascript">
window.opener = null; 
myref=window.open("./nurse.php", "Nurse-Call", config="height=500,width=500");
window.close();
</script>

<title>�@�h�I�s�u������</title>
</head>
<body>


<?php
session_start();
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");



mysql_close($link);
?>

</body>
</html>

