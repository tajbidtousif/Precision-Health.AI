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
		$mail->Password = 'omenzsgmwgchsdfr';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port = 465;


		$mail->setFrom('tajbidtousif@gmail.com','CSE 4400');
		$mail->addAddress($email);

		$msg = $description.$verification_code;

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
