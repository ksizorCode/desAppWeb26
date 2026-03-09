## 1. Crear un Tema desde Cero

### Pasos básicos

1. Ve a la carpeta del FTP o donde esté instalado WP
2. En `wp-content/themes/` crea una nueva carpeta con el nombre del tema (ej: `temazo`)
3. Crea `index.php` (obligatorio — página de inicio por defecto)
4. Crea `style.css` con la cabecera del tema
5. (Opcional) Añade `screenshot.png` o `screenshot.jpg` para la miniatura en el panel de temas

### `style.css` — Cabecera del tema

**Mínimo obligatorio:**
```css
/*
 * Theme Name: Temazo
*/
```

**Recomendado:**
```css
/**
 * Theme Name:        Temazo
 * Theme URI:         https://dicampus.es
 * Description:       Tema super chulo que se va a convertir en un temazo
 * Version:           1.0.0
 * Author:            Miguelin
 * Author URI:        https://miguelesteban.net
 * Tags:              block-patterns, full-site-editing
 * Text Domain:       me-temazo
 * Domain Path:       /assets/lang
 * Tested up to:      6.4
 * Requires at least: 6.2
 * Requires PHP:      7.4
 * License:           GNU General Public License v2.0 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */
```

> 📖 Documentación oficial: https://developer.wordpress.org/themes/core-concepts/theme-structure/

---

## 2. Estructura de Archivos

```
/TituloDelTheme
│
├──* style.css              ← Cabecera CSS del tema (obligatorio)
├──* index.php              ← Página de inicio por defecto (obligatorio)
├── functions.php           ← Funciones, hooks y enqueue de assets
│
│   # Bloques de maquetado
├── header.php              ← <head>, <header>, navegación y apertura del <html>
├── sidebar.php             ← <aside> y elementos del menú lateral
├── footer.php              ← <footer>, scripts y cierre del </html>
│
│   # Jerarquía de plantillas
├── front-page.php          ← Portada estática del sitio (mayor prioridad)
├── home.php                ← Página principal del blog
├── single.php              ← Post individual
├── page.php                ← Página estática
├── archive.php             ← Páginas de archivo (categorías, tags, fechas)
├── category.php            ← Páginas de categoría (mayor prioridad que archive)
├── tag.php                 ← Páginas de etiqueta
├── search.php              ← Resultados de búsqueda
├── 404.php                 ← Página de error 404
│
│   # Directorios opcionales
├── assets/
│   ├── css/
│   ├── js/
│   ├── img/
│   └── lang/               ← Archivos de traducción (.pot, .po, .mo)
├── parts/                  ← Partes reutilizables (cards, banners, etc.)
└── templates/              ← Plantillas de página personalizadas
    ├── bonita.php
    └── dos-columnas.php

* obligatorios
```

### Jerarquía de plantillas (orden de prioridad)

WordPress busca el archivo más específico. Por ejemplo, para una categoría con slug `noticias`:

```
category-noticias.php → category-5.php → category.php → archive.php → index.php
```

> 📖 Ver jerarquía completa: https://developer.wordpress.org/themes/basics/template-hierarchy/

---

## 3. Plantillas de Página Personalizadas

Las plantillas permiten asignar un diseño distinto a páginas concretas desde el panel de administración (`Página → Atributos → Plantilla`).

```php
<?php
/*
 * Template Name: Nombre de mi plantilla
 * Template Post Type: page, post  ← (opcional) tipos donde aplica
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();
    the_content();
endwhile; endif;

get_footer();
?>
```

---

## 4. `functions.php` — Funciones del Tema

Este archivo es el núcleo de configuración del tema. Se ejecuta automáticamente al cargar el tema.

### Estructura básica recomendada

```php
<?php

/**
 * Configuración inicial del tema
 */
function temazo_setup() {
    // Soporte para imágenes destacadas
    add_theme_support( 'post-thumbnails' );

    // Soporte para título dinámico en <head>
    add_theme_support( 'title-tag' );

    // Soporte para HTML5 en formularios, galerías, etc.
    add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption' ] );

    // Menús de navegación
    register_nav_menus([
        'primary'   => __( 'Menú principal', 'me-temazo' ),
        'footer'    => __( 'Menú del pie', 'me-temazo' ),
    ]);

    // Internacionalización
    load_theme_textdomain( 'me-temazo', get_template_directory() . '/assets/lang' );
}
add_action( 'after_setup_theme', 'temazo_setup' );


/**
 * Registrar y cargar estilos y scripts
 */
function temazo_assets() {
    wp_enqueue_style(
        'temazo-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );

    wp_enqueue_script(
        'temazo-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [ 'jquery' ],   // dependencias
        '1.0.0',
        true            // cargar en el footer
    );
}
add_action( 'wp_enqueue_scripts', 'temazo_assets' );
```

