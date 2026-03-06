<? require_once '../functions.php';
// Crear Conexión
$conn = new mysqli(SERV, USER, PASS, DBNM);
// Verificar Conexión
if ($conn->connect_error) {
  die("La conexión ha fallado: " . $conn->connect_error);
}

// Consulta SQL:
$sql = "INSERT INTO `alumnos` (
    `nombre`, `apellido`, `emoji`, `rol`, `foto`, `email`, `telefono`, `casa`, `direccion`, 
    `anio_nacimiento`, `ciudad`, `curso`, `actividades_extra`, `patronus`, `notas_interes`
) VALUES 
# --- ALUMNOS ---
('Harry', 'Potter', '⚡', 'Alumno', 'harry.jpg', 'h.potter@hogwarts.edu', '600000001', 'Gryffindor', 'Privet Drive 4', 1980, 'Little Whinging', 7, 'Quidditch, ED', 'Ciervo', 'El niño que vivió'),
('Hermione', 'Granger', '📚', 'Alumno', 'hermione.jpg', 'h.granger@hogwarts.edu', '600000002', 'Gryffindor', 'Londres', 1979, 'Londres', 7, 'Prefecta', 'Nutria', 'La más brillante'),
('Ron', 'Weasley', '🍗', 'Alumno', 'ron.jpg', 'r.weasley@hogwarts.edu', '600000003', 'Gryffindor', 'La Madriguera', 1980, 'Ottery St. Catchpole', 7, 'Quidditch', 'Jack Russell', 'Mejor amigo'),
('Draco', 'Malfoy', '🍏', 'Alumno', 'draco.jpg', 'd.malfoy@hogwarts.edu', '600000004', 'Slytherin', 'Mansión Malfoy', 1980, 'Wiltshire', 7, 'Inquisitorial Squad', 'Ninguno', 'Buscador'),
('Luna', 'Lovegood', '👓', 'Alumno', 'luna.jpg', 'l.lovegood@hogwarts.edu', '600000005', 'Ravenclaw', 'Casa Dirigible', 1981, 'Ottery St. Catchpole', 6, 'ED', 'Liebre', 'Soñadora'),
('Neville', 'Longbottom', '🌱', 'Alumno', 'neville.jpg', 'n.longbottom@hogwarts.edu', '600000006', 'Gryffindor', 'Londres', 1980, 'Londres', 7, 'Herbología', 'No corporal', 'Gran valor'),
('Ginny', 'Weasley', '🧹', 'Alumno', 'ginny.jpg', 'ginny.weasley@hogwarts.edu', '600000007', 'Gryffindor', 'La Madriguera', 1981, 'Ottery St. Catchpole', 6, 'Quidditch', 'Caballo', 'Buscadora'),
('Cedric', 'Diggory', '🏆', 'Alumno', 'cedric.jpg', 'c.diggory@hogwarts.edu', '600000008', 'Hufflepuff', 'Valle', 1977, 'Ottery St. Catchpole', 7, 'Torneo', 'Labrador', 'Prefecto'),
('Cho', 'Chang', '🦅', 'Alumno', 'cho.jpg', 'c.chang@hogwarts.edu', '600000009', 'Ravenclaw', 'Desconocida', 1979, 'Londres', 7, 'Quidditch', 'Cisne', 'Buscadora'),
('Vincent', 'Crabbe', '🔥', 'Alumno', 'crabbe.jpg', 'v.crabbe@hogwarts.edu', '600000010', 'Slytherin', 'Wiltshire', 1980, 'Wiltshire', 7, 'Inquisitorial', 'Ninguno', 'Amigo de Draco'),
('Gregory', 'Goyle', '👊', 'Alumno', 'goyle.jpg', 'g.goyle@hogwarts.edu', '600000011', 'Slytherin', 'Wiltshire', 1980, 'Wiltshire', 7, 'Inquisitorial', 'Ninguno', 'Poco hablador'),
('Pansy', 'Parkinson', '🍵', 'Alumno', 'pansy.jpg', 'p.parkinson@hogwarts.edu', '600000012', 'Slytherin', 'Londres', 1980, 'Londres', 7, 'Coro', 'Ninguno', 'Prefecta'),
('Blaise', 'Zabini', '🍷', 'Alumno', 'blaise.jpg', 'b.zabini@hogwarts.edu', '600000013', 'Slytherin', 'Villa', 1980, 'Milán', 7, 'Slug Club', 'Ninguno', 'Elegante'),
('Seamus', 'Finnigan', '💥', 'Alumno', 'seamus.jpg', 's.finnigan@hogwarts.edu', '600000014', 'Gryffindor', 'Kildare', 1980, 'Dublín', 7, 'Explosiones', 'Zorro', 'Medio mago'),
('Dean', 'Thomas', '⚽', 'Alumno', 'dean.jpg', 'd.thomas@hogwarts.edu', '600000015', 'Gryffindor', 'Londres', 1980, 'Londres', 7, 'Dibujo', 'No corporal', 'Fan fútbol'),
('Lavender', 'Brown', '🔮', 'Alumno', 'lavender.jpg', 'l.brown@hogwarts.edu', '600000016', 'Gryffindor', 'Brighton', 1980, 'Brighton', 7, 'Adivinación', 'Ardilla', 'Fan Trelawney'),
('Parvati', 'Patil', '🦋', 'Alumno', 'parvati.jpg', 'p.patil@hogwarts.edu', '600000017', 'Gryffindor', 'Londres', 1980, 'Londres', 7, 'ED', 'Mariposa', 'Gemela Gryff'),
('Padma', 'Patil', '🔷', 'Alumno', 'padma.jpg', 'pad.patil@hogwarts.edu', '600000018', 'Ravenclaw', 'Londres', 1980, 'Londres', 7, 'Prefecta', 'Mariposa', 'Gemela Raven'),
('Hannah', 'Abbott', '🍻', 'Alumno', 'hannah.jpg', 'h.abbott@hogwarts.edu', '600000019', 'Hufflepuff', 'Londres', 1980, 'Londres', 7, 'ED', 'Conejo', 'Futura tabernera'),
('Justin', 'Finch-Fletchley', '🐍', 'Alumno', 'justin.jpg', 'j.finch@hogwarts.edu', '600000020', 'Hufflepuff', 'Windsor', 1980, 'Windsor', 7, 'ED', 'No corporal', 'Muggleborn'),
('Ernie', 'Macmillan', '📜', 'Alumno', 'ernie.jpg', 'e.macmillan@hogwarts.edu', '600000021', 'Hufflepuff', 'Edimburgo', 1980, 'Edimburgo', 7, 'Prefecto', 'Jabalí', 'Pura sangre'),
('Susan', 'Bones', '⚖️', 'Alumno', 'susan.jpg', 's.bones@hogwarts.edu', '600000022', 'Hufflepuff', 'Reading', 1980, 'Reading', 7, 'ED', 'No corporal', 'Familia Min.'),
('Fred', 'Weasley', '🎆', 'Alumno', 'fred.jpg', 'f.weasley@hogwarts.edu', '600000023', 'Gryffindor', 'Madriguera', 1978, 'Ottery', 7, 'Bromas', 'Urraca', 'Gemelo 1'),
('George', 'Weasley', '👂', 'Alumno', 'george.jpg', 'george.weasley@hogwarts.edu', '600000024', 'Gryffindor', 'Madriguera', 1978, 'Ottery', 7, 'Bromas', 'Urraca', 'Gemelo 2'),
('Lee', 'Jordan', '🎙️', 'Alumno', 'lee.jpg', 'l.jordan@hogwarts.edu', '600000025', 'Gryffindor', 'Londres', 1978, 'Londres', 7, 'Locución', 'Lirón', 'Comentarista'),
('Katie', 'Bell', '🏐', 'Alumno', 'katie.jpg', 'k.bell@hogwarts.edu', '600000026', 'Gryffindor', 'Kent', 1979, 'Kent', 7, 'Quidditch', 'Gato', 'Cazadora'),
('Alicia', 'Spinnet', '🥅', 'Alumno', 'alicia.jpg', 'a.spinnet@hogwarts.edu', '600000027', 'Gryffindor', 'York', 1978, 'York', 7, 'Quidditch', 'Águila', 'Cazadora'),
('Angelina', 'Johnson', '🔥', 'Alumno', 'angelina.jpg', 'a.johnson@hogwarts.edu', '600000028', 'Gryffindor', 'Londres', 1977, 'Londres', 7, 'Quidditch', 'Fénix', 'Capitana'),
('Colin', 'Creevey', '📸', 'Alumno', 'colin.jpg', 'c.creevey@hogwarts.edu', '600000029', 'Gryffindor', 'Cerca', 1981, 'Pueblo', 6, 'Fotos', 'No corporal', 'Fan de Harry'),

