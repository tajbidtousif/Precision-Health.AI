<?php
include "config.php";
include "mail_service.php";

session_start();

if (isset($_SESSION['id'])) {
	header("Location: service.php");
}

// LOGIN PROCESS CODE
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);

	$sqlLogin = "SELECT * FROM user WHERE email = '$email' AND status = 'active'";
	$resultLogin = mysqli_query($conn, $sqlLogin);

	if (mysqli_num_rows($resultLogin) == 1) {
		$rowLogin = mysqli_fetch_assoc($resultLogin);
		$hashedPassword = $rowLogin['password']; 

		
		if (strcmp(md5($password), $hashedPassword) == 0) { 
			// Passwords match, proceed with login
			$_SESSION['id'] = $rowLogin['uid'];
			$_SESSION['name'] = $rowLogin['name'];
			$_SESSION['role'] = $rowLogin['role'];

			// Redirect to appropriate dashboard based on user role
			if ($rowLogin['role'] == 'user') {
				header("Location: service.php");
				exit();
			} elseif ($rowLogin['role'] == 'admin') {
				header("Location: admin-panel/admin_dashboard.php");
				exit();
			} elseif ($rowLogin['role'] == 'superadmin') {
				header("Location: super-admin-panel/superAdminDashboard.php");
				exit();
			}
		} else {
			
			echo "<script>alert('Incorrect password');</script>";
		}
	} else {
	
		echo "<script>alert('No user found');</script>";
	}
}



// SINGUP PROCESS CODE 
$otp_str = str_shuffle("0123456789");
$otp = substr($otp_str, 0, 5);

$act_str = rand(100000, 10000000);
$activation_code = str_shuffle("abcdefghijklmno" . $act_str);

