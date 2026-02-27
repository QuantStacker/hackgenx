<?php
include('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Parimal Control Hub</title>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    background:#0b1120;
    font-family:'Poppins',sans-serif;
    color:white;
    overflow-x:hidden;
}

/* Animated Grid Background */
body::before{
    content:"";
    position:fixed;
    width:100%;
    height:100%;
    background:
        linear-gradient(rgba(0,255,255,0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,255,255,0.05) 1px, transparent 1px);
    background-size:40px 40px;
    z-index:-1;
}

/* Top Bar */
.top-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:20px 40px;
    background:rgba(0,255,255,0.05);
    border-bottom:1px solid rgba(0,255,255,0.3);
    backdrop-filter:blur(10px);
}

.top-bar h1{
    font-family:'Orbitron',sans-serif;
    color:#00f5ff;
    letter-spacing:2px;
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

/* Dashboard Section */
.dashboard{
    padding:30px 40px;
}

/* Table Container */
.table-container{
    background:rgba(0,255,255,0.05);
    padding:20px;
    border-radius:15px;
    border:1px solid rgba(0,255,255,0.3);
    overflow-x:auto;
}

table{
    width:100%;
    border-collapse:collapse;
}

th,td{
    padding:12px;
    text-align:center;
}

th{
    background:rgba(0,255,255,0.2);
    font-family:'Orbitron',sans-serif;
}

tr{
    transition:0.3s;
}

tbody tr:hover{
    background:rgba(0,255,255,0.15);
}

a{
    color:#00f5ff;
    text-decoration:none;
}

a:hover{
    text-shadow:0 0 10px #00f5ff;
}

/* Footer */
.footer{
    position:fixed;
    bottom:0;
    width:100%;
    padding:8px;
    text-align:center;
    background:rgba(0,0,0,0.6);
    font-size:13px;
    opacity:0.8;
}

</style>
</head>

<body>

<div class="top-bar">
    <h1>PARIMAL CONTROL HUB</h1>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="dashboard">

    <!-- Monitoring Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Sr No</th>
                    <th>Product ID</th>
                    <th>Location</th>
                    <th>Clean</th>
                    <th>Security</th>
                    <th>SOS Last Call</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT * FROM product_details";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $row['pro_id']; ?></td>
                    <td>
                        <a href="live-data.php?id=<?php echo $row['pro_id']; ?>">
                            <?php echo $row['pro_name']; ?>
                        </a>
                    </td>
                    <td><?php echo $row['location']; ?></td>
                    <td>Live Monitoring</td>
                    <td>Active</td>
                    <td>
                        <strong>ID:</strong> <span id="event-id">NA</span><br>
                        <strong>Time:</strong> <span id="event-timestamp">NA</span>
                    </td>
                </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>No Results</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

</div>

<div class="footer">
🚀 Parimal – Smart Washroom Monitoring System | 2024-25
</div>

<script>
function fetchLiveData() {
    $.ajax({
        url: 'fetch_last_event.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            if (!data.error) {
                $('#event-id').text(data.id);
                $('#event-timestamp').text(data.timestamp);
            }
        }
    });
}

setInterval(fetchLiveData, 5000);
fetchLiveData();
</script>

</body>
</html>
