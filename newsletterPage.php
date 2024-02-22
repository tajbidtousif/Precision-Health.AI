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
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,800);

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: "Raleway", Arial, sans-serif;
            background: #7f9ead;
        }

        .card {
            position: relative;
            width: 300px;
            height: 200px;
            border-radius: 10px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.5);
            transition: 0.3s;
            padding: 30px 50px;
            background: #fff;
            cursor: pointer;
            margin-right: 30px;
        }

        .card:hover {
            height: 320px;
        }

        .imgbox {
            position: relative;
            width: 100%;
            height: 100%;
            transform: translateY(-80px);
            z-index: 99;
        }

        img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.5);
        }

        .content {
            padding: 10px 20px;
            text-align: center;
            transform: translateY(-450px);
            opacity: 0;
            transition: 0.3s;
        }

        .card:hover > .content {
            opacity: 1;
            transform: translateY(-180px);
        }

        .content h2 {
            color: #7f9ead;
        }
    </style>
</head>

<body>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="card">
                <div class="imgbox">
                    <img src="super-admin-panel/uploads/<?php echo $row['image']; ?>" />
                </div>
                <div class="content">
                    <h2><?php echo $row['title']; ?></h2>
                    <p><?php echo $row['content']; ?></p>
                </div>
            </div>
        <?php
        }
    } else {
        echo "No news available";
    }
    ?>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
