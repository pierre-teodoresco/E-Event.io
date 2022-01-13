<?php

class AdditionnalContent{

    private $id;
    private $point;
    private $description;
    private $event;

    public function __construct($data)
    {
        foreach($data as $key=>$var){
            $varName = $key;
            $this->$varName = $var;
        }
    }

    public function updateOrCreate(){
        $data = [
            'id' => $this->id,
            'point' => $this->point,
            'description' => $this->description,
            'event' => $this->event,
        ];
        $model = new AdditionnalContentModel();
        $model->updateOrCreate($data);
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