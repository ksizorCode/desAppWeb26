# FUNCIONES ÚTILES Y REUTILIZABLES de PHP


## Cifrado / Desencriptado
Funciones para la encriptación y cifrado o desencriptación.

### 1. Cifrado str_rot13
El alfabeto inglés tiene 26 caracteres.

La función `str_rot13` realiza una transformación de cifrado simple conocida como ROT13. Este algoritmo rota cada letra del alfabeto 13 posiciones (13+13 = 26). Es decir, cambia cada letra por la que está 13 lugares adelante en el alfabeto (y viceversa), lo que da como resultado un texto "cifrado" que, al aplicarse de nuevo, devuelve el texto original.

Ejemplo:
- La letra A se convierte en N.
- La letra B se convierte en O.
- La letra M se convierte en Z.
- La letra N se convierte en A.
- 
ROT13 es un cifrado simétrico, por lo que aplicarlo dos veces al mismo texto lo devuelve a su forma original.

```php
$texto = "Hola, mundo!";
$cifrado = str_rot13($texto);
$descifrado = str_rot13($cifrado);

echo "Cifrado: $cifrado\n"; 
echo "Descifrado: $descifrado\n";
```

✔️ Ventaja: No requiere clave.
❌ Desventaja: Fácilmente reversible sin seguridad real.
Las letras sin tilde (como "a" y "b") se rotan correctamente.
La "ñ" no se rotará de manera correcta en muchas implementaciones de ROT13.
Los números no se modifican.
Los caracteres con tilde generalmente no se ven afectados, pero su manejo depende del sistema o la implementación de la función.

---

### 2. base64

Base64 es un sistema de codificación utilizado para representar datos binarios (como imágenes, archivos, o cualquier tipo de información en formato binario) de manera que pueda ser manejada en un entorno que solo permite texto, como el caso de los correos electrónicos o URLs.

La idea principal de Base64 es tomar datos binarios y convertirlos en una secuencia de caracteres que solo consisten en texto, asegurando que esos caracteres sean seguros para ser transmitidos sin interferir con otros sistemas de procesamiento de texto.

**¿Cómo funciona Base64?**
Base64 toma bloques de 3 bytes (24 bits) de datos binarios y los divide en 4 grupos de 6 bits. Luego, cada grupo de 6 bits se mapea a un carácter de un conjunto específico de 64 caracteres.

**Los 64 caracteres de Base64**
Los caracteres que se utilizan en Base64 son:

- A-Z (26 letras mayúsculas)
- a-z (26 letras minúsculas)
- 0-9 (10 dígitos numéricos)
- + y / (símbolos adicionales)
En total, 26 + 26 + 10 + 2 = 64 caracteres, que son los que dan el nombre al sistema.

Ejemplo:
Supongamos que quieres codificar el texto "Hola".

Primero, convierte "Hola" a su representación binaria (en ASCII):

H → 72 (en ASCII) → 01001000 (binario)
o → 111 (en ASCII) → 01101111 (binario)
l → 108 (en ASCII) → 01101100 (binario)
a → 97 (en ASCII) → 01100001 (binario)
La secuencia binaria completa para "Hola" sería:

```
01001000 01101111 01101100 01100001
```
Luego, agrupas esta secuencia en bloques de 6 bits:

```
010010 000110 111101 101100 011000 01
```
Si el número de bits no es divisible entre 6 (como es el caso aquí), se agregan ceros al final para completar el último grupo.

```
010010 000110 111101 101100 011000 010000
```
Ahora, cada bloque de 6 bits se mapea a un carácter de Base64. Según la tabla estándar de Base64, los valores se mapean como sigue:

```arduino
Copiar
010010 → "S"
000110 → "G"
111101 → "9"
101100 → "s"
011000 → "Y"
010000 → "Q"
```
Entonces, "Hola" codificado en Base64 sería: "SG9sYQ==".

Nota: Los signos == al final son caracteres de relleno que se agregan si la longitud de los datos no es múltiplo de 3, para indicar que la cadena original fue recortada para completar un bloque completo.

**¿Por qué usar Base64?**
Base64 se utiliza para convertir datos binarios a texto porque:

Compatibilidad con sistemas de texto: Algunos sistemas no manejan bien los datos binarios, por ejemplo, sistemas de correo electrónico antiguos o ciertos protocolos HTTP.
Integridad de los datos: Usando solo caracteres ASCII (letras, números y símbolos comunes), garantizas que los datos no se alteren ni se corrompan durante la transmisión.
Desventajas de Base64
Tamaño mayor: Los datos codificados en Base64 aumentan de tamaño en un 33% aproximadamente. Esto se debe a que los 3 bytes de datos originales se transforman en 4 caracteres Base64.
**Resumen:**
Base64 es una forma de codificación binaria a texto que usa un conjunto de 64 caracteres para representar datos binarios, lo que permite que estos sean transmitidos o almacenados en sistemas que solo aceptan datos textuales.


```php
$texto = "Hola, mundo!";
$cifrado = base64_encode($texto);
$descifrado = base64_decode($cifrado);

echo "Texto original: $texto\n";
echo "Cifrado: $cifrado\n";
echo "Descifrado: $descifrado\n";
```

