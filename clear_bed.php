<?PHP
session_start();
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

$sql="UPDATE bed set device='0' , enable='0' ";
$result = mysql_query($sql) ;
$sql="UPDATE device  set enable='0' ";
$result = mysql_query($sql) ;

mysql_close($link);
header("Location: ./bed_status.php");

?>
