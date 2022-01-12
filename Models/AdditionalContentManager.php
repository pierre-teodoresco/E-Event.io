<?php
class AdditionalContentManager extends Model{
    private $_event = 'additionalcontent';

    public function __construct(){
        $this->getConnection();
        $this->table = $this->_event;
    }

    public function createAdditionalContentModel(){
        //TODO
    }

    public function getAdditionalContentModel(){
        //TODO
    }

    public function updateAdditionalContentModel(){
        //TODO
    }

    public function deleteAdditionalContentModel(){
        //TODO
    }
}