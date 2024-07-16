-- Creation de la base de donnees
CREATE DATABASE garage_db;
USE garage_db;

-- Table pour les slots de garage
CREATE TABLE g_slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(1) NOT NULL UNIQUE
);

-- Insertion des slots
INSERT INTO g_slots (nom) VALUES 
('A'),
('B'),
('C');

-- Table pour les types de service
CREATE TABLE g_services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50) NOT NULL,
    duree TIME NOT NULL,
    prix INT NOT NULL
);

-- Insertion des types de service
INSERT INTO g_services (type, duree, prix) VALUES
('Reparation simple', '01:00:00', 150000),
('Reparation standard', '02:00:00', 250000),
('Reparation complexe', '08:00:00', 800000),
('Entretien', '02:30:00', 300000);

-- Table pour les types de voiture
CREATE TABLE g_typevoiture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

-- Insertion des types de voiture
INSERT INTO g_typevoiture (nom) VALUES
('legere'),
('4x4'),
('Utilitaire');

-- Table pour les clients
CREATE TABLE g_clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_voiture VARCHAR(20) UNIQUE NOT NULL,
    id_typeVoiture INT NOT NULL,
    FOREIGN KEY (id_typeVoiture) REFERENCES g_typevoiture(id)
);

-- Table pour les reservations
CREATE TABLE g_reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_slot INT NOT NULL,
    id_service INT NOT NULL,
    id_client INT NOT NULL,
    date_debut DATETIME NOT NULL,
    date_fin DATETIME NOT NULL,
    date_paiement DATETIME,
    FOREIGN KEY (id_slot) REFERENCES g_slots(id),
    FOREIGN KEY (id_service) REFERENCES g_services(id),
    FOREIGN KEY (id_client) REFERENCES g_clients(id),
    CHECK (date_paiement IS NULL OR date_paiement >= date_debut)
);
DELIMITER //
CREATE PROCEDURE ClientLogin(
    IN car_number VARCHAR(20),
    IN car_type_name VARCHAR(50)
)
BEGIN
    DECLARE client_id INT;
    DECLARE car_type_id INT;

    -- Obtenir l'ID du type de voiture
    SELECT id INTO car_type_id FROM g_typevoiture WHERE nom = car_type_name;

    -- Vérifier si le type de voiture existe
    IF car_type_id IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Type de voiture non trouve';
    END IF;

    -- Vérifier si le client existe déjà
    SELECT id INTO client_id
    FROM g_clients
    WHERE numero_voiture = car_number AND id_typeVoiture = car_type_id;

    -- Si le client n'existe pas, l'inscrire automatiquement
    IF client_id IS NULL THEN
        INSERT INTO g_clients (numero_voiture, id_typeVoiture) VALUES (car_number, car_type_id);
        SELECT LAST_INSERT_ID() INTO client_id;
    END IF;

    -- Retourner l'ID du client
    SELECT client_id AS id;
END //
DELIMITER ;


-- Table pour les administrateurs
CREATE TABLE g_admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pseudo VARCHAR(50) NOT NULL UNIQUE,
    mdp VARCHAR(255) NOT NULL
);

-- Insertion des administrateurs
INSERT INTO g_admins (pseudo, mdp) VALUES
('admin', sha1('admin'));

CREATE TABLE `configuration` (
    date_reference DATE
);

INSERT INTO `configuration` (date_reference) VALUES ('2024-01-01');