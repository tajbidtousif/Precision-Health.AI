<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the news ID is provided in the URL
if (isset($_GET['id'])) {
    $news_id = $_GET['id'];

    // Retrieve the news details from the database
    $sql = "SELECT * FROM newsletter WHERE uid = $news_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['title'];
        $content = $row['content'];
    } else {
        // Redirect to the newsletter page if news article not found
        $newsletterPageURL = "newsletterPage.php";
        header("Location: $newsletterPageURL");
        exit();
    }
} else {
    // Redirect to the newsletter page if news ID is not provided
    $newsletterPageURL = "newsletterPage.php";
    header("Location: $newsletterPageURL");
    exit();
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo $title; ?> - Health News Details
    </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            margin-top: 100px;
            /* Increased top margin to push content down from the navbar */
            margin-bottom: 30px;
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

        .navbar {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #007bff;
            padding: 1rem;
            backdrop-filter: blur(10px);
        }

        .navbar .navbar-brand {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            font-size: 1.2rem;
            margin-right: 20px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff;
            transform: scale(1.1);
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-light bg-transparent">
        <div class="container">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
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

    <div class="container news-details">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="news-content">
                    <h3>
                        <?php echo $title; ?>
                    </h3>
                    <p>
                        <?php echo $content; ?>
                    </p>
                </div>
                <a href="newsletterPage.php" class="btn btn-primary btn-block">Back to News</a>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2023 PrecisionHealth.Com. All rights reserved.</p>
            <p>Leading University, Sylhet, Bangladesh</p>
        </div>
    </footer>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>