base64_encode($texto): Convierte el texto en una representación en base64.
- base64_decode($cifrado): Revierte el proceso y devuelve el texto original.

✔️ Ventajas:
- Fácil de usar y reversible.
- Útil para almacenar datos en formatos seguros (como URLs o JSON).

❌ Desventajas:
- No es un cifrado seguro, solo es una codificación.
- Puede ser decodificado fácilmente.

Si necesitas más seguridad, podrías combinarlo con una clave XOR o AES.

---

### 3. Cifrado XOR 
Utiliza la operación XOR entre cada byte del mensaje y una clave. Es simple, pero no proporciona alta seguridad.
```php
function xor_encrypt($string, $key) {
    $result = '';
    for($i = 0; $i < strlen($string); $i++) {
        $result .= chr(ord($string[$i]) ^ ord($key[$i % strlen($key)]));
    }
    return $result;
}

$texto = "Texto confidencial";
$clave = "clave_secreta";

$cifrado = xor_encrypt($texto, $clave);
$descifrado = xor_encrypt($cifrado, $clave);

echo "Texto cifrado (en base64): " . base64_encode($cifrado) . "\n";
echo "Texto descifrado: $descifrado\n";
```

✔️ Ventajas:
- Simple de implementar.
- La misma función sirve para cifrar y descifrar.

❌ Desventajas:
- No es criptográficamente seguro para datos sensibles.
- Vulnerable a análisis de frecuencia si la clave es corta.


### 4. Cifrado AES
AES es un estándar robusto para cifrado simétrico. PHP utiliza la extensión OpenSSL para cifrar y descifrar datos.
```php
function encrypt_aes($plaintext, $key) {
    $method = "AES-256-CBC";
    $iv = openssl_random_pseudo_bytes(16);
    $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $ciphertext);
}

function decrypt_aes($ciphertext, $key) {
    $method = "AES-256-CBC";
    $ciphertext = base64_decode($ciphertext);
    $iv = substr($ciphertext, 0, 16);
    $ciphertext = substr($ciphertext, 16);
    return openssl_decrypt($ciphertext, $method, $key, OPENSSL_RAW_DATA, $iv);
}

$texto = "Información sensible";
$clave = hash('sha256', 'mi_clave_secreta', true); // Clave de 256 bits

$cifrado = encrypt_aes($texto, $clave);
$descifrado = decrypt_aes($cifrado, $clave);

echo "Texto cifrado: $cifrado\n";
echo "Texto descifrado: $descifrado\n";
```
✔️ Ventajas:

Estándar de cifrado moderno y seguro.
Adecuado para datos sensibles.

❌ Desventajas:

Requiere la extensión OpenSSL.
Más complejo que otras opciones.


### 5. Cifrado con Clave Personalizada
Combina técnicas (por ejemplo, XOR y Base64) junto con una clave personalizada para añadir una capa extra de seguridad.

```php
function cifrar_con_clave($texto, $clave) {
    $texto_cifrado = '';
    for ($i = 0; $i < strlen($texto); $i++) {
        $texto_cifrado .= chr(ord($texto[$i]) + ord($clave[$i % strlen($clave)]));
    }
    return base64_encode($texto_cifrado);
}

function descifrar_con_clave($texto_cifrado, $clave) {
    $texto_cifrado = base64_decode($texto_cifrado);
    $texto = '';
    for ($i = 0; $i < strlen($texto_cifrado); $i++) {
        $texto .= chr(ord($texto_cifrado[$i]) - ord($clave[$i % strlen($clave)]));
    }
    return $texto;
}

$texto = "Mensaje secreto";
$clave = "miClave123";

$cifrado = cifrar_con_clave($texto, $clave);
$descifrado = descifrar_con_clave($cifrado, $clave);

echo "Texto cifrado: $cifrado\n";
echo "Texto descifrado: $descifrado\n";
```
✔️ Ventajas:

- Fácil de implementar y entender.
- Personalizable según necesidades básicas.

❌ Desventajas:

- No es criptográficamente seguro para aplicaciones de alta seguridad.
- Vulnerable a ciertos tipos de ataques.



### 6. Cifrado AES-256-CBC
Una variante específica del cifrado AES utilizando el modo AES-256-CBC.
```php
function cifrar_aes_256_cbc($texto, $clave) {
    $metodo = 'AES-256-CBC';
    $iv_length = openssl_cipher_iv_length($metodo);
    $iv = openssl_random_pseudo_bytes($iv_length);
    $cifrado = openssl_encrypt($texto, $metodo, $clave, 0, $iv);
    return base64_encode($iv . $cifrado);
}

function descifrar_aes_256_cbc($texto_cifrado, $clave) {
    $metodo = 'AES-256-CBC';
    $datos = base64_decode($texto_cifrado);
    $iv_length = openssl_cipher_iv_length($metodo);
    $iv = substr($datos, 0, $iv_length);
    $cifrado = substr($datos, $iv_length);
    return openssl_decrypt($cifrado, $metodo, $clave, 0, $iv);
}

$texto = "Hola, mundo!";
$clave = "otra_clave_segura_256";
$cifrado = cifrar_aes_256_cbc($texto, $clave);
$descifrado = descifrar_aes_256_cbc($cifrado, $clave);

echo "Texto original: $texto\n";
echo "Cifrado: $cifrado\n";
echo "Descifrado: $descifrado\n";
```

