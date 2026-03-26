<?php
class Autoloader
{

    public static function enregistrer()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($nom_classe)
    {
        // Remplace les antislashes des namespaces par des slashes (pour les dossiers)
        $nom_classe = str_replace('\\', '/', $nom_classe);

        // __DIR__ pointe sur le dossier actuel ("class/"). On remonte d'un cran pour chercher partout.
        $fichier = __DIR__ . '/../' . $nom_classe . '.php';

        if (file_exists($fichier)) {
            require $fichier;
        }
    }
}
