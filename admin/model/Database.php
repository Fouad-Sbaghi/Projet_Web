<?php

namespace model;

class Database
{
    private static $conn = null;

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

                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die('Erreur de connexion PDO : ' . $e->getMessage());
            }
        }
        return self::$conn;
    }

    public static function deconnexion()
    {
        self::$conn = null;
    }
}
