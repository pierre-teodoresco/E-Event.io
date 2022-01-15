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
        $stmt = "SELECT evenement.id,title,description,votes,username,image_profile 
                FROM evenement INNER JOIN account ON owner = account.id 
                ORDER BY evenement.id DESC";
        return $this->_connexion->query($stmt);
    }

    public function getComment($id){
        if(is_int(intval($id))) {
            $stmt = "SELECT author,description,username FROM `comment` INNER JOIN account ON author = account.id WHERE comment.event = $id";
            $result = $this->_connexion->query($stmt);
            $value= "";
            foreach ($result as $row){
                $value .= "<div class=\"container\">
                 <h3> $row[username]</h3>
                 <p> $row[description]</p>
                </div>";
            }
            return $value;
        }
        return "non";
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
        $stmt2 = "SELECT point,description FROM `addcontent` WHERE addcontent.event = $id";
        return $this->_connexion->query($stmt2);
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
}