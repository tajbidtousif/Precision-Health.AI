<?php
include "config.php";
include "mail_service.php";
session_start();

if (isset($_SESSION['id'])) {
	header("Location: service.php");
}

// LOGIN PROCESS CODE
if (isset($_POST['login'])) {
	
	$email = $_POST['email'];
	$password = mysqli_real_escape_string($conn, md5($_POST['password']));

	$sqlLogin = "SELECT * FROM user WHERE email ='".$email."' AND password = '".$password."' AND status = 'active'";
	
	$resultLogin = mysqli_query($conn, $sqlLogin);

	if (mysqli_num_rows($resultLogin) > 0) {

		// Check if 'rememberme' is set in $_POST array
		$rememberme = isset($_POST['rememberme']) ? $_POST['rememberme'] : '';

		if ($rememberme == "checked") {
			setcookie('email', $email);
			setcookie('password', $password);
		}
		else{
			setcookie('email', '');
			setcookie('password', '');
		}
		
		if($rowLogin = mysqli_fetch_assoc($resultLogin)){

			$_SESSION['id'] = $rowLogin['uid'];
			$name = $rowLogin['name'];

			$role = $rowLogin['role']; // Fetch the user role from the database

			if ($role == 'user') {
				$_SESSION['id'] = $rowLogin['uid'];
				$_SESSION['name'] = $rowLogin['name'];
				$_SESSION['role'] = 'user';
				header("Location: service.php"); // Redirect to the landing page for users
				exit();
			} elseif ($role == 'admin') {
				$_SESSION['id'] = $rowLogin['uid'];
				$_SESSION['name'] = $rowLogin['name'];
				$_SESSION['role'] = 'admin';
				header("Location: admin-panel/admin_dashboard.php"); // Redirect to the admin dashboard for admins
				exit();
			} else {
				echo "<script>alert('Unknown role');</script>";
			}
		}else{
			echo "<script>alert('Opss something wrong..');</script>";
		}
	}
	else{
		echo "<script>alert('No user exist with this email OR wrong password');</script>";
	}
}



// SINGUP PROCESS CODE 
$otp_str = str_shuffle("0123456789");
$otp = substr($otp_str, 0, 5);

$act_str = rand(100000, 10000000);
$activation_code = str_shuffle("abcdefghijklmno".$act_str);

if (isset($_POST['register'])) {
	
	$otp = $_POST['otp'];
	$activation_code = $_POST['activation_code'];
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, md5($_POST['password']));

	$selectDatabase = "SELECT * FROM user WHERE email = '".$email."'";
	$selectResult = mysqli_query($conn, $selectDatabase);
	if (mysqli_num_rows($selectResult) > 0) {
		
		$selectRow = mysqli_fetch_assoc($selectResult);

		echo $status = $selectRow['status'];

		if ($status == 'active') {
			
			echo "<script>alert('Email already registered')</script>";
		}
		else{

			$sqlUpdate = "UPDATE user SET name = '".$name."', password = '".$password."', otp = '".$otp."', activation_code = '".$activation_code."', role = 'user' WHERE email = '".$email."'";
			$updateResult = mysqli_query($conn, $sqlUpdate);

			if ($updateResult) {
				require 'class/class.phpmailer.php';
				
				// Your email verification code and other logic here...

				echo '<script>alert("Please Check Your Email for Verification Code");</script>';
				header('Refresh:1; url=email_verify.php?code='.$activation_code);
			}
		}
	}
	else{
		$email=$email;
		$verification_code = $otp;

		// Your email verification code and other logic here...

		$sqlInsert = "INSERT INTO user (name, email, password, otp, activation_code, role) VALUES ('".$name."', '".$email."', '".$password."', '".$otp."', '".$activation_code."', 'user')";
		$insertResult = mysqli_query($conn, $sqlInsert);

		if ($insertResult) {
			echo '<script>alert("Please Check Your Email for Verification Code");</script>';
			header('Refresh:1; url=email_verify.php?code='.$activation_code);
		}
		else{
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
					<input type="email" name="email" placeholder="Email" value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; }?>" autocomplete="off" required>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password']; }?>"autocomplete="off" required>
				</div>
				<div class="form-group extra">
					<input type="checkbox" name="rememberme" value="checked" <?php if(isset($_COOKIE['email'])){ echo 'checked'; }?>><label class="rem">Remember me</label>
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
	</div> <!-- End of Login Wrapper -->
	
	
	<div class="wrapper display" id="signup-side">
		<div class="left-side signUp">
			<h2>Signup</h2>
			<hr>		
			<form action="" method="POST" onsubmit="return validation()">			

				<input type="hidden" name="otp" value="<?php echo $otp; ?>">
				<input type="hidden" name="activation_code" value="<?php echo $activation_code; ?>">

				<div class="form-group">
					<label>Name</label>
					<input type="text" name="name" id="name" placeholder="Your Name" autocomplete="off" class = "form-control" required>
					<span id="nameerror" style="color: red;"></span>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="email" id="email" placeholder="Email" autocomplete="off" class = "form-control" required>
				    <span id="emailerror" style="color: red;"></span>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" id="password" placeholder="Password" class = "form-control" required>
					<span id="passworderror" style="color: red;"></span>
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

            var namecheck = /^[A-Za-z. ]{3,30}$/;
            var emailcheck = /^[A-Za-z0-9_]{3,}@[A-Za-z]{3,}[.]{1}[A-Za-z.]{2,6}$/;
            var passwordcheck = /^(?=.*[0-9])(?=.*[!@#$%^&*])[A-Za-z0-9!@#$%^&*]{6,16}$/;

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
        }
    </script>
	
	
	<!-- End of Signup Wrapper -->

</body>

<script type="text/javascript" src="js/jquery.min.3-4-1.js"></script>
<script>
	$(document).ready(function(){
		$('#signup-button').click(function(){
			$('#login-side').fadeOut().addClass('display');
			$('#signup-side').fadeIn().removeClass('display');			
		});
		$('#login-button').click(function(){
			$('#signup-side').fadeOut().addClass('display');
			$('#login-side').fadeIn().removeClass('display');	
		});
	});
</script>

</html>