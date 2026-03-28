<?php
// On imagine que vous avez inclus vos fichiers ou votre Autoloader ici

use classes\Etudiant;
use model\Database;
use model\UtilisateursModel;

// 1. On crée notre objet Etudiant
$nouvelEtudiant = new Etudiant("Dupond", "Jean", "jean.dupond@email.fr", "monMotDePasseSecret", "Informatique", "linkedin.com/in/jeandupond");

// 2. On se connecte à la base de données
$database = new Database();
$db = $database->getConnexion();

// 3. On appelle notre Modèle et on lui donne la connexion
$utilisateursManager = new UtilisateursModel($db);

// 4. On demande au modèle d'insérer notre objet étudiant !
$utilisateursManager->inserer($nouvelEtudiant);


?>