✔️ Ventajas:
- Implementación muy segura con verificación de integridad (HMAC).
- Adecuado para datos altamente sensibles.
- Detecta manipulaciones en los datos cifrados.

❌ Desventajas:
- Mayor complejidad y sobrecarga de procesamiento.
- Requiere extensión OpenSSL.

---

# Generar enlaces GET

## Whatsapp
### 1. Whatsapp con número
Genera un enlace para abrir WhatsApp con un número de teléfono específico.
```php
$numero = "1234567890";
$url = "https://wa.me/$numero";
echo $url;
```

Versión más avanzada:

```php
function generar_enlace_whatsapp_numero($numero) {
    // Eliminar caracteres no numéricos
    $numero_limpio = preg_replace('/[^0-9]/', '', $numero);
    return "https://wa.me/{$numero_limpio}";
}

$numero_telefono = "+34 612 345 678";
$enlace = generar_enlace_whatsapp_numero($numero_telefono);
echo "Enlace WhatsApp: $enlace";
```

### 2. Whatsap con mensaje
Genera un enlace para abrir WhatsApp con un mensaje predefinido.
```php
$mensaje = urlencode("Hola, ¿cómo estás?");
$url = "https://wa.me/?text=$mensaje";
echo $url;
```

Versión más avanzada:

```php
function generar_enlace_whatsapp_mensaje($mensaje) {
    $mensaje_codificado = urlencode($mensaje);
    return "https://wa.me/?text={$mensaje_codificado}";
}

$mensaje = "Hola, ¿cómo estás? Quería compartir esta información contigo.";
$enlace = generar_enlace_whatsapp_mensaje($mensaje);
echo "Enlace WhatsApp con mensaje: $enlace";
```


### 3. Whatsapp con número y mensaje
Combina el número de teléfono y un mensaje predefinido.
```php
$numero = "1234567890";
$mensaje = urlencode("Hola, ¿cómo estás?");
$url = "https://wa.me/$numero?text=$mensaje";
echo $url;
```

Versión más avanzada:
```php
function generar_enlace_whatsapp_completo($numero, $mensaje) {
    $numero_limpio = preg_replace('/[^0-9]/', '', $numero);
    $mensaje_codificado = urlencode($mensaje);
    return "https://wa.me/{$numero_limpio}?text={$mensaje_codificado}";
}

$numero = "+34 612 345 678";
$mensaje = "Hola, te contacto por el asunto que hablamos ayer.";
$enlace = generar_enlace_whatsapp_completo($numero, $mensaje);
echo "Enlace WhatsApp completo: $enlace";

```

Si necesitamos compartir la URL actual:

```php
$current_url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$enlace_compartir = 'https://wa.me/?text=' . urlencode('Hola, mira esto: ' . $current_url);
```

Pudiendo insertar la URL en un enlace tipo:    
```php
<a href="https://wa.me/?text=Hola, mira esto: <?php echo $current_url; ?>" class="btn btn-primary">Compartir en WhatsApp</a>
```



### Share
Genera enlaces para compartir contenido en distintas plataformas:

### - Facebook
```php
$url = urlencode("https://tusitio.com");
$titulo = urlencode("Título de la página");
$shareFacebook = "https://www.facebook.com/sharer/sharer.php?u=$url&t=$titulo";
```
### - Twitter / X
```php
$url = urlencode("https://tusitio.com");
$mensaje = urlencode("Echa un vistazo a esta página");
$shareTwitter = "https://twitter.com/intent/tweet?url=$url&text=$mensaje";
```

### - Compartir por mensaje (SMS):
```php
$url = urlencode("https://tusitio.com");
$shareMensaje = "sms:?body=$url";
```

### - Compartir por email:
```php
$url = urlencode("https://tusitio.com");
$asunto = urlencode("Interesante contenido");
$cuerpo = urlencode("Te recomiendo visitar: $url");
$shareEmail = "mailto:?subject=$asunto&body=$cuerpo";
```
### - Imprimir
Puedes usar JavaScript para invocar la función de impresión:
```html
<a href="#" onclick="window.print()">Imprimir esta página</a>
```


