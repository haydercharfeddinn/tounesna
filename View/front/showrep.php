<?php

include "../../controller/rep.php";

$c = new reponse();
$reclamation = $c->showreponse($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css.css" />
    <link rel="stylesheet" href="css22.css" />
    <title>reponse</title>
</head>
<header>
<div class="header">
    <a href="index.html" class="logo"><img src="images/logo.png" alt=""></a>
    <div class="header-right">
      <a href="index.html">Home</a>
      <a href="login.html">Se Connecter</a>
    </div>
  </div>
  
</header>
<?php  if ($reclamation->rowCount() > 0){?>
<center>
    <h1>Liste des reponses</h1>
</center>
<table border="1" align="center" width="70%">
    <tr>
        <th>ID reponse </th>
        <th>Reponse</th>
        <th>Id reclamation</th>
    </tr>


<?php
        
        foreach ($reclamation as $tab) { ?>
            <tr>
                <td><?php  echo  $tab['idrep']; ?></td>
                <td><?php  echo $tab['reponse'] ;?></td>
                <td><?php  echo $tab['idrec']; ?></td>
            </tr>
    <?php }
    ?>
</table>
<?php 
}else {
    
    ?>
    <center><h2>Aucune reponse trouvee!</h2></center>
    <?php
}

?>