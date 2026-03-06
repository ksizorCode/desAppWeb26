<?php
require_once '../functions.php';


me_header();

// Obtenemos todos los registros
$lista = obtener_datos("SELECT * FROM alumnos");

echo "<h2>Listado de Usuarios</h2>";
// Usamos tu función para pintarlos automáticamente
entablar($lista);
?>


<? me_footer()?>