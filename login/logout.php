<?php 

session_start();
session_destroy();

// Redirecting to the Login Page
header("Location:login.php"); 

?>
