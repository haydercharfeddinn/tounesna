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






class ticket {
    private ?int $id;
    private ?int $event_id;
    private ?int $user_id;
    private ?DateTime $purchase_date;
    private ?int $quantity;
    private ?float $total_total_price;

    // Constructor
    public function __construct(?int $id,  ?string $type_, ?string $user_id, ?DateTime $purchase_date, ?float $total_price,) {
        $this->id = $id;
        $this->event_id = $event_id;
        $this->user_id = $user_id;
        $this->purchase_date = $purchase_date;
        $this->quantity = $quantity;
        $this->total_total_price = $total_total_price;
    }

    //getters and setters

    public function get_Id(): ?int {
        return $this->id;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function set_Id(?int $id): void {
        $this->id = $id;// setter methode taabi be champ be champ
    }


    public function getevent_id(): ?int {
        return $this->type_;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setevent_id(?int $event_id): void {
        $this->event_id= $event_id;// setter methode taabi be champ be champ
    }


    public function getuser_id(): ?int {
        return $this->user_id;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setuser_id(?int $user_id): void {
        $this->user_id = $user_id;// setter methode taabi be champ be champ
    }

    
    public function getpurchase_date(): ?DateTime {
        return $this->purchase_date;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setpurchase_date(?DateTime $purchase_date): void {
        $this->purchase_date = $purchase_date;// setter methode taabi be champ be champ
    }


    public function getquantity(): ?int {
        return $this->quantity;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function setquantity(?int $quantity): void {    
        $this->quantity = $quantity;// setter methode taabi be champ be champ
    }


    public function gettotal_price(): ?float {
        return $this->total_price;//tekhou ml classe 'un enregistrement ) , khatrou private matnjmch takhou direcet lazmek getter
    }
    public function settotal_price(?float $total_price): void {    
        $this->total_price = $total_price;// setter methode taabi be champ be champ
    }
}
?>