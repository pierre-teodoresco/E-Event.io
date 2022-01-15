<?php

class UserModel extends Model{
    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = 'account';
        $this->className = 'user';
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    public function checkLogin($email, $password){
        $stmt = $this->_connexion->prepare("SELECT password,id,role FROM ".$this->table." WHERE email = '".$email."'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $result->password)) {
            //Penser a enable le session start
            session_start();
            $_SESSION['username'] = $email;
            $_SESSION['id'] = $result->id;
            $_SESSION['role'] = $result->role;
            //Redirigier l'user a la page index
            header('Location: index.php');
            return true;
        }
        return false;
    }

    public function checkRegister($email, $password, $options){
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        $stmt = $this->_connexion->prepare("INSERT INTO `account`(`email`, `role`, `password`) VALUES ('".$email."', '0', '".$hash."') ");
        $stmt->execute();

    }


    public function emailExists($email){
        $sql = "SELECT COUNT(*) FROM ".$this->table." WHERE email = '".$email."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        if($count == 0 )return false;
        else return true;
    }

    public function countOnlineEvents(){
        $date = date('Y-m-d');
        $stmt = $this->_connexion->prepare("SELECT * FROM `campagne` WHERE ('" . $date . "' >= datedeb AND '" . $date . "' <= datefin)");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function tableCampagne(){
        $stmt = "SELECT * FROM campagne";
        return $this->_connexion->query($stmt);
    }

    public function userCount(){
        $stmt = $this->_connexion->prepare("SELECT COUNT(*) FROM account");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function eventCount(){
        $stmt = $this->_connexion->prepare("SELECT COUNT(*) FROM evenement");
        $stmt->execute();
        return $stmt->fetchColumn();
    }


}