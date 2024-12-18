<?php
class Config {
    private static $dbHost = 'localhost';   // Database server
    private static $dbName = 'test';      // Database name
    private static $dbUser = 'root';         // MySQL user (default: root)
    private static $dbPass = '';             // Password (default is empty for XAMPP)

    public static function getConnexion() {
        try {
            $conn = new PDO(
                "mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
                self::$dbUser,
                self::$dbPass
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}

// Create and return the connection instance
$conn = Config::getConnexion();
?>
