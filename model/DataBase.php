<?php
namespace model;

use PDO;
use PDOException;

class Database {
    private $host = "localhost";
    private $port = 5433;
    private $dbname = "portofolioDB";
    private $user = "postgres";
    private $pass = "postgresql";
    public $connexion;

    public function getConnexion() {
        $this->connexion = null;
        try {
            $this->connexion = new PDO("pgsql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->dbname, $this->user, $this->pass);
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
        return $this->connexion;
    }
}
?>