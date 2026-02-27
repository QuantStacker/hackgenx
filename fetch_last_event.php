<?php
// Database connection
$servername = "localhost:3307";
$username = "root"; // Change if needed
$password = "";
$dbname = "esp_data";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die(json_encode(["error" => "Database connection failed"]));
}

// SQL query to get the last inserted row
$sql = "SELECT * FROM button_events ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

// Fetch and return JSON response
if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode([
        "id" => $row['id'],
        "timestamp" => $row['timestamp']
    ]);
} else {
    echo json_encode(["error" => "No data found"]);
}

// Close connection
mysqli_close($conn);
?>