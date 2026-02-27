<?php
include("db_connect.php");
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Parimal Command Center</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#0a0f1c;
    font-family:'Poppins',sans-serif;
    color:white;
    overflow-x:hidden;
}

/* Animated Background Grid */
body::before{
    content:"";
    position:fixed;
    width:100%;
    height:100%;
    background:linear-gradient(rgba(0,255,255,0.05) 1px, transparent 1px),
               linear-gradient(90deg, rgba(0,255,255,0.05) 1px, transparent 1px);
    background-size:40px 40px;
    z-index:-1;
}

/* Header */
.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 40px;
    background:rgba(0,255,255,0.05);
    backdrop-filter:blur(10px);
    border-bottom:1px solid rgba(0,255,255,0.2);
}

.top-bar h2{
    font-family:'Orbitron',sans-serif;
    letter-spacing:2px;
    color:#00f5ff;
}

.logout-btn{
    background:#ff2e63;
    padding:8px 20px;
    border-radius:30px;
    text-decoration:none;
    color:white;
    transition:0.3s;
}

.logout-btn:hover{
    box-shadow:0 0 15px #ff2e63;
}

/* Dashboard Title */
.title{
    text-align:center;
    margin:30px 0;
    font-size:28px;
    font-family:'Orbitron',sans-serif;
    color:#00f5ff;
    letter-spacing:3px;
}

/* Card Container */
.card-container{
    width:95%;
    max-width:1200px;
    margin:auto;
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:25px;
}

/* Product Card */
.card{
    background:rgba(0,255,255,0.05);
    border:1px solid rgba(0,255,255,0.3);
    border-radius:15px;
    padding:20px;
    transition:0.3s;
    position:relative;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 0 25px #00f5ff;
}

.card h3{
    font-family:'Orbitron',sans-serif;
    margin-bottom:10px;
    color:#00f5ff;
}

.card p{
    font-size:14px;
    opacity:0.8;
    margin-bottom:10px;
}

.card a{
    display:inline-block;
    margin-top:10px;
    padding:6px 15px;
    background:#00f5ff;
    color:black;
    border-radius:20px;
    text-decoration:none;
    font-weight:500;
    transition:0.3s;
}

.card a:hover{
    background:white;
}

/* Status Indicator */
.status{
    position:absolute;
    top:15px;
    right:15px;
    width:12px;
    height:12px;
    background:#00ff88;
    border-radius:50%;
    box-shadow:0 0 10px #00ff88;
    animation:blink 1.5s infinite alternate;
}

@keyframes blink{
    from{opacity:0.4;}
    to{opacity:1;}
}

/* Footer */
.footer{
    text-align:center;
    margin:40px 0 20px;
    opacity:0.6;
    font-size:14px;
}

</style>
</head>

<body>

<div class="top-bar">
    <h2>PARIMAL COMMAND CENTER</h2>
    <div>
        Welcome, <?php echo $_SESSION['username']; ?> |
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</div>

<div class="title">
    🌿 Smart IoT Monitoring Units
</div>

<div class="card-container">

<?php
$sql = "SELECT * FROM product";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "
        <div class='card'>
            <div class='status'></div>
            <h3>Unit ID: " . $row['id'] . "</h3>
            <p><strong>Product:</strong> " . $row['name'] . "</p>
            <p>" . $row['description'] . "</p>
            <a href='sensor-data.php?id=" . $row['id'] . "'>Open Monitoring</a>
        </div>
        ";
    }
} else {
    echo "<p style='text-align:center;'>No Monitoring Units Found</p>";
}
?>

</div>

<div class="footer">
🚀 Parimal – Smart Washroom Monitoring System | HackGenX 2026
</div>

</body>
</html>