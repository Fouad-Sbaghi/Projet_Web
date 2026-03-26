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
            $username = "postgres";
            $password = "postgresql"; // Mettez votre mot de passe
            $port = 5433;
            $dbname = "portofolioDB"; // Vérifiez le nom de votre base de données

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
