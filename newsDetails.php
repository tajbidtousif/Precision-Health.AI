<?php
// session_start(); 
// $isLoggedIn = false;

// if (isset($_SESSION['id'])) {
//     $isLoggedIn = true;
// }

// // Redirect to index.php if not logged in
// if (!$isLoggedIn) {
//     header("Location: index.php");
//     exit();
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health News Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            position: relative;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            animation: changeBackground 35s linear infinite;
        }

        @keyframes changeBackground {
            0% {
                background-image: url('img/1.png');
            }

            33% {
                background-image: url('img/2.png');
            }

            66% {
                background-image: url('img/3.png');
            }

            100% {
                background-image: url('img/4.png');
            }
        }

        .news-details {
            padding: 40px;
        }

        .news-details h2 {
            margin-bottom: 30px;
            font-family: 'Montserrat', sans-serif;
            text-align: center;
            font-size: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #9c723b;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .news-content {
            background-color: #141414;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-bottom: 30px;
        }

        .news-content h3 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #e9e4e4;
        }

        .news-content p {
            font-size: 1.2rem;
            color: #666;
        }

        .btn-primary {
            background: linear-gradient(135deg, #d8d065, #d47070);
            border: none;
            color: #fff;
            font-size: 1.1rem;
            border-radius: 30px;
            padding: 10px 25px;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-primary:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .btn-primary:focus {
            outline: none;
        }

        footer {
            color: #fff;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
            margin-top: 30px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand fun-animation" href="landingpage.php">
                <i class="fa fa-male"></i> precisionHealth.com
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
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="button" onclick="redirectToIndex()">Login</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container news-details">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="news-content">
                    <h3>Title of the News Article</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla suscipit urna eu dui sagittis,
                        vel
                        hendrerit mauris varius. Aliquam erat volutpat. Nam posuere enim vel malesuada vehicula.
                        Suspendisse potenti. Proin vel felis ligula. Nam a tellus vel felis mollis tempus et in purus.
                        Nam vehicula semper turpis, vel venenatis lacus scelerisque at. Duis tincidunt turpis eu
                        ultricies
                        malesuada. Phasellus quis tellus sit amet leo placerat malesuada.</p>
                    <p>Integer sollicitudin mauris vel purus facilisis viverra. Vestibulum ultrices nibh a nulla
                        faucibus,
                        id iaculis metus vehicula. Cras eget sollicitudin leo. In malesuada varius ligula, id
                        tincidunt
                        dolor rhoncus sit amet. Aliquam tempor quam at metus iaculis, at rutrum erat luctus. Nullam
                        mattis
                        libero et nisl vehicula, id varius nisi dictum. In vitae eros velit. Aenean ac metus sem.</p>
                    <p>Fusce suscipit venenatis ipsum, nec venenatis risus elementum sit amet. In scelerisque metus a
                        felis tincidunt, non ultricies lectus molestie. Aliquam viverra tristique ex eget lacinia.
                        Proin
                        ut lacus sollicitudin, rhoncus mauris non, malesuada lectus. Curabitur quis quam risus. Cras
                        tincidunt turpis ut leo elementum, a dapibus enim tincidunt. Sed sem nisi, pellentesque non
                        facilisis nec, aliquet non tortor. Cras nec sapien ultricies, efficitur sapien vitae, tempor
                        nulla. Donec nec risus a velit rutrum feugiat.</p>
                </div>
                <a href="newsletterPage.php" class="btn btn-primary btn-block">Back to News</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>&copy; 2023 PrecisionHealth.Com. All rights reserved.</p>
            <p>Leading University, Sylhet, Bangladesh</p>
        </div>
    </footer>

    <script>
        function redirectToIndex() {
            window.location.href = "index.php";
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>