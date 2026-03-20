<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        html{
            background:tan
        }

        body{
           
            font-family: sans-serif;
        }
        ul{
            list-style:none;
            padding-left:0;

            display: flex;
            flex-wrap:wrap;
            gap:10px;
        }
        li{
            background: white;
            padding: 20px;
            border-radius:20px;
            flex: 1 1 120px;
        }

        .director{ font-weight:bold; text-transform:uppercase; color:tan;}
        .anio{ color:lightblue}
    </style>
</head>
<body>


    


<?php

// Leemos el archivo JSON y lo convertimos en un array PHP llamado $datos
$datos = json_decode(file_get_contents('datos/datos2.json'), true);

//mirar la estructura de $datos para entenderla y saber como llamar a los elemetnos
echo '<pre>';
    print_r($datos);  // Comentar todo esto al terminar
echo '</pre>';        // Sólo para modo desarrollo


 echo   '<ul>'; //creamos el ul
 //hacemos un bucle foreach para recorrer el array
 foreach($datos['peliculas'] as $pelicula){
     echo '<li>';
        echo "<img src='{$pelicula['imagen']}'>";
        echo "<h2>{$pelicula['titulo']}</h2>";
        echo "<p class='director'> {$pelicula['director']}</p>";
        echo "<p class='anio'>{$pelicula['anio']}</p>";
     echo '</li>';
    }
    echo   '</ul>';
/*
// Iteramos sobre las películas y mostramos sus detalles
foreach ($datos['peliculas'] as $pelicula) {
    echo "Título: " . $pelicula['titulo'] . "<br>";
    echo "Director: " . $pelicula['director'] . "<br>";
    echo "Año: " . $pelicula['anio'] . "<br><br>";
}
*/

?>


</body>
</html>