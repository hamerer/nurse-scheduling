<?PHP
session_start();
include('../db.inc');

$link=mysql_connect($dbhostname, $dbusername, $dbpassword) or die("Unable to connect to database");
mysql_select_db($dbName,$link) or die( "Unable to select database");

$sql="SELECT phone FROM bed ";
$result = mysql_query($sql) ;
while ($row=mysql_fetch_array($result)){
	$bed_sql = "DELETE FROM bed where phone='$row[0]' ";
	$bed_result = mysql_query($bed_sql) ;

	$sip_sql="DELETE FROM sipfriends where name='$row[0]' ";
	$sip_result = mysql_query($sip_sql) ;
}
mysql_close($link);
header("Location: ./bed.php");

?>
