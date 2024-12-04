<?php
include "../../controller/blogc.php";
include "../../model/blogm.php";
$b=new BlogC;
$tab=$b->listBlogs();
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
                    <li><a href="../back/ajout.php">Ajouter</a></li>
                    <li><a href="#">Déconnexion</a></li>
                </ul>
            </nav>
        </header>
        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for blogs">

        <table id="myTable">
            <thead>
                <tr>
                    <th class="sortable">id<span class="arrow">&#x2195;</span>
                    </th>
                    <th class="sortable">contenue<span class="arrow">&#x2195;</span>
                    </th>
                    <th class="sortable">date publication<span class="arrow">&#x2195;</span>
                    </th>
                    <th>image</th>
                    <th>avis</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($tab as $blog){
                ?>
                <tr>
                    <td>
                        <?php echo $blog['id'];?>
                    </td>
                    <td>
                        <?php echo $blog['contenu'];?>
                    </td>
                    <td>
                        <?php echo $blog['date_pub'];?>
                    </td>
                    <td>
                        <?php if (!empty($blog['image'])): ?>
                            <p><?php echo $blog['image']; ?></p> <!-- For debugging -->
                            <img src="<?php echo $blog['image']; ?>" alt="Image Blog" style="width: 100px; height: 100px; object-fit: cover;">
                            <?php else: ?>
                            <p>No image</p>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php echo $blog['avis']; ?>
                    </td>


                    <td>
                        <form action="updateblog.php">
                            <input type="submit" name="update" value="update">
                            <input type="hidden" value=<?php echo $blog['id'];?> name="id">
                        </form>
                    </td>
                    <td>
                        <form action="deleteblog.php">
                            <input type="submit" name="delete" value="delete">
                            <input type="hidden" value=<?php echo $blog['id'];?> name="id">
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
<script>
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    document.addEventListener("DOMContentLoaded", function () {
        const headers = document.querySelectorAll(".sortable");

        function sortByColumn(columnIndex) {
            const tableBody = document.querySelector("tbody");
            const rows = Array.from(tableBody.querySelectorAll("tr"));
            const isAscending = headers[columnIndex].classList.toggle("asc");

            rows.sort((rowA, rowB) => {
                const valueA = rowA.cells[columnIndex].textContent.trim();
                const valueB = rowB.cells[columnIndex].textContent.trim();

                if (columnIndex === 0) {
                    // If the column is the ID column, parse the values as integers for numeric sorting
                    return isAscending ? parseInt(valueA) - parseInt(valueB) : parseInt(valueB) - parseInt(valueA);
                } else if (columnIndex === 1) {
                    // If the column is the date column, convert the dates to objects for comparison
                    return isAscending
                        ? new Date(valueA) - new Date(valueB)
                        : new Date(valueB) - new Date(valueA);
                }

                return isAscending
                    ? valueA.localeCompare(valueB)
                    : valueB.localeCompare(valueA);
            });

            rows.forEach((row) => tableBody.appendChild(row));
        }


        headers.forEach((header, index) => {
            header.addEventListener("click", () => sortByColumn(index));
        });
    });

</script>
</html>