<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "violated_user";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetched reported user data for users with role 'user'
$sql = "SELECT * FROM user WHERE role = 'admin'";
$result = $conn->query($sql);

include('superAdminSidebar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reported User Information</title>
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
            --green: #4caf50;

        }

        html {
            overflow-x: hidden;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1b203d;
            font-family: system-ui;
        }

        #user-info {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 50vh;

        }

        #content {
            margin-left: 280px;
            padding: 20px;

        }

        h2 {
            color: #fff;
            margin-left: 30px;
            margin-bottom: 20px;

        }

        #reportedUserTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        #reportedUserTable th,
        #reportedUserTable td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        #reportedUserTable th {
            background-color: #4CAF50;
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

        #reportedUserTable th,
        #reportedUserTable td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            color: white;
        }

        #reportedUserTable th {
            background-color: var(--green);
            color: white;
        }

        .category-button {
            background-color: var(--green);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .category-button:hover {
            background-color: #45a049;
        }

        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
        }

        .popup-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 900;
        }
    </style>
</head>

<body>

    <div id="user-info" class="section">
        <div id="content">
            <h2>Reported Admin Information</h2>
            <table id="reportedUserTable">
                <tr>
                    <th>UID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Reported By</th>
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['uid']}</td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['reportedBy']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No reported users found</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <div id="reasonPopup" class="popup">
        <span onclick="closePopup()" style="cursor: pointer; float: right;">&times;</span>
        <h3>Reason For Deactivating</h3>
        <p id="reasonText"></p>
    </div>

    <div id="popupOverlay" class="popup-overlay" onclick="closePopup()"></div>

    <script>
        function showReason(userId) {
            // Fetch the reason from the database using AJAX
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var reason = this.responseText;
                    document.getElementById("reasonText").innerHTML = reason;
                    openPopup();
                }
            };
            xmlhttp.open("GET", "getReason.php?userId=" + userId, true);
            xmlhttp.send();
        }

        function openPopup() {
            document.getElementById("reasonPopup").style.display = "block";
            document.getElementById("popupOverlay").style.display = "block";
        }

        function closePopup() {
            document.getElementById("reasonPopup").style.display = "none";
            document.getElementById("popupOverlay").style.display = "none";
        }
    </script>

</body>

</html>