<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : null;

// echo "User ID: " . $user_id;

$user_details = [];

if (!empty($user_id)) {
    $sql = "SELECT * FROM user WHERE uid = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user_details = mysqli_fetch_assoc($result);
    } else {
        die("Error fetching user details: " . mysqli_error($conn));
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_action'])) {
    $submit_action = $_POST['submit_action'];

    if ($submit_action === 'report_user') {
        // Handle reporting logic
        $category = mysqli_real_escape_string($conn, $_POST['category']); // Capture Categories value
        $reason = mysqli_real_escape_string($conn, $_POST['reason']);

        // Check if both category and reason are not empty
        if (!empty($category) && !empty($reason)) {
            // Move the user to the "violated_user" database
            $violated_conn = mysqli_connect($servername, $username, $password, "violated_user");

            if (!$violated_conn) {
                die("Connection to violated_user failed: " . mysqli_connect_error());
            }

            // Insert the user into "violated_user" database with Categories value
            $insert_sql = "INSERT INTO user (name, email, Categories, ReasonForDeactivating, status) 
                           VALUES ('{$user_details['name']}', '{$user_details['email']}', '$category', '$reason', 'Deactivated')";

            if (mysqli_query($violated_conn, $insert_sql)) {
                // User moved to "violated_user" successfully

                // Delete the user from the original database
                $delete_sql = "DELETE FROM user WHERE uid = $user_id";

                if (mysqli_query($conn, $delete_sql)) {
                    // Show success message using JavaScript
                    echo '<script>alert("User reported and moved to violated_user database successfully.");</script>';

                    // Redirect to UserInfo.php
                    header("Location: UserInfo.php");
                    exit();
                } else {
                    echo '<script>alert("Error deleting user from the original database: ");</script>';
                }
            } else {
                echo "Error moving user to violated_user database: " . mysqli_error($violated_conn);
            }

            mysqli_close($violated_conn);
        } else {
            echo "Please select a category and enter a reason.";
        }
    } elseif ($submit_action === 'deactivate_user') {
        // Handle deactivation logic
        $reason = mysqli_real_escape_string($conn, $_POST['reason']);
        // echo "User deactivated successfully. Reason: $reason";
    }
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
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #content {
            font-size: 20px;
            position: absolute;
            padding: 20px;
            width: 30%;
            background-color: var(--light);
            border: 1px solid var(--dark-grey);
            border-radius: 8px;
            text-align: center;
            cursor: default;
            left: 35%;
            box-shadow: 0 0 300px rgba(0, 0, 0, 0.1);

        }

        strong {
            font-weight: bold;
        }

        #reportButton {
            background-color: red;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 15px;
        }

        #reportFieldContainer {
            display: none;
            margin-top: 15px;
        }

        #reportField {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        #doneButton {
            background-color: green;
            color: white;
            padding: 8px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <div id="content">
        <?php
        if (!empty($user_details)) {
            echo "<p><strong>User ID:</strong> {$user_details['uid']}</p>";
            echo "<p><strong>Name:</strong> {$user_details['name']}</p>";
            echo "<p><strong>Email:</strong> {$user_details['email']}</p>";
            echo "<p><strong>Status:</strong> {$user_details['status']}</p>";

            echo '<button id="reportButton">Report</button>';

            echo '<form method="post" action="user_details.php" id="reportForm">';
            echo '<div id="reportFieldContainer">';
            echo '<select name="category" id="categoryField" style="margin-top: 10px;">';
            echo '<option value="Cyber Violence">Cyber Violence Report</option>';
            echo '<option value="Spamming Violence">Spamming Violence Report</option>';
            echo '</select>';
            echo '<textarea name="reason" id="reportField" placeholder="Enter your report" required></textarea>';
            echo '<input type="hidden" name="user_id" value="' . $user_id . '">';
            echo '<button type="submit" name="submit_action" value="report_user" id="doneButton">Submit Report</button>';
            echo '</div>';
            echo '</form>';
        } else {
            echo "<p>No user details found. </p>";
        }
        ?>
    </div>

    <script>
        document.getElementById("reportButton").addEventListener("click", function () {
            var reportFieldContainer = document.getElementById("reportFieldContainer");
            reportFieldContainer.style.display = "block";
        });
    </script>

</body>

</html>