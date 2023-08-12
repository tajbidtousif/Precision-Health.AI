
<?php
include "config.php";
session_start();

if (!isset($_SESSION['id'])) {
	header("Location: index.php");
}

?>
<!DOCTYPE html>
<html lang="en">

 	<head>
 		<!-- Meta Tags -->
		<meta charset="UTF-8">
		<meta name="author" content="Null_Void">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Site Title -->
 		<title>PHP Signup with OTP Email Verification System</title>
 		<!-- External Style Sheet -->
		<link rel="stylesheet" type="text/css" href="css/style.css" />

 	</head>
<body>
	<div class="wrapper" id="login-side">

		<div class="container">
			<h1>Welcome <?php if(isset($_COOKIE['username'])){ echo $_COOKIE['username']; }?></h1>
			<a href="logout.php">Logout</a>
		</div>
		
	</div>
</body>

<script type="text/javascript" src="js/jquery.min.3-4-1.js"></script>

</html>