<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Leemos los archivos del JSON</h1>

<?php

// leer archivo JSON
$data = file_get_contents('eventos.json');

// convertir a array
$eventos = json_decode($data, true);

// meterse en el primera dimensión del array (si es necesario)
if (isset($eventos['eventos'])) {
    $eventos = $eventos['eventos'];
}

?>
<details>
<summary>Estructura en ArrayPHP del  JSON</summary>
<pre>
<? print_r($eventos); // para depuración ?>
</pre>
</details>



<ul>
<?php

// función para convertir fecha a formato Google Calendar
function toGoogleDate($fecha) {
    return gmdate('Ymd\THis\Z', strtotime($fecha));
}

// recorrer eventos y generar enlaces a Google Calendar
foreach ($eventos as $evento) {

    // convertir fechas
    $inicio = toGoogleDate($evento['inicio']);
    $fin = toGoogleDate($evento['fin']);

    // construir URL Google Calendar
    $url = "https://calendar.google.com/calendar/render?action=TEMPLATE"
        . "&text=" . urlencode($evento['titulo'])
        . "&dates=" . $inicio . "/" . $fin
        . "&details=" . urlencode($evento['descripcion'])
        . "&location=" . urlencode($evento['lugar']);

        
    echo "<li>";
    echo "<h3>{$evento['titulo']}</h3>";
    echo "<p>{$evento['descripcion']}</p>";
    echo "<p>Lugar: {$evento['lugar']}</p>";
    echo "<p>Inicio: {$evento['inicio']}</p>";
    echo "<p>Fin: {$evento['fin']}</p>";

    echo "<a href='{$url}' target='_blank'>📅 Añadir a Google Calendar</a>";
echo "<br>";
// Decarga del .ics

$urlICS = "ics_get.php?"
    . "titulo=" . urlencode($evento['titulo'])
    . "&descripcion=" . urlencode($evento['descripcion'])
    . "&lugar=" . urlencode($evento['lugar'])
    . "&inicio=" . urlencode($evento['inicio'])
    . "&fin=" . urlencode($evento['fin']);

echo "<a href='{$urlICS}' target='_blank'>📄 Descargar ICS</a>";


    echo "</li>";
}
?>
</ul>


    
</body>
</html>