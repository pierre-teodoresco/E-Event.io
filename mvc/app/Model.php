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
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function getOne($id){
        $sql = 'SELECT * FROM '.$this->table.' WHERE id='.$id ;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch();
    }

    public function getAll(){
        $sql = 'SELECT * FROM '.$this->table . ' ORDER BY id ASC';
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function tupleExists($id){
        $sql = 'SELECT COUNT(*) FROM '.$this->table.' WHERE id = \''.$id.'\'';
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        if($count == 0 )
            return false;
        else return true;
    }

    public function updateOne($attributeName, $value, $id){
        if($this->tupleExists($id)){
            $sql = 'UPDATE ' .$this->table . ' SET '.$attributeName.'='.'\''.$value.'\' WHERE id='.$id;
            $query= $this->_connexion->prepare($sql);
            $query->execute();
        }

    }

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

    public function deleteOne($id){
        $sql = 'DELETE FROM '.$this->table.' WHERE id='.$id;
        $query= $this->_connexion->prepare($sql);
        $query->execute();
    }

    public function getCount(){
        $stmt = $this->_connexion->prepare("SELECT COUNT(*) FROM ".$this->table);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}
