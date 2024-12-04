<?php 
include "../../controller/comentairec.php";
$b = new comentaireC();
$b->deletecomentaire($_GET['id_c']);
header("location:dashboardcom.php");
?>