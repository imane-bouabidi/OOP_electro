<?php

class CommandeDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection(); 
    }

    public function add_Commande($idclient,$date_envoi,$date_livraison,$prix_total){
        //date actuelle
        $dateActuelle = date("Y-m-d H:i:s");
        //verifier si commande existe deja
        $verifier_existance_commande = "SELECT * FROM commande WHERE idclient = $idclient AND etat LIKE '%EN attente%'";
        $stmt = $pdo->prepare($verifier_existance_commande);
        $stmt->execute();
        $affected_rows = $stmt->rowCount();
        if (!$stmt || $affected_rows == 0) {
            //s'elle n'existe pas
            $inserer = "INSERT INTO commande(date_creation, date_envoi, date_livraison, prix_total, idclient, etat) VALUES ('$dateActuelle', NULL, NULL, '$prix_total', '$idclient', 'EN attente')";
            $inserer_commande = $pdo->prepare($inserer);
            $inserer_commande->execute();
            //exception si l'insertion ne fonctionne pas
            if (!$inserer_commande) {
                throw new PDOException("Échec lors de l'insertion dans la table 'commande': " . $pdo->errorInfo()[2]);
            }
            $id_com = $pdo->lastInsertId();
        } else {
            //recuperer l'id de la commande deja existante
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row === false) {
                throw new PDOException("Aucun résultat trouvé.");
            }
            $idcom = $row['idcom'];
        }
    }

    public function get_commande(){
        $get = "SELECT * FROM commande";
        $stmt = $pdo->query($get);
        $stmt->execute();
        $commandesDATA = $stmt->fetchAll();
        $commandes = array();
        foreach($commandesDATA as $commande){
            $commandes[] = new Catagory($commande['name'], $commande['description'], $commande['image']);
        }
        return $commandes;
    }


    public function validate_commande($idcom){
        $validate_commande = "UPDATE commande SET etat = 'EN cours',
                                    WHERE idcom = '$idcom'";   
        $stmt = $pdo->prepare($validate_commande);
        $stmt->execute();
    }
    
    
    public function update_statut($idcom,$etat){
        $update_statut = "UPDATE commande SET etat = '$etat',
                                    WHERE idcom = '$idcom'";   
        $stmt = $pdo->prepare($update_statut);
        $stmt->execute();
    }



    public function Delete_commande($idcom){
        $delete = "DELETE FROM commande where idcom = $idcom";
        $stmt = $pdo->prepare($delete);
        $stmt->execute();
    }
}
?>