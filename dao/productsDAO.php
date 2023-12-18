<?php
require_once 'C:\xampp\htdocs\projects\poo brief 1\database\connexion.php';
require_once 'C:\xampp\htdocs\projects\poo brief 1\products.php';
class productsDAO{
    private $pdo;
    
    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection(); 
    }
    
    public function add_Product($name,$code_barre,$prix_achat,$prix_final,$description,$quantité_min,$quantité_stock,$offre_prix,$category,$image){
        $add_Product = "INSERT INTO product (ettiquette,code_barre,prix_achat,prix_final,description,quantité_min,quantité_stock,offre_prix,categorie,image)
        VALUES ($name,$code_barre,$prix_achat,$prix_final,$description,$quantité_min,$quantité_stock,$offre_prix,$category,$image);";
        $stmt = $pdo->prepare($add_Product);
        $stmt->execute();
    }


    public function get_products(){
        $query = "SELECT * FROM product";
        $stmt = $this->pdo->query($query);
        $stmt->execute();
        $productsDATA = $stmt->fetchALL();
        $products = array();
        foreach($productsDATA as $product){
            $products[] = new Products(0,$product['name'],$product['code_barre'],$product['prix_achat'],$product['prix_final'],$product['description'],$product['quantité_min'],$product['quantité_stock'],$product['offre_prix'],$product['category'],$product['image']);
        }

        return $products;
    }

    public function update_Product($id,$name,$code_barre,$prix_achat,$prix_final,$description,$quantité_min,$quantité_stock,$offre_prix,$category,$image){
        $update_Product = "UPDATE product SET ettiquette = '$name',
                                    code_barre = '$code_barre',
                                    prix_achat = '$prix_achat',
                                    prix_final = '$prix_final',
                                    description = '$description',
                                    quantité_min = '$quantité_min',
                                    quantité_stock ='$quantité_stock',
                                    offre_prix = '$offre_prix',
                                    categorie = '$category',
                                    image = '$image'
                                    WHERE reference = '$id'";   
        $stmt = $pdo->query($update_Product);
        $stmt->execute();
    }

    public function Delete_product($id){
        $delete = "DELETE FROM product where reference = $id;";
        $stmt = $this->pdo->query($delete);
        $stmt->execute();
    }

    public function get_popular_products (){
        $sql2="SELECT * FROM product p1 WHERE nbachat = (SELECT MAX(nbachat)FROM product p2 WHERE p1.category = p2.category)";
        $result2 = $this->pdo->query($sql2);
        $result2->execute();
        $POPproducts = array();
        foreach($result2 as $product){
            $POPproducts[] = new Products(0,$product['name'],$product['code_barre'],$product['prix_achat'],$product['prix_final'],$product['description'],$product['quantité_min'],$product['quantité_stock'],$product['offre_prix'],$product['category'],$product['image']);
        }

        return $POPproducts;

    }
    
}
?>