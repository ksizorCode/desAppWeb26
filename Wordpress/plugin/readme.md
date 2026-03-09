# 🔌 Desarrollo de Plugins en WordPress — Apuntes Completos

---

## 1. ¿Qué es un Plugin?

Un plugin es un paquete de código PHP que extiende o modifica la funcionalidad de WordPress **sin tocar el núcleo**. Se activa/desactiva desde el panel de administración sin afectar a otros componentes.

**Diferencia clave con los temas:**
- Los **temas** controlan el aspecto visual.
- Los **plugins** controlan la funcionalidad.
- Un tema **no debería** añadir funcionalidad que el usuario quiera conservar si cambia de tema — eso va en un plugin.

---

## 2. Estructura mínima

```
wp-content/plugins/
└── mi-plugin/
    ├── mi-plugin.php       ← archivo principal (obligatorio)
    ├── uninstall.php       ← limpieza al desinstalar (recomendado)
    ├── includes/           ← clases y lógica PHP
    ├── admin/              ← vistas y lógica del panel de admin
    ├── public/             ← assets y lógica del front-end
    └── assets/
        ├── css/
        └── js/
```

> ⚠️ El plugin puede ser un único archivo `.php` dentro de `wp-content/plugins/` si es sencillo, pero la estructura de carpeta es recomendada.

---

## 3. Archivo principal — Cabecera obligatoria

```php
<?php
/**
 * Plugin Name:       Mi Plugin
 * Plugin URI:        https://miplugin.com
 * Description:       Descripción breve de lo que hace el plugin.
 * Version:           1.0.0
 * Author:            Tu Nombre
 * Author URI:        https://tupagina.com
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mi-plugin
 * Domain Path:       /languages
 * Requires at least: 6.0
 * Requires PHP:      7.4
 */

// Seguridad: evitar acceso directo al archivo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
```

> ⚠️ `if ( ! defined( 'ABSPATH' ) ) exit;` debe estar en **todos** los archivos PHP del plugin.

---

## 4. Constantes útiles del plugin

Definir constantes al inicio facilita el acceso a rutas y URLs en todo el plugin.

```php
define( 'MI_PLUGIN_VERSION',  '1.0.0' );
define( 'MI_PLUGIN_DIR',      plugin_dir_path( __FILE__ ) );   // ruta absoluta del servidor
define( 'MI_PLUGIN_URL',      plugin_dir_url( __FILE__ ) );    // URL pública del plugin
define( 'MI_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );   // 'mi-plugin/mi-plugin.php'
```

---

## 5. Hooks: Actions y Filters

Los hooks son la base del desarrollo de plugins. Permiten "engancharse" al ciclo de ejecución de WP.

### Actions — ejecutar código en un momento concreto

```php
// Sintaxis
add_action( 'nombre_del_hook', 'mi_funcion', $prioridad, $num_args );

// Ejemplo
add_action( 'init', 'mi_plugin_init' );
function mi_plugin_init() {
    // código que se ejecuta al inicializar WP
}

// Con prioridad (por defecto 10; menor = antes)
add_action( 'wp_footer', 'mi_funcion', 5 );

// Eliminar un action (misma prioridad que al añadirlo)
remove_action( 'wp_footer', 'mi_funcion', 5 );
```

### Filters — modificar un valor

```php
// Sintaxis
add_filter( 'nombre_del_hook', 'mi_filtro', $prioridad, $num_args );

// Ejemplo: añadir texto al final del contenido
add_filter( 'the_content', 'mi_plugin_contenido' );
function mi_plugin_contenido( $content ) {
    $content .= '<p>Texto añadido por mi plugin.</p>';
    return $content; // ← SIEMPRE devolver el valor en filters
}

// Eliminar un filter
remove_filter( 'the_content', 'mi_plugin_contenido' );
```

### Crear hooks propios

