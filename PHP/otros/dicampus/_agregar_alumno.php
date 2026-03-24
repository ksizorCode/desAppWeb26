<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<?php
//VARIABLES DONE ALMACENAMOS LOS DATOS DE NUESTRA BASE DE DATOS
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "dicampus";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

    //RECOGEMOS LOS DATOS
    $nombre = $_GET['nombre'];
    $apellido = $_GET['apellido'];
    $imagen = $_GET['imagen'];

    //LA QUERY DE SQL
    $sql = "INSERT INTO `alumnos` (`nombre`, `apellido`, `img`)
            VALUES ('$nombre', '$apellido', '$imagen');";

    //Hacemos la consulta de SQL
    mysqli_query($conn, $sql);
    echo 'Datos insertados correctamente, para '.$nombre;
    //echo $sql;

    
    //cerramos la conexión
    mysqli_close($conn);
?>
<a href='index.php'>Volver a Inicio</a>
<a href='insertar.php'>Insertar nuevo alumno</a>
</body>
</html>