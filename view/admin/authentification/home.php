<?php 
session_start();

// Check if the user is logged in and is a normal user
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'normal') {
    header("Location: login.php");
    die;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <!-- Add your home page styles here -->
</head>
<body>
    <h1>Welcome to the User Dashboard</h1>
    <p>This is the home page for normal users.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
