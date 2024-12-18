<?php 
include 'C:/xampp/htdocs/mico-html11/CONTROLLER/comentairec.php';  // Path to the controller
include 'C:/xampp/htdocs/mico-html11/MODEL/comentairem.php';  // Path to the Event class


$error="";

// create an instance of the controller
$comentairecontroller = new comentaireC(); 


if (isset($_POST["contenu_c"])   ) {
    if (
        !empty($_POST["contenu_c"])  
    
    ) {
        $comentaire = new comentaire(
            null,
            $_POST['contenu_c'],
            null,
            null
        );
        //
            
        $comentairecontroller->addcomentaire($comentaire); 

       header('Location:dashboardcom.php');
    } else
        $error = "Missing information";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un commentaire</title>
    <style>
       /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fc; /* Fond léger */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #5a5c69; /* Texte gris */
        }

        h2 {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            color: #4e73df; /* Bleu clair */
            margin-bottom: 20px;
        }
        /* Sidebar */
        .sidebar {
                width: 250px;
                background-color: #4e73df; /* Bleu */
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                padding: 15px 0;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
                color: #fff;
            }

            .sidebar a {
                display: block;
                color: #fff;
                text-decoration: none;
                font-size: 18px;
                padding: 10px 20px;
                transition: background-color 0.3s ease;
            }

            .sidebar a:hover {
                background-color: #2e59d9; /* Bleu plus foncé */
                border-radius: 5px;
            }

        /* Container */
        .container {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px 20px;
            max-width: 450px;
            width: 100%;
        }

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Espacement uniforme */
        }

        label {
            font-weight: bold;
            color: #5a5c69; /* Texte gris */
            margin-bottom: 5px;
        }

        input,
        select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #d1d3e2; /* Bordure gris clair */
            border-radius: 5px;
            background-color: #f8f9fc; /* Fond gris léger */
            color: #6e707e; /* Texte gris foncé */
            outline: none;
            transition: border-color 0.3s ease;
        }

        input:focus,
        select:focus {
            border-color: #4e73df; /* Couleur de focus */
            box-shadow: 0 0 5px rgba(78, 115, 223, 0.5);
        }

        /* Button */
        button {
            background-color: #4e73df; /* Bleu */
            color: #ffffff; /* Texte blanc */
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2e59d9; /* Bleu foncé */
        }

        /* Error Messages */
        .error {
            color: red;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../front/about.php">
            
            <div class="sidebar-brand-text mx-3">About <sup></sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="dashboardcom.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        



    </ul>



    <h2>Ajouter un comentaire</h2>
    <form id="eventForm" method="POST" onsubmit="return validateForm()">
        <label for="comentairecontenu">contenu</label>
        <input type="text" id="contenu" name="contenu_c">
       

        <button type="submit">Ajouter</button>
    </form>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
</div>

<script>
    /*function validateForm() {
        // Réinitialiser les messages d'erreur
        document.getElementById("typeError").innerText = "";
        document.getElementById("nomError").innerText = "";
        document.getElementById("dateError").innerText = "";
        document.getElementById("priceError").innerText = "";

        let isValid = true;

        // Valider le type d'événement
        const type = document.getElementById("type_").value;
        if (!type) {
            document.getElementById("typeError").innerText = "Veuillez sélectionner un type d'événement.";
            isValid = false;
        }

        // Valider le nom de l'événement
        const nom = document.getElementById("nom_eve").value.trim();
        if (!nom) {
            document.getElementById("nomError").innerText = "Veuillez entrer un nom pour l'événement.";
            isValid = false;
        } else if (nom.length < 3) {
            document.getElementById("nomError").innerText = "Le nom de l'événement doit contenir au moins 3 caractères.";
            isValid = false;
        }

        // Valider la date
        const dateInput = document.getElementById("date_").value;
        const today = new Date(); // Obtenir la date actuelle
        const selectedDate = new Date(dateInput); // Convertir l'entrée en objet Date

        if (!dateInput) {
            document.getElementById("dateError").innerText = "Veuillez sélectionner une date.";
            isValid = false;
        } else if (selectedDate < today.setHours(0, 0, 0, 0)) {
            document.getElementById("dateError").innerText = "La date ne peut pas être antérieure à aujourd'hui.";
            isValid = false;
        }


        // Valider le prix
        const price = document.getElementById("price").value;
        if (!price) {
            document.getElementById("priceError").innerText = "Veuillez entrer un prix.";
            isValid = false;
        } else if (price <= 0) {
            document.getElementById("priceError").innerText = "Le prix doit être supérieur à 0.";
            isValid = false;
        }

        return isValid;
    }*/
</script>

</body>
</html>