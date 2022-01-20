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

    public function getCommentByEventId($id){
        if(is_int(intval($id))) {
            $stmt = "SELECT author,description,username FROM `comment` INNER JOIN account ON author = account.id WHERE comment.event = $id";
            return $this->_connexion->query($stmt);
        }
        throw new Exception("id de commentaire invalide");
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

    public function getAdditionnalContentOfEvent($id){
        $stmt = "SELECT point,description FROM `addcontent` WHERE addcontent.event = $id";
        return $this->_connexion->query($stmt);
    }

    public function countOnlineEvents(){
        $date = date('Y-m-d');
        $stmt = $this->_connexion->prepare("SELECT * FROM `campagne` WHERE ('" . $date . "' >= datedeb AND '" . $date . "' <= datefin)");
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function addPoint($id, $point, $comment, $eventid){
        $stmt = $this->_connexion->prepare("UPDATE account SET point = point - '".$point."' WHERE id = '".$id."'");
        $stmt->execute();
        $stmt3 = $this->_connexion->prepare("UPDATE evenement SET votes = votes + '".$point."' WHERE id = '".$eventid."'");
        $stmt3->execute();
        if($comment != ""){
            $stmt2 = $this->_connexion->prepare("INSERT INTO comment(author, description, event) VALUES ('".$id."', '".$comment."', '".$eventid."')");
            $stmt2->execute();
        }
    }

    public function addAdd($point, $desc, $id){
        $stmt2 = $this->_connexion->prepare("INSERT INTO addcontent(point, description, event) VALUES ('".$point."', '".$desc."', '".$id."')");
        $stmt2->execute();

    }
    public function createEvent($id, $title, $desc, $content){
        $stmt2 = $this->_connexion->prepare("INSERT INTO evenement(title, owner, description, content) VALUES ('".$title."', '".$id."', '".$desc."', '".$content."')");
        $stmt2->execute();
    }

    public function getVotes(){
        $stmt = $this->_connexion->prepare("SELECT SUM(votes) FROM ".$this->table);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
    public function getAttribute($var, $id){
        $stmt = "SELECT $var FROM evenement WHERE id = $id";
        $stmt = $this->_connexion->query($stmt);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row[$var];
    }


    public function getMoyVotes(){
        $stmt = $this->_connexion->prepare("SELECT CAST(AVG(votes) AS DECIMAL(10,2)) FROM ".$this->table);
        $stmt->execute();
        return $stmt->fetchColumn();
    }


    public function isInCampagne(){
        $date = date('Y-m-d');
        $stmt = $this->_connexion->prepare("SELECT COUNT(*) FROM `campagne` WHERE ('" . $date . "' >= datedeb AND '" . $date . "' <= datefin)");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        if($count == 0){
            return false;
        }else{
            return true;
        }
    }


}