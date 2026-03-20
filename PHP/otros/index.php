<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directorio</title>
    <style>
       body {
    font-family: sans-serif;
    max-width: 900px;
    margin: 10px auto;
    padding: 30px;
}

a {
    text-decoration: none;
    color: black;
}

ul.galeria {
    list-style: none;
    padding-left: 0;
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

ul.galeria li a {
    display: block;
    padding: 8px 12px;
    border-radius: 20px;
    flex: 1 1 100px;
    transition: .3s ease-in-out;
    outline: solid 2px white;
    outline-offset:-4px;
}

ul.galeria li a:hover {
    outline: solid 2px black;
    outline-offset:0px;
}

/* Colores según el tipo */
.nombreArchivo { 
    background: lightgreen; 
}

.carpeta { 
    background-color: orange; 
}

.destacar { 
    background-color: red; 
}
 
    </style>
</head>
<body>

<h1>Los Ejercicios de Clase de Miguel</h1>
<a href="index.php">🏠 Volver al Inicio</a>
<ul class="galeria">
<?php

$directorio = "./";

// Verifica si hay GET en la URL y es un directorio
if (isset($_GET['dir'])) {
    $dirLimpio = basename($_GET['dir']); // Evita ataques
    $directorio .= $dirLimpio . '/';
}

if (!is_dir($directorio)) {
    echo "<p>Error: El directorio está vacío.</p>";
}
else {
    $arrayDirectorio = scandir($directorio);
    $arrayNoQuiero = ['.', '..']; // Elementos a no mostrar

    $arrayDirectorio = array_diff($arrayDirectorio, $arrayNoQuiero); // Filtra elementos

    foreach ($arrayDirectorio as $nombreArchivo) {
        $clase = '';
        
        if ($nombreArchivo == 'index.php' || $nombreArchivo == 'index.html') {
            $clase = "destacar ";
        }
        if ($nombreArchivo == 'style.css') {
            $clase = "estilo ";
        }
        
        $rutaCompleta = $directorio . $nombreArchivo;
        if (is_file($rutaCompleta)) {
            $icono = "📄";
            $clase .= "nombreArchivo";
            $link = $rutaCompleta;
        } else {
            $icono = "📂";
            $clase .= "carpeta";
            $link = "index.php?dir=" . urlencode($rutaCompleta);
        }
        echo "<li><a href='$link' class='$clase'>$icono $nombreArchivo</a></li>";
    }
}

?>
</ul>
</body>
</html>
