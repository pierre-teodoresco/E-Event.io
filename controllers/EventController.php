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
        $events = $this->model->getAllEvent();
        $value= "";
        foreach ($events as $event){
            $value .= "
            <div class=\"container\">
                <h3> $event[title]</h3>
                <h4> <img src='img/$event[image_profile]' width='100' alt=''> Autheur : <span> $event[username]</span></h4>
                <p> $event[description]</p>
                <div class=\"right\">
                    <div class=\"article-footer\">
                        <a href=\"\" class=\"button sucess\">12 Votes</a>
                        <a href=\"\" class=\"button\">Voir l'evenement</a>
                    </div>
                </div>
            </div>
            ";
        }
        $index_data['allEvent'] = $value;
        View::montrer('events/index', $index_data);
    }
}