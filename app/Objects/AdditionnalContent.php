<?php

class AdditionnalContent extends ObjectBase{

    private $id;
    private $point;
    private $description;
    private $event;

    public function __construct($data)
    {
        foreach($data as $key=>$value){
            $varName = $key;
            $this->$varName = $value;
        }
        $this->updateOrCreate();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function setPoint($point)
    {
        $this->point = $point;
        $this->updateOrCreate();
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->updateOrCreate();
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        $this->updateOrCreate();
    }

}