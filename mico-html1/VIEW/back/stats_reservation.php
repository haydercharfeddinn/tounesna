<?php
include_once '../../CONTROLLER/eventcontroller.php'; // Inclure le contrôleur
include_once '../../MODEL/event.php'; // Inclure le modèle

$eventcontroller = new eventcontroller();
$stats = $eventcontroller->getReservationStats();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Réservations</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            color: #5a5c69;
        }

        h2 {
            text-align: center;
            color: #4e73df;
        }

        .container {
            margin: 20px auto;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .table th {
            background-color: #4e73df;
            color: #fff;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            height: 100vh;
            background-color: #4e73df;
            color: white;
            padding: 20px;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            margin: 10px 0;
            padding: 10px;
            background: #2e59d9;
            border-radius: 5px;
            text-align: center;
        }

        .sidebar a:hover {
            background: #1e3e8d;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="affiche.php">Liste des Événements</a>
        <a href="stats_reservation.php">Statistiques des Réservations</a>
    </div>

    <div class="container">
        <h2>Statistiques des Réservations</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Événement</th>
                    <th>Nombre Total de Places Réservées</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($stats)): ?>
                    <?php foreach ($stats as $stat): ?>
                        <tr>
                            <td><?= htmlspecialchars($stat['nom_eve']) ?></td>
                            <td><?= htmlspecialchars($stat['total_places']) ?: 0 ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">Aucune donnée disponible</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
