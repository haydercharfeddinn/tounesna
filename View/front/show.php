<?php

include "../../controller/rec.php";
$c = new reclamation();
$reclamation = $c->showreclamation($_POST['n'], $_POST['p']);

?>
<style>
    .but {
        background-color: #123132;
        color: white;
        padding: 12px 17px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: left;
        text-decoration: none;
        margin-left: 650px;
    }

    .but:hover {
        background-color: #ddd;
    }
</style>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css.css" />
    <link rel="stylesheet" href="css22.css" />
    <title>Reclamation</title>
</head>

<header>
    <div class="header">
        <a href="index.html" class="logo"><img src="images/logo.png" alt=""></a>
        <li class="nav-item active">
                    <a class="nav-link" href="reclamation.html">reclamation</a>
                  </li>
    </div>
</header>

<?php if ($reclamation->rowCount() > 0) { ?>
    <center>
        <h1>Liste des reclamations</h1>
    </center>
    <table border="1" align="center" width="70%">
        <tr>
            <th>ID reclamation </th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Problème</th>
            <th>date</th>
            <th>sujet du reclamation</th>
            <th>Update</th>
            <th>Delete</th>
            <th>Reponse</th>
        </tr>

        <?php
        foreach ($reclamation as $tab) { ?>
            <tr id="reclamation-<?= $tab['idrec']; ?>">
                <td><?php echo $tab['idrec']; ?></td>
                <td><?php echo $tab['nom']; ?></td>
                <td><?php echo $tab['prenom']; ?></td>
                <td><?php echo $tab['ville']; ?></td>
                <td><?php echo $tab['date']; ?></td>
                <td><?php echo $tab['sujetrec']; ?></td>

                <td align="center">
                    <form method="POST" action="updateRec.php">
                        <input type="submit" name="update" value="Update">
                        <input type="hidden" value=<?php echo $tab['idrec']; ?> name="id">
                    </form>
                </td>
                <td>
                    <button class="delete-btn" data-id="<?= $tab['idrec']; ?>">Delete</button>
                </td>
                <td>
                    <a href="showrep.php?id=<?= $tab['idrec']; ?>">Consulter la reponse</a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <center><h2>Aucune reclamation trouvee!</h2></center>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(".delete-btn").click(function() {
        var reclamationId = $(this).data("id");

        $.ajax({
            url: "deleteRec.php", // Path to your delete PHP script
            type: "GET",
            data: { id: reclamationId }, // Pass the ID to delete
            success: function(response) {
                if (response === "success") {
                    // Remove the deleted reclamation row from the table
                    $("#reclamation-" + reclamationId).fadeOut();
                } else {
                    alert("Error deleting reclamation.");
                }
            },
            error: function() {
                alert("An error occurred.");
            }
        });
    });
});
</script>
</body>

</html>
