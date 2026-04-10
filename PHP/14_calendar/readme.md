# Generar citas y añadirlas al calendario

Al igual que para poder mostrar los datos de una localización en un mapa necesitamos disponer de los datos GPS:
- longitud
- latitud
Y nunca está de más añadir la dirección o <address> por si el usuario la necesitase.
Para ser mostrados utilizando tecnologías como Google Maps, Open Maps, Bing Maps, Apple Maps, etc..

Para crear una cita se utilizan básicamente dos sistemas:
1. URL para herramientas online tipo Google Calendar, Ouglook Calendar, etc...
2.  Archivos .cal que se procesan en Outlook, Apple iCal, otros gestores de agenda


La primera opción es muy sencilla de utilizar. Simplemente tenemos que generar una URL tipo:

`https://calendar.google.com/calendar/render?action=TEMPLATE&dates=20260413T080000Z%2F20260413T093000Z&details=&location=Gij%C3%B3n&text=Titulo%20del%20evento`

Esta url almacena datos como:
- dirección principal o dominio: calendar.google.com
- date= 2026 04 13 T08 00 00: 13 Abril 2026 a las 8:00 am
- details= no hay nada aquí
- location=Gijón
- text = titulo del evento

Esta clase de URLs se pueden crear a mano o directamente utilizando generadores online como:

- https://customer.io/tools/calendar-link-generator
- https://www.labnol.org/calendar



