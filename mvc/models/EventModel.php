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
}