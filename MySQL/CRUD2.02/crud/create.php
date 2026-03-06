<?php
require_once '../functions.php';
me_header();

// Si se ha enviado el formulario
if ($_POST) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];

    // Preparamos el SQL (Cuidado: en producción usa sentencias preparadas)
    $sql = "INSERT INTO alumnos (nombre,apellido,email) VALUES ('$nombre','$apellido','$email')";
    
    if (consulta($sql)) {
        echo "✅ Alumno guardado correctamente.";
    }
}
?>

<form method="post">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="apellido" placeholder="apellido" required>
    <input type="email" name="email" placeholder="Email" required>
    <button type="submit">Guardar Alumno</button>
</form>

<? me_footer()?>