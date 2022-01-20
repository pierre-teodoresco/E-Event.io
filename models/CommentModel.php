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

    /**
     * @param $id => L'ID de l'évenement afin de faire la requetes SQL
     * @return => Nous retournes un tableau avec l'auteur, la description et le pseudo par rapport a l'evenement
     * @throws Exception
     */
    public function getCommentByEventId($id){
        if(is_int(intval($id))) {
            $stmt = "SELECT author,description,username FROM `comment` INNER JOIN account ON author = account.id WHERE comment.event = $id";
            return $this->_connexion->query($stmt);
        }
        throw new Exception("id de commentaire invalide");
    }
}