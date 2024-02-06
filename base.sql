
CREATE DATABASE IF NOT EXISTS base;
use base;
-- Créer la table fiches_de_frais
CREATE TABLE fiches_de_frais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    etape INT,
    kilometres INT,
    nuitees INT,
    repas INT,
    date DATE,
    libelle VARCHAR(255),
    montant DECIMAL(10, 2),
    mois VARCHAR(10) -- Ajouter le champ pour représenter le mois
);
-- Insérer des données dans la table fiches_de_frais
INSERT INTO fiches_de_frais (etape, kilometres, nuitees, repas, date, libelle, montant, mois) VALUES
(0, 750, 9, 12, '2024-01-18', 'Repas représentation', 156.00, '2024-01'),
(0, 0, 0, 0, '2024-01-22', 'Achat fleuriste soirée « Medilog »', 120.30, '2024-01');
CREATE TABLE comptes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    profil VARCHAR(50) NOT NULL
);
-- Insérer les comptes visiteur et comptable
INSERT INTO comptes (username, password, profil) VALUES ('visiteur', '1234', 'Visiteur');
INSERT INTO comptes (username, password, profil) VALUES ('comptable', '1234', 'Comptable');
