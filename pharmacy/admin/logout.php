<?php
//include constants for SITEURL
include('../config/constants.php');
//1.Destroy session 
session_destroy();//unset $_SESSION['user']
//2 Redirect to login page
header('location:'.SITEURL.'admin/login.php');
?>