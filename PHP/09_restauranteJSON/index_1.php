<?php
//Cargamos los datos
$json = file_get_contents('datos.json');
$datos = json_decode($json, true); // true = array asociativo

?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $datos['restaurante']['nombre'] ?> - Carta</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Datos del restaurante -->
    <header>
        <h1><?= $datos['restaurante']['nombre'] ?></h1>
        <p>Dirección: <?= $datos['restaurante']['direccion'] ?></p>
        <p>Teléfono: <?= $datos['restaurante']['telefono'] ?></p>
    </header>

    <main>
        <?php foreach ($datos['carta'] as $categoria => $platos): ?>
        <h2><?= ucfirst($categoria) ?></h2>
        <ul>
            <?php foreach ($platos as $plato): ?>
            <li>
                <strong><?= htmlspecialchars($plato['nombre']) ?></strong><br>
                Ingredientes: <?= htmlspecialchars(implode(', ', $plato['ingredientes'])) ?><br>
                Alérgenos: <?= htmlspecialchars(implode(', ', $plato['alergenos'])) ?><br>
                Precio: <?= number_format($plato['precio'], 2) ?> €
            </li>
            <?php endforeach; ?>
        </ul>
        <?php endforeach; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> <?= $datos['restaurante']['nombre'] ?>. Todos los derechos reservados.</p>
        <p>Dirección: <?= $datos['restaurante']['direccion'] ?> | Teléfono: <?= $datos['restaurante']['telefono'] ?></p>
        <p>
            <a href="mailto:<?= $datos['restaurante']['email'] ?>"><?= $datos['restaurante']['email'] ?></a>|
            <a href="#">Aviso legal</a> |
            <a href="#">Política de privacidad</a>
        </p>
    </footer>


</body>

</html>