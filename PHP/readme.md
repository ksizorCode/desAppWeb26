# Funciones útiles en PHP


- convertir a minusculas
- convertir a mayusclas
- convertir a url
- convertir en slug


# 📌 Funciones útiles en PHP

🔽 Convertir a minúsculas
strtolower("HOLA MUNDO");
mb_strtolower("HÓLA MUNDO", "UTF-8");

🔼 Convertir a mayúsculas
strtoupper("hola mundo");
mb_strtoupper("hola mundo", "UTF-8");

🌐 Convertir texto a URL válida
urlencode("Hola mundo"); // Hola+mundo
rawurlencode("Hola mundo"); // Hola%20mundo


🔗 Convertir texto en SLUG

function slug($texto) {
    $texto = strtolower($texto);
    $texto = preg_replace('/[^a-z0-9]+/i', '-', $texto);
    $texto = trim($texto, '-');
    return $texto;
}

echo slug("Hola Mundo PHP");


🛰️ Elimina espacios

ltrim("  Hola"); // al incio
rtrim("Hola  "); // al final

🔍 Buscar texto dentro de otro
strpos("Hola mundo", "mundo"); //5

✂️ Cortar texto
substr("Hola mundo", 0, 4); //Hola

🔄 Reemplazar texto
str_replace("mundo", "PHP", "Hola mundo");
// Hola PHP

📏 Contar caracteres
strlen("Hola"); //4
mb_strlen("Hola ñ", "UTF-8");

📦 Convertir string en array
explode(",", "rojo,verde,azul");
// ["rojo", "verde", "azul"]

🔗 Convertir array en string
implode(",", ["rojo", "verde", "azul"]);
// rojo,verde,azul





