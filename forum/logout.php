<?php
ob_start(); 
//access the existing session 
session_start(); 
//remove all the session variables 
session_unset(); 
// destroy the user session 
session_destroy(); 
//redirect back to the login page 
header('location:login.php'); 

ob_flush(); 
?>