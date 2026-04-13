# Encriptaciones

Las encriptaciones son metodos para ocultar la información con la posibilidad de luego recuperarla.

Hay muchos metodos de encriptado, aquí vamos a mencionar los más típicos:



## 🔐 Tabla de Métodos de Encriptación

| Nivel | Método | Descripción | Código PHP | Seguridad |
|------|--------|------------|------------|----------|
| 1 | Inversión de texto (tipo Atbash básico) | Sustituye letras por su opuesta en el abecedario | ```php function atbash($text){ $abc = range('a','z'); $rev = array_reverse($abc); return strtr(strtolower($text), array_combine($abc,$rev)); } echo atbash("hola"); ``` | ❌ Muy baja |
| 2 | ROT13 | Desplaza letras 13 posiciones | ```php echo str_rot13("hola mundo"); ``` | ❌ Muy baja |
| 3 | Base64 | Codificación, no encriptación | ```php $enc = base64_encode("hola"); $dec = base64_decode($enc); ``` | ❌ Muy baja |
| 4 | Hash simple (MD5) | Genera hash fijo | ```php echo md5("password"); ``` | ❌ Obsoleto |
| 5 | Hash SHA-256 | Más fuerte que MD5 | ```php echo hash("sha256", "password"); ``` | ⚠️ Media |
| 6 | password_hash() | Hash seguro con salt automático | ```php $hash = password_hash("password", PASSWORD_DEFAULT); ``` | ✅ Alta |
| 7 | OpenSSL básico (AES) | Cifrado simétrico | ```php $data="secreto"; $key="clave"; $enc=openssl_encrypt($data,"AES-128-ECB",$key); $dec=openssl_decrypt($enc,"AES-128-ECB",$key); ``` | ⚠️ Media |
| 8 | AES-256-CBC con IV | Cifrado seguro moderno | ```php function encrypt($data,$key){ $iv = random_bytes(16); $enc = openssl_encrypt($data,"AES-256-CBC",$key,0,$iv); return base64_encode($iv.$enc); } function decrypt($data,$key){ $data = base64_decode($data); $iv = substr($data,0,16); $enc = substr($data,16); return openssl_decrypt($enc,"AES-256-CBC",$key,0,$iv); } ``` | ✅ Alta |
| 9 | Encriptación asimétrica (RSA) | Clave pública/privada | ```php $res=openssl_pkey_new(); openssl_pkey_export($res,$priv); $pub=openssl_pkey_get_details($res)['key']; openssl_public_encrypt("hola",$enc,$pub); openssl_private_decrypt($enc,$dec,$priv); ``` | ✅ Muy alta |


## 🔐Tipos de Encriptación
### 1. Encriptación Simétrica

Se utiliza **la misma clave** tanto para cifrar como para descifrar la información.

- **Ventajas:**
  - Rápida y eficiente
  - Ideal para grandes volúmenes de datos

- **Desventajas:**
  - Problemas para compartir la clave de forma segura

- **Ejemplo en PHP:**
```php
$data = "Mensaje secreto";
$key = "clave123";

$encrypted = openssl_encrypt($data, "AES-128-ECB", $key);
$decrypted = openssl_decrypt($encrypted, "AES-128-ECB", $key);

echo $encrypted;
echo $decrypted;
```


### 2. Encriptación Asimétrica

Utiliza dos claves diferentes:

Clave pública (para cifrar)
Clave privada (para descifrar)
Ventajas:
Mayor seguridad en la transmisión
No requiere compartir la clave privada
Desventajas:
Más lenta que la simétrica
Ejemplo en PHP:


```php
$data = "Mensaje secreto";

// Generar claves
$privateKey = openssl_pkey_new();
openssl_pkey_export($privateKey, $privateKeyStr);

$publicKeyDetails = openssl_pkey_get_details($privateKey);
$publicKey = $publicKeyDetails['key'];

// Encriptar con clave pública
openssl_public_encrypt($data, $encrypted, $publicKey);

// Desencriptar con clave privada
openssl_private_decrypt($encrypted, $decrypted, $privateKeyStr);

echo $decrypted;
```