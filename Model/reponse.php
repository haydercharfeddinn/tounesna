<?php
class rep
{
    private $idrep;
    private  $reponse;
    private  $idrec;

    public function __construct( $id=null,$r,$idr)
    {
        $this->idrep = $id;
        $this->reponse = $r;
        $this->idrec = $idr;
    }

   
   
    public function getreponse()
    {
        return $this->reponse;
    }

    
    public function setreponse($rep)
    {
        $this->reponse = $rep;

        return $this;
    }
}