# --- PROFESORES ---
('Albus', 'Dumbledore', '🧙‍♂️', 'Profesor', 'albus.jpg', 'a.dumbledore@hogwarts.edu', '001', 'Gryffindor', 'Castillo', 1881, 'Mould-on-the-Wold', NULL, 'Director', 'Fénix', 'Gran Mago'),
('Minerva', 'McGonagall', '🐈', 'Profesor', 'minerva.jpg', 'm.mcgonagall@hogwarts.edu', '002', 'Gryffindor', 'Castillo', 1935, 'Caithness', NULL, 'Transfiguración', 'Gato', 'Animaga'),
('Severus', 'Snape', '🧪', 'Profesor', 'severus.jpg', 's.snape@hogwarts.edu', '003', 'Slytherin', 'Castillo', 1960, 'Cokeworth', NULL, 'Pociones', 'Cierva', 'Misterioso'),
('Filius', 'Flitwick', '🎶', 'Profesor', 'filius.jpg', 'f.flitwick@hogwarts.edu', '004', 'Ravenclaw', 'Castillo', 1958, 'Desconocida', NULL, 'Encantamientos', 'No corporal', 'Ex-campeón duelo'),
('Pomona', 'Sprout', '🍄', 'Profesor', 'pomona.jpg', 'p.sprout@hogwarts.edu', '005', 'Hufflepuff', 'Castillo', 1941, 'Desconocida', NULL, 'Herbología', 'No corporal', 'Jefa Hufflepuff'),
('Sybill', 'Trelawney', '🔮', 'Profesor', 'sybill.jpg', 's.trelawney@hogwarts.edu', '006', 'Ravenclaw', 'Torre', 1962, 'Desconocida', NULL, 'Adivinación', 'No corporal', 'Vidente'),
('Rubeus', 'Hagrid', '🐕', 'Profesor', 'hagrid.jpg', 'r.hagrid@hogwarts.edu', '007', 'Gryffindor', 'Cabaña', 1928, 'West Country', NULL, 'Criaturas', 'Ninguno', 'Semi-gigante'),
('Gilderoy', 'Lockhart', '🦷', 'Profesor', 'gilderoy.jpg', 'g.lockhart@hogwarts.edu', '008', 'Ravenclaw', 'Mundo', 1964, 'Desconocida', NULL, 'DCAO', 'No corporal', 'Farsante'),
('Remus', 'Lupin', '🐺', 'Profesor', 'remus.jpg', 'r.lupin@hogwarts.edu', '009', 'Gryffindor', 'Mundo', 1960, 'Desconocida', NULL, 'DCAO', 'Lobo', 'Hombre lobo'),
('Alastor', 'Moody', '👁️', 'Profesor', 'moody.jpg', 'a.moody@hogwarts.edu', '010', 'Desconocida', 'Mundo', 1950, 'Escocia', NULL, 'DCAO', 'Ninguno', 'Auror'),

