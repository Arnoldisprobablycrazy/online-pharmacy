<?php 
//session start
  session_start();
  //create constants to store non repaeting values
  define('SITEURL', 'http://localhost/pharmacy/');
  define('LOCALHOST', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD','');
  define('DB_NAME', 'drug-order');

  $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD)or die(mysqli_error());//database connection
  $db_select = mysqli_select_db($conn, 'drug-order')or die(mysqli_error());//selecting database

  
 ?>