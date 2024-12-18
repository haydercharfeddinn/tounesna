<?php
class config {
    private static $dbHost = 'localhost';   // Serveur de base de données
    private static $dbName = 'test'; // Nom de la base de données
    private static $dbUser = 'root'; // Utilisateur MySQL (par défaut : root)
    private static $dbPass = '';    // Mot de passe (par défaut vide pour XAMPP)

    public static function getConnexion() {
        try {
            $conn = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active les erreurs PDO
            return $conn;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}

?>
