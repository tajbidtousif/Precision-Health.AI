<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "violated_user";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetched reported user data
$sql = "SELECT * FROM user";
$result = $conn->query($sql);


include('Sidebar.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reported User Information</title>
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
            --green: #4caf50;
            /* Added green color */
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

        #user-info {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            /* Changed height to min-height */
        }

        #content {
            margin-left: 280px;
            padding: 20px;
            /* Added padding */
        }

        h2 {
            color: var(--green);
            /* Added green color */
            margin-bottom: 20px;
        }

        #reportedUserTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #reportedUserTable th,
        #reportedUserTable td {
            border: 1px solid #ddd;
            padding: 12px;
            /* Increased padding */
            text-align: left;
        }

        #reportedUserTable th {
            background-color: var(--green);
            color: white;
        }

        .details-button {
            background-color: var(--green);
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
            <h2>Reported User Information</h2>
            <table id="reportedUserTable">
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>ReasonForDeactivating</th>
                    <th>Signup Time</th>
                    <th>Status</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['uid']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['ReasonForDeactivating']}</td>";
                        echo "<td>{$row['signup_time']}</td>";
                        echo "<td>{$row['status']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No reported users found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

</body>

</html>