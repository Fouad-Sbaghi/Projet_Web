<?php
/*
$liste_users = [
    ['id' => 1, 'nom' => 'Gilles', 'prenom' => 'Bob', 'role' => 'Etudiant'],
    ['id' => 2, 'nom' => 'Zhou', 'prenom' => 'Alice', 'role' => 'Admin']
];
*/

require_once '../classes/Autoloader.php';
Autoloader::enregistrer();

use model\UtilisateursModel;

$model_user = new UtilisateursModel();
$liste_users = $model_user->getAllUtilisateurs();

include "../view/header.php";
include "../view/sidebar.php";
include "../view/users.php";
include "../view/footer.php";
