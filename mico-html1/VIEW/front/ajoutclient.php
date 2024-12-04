<?php
// Inclure les dépendances nécessaires
//include 'config.php';
include_once '../../CONTROLLER/eventcontroller.php';  // Path to the controller
include_once '../../MODEL/event.php';  // Path to the Event class
// Initialisation des variables
$message = ""; // Pour afficher les messages à l'utilisateur

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $event_id = $_POST['event_id'] ?? null;
    $email = $_POST['email'] ?? null;
    $nbrp = $_POST['nbrp'] ?? null;

    // Valider les données
    if ($event_id === null || $email === null || $nbrp === null || $nbrp <= 0) {
        $message = "Erreur : Veuillez fournir un ID d'événement valide et un nombre de places correct.";
    } else {
        // Créer une instance de la classe `clients`
        $client = new clients(null, (int)$event_id, (string)$email, (int)$nbrp);

        // Créer une instance du contrôleur
        $controller = new clientcontroller();

        // Appeler la méthode `addclient` pour insérer les données
        try {
            $controller->addclient($client);
            $message = "Réservation ajoutée avec succès !";
        } catch (Exception $e) {
            $message = "Erreur lors de l'ajout de la réservation : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation de Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 300px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-container label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }
        .form-container input, .form-container select, .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
        .message {
            color: green;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }
        .error {
            color: red;
            font-size: 14px;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
    

</head>
<body>
<div class="form-container">
        <h2>Réservation de Tickets</h2>
        <!-- Affichage des messages -->
        <?php if (!empty($message)): ?>
            <div class="<?= strpos($message, 'Erreur') !== false ? 'error' : 'message' ?>">
                <?= $message ?>
            </div>
        <?php endif; ?>

        <!-- Formulaire -->
        <form action="" method="POST" onsubmit="return validateForm()" novalidate>
            <label for="event_id">Événement</label>
            <select name="event_id" id="event_id" required>
                <?php
                $db = config::getConnexion();
                $sql = "SELECT id, nom_eve FROM events";
                $result = $db->query($sql);
                while ($row = $result->fetch()) {
                    echo "<option value='{$row['id']}'>{$row['nom_eve']}</option>";
                }
                ?>
            </select>

            <label for="email">Adresse e-mail</label>
            <input type="email" name="email" id="email">
            <span id="emailError" class="error"></span>

            <label for="nbrp">Nombre de places</label>
            <input type="number" name="nbrp" id="nbrp">
            <span id="nbrpError" class="error"></span>

            <button type="submit">Réserver</button>
        </form>


    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function validateForm() {
                // Réinitialiser les messages d'erreur
                document.getElementById("emailError").innerText = "";
                document.getElementById("nbrpError").innerText = "";

                let isValid = true;

                // Valider l'adresse e-mail
                const email = document.getElementById("email").value.trim();
                const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!email) {
                    document.getElementById("emailError").innerText = "Veuillez entrer une adresse e-mail.";
                    isValid = false;
                } else if (!emailRegex.test(email)) {
                    document.getElementById("emailError").innerText = "Veuillez entrer une adresse e-mail valide.";
                    isValid = false;
                }

                // Valider le nombre de places
                const nbrp = document.getElementById("nbrp").value.trim();
                if (!nbrp) {
                    document.getElementById("nbrpError").innerText = "Veuillez entrer un nombre de places.";
                    isValid = false;
                } else if (nbrp < 1 || nbrp > 6) {
                    document.getElementById("nbrpError").innerText = "Le nombre de places doit être compris entre 1 et 6.";
                    isValid = false;
                }

                return isValid; // Empêche la soumission si `false`
            }

            // Ajouter l'événement de validation au formulaire
            const form = document.querySelector("form");
            form.addEventListener("submit", function(event) {
                if (!validateForm()) {
                    event.preventDefault(); // Bloque la soumission si la validation échoue
                }
            });
        });
    </script>
</body>
</html>

