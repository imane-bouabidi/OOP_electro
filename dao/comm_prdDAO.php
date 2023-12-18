<?php
include '../database/connexion.php';
include '../database/db_config.php';

class ProCommandeDAO{

    private $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getCommProduits(){
        $query = "SELECT * FROM commande_produit";
        $stmt = $this->pdo->query($query);
        $stmt->execute();
        $CommProduits = $stmt->fetchALL();
        $CommProduitsDATA = array();
        foreach($CommProduits as $CommProduct){
            $CommProduitsDATA = new ProCommande($CommProduct['idcom'],$CommProduct['idproduit'],$CommProduct['quantite'],$CommProduct['prix_unitaire'],$CommProduct['prix_total']);
        }
        return $CommProduitsDATA;
    }

}


?>