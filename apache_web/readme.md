# .htaccess
Recuerda que para que esto funcinone tienes que tener *Apache* activado.

Vamos a hacer una URL limpia a partir de un metodo GET donde no se verán los ? o los codigos internos para llamar al producto cinviertiendo lo de arriba en lo de abajo internamente:

```
https://dominio.com/productos/kingdom-hearts-III
                  
                    ↓   ↓   ↓   ↓   ↓   

https://dominio.com/productos.php?slug=kingdom-hearts-III
```

----

## 🐊FASE 001

`.htaccess`
```
RewriteEngine On

RewriteRule ^productos/([a-zA-Z0-9-]+)/?$ productos.php?slug=$1 [L,QSA]

```
---

`productos.php`
```php

<?php
  $titulo = $_GET["slug"];
?>

<main>
  <h1> <?=$titulo?></h1>
</main>
```

Para testearlo escribe: producto/lo-que-tu-quieras y debería aparecer ese contenido escrito como h1

---
## 🦎 FASE 002

1. Creamos tabla  SQL `videojuegos` que contenga un campo slug
2. Probamos a hacer la consulta en la propia base de datos a traves del slug
3. Reprogramamos el `productos.php` para que haga la consulta a la base de datos a través ddel valor slug testeado anteriorimente
4. Probamos las URL limpias
5. Hacemos un index que liste los productos


### 01 Creamos tabla

Inserta el siguiente codigo en el SQL de tu base de datos para crear la tabla videojuegos:

```sql
CREATE TABLE videojuegos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    precio DECIMAL(6,2) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    imagen VARCHAR(255),
    descripcion TEXT
);
```

Llenamos la tabla con datos:

```sql
INSERT INTO videojuegos (nombre, precio, slug, imagen, descripcion) VALUES
('The Legend of Zelda: Ocarina of Time', 59.99, 'zelda-ocarina-of-time', 'https://static.wikia.nocookie.net/zelda/images/4/4f/Car%C3%A1tula_OoT_3D.jpg/revision/latest/scale-to-width-down/1000?cb=20150816123006&path-prefix=es', 'Aventura épica de Link en Hyrule considerada uno de los mejores juegos de la historia.'),
('Super Mario Bros', 29.99, 'super-mario-bros', 'https://en.wikipedia.org/wiki/Super_Mario_Bros.#/media/File:Super_Mario_Bros._box.png', 'El clásico de plataformas que definió a toda una generación.'),
('Final Fantasy VII', 49.99, 'final-fantasy-vii', 'https://upload.wikimedia.org/wikipedia/en/c/c2/Final_Fantasy_VII_Box_Art.jpg', 'RPG legendario con Cloud y Sephiroth en una historia inolvidable.'),
('Metal Gear Solid', 39.99, 'metal-gear-solid', 'https://en.wikipedia.org/wiki/Metal_Gear_Solid_%281998_video_game%29#/media/File:Metal_Gear_Solid_cover_art.png', 'Acción y sigilo con una narrativa revolucionaria.'),
('Grand Theft Auto: San Andreas', 34.99, 'gta-san-andreas', 'https://m.media-amazon.com/images/I/71aaHRac81L._AC_SY741_.jpg', 'Mundo abierto enorme con libertad total en Los Santos.'),
('Half-Life 2', 44.99, 'half-life-2', 'https://upload.wikimedia.org/wikipedia/en/2/25/Half-Life_2_cover.jpg?_=20200629082017', 'Shooter innovador con físicas avanzadas y gran narrativa.'),
('The Witcher 3: Wild Hunt', 59.99, 'the-witcher-3', 'witcher3.jpg', 'RPG moderno con mundo abierto y decisiones complejas.'),
('Dark Souls', 39.99, 'dark-souls', 'dark-souls.jpg', 'Juego desafiante que redefinió la dificultad en videojuegos.');
```


### 02 Testeamos la consulta
Antes de continuar vamos a testear la consulta desde AdminNeo o phpmyadmin (la plataforma que estés usando para ver y gestionar la DB):

Ejemplo:
```sql
SELECT * FROM videojuegos WHERE slug = 'gta-san-andreas'
```

### 03 Reprogramamos productos.php:
En este caso voy a mostrar todo el código 'a  lo bruto', pero recuerda que en un proyecto real lo ideal sería particionarlo, hacer estructuras reutilizables, funciones, componentes, etc..

```php

<?php
// Capturamos el valor que llega via URL slug=aqui-hay-algo
$titulo = $_GET['slug'];


/*
 * BASE DE DATOS -----------------------------------
 */

// Credenciales de acceso a la DB:
$SERV = "localhost";
$USER = "root";
$PASS = "root";
$DBNM = "local";

// Crear conexión
$conn = new mysqli($SERV, $USER, $PASS, $DBNM);

// 🔹 Forzar UTF-8 real (IMPORTANTE)
$conn->set_charset("utf8mb4");

// Chequear conexción
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

//Consulta:
$sql = "SELECT * FROM videojuegos WHERE slug = '$titulo'";

// Ejecutar Consulta (SQL query)
$result = $conn->query($sql);



//Cerramos Conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videogame Shop - </title>
    <style>
        body{
            font-family: sans-serif;
            max-width:660px;
            margin:20px auto;
            padding: 20px;
        }
    </style>

</head>
<body>


<header>
    Videogame Shop
</header>

<main>
<?
// Procesar Resultado
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()):?>

    <h1><? echo $row['nombre']?> </h1>
    <img src="<? echo $row['imagen']?>" alt="<?=$row['nombre']?>">
    <p><? echo $row['descripcion']?></p>
    <span>P.V.P. <? echo  $row['precio'] ?>€<span>
    
    <? endwhile;
} else {
    echo "<p>El producto solicitado no existe</p>";
}

?>
</main>
<footer>&copy; Videogame Shop 2026</footer>
    
</body>
</html>
?>
```



### 04  Probamos las URL limpias

Una vez reprogramado productos.php vamos a insertar la siguiente url:

 - http://tuservidor.local/productos/super-mario-bros
 - http://tuservidor.local/productos/half-life-2
 - http://tuservidor.local/productos/the-witcher-3
 - http://tuservidor.local/productos/zelda-ocarina-of-time


### 05 Indice de Productos
Hasta ahora hemos echo el interfaz para mostrar el producto. Ahora vamos a crear la lista de productos a modo de indice de contenido.
Vamos a llamar a este archivo: 'tienda.php'. 
La tienda NO recibirá por el momento nada a través de GET (a no ser que en un futuro hiciésemos un sistema de clasificación por categorías, orden alfavetico / temporal, productos en oferta, productos destacados, etc..).

Simplemente mostrará una lista de productos y un enlace a productos/nombre-del-producto con la URL limpia obtenida de slug



   

