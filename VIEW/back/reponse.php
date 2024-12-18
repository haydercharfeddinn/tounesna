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
    </style>
</head>

<body>
<div class="sidebar">
        <a href="../back/affiche.php">Event</a>
        <a href="../back/backoffice.php">SHOP</a>
        <a href="../back/listeRec.php">Réclamation</a>
        <a class="sidebar-brand " href="../back/dashboardblog.php">blog </a>
    <a class="sidebar-brand " href="../back/admin/pages/dashboard.php">Admin </a>
    <a class="sidebar-brand " href="../back/createquiz.php">Quiz </a>
        <hr>
        <a href="../back/listerep.php">Réponse</a>
        <a href="statistique.php">Statistiques</a>
    </div>

    <div class="container">    
        <form action="addRep.php" method="post">
            <div class="row">
                <label for="sujet"><b>Réponse</b></label>
                <textarea id="reponse" name="reponse" placeholder="Votre réponse..." style="width:100%; height:200px;"></textarea>
            </div>
            <br>
            <div class="row">
                <input type="hidden" value="<?= htmlspecialchars($_GET['idrec'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" name="idrec">
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
</body>
</html>