```php
// Definir un action personalizado en tu plugin
do_action( 'mi_plugin_despues_de_guardar', $post_id, $data );

// Definir un filter personalizado en tu plugin
$resultado = apply_filters( 'mi_plugin_precio', $precio, $producto_id );

// Otros desarrolladores pueden engancharse:
add_action( 'mi_plugin_despues_de_guardar', function( $post_id, $data ) {
    // código externo
}, 10, 2 );
```

---

## 6. Hooks de activación, desactivación y desinstalación

```php
// Activación — se ejecuta UNA VEZ al activar el plugin
register_activation_hook( __FILE__, 'mi_plugin_activar' );
function mi_plugin_activar() {
    // crear tablas, opciones por defecto, etc.
    add_option( 'mi_plugin_version', MI_PLUGIN_VERSION );
    flush_rewrite_rules(); // si el plugin registra CPTs o rewrite rules
}

// Desactivación — se ejecuta al desactivar (el plugin sigue instalado)
register_deactivation_hook( __FILE__, 'mi_plugin_desactivar' );
function mi_plugin_desactivar() {
    // limpiar tareas programadas (wp_cron), etc.
    flush_rewrite_rules();
}
```

**`uninstall.php`** — se ejecuta al borrar el plugin desde el panel:

```php
<?php
// uninstall.php
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit; // seguridad
}

// Borrar opciones de la base de datos
delete_option( 'mi_plugin_version' );
delete_option( 'mi_plugin_ajustes' );

// Borrar tablas personalizadas
global $wpdb;
$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mi_tabla" );
```

---

## 7. Opciones — Settings API

### Guardar y recuperar opciones simples

```php
// Guardar
update_option( 'mi_plugin_color', '#ff0000' );

// Recuperar (con valor por defecto)
$color = get_option( 'mi_plugin_color', '#000000' );

// Borrar
delete_option( 'mi_plugin_color' );

// Opciones en array
update_option( 'mi_plugin_ajustes', [
    'color'    => '#ff0000',
    'activado' => true,
    'limite'   => 10,
]);
$ajustes = get_option( 'mi_plugin_ajustes', [] );
```

### Página de ajustes completa con Settings API

```php
// 1. Añadir la página al menú de admin
add_action( 'admin_menu', 'mi_plugin_menu' );
function mi_plugin_menu() {
    add_options_page(
        'Ajustes de Mi Plugin',  // título de la página
        'Mi Plugin',             // texto en el menú
        'manage_options',        // capacidad requerida
        'mi-plugin',             // slug único
        'mi_plugin_pagina'       // función que renderiza la página
    );
}

// 2. Registrar ajustes
add_action( 'admin_init', 'mi_plugin_register_settings' );
function mi_plugin_register_settings() {
    register_setting( 'mi_plugin_grupo', 'mi_plugin_ajustes', [
        'sanitize_callback' => 'mi_plugin_sanitize',
    ]);

    add_settings_section(
        'mi_plugin_seccion_general',
        'Configuración General',
        '__return_false',
        'mi-plugin'
    );

    add_settings_field(
        'color',
        'Color principal',
        'mi_plugin_field_color',
        'mi-plugin',
        'mi_plugin_seccion_general'
    );
}

// 3. Renderizar un campo
function mi_plugin_field_color() {
    $ajustes = get_option( 'mi_plugin_ajustes', [] );
    $color   = isset( $ajustes['color'] ) ? $ajustes['color'] : '#000000';
    echo '<input type="color" name="mi_plugin_ajustes[color]" value="' . esc_attr( $color ) . '">';
}

// 4. Sanitizar al guardar
function mi_plugin_sanitize( $input ) {
    $output = [];
    $output['color'] = sanitize_hex_color( $input['color'] ?? '#000000' );
    return $output;
}

// 5. Renderizar la página
function mi_plugin_pagina() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    ?>
    <div class="wrap">
        <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields( 'mi_plugin_grupo' );
            do_settings_sections( 'mi-plugin' );
            submit_button();
            ?>
        </form>
    </div>
    <?php
}
```

---

## 8. Custom Post Types (CPT)

