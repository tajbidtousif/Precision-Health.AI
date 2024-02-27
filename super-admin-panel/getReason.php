<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "violated_user";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the reason for deactivation based on the user ID
if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    $sql = "SELECT ReasonForDeactivating FROM user WHERE uid = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['ReasonForDeactivating'];
    } else {
        echo "Reason not found";
    }
} else {
    echo "User ID not provided";
}

$conn->close();
?>
