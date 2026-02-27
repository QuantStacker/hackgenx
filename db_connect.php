<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "esp_data";
$port = 3307;   // ADD THIS

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname, $port);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully!";
?>