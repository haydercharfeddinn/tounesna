<?php
session_start();
include 'connexion.php';
$bdd = maConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $numero_telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $produit_nom = $_POST['produit_nom']; // Assuming you send the product name
    $email = $_POST['email'];

    // Prepare the SQL statement
    $query = "INSERT INTO commandes (nom, prenom, numero_telephone, adresse, produit_nom,email) VALUES (:nom, :prenom, :numero_telephone, :adresse, :produit_nom , :email)";
    $stmt = $bdd->prepare($query);
    
    // Execute the statement
    if ($stmt->execute([':nom' => $nom, ':prenom' => $prenom, ':numero_telephone' => $numero_telephone, ':adresse' => $adresse, ':produit_nom' => $produit_nom , ':email' => $email,])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Erreur lors de l\'ajout de la commande.']);
    }
}
?> 