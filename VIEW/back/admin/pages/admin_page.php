<?php

include 'config.php';

session_start();

// Ensure admin ID is set in session
if (!isset($_SESSION['admin_id'])) {
   header('location:login.php');
   exit();
}

$admin_id = $_SESSION['admin_id'];

echo 'Admin ID: ' . $admin_id;  // Debugging: Checking if Admin ID is set correctly
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<h1 class="title"> <span>admin</span> profile page </h1>

<section class="profile-container">

   <?php
      // Fetch admin profile data from database
      $select_profile = $conn->prepare("SELECT * FROM users WHERE id = ?");
      $select_profile->execute([$admin_id]);
      $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

      // Check if profile data is returned
      if ($fetch_profile) {
   ?>
   
   <div class="profile">
      <img src="uploaded_img/<?= htmlspecialchars($fetch_profile['image']); ?>" alt="Profile Image">
      <h3><?= htmlspecialchars($fetch_profile['name']); ?></h3>
      <a href="admin_profile_update.php" class="btn">update profile</a>
      <a href="logout.php" class="delete-btn">logout</a>
      <div class="flex-btn">
         <a href="login.php" class="option-btn">login</a>
         <a href="register.php" class="option-btn">register</a>
      </div>
   </div>

   <?php
      } else {
         // If no profile data is found
         echo "<p>No profile found for this admin. Please check the admin ID in the database.</p>";
      }
   ?>

</section>

</body>
</html>
