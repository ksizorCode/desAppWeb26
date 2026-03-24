<?php
// Ruta de la carpeta a listar
$directorio = './';

// Obtener lista de elementos del directorio
$elementos = scandir($directorio);

echo "<ul>";
foreach ($elementos as $elemento) {
   // if ($elemento != '.' && $elemento != '..') { // Omitimos "." y ".."
        $rutaCompleta = $directorio . DIRECTORY_SEPARATOR . $elemento;

        // Imprimimos el enlace
        echo "<li>";
        
        // Verificamos si es un directorio o un archivo
        if (is_dir($rutaCompleta)) {
            echo "<span>📁</span>";
        } else {
            echo "<span>📄</span>";
        }
        
        echo "<a href=\"$elemento\">$elemento</a> ";
        echo "</li>";
   // }
}
echo "</ul>";
?>
