<?php
include('../../CONTROLLER/eventcontroller.php');

$message = "";
$reservationId = $_GET['reservation_id'] ?? null;
$editingReservation = null;

try {
    $db = config::getConnexion();

    // Vérification de l'existence de la réservation
    if ($reservationId) {
        $editSql = "SELECT clients.id, events.nom_eve, clients.nbrp 
                    FROM clients 
                    JOIN events ON clients.event_id = events.id 
                    WHERE clients.id = :id";
        $editQuery = $db->prepare($editSql);
        $editQuery->bindParam(':id', $reservationId, PDO::PARAM_INT);
        $editQuery->execute();
        $editingReservation = $editQuery->fetch();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newNbrp = intval($_POST['nbrp']);
            $newEventName = $_POST['nom_eve'];

            // Récupération de l'ID de l'événement basé sur le nouveau nom
            $eventSql = "SELECT id FROM events WHERE nom_eve = :nom_eve";
            $eventQuery = $db->prepare($eventSql);
            $eventQuery->bindParam(':nom_eve', $newEventName, PDO::PARAM_STR);
            $eventQuery->execute();
            $eventId = $eventQuery->fetchColumn();

            if ($eventId) {
                $updateSql = "UPDATE clients SET nbrp = :nbrp, event_id = :event_id WHERE id = :id";
                $updateQuery = $db->prepare($updateSql);
                $updateQuery->bindParam(':nbrp', $newNbrp, PDO::PARAM_INT);
                $updateQuery->bindParam(':event_id', $eventId, PDO::PARAM_INT);
                $updateQuery->bindParam(':id', $reservationId, PDO::PARAM_INT);
                $updateQuery->execute();
                header("Location: reservations.php?success=1");
                exit;
            } else {
                $message = "L'événement spécifié est introuvable.";
            }
        }
    } else {
        $message = "Aucune réservation trouvée.";
    }
} catch (Exception $e) {
    $message = "Erreur : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Réservation</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #2563eb;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-size: 14px;
            color: #555555;
        }

        input[type="number"],
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            font-size: 14px;
        }

        button {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #2563eb;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #1d4ed8;
        }

        .message-box {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
        }

        .success {
            background-color: #e0f7df;
            color: #256029;
        }

        .error {
            background-color: #fde2e2;
            color: #b91c1c;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Modifier Réservation</h2>
    <?php if ($message): ?>
        <div class="message-box <?= strpos($message, 'introuvable') === false ? 'success' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <?php if ($editingReservation): ?>
        <form action="" method="POST">
            <label for="nbrp">Nombre de places :</label>
            <input type="number" name="nbrp" id="nbrp" value="<?= htmlspecialchars($editingReservation['nbrp']) ?>" required>

            <label for="nom_eve">Nom de l'événement :</label>
            <input type="text" name="nom_eve" id="nom_eve" value="<?= htmlspecialchars($editingReservation['nom_eve']) ?>" required>

            <button type="submit">Enregistrer les modifications</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
