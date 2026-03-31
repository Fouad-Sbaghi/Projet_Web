<?php
namespace model;

use model\UtilisateurException;
use model\Database;
use PDO;

/**
 * Classe UtilisateursModel
 * 
 * Gère la récupération, modification et suppression des utilisateurs
 * Namespace model, utilisation de PDO uniquement
 */
class UtilisateursModel
{
    private $connexion;

    public function __construct() {
        $this->connexion = Database::getConnexion();
    }

    /**
     * Vérifier la connexion d'un utilisateur
     * @param string $email
     * @param string $pass mot de passe en clair
     * @return \classes\Etudiant|\classes\Administrateur
     * @throws UtilisateurException
     */
    public function verifierConnexion($email, $pass) {
        
        $sql = "SELECT id_user AS id, nom, prenom, email, mot_de_passe AS motdepasse, role, filiere, lien_linkedin, telephone_pro FROM UTILISATEURS WHERE email = :email";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            if (password_verify($pass, $data['motdepasse'])){ 
                
                if ($data['role'] === 'Admin') {
                    return new \classes\Administrateur($data['id'], $data['nom'], $data['prenom'], $data['email'], $data['motdepasse'], $data['telephone_pro']);
                } else {
                    return new \classes\Etudiant($data['id'], $data['nom'], $data['prenom'], $data['email'], $data['motdepasse'], $data['filiere'], $data['lien_linkedin']);
                }

            } else {
                throw new UtilisateurException("Mot de passe incorrect.", 401);
            }
        } else {
            throw new UtilisateurException("Utilisateur non trouvé.", 404);
        }
    }

    /**
     * Récupérer tous les utilisateurs
     * @return array tableau associatif
     */
    public function getAllUtilisateurs(){
        $sql = "SELECT id_user AS id, nom, prenom, email, role FROM UTILISATEURS";
        $stmt = $this->connexion->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach($data as $row) {
            if ($row['role'] === 'Admin') {
                $users[] = new \classes\Administrateur($row['id'], $row['nom'], $row['prenom'], $row['email'], "", "");
            } else {
                $users[] = new \classes\Etudiant($row['id'], $row['nom'], $row['prenom'], $row['email'], "", "", "");
            }
        }
        return $users;
    }

    /**
     * Récupérer un utilisateur par son ID
     * @param int $id
     * @return \classes\Etudiant|\classes\Administrateur
     * @throws UtilisateurException
     */
    public function getUtilisateurById($id){
        $sql = "SELECT id_user AS id, nom, prenom, email, mot_de_passe AS motdepasse, role, filiere, lien_linkedin, telephone_pro FROM UTILISATEURS WHERE id_user = :id";
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            if ($data['role'] === 'Admin') {
                return new \classes\Administrateur($data['id'], $data['nom'], $data['prenom'], $data['email'], $data['motdepasse'], $data['telephone_pro']);
            } else {
                return new \classes\Etudiant($data['id'], $data['nom'], $data['prenom'], $data['email'], $data['motdepasse'], $data['filiere'], $data['lien_linkedin']);
            }
        } else {
            throw new UtilisateurException("Utilisateur non trouvé.", 404);
        }
    }

    /**
     * Insérer un nouvel utilisateur (avec transaction)
     * @param \classes\Etudiant|\classes\Administrateur $user
     * @return bool
     */
    public function insererUtilisateur($user){
        try {
            $this->connexion->beginTransaction();

            $sql = "INSERT INTO UTILISATEURS (nom, prenom, email, mot_de_passe, role, filiere, lien_linkedin, telephone_pro) 
                    VALUES (:nom, :prenom, :email, :mdp, :role, :filiere, :linkedin, :tel)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':nom', $user->nom);
            $stmt->bindValue(':prenom', $user->prenom);
            $stmt->bindValue(':email', $user->email);
            // Hashage du mot de passe pour la sécurité
            $stmt->bindValue(':mdp', password_hash($user->motDePasse, PASSWORD_DEFAULT));
            $stmt->bindValue(':role', $user->role);
            $stmt->bindValue(':filiere', $user->filiere ?? '');
            $stmt->bindValue(':linkedin', $user->lienLinkedin ?? '');
            $stmt->bindValue(':tel', $user->telephonePro ?? '');
            $stmt->execute();

            $this->connexion->commit();
            return true;
        } catch (\Exception $e) {
            $this->connexion->rollBack();
            throw new UtilisateurException("Erreur : impossible d'ajouter cet utilisateur. L'adresse email est peut-être déjà utilisée.", 500);
        }
    }

    /**
     * Modifier un utilisateur (avec transaction)
     * @param \classes\Etudiant|\classes\Administrateur $user
     * @return bool
     */
    public function modifierUtilisateur($user){
        try {
            $this->connexion->beginTransaction();

            $sql = "UPDATE UTILISATEURS SET nom = :nom, prenom = :prenom, email = :email, role = :role, filiere = :filiere, lien_linkedin = :linkedin, telephone_pro = :tel WHERE id_user = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':nom', $user->nom);
            $stmt->bindValue(':prenom', $user->prenom);
            $stmt->bindValue(':email', $user->email);
            $stmt->bindValue(':role', $user->role);
            $stmt->bindValue(':filiere', $user->filiere ?? '');
            $stmt->bindValue(':linkedin', $user->lienLinkedin ?? '');
            $stmt->bindValue(':tel', $user->telephonePro ?? '');
            $stmt->bindValue(':id', $user->id);
            $stmt->execute();

            $this->connexion->commit();
            return true;
        } catch (\Exception $e) {
            $this->connexion->rollBack();
            throw new UtilisateurException("Erreur : impossible de modifier cet utilisateur. Vérifiez les informations saisies.", 500);
        }
    }

    /**
     * Supprimer un utilisateur
     * @param int $id
     * @return bool
     */
    public function supprimerUtilisateur($id){
        try {
            $this->connexion->beginTransaction();

            // Supprimer d'abord les projets liés (contrainte FK)
            $sql = "DELETE FROM PROJETS WHERE id_user = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            // Puis supprimer l'utilisateur
            $sql = "DELETE FROM UTILISATEURS WHERE id_user = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $this->connexion->commit();
            return true;
        } catch (\Exception $e) {
            $this->connexion->rollBack();
            throw new UtilisateurException("Erreur : impossible de supprimer cet utilisateur (il possède peut-être encore des projets liés).", 500);
        }
    }
}
?>