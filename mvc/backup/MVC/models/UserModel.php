<?php

class UserModel extends Model{
    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = 'account';
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    public function checkLogin($email, $password){
        $stmt = $this->_connexion->prepare("SELECT username,password,id,role FROM ".$this->table." WHERE email = '".$email."'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $result->password)) {
            //Penser a enable le session start
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION['username'] = $result->username;
            $_SESSION['id'] = $result->id;
            $_SESSION['role'] = $result->role;
            //Redirigier l'user a la page index
            header('Location: ?controller=event&action=index');
            return true;
        }
        return false;
    }


    public function checkPassword($id, $password){
        $stmt = $this->_connexion->prepare("SELECT password FROM ".$this->table." WHERE id = '".$id."'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if (password_verify($password, $result->password)) {
            //Penser a enable le session start
            return true;
        }
        return false;
    }

    public function checkRegister($email, $password, $options, $rank){
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        $stmt = $this->_connexion->prepare("INSERT INTO `account`(`email`, `role`, `password`) VALUES ('".$email."', '".$rank."', '".$hash."') ");
        $stmt->execute();

    }

    public function registerCampagne($name, $datedeb, $datefin, $point){
        $stmt = $this->_connexion->prepare("INSERT INTO `campagne`(`name`, `datedeb`, `datefin`, `points`) VALUES ('".$name."', '".$datedeb."', '".$datefin."', '".$point."') ");
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

    public function getPoint($id){
        $stmt = "SELECT point FROM account WHERE id = $id";
        $stmt = $this->_connexion->query($stmt);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row[point];
    }



    public function getAttribute($var, $id){
        $stmt = "SELECT $var FROM account WHERE id = $id";
        $stmt = $this->_connexion->query($stmt);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row[$var];
    }





    public function userExist($username){
        $sql = "SELECT COUNT(*) FROM account WHERE username = '".$username."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        if($count == 0 )return false;
        else return true;
    }

    public function checkUsername($user, $password, $options, $id){
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        $stmt = $this->_connexion->prepare("UPDATE account SET username = '".$user."', password = '".$hash."' WHERE id = '".$id."'");
        $stmt->execute();
    }
    public function changeImage($id, $img){
        $stmt = $this->_connexion->prepare("UPDATE account SET image_profile = '".$img."' WHERE id = '".$id."'");
        $stmt->execute();
    }
    public function updateVar($id, $var,$img){
        $stmt = $this->_connexion->prepare("UPDATE account SET $var = '".$img."' WHERE id = '".$id."'");
        $stmt->execute();
    }

}