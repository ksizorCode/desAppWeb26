# Mini-CMS
Un **Content Management System (CMS)** es un sistema que permite gestionar el contenido de un sitio web de forma organizada, separando los datos, la lógica y la presentación (Model Vista Controlaor).
Este mini-CMS en PHP aplica ese principio de forma simplificada y ligera, sin usar bases de datos.


## Estructura de archivos
```
/mini-cms
│
├── index.php              ← Router principal (?page=)
├── functions.php          ← Funciones comunes
├── config.php             ← Constantes de configuración de la App/Site
│
├── /inc
│   ├── header.php         ← <head>, <header>, navegación y apertura del <html>
│   └── footer.php         ← <footer>, scripts y cierre del </html>
│
├── /views                 ← Vistas (contenido por apartado)
│   ├── home.php
│   ├── servicios.php
│   ├── apartados.php
│   ├── ... .php
│   ├── ... .php
│   └── contacto.php
│
└── /assets                 ← Recursos (otros contenidos requeriso)
    ├── /css
    │   └── style.css
    ├── /js
    │   └── app.js
    ├── /img
    │   └── favicon
    └── /fonts

```

## Separación de responsabilidades
# Mini-CMS

Un **Content Management System (CMS)** es un sistema que permite gestionar el contenido de un sitio web de forma organizada, separando los datos, la lógica y la presentación. Este mini-CMS en PHP aplica ese principio de forma ligera y sin base de datos.

---

## Estructura de archivos
```
/mini-cms
│
├── index.php              ← Router principal (?page=)
├── functions.php          ← Funciones comunes
├── config.php             ← Constantes de configuración de la App/Site
│
├── /inc
│   ├── header.php         ← <head>, <header>, navegación y apertura del <html>
│   └── footer.php         ← <footer>, scripts y cierre del </html>
│
├── /views                 ← Vistas (contenido por apartado)
│   ├── home.php
│   ├── servicios.php
│   ├── apartados.php
│   └── contacto.php
│
└── /assets
    ├── /css
    │   └── style.css
    ├── /js
    │   └── app.js
    └── /img
```

---

## Separación de responsabilidades

### 1. Datos y contenido

- **`data.json`** — Contiene los datos globales del sitio: título, descripción, teléfono, dirección, email, redes sociales, etc. Es la fuente de verdad compartida por todas las vistas.
- **`views/home.php`** — Contenido de la página de inicio.
- **`views/contacto.php`** — Contenido y elementos del apartado de contacto.
- **`views/apartado.php`** — Ejemplo de cualquier otro apartado adicional.

La navegación entre apartados se gestiona mediante el parámetro GET `page` sobre `index.php`:
```
index.php?page=home       → carga views/home.php
index.php?page=contacto   → carga views/contacto.php
index.php?page=servicios  → carga views/servicios.php
```

En cada cambio de vista, `index.php` actualiza dinámicamente el `<title>` del documento y el `<h1>` principal según el apartado cargado.

---

### 2. Funcionalidades

Toda la lógica reutilizable reside en **`functions.php`**. Las funciones disponibles se describen en detalle en la sección funciones de este documento.

---

### 3. Apariencia

La presentación está distribuida en dos piezas:
- Estilo:
	 **`assets/css/style.css`** — Hoja de estilos principal.
- Piezas / Bloques:
	**`inc/header.php`** — Apertura del `<html>`, `<head>`, `<header>` y navegación.
	**`inc/footer.php`** — `<footer>`, carga de scripts y cierre del `</html>`.

---

## Funciones (`functions.php`)

### `titulo()`
Escribe el título del apartado actual en el `<title>` y/o `<h1>`.  
Si en la vista activa (`views/apartado.php`) existe una variable `$titulo`, la usa como texto. En caso contrario, recurre al título general del sitio.
```php
// En views/servicios.php
$titulo = "Nuestros Servicios";
```

---

### `appTitulo()`
Devuelve el título general de la aplicación o sitio web.  
Lo obtiene leyendo `data.json` a través de `functions.php`, que carga el JSON en un array `$data` y accede a:
```php
$data['site']['title']
```

---

### `description()`
Escribe la meta descripción o descripción visible del apartado.  
Si en la vista activa existe una variable `$descripcion`, la utiliza. Si no, recurre a la descripción general del sitio:
```php
$data['site']['description']
```
```php
// En views/contacto.php
$descripcion = "Ponte en contacto con nosotros a través del formulario o nuestros datos.";
```

---

## Flujo general
```
Petición → index.php?page=home
            │
            ├── Carga functions.php							 (define appTitulo(), titulo(), description())
			│			├── Carga config.php 				 (define DEBUG)
			│			└── Lee data.json → array $data
            │
			├── Comprueba GET['pages'] -> $page -> home
			|	Almacena bufer -> $contenido -> Incluye views/home.php   (define $titulo, $descripcion…)
			|		 └── 
            ├── incluye inc/header.php   (usa appTitulo(), titulo()) 
			├── carga $contenido 		 (usa titulo()) 
            └── Incluye inc/footer.php	 (usa appTitulo()) 
```

