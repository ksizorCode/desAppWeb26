<?php
$titulo = 'Carta de Restaurante';
include '_config.php';
include 'bloques/_header.php';

$archivo = 'datos.json';

// Cargar JSON y convertirlo en array PHP
if (file_exists($archivo)) {
    $miJSON = file_get_contents($archivo);
    $miArray = json_decode($miJSON, true);

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['nombrePlato'])) {
        // Capturar y sanitizar datos del formulario
        $nombrePlato = htmlspecialchars($_POST['nombrePlato']);
        $ingredientes = htmlspecialchars($_POST['ingredientes']);
        $precio = floatval($_POST['precio']);
        $tipo = in_array($_POST['tipo'], ['entrada', 'primer plato', 'segundo plato', 'postre', 'bebidas']) ? $_POST['tipo'] : 'entrada';
        $visible = isset($_POST['visible']) ? 1 : 0;

        // Agregar nuevo plato al array
        $miArray['carta'][] = [
            'nombre' => $nombrePlato,
            'ingredientes' => $ingredientes,
            'precio' => $precio,
            'tipo' => $tipo,
            'visible' => $visible
        ];

        // Guardar cambios en el JSON
        file_put_contents($archivo, json_encode($miArray, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

        echo "<div>
            <h2>Plato agregado con éxito</h2>
            <h3>$nombrePlato</h3>
            <p><strong>Ingredientes:</strong> $ingredientes</p>
            <p><strong>Precio:</strong> $precio €</p>
            <p><strong>Tipo:</strong> $tipo</p>
            <p><strong>Visible:</strong> " . ($visible ? 'Sí' : 'No') . "</p>
            <a href='index.php'>Ver Carta</a>
        </div>";
    }
} else {
    echo "ERROR: No hemos podido cargar los datos";
}
?>

<form action="" method="post">
    <input type="text" name="nombrePlato" placeholder="Nombre del plato" required>
    <textarea name="ingredientes" placeholder="Ingredientes" required></textarea>
    <input type="number" name="precio" placeholder="Precio (€)" step="0.01" required>

    <label for="tipo">Tipo:</label>
    <select name="tipo" required>
        <option value="entrada">Entrada</option>
        <option value="primer plato">Primer Plato</option>
        <option value="segundo plato">Segundo Plato</option>
        <option value="postre">Postre</option>
        <option value="bebidas">Bebidas</option>
    </select>

    <label>
        <input type="checkbox" name="visible" value="1" checked>
        Visible en la carta
    </label>

    <input type="submit" value="Guardar Plato">
</form>

<?php include 'bloques/_footer.php'; ?>
