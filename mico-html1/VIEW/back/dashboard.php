<?php
// Inclusion des fichiers nécessaires
include_once '../../CONTROLLER/eventcontroller.php';  // Inclure le contrôleur
include_once '../../MODEL/event.php';  // Inclure le modèle

// Création de l'instance du contrôleur
$eventcontroller = new eventcontroller();

// Récupération des statistiques de réservation
$reservationStats = $eventcontroller->getReservationStats();

// Test temporaire pour vérifier les données
// echo '<pre>'; print_r($reservationStats); echo '</pre>';

$eventNames = [];
$reservationCounts = [];

foreach ($reservationStats as $stat) {
    $eventNames[] = $stat['nom_eve'];  // Nom des événements
    $reservationCounts[] = isset($stat['total_reservations']) ? $stat['total_reservations'] : 0;  // Vérification de la clé
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Statistiques de Réservations</title>
    <!-- Inclusion de Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fc;
            margin: 0;
            padding: 0;
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

        .container {
            margin: 50px auto;
            max-width: 900px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #4e73df;
        }

        canvas {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Statistiques de Réservations</h2>
    <!-- Zone pour afficher le graphique -->
    <canvas id="reservationChart"></canvas>
</div>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../front/event.html">
        
        <div class="sidebar-brand-text mx-3">Event <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    <li class="nav-item active">
        <a class="nav-link" href="../back/ajout.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Ajouter</span></a>
    </li>

    <li class="nav-item active">
            <a class="nav-link" href="affiche.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Back to event List</span></a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
            <a class="nav-link" href="afficheclientt.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Client list</span></a>
    </li>

    </ul>
    <!-- End of Sidebar -->

<script>
    // Données récupérées depuis PHP
    const eventNames = <?php echo json_encode($eventNames); ?>;
    const reservationCounts = <?php echo json_encode($reservationCounts); ?>;

    // Configuration du graphique
    const ctx = document.getElementById('reservationChart').getContext('2d');
    const reservationChart = new Chart(ctx, {
        type: 'bar',  // Type du graphique (barres)
        data: {
            labels: eventNames,  // Noms des événements
            datasets: [{
                label: 'Nombre de réservations',
                data: reservationCounts,  // Nombres de réservations
                backgroundColor: 'rgba(78, 115, 223, 0.6)',  // Couleur des barres
                borderColor: 'rgba(78, 115, 223, 1)',  // Couleur des bordures
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,  // Rendre le graphique adaptatif
            plugins: {
                legend: {
                    display: true,  // Afficher la légende
                    position: 'top'  // Position de la légende
                }
            },
            scales: {
                y: {
                    beginAtZero: true  // Commencer l'axe Y à zéro
                }
            }
        }
    });
</script>

</body>
</html>
