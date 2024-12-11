<?php
session_start();
include_once '../../CONTROLLER/eventcontroller.php';
include_once '../../MODEL/event.php';

// Vérifier le statut du paiement
$paymentStatus = $_SESSION['payment_status'] ?? 'failed';

if ($paymentStatus === 'success') {
    // Récupérer les données sauvegardées en session
    $event_id = $_SESSION['event_id'] ?? null;
    $email = $_SESSION['email'] ?? null;
    $nbrp = $_SESSION['nbrp'] ?? null;

    if ($event_id && $email && $nbrp) {
        // Ajouter le client à la base de données
        $client = new clients(null, (int)$event_id, (string)$email, (int)$nbrp);
        $controller = new clientcontroller();

        try {
            $controller->addclient($client);
            echo "Paiement confirmé et réservation ajoutée avec succès !";
        } catch (Exception $e) {
            echo "Erreur lors de l'ajout de la réservation : " . $e->getMessage();
        }
    } else {
        echo "Erreur : données manquantes pour la réservation.";
    }
} else {
    echo "Le paiement a échoué. Veuillez réessayer.";
}
?>