Enlaces a compartir web y publicar en redes estilo Share This Page.
```php
function generar_enlaces_share($url, $titulo, $descripcion = "") {
    $url_codificada = urlencode($url);
    $titulo_codificado = urlencode($titulo);
    $descripcion_codificada = urlencode($descripcion);
    
    $enlaces = [
        'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url_codificada}",
        'twitter' => "https://twitter.com/intent/tweet?url={$url_codificada}&text={$titulo_codificado}",
        'linkedin' => "https://www.linkedin.com/sharing/share-offsite/?url={$url_codificada}",
        'email' => "mailto:?subject={$titulo_codificado}&body={$descripcion_codificada}%20{$url_codificada}",
        'whatsapp' => "https://api.whatsapp.com/send?text={$titulo_codificado}%20{$url_codificada}",
        'telegram' => "https://t.me/share/url?url={$url_codificada}&text={$titulo_codificado}",
        'pinterest' => "https://pinterest.com/pin/create/button/?url={$url_codificada}&description={$descripcion_codificada}",
        'reddit' => "https://www.reddit.com/submit?url={$url_codificada}&title={$titulo_codificado}",
        'print' => "javascript:window.print()"
    ];
    
    return $enlaces;
}

$url = "https://www.ejemplo.com/mi-articulo";
$titulo = "Artículo interesante sobre PHP";
$descripcion = "Un completo artículo sobre funciones útiles en PHP";

$enlaces_share = generar_enlaces_share($url, $titulo, $descripcion);

// Uso
echo "<a href='{$enlaces_share['facebook']}' target='_blank'>Compartir en Facebook</a><br>";
echo "<a href='{$enlaces_share['twitter']}' target='_blank'>Compartir en Twitter/X</a><br>";
echo "<a href='{$enlaces_share['whatsapp']}' target='_blank'>Enviar por WhatsApp</a><br>";
echo "<a href='{$enlaces_share['email']}'>Enviar por correo</a><br>";
echo "<a href='{$enlaces_share['print']}'>Imprimir página</a><br>";
```


# Mapas

## 1. Mapas a partir de Coordenadas
Genera enlaces para mostrar un mapa usando latitud y longitud.


### - OpenStreetMap:
```php
$lat = 40.416775;
$lon = -3.703790;
$urlOSM = "https://www.openstreetmap.org/?mlat=$lat&mlon=$lon#map=18/$lat/$lon";
```

### - Google Maps
```php
$lat = 40.416775;
$lon = -3.703790;
$urlGoogle = "https://www.google.com/maps?q=$lat,$lon";
```

### - Apple Maps
```php
$lat = 40.416775;
$lon = -3.703790;
$urlApple = "https://maps.apple.com/?ll=$lat,$lon";
```

Otra forma de hacerlo:

```php
function generar_enlaces_mapa_coordenadas($latitud, $longitud, $etiqueta = "Ubicación") {
    $etiqueta_codificada = urlencode($etiqueta);
    
    return [
        'google' => "https://www.google.com/maps?q={$latitud},{$longitud}&z=15&t=m&hl=es&label={$etiqueta_codificada}",
        'openstreetmap' => "https://www.openstreetmap.org/?mlat={$latitud}&mlon={$longitud}&zoom=16&layers=M",
        'apple' => "https://maps.apple.com/?ll={$latitud},{$longitud}&q={$etiqueta_codificada}&z=16"
    ];
}

$latitud = 40.416775;
$longitud = -3.703790;

$enlaces_mapa = generar_enlaces_mapa_coordenadas($latitud, $longitud, "Puerta del Sol, Madrid");

echo "<a href='{$enlaces_mapa['google']}' target='_blank'>Ver en Google Maps</a><br>";
echo "<a href='{$enlaces_mapa['openstreetmap']}' target='_blank'>Ver en OpenStreetMap</a><br>";
echo "<a href='{$enlaces_mapa['apple']}' target='_blank'>Ver en Apple Maps</a><br>";
```

## 2. Mapas a partir de Dirección
Genera enlaces a mapas usando una dirección (calle, número, ciudad y/o código postal).

### - Google Maps
```php
$direccion = urlencode("Calle de ejemplo, 123, Madrid, 28001");
$urlGoogle = "https://www.google.com/maps/search/?api=1&query=$direccion";
```

Otra forma de hacerlo:
```php
function generar_enlaces_mapa_direccion($direccion) {
    $direccion_codificada = urlencode($direccion);
    
    return [
        'google' => "https://www.google.com/maps/search/?api=1&query={$direccion_codificada}",
        'openstreetmap' => "https://www.openstreetmap.org/search?query={$direccion_codificada}",
        'apple' => "https://maps.apple.com/?q={$direccion_codificada}"
    ];
}

$direccion = "Gran Vía 28, 28013 Madrid, España";
$enlaces_mapa = generar_enlaces_mapa_direccion($direccion);

echo "<a href='{$enlaces_mapa['google']}' target='_blank'>Ver en Google Maps</a><br>";
echo "<a href='{$enlaces_mapa['openstreetmap']}' target='_blank'>Ver en OpenStreetMap</a><br>";
echo "<a href='{$enlaces_mapa['apple']}' target='_blank'>Ver en Apple Maps</a><br>";
```