if (isset($_POST['register'])) {

	$otp = $_POST['otp'];
	$activation_code = $_POST['activation_code'];
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']); //textfield er man variable e store korlam
	$password = mysqli_real_escape_string($conn, md5($_POST['password']));

	$selectDatabase = "SELECT * FROM user WHERE email = '" . $email . "'";
	$selectResult = mysqli_query($conn, $selectDatabase);
	if (mysqli_num_rows($selectResult) > 0) {

		$selectRow = mysqli_fetch_assoc($selectResult);

		echo $status = $selectRow['status'];

		if ($status == 'active') {

			echo "<script>alert('Email already registered')</script>";
		} else {

			$sqlUpdate = "UPDATE user SET name = '" . $name . "', password = '" . $password . "', otp = '" . $otp . "', activation_code = '" . $activation_code . "', role = 'user' WHERE email = '" . $email . "'";
			$updateResult = mysqli_query($conn, $sqlUpdate);

			if ($updateResult) {
				require 'class/class.phpmailer.php';
				$description = "Thank you for choosing PrecisionHealth.AI for your healthcare needs. As part of our commitment to ensuring the security of your account, we are sending you a One-Time Password (OTP) for verification purposes.Thank you for your cooperation. ";
				sendVerifcationEmail($email, $otp, $description);
				echo '<script>alert("Please Check Your Email for Verification Code");</script>';
				header('Refresh:1; url=email_verify.php?code=' . $activation_code);
			}
		}
	} else {
		$email = $email;
		$verification_code = $otp;

		

		$sqlInsert = "INSERT INTO user (name, email, password, otp, activation_code, role) VALUES ('" . $name . "', '" . $email . "', '" . $password . "', '" . $otp . "', '" . $activation_code . "', 'user')";
		$insertResult = mysqli_query($conn, $sqlInsert);

		if ($insertResult) {
			$description = "add description ";
			sendVerifcationEmail($email, $otp, $description);
			echo '<script>alert("Please Check Your Email for Verification Code");</script>';
			header('Refresh:1; url=email_verify.php?code=' . $activation_code);
		} else {
			echo '<script>alert("Opss something wrong failed to insert data")</script>';
		}
	}
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name="author" content="Triple-T">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>SignUp/SignIn</title>

	<link rel="stylesheet" type="text/css" href="css/style.css" />

</head>

<body>

	<div class="wrapper" id="login-side">
		<div class="left-side">
			<h2>Login</h2>
			<hr>
			<form action="" method="POST">
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" placeholder="Email" value="<?php if (isset($_COOKIE['email'])) {
						echo $_COOKIE['email'];
					} ?>" autocomplete="off" required>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password" value="<?php if (isset($_COOKIE['password'])) {
						echo $_COOKIE['password'];
					} ?>" autocomplete="off" required>
				</div>
				<div class="form-group extra">
					<input type="checkbox" name="rememberme" value="checked" <?php if (isset($_COOKIE['email'])) {
						echo 'checked';
					} ?>><label class="rem">Remember me</label>
					<label class="forgot"><a href="forgot_password.php">Forgot Password?</a></label>
				</div>
				<div class="form-group">
					<label></label>
					<input type="submit" name="login" value="Login">
				</div>
			</form>
		</div>
		<div class="container"></div>
		<div class="right-side" id="singup-text-side">
			<h2>Register</h2>
			<hr>
			<div class="right-side-text">
				<p>Don't have an account?</p>
				<p>Please click to signup button for register</p>
				<a href="javascript:void(0);" id="signup-button">Signup</a>
			</div>
		</div>
	</div> 


	<div class="wrapper display reg-left" id="signup-side">
		<div class="left-side signUp">
			<h2>Sign Up</h2>
			<hr>
			<form action="" method="POST" onsubmit="return validation()">

				<input type="hidden" name="otp" value="<?php echo $otp; ?>">
				<input type="hidden" name="activation_code" value="<?php echo $activation_code; ?>">

				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" id="name" placeholder="Your Name" autocomplete="off"
						class="form-control" required>
					<span id="nameerror" style="color: red;"></span>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" id="email" placeholder="Email" autocomplete="off"
						class="form-control" required>
					<span id="emailerror" style="color: red;"></span>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" id="password" placeholder="Password" class="form-control"
						required>
					<span id="passworderror" style="color: red;"></span>
				</div>
				<div class="form-group">
					<label>Confirm Password</label>
					<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"
						class="form-control" required>
					<span id="confirm_password_error" style="color: red;"></span>
				</div>
				<div class="form-group">
					<label></label>
					<input type="submit" name="register" id="submit" value="Signup">
				</div>
			</form>
		</div>
		<div class="container"></div>
		<div class="right-side" id="login-text-side">
			<h2>Login</h2>
			<hr>
			<div class="right-side-text">
				<p>Already have an account?</p>
				<p>Please click to login button for login</p>
				<a href="javascript:void(0)" id="login-button">Login</a>
			</div>
		</div>
	</div>

	<script>
		function validation() {
			var name = document.getElementById("name").value;
			var email = document.getElementById("email").value;
			var password = document.getElementById("password").value;
			var confirm_password = document.getElementById("confirm_password").value;

			var namecheck = /^[A-Za-z. ]{3,30}$/;
			var emailcheck = /^(cse_([0-9]+)@lus\.ac\.bd|([A-Za-z0-9_]+)@(gmail|yahoo|hotmail)\.com)$/;
			var passwordcheck = /^(?=.*[0-9])(?=.*[!@#$%^&])[A-Za-z0-9!@#$%^&]{6,16}$/;

			// Yo bro! Hash the password using MD5
			var hashed_password = md5(password);

			if (namecheck.test(name)) {
				document.getElementById("nameerror").innerHTML = "";
			} else {
				document.getElementById("nameerror").innerHTML = "** Name is Invalid";
				return false;
			}
			if (emailcheck.test(email)) {
				document.getElementById("emailerror").innerHTML = "";
			} else {
				document.getElementById("emailerror").innerHTML = "** Email is Invalid";
				return false;
			}
			if (passwordcheck.test(password)) {
				document.getElementById("passworderror").innerHTML = "";
			} else {
				document.getElementById("passworderror").innerHTML = "** Password is Invalid";
				return false;
			}
			if (password === confirm_password) {
				document.getElementById("confirm_password_error").innerHTML = "";
			} else {
				document.getElementById("confirm_password_error").innerHTML = "** Passwords do not match";
				return false;
			}
		}
	</script>




</body>

<script type="text/javascript" src="js/jquery.min.3-4-1.js"></script>
<script>
	$(document).ready(function () {
		$('#signup-button').click(function () {
			$('#login-side').fadeOut().addClass('display');
			$('#signup-side').fadeIn().removeClass('display');
		});
		$('#login-button').click(function () {
			$('#signup-side').fadeOut().addClass('display');
			$('#login-side').fadeIn().removeClass('display');
		});
	});
</script>

</html>