<?php
require_once '../functions.php';


 me_header();

// Borrar.php?id=5
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM alumnos WHERE id = $id";
    
    if (consulta($sql)) {
        echo "🗑️ Registro eliminado con éxito.";
    }
}
?>
<a href="index.php">Volver al listado</a>


<? me_footer()?>