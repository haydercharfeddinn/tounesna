<?php
include 'connexion.php';
$bdd = maConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $stmt = $bdd->prepare("DELETE FROM commandes WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erreur lors de la suppression.']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'ID manquant.']);
    }
}
