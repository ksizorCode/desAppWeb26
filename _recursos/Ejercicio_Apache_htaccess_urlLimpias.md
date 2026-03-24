# ✂️ URLs Lipias con Apache + HTACCESS + Base de Datos

Vamos a crear una pequeña web / app para un catálogo de productos de una tienda o similar.
El objetivo de este ejercicio es lograr el uso de URLs amigables o limpias que eviten cosas del tipo:
mi-web.com/contacto.php
mi-web.com/ficha.php?id=5
mi-web.com/ficha.php?slug=nombre-del-producto

Y lo sustituyan por algo tipo:
mi-web.com/contacto
mi-web.com/productos/nombre-del-producto

También aprovecharemos para implementar un Error 404 personalizado.

## 📝 Proceso de Trabajo e Indice de contenidos

0. [🍼 Primeros pasos](#primeros-pasos)
1. [Construcción de la Estructura de la Web / App](#Estructura-de-mi-Web-App)
)
2. [Programación de Elementos básicos]
3. [Base de Datos: Creación y conexión con la web]
4. [Apache y .htaccess]
---

## Primeros pasos
1. Crea un nuevo servidor en `Local` (para que no interfiera con otros desarrollos. Y como siempre borramos todo el contenidod e public)
2. Activa **Apache** en lugar de Nginx y dale a Aplicar (.htaccess sólo funciona en apache)

## 🏗️ Estructura de mi Web App

Orden de archivos y carpetas con las que vamos a trabajar:
| **Archivo**     | **Tipo de Archivo**  | **Directorio** | **Qué hará**                                                                                                |
|-----------------|----------------------|----------------|-------------------------------------------------------------------------------------------------------------|
| `index.php`     | PHP (apartado)       | `/`            | - Incluye `_header.php` y `_footer.php`.<br>- Listado de productos (conexión a la base de datos y bucle). |
| `_header.php`   | PHP (parcial)        | `/includes/`   | - Elementos de apertura del HTML.<br>- Navegación de la cabecera. |
| `_footer.php`   | PHP (parcial)        | `/includes/`   | - Elementos del footer.<br>- Cierre del HTML. |
| `_config.php`   | PHP (configuración)  | `/icnludes/`   | - Se carga en todos los apartados.<br>- Contiene constantes con datos habituales.<br>- Funciones reutilizables. |
| `ficha.php`     | PHP (apartado)       | `/`            | - Muestra información del producto individual. |
| `contacto.php`  | PHP (apartado)       | `/`            | - Muestra información de contacto de la empresa. |
| ``     |  PHP (apartado)      | `/`            | - Contenido de la página 404 con redirección a la web de inicio. |
| `style.css`     | CSS                  | `/assets/css/` | - Define los estilos de la web. |
| `.htaccess`     | Configuración Apache | `/`            | - Define el archivo que se mostrará en caso de error 404.<br>- Reglas de URL limpias (ejemplo: `index.php` → `/inicio`, `contacto.php` → `/contacto`).<br>- Convierte `ficha.php?slug=nombre-producto` en `/producto/nombre-producto`. |



     
La estructura de carpetas será la siguiente:


  
```
    /📂mi-web/
    │── 📄 index.php          # Página principal (incluye header, listado de productos y footer)
    │── 📄 contacto.php        # Página de contacto
    │── 📄 ficha.php           # Página de producto individual (muestra detalles según slug)
    │── 📄            # Página 404 con redirección
    │── 📄 style.css             # Estilo CSS de mi web
    │── 📄 .htaccess             # Reglas de URL amigables y manejo de errores
    │
    ├── /📂includes/          # Carpeta para elementos reutilizables
    │   ├── 📄  _config.php       # Fragmentos de código necesarios para todos los apartados
    │   ├── 📄  _header.php       # Encabezado y menú de navegación
    │   ├── 📄 _footer.php       # Pie de página y cierre de HTML
    │
    ├── /📂assets/            # Archivos estáticos
        ├── /📂css/             # Estilos CSS
        ├── /📂js/              # Scripts JavaScript
        ├── /📂img/             # Imágenes del sitio
```
    
---
# 🖥️ Programación:

## 🔌 BLOQUES 
Elementos reutilizables escructuras o bloques de código HTML.
Como el header, footer, aside, etc:
- **`_config.php`** contendrá todas las fucniones, cosntantes y elementos retuilizables. Se cargará desde todos los apartados
- **`_header.php`** contiene la apertura del HTML y la cabecera de la web y se carga en todos los apartados.
- **`_footer.php`** contiene el footer y el cierre del HTML y también se carga en todos los apartados.
- **`_asside.php`** (no existen este caso) pero podría ser la columna lateral de un apartado blog (por ejemplo).

#### `_config.php`
Constantes y funciones que se podrían necesitar y estarán disponibles en todos los apartados.
```php
<?
// Datos de la web:
const URL='https://mi-web.local';       // URL principal del proyecto
const TITULOWEB='Mi web de Productos';  // Nombre del proyecto
const LANG='es';                        // Idioma del proyecto
?>

```


#### `_header.php`
Programación para el bloque de la cabecera reutilizado en todos los apartados
```html
<!DOCTYPE html>
<html lang="<?=LANG?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=TITULO?></title>
</head>
<body>

<header>
    <nav>
        <ul>
            <li> <a href="inicio">Inicio</a></li>
            <li> <a href="contacto">Contacto</a></li>
        </ul>
    </nav>
</header>

<main>
    <h1><?=TITULO?></h1>
```

#### `_footer.php`
Programación para el bloque pie reutilizado en todos los apartado:
```html
</main>
<footer>
    <p>&Copy; Copyright <?=date('Y')?> <?=TITULOWEB?></p>
</footer>
</body>
</html>
```


## 📑 APARTADOS
Serían cada una de las secciones de la página web

#### `index.php`
```php
<? const TITULO ='Inicio'?>
<?php require 'includes/_config.php' ?>
<?php include 'includes/_header.php' ?>

<!-- Aquí el contenido del apartado -->

<?php include 'includes/_footer.php' ?>
```

#### `contacto.php`
```php
<? const TITULO ='Contacto'?>
<?php require 'includes/_config.php' ?>

<?php include 'includes/_header.php' ?>

<!-- Aquí el contenido de contacto-->
<h2>Ver a conocernos</h2>
<address>
C/ Corrida 55 Gijón Asturias
</address>
<a href="tel:985555555">985555555</a>

<?php include 'includes/_footer.php' ?>
```

#### `ficha.php`
```php
<? const TITULO ='Ficha de producto'?>
<?php require 'includes/_config.php' ?>

<?php include 'includes/_header.php' ?>

<!-- Aquí irá el contenido de la ficha de producto-->

<?php include 'includes/_footer.php' ?>
```

#### `error.php`
```php
<? const TITULO ='Error 404 - Página no encontrada'?>
<?php require 'includes/_config.php' ?>
<?php include 'includes/_header.php' ?>

<!-- Aquí irá el contenido para Error 404->
<h2>Lo sentimos pero no hemos podido encontrar el apartado</h2>
<a href="<?=URL?>/inicio">Volver a Inicio</a>

<?php include 'includes/_footer.php' ?>
```



#### `style.css`
Estilo css que tendrán todos los apartados;

```css
:root{
    --c1:coral;
    --c2:lightblue;
    --ff:sans-serif;
}

body{
    font-family: var(--ff);
    max-width: 960px;
    margin: 10px auto;
    padding: 20px;
    background-color: var(--c1);
}

header nav{
    list-style: none;
    padding-left: 0;
    display: flex;
    gap:10px
}

a{
    text-decoration: none;
    color:var(--c1);
}

header, main, footer{
    padding: 20px;
    border-radius: 20px;
    background-color: white;
    margin:0 0 20px 0;
}
```



---
## 🧮 Base de Datos: Creación y Conexión

### Creación de la Base de Datos
Vamos a crear la base de datos `Catálogo` con una tabla `Productos` que almacene entre otras cosas un campo **slug** que defina la URL limpia que utilizaremos. Más adelante este slug será el elemento identificativo para que muestre el contenido a partir de ese slug.

#### Estructura de la tabla Productos

| Nombre        | Tipo          | Settings                    |
|-------------|---------------|-------------------------------|
| **id** | INTEGER | 🔑 PK, not null , unique, autoincrement |
| **nombre** | VARCHAR(255) | not null  | 
| **descripcion** | TEXT(65535) | not null |
| **foto** | VARCHAR(255) | not null  |  
| **precio** | NUMERIC | not null  |  
| **slug** | VARCHAR(255) | not null  | 


#### Database Diagram

```mermaid
erDiagram
	productos {
		INTEGER id
		VARCHAR(255) nombre
		TEXT(65535) descripcion
		VARCHAR(255) foto
		NUMERIC precio
		VARCHAR(255) slug
	}
```

#### Código SQL

```sql
-- Crear la base de datos Catalogo (si no existe)
CREATE DATABASE IF NOT EXISTS Catalogo;

-- Seleccionar la base de datos Catalogo
USE Catalogo;

-- Crear la tabla productos
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    foto VARCHAR(255),
    precio DECIMAL(10,2) NOT NULL,
    slug VARCHAR(255) NOT NULL
);

-- Insertar datos de ejemplo
INSERT INTO productos (nombre, descripcion, foto, precio, slug)
VALUES
('Nevera Americana', 'Descripción de la Nevera Americana, ideal para grandes familias.', 'nevera-americana.jpg', 999.99, 'nevera-americana'),
('Lavadora Front-load', 'Lavadora con tecnología front-load para mayor eficiencia.', 'lavadora-frontload.jpg', 699.50, 'lavadora-front-load'),
('Televisor LED 50"', 'Televisor LED de 50 pulgadas con alta definición y smart TV.', 'televisor-led50.jpg', 549.00, 'televisor-led-50'),
('Microondas Digital', 'Microondas digital con múltiples funciones y fácil de usar.', 'microondas-digital.jpg', 150.00, 'microondas-digital'),
('Aspiradora sin bolsa', 'Aspiradora sin bolsa para una limpieza eficiente en el hogar.', 'aspiradora-sin-bolsa.jpg', 129.99, 'aspiradora-sin-bolsa'),
('Cafetera Espresso', 'Cafetera espresso para preparar el café perfecto en casa.', 'cafetera-espresso.jpg', 299.99, 'cafetera-espresso'),
('Horno Eléctrico', 'Horno eléctrico con múltiples funciones y distribución uniforme del calor.', 'horno-electrico.jpg', 350.00, 'horno-electrico'),
('Secadora de Ropa', 'Secadora de ropa con tecnología avanzada para un secado rápido.', 'secadora-de-ropa.jpg', 450.00, 'secadora-de-ropa'),
('Plancha de Vapor', 'Plancha de vapor de alta potencia para eliminar arrugas eficazmente.', 'plancha-de-vapor.jpg', 75.50, 'plancha-de-vapor'),
('Batería de Cocina', 'Juego de batería de cocina completa para todas tus recetas.', 'bateria-de-cocina.jpg', 220.00, 'bateria-de-cocina');



```




## Conexión de la Base de Datos con el PHP

Vamos a actualizar los contenidos para que se conecten con la base de datos.
La conexión con la base de datos se hará al menos en dos lugares de nuestra web: desde `index.php` y desde `ficha.php`.
Esto ya hace que nos compense guardar los datos de conexión en un único lugar en vez de repetir fragmentos de código con las contraseñas de acceso.

Almacenaremos pues los datos de conecion en config.php:



#### includes/_config.php
```php

//DATOS REUTILIZABLES
// Datos de la web:
const URL='https://mi-web.local';       // URL principal del proyecto
const TITULOWEB='Mi web de Productos';  // Nombre del proyecto
const LANG='es';   

//Datos Acceso a Servidor
const HOST = 'localhost';	// url del servidor donde está la bd mysql
const USER = 'root';		// nombre de usuario de la bd
const PASS = 'root';		// contraseña de la bd
const DBNA = 'catalogo';	// nombre de la bd



//FUNCIONES

// Ejemplo de Uso:
// $sql = "SELECT * FROM productos"; //almacenamos la consulta en una variable
// $resultado = consulta($sql);      // almacenamos el resultado que devuelve en la variable resultado y le pasamos la consulta

function consulta($sql, $devolver=false){
	// Crear Coneción
		$conn = mysqli_connect(HOST, USER, PASS, DBNA);
	// Verificar Conexión 
		if (!$conn) {
  		die("Conexión fallida: " . mysqli_connect_error());
	}
$result = mysqli_query($conn, $sql);
if($devolver){
  return $result;
}

//Cerrar conexión
mysqli_close($conn);
}

?>


```




Volvemos al `index.php`:

#### index.php
```php
<? const TITULO ='Inicio'?>
<?php require 'includes/_config.php' ?>
<?php include 'includes/_header.php' ?>

<!-- Aquí el contenido del apartado -->
<h2>Listado de Productos</h2>
<ul class="galeria">

<?php

$sql = "SELECT * FROM productos"; //almacenamos la consulta en la variable $sql
$resultado = consulta($sql);  	  //lanzamos a la consulta y almacenamos su resultado en $resultado

if (mysqli_num_rows($resultado) > 0) {
  // output data of each row
  while($dato = mysqli_fetch_assoc($result)) {
    //echo "<li><a href='ficha.php?slug={$dato['slug']}'>{$dato['nombre']}</a></li>";
    echo "<li><a href='{$dato['slug']}'>{$dato['nombre']}</a></li>";
  }
} else {
  echo "0 resultados";
}
?>
</ul>

<!-- Footer y cierre-->
<?php include 'includes/_footer.php' ?>

```

#### ficha.php
Actualizamos la programación en ficha para que nos muestre los datos de cada producto:
```php

<?php
$titulo='';

//Capturamos el GET slug
if(isset($_GET['slug'])){
$slug=$_GET['slug'];
}

//Consultamos en la DB que nos muestre el elemento que tengan ese slug

$sql='SELECT * FROM productos WHERE slug="$slug"';
$resultado = consulta($sql,1);

if (mysqli_num_rows($resultado) > 0) {
  // output data of each row
  while($dato = mysqli_fetch_assoc($result)) {
	$titulo=$dato['nombre'];
	$miHTML="<h1>{$dato['nombre']}</h1>
		 <img src='{$dato['descripcion']}'>
		 <p>{$dato['precio']}</p>";
  }
} else {
  $miHTML ="No se han encontrado resultados";
}

?>

<? define(TITULO = $titulo);?>
<?php require '_config.php' ?>

<?php include '_header.php' ?>

<!-- Aquí el contenido del apartado -->
<?php echo $miHTML; ?>

<!-- Footer y cierre-->
<?php include '_footer.php' ?>

```


---

## 🛰️ .htaccess
Creamos el arhivo `.htaccess`. Recuerda que tienes que activar Apache para que esto funcine.

```apache

RewriteEngine On

# 1️⃣ Redirigir errores 404 a error.php
ErrorDocument 404 /error.php

# 2️⃣ URLs amigables para páginas principales
RewriteRule ^inicio$ index.php [L]
RewriteRule ^contacto$ contacto.php [L]

# 3️⃣ URL limpia para productos: /producto/nombre-producto
RewriteRule ^producto/([^/]+)/?$ ficha.php?slug=$1 [L,QSA]

# Apartir de ahora la dirección para un producto por ejemplo nevera-americana será:
# miweb.com/producto/nevera-americana
# pero internamente estará apuntando de forma oculta a:
# miweb.com/ficha.php?slug=nevera-americana






