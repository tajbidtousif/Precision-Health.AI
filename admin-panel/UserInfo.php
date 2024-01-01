<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetched user data
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

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

                        // Details button here (Checked by author: Backend Dev: Tousif)
                        echo "<td>
        <form method=\"post\" action=\"User_details.php\">
            <input type=\"hidden\" name=\"user_id\" value=\"{$row['uid']}\">
            <button type=\"submit\" class=\"details-button\">Details</button>
        </form>
    </td>";
                    }
                } else {
                    echo "<tr><td colspan='10'>No users found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>