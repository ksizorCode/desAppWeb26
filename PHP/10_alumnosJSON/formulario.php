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
<h1>Insertar nuevo alumno</h1>   
<form action="agregarAlumno.php" method="get">
        <label>Nombre</label>
        <input type="text" placeholder="insertar nombre" name="nombre">

        <br>
        <label>Año nacimiento</label>
        <input type="year" placeholder="insertar año" name="anio">
<br>
        <input type="submit" value="Guardar Nuevo Alumno">
    </form>

    
</main>

<footer>
    <p>&copy; Copyright Alumnator</p>
</footer>