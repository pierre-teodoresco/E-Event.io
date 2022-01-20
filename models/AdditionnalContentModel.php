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

    /**
     * @param $id => Numéro ID correspondant à l'evenement
     * @return Nous renvoi un tableau du nombre de point et une description par rapport a l'evenement id.
     */
    public function getAdditionnalContentOfEvent($id){
        $stmt = "SELECT point,description FROM `addcontent` WHERE addcontent.event = $id ORDER BY point ASC";
        return $this->_connexion->query($stmt);
    }
}