<?php
$servername = "localhost";
$username = "app";
$password = "app@123";
$db = "app";
$port=3306;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $db, $port);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";

?>
