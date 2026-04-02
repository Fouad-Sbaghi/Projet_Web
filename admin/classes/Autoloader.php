<?php
class Autoloader
{

    public static function enregistrer()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($nom_classe)
    {

        $nom_classe = str_replace('\\', '/', $nom_classe);

        $fichier = __DIR__ . '/../' . $nom_classe . '.php';

        if (file_exists($fichier)) {
            require $fichier;
        }
    }
}
