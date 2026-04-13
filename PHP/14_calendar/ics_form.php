<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 🧹 Sanitizar (básico)
    function limpiar($dato) {
        return htmlspecialchars(trim($dato));
    }

    // 📅 Convertir formato HTML → ICS
    function formatearFechaICS($fecha) {
        return gmdate('Ymd\THis\Z', strtotime($fecha));
    }

    // 📦 Array del evento
    $evento = [
        'titulo' => limpiar($_POST['titulo']),
        'descripcion' => limpiar($_POST['descripcion']),
        'lugar' => limpiar($_POST['lugar']),
        'inicio' => formatearFechaICS($_POST['inicio']),
        'fin' => formatearFechaICS($_POST['fin'])
    ];

    // 🧠 Generador ICS
    function generarICS($evento) {
        $ics  = "BEGIN:VCALENDAR\r\n";
        $ics .= "VERSION:2.0\r\n";
        $ics .= "PRODID:-//MiWeb//ES\r\n";
        $ics .= "BEGIN:VEVENT\r\n";
        $ics .= "UID:" . uniqid() . "@miweb.com\r\n";
        $ics .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
        $ics .= "DTSTART:" . $evento['inicio'] . "\r\n";
        $ics .= "DTEND:" . $evento['fin'] . "\r\n";
        $ics .= "SUMMARY:" . $evento['titulo'] . "\r\n";
        $ics .= "DESCRIPTION:" . $evento['descripcion'] . "\r\n";
        $ics .= "LOCATION:" . $evento['lugar'] . "\r\n";
        $ics .= "END:VEVENT\r\n";
        $ics .= "END:VCALENDAR\r\n";

        return $ics;
    }

    // 📥 Headers descarga
    header('Content-Type: text/calendar; charset=utf-8');
    header('Content-Disposition: attachment; filename=evento.ics');

    echo generarICS($evento);
    exit;
}
?>

</body>
</html>