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
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #content {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #0c0e10;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        p {
            margin-bottom: 10px;
        }

        /* Add any additional styling as needed */
    </style>

</head>

<body>
    
    <?php if (isset($user_details)): ?>
        <h2>User Details</h2>
        <p>User ID:
            <?php echo $user_details['uid']; ?>
        </p>
        <p>Name:
            <?php echo $user_details['name']; ?>
        </p>
        <p>Email:
            <?php echo $user_details['email']; ?>
        </p>
        <!-- Add other user details as needed -->
    <?php else: ?>
        <p>User details not found.</p>
    <?php endif; ?>
</body>

</html>