<?php
session_start();
include("db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1B263B;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(255, 255, 255, 0.2);
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }
        button {
            background: #00A8E8;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background: #004E92;
        }
    </style>

    <?php
    if (isset($_POST['login'])) {
        $u = $_POST['username'];
        $p = $_POST['password'];
        $sql = "SELECT * FROM user WHERE username='$u' AND password='$p'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>window.location.href='admin-dashboard.php';</script>";
        } else {
            echo "<script>alert('Please enter valid username or password');</script>";
        }
    }
    ?>
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
