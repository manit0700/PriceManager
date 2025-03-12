<?php
// Manit Bhaveshkumar Dankhara ID: 1002117492
// Christopher Pressley ID: 1001377684

// Database connection settings
$servername = "localhost";
$username = "root";  // Default username for MySQL
$password = "";      // Default password for MySQL (empty)
$dbname = "bestPriceStore";  // The name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    // print_r("Connected");
}
?>
