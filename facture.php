<?php

 class Facture{
    private $name;
    private $quantity;
    private $prix_final;
    private $total;


    public function __construct($name,$quantity,$prix_final,$total) {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->prix_final = $prix_final;
        $this->total = $total;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of quantity
     */ 
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Get the value of prix_final
     */ 
    public function getPrix_final()
    {
        return $this->prix_final;
    }

    /**
     * Get the value of total
     */ 
    public function getTotal()
    {
        return $this->total;
    }
}

?>