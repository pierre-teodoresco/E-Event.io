<?php

final class EventController
{
    private $model;

    public function __construct()
    {
        $this->model = new EventModel;
    }

    public function index(){
        echo "fdp";
        $index_data = [
            'allEvent' => ''
        ];
        $index_data['allEvent'] = $this->model->getAllEvent();
        echo "ta darone";
        View::montrer('main/index', $index_data);
    }
}