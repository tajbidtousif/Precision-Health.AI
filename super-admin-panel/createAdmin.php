<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "otp_verification";
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input data
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Define variables and initialize with empty values
$fullname = $email = $password = $confirm_password = "";
$fullname_err = $email_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate Full Name
    if (empty($_POST["fullname"])) {
        $fullname_err = "Full Name is required";
    } else {
        $fullname = sanitize_input($_POST["fullname"]);
    }

    // Validate Email
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = sanitize_input($_POST["email"]);
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email_err = "Invalid email format";
        }
    }

    // Validate Password
    if (empty($_POST["password"])) {
        $password_err = "Password is required";
    } else {
        $password = sanitize_input($_POST["password"]);
    }

    // Validate Confirm Password
    if (empty($_POST["confirm_password"])) {
        $confirm_password_err = "Please confirm password";
    } else {
        $confirm_password = sanitize_input($_POST["confirm_password"]);
        if ($password !== $confirm_password) {
            $confirm_password_err = "Password did not match";
        }
    }

    // Check input errors before inserting into database
    if (empty($fullname_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {

        // Hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL statement to insert into database
        $sql = "INSERT INTO user (name, email, password, role, status) VALUES (?, ?, ?, 'admin', 'active')";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sss", $param_fullname, $param_email, $param_password);

        // Set parameters
        $param_fullname = $fullname;
        $param_email = $email;
        $param_password = $hashed_password;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to success page or display success message
            header("location: superAdmin.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
include("superAdminSidebar.php");
?>


<!DOCTYPE html>


<html>


<head>
    <title>Create Admin</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    body {
        margin: 0px;
        padding: 0px;
        background-color: #1b203d;
        overflow: hidden;
        font-family: system-ui;
    }

    .form-wrap {
        width: 320px;
        background: #1b203d;
        padding: 40px 20px;
        box-sizing: border-box;
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
    }

    h1 {
        text-align: center;
        color: #fff;
        font-weight: normal;
        margin-bottom: 20px;
    }

    input {
        width: 100%;
        background: none;
        border: 1px solid #fff;
        border-radius: 3px;
        padding: 6px 15px;
        box-sizing: border-box;
        margin-bottom: 20px;
        font-size: 16px;
        color: #fff;
    }

    input[type="submit"] {
        background: #bac675;
        border: 0;
        cursor: pointer;
        color: #3e3d3d;
    }

    input[type="submit"]:hover {
        background: #a4b15c;
        transition: .6s;
    }

    ::placeholder {
        color: #fff;
    }

    form h1 span {
        color: red;
    }
</style>


<body>
    <div class="form-wrap">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h1>Create <span/>Admin</span></h1>
            <input type="text" name="fullname" placeholder="Full Name">
            <span class="error">
                <?php echo $fullname_err; ?>
            </span>
            <input type="email" name="email" placeholder="Email">
            <span class="error">
                <?php echo $email_err; ?>
            </span>
            <input type="text" name="NID" placeholder="NID Info">
            <input type="password" name="password" placeholder="Password">
            <span class="error">
                <?php echo $password_err; ?>
            </span>
            <input type="password" name="confirm_password" placeholder="Confirm Password">
            <span class="error">
                <?php echo $confirm_password_err; ?>
            </span>
            <input type="submit" value="Create">
        </form>
    </div>
</body>

</html>