<?php
session_start();
include 'connexion.php';
$bdd = maConnexion();

// Handle CRUD operations
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                // Add article
                $nom = trim($_POST['nom']);
                $prix = $_POST['prix'];
                $taille = trim($_POST['taille']);
                $image = $_FILES['image'];

                // Input validation
                $errors = [];

                // Validate required fields
                if (empty($nom)) {
                    $errors[] = "Le nom de l'article est requis.";
                }
                if (empty($prix) || !is_numeric($prix) || $prix <= 0) {
                    $errors[] = "Le prix doit être un nombre positif.";
                }
                if (empty($taille)) {
                    $errors[] = "Les tailles disponibles sont requises.";
                }

                // Validate file upload
                if ($image['error'] !== UPLOAD_ERR_OK) {
                    $errors[] = "Erreur lors du téléchargement de l'image.";
                } else {
                    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                    if (!in_array($image['type'], $allowedTypes)) {
                        $errors[] = "Le fichier doit être une image (JPEG, PNG, GIF).";
                    }
                    if ($image['size'] > 2 * 1024 * 1024) { // 2MB limit
                        $errors[] = "L'image ne doit pas dépasser 2 Mo.";
                    }
                }

                // If there are errors, display them
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<p style='color:red;'>$error</p>";
                    }
                } else {
                    // Ensure the images directory exists
                    if (!is_dir('images')) {
                        mkdir('images', 0755, true); // Create the directory if it doesn't exist
                    }

                    // Handle filename conflicts
                    $targetFilePath = "images/" . basename($image['name']);
                    if (file_exists($targetFilePath)) {
                        $fileInfo = pathinfo($targetFilePath);
                        $newFileName = $fileInfo['filename'] . '_' . uniqid() . '.' . $fileInfo['extension'];
                        $targetFilePath = "images/" . $newFileName;
                    }

                    // Move the uploaded file
                    if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
                        $query = "INSERT INTO produit (nom, prix, taille, img) VALUES (:nom, :prix, :taille, :img)";
                        $stmt = $bdd->prepare($query);
                        $stmt->execute([':nom' => $nom, ':prix' => $prix, ':taille' => $taille, ':img' => $targetFilePath]);
                    } else {
                        echo "<p style='color:red;'>Erreur lors du déplacement du fichier.</p>";
                    }
                }
                break;

            case 'delete':
                // Delete article
                $nom = trim($_POST['nom']);
                $query = "DELETE FROM produit WHERE nom = :nom";
                $stmt = $bdd->prepare($query);
                $stmt->execute([':nom' => $nom]);
                break;

            case 'update':
                // Update article
                $nom = trim($_POST['nom']);
                $prix = $_POST['prix'];
                $taille = trim($_POST['taille']);
                
                // Input validation
                $errors = [];

                // Validate required fields
                if (empty($nom)) {
                    $errors[] = "Le nom de l'article est requis.";
                }
                if (empty($prix) || !is_numeric($prix) || $prix <= 0) {
                    $errors[] = "Le prix doit être un nombre positif.";
                }
                if (empty($taille)) {
                    $errors[] = "Les tailles disponibles sont requises.";
                }

                // If there are errors, display them
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<p style='color:red;'>$error</p>";
                    }
                } else {
                    // Prepare the update query
                    $query = "UPDATE produit SET prix = :prix, taille = :taille WHERE nom = :nom";
                    $params = [':prix' => $prix, ':taille' => $taille, ':nom' => $nom];

                    // Execute the update query
                    $stmt = $bdd->prepare($query);
                    $stmt->execute($params);
                }
                break;
        }
    }
}

// Fetch articles for display
$query = "SELECT * FROM produit";
$articles = $bdd->query($query)->fetchAll(PDO::FETCH_ASSOC);