```php
add_action( 'init', 'mi_plugin_register_cpt' );
function mi_plugin_register_cpt() {
    $labels = [
        'name'               => 'Productos',
        'singular_name'      => 'Producto',
        'add_new_item'       => 'Añadir producto',
        'edit_item'          => 'Editar producto',
        'not_found'          => 'No se encontraron productos',
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ],
        'rewrite'            => [ 'slug' => 'productos' ],
        'menu_icon'          => 'dashicons-cart',
        'show_in_rest'       => true, // necesario para el editor Gutenberg
    ];

    register_post_type( 'producto', $args );
}
```

---

## 9. Custom Taxonomies

```php
add_action( 'init', 'mi_plugin_register_taxonomy' );
function mi_plugin_register_taxonomy() {
    $labels = [
        'name'          => 'Categorías de Producto',
        'singular_name' => 'Categoría de Producto',
    ];

    $args = [
        'labels'       => $labels,
        'hierarchical' => true,     // true = como categorías / false = como tags
        'public'       => true,
        'rewrite'      => [ 'slug' => 'categoria-producto' ],
        'show_in_rest' => true,
    ];

    register_taxonomy( 'categoria_producto', [ 'producto' ], $args );
}
```

---

## 10. Tablas personalizadas en la base de datos

```php
// Crear tabla al activar el plugin
register_activation_hook( __FILE__, 'mi_plugin_crear_tabla' );
function mi_plugin_crear_tabla() {
    global $wpdb;

    $tabla   = $wpdb->prefix . 'mi_tabla';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $tabla (
        id          BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id     BIGINT(20) UNSIGNED NOT NULL,
        titulo      VARCHAR(255) NOT NULL,
        contenido   LONGTEXT,
        creado_en   DATETIME DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY user_id (user_id)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql ); // crea o actualiza la tabla de forma segura
}
```

### CRUD con $wpdb

```php
global $wpdb;
$tabla = $wpdb->prefix . 'mi_tabla';

// INSERT
$wpdb->insert( $tabla, [
    'user_id'   => get_current_user_id(),
    'titulo'    => 'Mi título',
    'contenido' => 'Contenido aquí',
], [ '%d', '%s', '%s' ] ); // formatos: %d=int, %s=string, %f=float

$nuevo_id = $wpdb->insert_id;

// SELECT — SIEMPRE usar prepare() con datos externos
$resultados = $wpdb->get_results(
    $wpdb->prepare( "SELECT * FROM $tabla WHERE user_id = %d", $user_id )
);

// SELECT — una sola fila
$fila = $wpdb->get_row(
    $wpdb->prepare( "SELECT * FROM $tabla WHERE id = %d", $id )
);

// SELECT — un solo valor
$total = $wpdb->get_var( "SELECT COUNT(*) FROM $tabla" );

// UPDATE
$wpdb->update( $tabla,
    [ 'titulo' => 'Nuevo título' ],   // datos
    [ 'id' => $id ],                  // WHERE
    [ '%s' ],                         // formato datos
    [ '%d' ]                          // formato WHERE
);

// DELETE
$wpdb->delete( $tabla, [ 'id' => $id ], [ '%d' ] );
```

> ⚠️ **Nunca** construir queries con datos del usuario sin `$wpdb->prepare()`. Evita inyección SQL.

---

## 11. AJAX en WordPress

### PHP — registrar endpoints AJAX

```php
// Para usuarios logueados
add_action( 'wp_ajax_mi_accion', 'mi_plugin_ajax_handler' );

// Para usuarios no logueados también
add_action( 'wp_ajax_nopriv_mi_accion', 'mi_plugin_ajax_handler' );

function mi_plugin_ajax_handler() {
    // Verificar nonce (seguridad)
    check_ajax_referer( 'mi_plugin_nonce', 'nonce' );

    // Verificar permisos
    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error( 'Sin permisos', 403 );
    }

    // Recoger datos del POST
    $dato = sanitize_text_field( $_POST['dato'] ?? '' );

    // Lógica...
    $resultado = [ 'mensaje' => 'OK', 'dato' => $dato ];

    wp_send_json_success( $resultado ); // devuelve JSON y termina
}
```

