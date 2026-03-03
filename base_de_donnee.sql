-- Création de la table UTILISATEURS

--DROP TABLE IF EXISTS PROJETS;
--DROP TABLE IF EXISTS FAQ;
--DROP TABLE IF EXISTS UTILISATEURS;

CREATE TABLE UTILISATEURS (
    id_user SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(100) NOT NULL,
    role VARCHAR(100) NOT NULL, 
    filiere VARCHAR(100), 
    lien_linkedin VARCHAR(100),
    telephone_pro VARCHAR(13)
);

-- Création de la table PROJETS
CREATE TABLE PROJETS (
    id_projet SERIAL PRIMARY KEY,
    id_user INT NOT NULL,
    titre VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(100),
    FOREIGN KEY (id_user) REFERENCES UTILISATEURS(id_user)
);

-- Création de la table FAQ
CREATE TABLE FAQ (
    id_faq SERIAL PRIMARY KEY,
    question TEXT NOT NULL,
    reponse TEXT NOT NULL
);

