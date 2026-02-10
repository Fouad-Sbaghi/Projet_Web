# Projet_Web
Pourquoi tu me read ?

page de connexion simple pour user et admin, sans verif les mdp ou autre
Juste créer la base de donnés mais rien a mettre dedans
Admin - Client en programmation objet avec au moins 1 héritage
nom, prenom, login, password
Faire un schéma de classe aussi (table)
tout en mcv
page contact en php
faq a faire



Je veux faire un Portfolio car c'est important d'en avoir un pour les futurs emplois, projets. Au final nous ferons un site qui fait des Portfolio à des utilisateurs pour rester dans le Projet. La cible sera les étudiants ou personnes en recherche d'emploi. 

Tout d'abord avant de commencer le projet, moi et Fouad avons préparé l'environnement pour bien faire le projet. Premièrement on commence par une connexion ssh sur Vscode. Puis on installe un projet github en commun et on installe git pour syncrhoniser nos 2 projets.  

#Côté Front Office (La Vitrine)

Page de présentation : Un "À propos" dynamique qui présente votre parcours.

Affichage des projets : Une page listant vos réalisations (récupérées en base de données).

Page de détail : Si je clique sur un projet, j'arrive sur une page dédiée (projet.php?id=3) avec une description longue.

Formulaire de contact : Permet à un visiteur de vous envoyer un mail directement.

Espace Utilisateur : Un visiteur peut se créer un compte pour, par exemple, laisser des commentaires ou enregistrer ses projets favoris. Il peut modifier ses infos ou supprimer son compte.

#Côté Back Office (L'Administration)

Tableau de bord : Vue d'ensemble (nombre de projets, derniers messages reçus).

Gestion du Portfolio : Une interface pour Ajouter un nouveau projet, Modifier une image ou Supprimer une ancienne réalisation.

Gestion des Utilisateurs : C'est ici que vous répondez à votre question : "Comment ajouter un utilisateur ?". L'administrateur a une page dédiée pour créer manuellement un compte (par exemple pour un collaborateur) ou bannir un utilisateur.

Gestion de la FAQ : Une interface pour rédiger les questions/réponses fréquentes qui s'afficheront sur le Front.

Système d'envoi de mail : Un outil pour envoyer un message groupé à tous les utilisateurs inscrits.

Base de données PostgreSQL :
(Apache)

Structure du Projet

view 
    - css
    - images
model
control
admin
    - view
    - model
    - control

Utilisation de VScode, PHP, css, PostgreSQL, Html, Apache
