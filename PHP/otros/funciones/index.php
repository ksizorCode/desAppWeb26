

<?php


$debug=1;

//Mis funciones

function p($array){
    global $debug;
    if($debug){
        echo '<div class="debug"><code><pre>';
        print_r($array);
        echo '</code></pre></div>';
    }
}





// Mi código de este apartado

function cargarJSON($archivoJSON='data.json'){
    if(file_exists($archivoJSON)){
        $contenido = json_decode(file_get_contents($archivoJSON), true);
        return $contenido;
    }
    else{
        echo 'No se ha podido cargar'.$archivoJSON;
    }
}


// Programación fuera de la función
$archivoJSON ='data.json';
if(file_exists($archivoJSON)){
    $contenido = json_decode(file_get_contents($archivoJSON), true);
}
else{
    echo 'No se ha podido cargar'.$archivoJSON;
}







    p(cargarJSON('datos.json'));



    foreach(cargarJSON('datos.json')['herramientas'] as $herramienta){
        echo "<li>
        <h2>{$herramienta['nombre']}</h2>
        <p class='categoria'>{$herramienta['categoria']}</p>
        <p class='marca'>{$herramienta['marca']}</p>
        <p class='precio'>{$herramienta['precio']}</p>
        <p class='stock'>{$herramienta['stock']}</p>
        </li>";
    }
  