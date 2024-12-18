<?php
session_start();
include 'connexion.php';
$bdd = maConnexion();

// Fetch top selling products
$query_top_sellers = "
    SELECT produit_nom, COUNT(*) as total_vendus
    FROM commandes
    GROUP BY produit_nom
    ORDER BY total_vendus DESC
    LIMIT 5";
$top_sellers = $bdd->query($query_top_sellers)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Backoffice</title>
    <link rel="icon" href="icon.png">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .stats-management {
            max-width: 1200px;
            margin: 50px 300px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .chart-container {
            margin-top: 30px;
            text-align: center;
        }

        canvas {
            max-width: 600px;
            margin: 0 auto;
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/affiche.php">
        
        <div class="sidebar-brand-text mx-3">Event <sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/backoffice.php">
        
        <div class="sidebar-brand-text mx-3">SHOP <sup></sup></div>
      
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <a id="icon-messagerie" href="backoffice_commandes.php">
         📩 
            </a>

</ul>
<!-- End of Sidebar -->
    <main class="stats-management">
        <h1>Statistiques des Articles</h1>
        <section>
            <h2>Articles les Plus Vendus</h2>
            <div class="chart-container">
                <canvas id="topSellersChart"></canvas>
            </div>
        </section>
    </main>

    <script>
        // Préparer les données PHP pour JavaScript
        const topSellers = <?php echo json_encode($top_sellers); ?>;

        // Extraire les noms des produits et les quantités vendues
        const labels = topSellers.map(item => item.produit_nom);
        const data = topSellers.map(item => item.total_vendus);

        // Configurer le graphique
        const ctx = document.getElementById('topSellersChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut', // Type de graphique : roue
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quantité Vendue',
                    data: data,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                    }
                }
            }
        });
    </script>
</body>
</html>
