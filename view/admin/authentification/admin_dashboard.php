<?php 
session_start();

include("connection.php");
include("functions.php");

// Check if the user is logged in
$user_data = check_login($con);

// Redirect non-admin users to the homepage
if ($user_data['user_type'] !== 'admin') {
    header("Location: home.php");
    die;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        background: #f3f4f6;
        color: #333;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 2rem;
        background: #4CAF50;
        color: #fff;
    }

    header a {
        text-decoration: none;
        color: #fff;
        font-size: 1.6rem;
        font-weight: 500;
        background: #f44336;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        transition: background 0.3s;
    }

    header a:hover {
        background: #d32f2f;
    }

    h1 {
        text-align: center;
        margin-top: 3rem;
        font-size: 2.8rem;
        color: #4CAF50;
    }

    .welcome-message {
        text-align: center;
        margin-top: 1.5rem;
        font-size: 2rem;
        color: #555;
    }

    main {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 80vh;
    }

    footer {
        text-align: center;
        padding: 1rem 0;
        background: #4CAF50;
        color: #fff;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
    </style>
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
    <a href="logout.php">Logout</a>
</header>

<main>
    <h2>Welcome to the Admin Dashboard</h2>
    <p>Hello, <?php echo $user_data['user_name']; ?></p>
</main>

<footer>
    &copy; 2024 Your Website. All Rights Reserved.
</footer>

</body>
</html>
