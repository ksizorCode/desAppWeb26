# Como hacer un Theme en WP

1. Ve a la carpeta del FPT o el lugar donde esté instalado WP
2. En wp-content / themes / crea una nueva carpeta con el nombre de tu nuevo tema, en mi caso será "temazo"
3. crea un index.php en esa carpeta
4. crea un archivo style.css y añade el siguiente código:

Código mínimo:
```css
/*
 * Theme Name:        Temazo
*/
``` 

Código recomendado:
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



5. Puedes añadir una imagen llamada screenshot.jpg o .png para la vista en miniatura en el panel de selección de themas.

Documentación Oficial: https://developer.wordpress.org/themes/core-concepts/theme-structure/


```
/TituloDelTheme
│
├──* style.css              ← Estilo CSS con comentarios anteriores
├──* index.php              ← Aspecto de la pagina de inicio por defecto
├── functions.php          ← Funciones asociadas al theme
│
├── /inc
│   ├── header.php         ← <head>, <header>, navegación y apertura del <html>
│   ├── aside.php          ← <aside> y elementos del menú laterial </aside>
│   └── footer.php         ← <footer>, scripts y cierre del </html>
│
├── single.php              ← Aspecto de un apartado individual como un post o pagina (si no hay page)
├── page.php              ← Aspecto de página
├── 404.php              ← Aspecto del error 404
```



## Listado de funciones de WP:

### Vistas
> Define estructuras para apartados como index.php, single.php, page.php

| Función | Descripción |
|---|---|
| `get_header()` | Carga el contenido del archivo `header.php` del theme |
| `get_footer()` | Carga el contenido del archivo `footer.php` del theme |
| `get_sidebar()` | Carga el contenido del archivo `sidebar.php` del theme |
| `get_template_part('ruta/archivo')` | Carga una parte de template personalizada (ej: `parts/card`) |
| `wp_head()` | Inserta scripts/estilos en el `<head>` — va justo antes de `</head>` en header.php |
| `wp_footer()` | Inserta scripts al final — va justo antes de `</body>` en footer.php |
| `get_search_form()` | Carga el formulario de búsqueda (`searchform.php`) |

---

### En bucles (The Loop)
> Dentro de `if(have_posts()) : while(have_posts()) : the_post();`

| Función | Descripción |
|---|---|
| `the_title()` | Muestra el título del post actual |
| `the_content()` | Muestra el contenido completo del post |
| `the_excerpt()` | Muestra el extracto/resumen del post |
| `the_ID()` | Muestra el ID del post actual |
| `the_permalink()` | Muestra la URL del post actual |
| `the_date()` | Muestra la fecha de publicación |
| `the_author()` | Muestra el nombre del autor |
| `the_category()` | Muestra las categorías del post |
| `the_tags()` | Muestra los tags del post |
| `the_post_thumbnail()` | Muestra la imagen destacada |
| `have_posts()` | Comprueba si hay posts en la consulta |
| `the_post()` | Avanza al siguiente post e inicializa los datos del post |

---

### Funciones de consulta (WP_Query)
| Función | Descripción |
|---|---|
| `get_posts($args)` | Devuelve un array de posts según parámetros |
| `new WP_Query($args)` | Crea una consulta personalizada de posts |
| `wp_reset_postdata()` | Restaura el post global tras un WP_Query personalizado |

---

### Assets (estilos y scripts)
| Función | Descripción |
|---|---|
| `wp_enqueue_style('nombre', get_template_directory_uri().'/style.css')` | Registra y carga una hoja de estilos |
| `wp_enqueue_script('nombre', get_template_directory_uri().'/js/main.js', [], '1.0', true)` | Registra y carga un script JS |
| `get_template_directory_uri()` | Devuelve la URL del directorio del theme activo |
| `get_stylesheet_directory_uri()` | Devuelve la URL del directorio del child theme |

---

### Funciones de usuario y autenticación
| Función | Descripción |
|---|---|
| `is_user_logged_in()` | Comprueba si el usuario está logueado |
| `get_current_user_id()` | Devuelve el ID del usuario actual |
| `wp_get_current_user()` | Devuelve el objeto del usuario actual |

---

### Condicionales útiles
| Función | Descripción |
|---|---|
| `is_home()` | True si es la página principal del blog |
| `is_front_page()` | True si es la portada del sitio |
| `is_single()` | True si es un post individual |
| `is_page()` | True si es una página estática |
| `is_archive()` | True si es una página de archivo |
| `is_category()` | True si es una página de categoría |
| `is_search()` | True si es una página de resultados de búsqueda |
| `is_404()` | True si es una página de error 404 |




home_url()  - url de la pagina de inciio

site_url()  - direccción donde lso elementos están instalados

bloginfo( 'name' ); - nombre del site