### PHP — pasar datos al JS con wp_localize_script

```php
add_action( 'wp_enqueue_scripts', 'mi_plugin_assets' );
function mi_plugin_assets() {
    wp_enqueue_script( 'mi-plugin-js', MI_PLUGIN_URL . 'assets/js/main.js', [ 'jquery' ], '1.0', true );

    // Pasar variables PHP → JS
    wp_localize_script( 'mi-plugin-js', 'miPlugin', [
        'ajaxUrl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'mi_plugin_nonce' ),
        'textos'  => [
            'cargando' => __( 'Cargando...', 'mi-plugin' ),
            'error'    => __( 'Ha ocurrido un error.', 'mi-plugin' ),
        ],
    ]);
}
```

### JavaScript — llamada AJAX

```javascript
// assets/js/main.js
jQuery(document).ready(function ($) {

    $('#mi-boton').on('click', function () {
        $.ajax({
            url:  miPlugin.ajaxUrl,
            type: 'POST',
            data: {
                action: 'mi_accion',       // debe coincidir con el hook wp_ajax_*
                nonce:  miPlugin.nonce,
                dato:   'valor de ejemplo',
            },
            beforeSend: function () {
                console.log(miPlugin.textos.cargando);
            },
            success: function (response) {
                if (response.success) {
                    console.log(response.data);
                } else {
                    console.error(response.data);
                }
            },
            error: function () {
                console.error(miPlugin.textos.error);
            }
        });
    });

});
```

---

## 12. Shortcodes

Los shortcodes permiten a los usuarios insertar funcionalidad del plugin directamente en el contenido con `[mi_shortcode]`.

```php
// Registrar
add_shortcode( 'mi_shortcode', 'mi_plugin_shortcode' );

function mi_plugin_shortcode( $atts, $content = null ) {
    // Atributos con valores por defecto
    $atts = shortcode_atts([
        'color'  => 'blue',
        'limite' => 5,
        'titulo' => 'Listado',
    ], $atts, 'mi_shortcode' );

    // Uso: [mi_shortcode color="red" limite="3" titulo="Mis posts"]
    ob_start(); // capturar HTML en buffer
    ?>
    <div class="mi-plugin-wrapper" style="color: <?php echo esc_attr( $atts['color'] ); ?>">
        <h3><?php echo esc_html( $atts['titulo'] ); ?></h3>
        <?php if ( $content ) : ?>
            <div class="contenido"><?php echo wp_kses_post( $content ); ?></div>
        <?php endif; ?>
    </div>
    <?php
    return ob_get_clean(); // devolver (no hacer echo)
}
```

> ⚠️ Los shortcodes siempre deben usar `return`, **nunca `echo`**.

---

## 13. Meta Boxes (campos en el editor de posts)

```php
// 1. Registrar la meta box
add_action( 'add_meta_boxes', 'mi_plugin_add_meta_box' );
function mi_plugin_add_meta_box() {
    add_meta_box(
        'mi_plugin_meta',          // ID único
        'Datos adicionales',       // título
        'mi_plugin_render_meta',   // función que renderiza
        [ 'post', 'page' ],        // tipos de post donde aparece
        'normal',                  // contexto: normal, side, advanced
        'high'                     // prioridad: high, default, low
    );
}

// 2. Renderizar la meta box
function mi_plugin_render_meta( $post ) {
    // Nonce para seguridad
    wp_nonce_field( 'mi_plugin_meta_nonce', 'mi_plugin_nonce' );

    $subtitulo = get_post_meta( $post->ID, '_mi_plugin_subtitulo', true );
    ?>
    <label for="mi_plugin_subtitulo">Subtítulo:</label>
    <input type="text"
           id="mi_plugin_subtitulo"
           name="mi_plugin_subtitulo"
           value="<?php echo esc_attr( $subtitulo ); ?>"
           style="width:100%">
    <?php
}

// 3. Guardar al publicar / actualizar
add_action( 'save_post', 'mi_plugin_save_meta' );
function mi_plugin_save_meta( $post_id ) {
    // Verificaciones de seguridad
    if ( ! isset( $_POST['mi_plugin_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['mi_plugin_nonce'], 'mi_plugin_meta_nonce' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Guardar
    if ( isset( $_POST['mi_plugin_subtitulo'] ) ) {
        update_post_meta(
            $post_id,
            '_mi_plugin_subtitulo',
            sanitize_text_field( $_POST['mi_plugin_subtitulo'] )
        );
    }
}
```

