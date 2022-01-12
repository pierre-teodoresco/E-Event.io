<?php
class AdditionalContent extends Model{
    private $_evenements;
    private $_pointrequis;
    private $_description;

    public function __construct (array $data){
        $this->hydrate($data);
    }

    public function hydrate (array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
    }


    public function setDescription($description)
    {
        if (is_string($description))
            $this->_description = $description;
    }

    public function setEvenements($evenements)
    {
        $this->_evenements = $evenements;
    }

    public function setPointrequis($pointrequis)
    {
        if (is_int($pointrequis))
            $this->_pointrequis = $pointrequis;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getEvenements()
    {
        return $this->_evenements;
    }

    public function getPointrequis()
    {
        return $this->_pointrequis;
    }
}