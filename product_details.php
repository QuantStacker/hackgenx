<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parimal_db"; // Change if needed

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products"; // Change table name if needed
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background: #28a745;
            color: white;
        }
    </style>
</head>
<body>

<h2>Product Details</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Price</th>
        <th>Stock</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['stock']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No data available</td></tr>";
    }
    $conn->close();
    ?>
</table>

</body>
</html>
