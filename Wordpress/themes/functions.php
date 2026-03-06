<?php

//activa las capacidades del THUMBNAIL o imagenes miniatura de apartado
function mi_tema_setup() {
    // Habilita las imágenes destacadas
    add_theme_support('post-thumbnails');

    // Opcional: Definir tamaños personalizados
    // add_image_size('post-header', 800, 400, true); 
}
add_action('after_setup_theme', 'mi_tema_setup');
