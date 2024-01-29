<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname_otp = "otp_verification";
$dbname_violated = "violated_user";

// Connect to otp_verification database
$conn_otp = mysqli_connect($servername, $username, $password, $dbname_otp);
if (!$conn_otp) {
    die("Connection failed: " . mysqli_connect_error());
}

// Connect to violated_user database
$conn_violated = mysqli_connect($servername, $username, $password, $dbname_violated);
if (!$conn_violated) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['take_action'])) {
    $uid = $_POST['uid'];

    // Retrieve admin information from otp_verification database
    $sql_select_admin = "SELECT * FROM user WHERE uid = $uid";
    $result_admin = mysqli_query($conn_otp, $sql_select_admin);

    if (mysqli_num_rows($result_admin) == 1) {
        $admin_data = mysqli_fetch_assoc($result_admin);

        // Insert admin information into violated_user database
        $sql_insert_violated = "INSERT INTO user (uid, name, email, role, ReasonForDeactivating, signup_time, status) VALUES 
                        ('{$admin_data['uid']}', '{$admin_data['name']}', '{$admin_data['email']}', '{$admin_data['role']}', '{$admin_data['adminReport']}', '{$admin_data['signup_time']}', '{$admin_data['status']}')";
        if (mysqli_query($conn_violated, $sql_insert_violated)) {
            // Delete admin record from otp_verification database
            $sql_delete_admin = "DELETE FROM user WHERE uid = $uid";
            if (mysqli_query($conn_otp, $sql_delete_admin)) {
                echo "<script>alert('Action taken successfully!');</script>";
            } else {
                echo "<script>alert('Failed to delete admin record from otp_verification database.');</script>";
            }
        } else {
            echo "<script>alert('Failed to insert admin information into violated_user database.');</script>";
        }
    } else {
        echo "<script>alert('Admin not found in otp_verification database.');</script>";
    }
}

include('superAdminSidebar.php');

// Fetch reported admins from otp_verification database
$sql = "SELECT uid, name, email, role, signup_time, status, adminReport FROM user WHERE role = 'admin' AND adminReport IS NOT NULL AND adminReport <> ''";
$result = mysqli_query($conn_otp, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Reported Admin Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1b203d;
        }

        #content h2{
            color: #fff;
            margin-left: 30px;
            margin-bottom: 20px;
            margin-top: 100px;
        }

        #content {
            margin-left: 280px;
            padding: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            background-color: #1b203d;
            color: white;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .action-button {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .action-button:hover {
            background-color: #005f77;
        }
    </style>
</head>
<body>
    <!-- Include SuperAdmin sidebar -->
    <?php include('superAdminSidebar.php'); ?>

    <div id="content">
        <h2>Reported Admin Information</h2>

        <!-- Display admin information and reports in a table -->
        <table>
            <thead>
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin Report</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['uid']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['adminReport']}</td>";
                        echo "<td>";
                        echo "<form method='post'>";
                        echo "<input type='hidden' name='uid' value='{$row['uid']}'>";
                        echo "<button type='submit' name='take_action' class='action-button'>Take Action</button>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No reported admins found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close database connections
mysqli_close($conn_otp);
mysqli_close($conn_violated);
?>
