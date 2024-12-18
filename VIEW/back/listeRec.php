<?php
include "../../CONTROLLER/rec.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les Événements</title>
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
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

        /* Container styles */
        .container {
            max-width: 1200px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        /* Header styles */
        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }

        /* Table styles */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #dee2e6;
        }

        .table th {
            background-color: #343a40;
            color: #fff;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #e9ecef;
        }

        /* Button styles */
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-outline-success {
            color: #28a745;
            border: 1px solid #28a745;
            background-color: transparent;
        }

        .btn-outline-success:hover {
            background-color: #28a745;
            color: #fff;
        }

        .btn-outline-danger {
            color: #dc3545;
            border: 1px solid #dc3545;
            background-color: transparent;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }

        /* Back to front-end button */
        .back-to-front {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 10px 15px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .back-to-front:hover {
            background-color: #0056b3;
        }

    </style>
</head>

<body>
    <div class="sidebar">
        <a class="sidebar-brand" href="../back/affiche.php">Event</a>
        <a class="sidebar-brand" href="../back/backoffice.php">SHOP</a>
        <a class="sidebar-brand" href="../back/listeRec.php">Réclamation</a>
        <hr class="sidebar-divider">
        <a class="nav-link" href="../back/listerep.php">Réponse</a>
        <a class="nav-link" href="statistique.php">Statistiques</a>
    </div>

    <div class="container">
        <h2>Liste des Réclamations</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Problème avec</th>
                    <th>Date</th>
                    <th>Sujet</th>
                    <th>Répondre</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $c = new reclamation();
            $reclamation = $c->listreclamation();
            foreach ($reclamation as $tab): ?>
                <tr>
                    <td><?= htmlspecialchars($tab['idrec']); ?></td>
                    <td><?= htmlspecialchars($tab['nom']); ?></td>
                    <td><?= htmlspecialchars($tab['prenom']); ?></td>
                    <td><?= htmlspecialchars($tab['ville']); ?></td>
                    <td><?= htmlspecialchars($tab['date']); ?></td>
                    <td><?= htmlspecialchars($tab['sujetrec']); ?></td>
                    <td><a href="reponse.php?idrec=<?= urlencode($tab['idrec']); ?>" class="btn btn-outline-success">Répondre</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</body>
</html>
