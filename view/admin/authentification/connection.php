<?php

// Database connection settings
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_sample_db"; // The database name that includes both tables

// Create a PDO connection
try {
    // Set DSN (Data Source Name)
    $dsn = "mysql:host=$dbhost;dbname=$dbname;charset=utf8"; 
    $con = new PDO($dsn, $dbuser, $dbpass);
    
    // Set PDO error mode to exception for easier debugging
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // If the connection fails, display an error message
    die("Connection failed: " . $e->getMessage());
}

// Optionally, call the function to check and add the admin if needed
include("functions.php");

?>
