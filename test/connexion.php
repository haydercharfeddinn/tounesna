<?php function maConnexion()
{
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
        return $bdd;
    } catch (PDOException $e) {
        die('Erreur :' . $e->getMessage());
    }
}
?>