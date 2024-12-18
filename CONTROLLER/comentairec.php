<?php

require "../../config.php";

class comentaireC
{
    public function listcomentaires()
    {
        $sql = "SELECT * FROM comentaire";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function deletecomentaire($id)
    {
        $sql = "DELETE FROM comentaire WHERE id_c = :id";
        $db = config::getConnexion();

        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addcomentaire($comentaire)
    {
        $sql = "INSERT INTO comentaire (contenu_c,date_pub_c,id_b) VALUES (:contenu_c,NOW(),:id_b)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'contenu_c' => $comentaire->getContenu(),
                'id_b' => $comentaire->getid_b(),
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function showcomentaire($id)
    {
        $sql = "SELECT * FROM comentaire WHERE id_c = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $comentaire = $query->fetch();
            return $comentaire;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updatecomentaire($id,$contenu,$date)
    {
        $sql = "UPDATE comentaire SET
                    contenu_c = '$contenu', 
                    date_pub_c = '$date'
                    WHERE id_c = $id ";
       
            $db = config::getConnexion();
            $query = $db->prepare($sql);
            try {
            $query->execute();

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}