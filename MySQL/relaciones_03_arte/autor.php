<? require 'functions.php'?>
<? getheader();?>

<a href="index.php" class="btn">❮❮ Volver</a>

<?php
//Capturamos id del autor
$id_autor = $_GET["id"];
//Consulta para Obras en base al id del autor
$sql = "SELECT o.*
FROM obras o
JOIN obras_autores oa
    ON oa.obra_id = o.id
WHERE oa.autor_id ='$id_autor'";

//Almacenamos resultado en array obras
$obras = consulta($sql);

debug_print_r($obras, 'Array Obras por Creador');


// -----

//Consultamos datos del autor
$sql ="SELECT * FROM autores WHERE id='$id_autor'";

//Almacenamos resultado en array autor
$autor = consulta($sql);
$autor = $autor[0]; // devuelve array multidim; pasamos a array simple.
debug_print_r($autor, 'Array Obras por Autor');
?>

<div class="ficha-autor">
    <div class="datos">
        <h1><?=$autor['nombre']?></h1>
        <p>Nacionalidad: <?=$autor['nacionalidad']?></p>

        <p>Fecha nacimiento: <?=formatear_fecha($autor['fecha_nacimiento'])?></p>
        <p>Fecha defunción: <?=formatear_fecha($autor['fecha_muerte'])?></p>
    
        <p><?=$autor['descripcion']?></p>
    </div>
    <img src="<?=$autor['imagen']?>" alt="<?=$autor['nombre']?>">
</div>

<h2>Obras de<?=$autor['nombre']?>:</h2>


<ul class="galeria">
    <? foreach($obras as $obra):?>
        <li>
        <a href="info.php?id=<?=$obra['id']?>">
            <h3><?=$obra['titulo']?></h3>
            <img src="<?=$obra['imagen']?>"/>
            <p><?=$obra['descripcion']?></p>
        </a>
        </li>
<? endforeach;?>
</ul>



<?getfooter();?>