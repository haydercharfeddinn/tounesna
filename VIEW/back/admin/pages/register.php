
<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = md5($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);
    $cpass = md5($_POST['cpass']);
    $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = 'uploaded_img/' . $image;

    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
    $select->execute([$email]);

    if ($select->rowCount() > 0) {
        $message[] = 'User already exists!';
    } else {
        if ($pass != $cpass) {
            $message[] = 'Confirm password not matched!';
        } elseif ($image_size > 2000000) {
            $message[] = 'Image size is too large!';
        } else {
            $insert = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUES(?,?,?,?)");
            $insert->execute([$name, $email, $cpass, $image]);
            if ($insert) {
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[] = 'Registered successfully!';
                header('location:login.php');
            }
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
   <title>Register</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <style>
/* Global Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

/* Body Styling */
body {
  font-family: 'Arial', sans-serif;
  background: #111; /* Black background */
  color: #ddd; /* Soft gray text */
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  overflow: hidden;
}

/* Message Box */
.message {
  position: fixed;
  top: 20px;
  right: 20px;
  background-color: #ff4747;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
  font-size: 14px;
  display: flex;
  align-items: center;
}

.message i {
  cursor: pointer;
  margin-left: 10px;
}

/* Form Container */
.form-container {
  background: linear-gradient(145deg, #222, #444); /* Gradient dark background */
  padding: 50px;
  border-radius: 12px;
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
  width: 450px; /* Increased width */
  height: 450px; /* Increased height */
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}

/* Form Header */
.form-container h3 {
  margin-bottom: 30px;
  font-size: 28px;
  font-weight: bold;
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 1.5px;
}

/* Input Fields */
.form-container .box {
  width: 80%; /* Adjust width to fit inside the square */
  padding: 12px;
  margin: 10px 0;
  border-radius: 8px;
  border: 1px solid #555;
  background: #222;
  color: #fff;
  font-size: 16px;
  transition: 0.3s ease;
}

.form-container .box:focus {
  outline: none;
  border-color: #f44336; /* Focus color changed to red */
  background: #333;
}

/* Submit Button */
.form-container .btn {
  width: 80%; /* Adjust width to fit inside the square */
  padding: 12px;
  background: #111; /* Black background */
  color: #fff; /* White text */
  border: none;
  border-radius: 8px;
  font-size: 18px;
  font-weight: bold;
  cursor: pointer;
  box-shadow: 0 4px 10px rgba(244, 67, 54, 0.6); /* Red shadow */
  transition: background 0.3s ease, box-shadow 0.3s ease;
}

.form-container .btn:hover {
  background: #333; /* Darker black on hover */
  box-shadow: 0 4px 15px rgba(244, 67, 54, 0.8); /* Enhanced red shadow */
}

/* Link Styling */
.form-container p {
  font-size: 14px;
  color: #aaa;
  margin-top: 10px;
}

.form-container p a {
  color: #f44336; /* Link color changed to red */
  text-decoration: none;
  font-weight: bold;
}

.form-container p a:hover {
  text-decoration: underline;
}


    </style>


   <script>
   document.addEventListener('DOMContentLoaded', function() {
       const form = document.querySelector('form');
       const emailInput = document.querySelector('input[name="email"]');
       const passInput = document.querySelector('input[name="pass"]');
       const cpassInput = document.querySelector('input[name="cpass"]');

       form.addEventListener('submit', function(event) {
           let isValid = true;

           // Email validation - check for '@' symbol
           if (!emailInput.value.includes('@')) {
               alert('Please enter a valid email address that includes "@"');
               isValid = false;
           }

           // Password validation - check for minimum length
         //   if (passInput.value.length < 6) {
         //       alert('Password must be at least 6 characters long.');
         //       isValid = false;
         //   }

           // Confirm password validation
           if (passInput.value !== cpassInput.value) {
               alert('Passwords do not match.');
               isValid = false;
           }

           if (!isValid) {
               event.preventDefault(); // Prevent form submission if validation fails
           }
       });
   });
   </script>
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $message) {
        echo '
        <div class="message">
            <span>' . $message . '</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
        </div>
        ';
    }
}
?>

<section class="form-container">
    <form action="" method="post" enctype="multipart/form-data">
        <h3>Register Now</h3>
        <input type="text" required placeholder="Enter your username" class="box" name="name">
        <input type="email" required placeholder="Enter your email" class="box" name="email">
        <input type="password" required placeholder="Enter your password" class="box" name="pass">
        <input type="password" required placeholder="Confirm your password" class="box" name="cpass">
        <input type="file" name="image" required class="box" accept="image/jpg, image/png, image/jpeg">
        <p>Already have an account? <a href="login.php">Login now</a></p>
        <input type="submit" value="Register Now" class="btn" name="submit">
    </form>
</section>

</body>
</html>
