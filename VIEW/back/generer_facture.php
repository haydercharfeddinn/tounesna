<?php
require('fpdf/fpdf.php'); // Inclure la bibliothèque FPDF
include 'connexion.php';
$bdd = maConnexion();

// Vérifier si l'ID est présent dans l'URL
if (!isset($_GET['id'])) {
    die("ID de commande manquant.");
}

$id = $_GET['id'];

// Récupérer les informations de la commande
$query = "SELECT * FROM commandes WHERE id = ?";
$stmt = $bdd->prepare($query);
$stmt->execute([$id]);
$commande = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$commande) {
    die("Commande non trouvée.");
}

// Informations de la facture
$entreprise = "TOUNESNA";
$adresseEntreprise = "La Petite Ariana, Tunis, 2081";
$telephoneEntreprise = "+216 54795175";

$clientNom = $commande['nom'] . ' ' . $commande['prenom'];
$clientAdresse = $commande['adresse'];
$clientTelephone = $commande['numero_telephone'];
$produitNom = $commande['produit_nom'];
$emailClient = $commande['email'];

// Calculer un prix (exemple simple)
$quantite = 1;  // Pour simplifier, nous considérons une seule unité par commande
$prixUnitaire = 50.00;  // Vous pouvez changer cela pour correspondre à votre produit
$totalFacture = $quantite * $prixUnitaire;

// Créer un PDF avec FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);

// En-tête de la facture
$pdf->Cell(0, 10, "Facture - Commande #" . $commande['id'], 0, 1, 'C');
$pdf->Ln(10);

// Informations de l'entreprise
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $entreprise, 0, 1);
$pdf->Cell(0, 10, $adresseEntreprise, 0, 1);
$pdf->Cell(0, 10, "Telephone : " . $telephoneEntreprise, 0, 1);
$pdf->Ln(10);

// Informations du client
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, "Facturer  :", 0, 1);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, $clientNom, 0, 1);
$pdf->Cell(0, 10, $clientAdresse, 0, 1);
$pdf->Cell(0, 10, "Telephone : " . $clientTelephone, 0, 1);
$pdf->Cell(0, 10, "E-mail : " . $emailClient, 0, 1);
$pdf->Ln(10);

// Tableau des produits
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 10, "Description", 1);
$pdf->Cell(30, 10, "Quantite", 1, 0, 'C');
$pdf->Cell(40, 10, "Prix Unitaire (dt)", 1, 0, 'C');
$pdf->Cell(40, 10, "Total (dt)", 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(80, 10, $produitNom, 1);
$pdf->Cell(30, 10, $quantite, 1, 0, 'C');
$pdf->Cell(40, 10, number_format($prixUnitaire, 2), 1, 0, 'C');
$pdf->Cell(40, 10, number_format($totalFacture, 2), 1, 1, 'C');

// Total général
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(150, 10, "Total", 1, 0, 'R');
$pdf->Cell(40, 10, number_format($totalFacture, 2), 1, 1, 'C');

// Message final
$pdf->Ln(10);
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, "Merci pour votre confiance. Veuillez effectuer le paiement sous 30 jours.", 0, 1, 'C');

// Générer le fichier PDF
$pdf->Output("I", "Facture_Commande_" . $commande['id'] . ".pdf"); // Téléchargement direct du PDF
