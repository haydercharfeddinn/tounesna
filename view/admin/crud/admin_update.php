<?php

@include 'config.php';

$id = $_GET['edit'];

if (isset($_POST['update_user'])) {

    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp_name = $_FILES['user_image']['tmp_name'];
    $user_image_folder = 'uploaded_img/' . $user_image;

    if (empty($user_name) || empty($user_email) || empty($user_image)) {
        $message[] = 'Please fill out all fields!';
    } else {
        $update_data = "UPDATE users SET name='$user_name', email='$user_email', image='$user_image' WHERE id = '$id'";
        $upload = mysqli_query($conn, $update_data);

        if ($upload) {
            move_uploaded_file($user_image_tmp_name, $user_image_folder);
            header('location:admin_page.php');
        } else {
            $message[] = 'Could not update the user!';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/style.css">
   <title>Update User</title>
   <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

:root {
    --green: #27ae60;
    --black: #333;
    --white: #fff;
    --bg-color: #eee;
    --box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .1);
    --border: .1rem solid var(--black);
}

* {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    outline: none;
    border: none;
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

.btn {
    display: block;
    width: 100%;
    cursor: pointer;
    border-radius: .5rem;
    margin-top: 1rem;
    font-size: 1.7rem;
    padding: 1rem 3rem;
    background: var(--green);
    color: var(--white);
    text-align: center;
    transition: background-color 0.3s ease;
}

.btn:hover {
    background: var(--black);
}

.message {
    display: block;
    background: var(--bg-color);
    padding: 1.5rem 1rem;
    font-size: 2rem;
    color: var(--black);
    margin-bottom: 2rem;
    text-align: center;
}

.container {
    max-width: 1200px;
    padding: 2rem;
    margin: 0 auto;
}

.admin-user-form-container.centered {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.admin-user-form-container form {
    max-width: 50rem;
    margin: 0 auto;
    padding: 2rem;
    border-radius: .5rem;
    background: var(--white);
    box-shadow: var(--box-shadow);
}

.admin-user-form-container form h3 {
    text-transform: uppercase;
    color: var(--black);
    margin-bottom: 1rem;
    text-align: center;
    font-size: 2.5rem;
}

.admin-user-form-container form .box {
    width: 100%;
    border-radius: .5rem;
    padding: 1.2rem 1.5rem;
    font-size: 1.7rem;
    margin: 1rem 0;
    background: var(--bg-color);
    text-transform: none;
    transition: border-color 0.3s ease;
}

.admin-user-form-container form .box:focus {
    border-color: var(--green);
}

.product-display {
    margin: 2rem 0;
}

.product-display .product-display-table {
    width: 100%;
    text-align: center;
}

.product-display .product-display-table thead {
    background: var(--bg-color);
}

.product-display .product-display-table th {
    padding: 1rem;
    font-size: 2rem;
}

.product-display .product-display-table td {
    padding: 1rem;
    font-size: 2rem;
    border-bottom: var(--border);
}

.product-display .product-display-table .btn:first-child {
    margin-top: 0;
}

.product-display .product-display-table .btn:last-child {
    background: crimson;
}

.product-display .product-display-table .btn:last-child:hover {
    background: var(--black);
}

@media (max-width: 991px) {
    html {
        font-size: 55%;
    }
}

@media (max-width: 768px) {
    .product-display {
        overflow-y: scroll;
    }

    .product-display .product-display-table {
        width: 80rem;
    }
}

@media (max-width: 450px) {
    html {
        font-size: 50%;
    }

    .admin-user-form-container form {
        padding: 1.5rem;
    }

    .btn {
        font-size: 1.5rem;
    }

    .admin-user-form-container form h3 {
        font-size: 2rem;
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

    <div class="admin-user-form-container centered">

        <?php
        $select = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
        while ($row = mysqli_fetch_assoc($select)) {
        ?>
        
        <form action="" method="post" enctype="multipart/form-data">
            <h3 class="title">Update the User</h3>
            <input type="text" class="box" name="user_name" value="<?php echo $row['name']; ?>" placeholder="Enter the user name">
            <input type="email" class="box" name="user_email" value="<?php echo $row['email']; ?>" placeholder="Enter the user email">
            <input type="file" class="box" name="user_image" accept="image/png, image/jpeg, image/jpg">
            <input type="submit" value="Update User" name="update_user" class="btn">
            <a href="admin_page.php" class="btn">Go Back!</a>
        </form>

        <?php }; ?>

    </div>

</div>

</body>
</html>
