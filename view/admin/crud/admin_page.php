<?php

@include 'config.php';

if (isset($_POST['add_user'])) {

    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp_name = $_FILES['user_image']['tmp_name'];
    $user_image_folder = 'uploaded_img/' . $user_image;

    if (empty($user_name) || empty($user_email) || empty($user_image)) {
        $message[] = 'Please fill out all fields';
    } else {
        $insert = "INSERT INTO users(name, email, image) VALUES('$user_name', '$user_email', '$user_image')";
        $upload = mysqli_query($conn, $insert);
        if ($upload) {
            move_uploaded_file($user_image_tmp_name, $user_image_folder);
            $message[] = 'New user added successfully';
        } else {
            $message[] = 'Could not add the user';
        }
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    header('location:admin_page.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

:root {
    --green: #27ae60;
    --dark-green: #2c3e50;
    --black: #333;
    --white: #fff;
    --bg-color: #f4f6f9;
    --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
    --border: .1rem solid var(--black);
    --hover-green: #218c55;
    --btn-hover-color: #2c3e50;
}

* {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none;
    text-decoration: none;
    text-transform: capitalize;
}

html {
    font-size: 62.5%;
    overflow-x: hidden;
}

body {
    background: var(--bg-color);
    color: var(--black);
}

h3 {
    font-size: 2.5rem;
    color: var(--dark-green);
    text-align: center;
    margin-bottom: 1rem;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.admin-user-form-container {
    display: flex;
    justify-content: center;
    min-height: 100vh;
    align-items: center;
}

.admin-user-form-container form {
    background: var(--white);
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--box-shadow);
    width: 100%;
    max-width: 50rem;
}

.admin-user-form-container form input[type="text"],
.admin-user-form-container form input[type="email"],
.admin-user-form-container form input[type="file"] {
    width: 100%;
    padding: 1.2rem 1.5rem;
    margin: 1.2rem 0;
    border-radius: 8px;
    background: #f7f7f7;
    font-size: 1.6rem;
    border: 1px solid #ddd;
}

.admin-user-form-container form input[type="file"] {
    padding: 1rem;
}

.admin-user-form-container form .btn {
    width: 100%;
    background: var(--green);
    color: var(--white);
    padding: 1.5rem;
    font-size: 1.8rem;
    text-align: center;
    border-radius: 8px;
    cursor: pointer;
    margin-top: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: background 0.3s;
}

.admin-user-form-container form .btn:hover {
    background: var(--hover-green);
}

.message {
    background-color: #e3f2fd;
    padding: 1.5rem;
    margin: 2rem 0;
    font-size: 1.8rem;
    color: var(--black);
    text-align: center;
    border-radius: 8px;
    box-shadow: var(--box-shadow);
}

.user-display {
    margin-top: 3rem;
    background: var(--white);
    border-radius: 8px;
    padding: 2rem;
    box-shadow: var(--box-shadow);
}

.user-display table {
    width: 100%;
    border-collapse: collapse;
    text-align: left;
    margin-top: 2rem;
}

.user-display th, .user-display td {
    padding: 1.5rem;
    font-size: 1.8rem;
    text-align: center;
}

.user-display th {
    background: var(--bg-color);
    color: var(--dark-green);
}

.user-display td {
    border-bottom: var(--border);
}

.user-display td img {
    border-radius: 50%;
    max-width: 80px;
    height: 80px;
    object-fit: cover;
}

.user-display .btn {
    background: #3498db;
    color: var(--white);
    padding: 1rem 2rem;
    font-size: 1.5rem;
    border-radius: 5px;
    transition: background 0.3s;
}

.user-display .btn:hover {
    background: var(--btn-hover-color);
}

.user-display .btn:first-child {
    background: #2ecc71;
}

.user-display .btn:first-child:hover {
    background: #27ae60;
}

.user-display .btn:last-child {
    background: #e74c3c;
}

.user-display .btn:last-child:hover {
    background: crimson;
}

@media (max-width: 768px) {
    html {
        font-size: 55%;
    }

    .user-display table {
        width: 100%;
        overflow-y: auto;
        font-size: 1.5rem;
    }

    .user-display td, .user-display th {
        padding: 1rem;
    }

    .admin-user-form-container form {
        padding: 1.5rem;
        width: 90%;
    }
}

@media (max-width: 450px) {
    html {
        font-size: 50%;
    }

    .admin-user-form-container form .box {
        font-size: 1.4rem;
    }

    .admin-user-form-container form .btn {
        font-size: 1.6rem;
        padding: 1rem 2rem;
    }
}

   </style>
</head>
<body>

<?php

if (isset($message)) {
    foreach ($message as $message) {
        echo '<span class="message">' . $message . '</span>';
    }
}

?>
   
<div class="container">

   <div class="admin-user-form-container">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new user</h3>
         <input type="text" placeholder="Enter user name" name="user_name" class="box">
         <input type="email" placeholder="Enter user email" name="user_email" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="user_image" class="box">
         <input type="submit" class="btn" name="add_user" value="Add User">
      </form>
   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM users");

   ?>
   <div class="user-display">
      <table class="user-display-table">
         <thead>
         <tr>
            <th>User Image</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Action</th>
         </tr>
         </thead>
         <?php while ($row = mysqli_fetch_assoc($select)) { ?>
         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>
               <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> Edit </a>
               <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> Delete </a>
            </td>
         </tr>
         <?php } ?>
      </table>
   </div>

</div>

</body>
</html>
