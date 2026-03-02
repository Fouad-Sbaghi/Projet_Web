<?php
$liste_users = [
    ['id' => 1, 'nom' => 'Dupont', 'prenom' => 'Jean', 'role' => 'Etudiant'],
    ['id' => 2, 'nom' => 'Martin', 'prenom' => 'Alice', 'role' => 'Admin']
];

include "../view/header.php";
include "../view/sidebar.php";
include "../view/users.php";
include "../view/footer.php";
