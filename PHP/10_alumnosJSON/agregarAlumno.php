<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<header>
    <nav>
        <ul>
            <li><a href="formulario.php">Formulario para agregar Alumno</a></li>
<li><a href="borrar.php">Borrar todos los alumnos (resetear JSON)</a></li>
<li><a href="index.php">Ver Listado completo</a></li>
        </ul>
    </nav>

</header>

<main>

<h1>Alumno agregado</h1>

<?php
//capturamos valores de la URL (por GET)
$nombre =$_GET['nombre'];
$anio =$_GET['anio'];

//revisamos si esos valores han sido capturados correctamente
echo $nombre;
echo $anio;


// cargamos 📃 JSON
$json = file_get_contents('alumnos.json');
// decodificamos 📃JSON a 🧨Array PHP
$alumnos = json_decode($json,true);
// revisamos si se ha cargado bien el JSON mostrando el 🧨Array PHP con print_r
print_r($alumnos);
// añadimos nuevo alumno al 🧨Array a partir de los datos capturados por GET
array_push($alumnos['alumnos'],['nombre'=>$nombre,'anio'=>$anio]);
// revisamos que el alumno haya sido añadido al 🧨Array con print_r
print_r($alumnos);
// codificamos el 🧨Array a JSON
$newJson = json_encode($alumnos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
// guardamos el 📃 JSON
file_put_contents('alumnos.json',$newJson);

echo "<h2>El alumno $nombre ha sido añadido correctamente</h2>";
echo "<a href='formulario.php'>Añadir otro alumno</a>";
echo "<a href='borrar.php'>Boorar todos los alumnos</a>";






?>


</main>

<footer>
    <p>&copy; Copyright Alumnator</p>
</footer>