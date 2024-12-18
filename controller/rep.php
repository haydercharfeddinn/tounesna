<?php

require 'C:\xampp\htdocs\projetWeb2A\config.php';


class reponse
{

    public function listereponse()
    {
        $sql = "SELECT * FROM reponse";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletereponse($ide)
    {
        $sql = "DELETE FROM reponse WHERE idrep = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

  

    function showreponse($id){
        $sql = "SELECT * FROM reponse  where idrec=$id";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addreponse()
    {
        $sql = "INSERT INTO reponse (reponse,idrec) 
        VALUES ( :reponse,:idrec)";
        $db = config::getConnexion();
        try {
            $reponse=$_POST['reponse'];
            $idrec=$_POST['idrec'];
            $query = $db->prepare($sql);
            $query->execute([
                'reponse' => $reponse,
                'idrec' => $idrec
            ]
        );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

   

    function updatereponse($rep, $id)
    {try {
        $db = config::getConnexion();
        $query = $db->prepare(
            "UPDATE reponse SET 
                reponse = :reponse
            WHERE `reponse`.`idrep`= $id"
        );
        $query->execute([
            'reponse' => $rep->getreponse()
        ]);
        echo $query->rowCount() . " records UPDATED successfully <br>";
    } catch (PDOException $e) {
        $e->getMessage();
    }
    }
    function showrep($id){
        $sql = "SELECT * from reponse where idrep = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();
            $r = $query->fetch();
            return $r;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
