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
        /* Your existing CSS styles here */

        /* Adjust the margin between cards */
        .card {
            margin-bottom: 20px;
            /* Reduce the bottom margin */
        }

        /* Adjustments for "Read More" button */
        .card {
            position: relative;
        }

        .btn-read-more {
            display: none;
            /* Initially hide the button */
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            bottom: 3px;
        }

        .card:hover .btn-read-more {
            display: block;
            /* Display button on hover */
        }

        @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,800);

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Raleway", Arial, sans-serif;
            background: #7f9ead;
            position: relative;
            /* Ensure relative positioning for absolute positioning of navbar */
        }

        /* Navbar Styles */
        .navbar {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #007bff;
            /* Blue color */
            padding: 1rem;
            backdrop-filter: blur(10px);
            /* Add blur effect */
        }

        .navbar .navbar-brand {
            color: #ffffff;
            /* White color */
            font-size: 1.5rem;
            font-weight: bold;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
            /* White color */
            font-size: 1.2rem;
            margin-right: 20px;
            transition: color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            color: #ffffff;
            /* White color */
            transform: scale(1.1);
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
            /* Adjust height on hover */
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
            /* Hide overflow content initially */
            max-height: 60px;
            /* Set max height to limit content */
            transition: max-height 0.3s;
            /* Transition max height for smooth effect */
        }

        .card:hover .content {
            max-height: 200px;
            /* Show full content on hover */
        }

        .content h2 {
            color: #007bff;
            /* Blue color */
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .content p {
            color: #333;
            /* Dark color */
            font-size: 1rem;
            line-height: 1.5;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
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
    <div class="container">
        <div class="row">

            <?php
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
                                    <a href="newsDetails.php">
                                        <?php echo $row['title']; ?>
                                    </a>
                                </h2>
                                <p>
                                    <?php echo $row['content']; ?>
                                </p>
                            </div>
                            <a href="newsDetails.php" class="btn btn-primary btn-read-more">Read More</a>
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

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>