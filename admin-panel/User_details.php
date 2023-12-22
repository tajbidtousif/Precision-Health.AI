<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";

// Create connection
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #content {
            max-width: 600px;
            margin: 20px;
            padding: 30px;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center the content */
        }

        /* Your existing styles remain unchanged */

        /* Additional style for user details */
        .user-detail {
            margin-bottom: 10px;
        }
    </style>

</head>

<body>

    <div id="content">
        <?php if (isset($user_details)): ?>
            <h2>User Details</h2>
            <div class="user-detail">
                <p>User ID: <?php echo $user_details['uid']; ?></p>
            </div>
            <div class="user-detail">
                <p>Name: <?php echo $user_details['name']; ?></p>
            </div>
            <div class="user-detail">
                <p>Email: <?php echo $user_details['email']; ?></p>
            </div>
            <!-- Add other user details as needed -->
        <?php else: ?>
            <p class="not-found">User details not found.</p>
        <?php endif; ?>
    </div>

</body>

</html>
