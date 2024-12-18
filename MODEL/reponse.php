<?php
class rep {
    private $id;
    private $reponse;
    private $idrec;

    // Constructor with arguments
    public function __construct($id = null, $reponse = null, $idrec = null) {
        $this->id = $id;
        $this->reponse = $reponse;
        $this->idrec = $idrec;
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
