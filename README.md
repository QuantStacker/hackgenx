# 🚻 Smart IoT Washroom Monitoring System

An IoT-based intelligent washroom monitoring system that detects odor levels, temperature, and environmental conditions in real-time using ESP32 and gas sensors. The system automatically updates sensor data to a PHP-MySQL backend and displays live monitoring results on a web dashboard.

---

## 📌 Problem Statement

Public and institutional washrooms often suffer from:
- Poor hygiene monitoring
- Manual inspection dependency
- Delayed cleaning response
- Unpleasant odor accumulation

There is no real-time system to monitor cleanliness levels.

---

## 💡 Solution

This project provides a **low-cost, scalable IoT solution** that:

- Detects harmful gases (like ammonia)
- Monitors temperature & humidity
- Sends live data to server via WiFi
- Stores data in MySQL database
- Displays live dashboard updates
- Triggers alerts when thresholds exceed

---

## 🏗️ System Architecture

ESP32 + Sensors  
⬇  
WiFi  
⬇  
PHP API (insert.php)  
⬇  
MySQL Database  
⬇  
Web Dashboard  

---

## 🔧 Hardware Components

- ESP32
- MQ135 Gas Sensor
- DHT11 Temperature & Humidity Sensor
- Relay Module
- Exhaust Fan
- LCD Display (Optional)
- Power Supply

---

## 💻 Software Stack

- PHP
- MySQL
- HTML
- CSS
- JavaScript
- XAMPP (Local Development)
- Arduino IDE (for ESP32 programming)

---

## 📂 Project Structure

```bash
Smart-Washroom-System/
│
├── index.php              # Landing page
├── dashboard.php          # Live monitoring dashboard
├── insert.php             # API endpoint for ESP32
├── db_connect.php         # Database connection
├── database.sql           # Database file
│
├── css/
│   └── styles.css
│
├── js/
│   └── script.js
│
└── assets/
    └── images
```

---

## 🗄️ Database Setup (Localhost)

1. Install XAMPP
2. Start Apache & MySQL
3. Open:
   ```
   http://localhost/phpmyadmin
   ```
4. Create new database (example: `washroom_db`)
5. Import `database.sql`
6. Update `db_connect.php`:

```php
$conn = new mysqli("localhost", "root", "", "washroom_db");
```

---

## 🚀 Running the Project Locally

1. Place project folder inside:
   ```
   C:\xampp\htdocs\
   ```
2. Start Apache & MySQL
3. Open browser:
   ```
   http://localhost/Smart-Washroom-System/
   ```

---

## 📡 ESP32 API Integration

Inside ESP32 code:

```cpp
http.begin("http://localhost/Smart-Washroom-System/insert.php");
```

If hosted online:

```cpp
http.begin("https://yourdomain.com/insert.php");
```

ESP32 sends:
- Gas sensor value
- Temperature
- Humidity

Data is stored in MySQL database automatically.

---

## 📊 Features

✅ Real-time odor detection  
✅ Temperature & humidity monitoring  
✅ Automatic fan control via relay  
✅ Live web dashboard  
✅ Database logging  
✅ Threshold-based alerts  
✅ Low-cost and scalable  
✅ Suitable for colleges, malls, public toilets  

---

## 🔔 Working Principle

1. Gas sensor detects ammonia level.
2. DHT11 measures temperature & humidity.
3. ESP32 reads sensor values.
4. If gas level exceeds threshold:
   - Relay activates exhaust fan.
5. Data is sent via WiFi to PHP API.
6. PHP stores data in MySQL.
7. Dashboard displays live data.

---

## 📈 Future Enhancements

- SMS / WhatsApp alert system
- Cloud hosting deployment
- AI-based predictive cleaning alerts
- Mobile app integration
- Multi-washroom centralized dashboard
- Data analytics & reports

---

## 🎯 Advantages

- Reduces manual inspection
- Improves hygiene standards
- Real-time monitoring
- Cost-effective solution
- Easy deployment
- Scalable infrastructure

---

## 🔒 Security Notes

- Do not upload database passwords publicly.
- Use environment variables for production deployment.
- Validate API inputs for security.

---

## 🏫 Use Case

This system is ideal for:

- Colleges
- Railway stations
- Airports
- Shopping malls
- Hospitals
- Corporate offices
