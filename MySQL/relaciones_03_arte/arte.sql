-- =========================================
-- 🔄 RESET TOTAL + CREACIÓN + DATOS
-- =========================================

-- Borrar y crear BD
DROP DATABASE IF EXISTS arte;
CREATE DATABASE arte;
USE arte;

-- =========================================
-- 👤 TABLA AUTORES
-- =========================================
CREATE TABLE autores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    nacionalidad VARCHAR(100),
    fecha_nacimiento DATE,
    fecha_muerte DATE,
    descripcion TEXT,
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
CREATE TABLE obras_autores (
    obra_id INT,
    autor_id INT,
    PRIMARY KEY (obra_id, autor_id),
    FOREIGN KEY (obra_id) REFERENCES obras(id) ON DELETE CASCADE,
    FOREIGN KEY (autor_id) REFERENCES autores(id) ON DELETE CASCADE
);

CREATE TABLE obras_disciplinas (
    obra_id INT,
    disciplina_id INT,
    PRIMARY KEY (obra_id, disciplina_id),
    FOREIGN KEY (obra_id) REFERENCES obras(id) ON DELETE CASCADE,
    FOREIGN KEY (disciplina_id) REFERENCES disciplinas(id) ON DELETE CASCADE
);

-- =========================================
-- INSERTS DISCIPLINAS
-- =========================================
INSERT INTO disciplinas (nombre, imagen) VALUES
('Pintura', 'img/disciplinas/pintura.jpg'),
('Escultura', 'img/disciplinas/escultura.jpg'),
('Arquitectura', 'img/disciplinas/arquitectura.jpg'),
('Música', 'img/disciplinas/musica.jpg'),
('Cine', 'img/disciplinas/cine.jpg'),
('Fotografía', 'img/disciplinas/fotografia.jpg'),
('Literatura', 'img/disciplinas/literatura.jpg');

-- =========================================
-- INSERTS AUTORES
-- =========================================
INSERT INTO autores (nombre, nacionalidad, fecha_nacimiento, fecha_muerte, descripcion, imagen) VALUES
('Leonardo da Vinci', 'Italia', '1452-04-15', '1519-05-02', 'Polímata del Renacimiento: pintor, inventor, científico y anatomista.', 'https://static.wixstatic.com/media/21c73d_7000e53f95994fdf8548d974b43ca4e9~mv2.jpg/v1/fill/w_740,h_880,al_c,q_85,usm_0.66_1.00_0.01,enc_avif,quality_auto/21c73d_7000e53f95994fdf8548d974b43ca4e9~mv2.jpg'),
('Pablo Picasso', 'España', '1881-10-25', '1973-04-08', 'Pintor y escultor español, uno de los artistas más influyentes del siglo XX.', 'img/creadores/picasso.jpg'),
('Stanley Kubrick', 'EEUU', '1928-07-26', '1999-03-07', 'Director de cine estadounidense, conocido por su estilo visual y narrativo único.', 'img/creadores/kubrick.jpg'),
('Ludwig van Beethoven', 'Alemania', '1770-12-17', '1827-03-26', 'Compositor y pianista alemán, figura central de la música clásica.', 'img/creadores/beethoven.jpg'),
('Antoni Gaudí', 'España', '1852-06-25', '1926-06-10', 'Arquitecto catalán, máximo exponente del modernismo.', 'img/creadores/gaudi.jpg'),
('Salvador Dalí', 'España', '1904-05-11', '1989-01-23', 'Pintor surrealista español, famoso por su imaginación y excentricidad.', 'img/creadores/dali.jpg'),
('David Lynch', 'EEUU', '1946-01-20', NULL, 'Director de cine y televisión, conocido por su estilo surrealista y misterioso.', 'img/creadores/lynch.jpg'),
('Banksy', 'Reino Unido', NULL, NULL, 'Artista urbano y activista político, cuya identidad real se desconoce.', 'img/creadores/banksy.jpg'),
('Auguste Rodin', 'Francia', '1840-11-12', '1917-11-17', 'Escultor francés considerado el padre de la escultura moderna.', 'img/creadores/rodin.jpg');

-- =========================================
-- INSERTS OBRAS
-- =========================================
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
('Girl with Balloon', 2002, 'Arte urbano', 'img/obras/banksy_balloon.jpg'),
('El pensante', 1902, 'Escultura de Auguste Rodin, representando un hombre en profunda reflexión', 'img/obras/pensante.jpg');

-- =========================================
-- RELACIONES OBRAS-AUTORES
-- =========================================
INSERT INTO obras_autores VALUES
(1,1),(2,1),(3,2),(4,6),(5,3),
(6,4),(7,5),(8,6),(9,7),(10,8),
(11,9);

-- =========================================
-- RELACIONES OBRAS-DISCIPLINAS
-- =========================================
INSERT INTO obras_disciplinas VALUES
(1,1),(2,1),(3,1),(4,5),(5,5),
(6,4),(7,3),(8,1),(9,5),(10,6),
(11,2);