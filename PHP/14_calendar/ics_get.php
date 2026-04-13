<?php

// 🧠 Convierte fecha HTML (datetime-local) a formato ICS
function toICSDate($fecha) {
    return gmdate('Ymd\THis\Z', strtotime($fecha));
}

// 🧹 Leer parámetros GET
$titulo       = $_GET['titulo'] ?? 'Sin título';
$descripcion  = $_GET['descripcion'] ?? '';
$lugar        = $_GET['lugar'] ?? '';
$inicio       = $_GET['inicio'] ?? '';
$fin          = $_GET['fin'] ?? '';

// ⚠️ Validación mínima obligatoria
if (empty($inicio) || empty($fin)) {
    die("❌ Error: faltan fechas (inicio o fin)");
}

// 📅 Conversión de fechas a formato ICS
$inicioICS = toICSDate($inicio);
$finICS    = toICSDate($fin);

// 🧾 Construcción del archivo ICS
$ics  = "BEGIN:VCALENDAR\r\n";
$ics .= "VERSION:2.0\r\n";
$ics .= "PRODID:-//MiWeb//Generador ICS GET//ES\r\n";
$ics .= "CALSCALE:GREGORIAN\r\n";

$ics .= "BEGIN:VEVENT\r\n";
$ics .= "UID:" . uniqid() . "@miweb.com\r\n";
$ics .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
$ics .= "DTSTART:$inicioICS\r\n";
$ics .= "DTEND:$finICS\r\n";
$ics .= "SUMMARY:" . $titulo . "\r\n";
$ics .= "DESCRIPTION:" . $descripcion . "\r\n";
$ics .= "LOCATION:" . $lugar . "\r\n";
$ics .= "END:VEVENT\r\n";
$ics .= "END:VCALENDAR\r\n";

// 📥 Headers para descarga del archivo
header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=evento.ics');

// 📤 salida del archivo
echo $ics;
exit;