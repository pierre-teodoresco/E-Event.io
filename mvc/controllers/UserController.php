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
            'emailError' => '',
            'accountCreate' => ''
        ];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $registerData['email'] = $_POST['email'];

            if (empty($registerData['email'])) {
                $registerData['emailError'] = '<p style=\'color:red\'>Renseignez une adresse mail</p>';
                View::montrer('users/register', $registerData);
                return;
            }
            if($this->model->emailExists($registerData['email'])){
                $registerData['emailError'] = '<p style=\'color:red\'>Cette adresse mail est déjà utilsée</p>';
                View::montrer('users/register', $registerData);
                return;
            }

            $this->model->checkRegister($registerData['email']);
            $registerData['accountCreate'] = '<p style=\'color:green\'>Felicitation, regarder votre email pour avoir vos idenntifications de connexions. (Regarder dans vos spam)/p>';
            View::montrer('users/register', $registerData);

        }else {
            View::montrer('users/register', $registerData);
        }
    }

    public function admin(){
        $admin_data = [
            'headEvent' => '',
            'tableCampagne' => '',
            'tableUsers' => '',
            'userCount' => '',
            'eventCount' => ''
        ];
        $admin_data['headEvent'] = $this->model->headerEventAdmin();
        $admin_data['tableCampagne'] = $this->model->tableCampagne();
        $admin_data['tableUsers'] = $this->model->tableUsers();
        $admin_data['userCount'] = $this->model->userCount();
        $admin_data['eventCount'] = $this->model->eventCount();

        View::montrer('users/admin', $admin_data);
    }

}