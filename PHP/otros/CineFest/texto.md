
-- crear tabla:

CREATE TABLE peliculas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    imagen VARCHAR(255) NULL,
    director VARCHAR(255) NULL,
    descripcion VARCHAR(255) NOT NULL
);


INSERT INTO peliculas (titulo, imagen, director, descripcion) VALUES
('La isla de las mentiras', 'isla_mentiras.jpg', 'Paula Cons', 'Drama basado en hechos reales.'),
('Blanco en blanco', 'blanco_en_blanco.jpg', 'Théo Court', 'Un fotógrafo en la Tierra del Fuego.'),
('Nieva en Benidorm', 'nieva_benidorm.jpg', 'Isabel Coixet', 'Un thriller ambientado en la costa.'),
('My Mexican Bretzel', 'mexican_bretzel.jpg', 'Nuria Giménez', 'Documental poético basado en diarios personales.'),
('El año del descubrimiento', 'ano_descubrimiento.jpg', 'Luis López Carrasco', 'Crónica de la España de los 90.'),
('Karen', 'karen.jpg', 'María Pérez Sanz', 'Historia de Karen Blixen en África.'),
('Ane', 'ane.jpg', 'David Pérez Sañudo', 'Una madre busca respuestas sobre su hija.'),
('Las niñas', 'las_ninas.jpg', 'Pilar Palomero', 'Un retrato de la educación en los 90.'),
('Los lobos', 'los_lobos.jpg', 'Samuel Kishi Leopo', 'Dos niños migrantes en EE.UU.'),
('La vida era eso', 'vida_era_eso.jpg', 'David Martín de los Santos', 'Encuentro de dos mujeres en un hospital.'),
('Armugán', 'armugan.jpg', 'Jo Sol', 'Un hombre con un don misterioso.'),
('La última primavera', 'ultima_primavera.jpg', 'Isabel Lamberti', 'Una familia enfrenta el desalojo.'),
('Un efecto óptico', 'efecto_optico.jpg', 'Juan Cavestany', 'Un matrimonio en Nueva York.'),
('Lúa vermella', 'lua_vermella.jpg', 'Lois Patiño', 'Misterios en la costa gallega.'),
('Baby', 'baby.jpg', 'Juanma Bajo Ulloa', 'Un thriller sin diálogos.');