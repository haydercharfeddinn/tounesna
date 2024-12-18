<?php

require '../../config.php';


class reclamation
{

    public function listreclamation()
    {
        $sql = "SELECT * FROM reclamation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deletereclamation($ide)
    {
        $sql = "DELETE FROM reclamation WHERE idrec = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $ide);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

  

    function showreclamation($nom,$prenom){
        $sql = "SELECT * FROM reclamation where nom='$nom' and prenom='$prenom'";
        $db = config::getConnexion();
        try{
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    function addreclamation()
    {
        $date=date("Y-m-d");

        $sql = "INSERT INTO reclamation (nom,prenom,ville,date,sujetrec) 
        VALUES ( :nom,:prenom, :ville,:date,:sujet)";
        $db = config::getConnexion();
        try {
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $ville=$_POST['ville'];
            $sujet=$_POST['sujet'];
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $nom,
                'prenom' => $prenom,
                'ville' => $ville,
                'sujet' => $sujet,
                'date' => $date
            ]
        );
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

   

    function updatereclamation($rec, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                "UPDATE reclamation SET 
                    sujetrec = :sujet
                WHERE `reclamation`.`idrec`= $id"
            );
            $query->execute([
                'sujet' => $rec->getsujet()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    function showrec($id){
        $sql = "SELECT * from reclamation where idrec = $id";
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
    function showreccount1(){
        $sql = "SELECT count(*) from reclamation where ville='Réservation'";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $r=$query->execute();
            return $r;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function showreccount2(){
        $sql = "SELECT count(*) from reclamation where ville='e-commerce'";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $r=$query->execute();
            return $r;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    function showreccount3(){
        $sql = "SELECT count(*) from reclamation where ville='Problème général'";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $r=$query->execute();
            return $r;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}





