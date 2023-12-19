<?php
require_once 'C:\xampp\htdocs\projects\poo brief 1\database\connexion.php';
require_once 'C:\xampp\htdocs\projects\poo brief 1\categories.php';
define('ROOTPATH', __DIR__);

class CategoriesDAO{
    private $pdo;

    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection(); 
    }

    public function add_Category($name, $description, $image){
        $add_Categpry = "INSERT INTO category
        VALUES (0,'$name', '$description', '$image');";
        $stmt = $this->pdo->prepare($add_Categpry);
        $stmt->execute();
    }

    public function get_categories(){
        $get = "SELECT * FROM category";
        $stmt = $this->pdo->prepare($get);
        $stmt->execute();
        $categoriesDATA = $stmt->fetchAll();
        $categories = array();
        foreach($categoriesDATA as $category){
            $categories[] = new Catagory($category['id'],$category['name'], $category['description'], $category['image']);
        }
        return $categories;
    }

    public function get_category_ById($id){
        $get = "SELECT * FROM category where id = '$id'";
        $stmt = $this->pdo->prepare($get);
        $stmt->execute();
        $categoriesDATA = $stmt->fetchAll();
        $categories = array();
        foreach($categoriesDATA as $category){
            $categories[] = new Catagory($category['id'],$category['name'], $category['description'], $category['image']);
        }
        return $categories;
    }

    public function update_Category($id,$name, $description, $image){
        $update_Category = "UPDATE category SET name = '$name',
                                    description = '$description',
                                    image = '$image'
                                    WHERE id = '$id';";   
        $stmt = $this->pdo->prepare($update_Category);
        $stmt->execute();
    }

    public function Delete_category($id){
        $delete = "DELETE FROM category where id = '$id';";
        $stmt = $this->pdo->prepare($delete);
        $stmt->execute();
        header('Location:Pagecategories.php');
    }
}
// $categorydao = new CategoriesDAO();
// $categorydao->add_Category("youcode","youcode","img");
// echo "category inserted  ";
// echo ROOTPATH;
?>