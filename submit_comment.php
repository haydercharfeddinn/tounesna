<?php
include "../../controller/comentaireC.php";  // Inclure le contrôleur de commentaires

if (isset($_POST['blog_id']) && isset($_POST['comment'])) {
    // Récupérer les données envoyées par AJAX
    $blogId = $_POST['blog_id'];
    $commentText = $_POST['comment'];

    // Créer une instance du contrôleur
    $comentaireController = new comentaireC();

    // Ajouter le commentaire à la base de données
    $comentaireController->addcomentaire(new comentaire(null, $commentText, null, $blogId));  // Assurez-vous que la classe `comentaire` accepte le `blog_id`

    // Réponse JSON ou simple message
    echo "Commentaire ajouté avec succès";
}
?>
