<?php

class config
{

    public static function getConnexion()
    {
        try {
            $pdo = new PDO(
                'mysql:host=localhost;dbname=web',
                'root',
                '',
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }

        return $pdo;
    }
}








config::getConnexion();
