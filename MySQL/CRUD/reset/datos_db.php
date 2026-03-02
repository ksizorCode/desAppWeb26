<? require_once '../functions.php';
// Crear Conexión
$conn = new mysqli(SERV, USER, PASS, DBNM);
// Verificar Conexión
if ($conn->connect_error) {
  die("La conexión ha fallado: " . $conn->connect_error);
}

// Consulta SQL:
$sql = "INSERT INTO `alumnos` (`nombre`, `apellido`)
VALUES 
('Harry', 'Potter'),
('Hermione', 'Granger'),
('Ron', 'Weasley'),
('Draco', 'Malfoy'),
('Luna', 'Lovegood'),
('Neville', 'Longbottom'),
('Ginny', 'Weasley'),
('Cedric', 'Diggory'),
('Cho', 'Chang'),
('Vincent', 'Crabbe'),
('Gregory', 'Goyle'),
('Pansy', 'Parkinson'),
('Blaise', 'Zabini'),
('Seamus', 'Finnigan'),
('Dean', 'Thomas'),
('Lavender', 'Brown'),
('Parvati', 'Patil'),
('Padma', 'Patil'),
('Hannah', 'Abbott'),
('Justin', 'Finch-Fletchley'),
('Ernie', 'Macmillan'),
('Susan', 'Bones');";

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
