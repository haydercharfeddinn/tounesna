<?php
include('../../CONTROLLER/eventcontroller.php');

$message = "";
$result = [];
$totalAmount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $email = $_POST['email'] ?? null;

    try {
        $db = config::getConnexion();

        // Gestion de la suppression
        if ($action === 'delete' && isset($_POST['reservation_id'])) {
            $reservationId = intval($_POST['reservation_id']);
            $deleteSql = "DELETE FROM clients WHERE id = :id";
            $deleteQuery = $db->prepare($deleteSql);
            $deleteQuery->bindParam(':id', $reservationId, PDO::PARAM_INT);
            $deleteQuery->execute();
            $message = "Réservation supprimée avec succès.";
        }

        // Affichage des réservations
        if ($email) {
            $sql = "SELECT clients.id, events.nom_eve, clients.nbrp, (events.price * clients.nbrp) AS total_price 
                    FROM clients 
                    JOIN events ON clients.event_id = events.id 
                    WHERE clients.email = :email";

            $query = $db->prepare($sql);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->execute();

            $result = $query->fetchAll();

            if ($result) {
                foreach ($result as $row) {
                    $totalAmount += $row['total_price'];
                }
            } else {
                $message = "Aucune réservation trouvée pour cet email.";
            }
        } else {
            $message = "Veuillez entrer une adresse email valide.";
        }
    } catch (Exception $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche Réservation</title>
    <style>
        /* Ajoutez vos styles ici */
        /* Global Styles */
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container for the form */
        .form-container {
            background: #ffffff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 450px;
        }

        /* Header style */
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333333;
            font-size: 24px;
        }

        /* Form label and input styling */
        .form-container label {
            display: block;
            font-size: 14px;
            color: #555555;
            margin-bottom: 8px;
        }

        .form-container input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            background-color: #f9fafb;
        }

        .form-container button {
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

        .form-container button:hover {
            background-color: #1d4ed8;
        }

        /* Message box */
        .message-box {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            font-size: 14px;
        }

        .message {
            background-color: #e0f7df;
            color: #256029;
        }

        .error {
            background-color: #fde2e2;
            color: #b91c1c;
        }

        /* Reservation list */
        .reservation-list {
            margin-top: 20px;
        }

        .reservation-item {
            background-color: #f9fafb;
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .reservation-item div {
            font-size: 14px;
            color: #333333;
        }

        .reservation-item .buttons {
            display: flex;
            gap: 10px;
        }

        .reservation-item button {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .reservation-item button.edit {
            background-color: #fbbf24;
            color: #ffffff;
        }

        .reservation-item button.edit:hover {
            background-color: #f59e0b;
        }

        .reservation-item button.delete {
            background-color: #ef4444;
            color: #ffffff;
        }

        .reservation-item button.delete:hover {
            background-color: #dc2626;
        }

        .total-amount {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            font-weight: bold;
            color: #2563eb;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Recherche Réservation</h2>
    <form action="" method="POST">
        <label for="email">Entrez votre email :</label>
        <input type="email" name="email" id="email" placeholder="exemple@domaine.com" required>
        <button type="submit">Rechercher</button>
    </form>

    <?php if ($message): ?>
        <div class="message-box <?= strpos($message, 'succès') !== false ? 'message' : 'error' ?>">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <?php if ($result): ?>
        <div class="reservation-list">
            <?php foreach ($result as $row): ?>
                <div class="reservation-item">
                    <div>
                        <strong><?= htmlspecialchars($row['nom_eve']) ?></strong><br>
                        Places : <?= htmlspecialchars($row['nbrp']) ?><br>
                        Prix total : <?= number_format($row['total_price'], 2) ?> €
                    </div>
                    <div class="buttons">
                        <form action="edit_reservation.php" method="GET">
                            <input type="hidden" name="reservation_id" value="<?= htmlspecialchars($row['id']) ?>">
                            <button type="submit" class="edit">Modifier</button>
                        </form>
                        <form action="" method="POST">
                            <input type="hidden" name="reservation_id" value="<?= htmlspecialchars($row['id']) ?>">
                            <button type="submit" name="action" value="delete" class="delete">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="total-amount">
            Montant total à payer : <?= number_format($totalAmount, 2) ?> €
        </div>
    <?php endif; ?>
</div>
</body>
</html>
