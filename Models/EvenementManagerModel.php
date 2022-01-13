<?php
class EvenementManagerModel extends Model{
    private $_event = 'events';

    public function __construct(){
        $this->getConnection();
        $this->table = $this->_event;
    }


    public function createEventModel(){
        //TODO
    }

    public function getEventModel(){
        //TODO
    }

    public function updateEventModel(){
        //TODO
    }

    public function deleteEventModel(){
        //TODO
    }
}