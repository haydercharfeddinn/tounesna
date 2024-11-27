<?php
include(__DIR__ . '/../config.php');//bech torbet mabin ficihier : eli fihom connexion ala base
include(__DIR__ . '/../Model/event.php');//bech torbet mabin ficihier : eli fihom class
class eventcontroller
{
    public function listevent()// affiche kol chyy
    {
        $sql = "SELECT * FROM events";
        $db = config::getConnexion();  //initialitaion de variable mte3 el base
        try {

            $liste = $db->query($sql);//nlanci requette
            return $liste;
        } catch (Exception $e) { //ereeur
            die('Error:' . $e->getMessage());
        }
    }
    function deleteevent($id)
    {
        $sql = "DELETE FROM events WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);// hadharha
        $req->bindValue(':id', $id);//insertion de variable au requete , ken hab nom rahou hat nom

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    function addevent($event)
    {
        if ($event === null) {
            echo 'Error: The $event object is null.';
            return;
        }

        $sql = "INSERT INTO events  
        VALUES (NULL, :type_, :nom_eve, :date_, :price)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':type_' => $event->gettype(),
                ':nom_eve' => $event->getnom_eve(),
                ':date_' => $event->getdate()->format('Y-m-d'),
                ':price' => $event->getprice()
            ]);
            echo 'Événement ajouté avec succès.';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    
    function updateevent($event, $id)
{
    var_dump($event); // affiche offre lkdima kbal update
    try {
        $db = config::getConnexion();

        $query = $db->prepare(  // preparation
            'UPDATE traveloffer SET 
                type_ = :type_,
                nom_eve = :nom_eve,
                date_ = :date_,
                price = :price,
                
            WHERE id = :id'
        );

        $query->execute([   //executa
            ':id'=>$event->getId(),
            ':type_' => $event->gettype(),
            ':nom_eve' => $event->getnom_eve(),
            ':date_' => $event->getdate()->format('Y-m-d'),
            ':price' => $event->getprice()
        ]);

        echo $query->rowCount() . " records UPDATED successfully <br>";  //rowcount : tesheb nb des lignes
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage(); 
    }
}

function showevent($id)
    {
        $sql = "SELECT * from events where id = $id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $event = $query->fetch();     //fetch: taffichi ala tableau zid thabet feha :
            return $event;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }



        private $db;
    
        public function __construct() {
            $this->db = config::getConnexion();
        }
    
        // Méthode pour récupérer tous les événements
        public function getAllEvents() {
            try {
                $query = $this->db->prepare("SELECT * FROM events");
                $query->execute();
                return $query->fetchAll(); // Retourne tous les événements
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
    

}

//...............................................................................................................................................

class ticketcontroller{
    function addticket($ticket)
    {
        if ($ticket === null) {
            echo 'Error: The $ticket object is null.';
            return;
        }

        $sql = "INSERT INTO tickets  
        VALUES (NULL, :event_id, :user_id, :purchase_date, :quantity, :total_price)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                ':event_id' => $ticket->getevent_id(),
                ':user_id' => $ticket->getuser_id(),
                ':purchase_date' => $ticket->getpurchase_date()->format('Y-m-d'),
                ':quantity' => $ticket->getquantity(),
                ':total_price' => $ticket->gettotal_price()
            ]);
            echo 'Événement ajouté avec succès.';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }



}
?>