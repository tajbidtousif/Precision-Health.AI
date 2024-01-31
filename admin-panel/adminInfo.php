<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Number of records to show per page
$records_per_page = 10;

// Get the current page
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}

// Calculate the offset for the query based on the current page
$offset = ($current_page - 1) * $records_per_page;

// Fetched user data with pagination
$sql = "SELECT * FROM user WHERE role = 'admin' LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

// Count total number of records
$total_records_sql = "SELECT COUNT(*) FROM user WHERE role = 'admin'";
$total_records_result = $conn->query($total_records_sql);
$total_records = $total_records_result->fetch_array()[0];

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);

include('Sidebar.php');

// Process report submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['admin_report']) && !empty($_POST['admin_report'])) {
        $report = $_POST['admin_report'];
        $uid = $_POST['uid'];

        // Update the adminReport column in the database
        $update_sql = "UPDATE user SET adminReport = '$report' WHERE uid = $uid";
        if ($conn->query($update_sql) === TRUE) {
            $success_message = "Report submitted successfully!";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    } else {
        $error_message = "Report field cannot be empty!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Information</title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        :root {
            --poppins: 'Poppins', sans-serif;
            --lato: 'Lato', sans-serif;

            --light: #F9F9F9;
            --blue: #3C91E6;
            --light-blue: #CFE8FF;
            --grey: #eee;
            --dark-grey: #AAAAAA;
            --dark: #342E37;
            --red: #DB504A;
            --yellow: #FFCE26;
            --light-yellow: #FFF2C6;
            --orange: #FD7238;
            --light-orange: #FFE0D3;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eee;
        }

        #content {
            margin-left: 280px;
            padding: 20px;
        }

        h2 {
            color: #4CAF50;
            margin-left: 30px;
            margin-bottom: 20px;
            margin-top: 100px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #gray;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #AAAAAA;
        }

        td {
            color: black;
        }

        .details-button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .details-button:hover {
            background-color: #45a049;
        }

        .action-button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .action-button:hover {
            background-color: #45a049;
        }

        /* Colorful Submit Button */
        .submit-button {
            background-color: #3c91e6;
            /* Blue color */
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #356dab;
            /* Darker blue color on hover */
        }
    </style>
</head>

<body>

    <div id="user-info" class="section">
        <div id="content">
            <h2>Admin Information</h2>
            <?php if (isset($success_message)): ?>
                <div class="success-message">
                    <?php echo $success_message; ?>
                </div>
            <?php endif; ?>
            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <table id="userTable">
                <!-- Table headers -->
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>SignUp Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php
                // Loop through the query results and display rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['uid']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['role']}</td>";
                    echo "<td>{$row['signup_time']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "<td>
                <form method=\"post\">
                    <input type=\"hidden\" name=\"uid\" value=\"{$row['uid']}\">
                    <button type=\"button\" class=\"details-button\" onclick=\"toggleReportForm(this)\">Report</button>
                    <div style=\"display:none;\">
                        <input type=\"text\" name=\"admin_report\" placeholder=\"Enter report\">
                        <button type=\"submit\" class=\"submit-button\">Submit</button>
                    </div>
                </form>
            </td>";
                    echo "</tr>";
                }
                ?>
            </table>

            <!-- Pagination checked by dev Tousif -->
            <div style="margin-top: 20px; padding: 10px;  background-color: ; display: inline-block;">
                <span
                    style="font-size: 16px; margin-right: 10px; padding: 8px; border: 1px solid #4caf50; border-radius: 4px;">Page:</span>
                <?php
                // Display pagination links
                for ($page = 1; $page <= $total_pages; $page++) {
                    echo "<a href='UserInfo.php?page={$page}' style='padding: 8px; margin-right: 5px; text-decoration: none; color: #4caf50; border: 1px solid #4caf50; border-radius: 4px;'>{$page}</a>";
                }
                ?>
            </div>
        </div>
    </div>

    <script>
        function toggleReportForm(button) {
            var form = button.nextElementSibling;
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }
    </script>
</body>

</html>