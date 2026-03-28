<?php
namespace model;

// Utilisation de la classe Exception qu'on a créée
use model\UtilisateurException;
use model\Database;

class UtilisateursModel
{
    // Ajout de la propriété pour stocker la connexion
    private $connexion;

    // Ajout du constructeur indispensable !
    public function __construct($db = null) {
        // Si on nous passe la connexion, on la prend, sinon on va la chercher
        $this->connexion = $db ?? Database::getConnexion();
    }

    // Méthode pour vérifier la connexion
    public function verifierConnexion($email, $pass) {
        
        // On récupère tout, et on utilise "AS" pour faire correspondre le SQL aux attributs des objets
        $sql = "SELECT id_user AS id, nom, prenom, email, mot_de_passe AS motDePasse, role, filiere, lien_linkedin, telephone_pro FROM UTILISATEURS WHERE email = :email";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        
        // On récupère sous forme de tableau associatif
        $data = $stmt->fetch(\PDO::FETCH_ASSOC);

        // Si l'utilisateur existe
        if ($data) {
            // Note : Plus tard, il faudra utiliser password_verify($pass, $data['motDePasse'])
            // Pour l'instant, on compare en clair comme tu l'as fait :
            if ($pass === $data['motDePasse']) { 
                
                // C'est ici qu'on respecte l'héritage de ton diagramme !
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
?>