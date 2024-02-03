<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /Project-4800/index.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get admin ID from session
$admin_id = $_SESSION['id'];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);

    // File upload handling
    $target_dir = "admin-panel/uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Check if file is selected
    if ($_FILES["image"]["name"]) {
        // Validate file type
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            exit();
        }

        // Check file size (limit to 5MB)
        if ($_FILES["image"]["size"] > 5000000) {
            echo "Sorry, your file is too large.";
            exit();
        }

        // Move uploaded file to target directory
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        echo "Please select an image file.";
        exit();
    }

    // Insert blog post data into the database
    $sql = "INSERT INTO user (uid, name, role, title, content, image) VALUES ('$admin_id', 'Admin', 'admin', '$title', '$content', '$target_file')";

    if (mysqli_query($conn, $sql)) {
        echo "Blog post created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

include('Sidebar.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Create Blog</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        /* Your CSS styles here */
    </style>
</head>

<body>
    <div class="form-wrap">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            enctype="multipart/form-data">
            <h1>Create <span>Blog</span></h1>
            <input type="text" name="title" placeholder="Title" required>
            <textarea name="content" placeholder="Write Body" rows="5" required></textarea>
            <input type="file" name="image" id="image" accept="image/*">
            <input type="submit" value="Post">
        </form>
    </div>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>