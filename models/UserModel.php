<?php
class UserModel extends Model{

    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = 'users';

        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }


    public function checkLogin($username, $password){
        return true;
    }

    public function findByName(string $name){
        $sql = "SELECT * FROM ".$this->table." WHERE `name`='".$name."'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}