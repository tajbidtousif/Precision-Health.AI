<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];


    $conn = mysqli_connect("localhost", "root", "", "otp_verification");


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "DELETE FROM user WHERE uid = '$user_id'";
    $result = $conn->query($sql);


    $conn->close();


    header("Location: admin_dashboard.php");
    exit();
}
?>