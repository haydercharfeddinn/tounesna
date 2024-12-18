<?php
include 'config.php';

if (isset($_GET['reset_code'])) {
    $reset_code = $_GET['reset_code'];

    // Check if the reset code is valid and not expired
    $select = $conn->prepare("SELECT * FROM users WHERE reset_code = ? AND reset_expiry > NOW()");
    $select->execute([$reset_code]);
    $user = $select->fetch(PDO::FETCH_ASSOC);

    if ($select->rowCount() > 0) {
        if (isset($_POST['new_password'])) {
            $new_password = md5($_POST['new_password']);
            
            // Update password and clear reset code
            $update = $conn->prepare("UPDATE users SET password = ?, reset_code = NULL, reset_expiry = NULL WHERE reset_code = ? ");
            $update->execute([$new_password, $reset_code]);
            echo '<p style="color: green;">Your password has been updated!</p>';
        }
    } else {
        echo '<p style="color: red;">Invalid or expired reset link.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    <form action="login.php" method="post">
        <h2>Set a New Password</h2>
        <input type="password" name="new_password" placeholder="Enter new password" required>
        <button type="submit">Update Password</button>
    </form>
</body>
</html>