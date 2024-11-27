<?php
echo "Debug: File is being accessed.";
session_start();
include 'connexion.php';
$bdd = maConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    // Delete the item from the panier table
    $query = "DELETE FROM panier WHERE id = :id";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':id', $id);
    
    if ($stmt->execute()) {
        // Return success response
        echo json_encode(['success' => true, 'newTotal' => calculateNewTotal()]);
    } else {
        // Return error response
        echo json_encode(['success' => false]);
    }
}

function calculateNewTotal() {
    global $bdd;
    $query = "SELECT SUM(p.prix) AS total FROM panier pa JOIN produit p ON pa.nom_prod = p.nom";
    $result = $bdd->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    return $row['total'] ? $row['total'] : 0;
}
?> 