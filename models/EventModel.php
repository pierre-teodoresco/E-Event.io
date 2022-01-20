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

    /**
     * @return Nous retournes sous forme de tableau tous les données essentiels d'un evenement
     */
    public function getAllEvent(){
        $stmt = "SELECT evenement.id,title,description,votes,username,image_profile,jury
                FROM evenement INNER JOIN account ON owner = account.id 
                ORDER BY evenement.id DESC";

        return $this->_connexion->query($stmt);
    }

    /**
     * @return Nous retournes toutes les informations necessaires pour l'affichage du TOP 3
     */
    public function getTop(){
        $stmt = "SELECT title FROM evenement ORDER BY evenement.votes DESC LIMIT 3";
        $stmt = $this->_connexion->query($stmt);
        return $stmt->fetchAll();
    }

    /**
     * @param $id => Afin de pouvoir recuperer les information nécessaires pour faire le tableau.
     * @return Nous retournes un tableau d'element correspondant à l'évenement défini en paramètre
     * @throws Exception
     */
    public function getEvent($id){
        if(is_int(intval($id))) {
            $stmt = "SELECT evenement.id,title,description,illustration,content,votes,username,image_profile,owner 
                    FROM evenement INNER JOIN account ON owner = account.id WHERE evenement.id = $id";
            $stmt = $this->_connexion->query($stmt);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        }
        else{
            throw new Exception("id d'évènement invalide ou évènement introuvable");
        }
    }

    /**
     * @param $id       => ID de l'evenement à mettre à jour
     * @param $title        => Nouveau titre à mettre à jour
     * @param $description  => Nouvelle description à mettre à jour
     * @param $content      => Nouveau contenu de l'evenement
     */
    public function updateEvent($id,$title,$description, $content){
        $stmt = $this->_connexion->prepare("UPDATE evenement SET title = '".$title."', description = '".$description."', content = '".$content."' WHERE id = '".$id."'");
        $stmt->execute();

    }

    /**
     * @param $accountId    => ID du compte l'utilisateur à mettre jour
     * @param $point        => Nombre de point a definir
     * @param $eventId      => Evenement auquel nous allons rajouter les points
     */
    public function addPoint($accountId, $point, $eventId){
        $stmt = $this->_connexion->prepare("UPDATE account SET point = point - '".$point."' WHERE id = '".$accountId."'");
        $stmt->execute();
        $stmt3 = $this->_connexion->prepare("UPDATE evenement SET votes = votes + '".$point."' WHERE id = '".$eventId."'");
        $stmt3->execute();
    }

    /**
     * @param $id
     * @return Method qui nous renvoi un pourcentage de l'avencement par rapport au pallier.
     */
    public function getPercentageOfAdditionnalContent($id){
        $lowerContent = $this->_connexion->prepare("SELECT addcontent.POINT FROM `addcontent` JOIN `evenement` ON evenement.ID = addcontent.EVENT WHERE evenement.ID = ".$id." AND addcontent.POINT < evenement.VOTES ORDER BY evenement.VOTES DESC LIMIT 1");
        $upperContent = $this->_connexion->prepare("SELECT addcontent.POINT FROM `addcontent` JOIN `evenement` ON evenement.ID = addcontent.EVENT WHERE evenement.ID = ".$id." AND addcontent.POINT > evenement.VOTES ORDER BY evenement.VOTES ASC LIMIT 1");
        $activeContent = $this->_connexion->prepare("SELECT VOTES FROM `evenement` WHERE ID = ".$id);
        $activeContent->execute();
        $lowerContent->execute();
        $upperContent->execute();
        $activeContent = $activeContent->fetchColumn();
        $lowerContent = $lowerContent->fetchColumn();
        $upperContent = $upperContent->fetchColumn();
        if(!isset($lowerContent) || !is_int($lowerContent) || $lowerContent == 0 ) $lowerContent = 0;
        if(!isset($upperContent) || !is_int($upperContent) || $upperContent == 0 ) $upperContent = $activeContent;
        return (($activeContent - $lowerContent)/($upperContent - $lowerContent)) * 100;
    }

    /**
     * @return Nous retournes le nombre votes total
     */
    public function getVotes(){
        $stmt = $this->_connexion->prepare("SELECT SUM(votes) FROM ".$this->table);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    /**
     * @return Nous retournes la moyenne de vote par evenement
     */
    public function getMoyVotes(){
        $stmt = $this->_connexion->prepare("SELECT CAST(AVG(votes) AS DECIMAL(10,2)) FROM ".$this->table);
        $stmt->execute();
        return $stmt->fetchColumn();
    }


}