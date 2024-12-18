<?php
include "../../controller/rep.php";
include "../../Model/reponse.php";

$error = "";


// create an instance of the controller
$rep = new reponse();
if (
    isset($_POST["reponse"]) 
) {
    if (
        !empty($_POST["reponse"]) 
       
    ) {
        $reponse = new rep(
            $_POST['id'],
            $_POST['reponse'],
            $_POST['idrec'],
        );
        $rep->updatereponse($reponse, $_POST["id"]);
        header('Location:listerep.php');
    } else
        $error = "Missing information";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .container {
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            max-width: 600px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }
        .form-container {
            margin: 0 auto;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .form-container input[type="text"], .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container input[type="text"][readonly] {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        .form-container input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #2e59d9;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Modification de la Réponse</h2>

        <?php if (!empty($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <div class="form-container">
            <form action="" method="POST">
                <label for="reponse">Réponse</label>
                <textarea name="reponse" id="reponse" rows="4"><?php echo htmlspecialchars($responseDetails['reponse'] ?? ''); ?></textarea>

                <input type="submit" value="Mettre à jour">
            </form>
        </div>
    </div>
</body>
</html>
