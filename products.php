<?php

 class Products{
    private $id;
    private $name;
    private $code_barre;
    private $prix_achat;
    private $prix_final;
    private $description;
    private $quantité_min;
    private $quantité_stock;
    private $offre_prix;
    private $category;
    private $image;


    public function __construct($id,$name,$code_barre,$prix_achat,$prix_final,$description,$quantité_min,$quantité_stock,$offre_prix,$category,$image) {
        $this->id = $id;
        $this->name = $name;
        $this->code_barre = $code_barre;
        $this->prix_achat = $prix_achat;
        $this->prix_final = $prix_final;
        $this->description = $description;
        $this->quantité_min = $quantité_min;
        $this->quantité_stock = $quantité_stock;
        $this->offre_prix = $offre_prix;
        $this->category = $category;
        $this->image = $image;
    }


    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of code_barre
     */ 
    public function getCode_barre()
    {
        return $this->code_barre;
    }

    /**
     * Get the value of prix_achat
     */ 
    public function getPrix_achat()
    {
        return $this->prix_achat;
    }

    /**
     * Get the value of prix_final
     */ 
    public function getPrix_final()
    {
        return $this->prix_final;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of quantité_min
     */ 
    public function getQuantité_min()
    {
        return $this->quantité_min;
    }

    /**
     * Get the value of quantité_stock
     */ 
    public function getQuantité_stock()
    {
        return $this->quantité_stock;
    }

    /**
     * Get the value of offre_prix
     */ 
    public function getOffre_prix()
    {
        return $this->offre_prix;
    }

    /**
     * Get the value of category
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Get the value of image
     */ 
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}

?>