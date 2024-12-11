<?php
session_start(); // Démarrer la session
include_once '../../CONTROLLER/eventcontroller.php'; // Path to event controller

$message = "";

// Traitement du formulaire de réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reserve'])) {
    $event_id = $_POST['event_id'] ?? null;
    $email = $_POST['email'] ?? null;
    $nbrp = $_POST['nbrp'] ?? null;

    // Valider les données
    if (!$event_id || !$email || !$nbrp || $nbrp <= 0) {
        $message = "Erreur : Veuillez fournir un événement valide, une adresse e-mail et un nombre de places correct.";
    } else {
        // Stocker les informations de réservation dans la session
        $_SESSION['reservation'] = [
            'event_id' => $event_id,
            'email' => $email,
            'nbrp' => $nbrp,
        ];
        // Rediriger vers le paiement
        header('Location: checkout.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f9f9f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .form-container { background: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); width: 300px; }
        .form-container h2 { text-align: center; margin-bottom: 20px; }
        .form-container input, .form-container select, .form-container button { width: 100%; padding: 10px; margin-bottom: 15px; }
        button { background-color: #007bff; color: white; border: none; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Réserver un événement</h2>
    <?php if (!empty($message)): ?>
        <div><?= $message ?></div>
    <?php endif; ?>
    <form action="" method="POST">
        <label for="event_id">Événement</label>
        <select name="event_id" id="event_id">
            <?php
            $db = config::getConnexion();
            $sql = "SELECT id, nom_eve FROM events";
            foreach ($db->query($sql) as $row) {
                echo "<option value='{$row['id']}'>{$row['nom_eve']}</option>";
            }
            ?>
        </select>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        <label for="nbrp">Nombre de places</label>
        <input type="number" name="nbrp" id="nbrp" min="1" required>
        <button type="submit" name="reserve">Réserver</button>
    </form>
</div>
</body>
</html>
