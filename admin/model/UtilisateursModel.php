<?php
namespace model;

// Utilisation de la classe Exception qu'on a créée
use model\UtilisateurException;
use model\Database;


class UtilisateursModel
{
    // Ajout de la propriété pour stocker la connexion
    private $connexion;

    public function __construct() {
        $this->connexion = Database::getConnexion();
    }

    // Méthode pour vérifier la connexion
    public function verifierConnexion($email, $pass) {
        
        $sql = "SELECT id_user AS id, nom, prenom, email, mot_de_passe AS motdepasse, role, filiere, lien_linkedin, telephone_pro FROM UTILISATEURS WHERE email = :email";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();


        $data = $stmt->fetch(\PDO::FETCH_ASSOC);


        if ($data) {
            if (password_verify($pass, $data['motdepasse'])){ 
                
                if ($data['role'] === 'Admin') {
                    return new \classes\Administrateur($data['id'], $data['nom'], $data['prenom'], $data['email'], $data['motdepasse'], $data['telephone_pro']);
                } else {
                    return new \classes\Etudiant($data['id'], $data['nom'], $data['prenom'], $data['email'], $data['motdepasse'], $data['filiere'], $data['lien_linkedin']);
                }

            } else {
                throw new UtilisateurException("Mot de passe incorrect.");
            }
        } else {
            throw new UtilisateurException("Utilisateur non trouvé.");
        }
    }

    public function getAllUtilisateurs(){
        $sql = "SELECT id_user AS id, nom, prenom, role FROM UTILISATEURS";
        $stmt = $this->connexion->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>