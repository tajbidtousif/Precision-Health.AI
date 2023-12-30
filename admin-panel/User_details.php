<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];

    $sql = "SELECT * FROM user WHERE uid = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user_details = mysqli_fetch_assoc($result);
    } else {
        echo "Error fetching user details: " . mysqli_error($conn);
    }

    mysqli_close($conn);
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
        if (isset($user_details)) {
            echo "<p><strong>User ID:</strong> {$user_details['uid']}</p>";
            echo "<p><strong>Name:</strong> {$user_details['name']}</p>";
            echo "<p><strong>Email:</strong> {$user_details['email']}</p>";
            echo "<p><strong>Status:</strong> {$user_details['status']}</p>";

            //  report button
            echo '<button id="reportButton" onclick="showReportField()">Report</button>';
            //  report field and done button
            echo '<div id="reportFieldContainer">';
            echo '<textarea id="reportField" placeholder="Enter your report"></textarea>';
            echo '<button id="doneButton" onclick="hideReportField()">Deactivate</button>';
            echo '</div>';
        } else {
            echo "<p>No user details found.</p>";
        }
        ?>
    </div>

    <script>
        function showReportField() {
            document.getElementById("reportFieldContainer").style.display = "block";
        }

        function hideReportField() {
            document.getElementById("reportFieldContainer").style.display = "none";
        }
    </script>

</body>

</html>