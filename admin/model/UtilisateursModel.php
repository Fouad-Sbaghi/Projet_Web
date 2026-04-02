<?php
namespace model;

use model\UtilisateurException;
use model\Database;
use PDO;

class UtilisateursModel
{
    private $connexion;

    public function __construct() {
        $this->connexion = Database::getConnexion();
    }

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

    public function insererUtilisateur($user){
        try {
            $this->connexion->beginTransaction();

            $sql = "INSERT INTO UTILISATEURS (nom, prenom, email, mot_de_passe, role, filiere, lien_linkedin, telephone_pro) 
                    VALUES (:nom, :prenom, :email, :mdp, :role, :filiere, :linkedin, :tel)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':nom', $user->nom);
            $stmt->bindValue(':prenom', $user->prenom);
            $stmt->bindValue(':email', $user->email);

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

    public function supprimerUtilisateur($id){
        try {
            $this->connexion->beginTransaction();

            $sql = "DELETE FROM PROJETS WHERE id_user = :id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

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