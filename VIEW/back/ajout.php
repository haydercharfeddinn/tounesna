<?php 
include_once '../../CONTROLLER/eventcontroller.php';  // Path to the controller
include_once '../../MODEL/event.php';  // Path to the Event class


$error = "";

$event= null;
// create an instance of the controller
$eventcontroller = new eventcontroller(); //ayet lel classe eli fih kol chyy


if (isset($_POST["type_"])  && $_POST["nom_eve"] && $_POST["date_"] && $_POST["price"] ) {
    if (
        !empty($_POST["type_"])  && !empty($_POST["nom_eve"]) && !empty($_POST["date_"]) && !empty($_POST["price"])
    
    ) {
        $event = new event(
            null,
            $_POST['type_'],
            $_POST['nom_eve'],
            new DateTime($_POST['date_']),
            $_POST['price']
        );
        //
        
        $eventcontroller->addevent($event); //bel fonction sabina fi waset base

       header('Location:affiche.php');//aytlha bech yafishiha louta
    } else
        $error = "Missing information";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Événement</title>
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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/affiche.php">
            
            <div class="sidebar-brand-text mx-3">Event <sup></sup></div>
        </a>
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/backoffice.php">
        
        <div class="sidebar-brand-text mx-3">SHOP <sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/listeRec.php">
        
        <div class="sidebar-brand-text mx-3">Réclamation <sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/dashboardblog.php">
        
        <div class="sidebar-brand-text mx-3">blog <sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/admin/pages/dashboard.php">
        
        <div class="sidebar-brand-text mx-3">Admin<sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/createquiz.php">
        
        <div class="sidebar-brand-text mx-3">Quiz <sup></sup></div>
      
    </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
    </li>
    
        

        

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="afficheclientt.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Client list</span></a>
        </li>
        

    </ul>



    <h2>Ajouter un Événement</h2>
    <form id="eventForm" method="POST" onsubmit="return validateForm()">
        <label for="type_">Type d'Événement :</label>
        <select id="type_" name="type_">
            <option value="">-- Sélectionnez --</option>
            <option value="Cinema">Cinema</option>
            <option value="Theatre">Theatre</option>
            <option value="Concert">Concert</option>
        </select>
        <span id="typeError" class="error"></span>

        <label for="nom_eve">Nom de l'événement :</label>
        <input type="text" id="nom_eve" name="nom_eve" placeholder="...">
        <span id="nomError" class="error"></span>

        <label for="date_">Date de l'Événement :</label>
        <input type="date" id="date_" name="date_">
        <span id="dateError" class="error"></span>

        <label for="price">Prix (en €) :</label>
        <input type="number" id="price" name="price" placeholder="Ex : 100">
        <span id="priceError" class="error"></span>

        <button type="submit">Ajouter</button>
    </form>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
</div>

<script>
    function validateForm() {
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
    }
</script>

</body>
</html>
