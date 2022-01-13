<?php

class AdditionnalContent extends ObjectBase{

    private $id;
    private $point;
    private $description;
    private $event;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        $this->updateAttribute('id', $id);
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function setPoint($point)
    {
        $this->point = $point;
        $this->updateAttribute('point', $point);
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->updateAttribute('description', $description);
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        $this->updateAttribute('event', $event);
    }

}