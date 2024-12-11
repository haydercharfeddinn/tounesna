<?php
include 'connexion.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\\xampp\\htdocs\\mico-html1\\VIEW\\back\\phpmailer\\src\\Exception.php';
require 'C:\\xampp\\htdocs\\mico-html1\\VIEW\\back\\phpmailer\\src\\PHPMailer.php';
require 'C:\\xampp\\htdocs\\mico-html1\\VIEW\\back\\phpmailer\\src\\SMTP.php';
require 'fpdf/fpdf.php';

$bdd = maConnexion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $email = $_POST['email'] ?? null;

    // Validation des données
    if (empty($id) || empty($email)) {
        echo json_encode(['success' => false, 'error' => 'ID ou e-mail manquant.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'error' => 'Adresse e-mail invalide.']);
        exit;
    }

    // Récupérer les informations de la commande
    $query = "SELECT * FROM commandes WHERE id = ?";
    $stmt = $bdd->prepare($query);
    $stmt->execute([$id]);
    $commande = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$commande) {
        echo json_encode(['success' => false, 'error' => 'Commande non trouvée.']);
        exit;
    }

    // Informations pour la facture
    $entreprise = "TOUNESNA";
    $adresseEntreprise = "La Petite Ariana, Tunis, 2081";
    $telephoneEntreprise = "+216 54795175";

    $clientNom = $commande['nom'] . ' ' . $commande['prenom'];
    $clientAdresse = $commande['adresse'];
    $clientTelephone = $commande['numero_telephone'];
    $produitNom = $commande['produit_nom'];
    $quantite = 1; // Par défaut
    $prixUnitaire = 50.00; // Exemple
    $totalFacture = $quantite * $prixUnitaire;

    // Générer la facture PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);

    $pdf->Cell(0, 10, "Facture - Commande #" . $commande['id'], 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, $entreprise, 0, 1);
    $pdf->Cell(0, 10, $adresseEntreprise, 0, 1);
    $pdf->Cell(0, 10, "Telephone : " . $telephoneEntreprise, 0, 1);
    $pdf->Ln(10);

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, "Facturer  :", 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, $clientNom, 0, 1);
    $pdf->Cell(0, 10, $clientAdresse, 0, 1);
    $pdf->Cell(0, 10, "Telephone : " . $clientTelephone, 0, 1);
    $pdf->Cell(0, 10, "E-mail : " . $email, 0, 1);
    $pdf->Ln(10);

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

    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(150, 10, "Total", 1, 0, 'R');
    $pdf->Cell(40, 10, number_format($totalFacture, 2), 1, 1, 'C');

    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "", 0, 1, 'C');

    $filePath = "Facture_Commande_" . $commande['id'] . ".pdf";
    $pdf->Output('F', $filePath);

    // Envoyer l'email avec la pièce jointe
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ddahmeni2.dali@gmail.com';
        $mail->Password = 'wmua hkri ozxt abnh';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('ddahmeni2.dali@gmail.com', 'TOUNESNA');
        $mail->addAddress($email);
        $mail->addAttachment($filePath);

        $mail->isHTML(true);
        $mail->Subject = 'Validation de votre commande avec facture';
        $mail->Body = "Bonjour,<br><br>Votre commande a ete validee. Vous trouverez en piece jointe la facture correspondante.<br><br>Merci pour votre confiance.<br><br>Cordialement,<br>TOUNESNA.";

        $mail->send();
        unlink($filePath); // Supprimer le fichier après envoi
        echo json_encode(['success' => true, 'message' => 'Facture envoyee par e-mail avec succès.']);
    } catch (Exception $e) {
        unlink($filePath); // Supprimer en cas d'échec aussi
        echo json_encode(['success' => false, 'error' => "Erreur lors de l'envoi de l'e-mail : {$mail->ErrorInfo}"]);
    }
}
?>
