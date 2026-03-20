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
|preload|indica cuánto se carga antes de reproducir (none, metadata, auto)|


Vamos a darle varias opciones para que cargue la más adecuada:

```html
<video width="320" height="240" controls>
  <source src="movie.mp4" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
Tu navegador no soporta la etiqueta de video
</video>
```