# --- STAFF / OTROS ---
('Argus', 'Filch', '🗝️', 'Staff', 'filch.jpg', 'a.filch@hogwarts.edu', '900', 'Ninguna', 'Castillo', 1940, 'Desconocida', NULL, 'Limpieza', 'Ninguno', 'Squib'),
('Madam', 'Pince', '📖', 'Staff', 'pince.jpg', 'm.pince@hogwarts.edu', '901', 'Ninguna', 'Biblioteca', 1950, 'Desconocida', NULL, 'Biblioteca', 'Ninguno', 'Estricta'),
('Madam', 'Pomfrey', '🏥', 'Staff', 'pomfrey.jpg', 'p.pomfrey@hogwarts.edu', '902', 'Ninguna', 'Enfermería', 1945, 'Desconocida', NULL, 'Sanación', 'Ninguno', 'Enfermera jefa'),

# --- FANTASMAS ---
('Nick', 'Casi Decapitado', '👻', 'Fantasma', 'nick.jpg', 'nick@hogwarts.edu', '000', 'Gryffindor', 'Castillo', 1450, 'Londres', NULL, 'Asustar', 'Ninguno', 'Casi decapitado'),
('Dama', 'Gris', '👸', 'Fantasma', 'damagris.jpg', 'damagris@hogwarts.edu', '000', 'Ravenclaw', 'Torre', 1000, 'Albania', NULL, 'Flotar', 'Ninguno', 'Helena Ravenclaw'),
('Barón', 'Sanguinario', '⛓️', 'Fantasma', 'baron.jpg', 'baron@hogwarts.edu', '000', 'Slytherin', 'Mazmorras', 1000, 'Albania', NULL, 'Flotar', 'Ninguno', 'Cadadenas'),
('Fraile', 'Gordo', '🥪', 'Fantasma', 'fraile.jpg', 'fraile@hogwarts.edu', '000', 'Hufflepuff', 'Sótanos', 1100, 'Desconocida', NULL, 'Flotar', 'Ninguno', 'Muy alegre');";

if ($conn->query($sql) === TRUE) {
  echo "Datos insertados en la tabla alumnos satisfactoriamente";
} else {
  echo "Error al insertar datos " . $conn->error;
}

$conn->close();
?>



<? me_header();?>

<h1>Datos insertados en tabla Alumnos Correctamente</h1>

<? me_footer();?>
