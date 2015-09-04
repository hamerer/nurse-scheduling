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

$sql = "DELETE FROM device WHERE name='".$_POST['name']."' ";

if ($conn->query($sql) === TRUE) {
    header("Location: ./device.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>