<?php
// model/Database.php
namespace model;

/**
 * Classe Database 
 * Permet d'établir la connexion et la déconnexion à la BD
 * Singleton : une seule connexion partagée
 */
class Database
{
    private static $conn = null;

    /**
     * Retourne la connexion PDO (singleton)
     */
    public static function getConnexion()
    {
        if (self::$conn === null) {
            $servername = "localhost";
            $username = "uapv2501475";
            $password = "Fouad84.";
            $port = 5432;
            $dbname = "etd";

            try {
                self::$conn = new \PDO("pgsql:host=$servername;port=$port;dbname=$dbname", $username, $password);
                // Activer les exceptions PDO pour voir les erreurs SQL
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die('Erreur de connexion PDO : ' . $e->getMessage());
            }
        }
        return self::$conn;
    }

    /**
     * Déconnexion de la BD
     */
    public static function deconnexion()
    {
        self::$conn = null;
    }
}
