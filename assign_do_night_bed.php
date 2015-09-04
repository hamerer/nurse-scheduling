<?php
header("Content-Type:text/html; charset=utf-8");
?>
<?php
$servername = "localhost";
$username = "root";
$password = "comproadmin";
$dbname = "asterisk";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql="UPDATE bed SET night_nurse='".$_POST['nurse_night']."' WHERE bed='0A' ";
if ($conn->query($sql) === TRUE) {
  header("Location: ./assign_day__bed_result.php");
  }
$conn->close();

