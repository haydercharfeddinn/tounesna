<?php
// Start of PHP file
include 'connexion.php';
$bdd = maConnexion();

// Compter le nombre de commandes
$queryCount = "SELECT COUNT(*) as total FROM panier";
$stmt = $bdd->prepare($queryCount);
$stmt->execute();
$countResult = $stmt->fetch(PDO::FETCH_ASSOC);
$panierCount = $countResult['total'] ?? 0; // 0 par défaut si aucune article
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vente d'Habits Traditionnels Tunisiens</title>
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #0c0c0c;
            background-color: #ffffff;
            overflow-x: hidden;
        }
  
        header {
            background-color: #9bc600;
            color: #fff;
            padding: 20px;
            text-align: center;
            position: relative;
        }
  
        #icon-historique {
            position: absolute;
            top: 80px;
            right: 20px;
            cursor: pointer;
            z-index: 2;
        }
  
        #icon-panier {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            z-index: 2;
        }
  
        #icon-panier span {
            background-color: #ff0000;
            color: #fff;
            padding: 5px 10px;
            border-radius: 50%;
            margin-left: 5px;
        }
  
        .articles {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            padding: 70px;
        }
  
        .article {
            background-color: #ffffff;
            border: 1px solid #9bc600;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 15px;
            padding: 20px;
            text-align: center;
            width: 200px;
        }
  
        .article img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
  
        .article h2 {
            font-size: 1.2em;
            margin: 10px 0;
        }
  
        .consulter-btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 10px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
  
        .consulter-btn:hover {
            background-color: #0056b3;
        }
  
        .popup {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }
  
        .popup-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 400px;
            position: relative;
            border-radius: 10px;
            overflow-y: auto;
            max-height: 80%;
            z-index: 11;
        }
  
        .close {
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 1.5em;
            cursor: pointer;
        }
  
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
  
        #panier {
            margin-top: 10px;
        }
  
        #acheter {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
        }
  
        #acheter:hover {
            background-color: #555;
        }
  
        .back-to-shop {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
        }
  
        .back-to-shop:hover {
            background-color: #0056b3;
        }
    </style>
  </head>
