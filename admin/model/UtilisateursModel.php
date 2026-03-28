<?php
// model/UtilisateursModel.php
namespace model;

// Utilisation de la classe Exception qu'on a créée
use model\UtilisateurException;

class UtilisateursModel
{

    public function verifierConnexion($email, $pass) {
    // On utilise les alias AS pour faire correspondre SQL et les attributs de ta classe
    $sql = "SELECT id_user AS id, nom, prenom, email, mot_de_passe AS motDePasse, role, filiere, lien_linkedin, telephone_pro FROM UTILISATEURS WHERE email = :email";
    $stmt = $this->connexion->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    
    // On récupère en tableau associatif classique
    $data = $stmt->fetch(\PDO::FETCH_ASSOC);

    if ($data) {
        // Le cahier des charges exige un vrai système de vérification [cite: 97]
        if (password_verify($pass, $data['motDePasse'])) { 
            
            // Instanciation de la bonne classe selon le rôle
            if ($data['role'] === 'Admin') {
                return new \classes\Administrateur($data['id'], $data['nom'], $data['prenom'], $data['email'], $data['motDePasse'], $data['telephone_pro']);
            } else {
                return new \classes\Etudiant($data['id'], $data['nom'], $data['prenom'], $data['email'], $data['motDePasse'], $data['filiere'], $data['lien_linkedin']);
            }

        } else {
            throw new UtilisateurException("Mot de passe incorrect.");
        }
    } else {
        throw new UtilisateurException("Utilisateur non trouvé.");
    }
    }
}
