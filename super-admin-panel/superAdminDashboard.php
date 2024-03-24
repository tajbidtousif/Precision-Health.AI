<?php

// if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'superadmin') {
//     // Redirect the user to the login page
//     header("Location: /Project-4800/index.php");
//     exit(); // Stop further execution
// }

$servername = "localhost";
$username = "root";
$password = "";
$database = "otp_verification";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch total number of users
$sqlTotalUsers = "SELECT COUNT(*) as total_users FROM user WHERE role = 'user'";
$resultTotalUsers = mysqli_query($conn, $sqlTotalUsers);
$rowTotalUsers = mysqli_fetch_assoc($resultTotalUsers);
$totalUsers = $rowTotalUsers['total_users'];

// Fetch total number of admins
$sqlTotalAdmins = "SELECT COUNT(*) as total_admins FROM user WHERE role = 'admin'";
$resultTotalAdmins = mysqli_query($conn, $sqlTotalAdmins);
$rowTotalAdmins = mysqli_fetch_assoc($resultTotalAdmins);
$totalAdmins = $rowTotalAdmins['total_admins'];

// Fetch total number of reported admins
$sqlReportedAdmins = "SELECT COUNT(*) as total_reported_admins FROM user WHERE adminReport = 1";
$resultReportedAdmins = mysqli_query($conn, $sqlReportedAdmins);
$rowReportedAdmins = mysqli_fetch_assoc($resultReportedAdmins);
$totalReportedAdminss = $rowReportedAdmins['total_reported_admins'];
$totalReportedAdmins = 7;

// Fetch total number of reported users from the user table in the violated_user database
$sqlReportedUsers = "SELECT COUNT(*) as total_reported_users FROM violated_user.user";
$resultReportedUsers = mysqli_query($conn, $sqlReportedUsers);
$rowReportedUsers = mysqli_fetch_assoc($resultReportedUsers);
$totalReportedUsers = $rowReportedUsers['total_reported_users'];


include 'superAdminSidebar.php';
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <title></title>
    <link rel="stylesheet" href="" type="text/css" />
    <style>
        body {
            margin: 0px;
            padding: 0px;
            background-color: #1b203d;
            overflow: hidden;
            font-family: system-ui;
        }

        .clearfix {
            clear: both;
        }


        #main {
            transition: margin-left .5s;
            padding: 16px;
            margin-left: 300px;
        }

        .head {
            padding: 20px;
        }

        .col-div-6 {
            width: 50%;
            float: left;
        }

        .profile {
            display: inline-block;
            float: right;
            width: 160px;
        }

        .pro-img {
            float: left;
            width: 40px;
            margin-top: 5px;
        }

        .profile p {
            color: white;
            font-weight: 500;
            margin-left: 55px;
            margin-top: 10px;
            font-size: 13.5px;
        }

        .profile p span {
            font-weight: 400;
            font-size: 12px;
            display: block;
            color: #8e8b8b;
        }

        .col-div-3 {
            width: 25%;
            float: left;
        }

        .box {
            width: 85%;
            height: 100px;
            background-color: #272c4a;
            margin-left: 10px;
            padding: 10px;
        }

        .box p {
            font-size: 35px;
            color: white;
            font-weight: bold;
            line-height: 30px;
            padding-left: 10px;
            margin-top: 20px;
            display: inline-block;
        }

        .box p span {
            font-size: 20px;
            font-weight: 400;
            color: #818181;
        }

        .box-icon {
            font-size: 40px !important;
            float: right;
            margin-top: 35px !important;
            color: #818181;
            padding-right: 10px;
        }

        .col-div-8 {
            width: 70%;
            float: left;
        }

        .col-div-4 {
            width: 30%;
            float: left;
        }

        .content-box {
            padding: 20px;
        }

        .content-box p {
            margin: 0px;
            font-size: 20px;
            color: #f7403b;
        }

        .content-box p span {
            float: right;
            background-color: #ddd;
            padding: 3px 10px;
            font-size: 15px;
        }

        .box-8,
        .box-4 {
            width: 95%;
            background-color: #272c4a;
            height: 330px;

        }

        .nav2 {
            display: none;
        }

        .box-8 {
            margin-left: 10px;
        }

        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;

        }

        td,
        th {
            text-align: left;
            padding: 15px;
            color: #ddd;
            border-bottom: 1px solid #81818140;
        }

        .circle-wrap {
            margin: 50px auto;
            width: 150px;
            height: 150px;
            background: #e6e2e7;
            border-radius: 50%;
        }

        .circle-wrap .circle .mask,
        .circle-wrap .circle .fill {
            width: 150px;
            height: 150px;
            position: absolute;
            border-radius: 50%;
        }

        .circle-wrap .circle .mask {
            clip: rect(0px, 150px, 150px, 75px);
        }

        .circle-wrap .circle .mask .fill {
            clip: rect(0px, 75px, 150px, 0px);
            background-color: #f7403b;
        }

        .circle-wrap .circle .mask.full,
        .circle-wrap .circle .fill {
            animation: fill ease-in-out 3s;
            transform: rotate(126deg);
        }

        @keyframes fill {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(126deg);
            }
        }

        .circle-wrap .inside-circle {
            width: 130px;
            height: 130px;
            border-radius: 50%;
            background: #fff;
            line-height: 130px;
            text-align: center;
            margin-top: 10px;
            margin-left: 10px;
            position: absolute;
            z-index: 100;
            font-weight: 700;
            font-size: 2em;
        }
    </style>
</head>

<body>

    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px; color: white;" class="nav">☰ Dashboard</span>
            </div>
        </div>
        <br />
        <br />
        <br />
        <div class="clearfix"></div>
        <br />
        <div class="col-div-3">
            <div class="box">
                <p>
                    <?php echo $totalUsers; ?><br /><span>Total User</span>
                </p>
                <i class="fa fa-users box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p>
                    <?php echo $totalAdmins; ?><br /><span>Total Admin</span>
                </p>
                <i class="fa fa-list box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p>
                    <?php echo $totalReportedUsers; ?><br /><span>Reported User</span>
                </p>
                <i class="fa fa-exclamation-triangle box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p>
                    <?php echo $totalReportedAdmins; ?><br /><span>Reported Admin</span>
                </p>
                <i class="fa fa-tasks box-icon"></i>
            </div>
        </div>
        <div class="clearfix"></div>
        <br /><br />
        <div class="clearfix"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>