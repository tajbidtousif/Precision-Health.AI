<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id'])) {
    // Redirect to the login page or any other desired page
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0; 
            background-image: url('img/Precision.png');
            background-size: cover;
        }

        .splash-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('img/splash1.png');
            background-size: cover;
            z-index: 9999;
        }

        
        .hide-splash-screen {
            animation: hideSplashScreen 3s ease-in-out forwards;
        }

        @keyframes hideSplashScreen {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                visibility: hidden;
            }
        }

        /* Navbar Styles */
        .navbar {
            background-color: rgb(49, 48, 48);
            padding: 1rem;
        }

        .navbar .navbar-brand {
            color: #d46b25;
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link {
            color: rgb(243, 243, 243);
            font-size: 1.2rem;
            margin-right: 20px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: rgb(255, 255, 255);
            transform: scale(1.1);
        }

        

        /* Footer Styles */
        footer {
            color: #a5a3a3;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
            margin-top: 480px;
        }
       
        .fitness-text {
            font-size: 1.2rem;
            font-weight: bold;
            color: #d46b25;
            font-family: cursive; 
            text-transform: uppercase;
            display: inline-block;
            position: absolute;
            top: 60%;
            left: 260px; 
            transform: translateY(-50%);
            animation: fadeInOut 3s infinite;
        }

        .precision-text {
            font-size: 2.5rem;
            font-weight: bold;
            color: #d46b25;
            font-family: 'Montserrat', sans-serif; 
            text-transform: uppercase;
            display: inline-block;
            position: absolute;
            top: 65%;
            left: 120px; 
            transform: translateY(-50%);
            animation: slideIn 2s, fadeInOut 3s infinite;
        }

        @keyframes slideIn {
            0% {
                transform: translateX(-100px);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes fadeInOut {
            0%, 100% {
                opacity: 0.5;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.1);
            }
        }

        .fitness-mascot {
            width: 100px;
            height: 200px;
            background-color: #fdd835; 
            position: absolute;
            bottom: 0;
            top: 22%;
            left: 20%;
            transform: translateX(-50%); 
            animation: jump 2s infinite; 
        }

        .fitness-mascot-head {
            width: 50px;
            height: 50px;
            background-color: #25e9d8; 
            border-radius: 50%; 
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -50%); 
        }

        .fitness-mascot-arm {
            width: 60px;
            height: 10px;
            background-color: #fdd835; 
            position: absolute;
            top: 40px;
        }

        .left-arm {
            left: -20px;
            transform-origin: right; 
            animation: wave 2s infinite alternate; 
        }

        .right-arm {
            right: -20px;
            transform-origin: left; 
            animation: wave 2s infinite alternate-reverse; 
        }

        
        @keyframes jump {
            0%, 100% {
                transform: translateY(0); 
            }
            50% {
                transform: translateY(-40px);
            }
        }

        
        @keyframes wave {
             0%, 100% {
                transform: rotate(0deg);  
            }
            50% {
                transform: rotate(45deg); 
            }
        }
        

/* Typing Animation */
@keyframes typing {
  from {
    width: 0; 
  }
  to {
    width: 100%; 
  }
}


#typing-animation {
  animation: typing 3s steps(40);
  white-space: nowrap; 
  overflow: hidden; 
  font-size: 3.0rem; 
  position: relative; 
  left: 550px;
  color: #f1efef;
  font-family: 'Montserrat', sans-serif; 
  top: 10px; 
  font-weight: bold;
}

.center-button {
    display: flex;
    justify-content: center;
    margin-top: 300px; 
}

.center-button a {
    display: inline-block;
    padding: 5px 15px;
    font-size: 1.2rem; 
    font-weight: bold;
    background-color: #d46b25; 
    color: white;
    text-decoration: none;
    border-radius: 25px; 
    transition: background-color 0.3s;
}

.center-button a:hover {
    background-color: #ff8124; 
    transform: scale(1.1);
}



footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    color: aliceblue;
}

    </style>
</head>

<body>
    <!-- Splash Screen -->
    <div class="splash-screen hide-splash-screen"></div>

    <!-- Main Content -->
    <nav class="navbar navbar-expand-md navbar-light bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="landingpage.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="service.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link login-btn" href="#"><i class="fas fa-user-circle"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1>
            <span class="fitness-text">Welcome to</span><br>
            <span class="precision-text">Precision Health</span>
            <span id="typing-animation"></span> 
        </h1>
    </div>

    <div class="container mt-5">
        <div class="fitness-mascot">
            <div class="fitness-mascot-head"></div>
            <div class="fitness-mascot-arm left-arm"></div>
            <div class="fitness-mascot-arm right-arm"></div>
        </div>
    </div>

    <div class="center-button">
        <a href="index.php" class="btn btn-primary btn-lg">Get Started</a>
    </div>


    <footer class="footer">
        <p>&copy; 2023 Precision Health.Com All rights reserved.</p>
    </footer>
   
    <script>
        const typedText = "A ML Based Web Application"; 
    
        let i = 0;
        const typingSpeed = 150; 
    
        function typeWriter() {
            if (i < typedText.length) {
                document.getElementById("typing-animation").innerHTML += typedText.charAt(i);
                i++;
                setTimeout(typeWriter, typingSpeed);
            }
        }
    
        window.onload = function () {
            typeWriter();
        };
    </script>
   
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>


</body>

</html>