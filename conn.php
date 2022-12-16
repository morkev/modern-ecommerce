<?php
   // Settings :: view errors
   // ini_set('display_errors',1);
   // ini_set('display_startup_erros',1);
   // error_reporting(E_ALL);

   // Start a session
   session_start();

   $hostname_conn = "localhost";
   $database_conn = "database_name";
   $username_conn = "root";
   $password_conn = "your_password";

   // Connect to MySQL database
   $conn = mysqli_connect($hostname_conn, $username_conn, $password_conn, $database_conn);
   if(!$conn) {
      echo "Error connecting to MySQL."; 
      exit;
   }
?>