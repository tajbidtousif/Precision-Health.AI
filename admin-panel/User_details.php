<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];

    $sql = "SELECT * FROM user WHERE uid = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user_details = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching user details: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

include('Sidebar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --poppins: 'Poppins', sans-serif;
            --light: #F9F9F9;
            --blue: #3C91E6;
            --light-blue: #CFE8FF;
            --grey: #eee;
            --dark-grey: #AAAAAA;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: var(--grey);
        }

        #content {
            margin: 20px auto;
            padding: 20px;
            width: 80%;
            background-color: var(--light);
            border: 1px solid var(--dark-grey);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            color: var(--blue);
        }
    </style>
</head>

<body>

    <div id="content">

        <h2>User Details</h2>
        <?php

        if (isset($user_details)) {
            echo "<p>User ID: {$user_details['uid']}</p>";
            echo "<p>Name: {$user_details['name']}</p>";
            echo "<p>Email: {$user_details['email']}</p>";
            echo "<p>Status: {$user_details['status']}</p>";
            // Add more details as needed
        } else {
            echo "<p>No user details found.</p>";
        }
        ?>
    </div>
</body>

</html>