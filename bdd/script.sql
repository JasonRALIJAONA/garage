-- Création de la base de données
CREATE DATABASE garage_db;
USE garage_db;

-- Table pour les slots de garage
CREATE TABLE Slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(1) NOT NULL UNIQUE
);

-- Insertion des slots
INSERT INTO Slots (nom) VALUES 
('A'),
('B'),
('C');

-- Table pour les types de service
CREATE TABLE Services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type VARCHAR(50) NOT NULL,
    duree TIME NOT NULL,
    prix INT NOT NULL
);

-- Insertion des types de service
INSERT INTO Services (type, duree, prix) VALUES
('Réparation simple', '01:00:00', 150000),
('Réparation standard', '02:00:00', 250000),
('Réparation complexe', '08:00:00', 800000),
('Entretien', '02:30:00', 300000);

-- Table pour les types de voiture
CREATE TABLE TypeVoiture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

-- Insertion des types de voiture
INSERT INTO TypeVoiture (nom) VALUES
('légère'),
('4x4'),
('Utilitaire');

-- Table pour les clients
CREATE TABLE Clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero_voiture VARCHAR(20) UNIQUE NOT NULL,
    id_typeVoiture INT NOT NULL,
    FOREIGN KEY (id_typeVoiture) REFERENCES TypeVoiture(id)
);

-- Table pour les réservations
CREATE TABLE Reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_slot INT NOT NULL,
    id_service INT NOT NULL,
    id_client INT NOT NULL,
    start_time DATETIME NOT NULL,
    end_time DATETIME NOT NULL,
    FOREIGN KEY (id_slot) REFERENCES Slots(id),
    FOREIGN KEY (id_service) REFERENCES Services(id),
    FOREIGN KEY (id_client) REFERENCES Clients(id)
);

-- Vérification des créneaux disponibles et prise de rendez-vous
DELIMITER //
CREATE PROCEDURE PrendreRendezVous(
    IN client_id INT,
    IN service_id INT,
    IN start_time DATETIME
)
BEGIN
    DECLARE duration TIME;
    DECLARE end_time DATETIME;
    DECLARE available_slot_id INT;

    -- Obtenir la durée du service
    SELECT duree INTO duration FROM Services WHERE id = service_id;
    SET end_time = DATE_ADD(start_time, INTERVAL TIME_TO_SEC(duration) SECOND);

    -- Trouver un slot disponible
    SELECT id INTO available_slot_id
    FROM Slots
    WHERE id NOT IN (
        SELECT id_slot
        FROM Reservations
        WHERE (start_time < end_time AND end_time > start_time)
    )
    LIMIT 1;

    -- Si aucun slot n'est disponible, renvoyer une erreur
    IF available_slot_id IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Aucun créneau disponible pour ce créneau horaire';
    ELSE
        -- Insérer la réservation
        INSERT INTO Reservations (id_slot, id_service, id_client, start_time, end_time)
        VALUES (available_slot_id, service_id, client_id, start_time, end_time);
    END IF;
END //
DELIMITER ;

-- Procédure pour le login/inscription client
DELIMITER //
CREATE PROCEDURE ClientLogin(
    IN car_number VARCHAR(20),
    IN car_type_name VARCHAR(50)
)
BEGIN
    DECLARE client_id INT;
    DECLARE car_type_id INT;
    
    -- Obtenir l'ID du type de voiture
    SELECT id INTO car_type_id FROM TypeVoiture WHERE nom = car_type_name;
    
    -- Vérifier si le client existe déjà
    SELECT id INTO client_id
    FROM Clients
    WHERE numero_voiture = car_number AND id_typeVoiture = car_type_id;
    
    -- Si le client n'existe pas, l'inscrire automatiquement
    IF client_id IS NULL THEN
        INSERT INTO Clients (numero_voiture, id_typeVoiture) VALUES (car_number, car_type_id);
        SELECT LAST_INSERT_ID() INTO client_id;
    END IF;
    
    -- Retourner l'ID du client
    SELECT client_id AS id;
END //
DELIMITER ;


-- Table pour les administrateurs
CREATE TABLE Admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);