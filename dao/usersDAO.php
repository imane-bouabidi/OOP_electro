<?php
require_once 'C:\xampp\htdocs\projects\poo brief 1\database\connexion.php';
require_once 'C:\xampp\htdocs\projects\poo brief 1\users.php';
class usersDAO{
    private $pdo;
    public function __construct(){
        $this->pdo = Database::getInstance()->getConnection(); 
    }

    public function add_User($username,$email,$phone,$adresse,$ville,$password,$type,$verfied){
        $query = "INSERT INTO users (username,email,phone,adresse,ville,password,type) 
        VALUES ('$username','$email','$phone','$adresse','$ville','$password','$type','$verfied');";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
    }
   
    public function get_Users(){
        $query = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $usersList = $stmt->fetchAll();
        $users = array();
        foreach ($usersList as $user) {
            $users[] = new users($user["id"],$user["username"],$user["email"],$user["phone"],$user["adresse"],$user["ville"],$user["password"],$user["type"],$user["verified"]);
        }
        return $users;
    }
    
    public function User_validation($id){
        $user = "UPDATE users SET verified = true where id = '$id';";
        $stmt = $this->pdo->prepare($user);
        $stmt->execute();
        // exit();
    }
    
    public function User_to_admin($id){
        $admin = "UPDATE users SET type = 'admin' where id = '$id';";
        $stmt = $this->pdo->prepare($admin);
        $stmt->execute();
        // header('Location:admin.php');
        // exit();
    }
    
    public function Delete_user($id){
        $delete = "DELETE FROM users where id = '$id';";
        $stmt = $this->pdo->prepare($delete);
        $stmt->execute();
        header('Location:admin.php');
        // exit();
    }

}



?>