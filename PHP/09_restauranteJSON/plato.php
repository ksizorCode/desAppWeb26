<?php
// ---------------------------------------------------
// plato.php: Mostrar detalles de un plato específico
// ---------------------------------------------------

// Cargar JSON
$json = file_get_contents('datos.json');
$datos = json_decode($json, true);

// Comprobar que el parámetro 'plato' existe
if (!isset($_GET['plato'])) {
    die("Error: No se ha especificado ningún plato.");
}

// Obtener nombre del plato de la URL
$nombrePlato = $_GET['plato'];

// Variable para almacenar el plato encontrado
$platoEncontrado = null;

// Buscar el plato en todas las categorías
foreach ($datos['carta'] as $categoria => $platos) {
    foreach ($platos as $plato) {
        if ($plato['nombre'] === $nombrePlato) {
            $platoEncontrado = $plato;
            $platoCategoria = $categoria;
            break 2; // salimos de ambos bucles
        }
    }
}

// Si no se encuentra el plato
if (!$platoEncontrado) {
    die("Error: Plato no encontrado.");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($platoEncontrado['nombre']) ?> - Detalle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1><?= htmlspecialchars($datos['restaurante']['nombre']) ?></h1>
    <p><a href="carta.php">← Volver a la carta</a></p>
</header>

<main>
    <section class="plato-detalle">
        <h2><?= htmlspecialchars($platoEncontrado['nombre']) ?></h2>
        <p><strong>Descripcion:</strong><?= htmlspecialchars($platoEncontrado['descripcion']) ?></p>
        <p><strong>Recomendacion:</strong> <?= htmlspecialchars($platoEncontrado['recomendacion']) ?></p>
        <p><strong>Categoría:</strong> <?= htmlspecialchars(ucfirst($platoCategoria)) ?></p>
        <p><strong>Ingredientes:</strong> <?= htmlspecialchars(implode(', ', $platoEncontrado['ingredientes'])) ?></p>
        <p><strong>Alérgenos:</strong> 
            <?= isset($platoEncontrado['alergenos']) && !empty($platoEncontrado['alergenos']) 
                ? htmlspecialchars(implode(', ', $platoEncontrado['alergenos'])) 
                : 'Ninguno' ?>
        </p>
        <p><strong>Precio:</strong> 
            <?= isset($platoEncontrado['precio']) ? number_format($platoEncontrado['precio'],2) . ' €' : 'Consultar' ?>
        </p>

  
        <?php if (!empty($platoEncontrado['foto'])): ?>
            <img src="<?= htmlspecialchars($platoEncontrado['foto']) ?>" alt="<?= htmlspecialchars($platoEncontrado['nombre']) ?>" style="max-width:400px; margin-top:20px;">
        <?php endif; ?>
    </section>
</main>

<footer>
    <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($datos['restaurante']['nombre']) ?></p>
</footer>

</body>
</html>
