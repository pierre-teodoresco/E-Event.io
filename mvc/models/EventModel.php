<?php
class EventModel extends Model
{

    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = 'evenement';
        $this->className = 'event';

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

            $stmt = "SELECT evenement.id,title,description,content,votes,username,image_profile FROM evenement INNER JOIN account ON owner = account.id WHERE evenement.id = $id";
            $stmt = $this->_connexion->query($stmt);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $value= "";
            $value .= "<div class=\"container\">
         <h3> $row[title]</h3>
         <h4> <img src='img/$row[image_profile]' width='100' alt=''> Autheur : <span> $row[username]</span></h4>
         <p> $row[description]</p>
         <p> $row[content]</p>
         <div class=\"right\">
         <div class=\"article-footer\">
         <a href=\"\" class=\"button sucess\">12 Votes
        </a>
         <a href=\"\" class=\"button\">Voir l'evenement</a>
         </div>
         </div>
        </div>";
            return $value;
        }else{
            return "non";
        }
        throw new Exception('L\'article choisie est introuvable.');
    }
}