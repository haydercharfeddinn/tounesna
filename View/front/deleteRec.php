<?php

include "../../controller/rec.php";

if (isset($_GET["id"])) {
    $reclamation = new reclamation();
    $reclamation->deletereclamation($_GET["id"]);

    echo "success";
} else {
    echo "error";
}
?>