---

## 5. `header.php` — Estructura básica

```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); // ← OBLIGATORIO: carga scripts y estilos de WP ?>
</head>
<body <?php body_class(); ?>>

<header>
    <a href="<?php echo home_url('/'); ?>">
        <?php bloginfo('name'); ?>
    </a>
    <nav>
        <?php
        wp_nav_menu([
            'theme_location' => 'primary',
            'menu_class'     => 'nav-menu',
        ]);
        ?>
    </nav>
</header>
```

---

## 6. `footer.php` — Estructura básica

```php
<footer>
    <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?></p>
</footer>

<?php wp_footer(); // ← OBLIGATORIO: carga scripts del footer ?>
</body>
</html>
```

---

## 7. The Loop — Bucle principal de WP

El bucle es el mecanismo central para mostrar contenido.

```php
<?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p class="meta">
                Por <?php the_author(); ?> | <?php the_date(); ?>
            </p>
            <?php the_post_thumbnail('medium'); ?>
            <?php the_excerpt(); ?>
        </article>

    <?php endwhile; ?>

    <?php the_posts_pagination(); // ← paginación ?>

<?php else : ?>
    <p>No se encontraron resultados.</p>
<?php endif; ?>
```

---

## 8. WP_Query — Consultas personalizadas

```php
<?php
$args = [
    'post_type'      => 'post',
    'posts_per_page' => 6,
    'category_name'  => 'noticias',
    'orderby'        => 'date',
    'order'          => 'DESC',
    'meta_key'       => '_destacado',    // filtro por campo personalizado
    'meta_value'     => '1',
];

$query = new WP_Query( $args );

if ( $query->have_posts() ) :
    while ( $query->have_posts() ) : $query->the_post();
        // contenido
    endwhile;
    wp_reset_postdata(); // ← SIEMPRE al finalizar un WP_Query personalizado
endif;
?>
```

### Parámetros comunes de WP_Query

| Parámetro | Valores / Ejemplo |
|---|---|
| `post_type` | `'post'`, `'page'`, `'any'`, CPTs |
| `posts_per_page` | número, `-1` para todos |
| `post_status` | `'publish'`, `'draft'`, `'any'` |
| `orderby` | `'date'`, `'title'`, `'menu_order'`, `'rand'` |
| `order` | `'ASC'`, `'DESC'` |
| `category_name` | slug de la categoría |
| `tag` | slug del tag |
| `author` | ID del autor |
| `s` | término de búsqueda |
| `paged` | número de página para paginación |

---

## 9. Referencia de Funciones

### Vistas y plantillas

| Función | Descripción |
|---|---|
| `get_header()` | Carga `header.php` |
| `get_footer()` | Carga `footer.php` |
| `get_sidebar()` | Carga `sidebar.php` |
| `get_template_part('parts/card')` | Carga una parte de template personalizada |
| `wp_head()` | Inserta scripts/estilos en `<head>` — va antes de `</head>` |
| `wp_footer()` | Inserta scripts al final — va antes de `</body>` |
| `get_search_form()` | Carga el formulario de búsqueda (`searchform.php`) |
| `body_class()` | Añade clases CSS dinámicas al `<body>` |
| `post_class()` | Añade clases CSS dinámicas al elemento del post |

---

### Dentro del bucle (The Loop)

| Función | Descripción |
|---|---|
| `the_title()` | Muestra el título del post |
| `get_the_title()` | Devuelve el título (para usar en variables) |
| `the_content()` | Muestra el contenido completo |
| `the_excerpt()` | Muestra el extracto / resumen |
| `the_ID()` | Muestra el ID del post |
| `get_the_ID()` | Devuelve el ID (para usar en variables) |
| `the_permalink()` | Muestra la URL del post |
| `get_permalink()` | Devuelve la URL (para usar en variables) |
| `the_date()` | Muestra la fecha de publicación |
| `get_the_date('d/m/Y')` | Devuelve la fecha con formato personalizado |
| `the_author()` | Muestra el nombre del autor |
| `the_category()` | Muestra las categorías |
| `the_tags()` | Muestra las etiquetas |
| `the_post_thumbnail('medium')` | Muestra la imagen destacada (tamaños: `thumbnail`, `medium`, `large`, `full`) |
| `get_the_post_thumbnail_url()` | Devuelve la URL de la imagen destacada |
| `have_posts()` | Comprueba si hay posts |
| `the_post()` | Avanza al siguiente post |

