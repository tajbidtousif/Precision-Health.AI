<?php
include "config.php";
session_start();

if (isset($_SESSION['id'])) {
	
	setcookie('username', "");

	if (session_destroy()) {
		
		header("Location: landingpage.php");
	}
}