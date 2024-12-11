<?php
require_once 'config.php'; // Include the config file

try {
    $db = config::getConnexion(); // Attempt to connect to the database
    echo "Database connected successfully!";
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>