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
}