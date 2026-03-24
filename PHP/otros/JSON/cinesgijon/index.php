<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cines Gijón</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo">Cines Gijón</div>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="admin.php">Admin</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Descubre nuestra cartelera de cines en gijón</h1>

    <?
    //definimos ruta a archivo con el que trabajaremos
    $rutaArchivo ='cartelera.json';
    
    // comprobamos que el archivo existe
    if(file_exists($rutaArchivo)){
        //cargamos el archivo
         $datosArchivoJSON = file_get_contents($rutaArchivo);
        //decodificamos el JSON y lo convertimos en array PHP
        $listaArray =  json_decode($datosArchivoJSON,true);

      //  $miArray = json_decode(file_get_contents('cartelera.json'),true);

    //Desplegamos el array con los datos de las pelis
      echo "<ul class='cartelera'>";
      foreach($listaArray['pelisCartelera'] as $peli){
          echo "<li>
            <img src='{$peli['cartel']}' alt='{$peli['titulo']} de {$peli['director']}'>
            <h2>{$peli['titulo']}</h2>
            <p class='director'>{$peli['director']}</p>
            <a href='#' class='btn'><i class='fa-solid fa-ticket'></i> Sacar Entradas</a>
          </li>";
        }  
        echo "</ul>";



    //   echo '<pre>';
    //     print_r($listaArray);
    //   echo '</pre>';
    }
    else{
        echo "No hemos podido cargar $rutaArchivo 😥";
    }




        ?>

    </main>
    <footer></footer>    


</body>
</html>