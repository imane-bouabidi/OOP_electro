<?php
include_once 'C:\xampp\htdocs\projects\poo brief 1\dao\commandeDAO.php';
include_once 'C:\xampp\htdocs\projects\poo brief 1\products.php';
include_once 'C:\xampp\htdocs\projects\poo brief 1\facture.php';
// $commande = new CommandeDAO();
// $produit = new productsDAO();

class ProCommandeDAO{

    private $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function add_to_commande($idprod){
        $get_prod = "SELECT * FROM product where id = '$idprod'";
        $stmt_get = $this->pdo->prepare($get_prod);
        $stmt_get->execute();
        $productDATA = $stmt_get->fetch(PDO::FETCH_ASSOC);
        if (!$productDATA) {
            // Product not found, handle this case if needed
            echo "Product not found!";
            return;
        }
        // Vérifier si une commande en attente existe
        $get_com_if_exists = "SELECT idcom FROM commande WHERE etat = 'EN attente'";
        $stmt_com = $this->pdo->prepare($get_com_if_exists);
        $stmt_com->execute();
        $result_com = $stmt_com->fetch();
    
        if ($result_com) {
            $idcommande = $result_com['idcom'];
    // Vérifier si le produit existe déjà dans la commande actuelle
        $check_existing_product = "SELECT * FROM commande_produit WHERE idcom = :idcommande AND idproduit = :idproduit";
        $stmt_check = $this->pdo->prepare($check_existing_product);
        $stmt_check->execute([
            ':idcommande' => $idcommande,
            ':idproduit' => $idprod
        ]);
        $existing_product = $stmt_check->fetch(PDO::FETCH_ASSOC);

        if ($existing_product) {
            // Le produit existe déjà, augmenter la quantité
            $new_quantity = $existing_product['quantite'] + 1;

            $update_quantity = "UPDATE commande_produit SET quantite = :quantite, prix_total = prix_unitaire*:quantite WHERE idcom = :idcommande AND idproduit = :idproduit";
            $stmt_update = $this->pdo->prepare($update_quantity);
            $execUpdate = $stmt_update->execute([
                ':quantite' => $new_quantity,
                ':idcommande' => $idcommande,
                ':idproduit' => $idprod
            ]);

            if ($execUpdate) {
                echo "Product quantity updated successfully!";
            } else {
                $errors = $stmt_update->errorInfo();
                echo "Error updating product quantity: " . implode(', ', $errors);
            }
        } else {
            // Insertion dans la table commande_produit
            $insert = "INSERT INTO commande_produit (idcom, idproduit, quantite, prix_unitaire, prix_total)
            VALUES (:idcommande, :idproduit, :quantite, :prix_unitaire, :prix_total)";
            $stment = $this->pdo->prepare($insert);
            $execQuery = $stment->execute([
                ':idcommande' => $idcommande,
                ':idproduit' => $idprod,
                ':quantite' => 1,
                ':prix_unitaire' => $productDATA['prix_final'],
                ':prix_total' => $productDATA['prix_final']
            ]);

            if ($execQuery) {
                echo "Product added to the cart successfully!";
            } else {
                $errors = $stment->errorInfo();
                echo "Error adding product to cart: " . implode(', ', $errors);
            }
        }
        } else {
            // Aucune commande en attente n'a été trouvée
            // Vous pouvez traiter ce cas en créant une nouvelle commande, si nécessaire
            $date_creation = (new DateTime())->format('Y-m-d H:i:s');
            $insert_commande = "INSERT INTO commande (date_creation, prix_total, idclient, etat)
                                VALUES (:date_creation, :prix_total, :idclient, 'EN attente')";
            $stmt_commande = $this->pdo->prepare($insert_commande);
            $execQuery_commande = $stmt_commande->execute([
                ':date_creation' => $date_creation,
                ':prix_total' => $productDATA['prix_final'],
                ':idclient' => 3 // Utilisation d'une valeur constante pour l'ID du client
            ]);
    
            if ($execQuery_commande) {
                $idcommande = $this->pdo->lastInsertId();
    
                // Insertion dans la table commande_produit
                $insert_produit = "INSERT INTO commande_produit (idcom, idproduit, quantite, prix_unitaire, prix_total)
                                   VALUES (:idcom, :idproduit, :quantite, :prix_unitaire, :prix_total)";
                $stment_produit = $this->pdo->prepare($insert_produit);
                $execQuery_produit = $stment_produit->execute([
                    ':idcom' => $idcommande,
                    ':idproduit' => $idprod,
                    ':quantite' => 1,
                    ':prix_unitaire' => $productDATA['prix_final'],
                    ':prix_total' => $productDATA['prix_final']
                ]);
            }
        }
    }

    public function get_commandDATA($idUser){
        $query = "SELECT * FROM commande_produit as cp join product on cp.idproduit = product.id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $commande = $stmt->fetchAll();
        $commandeDATA = array();
        foreach($commande as $comm){
            $commandeDATA[] = new Products($comm['id'],$comm['name'],$comm['code_barre'],$comm['prix_achat'],$comm['prix_final'],$comm['description'],$comm['quantité_min'],$comm['quantité_stock'],$comm['offre_prix'],$comm['category'],$comm['image']);
        }

        return $commandeDATA;

    }


    public function get_factureDATA($idUser){
        $query = "SELECT * FROM commande_produit as cp join product on cp.idproduit = product.id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $factures = $stmt->fetchAll();
        $factureDATA = array();
        foreach($factures as $facture){
            $factureDATA[] = new Facture($facture['name'],$facture['quantite'],$facture['prix_final'],$facture['prix_total']);
        }
        return $factureDATA;

    }
    
}


?>