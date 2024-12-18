<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher les Statistiques</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
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
        .card {
            margin-bottom: 20px;
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
        <h2>Statistiques des Profits</h2>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Graphique des Profits
            </div>
            <div class="card-body">
                <canvas id="myBarChart" width="100%" height="30"></canvas>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../back/fpdf/demo/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="../back/fpdf/demo/chart-area-demo.js"></script>
        <script src="../back/fpdf/demo/chart-bar-demo.php"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="../back/fpdf/demo/datatables-simple-demo.js"></script>
</body>
</html>