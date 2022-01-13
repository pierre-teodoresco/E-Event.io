<?php

require 'app/Constants.php';

final class AutoLoad
{
    public static function chargerClassesNoyau ($S_nomDeClasse)
    {
        $S_fichier = Constants::repertoireNoyau() . "$S_nomDeClasse.php";
        self::_charger($S_fichier);
    }

    public static function chargerClassesObjects ($S_nomDeClasse)
    {
        $S_fichier = Constants::repertoireObjects() . "$S_nomDeClasse.php";
        self::_charger($S_fichier);
    }

    public static function chargerClassesException ($S_nomDeClasse)
    {
        $S_fichier = Constants::repertoireExceptions() . "$S_nomDeClasse.php";

        self::_charger($S_fichier);
    }

    public static function chargerClassesModele ($S_nomDeClasse)
    {
        $S_fichier = Constants::repertoireModele() . "$S_nomDeClasse.php";

        self::_charger($S_fichier);
    }


    public static function chargerClassesVue ($S_nomDeClasse)
    {
        $S_fichier = Constants::repertoireVues() . "$S_nomDeClasse.php";

        self::_charger($S_fichier);
    }

    public static function chargerClassesControleur ($S_nomDeClasse)
    {
        $S_fichier = Constants::repertoireControleurs() . "$S_nomDeClasse.php";
        self::_charger($S_fichier);
    }
    private static function _charger ($S_fichierACharger)
    {
        if (is_readable($S_fichierACharger))
        {
            require $S_fichierACharger;
        }
    }

}

// J'empile tout ce beau monde comme j'ai toujours appris à le faire...
spl_autoload_register('AutoLoad::chargerClassesNoyau');
spl_autoload_register('AutoLoad::chargerClassesObjects');
spl_autoload_register('AutoLoad::chargerClassesException');
spl_autoload_register('AutoLoad::chargerClassesModele');
spl_autoload_register('AutoLoad::chargerClassesVue');
spl_autoload_register('AutoLoad::chargerClassesControleur');
