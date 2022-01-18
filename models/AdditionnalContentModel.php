<?php
class AdditionnalContentModel extends Model
{

    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = 'addcontent';

        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }

    public function getAdditionnalContentOfEvent($id){
        $stmt = "SELECT point,description FROM `addcontent` WHERE addcontent.event = $id";
        return $this->_connexion->query($stmt);
    }
}