---

### Consultas

| Función | Descripción |
|---|---|
| `get_posts($args)` | Devuelve array de posts |
| `new WP_Query($args)` | Crea una consulta personalizada |
| `wp_reset_postdata()` | Restaura el post global tras WP_Query personalizado |
| `get_queried_object()` | Devuelve el objeto de la consulta actual (categoría, tag, etc.) |

---

### Assets (estilos y scripts)

| Función | Descripción |
|---|---|
| `wp_enqueue_style('id', $url)` | Registra y carga un CSS |
| `wp_enqueue_script('id', $url, $deps, $ver, $footer)` | Registra y carga un JS |
| `wp_dequeue_style('id')` | Elimina un CSS registrado |
| `wp_dequeue_script('id')` | Elimina un JS registrado |
| `get_template_directory_uri()` | URL del directorio del tema activo |
| `get_stylesheet_directory_uri()` | URL del directorio del child theme |
| `get_template_directory()` | Ruta absoluta del servidor al tema |
| `get_stylesheet_uri()` | URL del `style.css` del tema activo |

---

### URLs y rutas del sitio

| Función | Descripción |
|---|---|
| `home_url('/')` | URL de la página de inicio |
| `get_home_url()` | Igual que la anterior |
| `site_url()` | URL donde está instalado WP (puede diferir de home_url) |
| `admin_url()` | URL del panel de administración |
| `get_theme_file_uri('img/logo.png')` | URL de un archivo dentro del tema |
| `get_theme_file_path('img/logo.png')` | Ruta de servidor de un archivo dentro del tema |

---

### Información del sitio

| Función | Descripción |
|---|---|
| `bloginfo('name')` | Nombre del sitio |
| `bloginfo('description')` | Descripción del sitio |
| `bloginfo('charset')` | Charset (ej: UTF-8) |
| `get_bloginfo('name')` | Devuelve el nombre como variable |
| `get_bloginfo('url')` | Devuelve la URL del sitio |
| `language_attributes()` | Atributos de idioma para `<html>` (ej: `lang="es-ES"`) |

---

### Usuario y autenticación

| Función | Descripción |
|---|---|
| `is_user_logged_in()` | True si el usuario está logueado |
| `get_current_user_id()` | ID del usuario actual |
| `wp_get_current_user()` | Objeto completo del usuario actual |
| `current_user_can('edit_posts')` | Comprueba si el usuario tiene un permiso |

---

### Condicionales

| Función | Descripción |
|---|---|
| `is_home()` | True si es la página principal del blog |
| `is_front_page()` | True si es la portada del sitio |
| `is_single()` | True si es un post individual |
| `is_page()` | True si es una página estática |
| `is_page('about')` | True si es una página concreta (por slug, ID o título) |
| `is_archive()` | True si es una página de archivo |
| `is_category()` | True si es una página de categoría |
| `is_tag()` | True si es una página de etiqueta |
| `is_search()` | True si es una página de resultados de búsqueda |
| `is_404()` | True si es la página de error 404 |
| `is_singular()` | True si es cualquier post/página individual |
| `is_admin()` | True si se está en el panel de administración |

---

## 10. Child Themes (Temas Hijo)

Un child theme hereda todo el tema padre y permite personalizarlo sin perder cambios al actualizar.

**Estructura mínima:**

```
/temazo-child
├── style.css
└── functions.php
```

**`style.css` del child theme:**
```css
/*
 * Theme Name:  Temazo Child
 * Template:    temazo         ← nombre de la carpeta del tema padre (obligatorio)
 * Version:     1.0.0
*/
```

**`functions.php` del child theme:**
```php
<?php
function temazo_child_assets() {
    // Cargar estilos del padre primero
    wp_enqueue_style(
        'temazo-parent',
        get_template_directory_uri() . '/style.css'
    );
}
add_action( 'wp_enqueue_scripts', 'temazo_child_assets' );
```

---

## 11. Hooks: Actions y Filters

