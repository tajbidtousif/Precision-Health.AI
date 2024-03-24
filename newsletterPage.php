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

$sql = "SELECT * FROM newsletter";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Check if there was an error executing the query
if (!$result) {
    die("Error executing the query: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>

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

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Raleway", Arial, sans-serif;
            position: relative;
            transition: transform 0.2s, box-shadow 0.2s;
            background: linear-gradient(135deg, #d8d065, #d47070);
            animation: changeBackground 35s linear infinite;
        }

        body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: -1;
    background: linear-gradient(135deg, #d8d065, #d47070); /* Fallback */
    animation: changeBackground 35s linear infinite;
    -webkit-filter: blur(8px); /* Chrome, Safari, Opera */
    filter: blur(8px);
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

        .container-news {
            margin-top: 100px;
            /* Increase the margin-top value to create more space */
            height: calc(100vh - 100px);
            /* Adjust the height accordingly */
            overflow-y: auto;

        }

        .card {
            position: relative;
            width: 300px;
            height: auto;
            border-radius: 10px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.5);
            transition: 0.3s;
            padding: 20px;
            background: #fff;
            margin-right: 30px;
            margin-bottom: 30px;
        }

        .card:hover {
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.5);
            height: auto;
        }

        .imgbox {
            position: relative;
            width: 100%;
            height: 200px;
            overflow: hidden;
        }

        img {
            width: 100%;
            height: auto;
            border-radius: 10px 10px 0 0;
            object-fit: cover;
        }

        .content {
            padding: 10px;
            text-align: left;
            overflow: hidden;
            max-height: 60px;
            transition: max-height 0.3s;
        }

        .card:hover .content {
            max-height: 200px;
        }

        .content h2 {
            color: #007bff;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .content p {
            color: #333;
            font-size: 1rem;
            line-height: 1.5;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .btn-read-more {
            display: none;
            /* Initially hide the button */
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .card:hover .btn-read-more {
            display: block;
            /* Display button on hover */
        }

        .container-news::-webkit-scrollbar {
            margin-left: -20px;
            /* Adjust the value as needed to move the scrollbar to the desired position */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-transparent">
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

    <div class="container-news">
        <div class="container">
            <div class="row">
                <?php
                include 'config.php';
                $sql = "SELECT * FROM newsletter";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="imgbox">
                                    <img src="super-admin-panel/uploads/<?php echo $row['image']; ?>"
                                        alt="<?php echo $row['title']; ?>" />
                                </div>
                                <div class="content">
                                    <h2>
                                        <?php echo $row['title']; ?>
                                    </h2>
                                    <p>
                                        <?php echo $row['content']; ?>
                                    </p>
                                </div>
                                <a <?php echo 'href="newsDetails.php?id=' . $row['uid'] . '"'; ?>
                                    class="btn btn-primary btn-read-more">Read More</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "No news available";
                }
                ?>
            </div>
        </div>
    </div>

      <!-- Footer -->
  

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>




<?php
// Close the database connection
mysqli_close($conn);
?>