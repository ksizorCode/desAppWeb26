# Videos en la web

Para insertar un video en HTML inserta el siguiente código:

```html
<video src="ruta/delvideo.mp4" controls>
```


|atributo|descripcon|
|---|---|
|controls|muestra los controles de reproducción (play, pausa, volumen, etc.)|
|muted|silencia el video (empieza sin sonido)|
|autoplay|reproducción automática al cargar la página (suele requerir también muted)|
|loop|repite el video automáticamente al finalizar|
|autoplay|reproducción automática al cargar la página (suele requerir también muted)|
|poster|URL de una imagen que se muestra antes de reproducir el video|
|playsinline|fuerza la reproducción dentro de la página en móviles (sin pantalla completa)|
|preload|indica cuánto se carga antes de reproducir (none, metadata, auto)|


También puedes usar varias fuentes para mejorar la compatibilidad:


```html
<video width="320" height="240" controls>
  <source src="movie.mp4" type="video/mp4">
  <source src="movie.webm" type="video/webm">
  <source src="movie.ogg" type="video/ogg">
  Tu navegador no soporta la etiqueta de video
</video>
```

---
Bancos de videos:
https://samplelib.com/sample-mp4.html
https://file-examples.com/index.php/sample-video-files/sample-mp4-files/
https://www.pexels.com/es-es/buscar/videos/videos/
https://pixabay.com/es/videos/search/


Ver más:
https://www.w3schools.com/html/html5_video.asp
Video como fondo:
https://www.w3schools.com/howto/howto_css_fullscreen_video.asp
