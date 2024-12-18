<?php
include "C:/xampp/htdocs/mico-html11/CONTROLLER/comentairec.php";
$b = new comentaireC;
$tab = $b->listcomentaires();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office - Commentaires</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Sidebar */
        .sidebar {
            width: 220px;
            background-color: #4e73df;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding: 10px 0;
            color: #fff;
            overflow-y: auto;
        }

        .sidebar a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #2e59d9;
            border-radius: 5px;
        }

        /* Main content */
        main {
            margin-left: 240px;
            padding: 20px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        header {
            background: #4e73df;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        input {
            margin-bottom: 15px;
            padding: 8px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #4e73df;
            color: white;
            cursor: pointer;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background: #4e73df;
            color: #ffffff;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="../back/affiche.php">Event</a>
        <a href="../back/backoffice.php">SHOP</a>
        <a href="../back/listeRec.php">Réclamation</a>
        <a href="../back/dashboardblog.php">Blog</a>
        <a href="../back/ajoutcom.php">Ajouter</a>
        <a href="dashboard.php">Dashboard</a>
    </div>

    <!-- Main Content -->
    <main>
        <header>
            <h1>Gestion des Commentaires</h1>
        </header>

        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher par contenu...">

        <table id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Contenu</th>
                    <th>Date de publication</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tab as $comentaire) { ?>
                <tr>
                    <td><?php echo $comentaire['id_c']; ?></td>
                    <td><?php echo htmlspecialchars($comentaire['contenu_c']); ?></td>
                    <td><?php echo $comentaire['date_pub_c']; ?></td>
                    <td>
                    <form action="updatecom.php?id_c=<?php echo $comentaire['id_c']; ?>" method="post">
                        <input type="hidden" name="id_c" value="<?php echo $comentaire['id_c']; ?>">
                            <button type="submit">Update</button>
                        </form>
                        <form action="deletecom.php" style="display: inline;">
                            <input type="hidden" name="id_c" value="<?php echo $comentaire['id_c']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <footer>
            <p>&copy; 2023 Votre Entreprise</p>
        </footer>
    </main>

    <!-- Script de recherche -->
    <script>
        function myFunction() {
            const input = document.getElementById("myInput").value.toUpperCase();
            const rows = document.querySelectorAll("#myTable tbody tr");

            rows.forEach(row => {
                const content = row.cells[1].textContent.toUpperCase();
                row.style.display = content.includes(input) ? "" : "none";
            });
        }
    </script>
</body>
</html>