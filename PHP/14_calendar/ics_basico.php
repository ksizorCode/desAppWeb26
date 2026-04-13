
<?php
//Genera archivo .ics con los datos fijos

header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename=evento.ics');

echo "BEGIN:VCALENDAR\r\n";
echo "VERSION:2.0\r\n";
echo "PRODID:-//MiWeb//ES\r\n";
echo "BEGIN:VEVENT\r\n";
echo "UID:" . uniqid() . "@miweb.com\r\n";
echo "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
echo "DTSTART:20260415T100000Z\r\n";
echo "DTEND:20260415T110000Z\r\n";
echo "SUMMARY:Evento desde PHP\r\n";
echo "DESCRIPTION:Generado dinámicamente\r\n";
echo "LOCATION:Oviedo\r\n";
echo "END:VEVENT\r\n";
echo "END:VCALENDAR\r\n";
exit;
