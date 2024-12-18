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
class BlogC
{
    // Liste de tous les blogs
    public function listBlogs()
    {
        $sql = "SELECT * FROM blog";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    // Suppression d'un blog
    public function deleteBlog($id)
    {
        $sql = "DELETE FROM blog WHERE id = :id";
        $db = config::getConnexion();

        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function addBlog($blog, $imagePath = null )
{
    // If an image is uploaded, add it to the insertion
    if ($imagePath) {
        $sql = "INSERT INTO blog (contenu, date_pub, image) VALUES (:contenu, NOW(), :image)";
    } else {
        $sql = "INSERT INTO blog (contenu, date_pub) VALUES (:contenu, NOW())";
    }
    
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'contenu' => $blog->getContenu(),
            'image' => $imagePath // If an image is provided, add it
        ]);
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
    public function addAvis($id,$avis)
    {
        $sql = "INSERT INTO blog (avis) VALUES (:avis) WHERE id=:id";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                'id'=> $id,
                'avis' => $avis 
            ]);
        } catch (Exception $e){
            echo 'Error: ' . $e->getMessage();

        }
    }

    // Afficher un blog spécifique
    public function showBlog($id)
    {
        $sql = "SELECT * FROM blog WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $blog = $query->fetch();
            return $blog;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateBlog($id, $contenu, $date, $imagePath = null)
    {
            $sql = "UPDATE blog SET contenu = :contenu, date_pub = :date_pub, image = :image WHERE id = $id";
        

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'contenu' => $contenu,
                'date_pub' => $date,
                'image' => $imagePath
            ]);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}
?>
