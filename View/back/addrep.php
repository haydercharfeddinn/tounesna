<?php

include "../../controller/rep.php";

$rep=new reponse();
$rep->addreponse();
header('Location:listeRec.php');
?>

