<?php
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