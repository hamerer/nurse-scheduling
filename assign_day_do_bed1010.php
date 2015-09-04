<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
header("Content-Type:text/html; charset=utf-8");
?>
<?php
$servername = "localhost";
$username = "root";
$password = "comproadmin";
$dbname = "asterisk";
date_default_timezone_set('Asia/Taipei');
$now  = date("Y-m-d",mktime(0, 0, 0, date("m")  , date("d")+$k, date("Y")));
$date=$_SESSION[date];
$date_like = $date . "%";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql="UPDATE bed SET day_nurse='".$_POST['nurse']."',night_nurse='".$_POST['nurse_night']."', mid_nurse='".$_POST['nurse_midnight']."', datetime='$now' WHERE bed='14' ";
if ($conn->query($sql) === TRUE) {
  header("Location: ./assign_day_bed_result1010.php");
  }
$conn->close();
