
<?php
include 'config.php';

session_start();

// Check if the user is redirected due to a ban
if (isset($_GET['message']) && $_GET['message'] == 'banned') {
    $message[] = 'Your account has been banned from the site.';
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $pass = md5($_POST['pass']);
    $pass = filter_var($pass, FILTER_SANITIZE_STRING);

    // Select the user with email and password
    $select = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ?");
    $select->execute([$email, $pass]);
    $row = $select->fetch(PDO::FETCH_ASSOC);

    if ($select->rowCount() > 0) {
        // Check if the account is banned
        if ($row['banned'] == 1) {
            $message[] = 'Your account has been banned from the site.';
        } else {
            // Store dynamic data in session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['name'] = $row['name'];       // Assuming 'name' column exists in your 'users' table
            $_SESSION['email'] = $row['email'];
            $_SESSION['image'] = $row['image'];     // Assuming 'image' column exists in your 'users' table
            $_SESSION['role'] = $row['user_type'];  // Assuming 'user_type' column exists

            // Redirect based on user type
            if ($row['user_type'] == 'admin') {
                header('Location: admin_page.php');
                exit();
            } elseif ($row['user_type'] == 'user') {
                header('Location: ../../../front/home.php');
                exit();
            } else {
                $message[] = 'No user found!';
            }
        }
    } else {
        $message[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <!-- font awesome cdn link  -->
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
  background: #111;
  color: #ddd;
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
  background: linear-gradient(145deg, #222, #444);
  padding: 40px;
  border-radius: 12px;
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.4);
  width: 100%;
  max-width: 380px;
  text-align: center;
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

/* Submit Button */
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

/* Link Styling */
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

   </style>


   <script>
   document.addEventListener('DOMContentLoaded', function() {
       const form = document.querySelector('form');
       const emailInput = document.querySelector('input[name="email"]');
       const passInput = document.querySelector('input[name="pass"]');

       form.addEventListener('submit', function(event) {
           let isValid = true;

           // Email validation
           const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
           if (!emailRegex.test(emailInput.value)) {
               alert('Please enter a valid email address.');
               isValid = false;
           }

           // Password validation (at least 6 characters)
          //  if (passInput.value.length < 6) {
          //      alert('Password must be at least 6 characters long.');
          //      isValid = false;
          //  }

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
      <h3>Login Now</h3>
      <input type="email" required placeholder="Enter your email" class="box" name="email">
      <input type="password" required placeholder="Enter your password" class="box" name="pass">
      <p>Don't have an account? <a href="register.php">Register Now</a></p>
      <p>Forgot your password? <a href="forgot_password.php">Reset Here</a></p>
      <input type="submit" value="Login Now" class="btn" name="submit">
   </form>
</section>

</body>
</html>
