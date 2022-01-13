<?php

class AdditionnalContent{

    private $id;
    private $point;
    private $description;
    private $event;

    public function __construct($data)
    {
        foreach($data as $var){
            $varName = array_search($var, $data);
            $this->$varName = $var;
        }
    }

    public function updateAll(){
        $data = [
            'id' => $this->id,
            'point' => $this->point,
            'description' => $this->description,
            'event' => $this->event,
        ];
        $model = new EventModel();
        $model->updateAll($data);
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
        $this->updateAll();
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->updateAll();
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        $this->updateAll();
    }

}