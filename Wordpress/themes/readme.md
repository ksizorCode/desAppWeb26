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





## Listado de funciones de WP:

### vistas
para las vistas de apartados colomsingle.php, page.pho
get_header
get_footer





