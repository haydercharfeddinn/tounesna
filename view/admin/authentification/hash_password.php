<?php
// Hash the password
$password = '2222';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Output the hashed password
echo $hashed_password;
?>
