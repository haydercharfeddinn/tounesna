<?php
// Include the necessary files
include_once '../../CONTROLLER/eventcontroller.php';  // Path to the controller
include_once '../../MODEL/event.php';  // Path to the Event class

// Create an instance of the EventController
$eventController = new EventController();

// Retrieve the events from the controller (assuming there is a method like getAllEvents)
$events = $eventController->listevent(); // Fetch the events (you need to define this method in the controller)

// If no events are found, you can handle that here.
if (!$events) {
    echo "Aucun événement trouvé.";
    exit();
}
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
            margin: 50px 300px;
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

<div class="container">
    <h2>Liste des Événements</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>type</th>
                <th>nom de l'evenement</th>
                <th>Date</th>
                <th>Prix</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($events as $event) { ?>
                <tr>
                    <td><?= $event['id'] ?></td>
                    <td><?= $event['type_'] ?></td>
                    <td><?= $event['nom_eve'] ?></td>
                    <td><?= $event['date_'] ?></td>
                    <td><?= $event['price'] ?> €</td>
                    <td>
                        <a href="modifier.php?id=<?= $event['id'] ?>"><button class="btn btn-outline-success btn-sm">Modifier</button></a>
                        <a href="supprimer.php?id=<?= $event['id'] ?>"><button class="btn btn-outline-danger btn-sm">Supprimer</button></a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../front/event.html">
        
        <div class="sidebar-brand-text mx-3">Event <sup></sup></div>
      
    </a>
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../back/backoffice.php">
        
        <div class="sidebar-brand-text mx-3">SHOP <sup></sup></div>
      
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">


    


</ul>
<!-- End of Sidebar -->

    

</div>

<script>
    // If necessary, include JavaScript functionality here
</script>

</body>
</html>
