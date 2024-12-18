<?php
class Blog
{
    private ?int $id = null;
    private ?string $contenu = null;
    private ?string $date_pub = null;
    private ?string $image = null; // Ajout de l'attribut image
    private ?string $avis = null; // Ajout de l'attribut avis

   
    // Le constructeur avec le paramètre image en option
    public function __construct($id = null, $contenu, $date_pub, $image = null)
    {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->date_pub = $date_pub;
        $this->image = $image; // Initialisation de l'image

    }

    // Getter pour l'id
    public function getId()
    {
        return $this->id;
    }

    // Getter et Setter pour le contenu
    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    // Getter et Setter pour la date de publication
    public function getDatePub()
    {
        return $this->date_pub;
    }

    public function setDatePub($date_pub)
    {
        $this->date_pub = $date_pub;
        return $this;
    }

    // Getter et Setter pour l'image
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }
    public function getAvis()
    {
        return $this->avis;
    }

    public function setAvis($avis)
    {
        $this->avis = $avis;
        return $this;
    }
}
class comentaire
{
    private ?int $id = null;
    private ?string $contenu = null;
    private ?string $date_pub = null;
    private ?string $id_b = null;


    public function __construct($id = null, $contenu = null, $date_pub = null )
    {
        $this->id = $id;
        $this->contenu = $contenu;
        $this->date_pub = $date_pub;

    }

    public function getId()
    {
        return $this->id;
    }

    public function getid_b()
    {
        return $this->id_b;
    }

    public function setid_b($id_b)
    {
        $this->id_b = $id_b;
        return $this;
    }
    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
        return $this;
    }

    public function getDatePub()
    {
        return $this->date_pub;
    }

    public function setDatePub($date_pub)
    {
        $this->date_pub = $date_pub;
        return $this;
    }
}
?>
