<?php
session_start();

// Unset all session variables
$_SESSION = array();

session_destroy();


header("Location: /Project-4800/index.php"); 
exit();
