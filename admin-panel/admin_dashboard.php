<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "otp_verification";

// Created connection
$conn = mysqli_connect("localhost", "root", "", "otp_verification");
// Checked connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetched user data
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

// Closing the connection
$conn->close();

include('Sidebar.php');
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<!-- My CSS -->
	<link rel="stylesheet" href="admin_dashboard.css">

	<title>Precision Health Community</title>
</head>
<body>

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>
						<?php echo $result->num_rows; ?>
						</h3>
						<p>Total User</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3>0</h3>
						<p>Inactive Users</p>
					</span>
				</li>
			</ul>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->
	

	<script src="script.js"></script>
</body>
</html>