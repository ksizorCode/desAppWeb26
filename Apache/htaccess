
# Apuntes de `.htaccess`

El archivo `.htaccess` es un archivo de configuración de Apache que permite controlar el comportamiento del servidor web a nivel de directorio, sin necesidad de modificar la configuración global del servidor.

---

## 📁 Ubicación y funcionamiento

- Se coloca en el directorio raíz o en cualquier subdirectorio.
- Apache lo lee en cada solicitud, por lo que los cambios son inmediatos.
- Afecta al directorio donde se encuentra y a todos sus subdirectorios.
- Requiere que `AllowOverride` esté habilitado en `httpd.conf`.

---

## 🔁 Redirecciones

### Redirigir HTTP a HTTPS

```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

### Redirigir www a sin www

```apache
RewriteEngine On
RewriteCond %{HTTP_HOST} ^www\.(.+)$ [NC]
RewriteRule ^ https://%1%{REQUEST_URI} [R=301,L]
```

### Redirigir sin www a www

```apache
RewriteEngine On
RewriteCond %{HTTP_HOST} !^www\. [NC]
RewriteRule ^ https://www.%{HTTP_HOST}%{REQUEST_URI} [R=301,L]
```

### Redirección simple de una página

```apache
Redirect 301 /pagina-vieja.html /pagina-nueva.html
```

---

## 🔗 URLs amigables (mod_rewrite)

```apache
RewriteEngine On

# Eliminar extensión .php de la URL
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule ^(.+)$ $1.php [L,QSA]

# URL limpia: /producto/123 → /producto.php?id=123
RewriteRule ^producto/([0-9]+)/?$ producto.php?id=$1 [L,QSA]

# URL limpia: /categoria/nombre → /categoria.php?nombre=nombre
RewriteRule ^categoria/([a-z0-9-]+)/?$ categoria.php?nombre=$1 [L,QSA]
```

### Flags comunes de RewriteRule

| Flag | Descripción |
|------|-------------|
| `L`  | Last – detiene el procesamiento de más reglas |
| `R=301` | Redirección permanente |
| `R=302` | Redirección temporal |
| `QSA` | Añade query string original a la URL destino |
| `NC` | No case-sensitive |
| `NE` | No escapar caracteres especiales |

---

## 🔒 Seguridad

### Bloquear acceso a archivos sensibles

```apache
<FilesMatch "\.(env|log|sql|bak|git|ini|conf)$">
    Require all denied
</FilesMatch>
```

### Proteger directorio con contraseña (Basic Auth)

```apache
AuthType Basic
AuthName "Área restringida"
AuthUserFile /ruta/absoluta/.htpasswd
Require valid-user
```

> Generar `.htpasswd`:
> ```bash
> htpasswd -c /ruta/.htpasswd usuario
> ```

### Bloquear IPs específicas

```apache
<RequireAll>
    Require all granted
    Require not ip 192.168.1.100
    Require not ip 10.0.0.0/8
</RequireAll>
```

### Permitir solo ciertas IPs

```apache
<RequireAny>
    Require ip 192.168.1.100
    Require ip 203.0.113.0/24
</RequireAny>
```

### Evitar listado de directorios

```apache
Options -Indexes
```

### Bloquear acceso a archivos ocultos (dotfiles)

```apache
<FilesMatch "^\.">
    Require all denied
</FilesMatch>
```

### Evitar ejecución de scripts en uploads

```apache
<Directory /var/www/html/uploads>
    Options -ExecCGI
    RemoveHandler .php .phtml .php3 .php4
    php_flag engine off
</Directory>
```

---

## ⚡ Caché y rendimiento

### Habilitar caché del navegador

```apache
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg           "access plus 1 year"
    ExpiresByType image/jpeg          "access plus 1 year"
    ExpiresByType image/png           "access plus 1 year"
    ExpiresByType image/gif           "access plus 1 year"
    ExpiresByType image/webp          "access plus 1 year"
    ExpiresByType image/svg+xml       "access plus 1 month"
    ExpiresByType text/css            "access plus 1 month"
    ExpiresByType text/javascript     "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    ExpiresByType application/pdf     "access plus 1 month"
    ExpiresByType text/html           "access plus 1 day"
