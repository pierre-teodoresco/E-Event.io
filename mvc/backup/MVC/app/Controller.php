<?php
class Controller{

    private $controller;
    private $controllerName;
    private $action;
    private $postParams;

    public function __construct ($controllerName, $action, $postParams)
    {

        if($controllerName == null || trim($controllerName) == '' || $controllerName == 'Controller') {
            // Définir au préalable une classe "Controller" par défaut,
            // afin de faire fonctionner correctement le reste du code
            $controllerName = 'EventController';
        }

        if(!class_exists($controllerName)) {
            header("HTTP/1.1 404 Not Found"); // https://www.php.net/manual/fr/function.header.php
            exit();
        }

        if($action == null || trim($action) == '') {
            $action = 'index';
        }

        $controller = new $controllerName;

        if(!method_exists($controller, $action)) {
            header("HTTP/1.1 404 Not Found"); // https://www.php.net/manual/fr/function.header.php
            exit();

        }

        $this->postParams = $postParams;
        $this->controllerName = $controllerName;
        $this->action = $action;
        $this->controller = $controller;



    }


    public function executer()
    {
        $B_called = call_user_func_array(array($this->controller, $this->action), array());

        if (false === $B_called) {
            throw new ControleurException("L'action " . $this->_A_urlDecortique['action'] .
                " du contrôleur " . $this->_A_urlDecortique['controleur'] . " a rencontré une erreur.");
        }
    }
}