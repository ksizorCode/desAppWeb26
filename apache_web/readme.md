# .htaccess
Recuerda que para que esto funcinone tienes que tener *Apache* activado.

Vamos a hacer una URL limpia a partir de un metodo GET donde no se verán los ? o los codigos internos para llamar al producto cinviertiendo lo de arriba en lo de abajo internamente:

```
https://dominio.com/productos/kingdom-hearts-III
                  
                    ↓   ↓   ↓   ↓   ↓   

https://dominio.com/productos.php?slug=kingdom-hearts-III
```

----


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

<footer>    <p>&copy;  Shop International</p> </footer>
```
