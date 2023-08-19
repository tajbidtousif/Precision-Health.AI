<!DOCTYPE html>
<html lang="en">
 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>About Us - Precision Health</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
           body {
            font-family: 'Arial', sans-serif;
            background-color: rgb(240, 240, 243);
        }

        .carousel-item img {
            max-height: 500px;
            object-fit: cover;
        }

        .navbar {
            padding: 1rem;
            background-color: #c9c5c5; 
        }

        .navbar .navbar-brand {
            color: #d46b25;
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.3s;
        }

        @keyframes rubberBand {
            0% { transform: scaleX(1); }
            30% { transform: scaleX(1.25); }
            40% { transform: scaleX(0.75); }
            50% { transform: scaleX(1.15); }
            65% { transform: scaleX(0.95); }
            75% { transform: scaleX(1.05); }
            100% { transform: scaleX(1); }
        }

       
        .navbar-brand {
            transition: transform 0.5s;
            
        }

        .navbar-brand:hover {
            animation: rubberBand 0.5s;
            
        }

        .navbar-nav .nav-link {
            color: rgb(19, 18, 18);
            font-size: 1.2rem;
            margin-right: 20px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: rgb(17, 16, 16);
            transform: scale(1.1);
        }

        footer {
            color: #141414;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
            margin-top: 30px;
        }

        .team-member {
            text-align: center;
        }

        .team-member-image {
            display: inline-block;
            border-radius: 50%;
            overflow: hidden;
            width: 180px; 
            height: 180px; 
            margin-bottom: 10px;
        }

        .team-member-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .team-member-info {
            text-align: center;
            
        }

        #aboutContent {
            max-height: 100px; 
            overflow: hidden;
            transition: max-height 0.3s ease; 
        }

       
        .show-more-btn {
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }

        .arrow-icon {
         font-size: 1.2rem;
         margin-left: 5px;
         cursor: pointer;
         transition: transform 0.3s;
      }

 
      #aboutContent.expanded ~ h1 .arrow-icon {
            transform: rotate(180deg);
            }

      #aboutContent.hidden {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
       }


        #aboutContent:not(.hidden) {
            max-height: 1000px; 
        }
   
        
    </style>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-light">
        <div class="container">
            <a class="navbar-brand fun-animation" href="landingpage.php">
                <i class="fa fa-male"></i> PrecisionHealth.Com
            </a>
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
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div id="aboutCarousel" class="carousel slide" data-bs-ride="carousel"  data-bs-interval="3000">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="img/about1.png" class="d-block w-100" alt="About Slide 1"  data-bs-interval="3000">
                </div>
                <div class="carousel-item">
                    <img src="img/about2.png" class="d-block w-100" alt="About Slide 2"  data-bs-interval="3000">
                </div>
                <div class="carousel-item">
                    <img src="img/about3.png" class="d-block w-100" alt="About Slide 3"  data-bs-interval="3000">
                </div>
                <div class="carousel-item">
                    <img src="img/about4.png" class="d-block w-100" alt="About Slide 3"  data-bs-interval="3000">
                </div>
            </div>
            <a class="carousel-control-prev" href="#aboutCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#aboutCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>

    <div class="container mt-5">
        
        <h1>
            About Us
            <span id="toggleArrow" class="fas fa-chevron-down arrow-icon"></span>
        </h1>
        <div id="aboutContent" class="hidden">
            <p>Welcome to PrecisionHealth.Com, your reliable and personalized health companion. We are a team of passionate and dedicated 4th-year students from Leading University, working together to bring you an innovative machine learning-based health prediction platform.</p>
        
        <p>At PrecisionHealth.Com, our mission is to empower individuals in making informed and proactive decisions about their health and well-being. We understand that each person's health journey is unique, and we are committed to providing personalized insights and recommendations tailored to your specific needs.</p>
        
        <p>Our cutting-edge machine learning algorithms analyze vital health metrics, including BMI (Body Mass Index), to deliver accurate health predictions and personalized action plans. With the power of artificial intelligence, we aim to revolutionize the way individuals approach their health and adopt a healthier lifestyle.</p>
        
        <p><strong>Why Choose PrecisionHealth.Com:</strong></p>
        <ol>
            <li><strong>Precision Predictions:</strong> Our advanced machine learning models analyze your health data to predict potential health risks and provide actionable recommendations to enhance your well-being.</li>
            <li><strong>Personalized Action Plans:</strong> We believe in the power of personalization. Based on your health analysis, we offer personalized action plans that suit your lifestyle and health goals.</li>
            <li><strong>Comprehensive Health Insights:</strong> Our platform provides a comprehensive overview of your health, helping you track progress and make data-driven decisions for better health outcomes.</li>
            <li><strong>User-Friendly Interface:</strong> Our user-friendly interface ensures a seamless experience, making health management accessible to everyone.</li>
            <li><strong>Privacy and Security:</strong> Your privacy and data security are our utmost priority. We adhere to strict data protection protocols to safeguard your sensitive information.</li>
        </ol>
        
        <p>Join us on this journey towards a healthier future. Let <a href="landingpage.html">precisionhealth.com</a> be your trusted health companion and guide you in unlocking your full potential for a healthier and happier life.</p>
        
        </div>
    </div>

    <div class="container mt-5">
    <h2>Our Team</h2>
    <div class="row justify-content-center">

        <!-- Supervisor Info -->
        <div class="col-md-4 mb-4">
            <div class="team-member">
                <div class="team-member-image">
                    <img src="img/sir.jpg" alt="Supervisor">
                </div>
                <div class="team-member-info">
                    <h5><strong>Dr.Shafkat Kibria</strong></h5>
                    <p>Our Team Supervisor</p>
                    <p>Assistant Professor & Head</p>
                    <p>Computer Science & Engineering</p>
                    <a href="#" target="_blank">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Supervisor Info -->

    <!-- Other Team Members -->
    <div class="row justify-content-center">

        <!-- Team Member 1 -->
        <div class="col-md-4 mb-4">
            <div class="team-member">
                <div class="team-member-image">
                    <img src="img/takrim.PNG" alt="Team Member 1">
                </div>
                <div class="team-member-info">
                    <h5><strong>Takrim Eahi Chowdhury</strong></h5>
                    <p>ML Enthusiast</p>
                    <a href="https://www.linkedin.com/in/takrim-eahi-chowdhury/" target="_blank">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Team Member 2 -->
        <div class="col-md-4 mb-4">
            <div class="team-member">
                <div class="team-member-image">
                    <img src="img/tousif.PNG" alt="Team Member 2">
                </div>
                <div class="team-member-info">
                    <h5><strong>Shah Tajbid Tousif</strong></h5>
                    <p>Web Developer</p>
                    <a href="https://www.linkedin.com/in/tajbidtousif/" target="_blank">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Team Member 3 -->
        <div class="col-md-4 mb-4">
            <div class="team-member">
                <div class="team-member-image">
                    <img src="img/tithi.PNG" alt="Team Member 3">
                </div>
                <div class="team-member-info">
                    <h5><strong>Suchona Ghosh Tithi</strong> <s</h5>
                    <p>UI/UX Designer</p>
                    <a href="https://www.linkedin.com/in/suchona-ghosh-tithi-2277a8210/" target="_blank">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Other Team Members -->
</div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2023 PrecisionHealth.Com. All rights reserved.</p>
            <p>Leading University, Sylhet, Bangladesh</p>
        </div>
    </footer>

    <script>
        var aboutContent = document.getElementById("aboutContent");
        var toggleArrow = document.getElementById("toggleArrow");
    
        
        toggleArrow.addEventListener("click", function () {
            aboutContent.classList.toggle("hidden"); 
        });
    </script>

    
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
