<?php
// model/Database.php
namespace model;

class Database
{
    private static $conn = null;

    // Méthode pour obtenir la connexion (Design Pattern Singleton)
    public static function getConnexion()
    {
        if (self::$conn === null) {
            $servername = "localhost";
            $username = "uapv2501850";
            $password = "MsM7du";
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
}
