<?php

// Database connection
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

// Fetch blog posts from the database
$sql = "SELECT * FROM user WHERE role = 'admin' AND title <> '' AND content <> ''";
$result = mysqli_query($conn, $sql);

// Include the sidebar
include("sidebar.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Posts</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <div class="container">
        <h1>Blog Posts</h1>
        <div class="blog-posts">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="blog-post">
                        <h2><?php echo $row['title']; ?></h2>
                        <p><?php echo $row['content']; ?></p>
                        <?php if (!empty($row['image'])) : ?>
                            <img src="<?php echo $row['image']; ?>" alt="Blog Image">
                        <?php endif; ?>
                    </div>
                <?php
                }
            } else {
                echo "<p>No blog posts found.</p>";
            }
            ?>
        </div>
    </div>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
