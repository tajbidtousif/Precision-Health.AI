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
$sql = "SELECT * FROM user LIMIT $offset, $records_per_page";
$result = $conn->query($sql);

// Count total number of records
$total_records_sql = "SELECT COUNT(*) FROM user";
$total_records_result = $conn->query($total_records_sql);
$total_records = $total_records_result->fetch_array()[0];

// Calculate the total number of pages
$total_pages = ceil($total_records / $records_per_page);

// Don't close the connection here

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

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

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

        html {
            overflow-x: hidden;
        }

        body.dark {
            --light: #0C0C1E;
            --grey: #060714;
            --dark: #FBFBFB;
        }

        body {
            background: var(--grey);
            overflow-x: hidden;
        }

        #userTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #userTable th,
        #userTable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        #userTable th {
            background-color: #4caf50;
            color: white;
        }

        #user-info {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #content {
            margin-left: 280px;
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
    </style>

</head>

<body>

    <div id="user-info" class="section">
        <div id="content">
            <h2>User Information</h2>
            <table id="userTable">
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Email</th>
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
                        echo "<td>{$row['status']}</td>";
                        echo "<td>
                 <form method=\"post\" action=\"User_details.php\">
                     <input type=\"hidden\" name=\"user_id\" value=\"{$row['uid']}\">
                         <button type=\"submit\" class=\"details-button\">Details</button>
                 </form>
             </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No users found</td></tr>";
                }
                ?>
            </table>

            <!-- Pagination checked by dev Tousif -->
            <div
                style="margin-top: 20px; padding: 10px;  background-color: #fff; display: inline-block;">
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
</body>

</html>