## Convertir a Slug
Convierte una cadena de texto en un slug amigable para URLs.
```php
function convertir_a_slug($texto) {
    // Convertir a minúsculas
    $texto = strtolower($texto);
    // Reemplazar acentos y caracteres especiales
    $buscar = array('á','é','í','ó','ú','ñ');
    $reemplazar = array('a','e','i','o','u','n');
    $texto = str_replace($buscar, $reemplazar, $texto);
    // Reemplazar espacios y caracteres no alfanuméricos por guiones
    $texto = preg_replace('/[^a-z0-9]+/i', '-', $texto);
    // Eliminar guiones al inicio y final
    $texto = trim($texto, '-');
    return $texto;
}

$cadena = "¡Hola, mundo! Esto es un ejemplo.";
$slug = convertir_a_slug($cadena);
echo $slug;
```

### Mostrar en Open Maps

```php
function iframe_openstreetmap($latitud, $longitud, $ancho = 600, $alto = 400, $zoom = 15) {
    return "<iframe width='{$ancho}' height='{$alto}' frameborder='0' scrolling='no' marginheight='0' marginwidth='0' 
            src='https://www.openstreetmap.org/export/embed.html?bbox=" . ($longitud - 0.01) . "%2C" . ($latitud - 0.01) . "%2C" . ($longitud + 0.01) . "%2C" . ($latitud + 0.01) . "&amp;layer=mapnik&amp;marker={$latitud}%2C{$longitud}' style='border: 1px solid black'></iframe><br/>
            <small><a href='https://www.openstreetmap.org/?mlat={$latitud}&amp;mlon={$longitud}#map={$zoom}/{$latitud}/{$longitud}'>Ver mapa más grande</a></small>";
}

echo iframe_openstreetmap(40.416775, -3.703790);
```

### Mostrar en Googel Maps
```php
function iframe_google_maps($latitud, $longitud, $ancho = 600, $alto = 400, $zoom = 15) {
    return "<iframe width='{$ancho}' height='{$alto}' frameborder='0' style='border:0' 
            src='https://www.google.com/maps/embed/v1/place?key=TU_API_KEY&q={$latitud},{$longitud}&zoom={$zoom}' allowfullscreen></iframe>";
}

// Nota: Necesitas una API key de Google Maps para que funcione
echo iframe_google_maps(40.416775, -3.703790);

// Alternativa sin API key (menos opciones pero funcional)
function iframe_google_maps_simple($latitud, $longitud, $ancho = 600, $alto = 400, $zoom = 15) {
    return "<iframe width='{$ancho}' height='{$alto}' frameborder='0' style='border:0' 
            src='https://maps.google.com/maps?q={$latitud},{$longitud}&z={$zoom}&output=embed' allowfullscreen></iframe>";
}

echo iframe_google_maps_simple(40.416775, -3.703790);
```

### Mostrar en Apple Maps
```php
function enlace_apple_maps($latitud, $longitud, $etiqueta = "Ubicación") {
    $etiqueta_codificada = urlencode($etiqueta);
    return "https://maps.apple.com/?ll={$latitud},{$longitud}&q={$etiqueta_codificada}";
}

echo "<a href='" . enlace_apple_maps(40.416775, -3.703790, "Puerta del Sol") . "' target='_blank'>Ver en Apple Maps</a>";

// Nota: Apple Maps no soporta embebido con iframe directamente como los otros servicios
```



## Conversión a slug
```php
function crear_slug($texto) {
    // Convertir a minúsculas
    $texto = mb_strtolower($texto, 'UTF-8');
    
    // Reemplazar caracteres especiales y acentos
    $texto = str_replace(
        ['á', 'é', 'í', 'ó', 'ú', 'ü', 'ñ', ' ', '&', '@', '$', '#', '%', '!', '¡', '?', '¿', '.', ',', ':', ';'],
        ['a', 'e', 'i', 'o', 'u', 'u', 'n', '-', '', '', '', '', '', '', '', '', '', '', '', '', ''],
        $texto
    );
    
    // Eliminar caracteres que no sean alfanuméricos o guiones
    $texto = preg_replace('/[^a-z0-9\-]/', '', $texto);
    
    // Eliminar guiones múltiples
    $texto = preg_replace('/-+/', '-', $texto);
    
    // Eliminar guiones al principio y al final
    return trim($texto, '-');
}

$titulo = "¿Cómo crear URLs amigables & SEO en PHP? ¡Guía completa!";
$slug = crear_slug($titulo);
echo "Slug: $slug"; // Resultado: "como-crear-urls-amigables-seo-en-php-guia-completa"
```



## Calendario

### 1. Generar Archivo iCal
Crea un archivo iCal (.ics) para representar un evento, a partir de fecha de inicio, fin, título y otros detalles.
```php
function generar_ical($titulo, $descripcion, $ubicacion, $fecha_inicio, $fecha_fin) {
    $ical  = "BEGIN:VCALENDAR\r\n";
    $ical .= "VERSION:2.0\r\n";
    $ical .= "PRODID:-//TuSitio//EN//\r\n";
    $ical .= "BEGIN:VEVENT\r\n";
    $ical .= "UID:" . uniqid() . "\r\n";
    $ical .= "DTSTAMP:" . gmdate('Ymd\THis\Z') . "\r\n";
    $ical .= "DTSTART:" . date('Ymd\THis\Z', strtotime($fecha_inicio)) . "\r\n";
    $ical .= "DTEND:" . date('Ymd\THis\Z', strtotime($fecha_fin)) . "\r\n";
    $ical .= "SUMMARY:" . $titulo . "\r\n";
    $ical .= "DESCRIPTION:" . $descripcion . "\r\n";
    $ical .= "LOCATION:" . $ubicacion . "\r\n";
    $ical .= "END:VEVENT\r\n";
    $ical .= "END:VCALENDAR\r\n";
    return $ical;
}

$evento = generar_ical(
    "Reunión de trabajo", 
    "Discutir proyecto", 
    "Oficina central", 
    "2025-04-01 09:00:00", 
    "2025-04-01 10:00:00"
);
file_put_contents("evento.ics", $evento);
```

