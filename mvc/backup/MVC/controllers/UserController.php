<?php
final class UserController{

    private $model;

    public function __construct()
    {
        $this->model = new UserModel;
    }

    public function login(){

        $login_data = [
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passwordError' => '',
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $login_data['email'] = $_POST['email'];
            $login_data['password'] = $_POST['password'];

            if (empty($login_data['email'])) {
                $login_data['emailError'] = '<p style=\'color:red\'>Renseignez une adresse mail</p>';
                View::montrer('users/login', $login_data);
                return;
            }
            if (empty($login_data['password'])) {
                $login_data['passwordError'] = '<p style=\'color:red\'>Renseignez un nom mot de passe</p>';
                View::montrer('users/login', $login_data);
                return;
            }
            if(!$this->model->emailExists($login_data['email'])){
                $login_data['emailError'] = '<p style=\'color:red\'>Cette email n\'existe pas</p>';
                View::montrer('users/login', $login_data);
                return;
            }
            if(!$this->model->checkLogin($login_data['email'], $login_data['password'])){
                $login_data['passwordError'] = '<p style=\'color:red\'>Mot de passe invalide</p>';
                View::montrer('users/login', $login_data);
                return;
            }
        }
        else{
            View::montrer('users/login', $login_data);
        }
    }

    /**
     * @return Fonction lors de la modification des information utilisateurs,
     */
    public function edit(){
        /**
         * Tableau qui récupère chaque parametre envoyé en POST et défini les des message d'erreur avec "error"+<var>
         */
        $edit_data = [
            'email' => '',
            'oldpassword' => '',
            'password' => '',
            'passwordc' => '',
            'prenom' => '',
            'nom' => '',
            'avatar' => '',
            'img' => '',
            'errorOldpassword' => '',
            'errorPassword' => '',
            'errorPasswordc' => ''
        ];


        /**
         * Charger les valeur des input en recuperant les informations dans la BDD;
         */

        /**
         * Recuprer les informations lorsque le joueur clique sur le bouton "valider mes informations"
         */
        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $edit_data['oldpassword'] = $_POST['oldpassword'];
            $edit_data['password'] = $_POST['password'];
            $edit_data['passwordc'] = $_POST['passwordc'];
            $edit_data['prenom'] = $_POST['prenom'];
            $edit_data['nom'] = $_POST['nom'];

            /**
             * On detecte si l'utilisateur veut changer son mot de passes uniquement lorsque le input "oldpassword" n'est plus = "";
             */
            if ($edit_data['oldpassword'] != "") {

                // On verifie que le input password n'est pas vide.
                if (empty($edit_data['password'])) {
                    $edit_data['errorPassword'] = '<p style=\'color:red\'>Veuillez definir un mot de passe</p>';
                    View::montrer('users/edit', $edit_data);
                    return;
                }

                // On verifie que la confirmation n'est pas vide. avec le passwordc
                if (empty($edit_data['passwordc'])) {
                    $edit_data['errorPasswordc'] = '<p style=\'color:red\'>Veuillez definir mot de passe </p>';
                    View::montrer('users/edit', $edit_data);
                    return;
                }

                // On verifie que le nouveau mot de passe et la confirmation sont bien egal.
                if ($edit_data['password'] != $edit_data['passwordc']) {
                    $edit_data['errorPassword'] = '<p style=\'color:red\'>Les mots de passes ne correspondent pas</p>';
                    View::montrer('users/edit', $edit_data);
                    return;
                }

                // On varifie que le nouveau mot de passe n'est pas egal à l'ancien mot de passes.
                if ($edit_data['password'] == $edit_data['oldpassword']) {
                    $edit_data['errorOldpassword'] = '<p style=\'color:red\'>Vous ne pouvez pas definir le meme mot de passe</p>';
                    View::montrer('users/edit', $edit_data);
                    return;
                }

                // On verfie à l'aide de la BDD que c'est le bon mot de passe dans l'input "oldpassword" qu'il a renseigné.
                if (!$this->model->checkPassword($_SESSION['id'], $edit_data['oldpassword'])) {
                    $edit_data['errorOldpassword'] = '<p style=\'color:red\'>Votre mot de passe est invalide</p>';
                    View::montrer('users/edit', $edit_data);
                    return;
                }

                //Une fois toutes les vérifications nous pouvons donc changer le mot de passes utilisateurs.
                $edit_data['errorOldpassword'] = '<p style=\'color:green\'>Mot de passes changé</p>';
                $options = ['cost' => 11,];
                $this->model->checkUsername($_SESSION['username'], $edit_data['password'], $options, $_SESSION['id']);
            }

            if (!empty($_FILES['avatar']['name'])) {
                $filename = $_FILES["avatar"]["name"];
                $tempname = $_FILES["avatar"]["tmp_name"];
                $folder = "img/" . $filename;

                if (move_uploaded_file($tempname, $folder)) {
                    $this->model->changeImage($_SESSION['id'], $filename);

                    $edit_data['img'] = $this->model->getAttribute('image_profile', $_SESSION['id']);
                    View::montrer('users/edit', $edit_data);
                } else {
                    echo "Failed to upload image";
                }
            }
            if($edit_data['prenom'] != ""){
                $edit_data['prenom'] = $this->model->updateVar($_SESSION[id], 'prenom', $edit_data['prenom']);
            }
            if($edit_data['nom'] != ""){
                $edit_data['nom'] = $this->model->updateVar($_SESSION[id], 'nom', $edit_data['nom']);
            }

        }
        $edit_data['email'] = $this->model->getAttribute('email',$_SESSION['id']);
        $edit_data['prenom'] = $this->model->getAttribute('prenom',$_SESSION['id']);
        $edit_data['nom'] = $this->model->getAttribute('nom',$_SESSION['id']);
        $edit_data['img'] = $this->model->getAttribute('image_profile',$_SESSION['id']);
        View::montrer('users/edit', $edit_data);

    }

    public function register(){

        $registerData = [
            'email' => '',
            'rank' => '',
            'emailError' => '',
            'rankError' => '',
            'accountCreate' => ''
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $registerData['email'] = $_POST['email'];
            $registerData['rank'] = $_POST['role'];

            if (empty($registerData['email'])) {
                $registerData['emailError'] = '<p style=\'color:red\'>Renseignez une adresse mail</p>';
                View::montrer('users/register', $registerData);
                return;
            }
            if (empty($registerData['rank'])) {
                $registerData['rankError'] = '<p style=\'color:red\'>Veuillez selectionner un role</p>';
                View::montrer('users/register', $registerData);
                return;
            }
            if($this->model->emailExists($registerData['email'])){
                $registerData['emailError'] = '<p style=\'color:red\'>Cette adresse mail est déjà utilsée</p>';
                View::montrer('users/register', $registerData);
                return;
            }
            $options = ['cost' => 11,];
            $password = $this->randomPassword();
            $this->model->checkRegister($registerData['email'], $password, $options, $registerData['rank']);
            $this->sendEmailPassword($registerData['email'], $password);
            $registerData['accountCreate'] = '<p style=\'color:green\'>Felicitation, regarder votre email pour avoir vos idenntifications de connexions. (Regarder dans vos spam)/p>';
        }
        View::montrer('users/register', $registerData);
    }

    public function admin(){

        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
            if($role !=4){
                header('Location: ?');
            }
        }
        else{
            header('Location: ?');
        }
        $campagneModel = new CampagneModel();
        $eventModel = new EventModel();
        $admin_data = [
            'headEvent' => '',
            'tableCampagne' => '',
            'tableUsers' => '',
            'userCount' => '',
            'eventCount' => '',
            'campagneName' => '',
            'campagneDatedeb' => '',
            'campagneDatefin' => '',
            'campagneUser' => '',
            'errorCampagneName' => '',
            'errorCampagneDatedeb' => '',
            'errorCampagneDatefin' => '',
            'errorCampagneUser' => '',
            'script' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST' ){
            if($_POST['action'] == "usertable"){

                $users = $this->model->getAll();

                for ($i = 0; $i< count($users); $i++){
                    $this->model->updateOne('role', $_POST['rank-select'][$i],$users[$i]['id']);
                }
            }else {
                $admin_data['campagneName'] = $_POST['campagne-title'];
                $admin_data['campagneDatedeb'] = $_POST['campagne-start'];
                $admin_data['campagneDatefin'] = $_POST['campagne-end'];
                $admin_data['campagneUser'] = $_POST['default-point'];
                $admin_data['script'] = "<script>document.getElementById(\"myModal\").style.display = \"block\";</script>";
                if (empty($admin_data['campagneName'])) {
                    $admin_data['errorCampagneName'] = '<p style=\'color:red\'>Renseignez un nom de campagne</p>';
                    View::montrer('users/admin', $admin_data);
                    return;
                }
                if (empty($admin_data['campagneDatedeb'])) {
                    $admin_data['errorCampagneDatedeb'] = '<p style=\'color:red\'>Renseignez une date de debut</p>';
                    View::montrer('users/admin', $admin_data);
                    return;
                }
                if (empty($admin_data['campagneDatefin'])) {
                    $admin_data['errorCampagneDatefin'] = '<p style=\'color:red\'>Renseignez une date de fin</p>';
                    View::montrer('users/admin', $admin_data);
                    return;
                }
                if (empty($admin_data['campagneUser'])) {
                    $admin_data['errorCampagneUser'] = '<p style=\'color:red\'>Renseignez un nombre de point par joueur</p>';
                    View::montrer('users/admin', $admin_data);
                    return;
                }
                if ($admin_data['campagneDatefin'] <= $admin_data['campagneDatedeb']) {
                    $admin_data['errorCampagneDatefin'] = '<p style=\'color:red\'>Renseignez date fin superieur a date debut</p>';
                    View::montrer('users/admin', $admin_data);
                    return;
                }
                $this->model->registerCampagne($admin_data['campagneName'], $admin_data['campagneDatedeb'], $admin_data['campagneDatefin'], $admin_data['campagneUser']);
                $admin_data['script'] = "";
                header('Location: ?controller=user&action=admin');

            }
        }
        $eventOnlineCount = $eventModel->countOnlineEvents();
        if ($eventOnlineCount == 0) {
            $admin_data['headEvent'] = "<p>Aucun evenement n'est en cours</p><p>Vous pouvez créer un evenement en cliquant sur lien</p>
            <div class=\"right\">
            <a id=\"myBtn\" class=\"button\">Créer une campagne</a>
            </div>";
        } else {
            $admin_data['headEvent'] = "<p>Un evenement est en cours</p>
             <form method=\"post\" id=\"closeCamp\">
            <div class=\"right\">
            <a href=\"javascript:;\"  class=\"button danger\">Arreter la campagne</a></form>
            
            </div>";
        }
        $campagnes = $campagneModel->getAll();
        $dataCampagnes= "";
        foreach ($campagnes as $campagne){
            $dataCampagnes .= "<tr><td>$campagne[id]</td><td>$campagne[name]</td><td>$campagne[datedeb]</td><td>$campagne[datefin]</td><td>$campagne[points]</td></tr>";
        }
        $admin_data['tableCampagne'] = $dataCampagnes;

        $users = $this->model->getAll();
        $dataValues= "";
        foreach ($users as $user){
            $dataValues .= "<tr><td>".$user['id']."</td><td><div class=\"select-rank\">  <select name=\"rank-select[]\" id=\"rank-select\">";
            $dataValues .= ($user['role'] === 1) ? "<option value=\"1\" selected=\"selected\">Donateurs</option>" : "<option value=\"1\" >Donateurs</option>";
            $dataValues .= ($user['role'] == 2) ? "<option value=\"2\" selected=\"selected\">Organisateur</option>" : "<option value=\"2\" >Organisateur</option>";
            $dataValues .= ($user['role'] == 3) ? "<option value=\"3\" selected=\"selected\">Jury</option>" : "<option value=\"3\" >Jury</option>";
            $dataValues .= ($user['role'] == 4) ? "<option value=\"4\" selected=\"selected\">Administrateur</option>" : "<option value=\"4\" >Administrateur</option>";
            $dataValues .= "</select></div>
                    </td><td>$user[username]</td><td>$user[email]</td>
                       <td>$user[point]</td></tr>";
        }
        $admin_data['tableUsers'] = $dataValues;
        $admin_data['userCount'] = $this->model->getCount();
        $admin_data['eventCount'] = $eventModel->getCount();
        View::montrer('users/admin', $admin_data);
    }



    public function jury(){

        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
            if($role !=3){
                header('Location: ?');
            }
        }
        else{
            header('Location: ?');
        }
        $campagneModel = new CampagneModel();
        $eventModel = new EventModel();
        $jury_data = [
            'tableUsers' => '',
            'userCount' => '',
            'eventCount' => '',
            'moyenneCount' => ''

        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST' ){

        }


        /*$events = $eventModel->getAllEvent();
        $dataValues= "";
        foreach ($events as $event){
            $dataValues .= "<tr><td>$event[id]</td><td>$event[title]</td><td>$event[votes]</td></tr>";
        }*/
        //$admin_data['tableUsers'] = $dataValues;
        $jury_data['userCount'] = $eventModel->getCount();
        $jury_data['eventCount'] = $eventModel->getVotes();
        $jury_data['moyenneCount'] = $eventModel->getMoy();
        View::montrer('users/jury', $jury_data);
    }

    public function sendEmailPassword($to, $pass){
        $subject = 'E-Event - Confirmation de création de compte';
        $message = '
     <html>
      <head>
       <title>Confirmation de création de compte</title>
      </head>
      <body>
      <h2>Confirmation de votre inscription</h2>
      <p>Bienvenue sur E-event.io!</p>
      <p>Voici votre mot de passe généré :</p>
      <h3>' .$pass.'</h3>
      <br>
      <p>Information sécurité :</p>
      <p>Nous vous recommandons de changer votre mot de passe une fois la première connexion effectué</p>
      <p>Ne donner jamais votre mot de passe</p>
      <p>Aucun membre du staff de e-event ne vous demandera votre mot de passe.</p>
      
      <p>Si vous n\'êtes pas l\'auteur de cette demande merci de ne pas en tenir compte </p>
      <br>
      <p>Equipe E-event.io! </p>
      <p>Message automatique, merci de ne pas répondre.</p>
      <br>
      <p>Projet fictif, développé au cours du cursur universitaire.</p>
      </body>
     </html>
     ';

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: E-EventIO <no-reply@tdeshors.net>';
        // Envoi
        mail($to, $subject, $message, implode("\r\n", $headers));
    }


    public function resetPwd($to, $pass){
        $subject = 'E-Event - Changement mot de passe';
        $message = '
     <html>
      <head>
       <title>Changement de mot de passe</title>
      </head>
      <body>
      <h2>Changement de votre mot de passe</h2>
      <p>Vous venez de réaliser la réinstialisation de votre mot de passe</p>
      <p>Voici votre nouveau mot de passe généré :</p>
      <h3>' .$pass.'</h3>
      <p>Durée du mot de passe 2h</p>
      <br>
      <p>Information sécurité :</p>
      <p>Nous vous recommandons de changer votre mot de passe une fois la première connexion effectué</p>
      <p>Ne donner jamais votre mot de passe</p>
      <p>Aucun membre du staff de e-event ne vous demandera votre mot de passe.</p>
      
      <p>Si vous n\'êtes pas l\'auteur de cette demande merci de ne pas en tenir compte </p>
      <br>
      <p>Equipe E-event.io! </p>
      <p>Message automatique, merci de ne pas répondre.</p>
      <br>
      <p>Projet fictif, développé au cours du cursur universitaire.</p>
      </body>
     </html>
     ';

        // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: E-EventIO <no-reply@tdeshors.net>';
        // Envoi
        mail($to, $subject, $message, implode("\r\n", $headers));
    }

    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-@&?!';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 10; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}