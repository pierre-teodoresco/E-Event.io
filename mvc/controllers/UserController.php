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
            View::montrer('users/register', $registerData);
        }else {
            View::montrer('users/register', $registerData);
        }
    }

    public function admin(){
        if(isset($_SESSION['role'])){
            $role = $_SESSION['role'];
            if($role !=4){
                header('Location: ?');
            }
        }
        else{
            //header('Location: ?');
        }

        $admin_data = [
            'headEvent' => '',
            'tableCampagne' => '',
            'tableUsers' => '',
            'userCount' => '',
            'eventCount' => ''
        ];
        $eventOnlineCount = $this->model->countOnlineEvents();
        if ($eventOnlineCount == 0) {
            $admin_data['headEvent'] = "<p>Aucun evenement n'est en cours</p><p>Vous pouvez créer un evenement en cliquant sur lien</p>";
        } else {
            $admin_data['headEvent'] = "<p>Un evenement est en cours</p>";
        }

        $campagnes = $this->model->tableCampagne();
        $dataCampagnes= "";
        foreach ($campagnes as $campagne){
            $dataCampagnes .= "<tr><td>$campagne[id]</td><td>$campagne[name]</td><td>$campagne[datedeb]</td><td>$campagne[datefin]</td><td>$campagne[points]</td></tr>";
        }
        $admin_data['tableCampagne'] = $dataCampagnes;

        $users = $this->model->getAll();
        $dataValues= "";
        foreach ($users as $user){
            $dataValues .= "<tr><td>".$user['id']."</td><td><div class=\"select-rank\"><select name=\"rank\" id=\"rank-select\">";
            $dataValues .= ($user['role'] == 1) ? "<option value=\"0\" selected='selected'>Donateurs</option>" : "<option value=\"0\" >Donateurs</option>";
            $dataValues .= ($user['role'] == 2) ? "<option value=\"1\" selected='selected'>Organisateur</option>" : "<option value=\"1\" >Organisateur</option>";
            $dataValues .= ($user['role'] == 3) ? "<option value=\"2\" selected='selected'>Jury</option>" : "<option value=\"2\" >Jury</option>";
            $dataValues .= ($user['role'] == 4) ? "<option value=\"4\" selected='selected'>Administrateur</option>" : "<option value=\"4\" >Administrateur</option>";
            $dataValues .= "</select></div>
                    </td><td>$user[username]</td><td>$user[email]</td>
                       <td>$user[point]</td></tr>";
        }
        $admin_data['tableUsers'] = $dataValues;
        $admin_data['userCount'] = $this->model->userCount();
        $admin_data['eventCount'] = $this->model->eventCount();
        View::montrer('users/admin', $admin_data);
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