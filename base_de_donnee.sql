-- Création de la table Utilisateurs avec héritage logique (Admin/Client)
CREATE TABLE utilisateurs (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    login VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    role VARCHAR(20) -- 'admin' ou 'client'
);

-- Table pour la FAQ demandée dans le sujet
CREATE TABLE faq (
    id SERIAL PRIMARY KEY,
    question TEXT,
    reponse TEXT
); 