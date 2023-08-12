<?php 
include "config.php";
include "mail_service.php";
session_start();

$basename = basename($_SERVER['HTTP_REFERER']);
$basname_replace = str_replace($basename, "reset_password.php", $_SERVER['HTTP_REFERER']);

$str_code = rand(100000, 10000000);
$reset_code = str_shuffle("abcdefghijklmnopqrstuvwxyz".$str_code);

$url = $basname_replace."?resetLink=".$reset_code;

if (isset($_POST['resetLink'])) {
	
	$email = mysqli_real_escape_string($conn, $_POST['email']);

	$sqlSelect = "SELECT * FROM user WHERE email = '".$email."' AND status = 'active'";
	$resultSelect = mysqli_query($conn, $sqlSelect);
	if (mysqli_num_rows($resultSelect) > 0) {
		// SINGUP PROCESS CODE 
		$otp_str = str_shuffle("0123456789");
		$otp = substr($otp_str, 0, 5);
		$sqlUpdate = "UPDATE user SET otp = '".$otp."' WHERE email = '".$email."'";
		//echo $sqlUpdate. " " . strval($otp);
		$updateResult = mysqli_query($conn, $sqlUpdate);

		if($updateResult){			
			$description = "To reset password please use this code to verify your authinticity";
			if(sendVerifcationEmail($email, $otp,$description)){
				$sqlUpdate = "UPDATE user SET reset_code = '".$reset_code."' WHERE email = '".$email."'";
				$resultUpdate = mysqli_query($conn, $sqlUpdate);
				if ($resultUpdate) {
					echo '<script>alert("Please Check Your Email for reset password")</script>';
					
					$_SESSION['forgot_password_email']=$email;
					
					header('Refresh:1; url=reset_password.php');
				}
				else{
					echo "<script>alert('opss something wrong...');</script>";
				}
			}
			else{
				echo "<script>alert('error sending email...');</script>";
			}
		}
		

		
	}
	else{
		echo "<script>alert('No account found...');</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">

 	<head>
 		<!-- Meta Tags -->
		<meta charset="UTF-8">
		<meta name="author" content="Tajbid Tousif">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Site Title -->
 		<title>PHP Signup with OTP Email Verification System</title>
 		<!-- External Style Sheet -->
		<link rel="stylesheet" type="text/css" href="css/style.css" />

 	</head>
<body>
	<div class="wrapper">
		<div class="otp">
			<h2>Forgot Password</h2>
			<hr>		
			<form action="" method="POST">
				<div class="form-group">
					<label>Registered Email</label>
					<input type="email" name="email" placeholder="Enter your registered email" autocomplete="off">
				</div>
				<div class="form-group">
					<label></label>
					<input type="submit" name="resetLink" value="Submit">
				</div>
			</form>
		</div>
	</div>
	<!-- End of Login Wrapper -->
</body>

<script type="text/javascript" src="js/jquery.min.3-4-1.js"></script>

</html>