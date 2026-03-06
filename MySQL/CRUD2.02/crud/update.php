<?php
require_once '../functions.php';
me_header();

// 1. Supongamos que recibimos un ID por la URL: editar.php?id=5
$id = $_GET['id'];

// 2. Obtenemos los datos actuales de ese usuario
$usuario = obtener_datos("SELECT * FROM alumnos WHERE id = $id");

if ($_POST) {
    $nuevo_nombre = $_POST['nombre'];
    $sql_update = "UPDATE alumnos SET nombre = '$nuevo_nombre' WHERE id = $id";
    
    if (consulta($sql_update)) {
        echo "✅ Alumno actualizado.";
    }
}
?>

<form method="post">
    <input type="text" name="nombre" value="<?php echo $usuario[0]['nombre']; ?>">
    <button type="submit">Actualizar</button>
</form>

<? me_footer()?>