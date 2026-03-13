
### 🍕 EJEMPLO 001 
#
# En la raiz de LOCAL (public)
# 1. Cambiar el motor del servidor a Apache
# 2. Crear un 404.html con mensaje divertido de Error
# 3. Redirijimos el error 404 a ese archivo
    ErrorDocument 404 /404.html


# 4. Simulamos el error con una ruta inexistente:
#   Ejemplo: http://trasteo.local//asdklfjaslñkdfklñjjasd
#
# ----------------------------------------------------


### 🍕 EJEMPLO 002
#
# Ahora vamos a hacer una redirección limpia para que el usuario no vea cosas tipo algo.com/servicios.php si no algo.com/servicios


# Activamos al redirección de direcciones
RewriteEngine On

# Especificamos a donde apunta cada dirección
RewriteRule ^home/?$                                /index.php      [L]
RewriteRule ^inicio/?$                              /index.php      [L]
RewriteRule ^servicios/?$                           /servicios.php  [L]
RewriteRule ^servicios-de-psicología-en-gijon/?$    /servicios.php  [L]
RewriteRule ^contacto/?$                            /contacto.php   [L]
RewriteRule ^promociones/?$                         /promociones.php [L]

# Provamos si funciona (ahora las rutas de los a href= no necesitan .php o .html, si no el nombre que acabamos de indicar ejemplo: servicios)
