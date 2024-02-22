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

// Fetch news details based on the title from the URL parameter
if (isset($_GET['title'])) {
    $title = $_GET['title'];
    
    // Prepare and execute SQL query
    $sql = "SELECT * FROM newsletter WHERE title = '$title'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "No news found with the specified title.";
    }
} else {
    echo "Title parameter is missing.";
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Details</title>
    <!-- Add your CSS styles here -->
</head>
<body>

<?php if (isset($row) && !empty($row)): ?>
    <div class="container">
        <div class="news-details">
            <h2><?php echo $row['title']; ?></h2>
            <?php if (!empty($row['image'])): ?>
                <img src="super-admin-panel/uploads/<?php echo $row['image']; ?>" alt="News Image">
            <?php endif; ?>
            <p><?php echo $row['content']; ?></p>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
