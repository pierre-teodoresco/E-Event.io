<?php

final class EventController
{
    private $model;

    public function __construct()
    {
        $this->model = new EventModel;
    }

    public function index(){
        $index_data = [
            'allEvent' => ''
        ];
        $index_data['allEvent'] = $this->model->getAllEvent();
        View::montrer('main/index', $index_data);
    }
}