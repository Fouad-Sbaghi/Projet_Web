<?php

namespace model;

/**
 * Classe Database
 * Gère la connexion à la base de données PostgreSQL via PDO.
 * Utilise le design pattern Singleton.
 */
class Database
{
    /** @var \PDO|null Instance unique de connexion PDO */
    private static $conn = null;

    /**
     * Retourne l'instance unique de connexion PDO (Singleton)
     * @return \PDO Connexion à la base de données
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
                self::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            } catch (\PDOException $e) {
                die('Erreur de connexion PDO : ' . $e->getMessage());
            }
        }
        return self::$conn;
    }

    /**
     * Ferme la connexion à la base de données
     * @return void
     */
    public static function deconnexion()
    {
        self::$conn = null;
    }
}
