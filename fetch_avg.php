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

// SQL query to get the average of the last 10 rows
$sql = "SELECT 
            AVG(temperature) AS avg_temperature, 
            AVG(humidity) AS avg_humidity, 
            AVG(sound_level) AS avg_sound_level, 
            AVG(gas_level) AS avg_gas_level
        FROM (
            SELECT temperature, humidity, sound_level, gas_level
            FROM sensor_data
            ORDER BY id DESC
            LIMIT 10
        ) AS last_10_rows";

$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    $avg_temperature = number_format($row['avg_temperature'], 2);
    $avg_humidity = number_format($row['avg_humidity'], 2);
    $avg_sound_level = number_format($row['avg_sound_level'], 2);
    $avg_gas_level = number_format($row['avg_gas_level'], 2);
    
    // Determine gas level alerts
    $gas_alert = "";
    if ($avg_gas_level >= 100) {
        $gas_alert = "🔥 Dangerous: Can cause irritation; requires emergency action!";
    } elseif ($avg_gas_level >= 50) {
        $gas_alert = "⚠️ Critical Alert: Unhealthy air, immediate cleaning required.";
    } elseif ($avg_gas_level >= 25) {
        $gas_alert = "⚠️ Moderate Alert: Unhygienic conditions, needs cleaning soon.";
    } elseif ($avg_gas_level >= 5) {
        $gas_alert = "🔵 Mild Alert: Poor ventilation, needs monitoring.";
    } else {
        $gas_alert = "✅ Gas level is normal.";
    }

    // Determine sound level alerts
    $sound_alert = "";
    if ($avg_sound_level >= 100 && $avg_sound_level <= 120) {
        $sound_alert = "🚨 Alert! Someone may be shouting for help!";
    } else {
        $sound_alert = "✅ Sound level is within a safe range.";
    }

    // Return JSON response
    echo json_encode([
        "avg_temperature" => $gas_alert,
        "avg_humidity" => $sound_alert
    ]);
} else {
    echo json_encode(["error" => mysqli_error($conn)]);
}

// Close connection
mysqli_close($conn);
?>
