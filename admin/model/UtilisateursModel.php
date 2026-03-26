<?php
// model/UtilisateursModel.php
namespace model;

// Utilisation de la classe Exception qu'on a créée
use model\UtilisateurException;

class UtilisateursModel
{

    // Méthode pour vérifier la connexion
    public function verifierConnexion($email, $pass) {
        // ... (votre code d'avant)
        $sql = "SELECT * FROM UTILISATEURS WHERE email = :email";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        // --- LA MODIFICATION EST ICI ---
        // On demande à PDO de nous renvoyer un objet 'Utilisateur'
        $stmt->setFetchMode(\PDO::FETCH_CLASS, 'classes\Utilisateur');
        $utilisateur = $stmt->fetch();

        // Si l'utilisateur existe
        if ($utilisateur) {
            // (La vérification du mot de passe dépend de si vous l'avez hashé ou non en BDD)
            // Si c'est en clair pour l'instant (à changer plus tard pour la sécurité) :
            if ($pass === $utilisateur->mot_de_passe) { 
                return $utilisateur; // On retourne l'OBJET
            } else {
                throw new UtilisateurException("Mot de passe incorrect.");
            }
        } else {
            throw new UtilisateurException("Utilisateur non trouvé.");
        }
    }
}
