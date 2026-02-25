# .htaccess
## ¿Qué es .htaccess?
El archivo  `.htaccess` es un archivo configuración utilizado por los servidores **Apache**.
Entre sus usos se encuentran:

- Redireccionamientos: Como el ejemplo para el error 404.
- Reescritura de URLs: Para generar rutas más amigables y optimizadas para el posicionamiento web (SEO).
- Control de acceso: Bloqueo de IPs, autenticación, entre otros.
- Configuración de caché: Mejorando la velocidad de carga del sitio.



## Redireccionar a una página 404 personalizada
Puedes redirigir a una página personalizada de error 404 utilizando el siguiente código:

Este código le indica a Apache que, cuando no se encuentre una página, redirija al archivo 404.html en lugar de mostrar la página predeterminada de error del servidor.
En el caso de querer que cualquier dirección incorrecta en nuestra web lance el archivo 404 se utilizará el siguiente código:

```apache
# Redireccionar al archivo que se mostrará en caso de error 404
RewriteEngine On
ErrorDocument 404 /404.html
```

## Redireccionamientos 301 (permanentes)
Si deseas redirigir permanentemente una URL a otra (por ejemplo, cambiar de una página antigua a una nueva):

```apache
Redirect 301 /pagina-antigua.html /nueva-pagina.html
```
También puedes usar RewriteRule para más flexibilidad en los redireccionamientos:

```apache
RewriteEngine On
RewriteRule ^pagina-antigua$ /nueva-pagina [R=301,L]
```

## Redireccionamiento Condicional (si el usuario viene desde un dominio específico)
A veces necesitas redirigir a los usuarios que vienen desde un dominio específico:

```apache
RewriteEngine On
RewriteCond %{HTTP_REFERER} ^http://dominio-externo.com [NC]
RewriteRule ^(.*)$ /pagina-de-redireccion [R=301,L]
```
Este código redirige a los usuarios que vienen de dominio-externo.com hacia la página pagina-de-redireccion.

## Hacer Redirección 301 para Toda una Carpeta
Si quieres redirigir toda una carpeta a otra ubicación, puedes hacerlo así:

```apache
RewriteEngine On
RewriteRule ^old-folder/(.*)$ /new-folder/$1 [R=301,L]
```
Esto redirige cualquier cosa dentro de old-folder/ a la misma ruta dentro de new-folder/.

## Redirigir todo el tráfico HTTP a HTTPS
Si tienes un sitio web con SSL y quieres redirigir todo el tráfico HTTP a HTTPS:

```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```
Este código asegura que todas las solicitudes HTTP sean redirigidas a HTTPS de manera permanente.

## Reescritura de URL para URLs amigables
Para hacer URLs más amigables (por ejemplo, de index.php?id=123 a producto/123), puedes usar:

```apache

RewriteEngine On
RewriteRule ^producto/([0-9]+)$ index.php?id=$1 [L]
```

Esto permite que la URL producto/123 sea interpretada por index.php?id=123.


----


## Reescritura a URL limpia
En ciertas ocuasiones nos podemos encontrar con rutas de URLs con extensiones de archivos o estructuras poco amigables de cara al posicionamiento SEO.
En esos casos podemos reconvertir cosas tipo:
Tenemos esta url un poco fea:
- `https://miweb.com/productos/playeros-rojos.php`
- `https://miweb.com/productos/864545.php`
- `https://miweb.com/productos?procuto=playero-34554`
- 
Podemos reconvertirlo a una estrucuta como estas:
- `https://miweb.com/productos/deporte/tenis/playeros/adidas/running-air-4200`
- `https://miweb.com/productos/playeros-rojos`

Veamos su uso.
Siendo la estructura de carpetas la siguiente, haremos el código que figura continuación para generar unas URLs amigables o limpias de cara al posicionamiento:

```
Proyecto/
│  
├── .htaccess
├── apartado-contacto-de-nuestra-empresa.php
├── index.php
├── productos.php
├── s.php
├── login.php
└── assets/
    └── apartados/
        └── serv550.php
```
`.htaccess`
```htaccess
#redirección
RewriteEngine On
RewriteRule ^inicio$ index.php [L]
RewriteRule ^productos$ productos.php [L]
RewriteRule ^servicios$ s.php [L]
RewriteRule ^/acceso/clientes/premium$ login.php [L]
RewriteRule ^servicios$  assets/apartados/serv550.php [L]
RewriteRule ^contacto$  apartado-contacto-de-nuestra-empresa.php [L]
```
Las rutas a los enlaces de navegación por lo tanto apuntarán a las nuevas URLs limpias:

```html
<nav>
    <ul>
    <li><a href="inicio">Inicio</a></li>
    <li><a href="productos">Productos</a></li>
    <li><a href="servicios">Servicios</a></li>
    <li><a href="contacto">Contacto</a></li>
    <li><a href="/acceso/clientes/premium">Acceso</a></li>
    </ul>
</nav>
```



## Control de Acceso
Podemos bloquear el acceso a un apartado (carpeta o subdirectorio) de nuestra web con usuario y contraseña o limitar el acceso desde IPs determinadas.



## Evitar el acceso a archivos sensibles
Puedes evitar que se accedan a archivos como .env, .git o cualquier otro archivo sensible:

```apache
<FilesMatch "^\.">
    Order Allow,Deny
    Deny from all
</FilesMatch>
```
Este código bloquea el acceso a cualquier archivo que empiece con un punto (por ejemplo, .git, .env).


## Bloquear acceso por IP
Si quieres bloquear ciertas direcciones IP de acceder a tu sitio, puedes hacerlo así:


```apache
<RequireAll>
    Require all granted
    Require not ip 192.168.1.100
    Require not ip 203.0.113.0/24
</RequireAll>
```
Este bloque impide el acceso a las IPs especificadas.

## Autenticación Básica
Si quieres proteger un directorio con contraseña, puedes usar la autenticación básica:

```apache

<Directory "/ruta/al/directorio">
    AuthType Basic
    AuthName "Área restringida"
    AuthUserFile /ruta/a/.htpasswd
    Require valid-user
</Directory>
```
Luego, debes crear un archivo .htpasswd que contenga el nombre de usuario y la contraseña codificada.