Versión más completa:

```php
function formatear_fecha_calendario($timestamp) {
    return date('Ymd\THis', $timestamp);
}

function generar_archivo_ical($titulo, $descripcion, $ubicacion, $inicio, $fin, $recordatorio = 30) {
    $inicio_formato = formatear_fecha_calendario($inicio);
    $fin_formato = formatear_fecha_calendario($fin);
    $ahora = formatear_fecha_calendario(time());
    
    $uid = md5(uniqid(mt_rand(), true)) . '@midominio.com';
    
    $ical = "BEGIN:VCALENDAR\r\n";
    $ical .= "VERSION:2.0\r\n";
    $ical .= "PRODID:-//Mi Aplicación//ES\r\n";
    $ical .= "CALSCALE:GREGORIAN\r\n";
    $ical .= "METHOD:PUBLISH\r\n";
    $ical .= "BEGIN:VEVENT\r\n";
    $ical .= "UID:{$uid}\r\n";
    $ical .= "DTSTAMP:{$ahora}\r\n";
    $ical .= "DTSTART:{$inicio_formato}\r\n";
    $ical .= "DTEND:{$fin_formato}\r\n";
    $ical .= "SUMMARY:{$titulo}\r\n";
    
    if (!empty($descripcion)) {
        $ical .= "DESCRIPTION:" . str_replace("\n", "\\n", $descripcion) . "\r\n";
    }
    
    if (!empty($ubicacion)) {
        $ical .= "LOCATION:{$ubicacion}\r\n";
    }
    
    if ($recordatorio > 0) {
        $ical .= "BEGIN:VALARM\r\n";
        $ical .= "ACTION:DISPLAY\r\n";
        $ical .= "DESCRIPTION:Recordatorio\r\n";
        $ical .= "TRIGGER:-PT{$recordatorio}M\r\n";
        $ical .= "END:VALARM\r\n";
    }
    
    $ical .= "END:VEVENT\r\n";
    $ical .= "END:VCALENDAR\r\n";
    
    return $ical;
}

// Uso
$inicio = strtotime("2025-04-20 14:00:00");
$fin = strtotime("2025-04-20 16:00:00");
$ical = generar_archivo_ical(
    "Reunión de proyecto", 
    "Discusión sobre nuevas funcionalidades.\nTraer documentación.",
    "Sala 3, Edificio Principal",
    $inicio,
    $fin
);

// Para descargar el archivo
header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: attachment; filename="evento.ics"');
echo $ical;

```

### 2. Generar Enlace a Google Calendar
Crea un enlace que permita al usuario añadir un evento a su Google Calendar.
```php
$titulo = urlencode("Reunión de trabajo");
$descripcion = urlencode("Discutir proyecto");
$ubicacion = urlencode("Oficina central");
$fecha_inicio = date('Ymd\THis\Z', strtotime("2025-04-01 09:00:00"));
$fecha_fin = date('Ymd\THis\Z', strtotime("2025-04-01 10:00:00"));

$urlGoogleCalendar = "https://www.google.com/calendar/render?action=TEMPLATE&text=$titulo&dates=$fecha_inicio/$fecha_fin&details=$descripcion&location=$ubicacion&sf=true&output=xml";

echo $urlGoogleCalendar;

```

### JSON

## 1. Encriptar JSON
Ejemplo de cómo encriptar una cadena JSON utilizando el cifrado AES (función definida anteriormente).
```php
$json = json_encode(array("nombre" => "Juan", "edad" => 30));
$clave = "mi_clave_secreta";

$cifrado = cifrar_aes($json, $clave);
echo $cifrado;
```

## 2. Desencriptar JSON
Descifra la cadena encriptada y decodifica el JSON.
```php
$descifrado = descifrar_aes($cifrado, $clave);
$data = json_decode($descifrado, true);
print_r($data);
```




## Otras Funciones Útiles para el Día a Día

### - Validación de emails:
```php
function validar_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
```

### - Generación de contraseñas aleatorias:
```php
function generar_password($longitud = 8) {
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $password = '';
    for ($i = 0; $i < $longitud; $i++) {
        $password .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $password;
}
```

### - Conversión de fecha a formato legible:
```php
function formatear_fecha($fecha, $formato = 'd/m/Y H:i') {
    $datetime = new DateTime($fecha);
    return $datetime->format($formato);
}
```


### - Función Fecha en español

