<?php
namespace model;

use PDO;
use classes\Utilisateur; 

class UtilisateursModel {
    private $connexion;

    public function __construct($db) {
        $this->connexion = $db;
    }


    public function inserer(Utilisateur $user) {
        $role = (get_class($user) == 'classes\Administrateur') ? 'Admin' : 'Etudiant';

        $sql = "INSERT INTO UTILISATEURS (nom, prenom, email, mot_de_passe, role, filiere, lien_linkedin, telephone_pro) 
                VALUES (:nom, :prenom, :email, :mot_de_passe, :role, :filiere, :lien_linkedin, :telephone_pro)";
        
        $stmt = $this->connexion->prepare($sql);

        $stmt->bindValue(':nom', $user->nom);
        $stmt->bindValue(':prenom', $user->prenom);
        $stmt->bindValue(':email', $user->email);
        $stmt->bindValue(':mot_de_passe', password_hash($user->motDePasse, PASSWORD_DEFAULT)); 
        $stmt->bindValue(':role', $role);

        $stmt->bindValue(':filiere', property_exists($user, 'filiere') ? $user->filiere : null);
        $stmt->bindValue(':lien_linkedin', property_exists($user, 'lienLinkedin') ? $user->lienLinkedin : null);
        $stmt->bindValue(':telephone_pro', property_exists($user, 'telephonePro') ? $user->telephonePro : null);

        if($stmt->execute()) {
            echo "L'utilisateur a bien été créé dans la base de données !";
            return true;
        }
        return false;
    }
}
?>