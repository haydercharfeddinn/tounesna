<?php
class event {
    private ?int $id;
    private ?string $type_;
    private ?string $nom_eve;
    private ?DateTime $date_;
    private ?float $price;

    // Constructor
    public function __construct(?int $id,  ?string $type_, ?string $nom_eve, ?DateTime $date_, ?float $price,) {
        $this->id = $id;
        $this->type_ = $type_;
        $this->nom_eve = $nom_eve;
        $this->date_ = $date_;
        $this->price = $price;
    }

    //getters and setters

    public function getId(): ?int {
        return $this->id;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setId(?int $id): void {
        $this->id = $id;// setter methode taabi be champ be champ
    }


    public function gettype(): ?string {
        return $this->type_;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function settype(?string $type_): void {
        $this->type_ = $type_;// setter methode taabi be champ be champ
    }


    public function getnom_eve(): ?string {
        return $this->nom_eve;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setnom_eve(?string $nom_eve): void {
        $this->nom_eve = $nom_eve;// setter methode taabi be champ be champ
    }

    
    public function getdate(): ?DateTime {
        return $this->date_;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setdate(?DateTime $date_): void {
        $this->date_ = $date_;// setter methode taabi be champ be champ
    }


    public function getprice(): ?float {
        return $this->price;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setprice(?float $price): void {    
        $this->price = $price;// setter methode taabi be champ be champ
    }
}






class clients {
    private ?int $id;
    private ?int $event_id;
    private ?string $email;
    private ?int $nbrp;

    // Constructor
    public function __construct(?int $id,  ?int $event_id, string $email, ?int $nbrp,) {
        $this->id = $id;
        $this->event_id = $event_id;
        $this->email = $email;
        $this->nbrp = $nbrp;
    }

    //getters and setters

    public function get_Id(): ?int {
        return $this->id;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function set_Id(?int $id): void {
        $this->id = $id;// setter methode taabi be champ be champ
    }


    public function getevent_id(): ?int {
        return $this->event_id;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setevent_id(?int $event_id): void {
        $this->event_id= $event_id;// setter methode taabi be champ be champ
    }


    public function getemail(): ?string {
        return $this->email;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setemail(?string $email): void {
        $this->email = $email;// setter methode taabi be champ be champ
    }


    public function getnbrp(): ?int {
        return $this->nbrp;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setnbrp(?int $nbrp): void {
        $this->nbrp = $nbrp;// setter methode taabi be champ be champ
    }
}
?>