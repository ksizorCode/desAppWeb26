<? require 'functions.php'?>
<? getheader();?>

<a href="index.php" class="btn">❮❮ Volver</a>

<?php
$id = $_GET["id"];
$sql = "SELECT 
    o.id,
    o.titulo,
    o.imagen,
    o.año,
    o.descripcion,
    a.nombre AS 'autor',
    a.id AS id_autor,
    d.nombre AS 'disciplina',
    d.id AS id_disciplina
FROM obras o

-- Relación con autores
JOIN obras_autores oa 
    ON oa.obra_id = o.id
JOIN autores a 
    ON oa.autor_id = a.id

-- Relación con disciplinas
JOIN obras_disciplinas od 
    ON od.obra_id = o.id
JOIN disciplinas d 
    ON od.disciplina_id = d.id

WHERE o.id='$id'";

    $obra = consulta($sql);

    debug_print_r($obra, 'no indentado');
    
    $obra=$obra[0]; // abrir primera identación
    
    debug_print_r($obra,'tras abrir indentación');
?>

<div class="ficha">
    <img src="<?=$obra['imagen']?>"/>
    <div>
    <h1><?=$obra['titulo']?></h1>
    <a href="autor.php?id=<?=$obra['id_autor']?>"><?=$obra['autor']?></a>
    <p><?=$obra['año']?></p>
    <p><?=$obra['descripcion']?></p>
    <a href="disciplina.php?id=<?=$obra['id_disciplina']?>"><?=$obra['disciplina']?></a>
    </div>    

    </div>



<?getfooter();?>