<?php

public class Commande{
    private $idcom;
    private $date_creation;
    private $date_envoi;
    private $date_livraison;
    private $prix_total;
    private $idclient;
    private $etat;

    public function __construct($idcom, $date_creation,$date_envoi,$date_livraison,$prix_total,$idclient,$etat) {
        $this->idcom = $idcom;
        $this->date_creation = $date_creation;
        $this->date_envoi = $date_envoi;
        $this->date_livraison = $date_livraison;
        $this->prix_total = $prix_total;
        $this->idclient = $idclient;
        $this->etat = $etat;
    }

    /**
     * Get the value of idcom
     */ 
    public function getIdcom()
    {
        return $this->idcom;
    }

    /**
     * Get the value of date_creation
     */ 
    public function getDate_creation()
    {
        return $this->date_creation;
    }

    /**
     * Get the value of date_envoi
     */ 
    public function getDate_envoi()
    {
        return $this->date_envoi;
    }

    /**
     * Get the value of date_livraison
     */ 
    public function getDate_livraison()
    {
        return $this->date_livraison;
    }

    /**
     * Get the value of prix_total
     */ 
    public function getPrix_total()
    {
        return $this->prix_total;
    }

    /**
     * Get the value of idclient
     */ 
    public function getIdclient()
    {
        return $this->idclient;
    }

    /**
     * Get the value of etat
     */ 
    public function getEtat()
    {
        return $this->etat;
    }
}

?>