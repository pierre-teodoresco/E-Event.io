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
            'modal' => '',
            'point' => '',
            'username' => '',
            'password' => '',
            'passwordc' => '',
            'usernameError' => '',
            'passwordError' => '',
            'passwordcError' => ''
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

                $modal = "<script> var modal = document.getElementById(\"myModal\");
                    modal.style.display = \"block\";
                </script>";

                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $index_data['username'] = $_POST['username'];
                    $index_data['password'] = $_POST['password'];
                    $index_data['passwordc'] = $_POST['passwordc'];
                    if (empty($index_data['username'])) {
                        $index_data['usernameError'] = '<p style=\'color:red\'>Merci de renseignez un pseudo</p>';
                        $index_data['modal'] = $modal;
                        View::montrer('main/index', $index_data);
                        return;
                    }
                    if (empty($index_data['password'])) {
                        $index_data['passwordError'] = '<p style=\'color:red\'>Merci de renseignez un mot de passe</p>';
                        $index_data['modal'] = $modal;
                        View::montrer('main/index', $index_data);
                        return;
                    }
                    if (empty($index_data['passwordc'])) {
                        $index_data['passwordcError'] = '<p style=\'color:red\'>Merci de renseignez la confirmation</p>';
                        $index_data['modal'] = $modal;
                        View::montrer('main/index', $index_data);
                        return;
                    }
                    if ($this->model->userExist($index_data['username'])) {
                        $index_data['passwordcError'] = '<p style=\'color:red\'>Pseudo déjà utilisé</p>';
                        $index_data['modal'] = $modal;
                        View::montrer('main/index', $index_data);
                        return;
                    }
                    if ($index_data['passwordc'] != $index_data['password']) {
                        $index_data['passwordcError'] = '<p style=\'color:red\'>Les mots de passes ne correspondent pas</p>';
                        $index_data['modal'] = $modal;
                        View::montrer('main/index', $index_data);
                        return;
                    }
                    $options = ['cost' => 11,];
                    $this->model->checkUsername($index_data['username'], $index_data['password'], $options, $_SESSION[id]);
                    $_SESSION['username'] = $index_data['username'];
                    View::montrer('main/index', $index_data);
                    return;
                }
            }else{
                echo "non connecté";
            }
        }
        $index_data['allEvent'] = $value;
        $index_data['modal'] = $modal;
        $index_data['point'] = $this->model->getPoint($_SESSION['id']);
        View::montrer('main/index', $index_data);
    }
}