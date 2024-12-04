<?php
include "../../controller/comentaireC.php";
$b=new comentaireC;
$tab=$b->listcomentaires();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back Office</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        header {
            background: #35424a;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }

        header nav ul {
            list-style: none;
            padding: 0;
        }

        header nav ul li {
            display: inline;
            margin: 0 15px;
        }

        header nav ul li a {
            color: #ffffff;
            text-decoration: none;
        }

        main {
            padding: 20px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            background: #e2e2e2;
            padding: 20px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background: #35424a;
            color: #ffffff;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Back Office</h1>
            <nav>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="../back/ajoutcom.php">Ajouter</a></li>
                    <li><a href="#">Déconnexion</a></li>
                </ul>
            </nav>
        </header>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>contenue</th>
                    <th>date publication</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($tab as $comentaire){
                ?>
                <tr>
                    <td>
                        <?php echo $comentaire['id_c'];?>
                    </td>
                    <td>
                        <?php echo $comentaire['contenu_c'];?>
                    </td>
                    <td>
                        <?php echo $comentaire['date_pub_c'];?>
                    </td>
                    <td>
                        <form action="updatecom.php">
                            <input type="submit" name="update" value="update">
                            <input type="hidden" value=<?php echo $comentaire['id_c'];?> name="id_c">
                        </form>
                    </td>
                    <td>
                        <form action="deletecom.php">
                            <input type="submit" name="delete" value="delete">
                            <input type="hidden" value=<?php echo $comentaire['id_c'];?> name="id_c">
                        </form>
                    </td>
                    
                </tr>
                <?php }?>
            </tbody>
        </table>
        

        <footer>
            <p>&copy; 2023 Votre Entreprise</p>
        </footer>
    </div>
</body>

</html>
