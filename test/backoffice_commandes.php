<?php
session_start();
include 'connexion.php';
$bdd = maConnexion();

// Fetch commandes for display
$query = "SELECT c.id, c.nom, c.prenom, c.numero_telephone, c.adresse, c.produit_nom 
          FROM commandes c";
$commandes = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice - Gestion des Commandes</title>
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
        }

        .articles-management {
            padding: 20px;
        }

        .articles-list {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<script>
    function supprimerCommande(id) {
    if (confirm('Voulez-vous vraiment supprimer cette commande ?')) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "supprimer_commande.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.success) {
                    alert('Commande supprimée avec succès.');
                    // Remove the row from the table
                    const row = document.getElementById('commande-row-' + id);
                    if (row) {
                        row.remove(); // Remove the row from the DOM
                    }
                } else {
                    alert('Erreur lors de la suppression de la commande: ' + response.error);
                }
            }
        };
        xhr.send("id=" + encodeURIComponent(id));
    }
}
</script>
<body>
    <header>
        <h1>Backoffice - Gestion des Commandes</h1>
    </header>
    
    <main class="articles-management">
        <section class="articles-list">
            <h2>Liste des Commandes</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Numéro de Téléphone</th>
                        <th>Adresse</th>
                        <th>Nom du Produit</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commandes as $commande): ?>
                    <tr id="commande-row-<?= htmlspecialchars($commande['id']) ?>">
                        <td><?= htmlspecialchars($commande['id']) ?></td>
                        <td><?= htmlspecialchars($commande['nom']) ?></td>
                        <td><?= htmlspecialchars($commande['prenom']) ?></td>
                        <td><?= htmlspecialchars($commande['numero_telephone']) ?></td>
                        <td><?= htmlspecialchars($commande['adresse']) ?></td>
                        <td><?= htmlspecialchars($commande['produit_nom']) ?></td>
                        <td>
                            <button onclick="supprimerCommande(<?= htmlspecialchars($commande['id']) ?>)">Supprimer</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html> 