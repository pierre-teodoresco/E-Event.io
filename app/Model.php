<?php

abstract class Model{
    // Informations de la base de données
    private $host = "localhost";
    private $db_name = "phpproject";
    private $username = "phpproject";
    private $password = "qyfzuf-0vepna-zynkUj";
    private $port = '3306';

    // Propriétés permettant de personnaliser les requêtes
    public $table;

    public function getConnection(){
        // On supprime la connexion précédente
        $this->_connexion = null;

        // On essaie de se connecter à la base
        try{
            $this->_connexion = new PDO("mysql:host=" . $this->host .';port=' . $this->port. ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec("set names utf8");
            $this->_connexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //Anti injection SQL
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    //Permet de récupérer un tuple à partir de son id
    public function getOne($id){
        $sql = 'SELECT * FROM '.$this->table.' WHERE id='.$id ;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    //Permet de récuperer tout les tuples
    public function getAll(){
        $sql = 'SELECT * FROM '.$this->table . ' ORDER BY id ASC';
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    //Renvoie vrai si le tuple existe et faux sinon
    public function tupleExists($id): bool
    {
        $sql = 'SELECT COUNT(*) FROM '.$this->table.' WHERE id = \''.$id.'\'';
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        if($count == 0 )
            return false;
        else return true;
    }

    //Met à jour un seul attribut d'un tuple
    public function updateOne($attributeName, $value, $id){
        if($this->tupleExists($id)){
            $sql = 'UPDATE ' .$this->table . ' SET '.$attributeName.'='.'\''.$value.'\' WHERE id='.$id;
            $query= $this->_connexion->prepare($sql);
            $query->execute();
        }

    }

    //met à jour plusieurs attributs d'un tuple
    public function updateAll($data, $id){
        $sql = 'UPDATE '.$this->table.' SET ';
        foreach($data as $key=>$val) {
            $sql .= $key . '= \'' . $val. '\',';
        }
        $sql = substr($sql, 0, -1); //On retire la derniere virgule
        $sql .= ' WHERE id=\''.$id.'\'';
        $query= $this->_connexion->prepare($sql);
        $query->execute();
    }

    //Insertion d'un nouveau tuple
    public function createOne($data){
        $sql = 'INSERT INTO '.$this->table.' (';
        foreach($data as $key=>$val) {
            $sql .= '`'.$key.'`,';
        }
        $sql = substr($sql, 0, -1); //On retire la derniere virgule
        $sql .= ') VALUES (';
        foreach($data as $val) {
            $sql .= '\''.$val.'\',';
        }
        $sql = substr($sql, 0, -1); //On retire la derniere virgule
        $sql .= ')';
        $query= $this->_connexion->prepare($sql);
        $query->execute();
    }

    //Suppression d'un tuple
    public function deleteOne($id){
        $sql = 'DELETE FROM '.$this->table.' WHERE id='.$id;
        $query= $this->_connexion->prepare($sql);
        $query->execute();
    }

    //Retourne le nombre de tuples dans la base
    public function getCount(){
        $stmt = $this->_connexion->prepare("SELECT COUNT(*) FROM ".$this->table);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    //Récupère un attribut d'un tuple
    public function getAttribute($var, $id){
        $stmt = "SELECT $var FROM ".$this->table." WHERE id = $id";
        $stmt = $this->_connexion->query($stmt);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row[$var];
    }


}