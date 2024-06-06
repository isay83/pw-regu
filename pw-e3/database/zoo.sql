CREATE DATABASE zoo;


CREATE TABLE Habitats ( 
    id INT PRIMARY KEY AUTO_INCREMENT, 
    nombre VARCHAR(255) 
);

CREATE TABLE Animales ( 
    id INT PRIMARY KEY AUTO_INCREMENT, 
    nombre VARCHAR(255), 
    especie VARCHAR(255), 
    habitat_id INT, 
    FOREIGN KEY (habitat_id) REFERENCES Habitats(id) 
);

CREATE TABLE Comidas ( 
    id INT PRIMARY KEY AUTO_INCREMENT, 
    animal_id INT, 
    fecha DATE, 
    hora TIME, 
    tipo VARCHAR(255), 
    FOREIGN KEY (animal_id) REFERENCES Animales(id) 
    );

-- Insertar hábitats
INSERT INTO Habitats (nombre) VALUES
('Jungla'),
('Sabana'),
('Acuario'),
('Bosque');

-- Insertar animales
INSERT INTO Animales (nombre, especie, habitat_id) VALUES
('León', 'Panthera leo', 2),
('Tigre', 'Panthera tigris', 2),
('Gorila', 'Gorilla gorilla', 1),
('Panda', 'Ailuropoda melanoleuca', 4);

-- Insertar comidas de ejemplo
INSERT INTO Comidas (animal_id, fecha, hora, tipo) VALUES
(1, '2024-04-30', '12:00:00', 'Carne'),
(1, '2024-04-30', '18:00:00', 'Carne'),
(2, '2024-04-30', '12:30:00', 'Carne'),
(2, '2024-04-30', '18:30:00', 'Carne'),
(3, '2024-04-30', '10:00:00', 'Frutas'),
(3, '2024-04-30', '16:00:00', 'Frutas'),
(4, '2024-04-30', '11:00:00', 'Bambú'),
(4, '2024-04-30', '17:00:00', 'Bambú');

