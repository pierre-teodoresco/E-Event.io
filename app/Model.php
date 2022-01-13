<?php
abstract class Model{
    // Informations de la base de données
    private $host = "localhost";
    private $db_name = "phpproject";
    private $username = "root";
    private $password = "";

    // Propriété qui contiendra l'instance de la connexion
    protected $_connexion;

    // Propriétés permettant de personnaliser les requêtes
    public $table;
    public $className;


    public function getConnection(){
        // On supprime la connexion précédente
        $this->_connexion = null;

        // On essaie de se connecter à la base
        try{
            $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }
    }

    public function getOne($id){
        $sql = 'SELECT * FROM '.$this->table.' WHERE id='.$id ;
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $data = $query->fetch();
        return new (ucfirst($this->className))($data);
    }

    public function getAll(){
        $objects = [];
        $sql = 'SELECT * FROM '.$this->table . ' ORDER BY id DESC';
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $objects[] = new (ucfirst($this->className))($data);
        }
        return $objects;
    }

    public function updateOrCreate($data){
        $sql = 'SELECT COUNT(*) FROM '.$this->table.' WHERE id = \''.$data['id'].'\'';
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $count = $query->fetchColumn();
        if($count == 0 )
            $this->createOne($data);
        else $this->updateAll($data);
    }

    public function updateOne($attributeName, $value, $id){
        $sql = 'UPDATE ' .$this->table . ' SET '.$attributeName.'='.'\''.$value.'\' WHERE id='.$id;
        $query= $this->_connexion->prepare($sql);
        $query->execute([$attributeName, $id]);
    }

    public function updateAll($data){
        $sql = 'UPDATE '.$this->table.' SET ';
        foreach($data as $key=>$val) {
            $sql .= $key . '= \'' . $val. '\',';
        }
        $sql = substr($sql, 0, -1); //On retire la derniere virgule
        $sql .= ' WHERE id=\''.$data['id'].'\'';
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
        echo $sql;
        $query= $this->_connexion->prepare($sql);
        $query->execute();
    }

}