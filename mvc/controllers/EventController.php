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
            'allEvent' => '',
            'event' => '',
            'comment' => '',
            'modal' => ''
        ];

        if(isset($_GET['id'])){
            $index_data['event'] = $this->model->getEvent($_GET['id']);
            $index_data['comment'] = $this->model->getComment($_GET['id']);
            View::montrer('main/event', $index_data);
            return;
        }else{
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
                        <a href=\"\" class=\"button sucess\">$event[votes] Votes</a>
                        <a href=\"?controller=event&action=index&id=$event[id]\" class=\"button\">Voir l'evenement</a>
                    </div>
                </div>
            </div>
            ";
            }
            if($_SESSION[username] == "" && $_SESSION[id] != ""){
                echo("client connecté mais sans account");

                $modal .= "<script> var modal = document.getElementById(\"myModal\");
                    modal.style.display = \"block\";
                </script>";
            }else{
                echo "non connecté";
            }
        }
        $index_data['allEvent'] = $value;
        $index_data['modal'] = $modal;
        View::montrer('main/index', $index_data);
    }
}