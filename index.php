<?php
// Ce fichier est le point d'entrée de votre application

require 'app/AutoLoad.php';

if(!isset($_SESSION)){
    session_start();
}
const CONTROLLER_PARAMETER = 'controller';
const ACTION_PARAMETER = 'action';

try
{
    $A_postParams = isset($_POST) ? $_POST : null;
    $controllerName = isset($_GET[CONTROLLER_PARAMETER]) ? $_GET[CONTROLLER_PARAMETER] . 'Controller' : null;
    $action = isset($_GET[ACTION_PARAMETER]) ? $_GET[ACTION_PARAMETER] : null;
    $O_controleur = new Controller($controllerName, $action, $A_postParams);
    $O_controleur->executer();
}
catch (ControleurException $O_exception)
{
    echo ('Une erreur s\'est produite : ' . $O_exception->getMessage());
}