---

## 14. REST API

WP tiene una REST API integrada. Los plugins pueden registrar endpoints propios.

```php
add_action( 'rest_api_init', 'mi_plugin_register_routes' );
function mi_plugin_register_routes() {
    register_rest_route( 'mi-plugin/v1', '/productos', [
        'methods'             => WP_REST_Server::READABLE, // GET
        'callback'            => 'mi_plugin_get_productos',
        'permission_callback' => '__return_true', // público
    ]);

    register_rest_route( 'mi-plugin/v1', '/productos/(?P<id>\d+)', [
        'methods'             => WP_REST_Server::EDITABLE, // POST, PUT, PATCH
        'callback'            => 'mi_plugin_update_producto',
        'permission_callback' => function() {
            return current_user_can( 'edit_posts' );
        },
        'args' => [
            'id' => [
                'validate_callback' => function( $param ) {
                    return is_numeric( $param );
                }
            ],
        ],
    ]);
}

function mi_plugin_get_productos( WP_REST_Request $request ) {
    $productos = get_posts([ 'post_type' => 'producto', 'posts_per_page' => -1 ]);
    return rest_ensure_response( $productos );
}

function mi_plugin_update_producto( WP_REST_Request $request ) {
    $id   = (int) $request->get_param( 'id' );
    $data = $request->get_json_params();
    // lógica de actualización...
    return rest_ensure_response([ 'updated' => $id ]);
}
```

**Endpoint resultante:** `https://tusitio.com/wp-json/mi-plugin/v1/productos`

---

## 15. Tareas programadas (WP-Cron)

```php
// Añadir intervalo personalizado
add_filter( 'cron_schedules', 'mi_plugin_cron_interval' );
function mi_plugin_cron_interval( $schedules ) {
    $schedules['cada_cinco_minutos'] = [
        'interval' => 300,
        'display'  => 'Cada 5 minutos',
    ];
    return $schedules;
}

// Programar al activar el plugin
register_activation_hook( __FILE__, 'mi_plugin_activar_cron' );
function mi_plugin_activar_cron() {
    if ( ! wp_next_scheduled( 'mi_plugin_tarea' ) ) {
        wp_schedule_event( time(), 'hourly', 'mi_plugin_tarea' );
        // intervalos: hourly, twicedaily, daily, weekly, cada_cinco_minutos
    }
}

// Desregistrar al desactivar
register_deactivation_hook( __FILE__, 'mi_plugin_desactivar_cron' );
function mi_plugin_desactivar_cron() {
    $timestamp = wp_next_scheduled( 'mi_plugin_tarea' );
    wp_unschedule_event( $timestamp, 'mi_plugin_tarea' );
}

// La tarea en sí
add_action( 'mi_plugin_tarea', 'mi_plugin_ejecutar_tarea' );
function mi_plugin_ejecutar_tarea() {
    // lógica que se ejecuta periódicamente
    update_option( 'mi_plugin_ultima_ejecucion', current_time( 'mysql' ) );
}
```

---

## 16. Seguridad — Resumen esencial

| Concepto | Función | Cuándo usarlo |
|---|---|---|
| Nonce (verificación de intención) | `wp_nonce_field()`, `wp_verify_nonce()`, `check_ajax_referer()` | Formularios y AJAX |
| Sanitizar entrada | `sanitize_text_field()`, `sanitize_email()`, `absint()`, `wp_kses_post()` | Antes de guardar en BD |
| Escapar salida | `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()` | Antes de mostrar en HTML |
| Comprobar permisos | `current_user_can('manage_options')` | Antes de cualquier acción admin |
| Evitar acceso directo | `if ( ! defined('ABSPATH') ) exit;` | En todos los archivos PHP |
| Queries seguras | `$wpdb->prepare()` | Antes de cualquier query con datos externos |

