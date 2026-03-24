<?php
$titulo = 'Detalles del Plato';
require '_config.php'; // Configuración global
include 'bloques/_header.php'; // Cabecera común

// Verificar si se recibe el parámetro 'nombre'
if (isset($_GET['nombre'])) {
    $nombre_plato = htmlspecialchars($_GET['nombre']); // Sanear el nombre recibido

    $archivo = 'datos.json';

    if (file_exists($archivo)) {
        $miJSON = file_get_contents($archivo);
        $miArray = json_decode($miJSON, true);

        // Buscar el plato con el nombre recibido
        $plato_encontrado = null;
        foreach ($miArray['carta'] as $plato) {
            if (strtolower($plato['nombre']) == strtolower($nombre_plato)) {
                $plato_encontrado = $plato;
                break;
            }
        }

        // Mostrar los detalles del plato si se encuentra
        if ($plato_encontrado) {
            echo "<div class='plato-detalle'>
                    <h1>{$plato_encontrado['nombre']}</h1>
                    <p><strong>Ingredientes:</strong> {$plato_encontrado['ingredientes']}</p>
                    <p><strong>Tipo:</strong> {$plato_encontrado['tipo']}</p>
                    <p><strong>Precio:</strong> {$plato_encontrado['precio']}€</p>
                </div>";
        } else {
            echo "<p>El plato no se encontró.</p>";
        }
    } else {
        echo "<p>ERROR: No se pudo cargar el archivo de datos.</p>";
    }
} else {
    echo "<p>No se ha seleccionado ningún plato.</p>";
}

include 'bloques/_footer.php'; // Pie de página común
?>