```php
function fecha_espanol($timestamp, $formato = 'completo') {
    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es');
    
    $meses = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
    $dias_semana = ['domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado'];
    
    $dia = date('j', $timestamp);
    $dia_semana = $dias_semana[date('w', $timestamp)];
    $mes = $meses[date('n', $timestamp) - 1];
    $año = date('Y', $timestamp);
    $hora = date('H:i', $timestamp);
    
    switch ($formato) {
        case 'completo':
            return "$dia_semana, $dia de $mes de $año a las $hora";
        case 'medio':
            return "$dia de $mes de $año";
        case 'corto':
            return "$dia/$mes/$año";
        case 'hora':
            return "$dia de $mes, $hora";
        default:
            return "$dia de $mes de $año";
    }
}

echo fecha_espanol(time(), 'completo') . "<br>";
echo fecha_espanol(strtotime('+2 days'), 'medio') . "<br>";
echo fecha_espanol(strtotime('last monday'), 'corto') . "<br>";

```


### Valoración del DNI/NIE español
```php
function validar_dni_nie($documento) {
    $documento = strtoupper(str_replace(['-', '.', ' '], '', $documento));
    
    if (preg_match('/^[0-9]{8}[A-Z]$/', $documento)) {
        // Es un DNI
        $numero = substr($documento, 0, 8);
        $letra = substr($documento, 8, 1);
        
        $resto = $numero % 23;
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letra_correcta = substr($letras, $resto, 1);
        
        return $letra === $letra_correcta;
    } elseif (preg_match('/^[XYZ][0-9]{7}[A-Z]$/', $documento)) {
        // Es un NIE
        $primer_caracter = substr($documento, 0, 1);
        $numero = substr($documento, 1, 7);
        $letra = substr($documento, 8, 1);
        
        // Reemplazar el primer carácter por su equivalente numérico
        switch ($primer_caracter) {
            case 'X': $numero = '0' . $numero; break;
            case 'Y': $numero = '1' . $numero; break;
            case 'Z': $numero = '2' . $numero; break;
        }
        
        $resto = $numero % 23;
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letra_correcta = substr($letras, $resto, 1);
        
        return $letra === $letra_correcta;
    }
    
    return false;
}

$documentos = ['12345678Z', '11111111H', 'X1234567L', 'Y1234567X'];
foreach ($documentos as $doc) {
    echo "El documento $doc es " . (validar_dni_nie($doc) ? "válido" : "inválido") . "<br>";
}
```


### Calcular edad apartir de fecha de nacimiento
```php
function calcular_edad($fecha_nacimiento) {
    $nacimiento = new DateTime($fecha_nacimiento);
    $hoy = new DateTime();
    $diferencia = $nacimiento->diff($hoy);
    
    return $diferencia->y;
}

echo "Edad: " . calcular_edad('1990-05-15') . " años<br>";
```


### Acortar texto con puntos suspensivos

```php
function acortar_texto($texto, $longitud_maxima = 100, $preservar_palabras = true) {
    if (strlen($texto) <= $longitud_maxima) {
        return $texto;
    }
    
    if ($preservar_palabras) {
        // Cortar hasta el límite máximo
        $texto_cortado = substr($texto, 0, $longitud_maxima);
        // Encontrar la última posición de un espacio
        $ultima_pos_espacio = strrpos($texto_cortado, ' ');
        
        if ($ultima_pos_espacio !== false) {
            // Cortar hasta la última palabra completa
            $texto_cortado = substr($texto_cortado, 0, $ultima_pos_espacio);
        }
        
        return $texto_cortado . '...';
    } else {
        return substr($texto, 0, $longitud_maxima) . '...';
    }
}

$texto_largo = "Este es un ejemplo de un texto muy largo que necesitamos acortar para mostrar en un resumen o en una lista de resultados donde el espacio es limitado.";
echo acortar_texto($texto_largo, 50) . "<br>";

```


### Generar código QR

```php
function generar_codigo_qr($datos, $tamaño = 200) {
    // Se necesita tener instalada la librería GD
    $datos_codificados = urlencode($datos);
    return "https://chart.googleapis.com/chart?chs={$tamaño}x{$tamaño}&cht=qr&chl={$datos_codificados}&choe=UTF-8";
}

// Uso básico para URL
$url_qr = generar_codigo_qr("https://www.example.com");
echo "<img src='{$url_qr}' alt='Código QR'>";

// Uso para vCard
$vcard = "BEGIN:VCARD\nVERSION:3.0\nN:Apellidos;Nombre\nTEL:+34612345678\nEMAIL:email@ejemplo.com\nEND:VCARD";
$vcard_qr = generar_codigo_qr($vcard);
echo "<img src='{$vcard_qr}' alt='Código QR vCard'>";

```


### Generar nombres de archivos únicos

