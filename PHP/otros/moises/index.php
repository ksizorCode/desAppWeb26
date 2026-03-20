<?php $t='Beerray'?>
<?php require 'bloques/_config.php'?>
<?php include_once 'bloques/_header.php'?>

<?php 


    $ruta = 'assets/datos/cervezas.json'; //La ruta de nuestro JSON
    //Llamada a la función para pintar el array, la función a la que estamos llamando se encuentra en config.php
    debugPrint_r(cargarJSON($ruta));
    
    echo '<ul class="flex">';
    //Usamos un bucle foreach para recorrer el array
    //Por cada item en el array cervezas escribimos los datos(nombre, tipo, origen, alcohol, precio)
    $miArray = cargarJSON($ruta);
    foreach($miArray['cervezas'] as $miCerveza){
        echo "<li class='card'>
            <h2 class = 'nombre'>{$miCerveza['nombre']}</h2>
            <p class = 'tipo'>{$miCerveza['tipo']}</p>
            <p class = 'origen'>{$miCerveza['origen']}</p>
            <p class = 'alcohol'>{$miCerveza['alcohol']}</p>
            <p class = 'precio'>{$miCerveza['precio']}</p>
        </li>";
    }

    echo '</ul>';
    ?>
<?php include_once 'bloques/_footer.php'?>