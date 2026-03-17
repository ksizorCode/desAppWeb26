# .htaccess
Recuerda que para que esto funcinone tienes que tener *Apache* activado.



```
RewriteEngine On

RewriteRule ^productos/([a-zA-Z0-9-]+)/?$ productos.php?slug=$1 [L,QSA]

```
