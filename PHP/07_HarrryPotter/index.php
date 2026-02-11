


<?php
//cargamos array del archivo datos.php
 include 'datos.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personajes Harry Potter</title>
    <link rel="stylesheet" href="style.css?v=<?=date('U')?>">
</head>
<body>
    

<main>
<h1>Listado Personajes</h1>
    <? mostrarGaleria($datos); ?>
</main>

<footer>
    &copy; 2026 - Personajes Harry Potter
</footer>
</body>
</html>