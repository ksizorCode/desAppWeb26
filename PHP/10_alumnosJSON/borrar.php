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



