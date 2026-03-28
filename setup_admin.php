<?php
// On affiche les erreurs au cas où
ini_set('display_errors', 1);
error_reporting(E_ALL);

// On charge l'autoloader (vérifiez bien que le dossier s'appelle 'classes' avec un 's')
require_once 'admin/classes/Autoloader.php';
Autoloader::enregistrer();

use model\Database;

echo "<h1>Installation du compte Admin</h1>";

try {
    // On récupère la connexion à votre base de données
    $db = Database::getConnexion();

    // La requête SQL pour créer l'admin
    $sql = "INSERT INTO UTILISATEURS (nom, prenom, email, mot_de_passe, role) 
            VALUES ('Super', 'Admin', 'admin@test.fr', '1234', 'Admin')";

    // On exécute la requête
    $db->exec($sql);
    
    echo "<p style='color: green;'>✅ L'administrateur a bien été créé dans la base de données !</p>";
    echo "<p><strong>Email :</strong> admin@test.fr<br><strong>Mot de passe :</strong> 1234</p>";
    echo "<p style='color: red;'>⚠️ TRÈS IMPORTANT : Supprimez immédiatement ce fichier (setup_admin.php) de votre serveur pour des raisons de sécurité !</p>";

} catch (PDOException $e) {
    // Si l'utilisateur existe déjà ou s'il y a un problème, on affiche l'erreur
    echo "<p style='color: red;'>❌ Erreur SQL : " . $e->getMessage() . "</p>";
}
?>