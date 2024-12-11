<?php
session_start(); // Démarrer la session
$reservation = $_SESSION['reservation'] ?? null;
$message = "";

// Import des classes PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer/src/Exception.php';
require '../../phpmailer/src/PHPMailer.php';
require '../../phpmailer/src/SMTP.php';

// Traitement du formulaire de paiement
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay'])) {
    // Simulation de validation de paiement
    $payment_successful = true; // À remplacer par l'intégration réelle

    if ($payment_successful && $reservation) {
        // Ajouter le client dans la base de données
        include_once '../../CONTROLLER/eventcontroller.php';
        include_once '../../MODEL/event.php';
        $client = new clients(null, $reservation['event_id'], $reservation['email'], $reservation['nbrp']);
        $controller = new clientcontroller();
        try {
            $controller->addclient($client);
            $message = "Réservation et paiement réussis !";
            unset($_SESSION['reservation']); // Nettoyer la session

            // Envoi de l'email de confirmation
            $mail = new PHPMailer(true);
            try {
                // Configuration du serveur SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'dhia.elghak19@gmail.com'; // Remplacez par votre e-mail
                $mail->Password = 'evvfygadahwpadoq'; // Mot de passe d'application
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                // Configuration des destinataires
                $mail->setFrom('dhia.elghak19@gmail.com', 'Nom de l\'organisation');
                $mail->addAddress($reservation['email']); // Destinataire (client)

                // Contenu de l'e-mail
                $mail->isHTML(true);
                $mail->Subject = "Confirmation de votre réservation";
                $mail->Body = "
                    <h2>Merci pour votre réservation !</h2>
                    <p>Votre réservation pour l'événement <strong>{$reservation['event_id']}</strong> a été confirmée.</p>
                    <p><strong>Détails :</strong></p>
                    <ul>
                        <li>Email : {$reservation['email']}</li>
                        <li>Nombre de places : {$reservation['nbrp']}</li>
                        <li>Total payé : " . ($reservation['nbrp'] * 30) . " €</li>
                    </ul>
                    <p>Nous avons hâte de vous voir à l'événement !</p>
                ";

                $mail->send();
                $message .= " Un e-mail de confirmation a été envoyé.";
            } catch (Exception $e) {
                $message .= " Cependant, l'e-mail de confirmation n'a pas pu être envoyé. Erreur : " . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            $message = "Erreur lors de l'ajout de la réservation : " . $e->getMessage();
        }
    } else {
        $message = "Erreur de paiement. Veuillez réessayer.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <style>
        /* CSS ajouté ici */
                /* Style pour le formulaire de paiement */
        /* Style global de la page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Conteneur principal pour le formulaire */
        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            margin: 20px;
        }

        /* Titre du formulaire */
        .form-container h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Message de confirmation ou d'erreur */
        .message, .error {
            font-size: 16px;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .message {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Formulaire */
        form {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        label {
            font-weight: bold;
            margin: 8px 0 5px;
            text-align: left;
            width: 100%;
        }

        input[type="text"] {
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
        }

        /* Bouton de paiement */
        button[type="submit"] {
            padding: 12px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Responsive - Adaptation pour les petits écrans */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
                width: 90%;
            }

            .form-container h2 {
                font-size: 20px;
            }

            label, input[type="text"], button[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Paiement</h2>
    <?php if (!empty($message)): ?>
        <div class="<?= strpos($message, 'Erreur') !== false ? 'error' : 'message' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <?php if ($reservation): ?>
        <p>Événement: <?= htmlspecialchars($reservation['event_id']) ?></p>
        <p>Email: <?= htmlspecialchars($reservation['email']) ?></p>
        <p>Nombre de places: <?= htmlspecialchars($reservation['nbrp']) ?></p>
        <p>Total: <?= htmlspecialchars($reservation['nbrp'] * 30) ?> €</p> <!-- Exemple de calcul de total -->
        
        <form action="" method="POST">
            <label for="card_number">Numéro de carte</label>
            <input type="text" name="card_number" id="card_number" required>
            
            <label for="expiration_date">Date d'expiration</label>
            <input type="text" name="expiration_date" id="expiration_date" required>
            
            <label for="cvv">CVV</label>
            <input type="text" name="cvv" id="cvv" required>

            <button type="submit" name="pay">Payer</button>
        </form>
    <?php else: ?>
        <p>Erreur : aucune réservation trouvée.</p>
    <?php endif; ?>
</div>
</body>
</html>
