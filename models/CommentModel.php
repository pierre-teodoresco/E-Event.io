<?php
class CommentModel extends Model
{

    public function __construct()
    {
        // Nous définissons la table par défaut de ce modèle
        $this->table = 'comment';

        // Nous ouvrons la connexion à la base de données
        $this->getConnection();
    }
}