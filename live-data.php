<?php
include('db_connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Parimal Live Sensor Intelligence Panel</title>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    background:rgba(0,255,255,0.08);
    padding:18px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    border-bottom:1px solid rgba(0,255,255,0.3);
}

.top-bar h1{
    font-family:'Orbitron',sans-serif;
    color:#00f5ff;
    letter-spacing:2px;
}

.logout-btn{
    background:#ff2e63;
    padding:8px 20px;
    border-radius:25px;
    text-decoration:none;
    color:white;
    transition:0.3s;
}

.logout-btn:hover{
    box-shadow:0 0 15px #ff2e63;
}

/* Dashboard */
.dashboard{
    margin:20px;
    padding:25px;
    background:rgba(0,255,255,0.05);
    border-radius:15px;
    border:1px solid rgba(0,255,255,0.3);
}

.dashboard h2{
    font-family:'Orbitron',sans-serif;
    color:#00f5ff;
}

hr{
    border:1px solid rgba(0,255,255,0.3);
}

/* Layout */
.main-grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:25px;
    margin:20px;
}

/* Chart Box */
.chart-box{
    background:rgba(0,255,255,0.05);
    padding:20px;
    border-radius:15px;
    border:1px solid rgba(0,255,255,0.3);
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
    background:rgba(0,255,255,0.05);
    border-radius:15px;
    overflow:hidden;
}

th, td{
    padding:10px;
    text-align:center;
}

th{
    background:rgba(0,255,255,0.2);
    font-family:'Orbitron',sans-serif;
}

tbody tr{
    transition:0.3s;
}

tbody tr:hover{
    background:rgba(0,255,255,0.15);
}

/* Info Panel */
.info-panel{
    background:rgba(0,255,255,0.05);
    padding:20px;
    border-radius:15px;
    border:1px solid rgba(0,255,255,0.3);
}

.info-panel h3{
    color:#00f5ff;
    margin-bottom:10px;
}

/* Alert Box */
.alert-box{
    margin-top:20px;
    padding:15px;
    border-radius:10px;
    background:rgba(255,0,0,0.1);
    border:1px solid rgba(255,0,0,0.5);
}

.live-data{
    color:#00f5ff;
    font-weight:bold;
}

/* Footer */
.footer{
    position:fixed;
    bottom:0;
    width:100%;
    padding:8px;
    text-align:center;
    background:rgba(0,0,0,0.5);
    font-size:13px;
}

@media(max-width:900px){
    .main-grid{
        grid-template-columns:1fr;
    }
}

</style>
</head>

<body>

<div class="top-bar">
    <h1>PARIMAL LIVE MONITOR</h1>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<?php
$id = isset($_GET['id']) ? $_GET['id'] : '';
if($id == 1){
?>

<div class="dashboard">
    <h2>Live Sensor Data >> Parimal 101</h2>
    <a href="admin-dashboard.php" style="color:#00f5ff;font-size:12px;">← Back to Dashboard</a>
    <hr>
</div>

<div class="main-grid">

<div class="chart-box">
<canvas id="sensorChart"></canvas>

<table>
<thead>
<tr>
<th>Timestamp</th>
<th>Temp (°C)</th>
<th>Humidity</th>
<th>Sound (dB)</th>
<th>Gas (PPM)</th>
</tr>
</thead>
<tbody id="sensorTableBody"></tbody>
</table>
</div>

<div class="info-panel">

<h3>Ammonia Threshold Guide</h3>
<ul>
<li>5–10 ppm → Mild</li>
<li>25 ppm → Moderate</li>
<li>50 ppm → Critical</li>
<li>100+ ppm → Dangerous</li>
</ul>

<h3 style="margin-top:15px;">Sound Level Guide</h3>
<ul>
<li>Normal: 60 dB</li>
<li>Shouting: 90 dB</li>
<li>Scream: 100–120 dB</li>
</ul>

<div class="alert-box">
<h3>Live Average Alerts</h3>
<p>Clean Alert: <span id="avgTemperature">Loading...</span></p>
<p>Security Alert: <span id="avgHumidity">Loading...</span></p>

<p>SOS Event ID: <span class="live-data" id="event-id">Loading...</span></p>
<p>Timestamp: <span class="live-data" id="event-timestamp">Loading...</span></p>
</div>

</div>

</div>

<?php
} else {
echo "<div class='dashboard'><h2>Product Data Not Available</h2></div>";
}
?>

<div class="footer">
🚀 Parimal – Smart Washroom Monitoring System | 2024-25
</div>

<script>

let sensorChart;

function fetchSensorData(){
    $.ajax({
        url:'fetch_data.php',
        method:'GET',
        dataType:'json',
        success:function(data){
            updateTable(data);
            updateChart(data);
        }
    });
}

function updateTable(data){
    let tableBody=document.getElementById("sensorTableBody");
    tableBody.innerHTML="";
    data.forEach(row=>{
        tableBody.innerHTML+=`
        <tr>
        <td>${row.timestamp}</td>
        <td>${row.temperature}</td>
        <td>${row.humidity}</td>
        <td>${row.sound_level}</td>
        <td>${row.gas_level}</td>
        </tr>`;
    });
}

function updateChart(data){
    let labels=data.map(row=>row.timestamp);
    let temp=data.map(row=>row.temperature);
    let hum=data.map(row=>row.humidity);
    let sound=data.map(row=>row.sound_level);
    let gas=data.map(row=>row.gas_level);

    let ctx=document.getElementById('sensorChart').getContext('2d');
    if(sensorChart instanceof Chart){ sensorChart.destroy(); }

    sensorChart=new Chart(ctx,{
        type:'line',
        data:{
            labels:labels,
            datasets:[
                {label:'Temperature',data:temp,borderColor:'#ff4d4d'},
                {label:'Humidity',data:hum,borderColor:'#00f5ff'},
                {label:'Sound',data:sound,borderColor:'#00ff88'},
                {label:'Gas',data:gas,borderColor:'#ff00ff'}
            ]
        },
        options:{
            responsive:true,
            plugins:{legend:{labels:{color:'white'}}},
            scales:{
                x:{ticks:{color:'white'}},
                y:{ticks:{color:'white'}}
            }
        }
    });
}

setInterval(fetchSensorData,5000);
fetchSensorData();

function fetchLiveAverages(){
    $.ajax({
        url:'fetch_avg.php',
        method:'GET',
        dataType:'json',
        success:function(data){
            if(!data.error){
                $("#avgTemperature").text(data.avg_temperature);
                $("#avgHumidity").text(data.avg_humidity);
            }
        }
    });
}

setInterval(fetchLiveAverages,5000);
fetchLiveAverages();

function fetchLiveData(){
    $.ajax({
        url:'fetch_last_event.php',
        method:'GET',
        dataType:'json',
        success:function(data){
            if(!data.error){
                $('#event-id').text(data.id);
                $('#event-timestamp').text(data.timestamp);
            }
        }
    });
}

setInterval(fetchLiveData,5000);
fetchLiveData();

</script>

</body>
</html>