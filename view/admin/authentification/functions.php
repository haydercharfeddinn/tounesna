<?php

// Check if the session has an active user and return user data
function check_login($con)
{
    if (isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];

        // Use prepared statement to prevent SQL injection
        $stmt = $con->prepare("SELECT user_id, user_name, user_type FROM users WHERE user_id = ? LIMIT 1");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($user_id, $user_name, $user_type);
            $stmt->fetch();
            return [
                'user_id' => $user_id,
                'user_name' => $user_name,
                'user_type' => $user_type
            ];
        }
    }
    
    // Redirect to login if session is not valid
    header("Location: login.php");
    die;
}


function random_num($length)
{
    // Ensure length is at least 5
    $length = max(5, $length);

    $text = "";
    for ($i = 0; $i < $length; $i++) {
        $text .= rand(0, 9); // Add random digit
    }

    return $text;
}

?>
