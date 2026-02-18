
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
<?php

$json = file_get_contents('alumnos.json');
$alumnos = json_decode($json,true);

//Borramos sololo que hay dentro de el sub-array alumnos
$alumnos['alumnos'] = [];

$newJson=json_encode($alumnos);
file_put_contents('alumnos.json', $newJson);
?>

<h1>Se han borrado todos los alumnos</h1>
<a href="formulario.php">Volver a formulario</a>



</main>

<footer>
    <p>&copy; Copyright Alumnator</p>
</footer>



