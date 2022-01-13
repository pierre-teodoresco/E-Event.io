<?php
class EvenementModel {
    private $_id;
    private $_title;
    private $_description;
    private $_content;
    private $_votes;
    private $_ilustration;
    private $_auteur;
    private $_addcontent;


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

    public function setTitle($_title)
    {
        if (is_string($_title))
            $this->_title = $_title;
    }

    public function setDescription($description)
    {
        if (is_string($description)){
            if (strlen($description) < 140)
                $this->_description = $description;
        }
    }

    public function setContent($content)
    {
        if (is_string($content))
            $this->_content = $content;
    }

    public function setVotes($votes)
    {
        if (is_int($votes))
            $this->_votes = $votes;
    }

    public function setIlustration($ilustration)
    {
        if (is_string($ilustration))
            $this->_ilustration = $ilustration;
    }

    public function setAuteur($auteur)
    {
        if (is_int($auteur))
            $this->_auteur = $auteur;
    }

    public function setAddcontent($addcontent)
    {
        if (is_string($addcontent))
            $this->_addcontent = $addcontent;
    }

    public function getAuteur()
    {
        return $this->_auteur;
    }

    public function getVotes()
    {
        return $this->_votes;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getContent()
    {
        return $this->_content;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function getIlustration()
    {
        return $this->_ilustration;
    }

    public function getAddcontent()
    {
        return $this->_addcontent;
    }

    public function getTitle()
    {
        return $this->_title;
    }

}
