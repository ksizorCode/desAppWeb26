<?php
/**
 * Plugin Name: Comics Custom Post Type
 * Description: Crea el CPT "Comics" con sus taxonomías: Año, Autor, Serie, Universo, Editorial y Personajes.
 * Version: 1.0
 * Author: Nadine
 */

// Seguridad: evita acceso directo al archivo
if ( ! defined( 'ABSPATH' ) ) exit;


/* ============================================
    1. REGISTRAR EL CPT: COMICS
   ============================================ */

function comics_registrar_cpt() {

    $labels = array(
        'name'               => 'Comics',
        'singular_name'      => 'Comic',
        'add_new'            => 'Añadir nuevo',
        'add_new_item'       => 'Añadir nuevo comic',
        'edit_item'          => 'Editar comic',
        'new_item'           => 'Nuevo comic',
        'view_item'          => 'Ver comic',
        'search_items'       => 'Buscar comics',
        'not_found'          => 'No se encontraron comics',
        'not_found_in_trash' => 'No hay comics en la papelera',
        'menu_name'          => 'Comics',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,          // visible en el front-end
        'has_archive'        => true,          // página de archivo (índice): /comics/
        'rewrite'            => array( 'slug' => 'comics' ),
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_icon'          => 'dashicons-book-alt', // dashicon en el admin
        'show_in_rest'       => true,          // compatible con el editor de bloques
    );

    register_post_type( 'comic', $args );
}
add_action( 'init', 'comics_registrar_cpt' );


/* ============================================
    2. REGISTRAR LAS TAXONOMÍAS
    ============================================
    Cada taxonomía sigue el mismo patrón.
    - hierarchical: true  → funciona como Categorías (árbol)
    - hierarchical: false → funciona como Etiquetas (libre)
   ============================================ */

function comics_registrar_taxonomias() {

    // --- AÑO ---
    register_taxonomy( 'comic_anio', 'comic', array(
        'label'        => 'Año',
        'hierarchical' => false,   // etiqueta libre (ej: 1985, 2003...)
        'rewrite'      => array( 'slug' => 'comic-anio' ),
        'show_in_rest' => true
    ));

    // --- AUTOR ---
    register_taxonomy( 'comic_autor', 'comic', array(
        'label'        => 'Autor',
        'hierarchical' => false,   // varios autores como etiquetas
        'rewrite'      => array( 'slug' => 'comic-autor' ),
        'show_in_rest' => true
    ));

    // --- SERIE ---
    register_taxonomy( 'comic_serie', 'comic', array(
        'label'        => 'Serie',
        'hierarchical' => true,    // categoría (ej: Batman > Year One)
        'rewrite'      => array( 'slug' => 'comic-serie' ),
        'show_in_rest' => true
    ));

    // --- UNIVERSO ---
    register_taxonomy( 'comic_universo', 'comic', array(
        'label'        => 'Universo',
        'hierarchical' => true,    // categoría (ej: DC, Marvel, Independiente)
        'rewrite'      => array( 'slug' => 'comic-universo' ),
        'show_in_rest' => true,
    ));

    // --- EDITORIAL ---
    register_taxonomy( 'comic_editorial', 'comic', array(
        'label'        => 'Editorial',
        'hierarchical' => true,    // categoría (ej: DC Comics, Panini...)
        'rewrite'      => array( 'slug' => 'comic-editorial' ),
        'show_in_rest' => true,
    ));

    // --- PERSONAJES ---
    register_taxonomy( 'comic_personajes', 'comic', array(
        'label'        => 'Personajes',
        'hierarchical' => true,   // etiquetas libres (ej: Batman, Joker...)
        'rewrite'      => array( 'slug' => 'comic-personajes' ),
        'show_in_rest' => true,
    ));
}
add_action( 'init', 'comics_registrar_taxonomias' );


/* ============================================
    3. LIMPIAR PERMALINKS AL ACTIVAR
    ============================================
    Evita el error 404 al entrar a un comic
    por primera vez después de instalar.
   ============================================ */

function comics_activar() {
    comics_registrar_cpt();
    comics_registrar_taxonomias();
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'comics_activar' );



// Obtener plantilla de visualización para single y para archive de la ruta del plugin en lugar de la del theme:


/**
 * Carga las plantillas single-comic.php y archive-comic.php
 * desde la carpeta /templates/ del plugin, con fallback al tema.
 */

function comics_cargar_plantilla( $plantilla ) {

    // ¿Es un single de comic?
    $es_single  = is_singular( 'comic' );

    // ¿Es un archivo de comic o de alguna de sus taxonomías?
    $es_archivo = is_post_type_archive( 'comic' )
            || is_tax( array(
                    'comic_anio',
                    'comic_autor',
                    'comic_serie',
                    'comic_universo',
                    'comic_editorial',
                    'comic_personajes',
            ));

    if ( ! $es_single && ! $es_archivo ) {
        return $plantilla; // no es nuestro, devolver sin tocar
    }

    // Nombre del archivo según el tipo
    $archivo = $es_single ? 'single-comic.php' : 'archive-comic.php';

    // 1. Primero busca en el tema (permite al usuario sobreescribir)
    $en_tema = locate_template( $archivo );
    if ( $en_tema ) {
        return $en_tema;
    }

    // 2. Si no existe en el tema, usa la del plugin
    $en_plugin = plugin_dir_path( __FILE__ ) . 'templates/' . $archivo;
    if ( file_exists( $en_plugin ) ) {
        return $en_plugin;
    }

    // 3. Fallback: devuelve la plantilla original de WordPress
    return $plantilla;
}
add_filter( 'template_include', 'comics_cargar_plantilla' );


/*
```

---

## Estructura de carpetas del plugin
```
comics-cpt/
├── comics-cpt.php          ← registro CPT + taxonomías + este filtro
└── templates/
    ├── single-comic.php
    └── archive-comic.php
```

---

## Orden de prioridad
```
1. /wp-content/themes/tu-tema/single-comic.php   ← el tema manda
2. /wp-content/plugins/comics-cpt/templates/     ← fallback del plugin
3. Plantilla por defecto de WordPress             ← último recurso

*/