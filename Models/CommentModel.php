<?php
class CommentModel extends Model{
    private $_auteur;
    private $_description;
    private $_evenement;

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
    public function setAuteur($auteur)
    {
        if (is_string($auteur))
            $this->_auteur = $auteur;
    }

    public function setDescription($description)
    {
        if (is_string($description))
            $this->_description = $description;
    }

    public function setEvenement($evenement)
    {
        $this->_evenement = $evenement;
    }

    public function getAuteur()
    {
        return $this->_auteur;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getEvenement()
    {
        return $this->_evenement;
    }
}