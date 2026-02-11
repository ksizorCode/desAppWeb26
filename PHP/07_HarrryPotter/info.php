<?
//obtenemos valor a cargar del GET, si no hay será 0
$elemento = $_GET['p'] ?? 0;

//cargamos array del archivo datos.php
include 'datos.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? echo $datos[$elemento]['nombre']; ?></title>
    <link rel="stylesheet" href="style.css?v=<?=date('U')?>">
</head>
<body id="ficha">
    



<main>
<a href="index.php">Volver</a>
<div class="ficha">
    <h1 style='view-transition-name:title-<?=$elemento?>'><? echo $datos[$elemento]['nombre']; ?><span> de <?=$datos[$elemento]['casa']?></span></h1>
    <img src='<?=$datos[$elemento]['imagen']; ?>' alt='<?=$datos[$elemento]['nombre']; ?>' style='view-transition-name:image-<?=$elemento?>'>

    <p>📖 <?=$datos[$elemento]['descripcion']; ?></p>
    <p>🏰 Casa: <?=$datos[$elemento]['casa']; ?></p>
    <p>🩸 Sangre: <?=$datos[$elemento]['sangre']; ?></p>
    <p>✨ Patronus: <?=$datos[$elemento]['patronus']; ?></p>
    <p>⚡ Varita: <?=$datos[$elemento]['varita']; ?></p>
</div>

<section>
    <h2>Otros personajes</h2>
    <? mostrarGaleria($datos, $elemento); ?>
</section>


</main>

<footer>
    &copy; 2026 - Personajes Harry Potter
</footer>
</body>
</html>