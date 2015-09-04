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
$name=$_POST['name'];
$car=$_POST['car'];
$mobile=$_POST['mobile'];

$sql = "INSERT INTO device (name,car,mobile) VALUES('$name','$car','$mobile') ";
if ($conn->query($sql) === TRUE) {
    header("Location: ./device.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>