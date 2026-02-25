
# 📌 Apuntes de Programación en WordPress

## Índice
- [Funciones Básicas de WordPress](#funciones-basicas-de-wordpress)
- [Funciones para Trabajar con Entradas (Posts)](#funciones-para-trabajar-con-entradas-posts)
- [Funciones para Trabajar con Páginas](#funciones-para-trabajar-con-paginas)
- [Funciones para Menús](#funciones-para-menus)
- [Funciones para Trabajar con Usuarios](#funciones-para-trabajar-con-usuarios)
- [Funciones para Cargar Archivos y Scripts](#funciones-para-cargar-archivos-y-scripts)
- [Funciones para Trabajar con la Base de Datos](#funciones-para-trabajar-con-la-base-de-datos)
- [Funciones de Seguridad en WordPress](#funciones-de-seguridad-en-wordpress)
- [Qué es un Nonce en WordPress](#que-es-un-nonce-en-wordpress)

---

## 📋 Funciones Básicas de WordPress

### 📌 Obtener Información del Sitio
```php
get_bloginfo( $show );
```

| Función                          | Descripción                                        | Ejemplo                                      |
|---------------------------------|----------------------------------------------------|----------------------------------------------|
| `get_bloginfo('name')`           | Obtiene el nombre del sitio.                       | `echo get_bloginfo('name');`                  |
| `get_bloginfo('description')`    | Obtiene la descripción del sitio.                  | `echo get_bloginfo('description');`           |
| `get_bloginfo('url')`            | Obtiene la URL del sitio.                          | `echo get_bloginfo('url');`                   |
| `get_bloginfo('language')`       | Obtiene el lenguaje del sitio.                     | `echo get_bloginfo('language');`              |
| `get_bloginfo('charset')`        | Obtiene la codificación de caracteres (UTF-8).      | `echo get_bloginfo('charset');`               |
| `get_bloginfo('version')`        | Obtiene la versión de WordPress instalada.         | `echo get_bloginfo('version');`               |

---

## 📌 Funciones para Trabajar con Entradas (Posts)

### 📌 Obtener Información de una Entrada
```php
get_the_title( $post_id );
```

| Función                        | Descripción                                                            | Ejemplo                                |
|--------------------------------|------------------------------------------------------------------------|----------------------------------------|
| `get_the_title()`               | Obtiene el título de la entrada actual.                                | `echo get_the_title();`               |
| `get_permalink()`               | Obtiene la URL de la entrada actual.                                   | `echo get_permalink();`               |
| `get_the_content()`             | Obtiene el contenido de la entrada actual.                             | `echo get_the_content();`             |
| `get_the_post_thumbnail()`      | Obtiene la imagen destacada de la entrada.                             | `echo get_the_post_thumbnail();`      |
| `has_post_thumbnail()`          | Comprueba si la entrada tiene una imagen destacada.                    | `if (has_post_thumbnail()) { echo 'Tiene imagen destacada'; }` |
| `get_the_author()`              | Obtiene el nombre del autor.                                           | `echo get_the_author();`              |
| `get_the_category()`            | Obtiene las categorías asignadas a la entrada.                         | `$categories = get_the_category(); foreach($categories as $cat) { echo $cat->name . ' '; }` |
| `get_the_tags()`                | Obtiene las etiquetas asignadas a la entrada.                          | `$tags = get_the_tags(); foreach($tags as $tag) { echo $tag->name . ' '; }` |
| `get_the_terms()`               | Obtiene los términos de una taxonomía específica para la entrada.      | `$terms = get_the_terms($post->ID, 'taxonomy'); foreach($terms as $term) { echo $term->name . ' '; }` |
| `home_url()`                    | Añade la URL de la página de inicio                                    | `home_url()`                          | 

Ten en cuenta que en muchos casos esto se utilizará dentro de un bucle

### 📌 Bucles en WordPress
🔄 Bucle Principal (The Loop)
```php
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
        echo '<h2>' . get_the_title() . '</h2>';
        the_content();
    }
} else {
    echo 'No hay entradas disponibles.';
}
```

## Funciones para la Creación de Themes y Plantillas

| Función        | Descripción                                 | Ejemplo        |
|----------------|---------------------------------------------|----------------|
| `get_header()` | Carga el encabezado de la plantilla.        | get_header();  |
| `get_footer()` | Carga el pie de página de la plantilla.     | get_footer();  |
| `get_sidebar()`| Carga la barra lateral.                     | get_sidebar(); |
| `wp_head()`    | Agrega elementos en <head>.                 | wp_head();     |
| `wp_footer()   | Agrega elementos antes del cierre de <body>.| wp_footer();   |
| ` get_search_form()` | Agrega campo del buscador | get_search_form();|

---

### 📌 Creación de una Página 404 Personalizada

Si deseas personalizar la página de error 404 de tu sitio en WordPress, puedes crear un archivo `404.php` en tu tema y usar las siguientes funciones:
```php
<?php get_header(); ?>

<div class="container">
    <h1>¡Oops! Página no encontrada 😕</h1>
    <p>Lo sentimos, pero la página que buscas no existe. Puedes volver a la <a href="<?php echo home_url(); ?>">página de inicio</a> o usar la búsqueda.</p>
    <?php get_search_form(); ?>
</div>

<?php get_footer(); ?>
```
### 📌 Crear un Shortcode para Mostrar un Mensaje Personalizado

Puedes crear un shortcode en WordPress para mostrar un mensaje especial en cualquier parte de tu sitio:
```php
function mensaje_personalizado() {
    return '<p>📌 Este es un mensaje dinámico generado con un shortcode.</p>';
}
add_shortcode('mensaje', 'mensaje_personalizado');
```


## 📌 Funciones para Trabajar con Páginas
| Función          | Descripción                     | Ejemplo                                  |
|------------------|---------------------------------|------------------------------------------|
| `wp_list_pages()`| Muestra una lista de páginas.   | `wp_list_pages(['title_li' => '']);`     |
| `get_page_by_path()` | Obtiene una página por su slug. | `$page = get_page_by_path('contacto'); echo $page->post_title;` |

---

## 📌 Funciones para Menús
| Función          | Descripción                     | Ejemplo                                  |
|------------------|---------------------------------|------------------------------------------|
| `wp_nav_menu()`  | Muestra un menú de WordPress.   | `wp_nav_menu(['theme_location' => 'main-menu']);` |

---

## 📌 Funciones para Trabajar con Usuarios
| Función                | Descripción                            | Ejemplo                                      |
|------------------------|----------------------------------------|----------------------------------------------|
| `wp_get_current_user()`| Obtiene los datos del usuario logueado. | `$user = wp_get_current_user(); echo $user->user_login;` |
| `get_user_by()`        | Obtiene un usuario por un campo específico. | `$user = get_user_by('email', 'admin@example.com'); echo $user->ID;` |

---

## 📌 Funciones para Cargar Archivos y Scripts
| Función              | Descripción                            | Ejemplo                                      |
|----------------------|----------------------------------------|----------------------------------------------|
| `wp_enqueue_script()`| Carga un script en el sitio.           | `wp_enqueue_script('mi-script', get_template_directory_uri().'/js/mi-script.js', [], '1.0', true);` |
| `wp_enqueue_style()` | Carga un archivo CSS en el sitio.      | `wp_enqueue_style('mi-estilo', get_stylesheet_uri());` |

---

## 📌 Funciones para Trabajar con la Base de Datos
| Función                | Descripción                            | Ejemplo                                      |
|------------------------|----------------------------------------|----------------------------------------------|
| `$wpdb->get_results()` | Obtiene datos de la base de datos.     | `$resultados = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_status = 'publish'");` |
| `$wpdb->insert()`      | Inserta datos en la base de datos.     | `$wpdb->insert($wpdb->posts, ['post_title' => 'Nuevo Post', 'post_status' => 'draft']);` |

---

## 📌 Qué es un Nonce en WordPress

Un **nonce** (*Number Once*) es un token de seguridad que se utiliza para validar la autenticidad de las solicitudes en WordPress. Su objetivo es proteger formularios y acciones específicas contra ataques CSRF (*Cross-Site Request Forgery*).

### Ejemplo de Uso de Nonce
```php
// Generar un nonce en un formulario
function mi_formulario() {
    echo '<form method="post" action="">';
    wp_nonce_field('guardar_datos', 'mi_nonce');
    echo '<input type="submit" value="Enviar">';
    echo '</form>';
}

// Verificar el nonce al procesar el formulario
if (isset($_POST['mi_nonce']) && wp_verify_nonce($_POST['mi_nonce'], 'guardar_datos')) {
    echo 'Nonce verificado correctamente.';
} else {
    echo 'Error: Nonce no válido.';
}
```
