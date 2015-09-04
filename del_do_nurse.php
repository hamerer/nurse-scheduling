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

$sql = "DELETE FROM nurse WHERE name='".$_POST['name']."' ";

if ($conn->query($sql) === TRUE) {
    header("Location: ./del_nurse.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>