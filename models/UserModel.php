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
        if ($stmt->fetch() && password_verify($password, $result->password)) {
            //Penser a enable le session start
            $_SESSION['username'] = $email;
            $_SESSION['id'] = $result->id;
            $_SESSION['role'] = $result->role;
            //Redirigier l'user a la page index
            return true;
        }
        return false;
    }


    public function emailExists($email){
        $sql = "SELECT COUNT(*) FROM ".$this->table." WHERE email = '".$email."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        if($count == 0 )return false;
        else return true;
    }

    public function findByName(string $name){
        $sql = "SELECT * FROM ".$this->table." WHERE `name`='".$name."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}