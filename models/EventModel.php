<?php
class EventModel extends Model
{

    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = 'evenement';

        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    public function getAllEvent(){
        $stmt = "SELECT evenement.id,title,description,votes,username,image_profile,jury
                FROM evenement INNER JOIN account ON owner = account.id 
                ORDER BY evenement.id DESC";

        return $this->_connexion->query($stmt);
    }

    public function getTop(){
        $stmt = "SELECT title FROM evenement ORDER BY evenement.votes DESC LIMIT 3";
        $stmt = $this->_connexion->query($stmt);
        return $stmt->fetchAll();
    }

    public function getEvent($id){
        if(is_int(intval($id))) {
            $stmt = "SELECT evenement.id,title,description,content,votes,username,image_profile,owner 
                    FROM evenement INNER JOIN account ON owner = account.id WHERE evenement.id = $id";
            $stmt = $this->_connexion->query($stmt);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        else{
            throw new Exception("id d'évènement invalide ou évènement introuvable");
        }
    }

    public function addPoint($accountId, $point, $eventId){
        $stmt = $this->_connexion->prepare("UPDATE account SET point = point - '".$point."' WHERE id = '".$accountId."'");
        $stmt->execute();
        $stmt3 = $this->_connexion->prepare("UPDATE evenement SET votes = votes + '".$point."' WHERE id = '".$eventId."'");
        $stmt3->execute();
    }


    public function getVotes(){
        $stmt = $this->_connexion->prepare("SELECT SUM(votes) FROM ".$this->table);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getMoyVotes(){
        $stmt = $this->_connexion->prepare("SELECT CAST(AVG(votes) AS DECIMAL(10,2)) FROM ".$this->table);
        $stmt->execute();
        return $stmt->fetchColumn();
    }


}