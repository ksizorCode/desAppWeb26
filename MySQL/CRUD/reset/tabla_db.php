<? require_once '../functions.php';
// Crear Conexión
$conn = new mysqli(SERV, USER, PASS, DBNM);
// Verificar Conexión
if ($conn->connect_error) {
  die("La conexión ha fallado: " . $conn->connect_error);
}

// Consulta SQL:
$sql = "CREATE TABLE `alumnos` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL
);";

if ($conn->query($sql) === TRUE) {
  echo "La tabla Alumnos ha sido creada satisfactoriamente";
} else {
  echo "Error al crear la base de datos " . $conn->error;
}

$conn->close();
?>



<? me_header();?>

<h1>Tabla Creada en base de datos</h1>

<? me_footer();?>
