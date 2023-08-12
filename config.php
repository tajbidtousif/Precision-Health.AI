<?php 

$conn = mysqli_connect("localhost", "root", "", "otp_verification");

if (!$conn) {
	echo "Connection Failed ".mysqli_connect_error() or die();
}
