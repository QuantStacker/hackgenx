<?php
$servername = "localhost"; // WAMP default
$username = "root";        // WAMP default
$password = "";            // leave blank for WAMP
$database = "esp_data";    // your database name

// Initialize MySQLi and set charset BEFORE connecting
$conn = mysqli_init();
mysqli_options($conn, MYSQLI_INIT_COMMAND, "SET NAMES 'utf8'");

if (!$conn->real_connect($servername, $username, $password, $database)) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if data is received via HTTP POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST); // for debugging

    $temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $sound_level = $_POST['sound_level'];
    $gas_level = $_POST['gas_level'];

    // Insert data into the sensor_data table
    $sql = "INSERT INTO sensor_data (temperature, humidity, sound_level, gas_level)
            VALUES ('$temperature', '$humidity', '$sound_level', '$gas_level')";

    if ($conn->query($sql) === TRUE) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