<body>
    <header>
        <h1>SHOP</h1>
        <div id="icon-historique" onclick="afficherHistorique()">
            📜 </div>
        <div id="icon-panier" onclick="afficherPanier()">
            🛒 <span id="panier-count"><?= htmlspecialchars($panierCount) ?></span> 
        </div>
    </header>
    
    <main>
        <section class="articles">
            <!-- Articles dynamiques extraits de la base de données -->
            <?php
            $query = "SELECT * FROM produit";
            $result = $bdd->query($query);
            
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="article">';
                    echo '<img src="' . htmlspecialchars($row['img']) . '" alt="' . htmlspecialchars($row['nom']) . '">';
                    echo '<h2>' . htmlspecialchars($row['nom']) . '</h2>';
                    echo '<p>' . htmlspecialchars($row['descr']) . '</p>';
                    echo '<p>Prix: ' . htmlspecialchars($row['prix']) . ' TND</p>';
                    echo '<a href="' . htmlspecialchars($row['nom']) . '.php" class="consulter-btn">Consulter</a>';
                    echo '</div>';
                }
            } else {
                echo '<p>Aucun produit disponible pour le moment.</p>';
            }
            ?>
        </section>
    </main>

    <div id="panier-popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="fermerPanier()">&times;</span>
            <h2>Votre Panier</h2>
            <div id="panier">
                <?php
                // Récupérer les produits dans le panier
                $queryPanier = "SELECT p.*, pa.id AS panier_id FROM panier pa JOIN produit p ON pa.nom_prod = p.nom";
                $resultPanier = $bdd->query($queryPanier);
                if ($resultPanier->rowCount() > 0) {
                    $total = 0;
                    while ($row = $resultPanier->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div id="article-' . $row['panier_id'] . '">';
                        echo '<h3>' . htmlspecialchars($row['nom']) . '</h3>';
                        echo '<p>Prix: ' . htmlspecialchars($row['prix']) . ' TND</p>';
                        echo '<p>Description: ' . htmlspecialchars($row['descr']) . '</p>';
                        echo '<form method="POST" action="supprimer_article.php" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer cet article ?\');">';
                        echo '<input type="hidden" name="id" value="' . $row['panier_id'] . '">';
                        echo '<button type="submit" onclick="refreshPage()">Supprimer</button>';
                        echo '</form>';
                        echo '</div>';
                        $total += $row['prix'];
                    }
                    echo '<p id="total">Total: ' . $total . ' TND</p>';
                } else {
                    echo '<p>Votre panier est vide.</p>';
                }
                ?>
            </div>
            <button id="acheter" onclick="acheterArticles()">Acheter</button>
        </div>
    </div>

    <div id="historique-popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="fermerHistorique()">&times;</span>
            <h2>Historique d'Achats</h2>
            <div id="historique"></div>
        </div>
    </div>
    <div id="confirmation-popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="fermerConfirmation()">&times;</span>
            <h2>Confirmation de Commande</h2>
            <form id="confirmation-form">
                <label for="nom">Nom:</label><br>
                <input type="text" id="nom" name="nom" required><br><br>
                
                <label for="prenom">Prénom:</label><br>
                <input type="text" id="prenom" name="prenom" required><br><br>
                
                <label for="telephone">Numéro de Téléphone:</label><br>
                <input type="tel" id="telephone" name="telephone" required><br><br>
                
                <label for="adresse">Adresse:</label><br>
                <textarea id="adresse" name="adresse" required></textarea><br><br>
                
                <p id="prix-total">Total: 0 TND</p><br>
                <button type="button" onclick="confirmerCommande()">Confirmer</button>
            </form>
        </div>
    </div>

    <script>
       

        function refreshPage() {
            setTimeout(function() {
                location.reload();
            }, 100);
        }

        function supprimerArticle(panierId) {
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "supprimer_article.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        document.getElementById('article-' + panierId).remove();
                        document.getElementById('total').textContent = 'Total: ' + response.newTotal + ' TND';
                        const panierCountElement = document.getElementById('panier-count');
                        let currentCount = parseInt(panierCountElement.textContent);
                        panierCountElement.textContent = Math.max(0, currentCount - 1);
                        refreshPage();
                    } else {
                        alert('Une erreur s est produite lors de la suppression de l article.');
                    }
                }
            };
            xhr.send("id=" + panierId);
        }

        function afficherPanier() {
            const popup = document.getElementById('panier-popup');
            popup.style.display = 'block';
        }

        function fermerPanier() {
            document.getElementById('panier-popup').style.display = 'none';
        }

        function afficherHistorique() {
            const popup = document.getElementById('historique-popup');
            popup.style.display = 'block';
        }

        function fermerHistorique() {
            document.getElementById('historique-popup').style.display = 'none';
        }

        function acheterArticles() {
            if (document.getElementById('panier').children.length === 0) {
                alert('Votre panier est vide.');
                return;
            }
            const popup = document.getElementById('confirmation-popup');
            const total = document.getElementById('total').textContent.split(': ')[1];
            document.getElementById('prix-total').textContent = 'Total: ' + total;
            popup.style.display = 'block';
        }

        function fermerConfirmation() {
            document.getElementById('confirmation-popup').style.display = 'none';
        }

        function confirmerCommande() {
            const nom = document.getElementById('nom').value;
            const prenom = document.getElementById('prenom').value;
            const telephone = document.getElementById('telephone').value;
            const adresse = document.getElementById('adresse').value;

            // Assuming you have a way to get the product name(s) from the cart
            const produitNom = []; // This should be populated with the product names in the cart
            const panierItems = document.getElementById('panier').children;

            // Check if there are items in the cart
            if (panierItems.length === 0) {
                alert('Votre panier est vide.');
                return;
            }

            for (let item of panierItems) {
                const productNameElement = item.querySelector('h3'); // Adjust based on your HTML structure
                if (productNameElement) {
                    produitNom.push(productNameElement.textContent); // Only push if the element exists
                }
            }

            if (nom && prenom && telephone && adresse) {
                // Send the order details to the server
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "ajouter_commande.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        const response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            alert('Merci ' + prenom + ' ' + nom + ', votre commande a été confirmée !');
                            localStorage.removeItem('panier');
                            location.reload();
                        } else {
                            alert('Erreur lors de la confirmation de la commande: ' + response.error);
                        }
                    }
                };
                xhr.send("nom=" + encodeURIComponent(nom) + "&prenom=" + encodeURIComponent(prenom) + "&telephone=" + encodeURIComponent(telephone) + "&adresse=" + encodeURIComponent(adresse) + "&produit_nom=" + encodeURIComponent(produitNom.join(',')));
            } else {
                alert('Veuillez remplir tous les champs.');
            }
        }
    </script>
</body>
<!-- footer section -->
<footer class="footer_section">
    <div class="container">
        <p>
            &copy; <span id="displayYear"></span> All Rights Reserved 
        </p>
    </div>
</footer>
<script>
    document.getElementById('displayYear').textContent = new Date().getFullYear();
</script>
<!-- footer section -->
</html>
