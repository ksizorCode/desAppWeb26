# Apuntes sobre WordPress

# WP configuraicón básica
1. Settings / General 
    - Laguaje: Español
    -  Timezone: Madrid
    -  !!URL no se tocam (si se ha hecho habría que entrar desde la base dedatos.)

2. Ajustes / Lectura:
    - Una pagina estática
    - Enlaces permanentes ->  Nombre de la entrada







## Introducción a WordPress

WordPress es un sistema de gestión de contenidos (CMS) de código abierto que permite la creación y administración de sitios web de forma sencilla y flexible.

### Características principales:
- Fácil instalación y configuración.
- Sistema de temas para personalizar el diseño.
- Plugins para ampliar funcionalidades.
- Gestión de usuarios y roles.
- Optimización para SEO.
- Comunidad y soporte amplio.

## Instalación de WordPress

### Requisitos previos:
- Servidor web (Apache, Nginx o similar).
- PHP 7.4 o superior.
- Base de datos MySQL o MariaDB.

### Pasos de instalación:
1. Descargar WordPress desde [wordpress.org](https://wordpress.org).
2. Subir los archivos al servidor.
3. Crear una base de datos en MySQL.
4. Configurar el archivo `wp-config.php`.
5. Ejecutar el instalador desde el navegador.

## Estructura de Archivos

| Carpeta/Archivo | Descripción |
|----------------|-------------|
| `wp-admin/` | Panel de administración de WordPress. |
| `wp-content/` | Contiene temas, plugins y archivos subidos. |
| `wp-includes/` | Archivos de funciones y core de WordPress. |
| `wp-config.php` | Configuración de la base de datos y ajustes generales. |
| `.htaccess` | Configuraciones del servidor para enlaces permanentes. |

## Temas y Personalización

### Instalación de un tema:
1. Ir a `Apariencia > Temas` en el panel de administración.
2. Seleccionar "Añadir nuevo" y elegir un tema gratuito o subir uno propio.
3. Activar el tema elegido.

### Creación de un tema personalizado:
- Crear una carpeta en `wp-content/themes/`.
- Agregar los archivos `style.css` y `index.php`.
- Definir la cabecera en `style.css`.
- Utilizar `functions.php` para agregar funcionalidades.

## Plugins y Extensiones

Los plugins permiten ampliar las funcionalidades de WordPress. Se pueden instalar desde el panel de administración en `Plugins > Añadir nuevo`.

### Plugins esenciales:
- **Yoast SEO**: Optimización para motores de búsqueda.
- **WooCommerce**: Creación de tiendas en línea.
- **Elementor**: Editor visual para páginas.
- **WP Super Cache**: Mejora la velocidad del sitio.

## Gestión de Contenido

### Tipos de contenido en WordPress:
- **Entradas**: Contenido cronológico para blogs.
- **Páginas**: Contenido estático.
- **Categorías y etiquetas**: Organización de contenido.
- **Menús**: Navegación personalizada.

### Editor Gutenberg:
WordPress utiliza un editor basado en bloques llamado Gutenberg, que permite construir páginas de manera intuitiva.

## Seguridad en WordPress

### Buenas prácticas:
- Mantener WordPress, temas y plugins actualizados.
- Usar contraseñas seguras y autenticación en dos pasos.
- Limitar intentos de acceso con plugins de seguridad.
- Hacer copias de seguridad periódicas.

## Optimización y SEO

### Consejos para mejorar el SEO:
- Usar títulos y descripciones optimizadas.
- Mejorar la velocidad de carga con un sistema de caché.
- Optimizar imágenes para reducir el tamaño.
- Crear enlaces permanentes amigables.

## Conclusión
WordPress es una herramienta poderosa y flexible para la creación de sitios web. Con el uso adecuado de temas, plugins y optimización, es posible desarrollar sitios eficientes y seguros.
