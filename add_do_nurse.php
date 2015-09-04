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

$sql = "INSERT INTO nurse (name, nurse, password)
VALUES ('".$_POST['name']."', '".$_POST['nurse']."', '".$_POST['mypass']."')";

if ($conn->query($sql) === TRUE) {
    header("Location: ./add_nurse.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>