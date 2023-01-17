<?php 

session_start();
session_destroy();

// Redirecting to the Login Page
header("LOCATION:login.php"); 

?>