</IfModule>
```

### Compresión GZIP

```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE text/javascript
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/json
    AddOutputFilterByType DEFLATE application/xml
    AddOutputFilterByType DEFLATE image/svg+xml
</IfModule>
```

### Deshabilitar ETags (evitar requests innecesarios)

```apache
FileETag None
Header unset ETag
```

---

## ❌ Páginas de error personalizadas

```apache
ErrorDocument 400 /errores/400.html
ErrorDocument 401 /errores/401.html
ErrorDocument 403 /errores/403.html
ErrorDocument 404 /errores/404.html
ErrorDocument 500 /errores/500.html
ErrorDocument 503 /errores/503.html
```

---

## 🛡️ Cabeceras de seguridad HTTP

```apache
<IfModule mod_headers.c>
    # Evitar que la página sea cargada en iframes de otros dominios
    Header always set X-Frame-Options "SAMEORIGIN"

    # Evitar MIME type sniffing
    Header always set X-Content-Type-Options "nosniff"

    # Protección básica contra XSS (obsoleta en navegadores modernos)
    Header always set X-XSS-Protection "1; mode=block"

    # Controlar información de referencia
    Header always set Referrer-Policy "strict-origin-when-cross-origin"

    # Content Security Policy (adaptar según necesidades)
    Header always set Content-Security-Policy "default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline';"

    # HSTS: forzar HTTPS durante 1 año
    Header always set Strict-Transport-Security "max-age=31536000; includeSubDomains; preload"

    # Eliminar cabecera que revela versión del servidor
    Header unset X-Powered-By
</IfModule>
```

---

## 🌐 CORS (Cross-Origin Resource Sharing)

```apache
<IfModule mod_headers.c>
    # Permitir desde un dominio específico
    Header set Access-Control-Allow-Origin "https://tudominio.com"

    # Permitir métodos HTTP
    Header set Access-Control-Allow-Methods "GET, POST, PUT, DELETE, OPTIONS"

    # Permitir cabeceras
    Header set Access-Control-Allow-Headers "Content-Type, Authorization"

    # Permitir credenciales
    Header set Access-Control-Allow-Credentials "true"
</IfModule>

# ⚠️ Permitir desde cualquier origen (no recomendado en producción)
# Header set Access-Control-Allow-Origin "*"
```

---

## 🗂️ Tipos MIME personalizados

```apache
AddType application/font-woff        .woff
AddType application/font-woff2       .woff2
AddType application/vnd.ms-fontobject .eot
AddType image/svg+xml                .svg
AddType application/json             .json
AddType video/mp4                    .mp4
AddType video/webm                   .webm
```

---

## 🔧 Configuración de PHP (si disponible)

```apache
# Aumentar límite de subida de archivos
php_value upload_max_filesize   64M
php_value post_max_size         64M
php_value max_execution_time    300
php_value memory_limit          256M

# Ocultar errores al usuario (producción)
php_flag display_errors         Off
php_flag log_errors             On
php_value error_log             /ruta/al/error.log
```

---

## 🏗️ WordPress

```apache
# Permalink structure estándar de WordPress
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /
    RewriteRule ^index\.php$ - [L]
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule . /index.php [L]
</IfModule>
```

---

## 📋 Referencia rápida de directivas

| Directiva | Uso |
|-----------|-----|
| `Options` | Activa/desactiva funciones (Indexes, FollowSymLinks...) |
| `Redirect` | Redireccionamiento simple |
| `RewriteEngine On` | Activa mod_rewrite |
| `RewriteCond` | Condición para RewriteRule |
| `RewriteRule` | Regla de reescritura de URL |
| `AuthType` | Tipo de autenticación |
| `ErrorDocument` | Páginas de error personalizadas |
| `AddType` | Asocia extensión con tipo MIME |
| `Header` | Manipula cabeceras HTTP |
| `ExpiresActive` | Activa control de caché |
| `php_value` | Configura PHP |

---

> **⚠️ Notas importantes:**
> - Siempre hacer copia de seguridad antes de editar.
> - Un error de sintaxis puede dejar el sitio inaccesible (error 500).
> - Los cambios son inmediatos, no requieren reiniciar Apache.
> - `RewriteEngine On` debe aparecer antes de cualquier regla de reescritura.
