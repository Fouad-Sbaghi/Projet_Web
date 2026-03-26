<?php
// model/UtilisateursModel.php
namespace model;

// Utilisation de la classe Exception qu'on a créée
use model\UtilisateurException;

class UtilisateursModel
{

    // Méthode pour vérifier la connexion
    public function verifierConnexion($email, $motDePasse)
    {
        $conn = Database::getConnexion();

        // On cherche l'utilisateur par son email (ici j'utilise l'email comme "user" pour se connecter)
        $sql = "SELECT * FROM UTILISATEURS WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(\PDO::FETCH_CLASS);

        // Si aucun utilisateur n'est trouvé
        if (!$user) {
            throw new UtilisateurException("Cet utilisateur n'existe pas.");
        }

        if ($motDePasse === $user['mot_de_passe'] || password_verify($motDePasse, $user['mot_de_passe'])) {
            return $user; // On retourne les infos de l'utilisateur
        } else {
            throw new UtilisateurException("Mot de passe incorrect.");
        }
    }

    // Vous ajouterez ici plus tard : ajouterUtilisateur(), modifierProfil(), supprimerCompte()
}
