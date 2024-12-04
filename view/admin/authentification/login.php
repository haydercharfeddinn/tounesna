<?php 
session_start();

include("connection.php");
include_once("functions.php");

$message = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Retrieve and sanitize input data
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        // Prepare the SQL statement to prevent SQL injection
        $stmt = $con->prepare("SELECT user_id, password, user_type FROM users WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        // Check if user exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $hashed_password, $user_type);
            $stmt->fetch();

            // Verify the password using password_verify
            if (password_verify($password, $hashed_password)) {
                // Set session variables
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_type'] = $user_type;

                // Redirect based on user type
                if ($user_type === 'admin') {
                    header("Location: hash_password.php"); // Admin page
                } else {
                    header("Location: home.php"); // Normal user home page
                }
                die;
            } else {
                $message = "Wrong email or password!";
            }
        } else {
            $message = "Wrong email or password!";
        }

        $stmt->close();
    } else {
        $message = "Please enter valid email and password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
    <div class="title">Login</div>
    <form method="post">
        <?php if (isset($message)) { echo '<div class="error-message">'.$message.'</div>'; } ?>

        <input type="email" name="email" placeholder="Email Address" required><br>

        <input type="password" name="password" placeholder="Password" required><br>

        <input id="button" type="submit" value="Login"><br>

        <a href="signup.php">Click here to Signup</a>
    </form>
</div>

</body>
</html>
