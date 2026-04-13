<?php

/* Función
 * Esta función recibe los parametros de un array y lo convierte a un archivo .ics
 */

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

// Array con los datos del evento
$evento = [
    'inicio' => '20260415T100000Z',
    'fin' => '20260415T110000Z',
    'titulo' => 'Clase de desarrollo web',
    'descripcion' => 'Sesión práctica de PHP',
    'lugar' => 'Aula 3'
];


// Le especificamos al navegador que lo qeu va a llegar no es html si no un formato tipo calendario (text/calendar)
header('Content-Type: text/calendar; charset=utf-8');

// Fuerza la descarga como archivo que se descarga con este nombre
header('Content-Disposition: attachment; filename=evento.ics');

echo generarICS($evento);
exit;