# .htaccess
Recuerda que para que esto funcinone tienes que tener *Apache* activado.

Vamos a hacer una URL limpia a partir de un metodo GET donde no se verán los ? o los codigos internos para llamar al producto cinviertiendo lo de arriba en lo de abajo internamente:

```
https://dominio.com/productos/kingdom-hearts-III
                  
                    ↓   ↓   ↓   ↓   ↓   

https://dominio.com/productos.php?slug=kingdom-hearts-III
```

----

## FASE 001

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
## FASE 002

1. Creamos tabla  SQL `videojuegos` que contenga un campo slug
2. Probamos a hacer la consulta en la propia base de datos a traves del slug
3. Reprogramamos el `productos.php` para que haga la consulta a la base de datos a través ddel valor slug testeado anteriorimente
4. Probamos las URL limpias
5. Hacemos un index que liste lod productos


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
('The Legend of Zelda: Ocarina of Time', 59.99, 'zelda-ocarina-of-time', 'zelda.jpg', 'Aventura épica de Link en Hyrule considerada uno de los mejores juegos de la historia.'),
('Super Mario Bros', 29.99, 'super-mario-bros', 'mario.jpg', 'El clásico de plataformas que definió a toda una generación.'),
('Final Fantasy VII', 49.99, 'final-fantasy-vii', 'ff7.jpg', 'RPG legendario con Cloud y Sephiroth en una historia inolvidable.'),
('Metal Gear Solid', 39.99, 'metal-gear-solid', 'mgs.jpg', 'Acción y sigilo con una narrativa revolucionaria.'),
('Grand Theft Auto: San Andreas', 34.99, 'gta-san-andreas', 'gta-sa.jpg', 'Mundo abierto enorme con libertad total en Los Santos.'),
('Half-Life 2', 44.99, 'half-life-2', 'hl2.jpg', 'Shooter innovador con físicas avanzadas y gran narrativa.'),
('The Witcher 3: Wild Hunt', 59.99, 'the-witcher-3', 'witcher3.jpg', 'RPG moderno con mundo abierto y decisiones complejas.'),
('Dark Souls', 39.99, 'dark-souls', 'dark-souls.jpg', 'Juego desafiante que redefinió la dificultad en videojuegos.');
```




   

