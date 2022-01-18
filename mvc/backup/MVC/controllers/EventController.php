<?php

final class EventController
{
    private $model;

    public function __construct()
    {
        $this->model = new EventModel;
    }

    public function index(){
        $userModel = new UserModel();
        $data = [
            'allEvent' => '',
            'event' => '',
            'comment' => '',
            'modal' => '',
            'avatar' => '',
            'point' => '',
            'username' => '',
            'password' => '',
            'passwordc' => '',
            'usernameError' => '',
            'passwordError' => '',
            'passwordcError' => ''
        ];
        if($_SESSION['id']) $data['point'] = $userModel->getPoint($_SESSION['id']);
        if($_SESSION['id']) $data['avatar'] = $userModel->getAttribute('image_profile',$_SESSION['id']);
        if(isset($_GET['id'])){

            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $point = $_POST['givepoint'];
                $comment = $_POST['commentairesec'];
                $this->model->addPoint($_SESSION[id], $point, $comment, $_GET['id']);
                View::montrer('main/event');
                return;
            }
            $event = $this->model->getEvent($_GET['id']);
            $dataEvent = "
                <div class=\"container\">
                <h3> $event[title]</h3>
                <h4> <img src='img/$event[image_profile]' width='100' alt=''> Autheur : <span> $event[username]</span></h4>
                <p> $event[description]</p>
                <p> $event[content]</p>
                <h3>Contenu supplémentaire</h3>
                <table>
                <thead>
                    <tr>
                        <th>Points</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
            ";

            $additionnalContent = $this->model->getAdditionnalContentOfEvent($_GET['id']);
            foreach ($additionnalContent as $row){
                $dataEvent .= "
                <tr>
                    <td> $row[point]</td>
                    <td> $row[description]</td>
                </tr>
                ";
            }
            $dataEvent .= "</tbody></table></div>";
            $data['event'] = $dataEvent;
            $data['comment'] = $this->model->getComment($_GET['id']);
            View::montrer('main/event', $data);
            return;
        }else{
            $events = $this->model->getAllEvent();
            $dataAllEvent= "";
            foreach ($events as $event){
                $dataAllEvent .= "
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
            </div>";
            }
            $data['allEvent'] = $dataAllEvent;
            if($_SESSION[username] == "" && $_SESSION[id] != ""){
                $modal = "<script> var modal = document.getElementById(\"changepassword\");
                    modal.style.display = \"block\";
                </script>";

                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $data['username'] = $_POST['username'];
                    $data['password'] = $_POST['password'];
                    $data['passwordc'] = $_POST['passwordc'];
                    if (empty($data['username'])) {
                        $data['usernameError'] = '<p style=\'color:red\'>Merci de renseignez un pseudo</p>';
                        $data['modal'] = $modal;
                        View::montrer('main/index', $data);
                        return;
                    }
                    if (empty($data['password'])) {
                        $data['passwordError'] = '<p style=\'color:red\'>Merci de renseignez un mot de passe</p>';
                        $data['modal'] = $modal;
                        View::montrer('main/index', $data);
                        return;
                    }
                    if (empty($data['passwordc'])) {
                        $data['passwordcError'] = '<p style=\'color:red\'>Merci de renseignez la confirmation</p>';
                        $data['modal'] = $modal;
                        View::montrer('main/index', $data);
                        return;
                    }
                    if ($userModel->userExist($data['username'])) {
                        $data['passwordcError'] = '<p style=\'color:red\'>Pseudo déjà utilisé</p>';
                        $data['modal'] = $modal;
                        View::montrer('main/index', $data);
                        return;
                    }
                    if ($data['passwordc'] != $data['password']) {
                        $data['passwordcError'] = '<p style=\'color:red\'>Les mots de passes ne correspondent pas</p>';
                        $data['modal'] = $modal;
                        View::montrer('main/index', $data);
                        return;
                    }
                    $options = ['cost' => 11,];
                    $userModel->checkUsername($data['username'], $data['password'], $options, $_SESSION[id]);
                    $_SESSION['username'] = $data['username'];
                    View::montrer('main/index', $data);
                    return;
                }
            }
        }
        $data['modal'] = $modal;
        View::montrer('main/index', $data);
    }
}