<?php
class Campagne extends Model{
    private $_id;
    private $_name;
    private $_datedeb;
    private $_datefin;
    private $_pointalloue;

    public function setId($id)
    {
        if(is_int($id))
            $this->_id = $id;
    }

    public function setDatedeb($datedeb)
    {
        $this->_datedeb = $datedeb;
    }

    public function setDatefin($datefin)
    {
        $this->_datefin = $datefin;
    }


    public function setName($name)
    {
        if(is_string(($name)))
            $this->_name = $name;
    }

    public function setPointalloue($pointalloue)
    {
        if(is_int($pointalloue))
            $this->_pointalloue = $pointalloue;
    }

    public function getId()
    {
        return $this->_id;
    }


    public function getName()
    {
        return $this->_name;
    }


    public function getDatedeb()
    {
        return $this->_datedeb;
    }


    public function getDatefin()
    {
        return $this->_datefin;
    }


    public function getPointalloue()
    {
        return $this->_pointalloue;
    }
}
