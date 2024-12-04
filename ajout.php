<?php 
include '../../controller/blogc.php';  // Path to the controller
include '../../model/blogm.php';  // Path to the Event class

$error = "";

// create an instance of the controller
$blogcontroller = new BlogC();

if (isset($_POST["contenu"])) {
    if (!empty($_POST["contenu"])) {
        // Gestion de l'image
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = "uploads/"; 
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            // Vérifier si l'image est de type valide (jpg, png, jpeg, gif)
            if (in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
                $imagePath = $targetFile; 
            } else {
                $error = "Désolé, seuls les fichiers JPG, PNG, JPEG, GIF sont autorisés.";
            }
        }

        $blog = new Blog(
            null,
            $_POST['contenu'],
            null
        );

        // Ajout du blog avec image (si l'image a été téléchargée)
        $blogcontroller->addBlog($blog, $imagePath);

        header('Location: dashboard.php');
    } else {
        $error = "Informations manquantes";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un blog</title>
    <style>
        /* ... Votre style CSS reste inchangé ... */
    </style>
</head>
<body>

<div class="container">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <!-- Sidebar Content -->
    </ul>

    <h2>Ajouter un blog</h2>
    <form id="eventForm" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <label for="contenu">Contenu</label>
        <input type="text" id="contenu" name="contenu" required>

        <label for="image">Image (optionnelle)</label>
        <input type="file" id="image" name="image">

        <button type="submit">Ajouter</button>
    </form>

    <?php if ($error): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>
</div>

<script>
    // Validation JavaScript (facultative, vous pouvez ajouter plus de conditions si nécessaire)
    function validateForm() {
        const contenu = document.getElementById('contenu').value;
        if (!contenu.trim()) {
            alert('Le contenu est obligatoire');
            return false;
        }
        return true;
    }
</script>

</body>
</html>
