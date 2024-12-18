<?php 
include "C:/xampp/htdocs/mico-html11/CONTROLLER/comentairec.php";
$b = new comentaireC();
$b->deletecomentaire($_GET['id_c']);
header("location:dashboardcom.php");
?>