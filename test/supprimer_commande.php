<?php
session_start();
include 'connexion.php';
$bdd = maConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Get the ID of the commande to delete

    // Prepare the SQL statement
    $query = "DELETE FROM commandes WHERE id = :id";
    $stmt = $bdd->prepare($query);
    
    // Execute the statement
    if ($stmt->execute([':id' => $id])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erreur lors de la suppression de la commande.']);
    }
}
?> 