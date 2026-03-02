<?php 
require_once 'functions.php'; 

// 1. Traemos todo con el asterisco
$alumnos = obtener_datos("SELECT * FROM alumnos");

me_header(); 
?>

<h1>Fichas Detalladas de Alumnos</h1>
<ul class="lista">


<?php
// 2. Llamamos a la nueva función
foreach($alumnos as $alumno):?>

<li>
    <a href="ficha.php?id=<?=$alumno['id']?>">   
        <? echo $alumno['id']?>
        <img src="assets/img/<? echo $alumno['foto']?>" alt="<?=$alumno['nombre'].' '.$alumno['apellido']?>"> 
    <?=$alumno['nombre'].' '.$alumno['apellido']?>
    </a>
</li>

<?endforeach;?>
</ul>

<?php me_footer(); ?>


