<?php
namespace model;

use PDO;
use classes\Faq; // On importe votre classe objet

class FaqModel {
    private $connexion;

    public function __construct() {
        // On utilise votre Database en mode Singleton
        $this->connexion = Database::getConnexion();
    }

    // Méthode pour récupérer toutes les FAQ sous forme d'objets
    public function getAllFaqs() {
        $sql = "SELECT * FROM FAQ";
        $stmt = $this->connexion->query($sql);
        
        // C'est ICI la magie : PDO va transformer chaque ligne SQL en un objet de votre classe Faq !
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'classes\Faq');
        
        return $stmt->fetchAll(); // Retourne un tableau d'objets Faq
    }
}
?>