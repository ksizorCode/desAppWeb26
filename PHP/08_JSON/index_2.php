<?php

//cargamos el archivo JSON
$json=file_get_contents('datos.json');

//convertimos $json a array PHP
$arrayDatos = json_decode($json, true);

//mostrar datos del array
/*
echo '<pre><code>';
print_r($arrayDatos);
echo '</pre></code>'; 
*/ 
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frutería ADA</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <header>
        <nav>
            <ul>
                <li><a href="index.php">inicio</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Frutería ADA</h1>
        <?php
        //Mostrar lista a partir de datos del JSON convertido en Array PHP
        echo '<ul>';
        foreach($arrayDatos['frutas'] as $elemento){
            echo "<li>
            <p>{$elemento['icono']}</p>
            <h2>{$elemento['nombre']}</h2>
            <p>Color: {$elemento['color']}</p>
            <p>P.V.P: {$elemento['precio']}€</p>
            </li>";
            }
            
        echo '</ul>';
    ?>


    </main>
    <footer>
        <p>&copy; <?=date('Y')?></p>
    </footer>
</body>

</html>