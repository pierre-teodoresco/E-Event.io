<?php

final class View
{
    //Permet d'afficher une page php avec une grille de données
    public static function montrer ($S_localisation, $data = array())
    {
        extract($data); //Facilite l'appel des données fournies
        ob_start();
        include(Constants::repertoireVues() . $S_localisation. '.php');
        $content = ob_get_clean(); //content contient la page demandée
        include(Constants::repertoireVues() .'template.php'); //Affichage de la page demandée à l'intérieur de notre template
    }
}