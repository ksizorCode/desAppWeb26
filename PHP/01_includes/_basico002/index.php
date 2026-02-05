
<?
//Cargamos las variables Globales
// (datos que se repiten en todos los apartados de la web)
include 'componentes/datos.php';

// Cargamos las variables Locales
// Datos puntuales a este apartado nada más
$tituloApt='Home';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? echo $tituloApt?> <? echo $tituloWeb?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php include 'componentes/header.php';?>

<main>
    <h1><? echo $tituloApt?> - Bienvenidos al <? echo $tituloWeb?></h1>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut corrupti laudantium dignissimos fuga, quas numquam dolorum deleniti ipsa, magnam placeat laboriosam? Aliquam repellendus corrupti adipisci possimus ab nam, illum quasi.Z</p>
</main>

<?php include 'componentes/footer.php';?>

</body>
</html>
