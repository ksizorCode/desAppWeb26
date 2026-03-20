# Videos en la web

## Insretar un video
Para insertar un video en HTML usa la etiqueta `<video>`:

```html
<video src="ruta/delvideo.mp4" controls>
```

```html
<video src="ruta/del-video.mp4" controls>
  Tu navegador no soporta la etiqueta de video.
</video>
```
> ⚠️ Siempre incluye el texto de fallback dentro de `<video>` para navegadores sin soporte.

--

## Atributos de `<video>`
 
| Atributo | Descripción |
|---|---|
| `controls` | Muestra los controles de reproducción (play, pausa, volumen, etc.) |
| `autoplay` | Reproducción automática al cargar la página (suele requerir también `muted`) |
| `muted` | Silencia el video (necesario para que funcione `autoplay` en la mayoría de navegadores) |
| `loop` | Repite el video automáticamente al finalizar |
| `poster` | URL de una imagen que se muestra antes de reproducir el video |
| `playsinline` | Fuerza la reproducción dentro de la página en móviles (sin pantalla completa) |
| `preload` | Indica cuánto contenido se precarga: `none`, `metadata` o `auto` |
| `width` / `height` | Dimensiones del reproductor en píxeles |
 
---
 
## Múltiples fuentes (compatibilidad)
 
Distintos navegadores soportan distintos formatos. Usa `<source>` para ofrecer alternativas:
 
```html
<video width="320" height="240" controls>
  <source src="movie.mp4"  type="video/mp4">
  <source src="movie.webm" type="video/webm">
  <source src="movie.ogg"  type="video/ogg">
  Tu navegador no soporta la etiqueta de video.
</video>
```
 
El navegador usará el **primer formato que soporte** y omitirá el resto.
 
---
 
## Control con JavaScript
 
Puedes controlar el video desde JS usando la referencia al elemento `<video>`.
 
### Referencia al elemento
 
```html
<video id="miVideo" src="video.mp4" width="400"></video>
 
<button onclick="reproducir()">▶ Play</button>
<button onclick="pausar()">⏸ Pausa</button>
<button onclick="reiniciar()">⏮ Reiniciar</button>
```
 
```javascript
const video = document.getElementById("miVideo");
 
function reproducir() { video.play(); }
function pausar()     { video.pause(); }
function reiniciar()  { video.currentTime = 0; video.play(); }
```
 
### Propiedades útiles
 
| Propiedad | Tipo | Descripción |
|---|---|---|
| `video.currentTime` | número | Tiempo actual en segundos (lectura/escritura) |
| `video.duration` | número | Duración total en segundos (solo lectura) |
| `video.volume` | número (0–1) | Volumen (0 = silencio, 1 = máximo) |
| `video.muted` | booleano | `true` si está silenciado |
| `video.paused` | booleano | `true` si está pausado |
| `video.playbackRate` | número | Velocidad de reproducción (1 = normal, 2 = doble) |
| `video.loop` | booleano | `true` si está en modo bucle |
 
### Métodos útiles
 
| Método | Descripción |
|---|---|
| `video.play()` | Reproduce el video (devuelve una Promise) |
| `video.pause()` | Pausa el video |
| `video.load()` | Recarga el video (útil si cambias la fuente dinámicamente) |
| `video.requestFullscreen()` | Pone el video en pantalla completa |
 
### Eventos útiles
 
```javascript
video.addEventListener("play",       () => console.log("Reproduciendo"));
video.addEventListener("pause",      () => console.log("Pausado"));
video.addEventListener("ended",      () => console.log("Video terminado"));
video.addEventListener("timeupdate", () => console.log("Tiempo:", video.currentTime));
video.addEventListener("volumechange", () => console.log("Volumen:", video.volume));
```
 
### Ejemplo completo: barra de progreso personalizada
 
```html
<video id="miVideo" src="video.mp4" width="400"></video>
<input type="range" id="progreso" value="0" min="0" step="0.1">
 
<script>
  const video    = document.getElementById("miVideo");
  const progreso = document.getElementById("progreso");
 
  // Actualiza la barra mientras avanza el video
  video.addEventListener("timeupdate", () => {
    progreso.max   = video.duration;
    progreso.value = video.currentTime;
  });
 
  // Permite saltar a cualquier punto
  progreso.addEventListener("input", () => {
    video.currentTime = progreso.value;
  });
</script>
```
 
---
 
## Bancos de videos gratuitos
 
- [SampleLib](https://samplelib.com/sample-mp4.html) — videos de prueba en distintas resoluciones
- [File Examples](https://file-examples.com/index.php/sample-video-files/sample-mp4-files/) — archivos de muestra
- [Pexels](https://www.pexels.com/es-es/buscar/videos/videos/) — videos libres de derechos
- [Pixabay](https://pixabay.com/es/videos/search/) — videos libres de derechos
 
---
 
## Ver más
 
- 📖 [HTML Video — W3Schools](https://www.w3schools.com/html/html5_video.asp)
- 🎬 [Video como fondo de página (fullscreen)](https://www.w3schools.com/howto/howto_css_fullscreen_video.asp)
- 📖 [HTMLMediaElement — MDN](https://developer.mozilla.org/es/docs/Web/API/HTMLMediaElement)