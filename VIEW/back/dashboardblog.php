<?php
include "C:/xampp/htdocs/mico-html11/CONTROLLER/blogc.php";
include "C:/xampp/htdocs/mico-html11/MODEL/blogm.php";
$b = new BlogC;
$tab = $b->listBlogs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office</title>
    <style>
        /* Sidebar Styles */
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

        /* Main Content */
        main {
            margin-left: 240px;
            padding: 20px;
            background: #ffffff;
        }

        header h1 {
            text-align: center;
            margin-bottom: 20px;
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
        <a href="../back/dashboardcom.php">commentaire</a>
        <a href="../back/ajout.php">Ajouter</a>
        <a href="dashboard.php">Dashboard</a>
    </div>

    <!-- Main Content -->
    <main>
        <header>
            <h1>Back Office</h1>
            <nav>
                <a href="#">Dashboard</a> |
                <a href="./ajoutblog.php">Ajouter</a> |
                <a href="#">Déconnexion</a>
            </nav>
        </header>

        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Rechercher par contenu...">

        <table id="myTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Contenu</th>
                    <th>Date de publication</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tab as $blog) { ?>
                <tr>
                    <td><?php echo $blog['id']; ?></td>
                    <td><?php echo $blog['contenu']; ?></td>
                    <td><?php echo $blog['date_pub']; ?></td>
                    <td>
                        <?php if (!empty($blog['image'])): ?>
                            <img src="<?php echo $blog['image']; ?>" alt="Image Blog" style="width: 100px; height: 100px; object-fit: cover;">
                            <?php else: ?>
                            <p>No image</p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="updateblog.php"  style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">
                            <button type="submit">Update</button>
                        </form>
                        <form action="deleteblog.php" style="display: inline;">
                            <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>

    <script>
        // Recherche dynamique
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
