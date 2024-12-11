<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../phpmailer/src/Exception.php';
require '../../phpmailer/src/PHPMailer.php';
require '../../phpmailer/src/SMTP.php';

// Vérifier les données de réservation
$reservation = $_SESSION['reservation'] ?? null;
if (!$reservation) {
    die("Aucune réservation trouvée.");
}

// Ajouter à la base de données
include_once '../../CONTROLLER/eventcontroller.php';
include_once '../../MODEL/event.php';
$client = new clients(null, $reservation['event_id'], $reservation['email'], $reservation['nbrp']);
$controller = new clientcontroller();
try {
    $controller->addclient($client);

    // Envoyer un email de confirmation
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dhia.elghak19@gmail.com';
    $mail->Password = 'evvfygadahwpadoq';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('dhia.elghak19@gmail.com', 'Réservations');
    $mail->addAddress($reservation['email']);
    $mail->isHTML(true);
    $mail->Subject = "Confirmation de réservation";
    $mail->Body = "
        <h2>Confirmation de réservation</h2>
        <p>Événement : {$reservation['event_id']}</p>
        <p>Nombre de places : {$reservation['nbrp']}</p>
        <p>Montant total : " . ($reservation['nbrp'] * 30) . " €</p>
    ";
    $mail->send();

    echo "Paiement réussi ! Un email de confirmation a été envoyé.";
    unset($_SESSION['reservation']);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 </head>
 <body>

    <p>Thank you for your payment</p>
 </body>
 </html>