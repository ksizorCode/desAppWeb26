<?php
// ---------------------------------------------------
// CARGA DEL JSON
// ---------------------------------------------------
$json = file_get_contents('datos.json');
$datos = json_decode($json, true);

if (!isset($datos['restaurante']) || !isset($datos['carta'])) {
    die("Error: El archivo JSON no contiene los datos necesarios.");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($datos['restaurante']['nombre']) ?> - Carta</title>
    <link rel="stylesheet" href="style.css?v=<?= filemtime('style.css') ?>">
</head>

<body>

    <header>
        <h1><?= htmlspecialchars($datos['restaurante']['nombre']) ?></h1>
        <p>Dirección: <?= htmlspecialchars($datos['restaurante']['direccion'] ?? 'No disponible') ?></p>
        <p>Teléfono: <?= htmlspecialchars($datos['restaurante']['telefono'] ?? 'No disponible') ?></p>
    </header>

    <main>
        <div id="vistaControles">
            <span>Ver como: </span>
            <button data-vista="lista">Lista</button>
            <button data-vista="grid">Retícula</button>
            <button data-vista="compacta">Compacta</button>
        </div>

        <?php foreach ($datos['carta'] as $categoria => $platos): ?>
        <section class="categoria lista">
            <h2><?= ucfirst(htmlspecialchars($categoria)) ?></h2>
            <ul class="platos">
                <?php foreach ($platos as $plato): ?>
                <li class="plato">
                    <article>
                        <!-- Imagen del plato -->
                        <?php if (!empty($plato['foto'])): ?>
                        <a href="plato.php?plato=<?= urlencode($plato['nombre']) ?>">
                            <img src="<?= htmlspecialchars($plato['foto']) ?>"
                                alt="<?= htmlspecialchars($plato['nombre']) ?>" class="plato-foto">
                        </a>
                        <?php endif; ?>
                        <div class="txt">
                            <h3>
                                <a href="plato.php?plato=<?= urlencode($plato['nombre']) ?>">
                                    <?= htmlspecialchars($plato['nombre'] ?? 'Sin nombre') ?>
                                </a>
                            </h3>

                            <p>
                                <strong>Ingredientes:</strong>
                                <?= isset($plato['ingredientes']) ? htmlspecialchars(implode(', ', $plato['ingredientes'])) : 'No disponible' ?>
                            </p>

                            <p>
                                <strong>Alérgenos:</strong>
                                <?= isset($plato['alergenos']) && !empty($plato['alergenos']) 
                                    ? htmlspecialchars(implode(', ', $plato['alergenos'])) 
                                    : 'Ninguno' ?>
                            </p>

                            <p>
                                <strong>Precio:</strong>
                                <?= isset($plato['precio']) ? number_format($plato['precio'], 2) . " €" : 'Consultar' ?>
                            </p>
                        </div>
                    </article>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
        <?php endforeach; ?>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($datos['restaurante']['nombre']) ?>. Todos los derechos
            reservados.</p>
        <p>
            Dirección: <?= htmlspecialchars($datos['restaurante']['direccion'] ?? 'No disponible') ?> |
            Teléfono: <?= htmlspecialchars($datos['restaurante']['telefono'] ?? 'No disponible') ?>
        </p>
        <p>
            <?php if (!empty($datos['restaurante']['email'])): ?>
            <a href="mailto:<?= htmlspecialchars($datos['restaurante']['email']) ?>">
                <?= htmlspecialchars($datos['restaurante']['email']) ?>
            </a> |
            <?php endif; ?>
            <a href="#">Aviso legal</a> |
            <a href="#">Política de privacidad</a>
        </p>
    </footer>

    <script src="script.js"></script>

</body>

</html>