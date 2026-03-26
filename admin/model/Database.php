<?php
// admin/model/Database.php
namespace model;

// On inclut le fichier secret qui contient les mots de passe.
// L'autoloader risque de s'emmêler les pinceaux avec __DIR__, donc on utilise un chemin relatif.
require_once __DIR__ . '/../../config.php'; 

class Database
{
    private static $conn = null;

    public static function getConnexion()
    {
        if (self::$conn === null) {
            try {
                self::$conn = new \PDO(
                    "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, 
                    DB_USER, 
                    DB_PASS
                );
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die('Erreur de connexion PDO : ' . $e->getMessage());
            }
        }
        return self::$conn;
    }
}
?>