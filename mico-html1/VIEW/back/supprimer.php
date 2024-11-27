<?php
include '../../CONTROLLER/eventcontroller.php';


$c = new eventcontroller();
$c->deleteevent($_GET["id"]);
header('Location:affiche.php');


?>