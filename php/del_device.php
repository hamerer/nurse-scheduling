<?PHP
session_start();
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");
$sql=" SELECT name FROM device ";
$result = mysql_query($sql) ;
while ($row=mysql_fetch_array($result)){
	$device_sql="DELETE FROM device where name='$row[0]' ";
	$device_result = mysql_query($device_sql) ;

	$sip_sql="DELETE FROM sipfriends where name='$row[0]' ";
	$sip_result = mysql_query($sip_sql) ;
}
mysql_close($link);
header("Location: ./device.php");

?>
