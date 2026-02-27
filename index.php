<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>परिमळ - Smart Washroom Monitoring</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            color: white;
            background: radial-gradient(circle, #0D1B2A, #1B263B);
            text-align: center;
        }

        /* Navbar */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px 65px;
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(11px);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
            padding: 0;
            position: relative;
        }

        .nav-links li {
            display: inline;
            position: relative;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-size: 16px;
            transition: color 0.3s;
            padding: 10px;
        }

        .nav-links a:hover {
            color: #00A8E8;
        }

        /* Dropdown Menu */
        .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: rgba(0, 0, 0, 0.8);
            list-style: none;
            padding: 10px;
            text-align: left;
            width: 150px;
            border-radius: 5px;
        }

        .dropdown li {
            padding: 5px 10px;
        }

        .dropdown a {
            color: white;
            display: block;
        }

        .dropdown a:hover {
            color: #00A8E8;
        }

        .nav-links li:hover .dropdown {
            display: block;
        }

        /* Hero Section */
        .hero {
            padding: 150px 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-image: url('dark.webp');
            background-size: cover, contain;
            background-position: center, bottom;
            background-repeat: no-repeat, no-repeat;
        }

        .hero h1 {
            font-size: 42px;
            font-weight: bold;
        }

        .hero p {
            font-size: 18px;
            opacity: 0.8;
        }

        .cta-buttons {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
        }

        /* Buttons */
        .btn, .generate-btn, .video-btn {
            padding: 12px 20px;
            border: none;
            font-size: 16px;
            font-weight: bold;
            color: white;
            background: linear-gradient(90deg, #004E92, #00A8E8);
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0px 4px 15px rgba(0, 168, 232, 0.5);
        }

        .btn:hover, .generate-btn:hover, .video-btn:hover {
            transform: scale(1.05);
        }

        .video-btn {
            border: 1px solid white;
            background: transparent;
        }

        .video-btn:hover {
            background: white;
            color: black;
        }

        /* Mobile Navbar */
        .menu-toggle {
            display: none;
            font-size: 24px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }

            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                width: 100%;
                background: rgba(0, 0, 0, 0.8);
                text-align: center;
            }

            .nav-links.show {
                display: flex;
            }
            /* Card Section */
        .info-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #4A4A4A;
            border-radius: 15px;
            width: 80%;
            max-width: 1000px;
            margin: 40px auto;
            padding: 40px;
            height: 600px;
            box-shadow: 0px 4px 15px rgba(255, 255, 255, 0.2);
            background: rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(11px);
        }

        .info-column {
            flex: 1;
            padding: 20px;
            text-align: left;
        }
        .info-columns {
            flex: 1;
            padding: 20px;
            text-align: Right;
        }

        .info-column h2 {
            font-size: 28px;
            color: #00A8E8;
        }

        .info-column p {
            font-size: 18px;
            opacity: 0.9;
            margin-top: 10px;
        }

             

        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="logo">परिमळ</div>
            <div class="menu-toggle">☰</div>
            <ul class="nav-links">
                <li><a href="#">Overview</a></li>
                <li><a href="#">Features</a></li>
               <li class="has-dropdown">
                    <a href="#">Dashboard</a>
               <ul class="dropdown">
        <li><a href="login.html">Login User</a></li>
    
        <li><a href="project_details/server_data.php">Server Data</a></li>
        <li><a href="project_details/product_details.php">Product Details</a></li>

        </ul>
        </li>

                <li><a href="#">contact</a></li>
            </ul>
        </nav>
    </header>

    <section class="hero">
        <h1>Intelligent Washroom System</h1>
        <p>Real-time cleanliness tracking for public washrooms.</p>
        <div class="cta-buttons">
            <a href="login.html">
            <a href="login.php" class="video-btn" style="text-decoration: none;">Login</a>
            </a>
            <button class="generate-btn">Check Status →</button>
          
        </div>
    </section>
    <!-- New Card Section -->
    <section class="info-card">
        
        <div class="info-columns">
            <h2>Contact</h2>
            <p>Email: support@parimal.com</p>
            <p>Phone: +91 98765 43210</p>
            <p>Address: 123, Smart City, India</p>
        </div>
    </section>
    

    <script>
        document.querySelector('.generate-btn').addEventListener('click', () => {
            alert('Checking washroom status... (Feature in progress)');
        });
        document.querySelector('.menu-toggle').addEventListener('click', () => {
            document.querySelector('.nav-links').classList.toggle('show');
        });

        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                document.querySelector('.nav-links').classList.remove('show');
            });
        });

        
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', event => {
                event.preventDefault();
                const target = document.querySelector(link.getAttribute('href'));
                target.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
</body>
</html>
