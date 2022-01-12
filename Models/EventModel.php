<?php
class EventModel {
    private $_id;
    private $_titre;
    private $_description;
    private $_contenu;
    private $_compteurDeVote;
    private $_listeCommentaire;
    private $_illustration;
    private $_auteur;
    private $_listeContenuDebloquable;


    public function __construct (array $data){
        $this->hydrate($data);
    }

    public function hydrate (array $data){
        foreach ($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }

    public function setId($id)
    {
        $id = (int) $id;
        if ($id > 0)
            $this->_id = $id;
    }

    public function setTitre($titre)
    {
        if (is_string($titre))
            $this->_titre = $titre;
    }

    public function setDescription($description)
    {
        if (is_string($description)){
            if (strlen($description) < 140)
                $this->_description = $description;
        }
    }

    public function setContenu($contenu)
    {
        if (is_string($contenu))
            $this->_contenu = $contenu;
    }

    public function setCompteurDeVote($compteurDeVote)
    {
        if (is_int($compteurDeVote))
            $this->_compteurDeVote = $compteurDeVote;
    }

    public function setListeCommentaire($listeCommentaire)
    {
        if (is_array($listeCommentaire))
            $this->_listeCommentaire = $listeCommentaire;
    }

    public function setIllustration($illustration)
    {
        if (is_string($illustration))
            $this->_illustration = $illustration;
    }

    public function setAuteur($auteur)
    {
        if (is_string($auteur))
            $this->_auteur = $auteur;
    }

    public function setListeContenuDebloquable($listeContenuDebloquable)
    {
        if (is_array($listeContenuDebloquable))
        $this->_listeContenuDebloquable = $listeContenuDebloquable;
    }

    public function getAuteur()
    {
        return $this->_auteur;
    }

    public function getCompteurDeVote()
    {
        return $this->_compteurDeVote;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getContenu()
    {
        return $this->_contenu;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getIllustration()
    {
        return $this->_illustration;
    }

    public function getListeCommentaire()
    {
        return $this->_listeCommentaire;
    }

    public function getListeContenuDebloquable()
    {
        return $this->_listeContenuDebloquable;
    }

    public function getTitre()
    {
        return $this->_titre;
    }

}
