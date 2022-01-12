<?php

final class UsersController{

    private $model;

    public function __construct()
    {
        $this->model = new UserModel;
    }

    public function login(){

        $login_data = [
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
            ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $login_data['username'] = $_POST['username'];
            $login_data['password'] = $_POST['password'];

            if (empty($login_data['username'])) {
                $login_data['usernameError'] = '<p style=\'color:red\'>Renseignez un nom d\'utilisateur</p>';
                View::montrer('users/login', $login_data);
            }
            else if (empty($login_data['password'])) {
                $login_data['passwordError'] = '<p style=\'color:red\'>Renseignez un nom mot de passe</p>';
                View::montrer('users/login', $login_data);
            }

        }
        else{
            View::montrer('users/login', $login_data);
        }
    }





    public function register(){

        View::montrer('users/register');
    }
}