---

## 17. Estructura recomendada con clases (OOP)

Para plugins medianos/grandes, usar clases evita conflictos de nombres y organiza mejor el código.

```php
<?php
// mi-plugin.php
if ( ! defined( 'ABSPATH' ) ) exit;

final class Mi_Plugin {

    private static $instance = null;

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    private function define_constants() {
        define( 'MI_PLUGIN_VERSION', '1.0.0' );
        define( 'MI_PLUGIN_DIR',     plugin_dir_path( __FILE__ ) );
        define( 'MI_PLUGIN_URL',     plugin_dir_url( __FILE__ ) );
    }

    private function includes() {
        require_once MI_PLUGIN_DIR . 'includes/class-mi-plugin-cpt.php';
        require_once MI_PLUGIN_DIR . 'includes/class-mi-plugin-ajax.php';
        if ( is_admin() ) {
            require_once MI_PLUGIN_DIR . 'admin/class-mi-plugin-admin.php';
        }
    }

    private function init_hooks() {
        add_action( 'init', [ $this, 'init' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        register_activation_hook( __FILE__, [ $this, 'activar' ] );
        register_deactivation_hook( __FILE__, [ $this, 'desactivar' ] );
    }

    public function init() {
        load_plugin_textdomain( 'mi-plugin', false, MI_PLUGIN_DIR . 'languages' );
    }

    public function enqueue_assets() {
        wp_enqueue_style( 'mi-plugin', MI_PLUGIN_URL . 'assets/css/main.css', [], MI_PLUGIN_VERSION );
    }

    public function activar() { /* ... */ }
    public function desactivar() { /* ... */ }
}

// Inicializar el plugin
function mi_plugin() {
    return Mi_Plugin::get_instance();
}
mi_plugin();
```

---

## 18. Internacionalización (i18n)

```php
// En functions.php o el constructor del plugin
load_plugin_textdomain( 'mi-plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );

// Usar en el código
__( 'Texto a traducir', 'mi-plugin' );           // devuelve string
_e( 'Texto a traducir', 'mi-plugin' );           // hace echo
_n( '%d elemento', '%d elementos', $n, 'mi-plugin' ); // singular/plural
sprintf( __( 'Hola, %s', 'mi-plugin' ), $nombre );    // con variables
```

Generar el archivo `.pot` con WP-CLI:
```bash
wp i18n make-pot . languages/mi-plugin.pot --domain=mi-plugin
```

---

## 19. WP-CLI — comandos útiles para desarrollo

```bash
# Activar / desactivar plugin
wp plugin activate mi-plugin
wp plugin deactivate mi-plugin

# Listar plugins activos
wp plugin list --status=active

# Actualizar
wp plugin update mi-plugin

# Scaffold — generar boilerplate de plugin
wp scaffold plugin mi-plugin --plugin_name="Mi Plugin" --activate

# Scaffold CPT
wp scaffold post-type producto --plugin=mi-plugin

# Scaffold taxonomía
wp scaffold taxonomy categoria-producto --post_types=producto --plugin=mi-plugin

# Flush de rewrite rules
wp rewrite flush

# Borrar caché
wp cache flush
```

---

## 20. Recursos y documentación

| Recurso | URL |
|---|---|
| Guía oficial de plugins | https://developer.wordpress.org/plugins/ |
| Referencia de hooks | https://developer.wordpress.org/reference/hooks/ |
| Referencia de funciones | https://developer.wordpress.org/reference/ |
| Plugin Handbook | https://developer.wordpress.org/plugins/plugin-basics/ |
| REST API Handbook | https://developer.wordpress.org/rest-api/ |
| WP-CLI | https://wp-cli.org |
| Plugin Check (herramienta oficial) | https://wordpress.org/plugins/plugin-check/ |