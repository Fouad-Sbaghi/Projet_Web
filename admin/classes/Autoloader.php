<?php
/**
 * Classe Autoloader
 * Charge automatiquement les classes PHP via spl_autoload_register
 * en se basant sur les namespaces pour localiser les fichiers.
 */
class Autoloader
{
    /**
     * Enregistre la méthode autoload auprès de PHP
     * @return void
     */
    public static function enregistrer()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Charge automatiquement un fichier de classe à partir de son namespace
     * @param string $nom_classe Nom complet de la classe (avec namespace)
     * @return void
     */
    public static function autoload($nom_classe)
    {
        $nom_classe = str_replace('\\', '/', $nom_classe);
        $fichier = __DIR__ . '/../' . $nom_classe . '.php';

        if (file_exists($fichier)) {
            require $fichier;
        }
    }
}
