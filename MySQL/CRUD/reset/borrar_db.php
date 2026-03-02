<? require_once '../functions.php';


// Crear Conexión
$conn = new mysqli(SERV, USER, PASS, DBNM);
// Verificar Conexión
if ($conn->connect_error) {
  die("La conexión ha fallado: " . $conn->connect_error);
}

// Elminar base de datos
$sql = "DROP DATABASE local";

if ($conn->query($sql) === TRUE) {
  echo "La base de datos se ha borrado satisfactoriamente";
} else {
  echo "Error al borrar la base de datos " . $conn->error;
}

$conn->close();



?>














<? me_header();?>

<h1>Base de Datos Borrada</h1>

<? me_footer();?>

