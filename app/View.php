<?php

final class View
{
    public static function ouvrirTampon()
    {
        // On démarre le tampon de sortie, on va l'appeler "tampon principal"
        ob_start();
    }

    public static function recupererContenuTampon()
    {
        // On retourne le contenu du tampon principal
        return ob_get_clean();
    }

    public static function montrer ($S_localisation, $data = array())
    {
        extract($data);
        ob_start();
        include(Constants::repertoireVues() . $S_localisation. '.php');
        $content = ob_get_clean();
        include(Constants::repertoireVues() .'template.php');
    }


}