<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>festival de Cine</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<?php

//Conexión con base de datos
$host = "localhost"; $user = "root"; $pass = "root"; $data = "ficx";
$conn = mysqli_connect($host, $user, $pass, $data);
// Revisar la conexión
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());  }
// Desplegar datos: // Consulta SQL
$sql = "SELECT * FROM peliculas";
// Recoger resultados de la consulta en un array
$resultado_array = mysqli_query($conn, $sql);
    // recorremos bucle para mostrar datos
    if (mysqli_num_rows($resultado_array) > 0) {    
        echo "<ul class='flex'>";
            while($row = mysqli_fetch_assoc($resultado_array)) {
                echo "<li> <img src='img/{$row['imagen']}'>";
                echo "<h2>{$row['titulo']}</h2>";
                echo "<p>{$row['director']}</p></li>";
            }
        echo "</ul>";
      } else {
        echo "No hay pelícualas en la base de datos.";
      }





?>


    
</body>
</html>