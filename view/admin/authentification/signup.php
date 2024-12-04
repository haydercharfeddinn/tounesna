<?php 
session_start();

include("connection.php");



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve and sanitize input data
    $user_name = trim($_POST['user_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    
    // Basic validation
    if (!empty($user_name) && !empty($email) && !empty($password) && !is_numeric($user_name)) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Generate a unique user ID
        $user_id = random_num(20);
        
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $con->prepare("INSERT INTO users (user_id, user_name, email, password, user_type) VALUES (?, ?, ?, ?, 'normal')");
        $stmt->bind_param("ssss", $user_id, $user_name, $email, $hashed_password);
        
        // Execute the statement
        if ($stmt->execute()) {
            header("Location: login.php");
            die;
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "Please enter valid information!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: #f3f4f6;
            color: #333;
        }

        #box {
            width: 300px;
            padding: 30px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 100px auto;
        }

        .title {
            font-size: 1.6rem;
            font-weight: 500;
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #4CAF50;
            border: none;
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            border-radius: 4px;
        }

        input[type="submit"]:hover {
            background: #45a049;
        }

        .error-message {
            color: red;
            font-size: 1rem;
            margin-bottom: 15px;
            text-align: center;
        }

        a {
            text-decoration: none;
            color: #4CAF50;
            display: block;
            text-align: center;
            margin-top: 10px;
        }

        a:hover {
            color: #45a049;
        }
    </style>
</head>
<body>

<div id="box">
    <div class="title">Signup</div>
    <form method="post">
        <?php if (isset($message)) { echo '<div class="error-message">'.$message.'</div>'; } ?>

        <input type="text" name="user_name" placeholder="Name" required><br>

        <input type="email" name="email" placeholder="Email" required><br>

        <input type="password" name="password" placeholder="Password" required><br>

        <input id="button" type="submit" value="Signup"><br>

        <a href="login.php">Click here to Login</a>
    </form>
</div>

</body>
</html>
