<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";


$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$records_per_page = 10;


if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $current_page = $_GET['page'];
} else {
    $current_page = 1;
}


$offset = ($current_page - 1) * $records_per_page;


$sql = "SELECT * FROM user WHERE role = 'admin' LIMIT $offset, $records_per_page";
$result = $conn->query($sql);


$total_records_sql = "SELECT COUNT(*) FROM user WHERE role = 'admin'";
$total_records_result = $conn->query($total_records_sql);
$total_records = $total_records_result->fetch_array()[0];


$total_pages = ceil($total_records / $records_per_page);


include("superAdminSidebar.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1b203d;
            font-family: system-ui;
        }

        #content {
            margin-left: 280px;
            padding: 20px;
        }

        h2 {
            color: #fff;
            margin-left: 30px;
            margin-bottom: 20px;
            margin-top: 100px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #1b203d;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
           
            color: white;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
        }

        tr:hover {
            background-color: #004080;
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
    </style>
</head>
<body>

<div id="admin-info" class="section">
    <div id="content">
        <h2>Admin Information</h2>
        <table id="adminTable">
        <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>SignUp Time</th>
                    <th>Status</th>
                </tr>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['uid']}</td>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['role']}</td>";
                    echo "<td>{$row['signup_time']}</td>";
                    echo "<td>{$row['status']}</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No admins found</td></tr>";
            }
            ?>
        </table>

        <!-- Pagination -->
        <div style="margin-top: 20px; padding: 10px; background-color: ; display: inline-block;">
            <span style="font-size: 16px; margin-right: 10px; padding: 8px; border: 1px solid #4caf50; border-radius: 4px; color:white">Page:</span>
            <?php
            // Display pagination links
            for ($page = 1; $page <= $total_pages; $page++) {
                echo "<a href='AdminInfo.php?page={$page}' style='padding: 8px; margin-right: 5px; text-decoration: none; color: #4caf50; border: 1px solid #4caf50; border-radius: 4px;'>{$page}</a>";
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