Los hooks son el sistema de eventos de WordPress. Permiten modificar el comportamiento sin tocar el núcleo.

### Actions — ejecutar código en un momento concreto

```php
// Añadir una función a un hook de acción
add_action( 'wp_footer', 'mi_funcion' );

function mi_funcion() {
    echo '<p>Texto añadido en el footer</p>';
}

// Con prioridad (menor número = antes; por defecto 10)
add_action( 'wp_footer', 'mi_funcion', 5 );
```

### Filters — modificar un valor antes de mostrarlo

```php
// Añadir texto al final de cada extracto
add_filter( 'the_excerpt', 'mi_excerpto_personalizado' );

function mi_excerpto_personalizado( $excerpt ) {
    return $excerpt . '<a href="' . get_permalink() . '">Leer más</a>';
}
```

### Hooks más usados en temas

| Hook | Tipo | Descripción |
|---|---|---|
| `after_setup_theme` | Action | Configuración inicial del tema |
| `wp_enqueue_scripts` | Action | Cargar CSS y JS en el front-end |
| `wp_head` | Action | Insertar código en `<head>` |
| `wp_footer` | Action | Insertar código antes de `</body>` |
| `init` | Action | Se ejecuta al inicializar WP |
| `the_content` | Filter | Modifica el contenido del post |
| `the_title` | Filter | Modifica el título del post |
| `the_excerpt` | Filter | Modifica el extracto |
| `body_class` | Filter | Añade clases al `<body>` |
| `excerpt_length` | Filter | Cambia la longitud del extracto |

---

## 12. Campos Personalizados (Custom Fields / Meta)

```php
// Guardar un campo personalizado
update_post_meta( $post_id, 'nombre_campo', $valor );

// Obtener un campo personalizado
$valor = get_post_meta( $post_id, 'nombre_campo', true );

// Mostrar en el loop
$subtitulo = get_post_meta( get_the_ID(), 'subtitulo', true );
if ( $subtitulo ) {
    echo '<p class="subtitulo">' . esc_html( $subtitulo ) . '</p>';
}
```

---

## 13. Widgets y Sidebars

Registro de una sidebar en `functions.php`:

```php
function temazo_widgets_init() {
    register_sidebar([
        'name'          => 'Barra lateral principal',
        'id'            => 'sidebar-1',
        'description'   => 'Añade widgets aquí.',
        'before_widget' => '<section class="widget">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action( 'widgets_init', 'temazo_widgets_init' );
```

En `sidebar.php`:

```php
<?php if ( is_active_sidebar('sidebar-1') ) : ?>
    <aside>
        <?php dynamic_sidebar('sidebar-1'); ?>
    </aside>
<?php endif; ?>
```

---

## 14. Escapado y Seguridad

> ⚠️ Siempre escapar los datos antes de mostrarlos para evitar XSS.

| Función | Uso |
|---|---|
| `esc_html( $texto )` | Escapa para mostrar texto en HTML |
| `esc_attr( $valor )` | Escapa para usar en atributos HTML |
| `esc_url( $url )` | Escapa URLs |
| `esc_js( $texto )` | Escapa para usar en JavaScript |
| `wp_kses_post( $html )` | Permite solo HTML seguro (como en posts) |
| `sanitize_text_field( $input )` | Limpia texto de entrada del usuario |

---

## 15. Internacionalización (i18n)

Para hacer el tema traducible, usa estas funciones en lugar de texto directo:

```php
// Mostrar texto traducible
_e( 'Leer más', 'me-temazo' );

// Obtener texto traducible como variable
$texto = __( 'Leer más', 'me-temazo' );

// Con variable dentro del texto
$msg = sprintf( __( 'Escrito por %s', 'me-temazo' ), get_the_author() );

// Singular / plural
$count = 3;
printf( _n( '%d comentario', '%d comentarios', $count, 'me-temazo' ), $count );
```

---

## 16. Recursos y Documentación

| Recurso | URL |
|---|---|
| Documentación de temas | https://developer.wordpress.org/themes/ |
| Jerarquía de plantillas | https://developer.wordpress.org/themes/basics/template-hierarchy/ |
| Referencia de funciones | https://developer.wordpress.org/reference/ |
| Hooks reference | https://developer.wordpress.org/reference/hooks/ |
| WP_Query | https://developer.wordpress.org/reference/classes/wp_query/ |
| Theme Unit Test | https://codex.wordpress.org/Theme_Unit_Test |