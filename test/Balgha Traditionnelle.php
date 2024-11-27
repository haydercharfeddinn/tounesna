<?php
// Initialiser la session pour la gestion du panier
session_start();
include 'connexion.php';
$bdd = maConnexion();

// Initialiser le panier si ce n'est pas encore fait
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Gestion de l'ajout au panier
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articleNom = $_POST['nom'];

    // Ajouter l'article au panier (session)
    $_SESSION['panier'][] = [
        'nom' => $articleNom
    ];

    // Ajouter l'article au panier (table dans la base de données)
    $query = "INSERT INTO panier (nom_prod) VALUES (:nom)";
    $stmt = $bdd->prepare($query);
    $stmt->bindParam(':nom', $articleNom);
    $stmt->execute();

    // Redirection après ajout
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Article - Balgha Traditionnelle</title>
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .details-container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .details-container img {
            max-width: 60%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .details-container h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #333;
        }

        .details-container p {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: #555;
        }

        .details-container label {
            display: block;
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        .details-container select {
            padding: 10px;
            font-size: 1.1em;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .details-container button {
            padding: 15px 25px;
            font-size: 1.1em;
            margin: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .add-to-cart {
            background-color: #28a745;
            color: #fff;
        }

        .add-to-cart:hover {
            background-color: #218838;
        }

        .back-to-shop {
            background-color: #007BFF;
            color: #fff;
        }

        .back-to-shop:hover {
            background-color: #0056b3;
        }

        .message {
            color: green;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="details-container">
        <img id="article-image" src="balgha.png" alt="Image de l'article">
        <h1 id="article-nom">Balgha Traditionnelle</h1>
        <p id="article-description">Chaussures traditionnelles confortables en cuir.</p>
        <p id="article-prix">Prix: 50 TND</p>
        <form method="POST" action="">
            <input type="hidden" name="nom" value="Balgha Traditionnelle">
            <input type="hidden" name="prix" value="50">
            <label for="taille">Choisir la taille:
                <select id="taille" name="taille">
                    <option value="40">40</option>
                    <option value="41">41</option>
                    <option value="42">42</option>
                    <option value="43">43</option>
                    <option value="44">44</option>
                </select>
            </label>
            <button type="submit" class="add-to-cart">Ajouter au panier</button>
        </form>
        <button class="back-to-shop" onclick="window.location.href='index.php'">Retour à la boutique</button>
    </div>
</body>
</html>
