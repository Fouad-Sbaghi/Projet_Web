-- Création de la table UTILISATEURS
CREATE TABLE UTILISATEURS (
    id_user SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL, 
    filiere VARCHAR(150), 
    lien_linkedin VARCHAR(255),
    telephone_pro VARCHAR(20)
);

-- Création de la table PROJETS
CREATE TABLE PROJETS (
    id_projet SERIAL PRIMARY KEY,
    id_user INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES UTILISATEURS(id_user)
);

-- Création de la table FAQ
CREATE TABLE FAQ (
    id_faq SERIAL PRIMARY KEY,
    question TEXT NOT NULL,
    reponse TEXT NOT NULL
);