<?php
include "../../CONTROLLER/rep.php";
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
            background-color: #4e73df;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 15px 0;
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
            background-color: #2e59d9;
            border-radius: 5px;
        }
        /* Container styles */
        .container {
            margin-left: 260px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 20px;
        }
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
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
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
    </style>
</head>

<body>
    <div class="sidebar">
        <a href="../back/affiche.php">Event</a>
        <a href="../back/backoffice.php">SHOP</a>
        <a href="../back/listeRec.php">Réclamation</a>
        <hr>
        <a href="../back/listerep.php">Réponse</a>
        <a href="statistique.php">Statistiques</a>
    </div>

    <div class="container">
        <h2>Liste des Réponses</h2>
        <div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Réponse</th>
                                <th>Réponse</th>
                                <th>ID Réclamation</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $c = new reponse();
                            $reponses = $c->listereponse();
                            foreach ($reponses as $tab): ?>
                                <tr>
                                    <td><?= htmlspecialchars($tab['idrep']); ?></td>
                                    <td><?= htmlspecialchars($tab['reponse']); ?></td>
                                    <td><?= htmlspecialchars($tab['idrec']); ?></td>
                                    <td>
                                        <form method="POST" action="updaterep.php">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($tab['idrep']); ?>">
                                            <button type="submit" class="btn btn-outline-success">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="deleteRep.php?id=<?= htmlspecialchars($tab['idrep']); ?>" class="btn btn-outline-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
</body>
</html>
