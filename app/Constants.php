<?php
// © GERARD Olivier

final class Constants
{
    const REPERTOIRE_VUES = '/views/';

    const REPERTOIRE_MODELE = '/models/';

    const REPERTOIRE_NOYAU = '/app/';

    const REPERTOIRE_EXCEPTIONS = '/app/Exceptions/';

    const REPERTOIRE_CONTROLEURS = '/controllers/';

    public static function repertoireRacine()
    {
        return realpath(__DIR__ . '/rendu/');
    }

    public static function repertoireNoyau()
    {
        return self::repertoireRacine() . self::REPERTOIRE_NOYAU;
    }

    public static function repertoireExceptions()
    {
        return self::repertoireRacine() . self::REPERTOIRE_EXCEPTIONS;
    }

    public static function repertoireVues()
    {
        return self::repertoireRacine() . self::REPERTOIRE_VUES;
    }

    public static function repertoireModele()
    {
        return self::repertoireRacine() . self::REPERTOIRE_MODELE;
    }

    public static function repertoireControleurs()
    {
        return self::repertoireRacine() . self::REPERTOIRE_CONTROLEURS;
    }

}