```php
function generar_nombre_archivo_unico($nombre_original, $directorio = '') {
    // Obtener la extensión del archivo
    $extension = pathinfo($nombre_original, PATHINFO_EXTENSION);
    
    // Crear un nombre base único (sin extensión)
    $nombre_base = pathinfo($nombre_original, PATHINFO_FILENAME);
    
    // Sanitizar el nombre (eliminar caracteres especiales)
    $nombre_base = preg_replace('/[^a-zA-Z0-9-_]/', '', $nombre_base);
    
    // Añadir timestamp para garantizar unicidad
    $nombre_unico = $nombre_base . '_' . time() . '_' . mt_rand(1000, 9999);
    
    // Comprobar si ya existe un archivo con este nombre
    if (!empty($directorio)) {
        $contador = 1;
        $nombre_archivo = $nombre_unico . '.' . $extension;
        
        while (file_exists($directorio . '/' . $nombre_archivo)) {
            $nombre_archivo = $nombre_unico . '_' . $contador . '.' . $extension;
            $contador++;
        }
        
        return $nombre_archivo;
    }
    
    return $nombre_unico . '.' . $extension;
}

echo generar_nombre_archivo_unico('documento.pdf') . "<br>";
echo generar_nombre_archivo_unico('mi foto.jpg') . "<br>";
echo generar_nombre_archivo_unico('archivo con espacios!.docx') . "<br>";
```


### Generar colores aleatorioes en formato hexadecimal
```php
function color_aleatorio($brillante = false) {
    if ($brillante) {
        // Colores con alta luminosidad
        $r = mt_rand(150, 255);
        $g = mt_rand(150, 255);
        $b = mt_rand(150, 255);
    } else {
        $r = mt_rand(0, 255);
        $g = mt_rand(0, 255);
        $b = mt_rand(0, 255);
    }
    
    return sprintf("#%02x%02x%02x", $r, $g, $b);
}

echo "Color aleatorio: <span style='background-color:" . color_aleatorio() . "; padding: 5px 10px;'>" . color_aleatorio() . "</span><br>";
echo "Color brillante: <span style='background-color:" . color_aleatorio(true) . "; padding: 5px 10px;'>" . color_aleatorio(true) . "</span><br>";
```



### Eliminar acentos y caracteres especiales
```php
function eliminar_acentos($texto) {
    $no_permitidos = [
        'á' => 'a', 'é' => 'e', 'í' => 'i', 'ó' => 'o', 'ú' => 'u', 'ü' => 'u',
        'Á' => 'A', 'É' => 'E', 'Í' => 'I', 'Ó' => 'O', 'Ú' => 'U', 'Ü' => 'U',
        'à' => 'a', 'è' => 'e', 'ì' => 'i', 'ò' => 'o', 'ù' => 'u',
        'À' => 'A', 'È' => 'E', 'Ì' => 'I', 'Ò' => 'O', 'Ù' => 'U',
        'ñ' => 'n', 'Ñ' => 'N',
        'ç' => 'c', 'Ç' => 'C'
    ];
    
    return strtr($texto, $no_permitidos);
}

echo eliminar_acentos("Murciélago áéíóú ÀÈÌÒÙ ñÑ çÇ") . "<br>"; // "Murcielago aeiou AEIOU nN cC"
```


### Generar identificadores únicos seguros
```php
function generar_id_unico($longitud = 16) {
    $bytes = random_bytes($longitud);
    return bin2hex($bytes);
}

echo "ID único (32 caracteres): " . generar_id_unico() . "<br>";
echo "ID único corto (16 caracteres): " . generar_id_unico(8) . "<br>";
echo "ID único largo (64 caracteres): " . generar_id_unico(32) . "<br>";
```

### Calcular la distancia entre coordenadas GPS
```php
function calcular_distancia_gps($lat1, $lon1, $lat2, $lon2, $unidad = 'km') {
    // Radio de la Tierra en kilómetros
    $radio_tierra = 6371;
    
    // Convertir grados a radianes
    $lat1 = deg2rad($lat1);
    $lon1 = deg2rad($lon1);
    $lat2 = deg2rad($lat2);
    $lon2 = deg2rad($lon2);
    
    // Fórmula de Haversine
    $dlat = $lat2 - $lat1;
    $dlon = $lon2 - $lon1;
    
    $a = sin($dlat/2) * sin($dlat/2) + cos($lat1) * cos($lat2) * sin($dlon/2) * sin($dlon/2);
    $c = 2 * atan2(sqrt($a), sqrt(1-$a));
    $distancia = $radio_tierra * $c;
    
    // Convertir unidades si es necesario
    if ($unidad == 'mi') {
        $distancia *= 0.621371; // Convertir a millas
    } elseif ($unidad == 'm') {
        $distancia *= 1000; // Convertir a metros
    }
    
    return round($distancia, 2);
}

// Ejemplo: Madrid a Barcelona
$madrid_lat = 40.416775;
$madrid_lon = -3.703790;
$barcelona_lat = 41.385064;
$barcelona_lon = 2.173404;

echo "Distancia entre Madrid y Barcelona: " . 
     calcular_distancia_gps($madrid_lat, $madrid_lon, $barcelona_lat, $barcelona_lon) . " km<br>";
echo "Distancia en millas: " . 
     calcular_distancia_gps($madrid_lat, $madrid_lon, $barcelona_lat, $barcelona_lon, 'mi') . " millas<br>";
```




