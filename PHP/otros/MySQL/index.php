<?php
//CONEXIÓN A LA BASE DE DATOS
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "miguel";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, nombre, dorsal FROM jugadores"; //CONSULTA A LA BASE DE DATOS
$result = $conn->query($sql); //GUARDA LO QUE DEVUELVE LA CONSULTA

if ($result->num_rows > 0) {//Si el número de filas es mayor que 0...
    // Mostramos en formato tabla el contenido que le estamos pidiendo con la consulta a la BBDD
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Dorsal</th></tr>";

    while ($row = $result->fetch_assoc()) {//Mientras siga habiendo filas por mostrar...
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["dorsal"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} else {//Si no hay filas le decimos al usuario que ha encontrado 0 resultados
  echo "No se han encontrado resultados";
}
$conn->close(); //CERRAMOS LA CONEXIÓN A LA BASE DE DATOS
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HOLA MUNDO</h1>
</body>
</html>