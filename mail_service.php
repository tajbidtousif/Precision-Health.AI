<?php
include "config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'class/class.phpmailer.php';




function sendVerifcationEmail($email, $verification_code, $description): bool
{
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';

	$mail = new PHPMailer(true);
	
	try{
		$mail ->isSMTP();
		$mail->Host     = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'tajbidtousif@gmail.com';
		$mail->Password = 'opmdrhayomkzxwii';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port = 465;


		$mail->setFrom('tajbidtousif@gmail.com','PrecisionHealth.AI');
		$mail->addAddress($email);

		$msg =  "Thank you for choosing PrecisionHealth.AI for your healthcare needs. As part of our commitment to ensuring the security of your account, we are sending you a One-Time Password (OTP) for verification purposes.Thank you for your cooperation.  Your OTP is: " . $verification_code;

		$mail->isHTML(true);
		$mail->Subject = "Account Verification";
		$mail->Body = $msg;
		$mail->AltBody =  'This is the body in plain text for non-HTML mail client';

		$mail->send();

	} catch(Exception){
		echo "<script>('$e')</script>";
		return false;
	}

	return true;
	
}



?> 
