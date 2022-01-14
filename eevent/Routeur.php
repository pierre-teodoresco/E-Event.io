<?php


class Routeur
{

    private $_ctrl;
    private $_view;

    public function routeReq(){
        try{
            spl_autoload_register(function($class){
                require_once('models/'.$class.'.php');
            });
            $url = '';

            if(isset($_GET['url'])){
                $url = explode('/', filter_var($_GET['url'],FILTER_SANITIZE_URL));

                $controller = ucfirst((strtolower($url)));
                $controllerClass = $controller."Controller";
                $controllerFile = "controllers/".$controllerClass.".php";

                if(file_exists($controllerFile)){
                    require_once ($controllerFile);
                    $this->_ctrl = new $controllerClass($url);
                }else{
                    throw new Exception('Page introuvable');
                }
            }else{
                require_once('controllers/ControllerAccueil.php');
            }
        }catch (Exception $e){
            $errorMsg = $e->getMessage();
            require_once ('views/viewError.php');
        }
    }
}