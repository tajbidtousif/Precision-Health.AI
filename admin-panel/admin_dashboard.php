<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";

// Created connection
$conn = mysqli_connect("localhost", "root", "", "otp_verification");
// Checked connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetched user data
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

// Closing the connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>

<body>

    <input type="checkbox" id="check">

    <header>
        <label for="check">
            <i class="fa fa-bars" id="side_nav_btn"></i>
        </label>
        <div class="left_side">
            <h3>Precision Health Community</h3>
        </div>
    </header>
    <div class="side-nav">
        <div class="logo">
            <img src="http://localhost/Project-4800/img/adminlogo.jpg" alt="Logo" class="image">
        </div>

        <a href="#dashboard"><i class="fa fa-desktop"><span>Dashboard</span></i></a>
        <a href="#user-info"><i class="fa-solid fa-user"><span>User-Info</span></i></a>
        <a href="#"><i class="fa fa-table"><span>Tables</span></i></a>
        <a href="#"><i class="fa fa-th"><span>forms</span></i></a>
        <a href="#"><i class="fa fa-info-circle"><span>about</span></i></a>
        <a href="#"><i class="fa fa-sliders"><span>Settings</span></i></a>
    </div>
    <div class="banner">

        <div id="dashboard" class="section">
            <div class="cart-container">
                <i class="fa fa-shopping-cart" id="cart-icon"></i>
                <span id="user-count">
                    <?php echo $result->num_rows; ?>
                </span>
            </div>
        </div>

        <div id="user-info" class="section">
            <div id="content">
                <h2>User Information</h2>
                <table id="userTable">
                    <tr>
                        <th>UID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Signup Time</th>
                        <th>OTP</th>
                        <th>Activation Code</th>
                        <th>Reset Code</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['uid']}</td>";
                            echo "<td>{$row['name']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['password']}</td>";
                            echo "<td>{$row['signup_time']}</td>";
                            echo "<td>{$row['otp']}</td>";
                            echo "<td>{$row['activation_code']}</td>";
                            echo "<td>{$row['reset_code']}</td>";
                            echo "<td>{$row['status']}</td>";

                           //delete button here.... confirmed by author

                            echo "<td><form method='post' action='delete_user.php'>";
                            echo "<input type='hidden' name='user_id' value='{$row['uid']}'>";
                            echo "<button type='submit' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</button>";
                            echo "</form></td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>No users found</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>

    </div>

    <script src="https://kit.fontawesome.com/b478a02406.js" crossorigin="anonymous"></script>

</body>

</html>