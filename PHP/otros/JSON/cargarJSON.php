<?php
    $construccion=1;
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

   <link rel="stylesheet" href="style.css">
    
    <?php
    if($construccion){
        echo '<link rel="stylesheet" href="debug_style.css">';
    }
    ?>

</head>
<body>
   
<?php



if($construccion){
    echo '<pre>👽estas en modo construcción o debug!!!</pre>';
}

echo '<h1>Cargar mi JSON</h1>';
echo '<p> Bienvenidos al sistema de cargas de JSON. Vamos a cargar un archivo llamado datos.json</p>';


$archivo = 'datos/datos.json'; // almacena el archivo a cargar
//verificamos si el archivo existe
if(file_exists($archivo)){
    $archivoJSON = file_get_contents($archivo); //Cargamos el archivo
    $miArray = json_decode($archivoJSON,true); //convierte el JSON en array de PHP
   
    //Ver si el Array se ha creado correctamente y analizar su contenido    
   if($construccion){
        echo '<pre>';
            print_r($miArray);
        echo '</pre>';
    }
    
    
    //Mostrar lista bonita
    echo '<ul class="galeria">';

    foreach($miArray['peliculas'] as $item){
        echo '<li>';
            echo "<h2>{$item['titulo']}</h2>";
            echo "<img src='{$item['imagen']}'>";
            echo "<p class='director'>{$item['director']}</p>";
            echo "<p class='year'>{$item['anio']}</p>";
            echo '<a href="#" class="btn">vermás</a>';
        echo '</li>';

        echo "<li>
                    <h2>{$item['titulo']}</h2>
                    <img src='{$item['imagen']}'>
                    <p class='director'>{$item['director']}</p>
                    <p class='year'>{$item['anio']}</p>
                    <a href='#' class='btn'>vermás</a>
                </li>"; 
    }

    echo '</ul>';




}
else{
    echo "<div class='alerta'>No se puede cargar el archivo <strong> $archivo </strong></div>";
}








if($construccion){
    echo '<pre>👽fin de la gÜEBBBB!!!!</pre>';
}



?>


</body>
</html>