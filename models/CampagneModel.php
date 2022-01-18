<?php
class CampagneModel extends Model
{

    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = 'campagne';
        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }



    public function isInCampagne(): bool
    {
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