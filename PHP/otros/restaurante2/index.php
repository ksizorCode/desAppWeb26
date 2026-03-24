<?php
$titulo = 'Carta de Restaurante';
require '_config.php';
include 'bloques/_header.php';

$archivo = 'datos.json';

if (file_exists($archivo)) {
    $miJSON = file_get_contents($archivo);
    $miArray = json_decode($miJSON, true);

    // Organizar platos por tipo
    $categorias = [
        'entrada' => [],
        'primer plato' => [],
        'segundo plato' => [],
        'postre' => [],
        'bebidas' => []
    ];

    foreach ($miArray['carta'] as $plato) {
        if ($plato['visible'] == 1) { // Solo mostrar platos visibles
            $categorias[$plato['tipo']][] = $plato;
        }
    }

    echo '<div class="carta">';

    foreach ($categorias as $tipo => $platos) {
        if (!empty($platos)) {
            echo "<h2>" . ucfirst($tipo) . "</h2>"; // Capitaliza la primera letra
            echo '<ul class="galeria">';
            foreach ($platos as $plato) {
                echo "<li class='plato' 
                data-nombre='{$plato['nombre']}'
                data-ingredientes='{$plato['ingredientes']}'
                data-precio='{$plato['precio']}€'>
                <h3>{$plato['nombre']}</h3>
                <p>{$plato['ingredientes']}</p>
                <span>{$plato['precio']}€</span>
                <a href='plato.php?nombre=" . urlencode($plato['nombre']) . "' class='btn'>Ver ficha</a>

                </li>";
            }
            echo '</ul>';
        }
    }

    echo '</div>';
} else {
    echo "<p class='error'>ERROR: No hemos podido cargar los datos.</p>";
}

include 'bloques/_footer.php';
?>
