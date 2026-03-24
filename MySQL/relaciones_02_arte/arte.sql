-- =========================================
-- 🔄 RESET TOTAL + CREACIÓN + DATOS
-- =========================================

-- Borrar y crear BD
DROP DATABASE IF EXISTS arte;
CREATE DATABASE arte;
USE arte;

-- =========================================
-- 👤 TABLA CREADORES
-- =========================================
CREATE TABLE creadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    nacionalidad VARCHAR(100),
    fecha_nacimiento DATE,
    fecha_muerte DATE,
    imagen VARCHAR(255)
);

-- =========================================
-- 🎭 TABLA DISCIPLINAS
-- =========================================
CREATE TABLE disciplinas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    imagen VARCHAR(255)
);

-- =========================================
-- 🖼️ TABLA OBRAS
-- =========================================
CREATE TABLE obras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    año INT,
    descripcion TEXT,
    imagen VARCHAR(255)
);

-- =========================================
-- 🔗 RELACIONES
-- =========================================
CREATE TABLE obras_creadores (
    obra_id INT,
    creador_id INT,
    PRIMARY KEY (obra_id, creador_id),
    FOREIGN KEY (obra_id) REFERENCES obras(id) ON DELETE CASCADE,
    FOREIGN KEY (creador_id) REFERENCES creadores(id) ON DELETE CASCADE
);

CREATE TABLE obras_disciplinas (
    obra_id INT,
    disciplina_id INT,
    PRIMARY KEY (obra_id, disciplina_id),
    FOREIGN KEY (obra_id) REFERENCES obras(id) ON DELETE CASCADE,
    FOREIGN KEY (disciplina_id) REFERENCES disciplinas(id) ON DELETE CASCADE
);

-- =========================================
-- INSERTS
-- =========================================
INSERT INTO disciplinas (nombre, imagen) VALUES
('Pintura', 'img/disciplinas/pintura.jpg'),
('Escultura', 'img/disciplinas/escultura.jpg'),
('Arquitectura', 'img/disciplinas/arquitectura.jpg'),
('Música', 'img/disciplinas/musica.jpg'),
('Cine', 'img/disciplinas/cine.jpg'),
('Fotografía', 'img/disciplinas/fotografia.jpg'),
('Literatura', 'img/disciplinas/literatura.jpg');

INSERT INTO creadores (nombre, nacionalidad, fecha_nacimiento, fecha_muerte, imagen) VALUES
('Leonardo da Vinci', 'Italia', '1452-04-15', '1519-05-02', 'img/creadores/leonardo.jpg'),
('Pablo Picasso', 'España', '1881-10-25', '1973-04-08', 'img/creadores/picasso.jpg'),
('Stanley Kubrick', 'EEUU', '1928-07-26', '1999-03-07', 'img/creadores/kubrick.jpg'),
('Ludwig van Beethoven', 'Alemania', '1770-12-17', '1827-03-26', 'img/creadores/beethoven.jpg'),
('Antoni Gaudí', 'España', '1852-06-25', '1926-06-10', 'img/creadores/gaudi.jpg'),
('Salvador Dalí', 'España', '1904-05-11', '1989-01-23', 'img/creadores/dali.jpg'),
('David Lynch', 'EEUU', '1946-01-20', NULL, 'img/creadores/lynch.jpg'),
('Banksy', 'Reino Unido', NULL, NULL, 'img/creadores/banksy.jpg');

INSERT INTO obras (titulo, año, descripcion, imagen) VALUES
('La Mona Lisa', 1503, 'Retrato renacentista icónico', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Leonardo_da_Vinci_-_Mona_Lisa_%28Louvre%2C_Paris%29.jpg/500px-Leonardo_da_Vinci_-_Mona_Lisa_%28Louvre%2C_Paris%29.jpg'),
('La última cena', 1498, 'Fresco religioso', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/48/The_Last_Supper_-_Leonardo_Da_Vinci_-_High_Resolution_32x16.jpg/1280px-The_Last_Supper_-_Leonardo_Da_Vinci_-_High_Resolution_32x16.jpg'),
('Guernica', 1937, 'Pintura sobre la guerra civil española', 'https://upload.wikimedia.org/wikipedia/commons/6/6f/Mural_del_Gernika.jpg'),
('El perro andaluz', 1929, 'Cortometraje surrealista', 'img/obras/perro_andaluz.jpg'),
('2001: Una odisea del espacio', 1968, 'Película de ciencia ficción', 'img/obras/2001.jpg'),
('Sinfonía nº 9', 1824, 'Obra musical clásica', 'img/obras/sinfonia9.jpg'),
('La Sagrada Familia', 1882, 'Basílica en Barcelona', 'img/obras/sagrada_familia.jpg'),
('El gran masturbador', 1929, 'Pintura surrealista', 'img/obras/gran_masturbador.jpg'),
('Mulholland Drive', 2001, 'Película de misterio', 'img/obras/mulholland.jpg'),
('Girl with Balloon', 2002, 'Arte urbano', 'img/obras/banksy_balloon.jpg');

INSERT INTO obras_creadores VALUES
(1,1),(2,1),(3,2),(4,6),(5,3),
(6,4),(7,5),(8,6),(9,7),(10,8);

INSERT INTO obras_disciplinas VALUES
(1,1),(2,1),(3,1),(4,5),(5,5),
(6,4),(7,3),(8,1),(9,5),(10,6);