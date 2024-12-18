<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'config.php';

$message = ''; // Initialize the message variable

if (isset($_POST['reset'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Check if the email exists in the database
    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select->execute([$email]);
    $user = $select->fetch(PDO::FETCH_ASSOC);

    if ($select->rowCount() > 0) {
        $reset_code = bin2hex(random_bytes(50)); // Generate random reset code
        $reset_expiry = date("Y-m-d H:i:s", strtotime('+30 minutes')); // Valid for 30 minutes

        // Update reset code and expiry in the database
        $update = $conn->prepare("UPDATE `users` SET reset_code = ?, reset_expiry = ? WHERE email = ?");
        $update->execute([$reset_code, $reset_expiry, $email]);

        // Send the reset email
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'hsinigaylen@gmail.com'; // Your Gmail address
            $mail->Password = 'byfbcxucnpgerzec'; // Your Gmail SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('hsinigaylen@gmail.com', 'Dashboard');
            $mail->addAddress($email); // Recipient's email

            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request';
            $reset_link = "http://localhost/mico-html1/VIEW/back/dashboard/pages/reset_password.php?reset_code=$reset_code";
            $mail->Body = "
                <h2>Password Reset Request</h2>
                <p>Click the link below to reset your password:</p>
                <a href='$reset_link'>$reset_link</a>
                <p>This link will expire in 30 minutes.</p>
            ";

            $mail->send();
            // Show success message
            $message = '<p style="color: green;">Password reset email sent! Check your inbox.</p>';
        } catch (Exception $e) {
            $message = '<p style="color: red;">Error: Unable to send email. ' . $mail->ErrorInfo . '</p>';
        }
    } else {
        $message = '<p style="color: red;">No account found with that email address.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        /* Add your styles here */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: #111;
            color: #ddd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: linear-gradient(145deg, #222, #444);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
            width: 100%;
            max-width: 380px;
            text-align: center;
        }

        .form-container h2 {
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: bold;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .form-container .box {
            width: 100%;
            padding: 15px;
            margin: 15px 0;
            border-radius: 8px;
            border: 1px solid #555;
            background: #222;
            color: #fff;
            font-size: 16px;
            transition: 0.3s ease;
        }

        .form-container .box:focus {
            outline: none;
            border-color: #f44336;
            background: #333;
        }

        .form-container .btn {
            width: 100%;
            padding: 15px;
            background: #111;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(244, 67, 54, 0.6);
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container .btn:hover {
            background: #333;
            box-shadow: 0 4px 15px rgba(244, 67, 54, 0.8);
        }

        .form-container p {
            font-size: 14px;
            color: #aaa;
            margin-top: 10px;
        }

        .form-container p a {
            color: #f44336;
            text-decoration: none;
            font-weight: bold;
        }

        .form-container p a:hover {
            text-decoration: underline;
        }

        .message {
            color: green;
            font-size: 14px;
            margin-top: 20px;
        }

    </style>
</head>
<body>
    <section class="form-container">
        <form action="" method="post">
            <h2>Reset Password</h2>
            <input type="email" name="email" placeholder="Enter your email" class="box" required>
            <button type="submit" name="reset" class="btn">Send Reset Link</button>
        </form>
        <?php
            // Display the message after email sending attempt
            if ($message) {
                echo '<div class="message">' . $message . '</div>';
            }
        ?>
    </section>
</body>
</html>
