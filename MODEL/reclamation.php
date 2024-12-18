<?php
class rec
{
    private $id;
    private  $nom;
    private  $prenom;
    private  $ville;
    private ?DateTime $date;
    private  $sujet;

    public function __construct( $id=null,$n, $p, $v,$d, $s)
    {
        $this->id = $id;
        $this->nom = $n;
        $this->prenom = $p;
        $this->ville = $v;
        $this->date = $d;
        $this->sujet = $s;
    }

   
   
    public function getnom()
    {
        return $this->nom;
    }
    /**
     * Set the value of firstName
     *
     * @return  self
     */
    
    public function setnom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

   
    public function getprenom()
    {
        return $this->prenom;
    }
    
   /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setprenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

   
    public function getville()
    {
        return $this->ville;
    }
   /**
     * Set the value of firstName
     *
     * @return  self
     */
    
    public function setville($ville)
    {
        $this->ville = $ville;

        return $this;
    }
    public function getdate()
    {
        return $this->date;
    }

  /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function getsujet()
    {
        return $this->sujet;
    }

    /**
     * Set the value of firstName
     *
     * @return  self
     */
    public function setsujet($sujet)
    {
        $this->sujet = $sujet;

        return $this;
    }
}
