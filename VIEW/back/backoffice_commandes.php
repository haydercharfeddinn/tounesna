<?php
session_start();
include 'connexion.php';
$bdd = maConnexion();

// Fetch commandes for display
$query = "SELECT c.id, c.nom, c.prenom, c.numero_telephone, c.adresse, c.produit_nom, c.email 
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
            background-color: #f8f9fa;
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
            max-width: 1200px;
            margin: 50px 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0);
        }

        .articles-list {
            background-color: #fff;
            
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
        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: #4e73df; /* Bleu */
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 15px 0;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            color: #fff;
            }

            .sidebar a {
                display: block;
                color: #fff;
                text-decoration: none;
                font-size: 18px;
                padding: 10px 20px;
                transition: background-color 0.3s ease;
            }

            .sidebar a:hover {
                background-color: #2e59d9; /* Bleu plus foncé */
                border-radius: 5px;
            }
    </style>
</head>
<script>
    function validerParEmail(id, email) {
    if (confirm(`Voulez-vous envoyer un e-mail de validation à ${email} ?`)) {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "valider_email.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert('E-mail de validation envoyé avec succès.');
                    } else {
                        alert('Erreur lors de l\'envoi de l\'e-mail: ' + response.error);
                    }
                } catch (e) {
                    alert('Erreur de communication avec le serveur.');
                }
            }
        };
        xhr.send(`id=${encodeURIComponent(id)}&email=${encodeURIComponent(email)}`);
    }
}


    function supprimerCommande(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette commande ?")) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "supprimer_commande.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Supprime la ligne du tableau
                            const row = document.getElementById(`commande-row-${id}`);
                            if (row) row.remove();

                            alert("Commande supprimée avec succès.");
                        } else {
                            alert("Erreur : " + response.error);
                        }
                    } catch (e) {
                        alert("Erreur de communication avec le serveur.");
                    }
                }
            };

            xhr.send(`id=${encodeURIComponent(id)}`);
        }
    }
</script>


<body>
    
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../front/event.html">
        
        <div class="sidebar-brand-text mx-3">Event <sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/backoffice.php">
        
        <div class="sidebar-brand-text mx-3">SHOP <sup></sup></div>
      
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <a id="icon-stats" href="stats.php">
            📊 STATS 
            </a>

    


</ul>
<!-- End of Sidebar -->
    
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
                        <th>Email</th>
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
                        <td><?= htmlspecialchars($commande['email']) ?></td>
                        <td><?= htmlspecialchars($commande['produit_nom']) ?></td>
                        <td>
                            <button onclick="supprimerCommande(<?= htmlspecialchars($commande['id']) ?>)">Supprimer</button>
                            <button onclick="validerParEmail(<?= htmlspecialchars($commande['id']) ?>, '<?= htmlspecialchars($commande['email']) ?>')">Valider par Email</button>
                            <a href="generer_facture.php?id=<?= htmlspecialchars($commande['id']) ?>" target="_blank"> <button>Créer une facture</button></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
