<?php

class Controller
{
    private $controller;
    private $action;

    //Traitement de l'url à partir du nom du controlleur et de l'action demandée
    public function __construct($controllerName, $action)
    {
        //Le nom du controlleur est remplacé avec le nom du controlleur Event en cas de problème avec ce dernier
        if ($controllerName == null || trim($controllerName) == '' || $controllerName == 'Controller') {
            $controllerName = 'EventController';
        }

        //On vérifie l'existance de la classe associée au nom du controlleur demandé
        if (!class_exists($controllerName)) {
            header("HTTP/1.1 404 Not Found");
            exit();
        }

        //L'action est remplacée par l'action par défaut en cas de problème avec celle ci
        if ($action == null || trim($action) == '') {
            $action = 'index';
        }

        //On instancie le controlleur demandé
        $controller = new $controllerName;

        //On vérifie l'existance de l'action
        if (!method_exists($controller, $action)) {
            header("HTTP/1.1 404 Not Found");
            exit();
        }

        $this->action = $action;
        $this->controller = $controller;
    }


    //Execution de l'action associée au controlleur
    /**
     * @throws ExceptionController
     */
    public function executer()
    {
        //Execution de la méthode action associée au controlleur
        $B_called = call_user_func_array(array($this->controller, $this->action), array());

        if (false === $B_called) {
            throw new ExceptionController("L'action du controlleur a rencontré une erreur.");
        }
    }
}