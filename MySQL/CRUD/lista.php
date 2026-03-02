<? require_once 'functions.php';




// Conexión
$conn = new mysqli(SERV, USER, PASS, DBNM);
// Check 
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Consulta:
$sql = "SELECT * FROM alumnos";
// Ejecutar Consulta
$result = $conn->query($sql);

?>








<? me_header();?>

<h1>Listado de la base de datos</h1>


<?php
// Process the result set
if ($result->num_rows > 0) {
    echo '<ul>';
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<li>id: " . $row["id"]. " - " . $row["nombre"]. " " . $row["apellido"]. "</li>";
        }
        echo '</ul>';
        }
else {
        echo "<p>No se han encontrado Alumnos</p>";
    }
            
$conn->close();



?>

<? me_footer();?>