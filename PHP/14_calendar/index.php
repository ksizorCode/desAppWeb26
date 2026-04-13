<style>
     body {
        max-width: 960px;
        margin: 20px auto;
        font-family: sans-serif;
        padding: 20px;
    }
    code, pre{
        padding: 5px;
        background:#DEDEDE;
        border-radius: 3px;
        font-weight: bold;
        transition:.7   s;
        display: inline-block;
    }
    label{
        display: block;
    }
</style>


<h1>Creación de eventos en Calendarios</h1>

<p>Existen principalmente dos tipos:</p>

<h2>Enlace a Plataforma</h2>
<p>Se construyen a partir de una URL con parámetros en la ruta.</p>
<dl>
    <dt>Google Calendar</dt>
    <dd><a href="https://calendar.google.com/calendar/render?action=TEMPLATE&dates=20260413T080000Z%2F20260413T093000Z&details=&location=Gij%C3%B3n&text=Titulo%20del%20evento">Enlace a Evengo de Googel Maps</a></dd>
    <dt>Outlook</dt>
    <dt>Microsoft 365</dt>
</dl>

<p>Existen webs como estas que permiten generar ese contenido:</p>
<ul>
    <li>
        <a href="ttps://customer.io/tools/calendar-link-generator">https://customer.io/tools/calendar-link-generator</a>
    </li>
    <li>
        <a href="https://www.labnol.org/calendar">https://www.labnol.org/calendar</a>
    </li>
</ul>




<hr>
<h2>Archivo .ics</h2>
<p>Archivo de calendario tipo .ics</p>
<p>Tienen un formato parecido a esto:</p>
<pre>
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//MiApp//Evento Demo//ES
CALSCALE:GREGORIAN

BEGIN:VEVENT
UID:123456789@miapp.com
DTSTAMP:20260413T080000Z
DTSTART:20260415T100000Z
DTEND:20260415T110000Z
SUMMARY:Reunión de prueba
DESCRIPTION:Este es un evento de ejemplo generado en formato ICS
LOCATION:Oviedo
STATUS:CONFIRMED
SEQUENCE:0
BEGIN:VALARM
TRIGGER:-PT15M
DESCRIPTION:Recordatorio
ACTION:DISPLAY
END:VALARM
END:VEVENT

END:VCALENDAR
</pre>

<pre>
🧩 Estructura explicada
Campo	Descripción
BEGIN:VCALENDAR	Inicio del calendario
VERSION	Versión del estándar (2.0)
BEGIN:VEVENT	Inicio del evento
UID	Identificador único
DTSTAMP	Fecha de creación
DTSTART / DTEND	Inicio y fin del evento (UTC)
SUMMARY	Título
DESCRIPTION	Descripción
LOCATION	Lugar
VALARM	Recordatorio
</pre>

<p>
De esta forma que el siguiente php crearía el archivo ics: <a href="ics_basico.php">📅 Descargar evento: (ics_basico.php)</a>
</p>
<p>
Lo mismo a partir de datos de un array: <a href="ics_basico.php">📅 Descargar evento: (ics_basico.php)</a>
</p>


<form method="POST" action="ics_form.php">
    <label>Título</label>
    <input type="text" name="titulo" required value="Feria de Muestras">

    <label>Descripción</label>
    <textarea name="descripcion">Sitio al que ir a comer bocata calamares y se vuelve con mil trastos</textarea>

    <label>Lugar</label>
    <input type="text" name="lugar" value="Recinto Luis Adaro">

<label>Fecha inicio</label>
<input type="datetime-local" name="inicio" required value="2026-08-10T10:30">

<label>Fecha fin</label>
<input type="datetime-local" name="fin" required value="2026-08-10T18:30">

    <button type="submit">📅 Descargar evento: (ics_form.php)</button>
</form>

<a href="events_json.php">Ver eventos a partir de un JSOn y descargar .ics para cada caso</a>







