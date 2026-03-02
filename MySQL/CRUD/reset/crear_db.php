<?php
require_once '../functions.php';

// 1. Crear Conexión inicial al servidor
$conn = new mysqli(SERV, USER, PASS);

// Verificar Conexión
if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

// 2. Crear base de datos (con IF NOT EXISTS para evitar errores)
$sql ="CREATE DATABASE IF NOT EXISTS local CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci";



if ($conn->query($sql) === TRUE) {
    $mensaje = "La base de datos se ha creado o ya existe satisfactoriamente.";
    
    // OPCIONAL: Seleccionar la base de datos para usarla de inmediato
    $conn->select_db("local");
} else {
    $mensaje = "Error al crear la base de datos: " . $conn->error;
}


?>

<?php me_header(); ?>

<div class="container">
    <h1>Estado del Sistema</h1>
    <p><?php echo $mensaje; ?></p>
    
    <?php if ($conn->query($sql) === TRUE): ?>
        <div class="alert alert-success">Base de datos "local" lista para usar.</div>
    <?php endif; ?>
</div>

<?php
$conn->close();?>

<?php me_footer(); ?>