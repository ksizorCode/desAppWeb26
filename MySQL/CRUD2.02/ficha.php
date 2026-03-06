<?php 
require_once 'functions.php'; 

$id =$_GET['id'];


// 1. Traemos todo con el asterisco
$alumnos = obtener_datos("SELECT * FROM alumnos WHERE id=$id");

me_header(); 
?>

<h1>Fichas Detalladas de Alumno</h1>

<?php

foreach($alumnos as $a):?>

    <img src="img/<?=$a['foto']?>" alt="<?=$a['nombre'].' '.$a['apellido']?>">

<? endforeach;

// 2. Llamamos a la nueva función
detallar_lista($alumnos);


?>

<?php me_footer(); ?>


