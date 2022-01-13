<?php
class AddContent extends Model{
    private $_id;
    private $_event;
    private $_point;
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



    public function setId($id)
    {
        if(is_int($id))
            $this->_id = $id;
    }

    public function setDescription($description)
    {
        if (is_string($description))
            $this->_description = $description;
    }

    public function setEvent($event)
    {
        $this->_event = $event;
    }

    public function setPoint($point)
    {
        if (is_int($point))
            $this->_point = $point;
    }
    
    public function getId()
    {
        return $this->_id;
    }

    public function getDescription()
    {
        return $this->_description;
    }

    public function getEvent()
    {
        return $this->_event;
    }

    public function getPoint()
    {
        return $this->_point;
    }
}