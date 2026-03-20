<?php
// Ruta de la carpeta a listar
$directorio = './';

// Obtener lista de elementos del directorio
$elementos = scandir($directorio);

echo "<ul>";
foreach ($elementos as $elemento) {
    if ($elemento != '.' && $elemento != '..') { // Omitimos "." y ".."
        $rutaCompleta = $directorio . DIRECTORY_SEPARATOR . $elemento;

        // Imprimimos el enlace
        echo "<li><a href=\"$elemento\">$elemento</a> ";

        // Verificamos si es un directorio o un archivo
        if (is_dir($rutaCompleta)) {
            echo "<span>(Soy un directorio)</span>";
        } else {
            echo "<span>(Soy un archivo)</span>";
        }

        echo "</li>";
    }
}
echo "</ul>";
?>