// Compter le nombre de commandes
$queryCount = "SELECT COUNT(*) as total FROM commandes";
$stmt = $bdd->prepare($queryCount);
$stmt->execute();
$countResult = $stmt->fetch(PDO::FETCH_ASSOC);
$commandeCount = $countResult['total'] ?? 0; // 0 par défaut si aucune commande
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backoffice - Gestion des Articles</title>
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
            background-color:white;
            color: #fff;
            padding: 0px;
            text-align: center;
            position: relative;
        }

        #icon-messagerie, #icon-historique {
            position: absolute;
            top: 20px;
            cursor: pointer;
        }

        #icon-messagerie {
            left: 0;
            top: 180px;
        }
        #icon-stats {
            left: 0;
            top: 0;
        }


        #icon-historique {
            position: absolute;
            top: 50px;
            right: 20px;
        }

        #icon-messagerie span, #icon-historique span {
            background-color: #ff0000;
            color: #fff;
            padding: 5px 10px;
            border-radius: 50%;
            margin-left: 5px;
        }

        .articles-management {
            max-width: 1200px;
            margin: 50px 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .article-form {
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
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

        .article-form input[type="file"] {
            padding: 5px;
        }

        .article button {
            margin-left: 10px;
            padding: 5px 10px;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .article button:hover {
            background-color: #555;
        }

        #messagerie-popup, #historique-popup {
            display: none;
            position: fixed;
            z-index: 1;
            right: 20px;
            top: 70px;
            width: 300px;
            background-color: #fff;
            border: 1px solid #888;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        #messagerie-header, #historique-header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        #messagerie-content, #historique-content {
            padding: 10px;
        }

        .commande {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
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
<body>
    <header>
       
        
       
    </header>   
      <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/affiche.php">
        
        <div class="sidebar-brand-text mx-3">Event <sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/backoffice.php">
        
        <div class="sidebar-brand-text mx-3">SHOP <sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/listeRec.php">
        
        <div class="sidebar-brand-text mx-3">Réclamation <sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/dashboardblog.php">
        
        <div class="sidebar-brand-text mx-3">blog <sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/dashboardcom.php">
        
        <div class="sidebar-brand-text mx-3">commentaire <sup></sup></div>
      
    </a>
    
    

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <a id="icon-messagerie" href="backoffice_commandes.php">
         📩 <span id="commande-count"><?= htmlspecialchars($commandeCount) ?></span>
            </a>
    <a id="icon-stats" href="stats.php">
            📊 STATS 
            </a>

    


</ul>
<!-- End of Sidebar -->
    
    <main class="articles-management">
        <section class="article-form">
            <h2>Ajouter un Nouvel Article</h2>
            <form id="ajout-article-form" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <label for="nom-article">Nom de l'article:</label>
                <input type="text" name="nom" required><br><br>
                <label for="prix-article">Prix (TND):</label>
                <input type="number" name="prix" required><br><br>
                <label for="taille-article">Tailles disponibles:</label>
                <input type="text" name="taille" placeholder="S, M, L, XL, XXL" required><br><br>
                <label for="image-article">Image de l'article:</label>
                <input type="file" name="image"><br><br>
                <button type="submit">Ajouter Article</button>
            </form>
        </section>

        <section class="articles-list">
            <h2>Liste des Articles</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prix (TND)</th>
                        <th>Tailles</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="articles">
                    <?php foreach ($articles as $article): ?>
                    <tr>
                        <td><?= htmlspecialchars($article['nom']) ?></td>
                        <td><?= htmlspecialchars($article['prix']) ?> TND</td>
                        <td><?= htmlspecialchars($article['taille']) ?></td>
                        <td><img src="<?= htmlspecialchars($article['img']) ?>" alt="<?= htmlspecialchars($article['nom']) ?>" style="width: 50px; height: 50px;"></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="nom" value="<?= htmlspecialchars($article['nom']) ?>">
                                <button type="submit">Supprimer</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="nom" value="<?= htmlspecialchars($article['nom']) ?>">
                                <input type="number" name="prix" value="<?= htmlspecialchars($article['prix']) ?>" required>
                                <input type="text" name="taille" value="<?= htmlspecialchars($article['taille']) ?>" required>
                                <button type="submit">Mettre à jour</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
        // ... existing scripts ...
    </script>
</body>
</html>