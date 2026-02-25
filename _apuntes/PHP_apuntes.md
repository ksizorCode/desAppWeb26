# Curso de PHP

Bienvenido al curso introductorio de PHP. En este repositorio encontrarás ejemplos y ejercicios para aprender los fundamentos de PHP.

## Índice

1. [Introducción a PHP](#introducción-a-php)
2. [Variables y Tipos de Datos](#variables-y-tipos-de-datos)
3. [Operadores](#operadores)
4. [Estructuras de Control](#estructuras-de-control)
5. [Funciones](#funciones)
6. [Manejo de Formularios](#manejo-de-formularios)
7. [Conexión con MySQL](#conexión-con-mysql)
8. [Programación Orientada a Objetos](#programación-orientada-a-objetos)
9. [Archivos y Sesiones](#archivos-y-sesiones)
10. [Funciones Resrvadas](#funciones-reservadas)

---

## Introducción a PHP

PHP es un lenguaje de programación del lado del servidor diseñado para el desarrollo web.

- **Extensión de archivos:** `.php`
- **Sintaxis básica:**

```php
<?php
  echo "¡Hola, mundo!";
?>
```

---

## Variables y Tipos de Datos

| Tipo | Descripción | Ejemplo (Tipado débil) | Tipado Estricto |
|------|------------|---------|----------------|
| `string` | Texto | `$nombre = "Juan";` | `string $nombre = "Juan";` |
| `int` | Número entero | `$edad = 25;` | `int $edad = 25;` |
| `float` | Número decimal | `$precio = 10.99;` | `float $precio = 10.99;` |
| `bool` | Booleano | `$activo = true;` | `bool $activo = true;` |
| `array` | Arreglo | `$colores = ["rojo", "azul"];` | `array $colores = ["rojo", "azul"];` |
| `object` | Objeto | `$persona = new Persona();` | `Persona $persona = new Persona();` |

---

## Operadores

| Tipo | Operadores |
|------|------------|
| Aritméticos | `+`, `-`, `*`, `/`, `%` |
| Comparación | `==`, `!=`, `>`, `<`, `>=`, `<=` |
| Lógicos | `&&`, `||`, `!` |
| Asignación | `=`, `+=`, `-=`, `*=`, `/=` |

---

## Estructuras de Control

### Condicionales
Se ejecutan si se cumple una o varias condiciones

#### `if-else`
```php
if ($edad >= 18) {
    echo "Eres mayor de edad.";
} else {
    echo "Eres menor de edad.";
}
```

#### `if-else` con `break`
```php
$valor = 5;
if ($valor < 10) {
    echo "El valor es menor que 10.";
    break;
}
```

#### `if` anidados
```php
$nota = 85;
if ($nota >= 90) {
    echo "Excelente";
} else {
    if ($nota >= 70) {
        echo "Aprobado";
    } else {
        echo "Reprobado";
    }
}
```


#### `if` con true/false
```php
$aceptado = true;
if ($aceptado == true) {
    echo "Ha aceptado";
} 

// es lo mismo que oner:
if ($aceptado) {
    echo "Ha aceptado";
} 

// o podemos validar lo contrario (si nó)
if (!$aceptado) {
    echo "No ha aceptado";
} 

```


#### `if` con OR y AND
|| para ó o OR
&& para y o AND


```php
$edad = 25;
$jubilado=true;
$sillaRuedas=true;
if ($edad >= 60 || $edad >= 70) {
    echo "Descuento";
} else {
    if ($jubilado && $sillaRuedas) {
        echo "Descuento y Necesita asistencia";
    } else {
        echo "Pago normal";
    }
}
```

### `switch`
en función de la posibilidad da un resultado u otro
```php
$dia = "martes";
switch ($dia) {
    case "lunes":
        echo "Inicio de semana";
        break;
    case "viernes":
        echo "Fin de semana próximo";
        break;
    default:
        echo "Día normal";
}
```

### Bucles
Repite una acción X cantidad de veces; en la gran mayoría de los casos haciendo pequeñas variantes dentro de la ejecución de esa repetición.
A cada una de esas repeticiones se las denomina: iteraciones.

#### `for`
```php
for ($i = 0; $i < 5; $i++) {
    echo "Número: $i <br>";
}
```

#### `while`
```php
$contador = 0;
while ($contador < 5) {
    echo "Contador: $contador <br>";
    $contador++;
}
```

#### `do-while`
```php
$contador = 0;
do {
    echo "Ejecutado al menos una vez.";
    $contador++;
} while ($contador < 1);
```

---

## Funciones
Paquetizan acciones. Son como departamentos de una empresa que se encargan de una acción en particilar. Unas funciones pueden llamar a otras. Y las funcionespueden retuilizarse tantas veces como se necesite.

### Función básica
```php
// Declaración de la función
function saludar() {
    return "Hola, mundo";
}
// Llamada a la función
echo saludar();
```

### Función con parámetros
Son funciones a las que se les pasan unos valores con los que luego operar.
```php
function sumar($a, $b) {
    return $a + $b;
}
echo sumar(5, 10);
```

### Función con parámetros por defecto
Si existen la posibilidad de que a la función se le puedan pasar parámetros o no, se pueden declarar parámetros por defecto. De tal manera que no será necesario pasarlos siempre.
```php
function saludarNombre($nombre = "Invitado") {
    return "Hola, " . $nombre;
}
echo saludarNombre(); // Hola, Invitado
```



### Función con varios parámetros
Si la función cuenta con muchos parámetros y queremos saltarnos alguno podemo shacer esto:

```php
function img_constructor($img, $class='miImg', $id='', $width='150', $alt='Imagen' ) {
    return "<img src='$img' class='$class' id='$id' alt='$alt' width='$width'>";
}
echo img_constructor('img/001.jpg', alt:'Dinosaurio bailando'); // Hola, Invitado
```

### Arrow function
```php
$doblar = fn($num) => $num * 2;
echo $doblar(4); // 8
```

---

## Manejo de Formularios

### Método GET
```html
<form method="GET" action="procesar.php">
    <input type="text" name="nombre">
    <input type="submit" value="Enviar">
</form>
```

**Ejemplo de URL generada en GET:**
```
procesar.php?nombre=Juan
```

En `procesar.php`:
```php
<?php
  echo "Hola, " . $_GET['nombre'];
?>
```

### Método POST
```html
<form method="POST" action="procesar.php">
    <input type="text" name="nombre">
    <input type="submit" value="Enviar">
</form>
```

En `procesar.php`:
```php
<?php
  echo "Hola, " . $_POST['nombre'];
?>
```

---


## Conexión con MySQL

```php
$conn = new mysqli("localhost", "usuario", "contraseña", "base_datos");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";
```

---

## Programación Orientada a Objetos

```php
class Persona {
    public $nombre;
    function __construct($nombre) {
        $this->nombre = $nombre;
    }
    function saludar() {
        return "Hola, " . $this->nombre;
    }
}
$persona = new Persona("Carlos");
echo $persona->saludar();
```

---

## Archivos y Sesiones

### Escritura y Lectura de Archivos
```php
file_put_contents("archivo.txt", "Hola Mundo");
echo file_get_contents("archivo.txt");
```

### Manejo de Sesiones
```php
session_start();
$_SESSION['usuario'] = "Juan";
echo $_SESSION['usuario'];
```

---
## Funciones Reservadas
Se trata de funciones ya creadas por PHP que simplifican la realización de operaciones frecuentes, ayudando a optimizar el tiempo de desarrollo.


| Función                | Descripción                                                    | Ejemplo de Uso                                                                                                     | Resultado Comentado                                                             |
|------------------------|----------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------|
| `htmlspecialchars()`   | Convierte caracteres especiales a entidades HTML.            | `echo htmlspecialchars("<a href='test'>Test</a>");`                                                                 | `&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt;`                                  |
| `strlen()`             | Devuelve la longitud de una cadena.                           | `echo strlen("Hola Mundo");`                                                                                        | `10` (incluye espacios)                                                        |
| `strpos()`             | Busca la posición de la primera aparición de una subcadena.    | `echo strpos("Hola Mundo", "Mundo");`                                                                               | `5` (posición iniciando en 0)                                                   |
| `date()`               | Formatea una fecha/hora local.                                 | `echo date("Y-m-d");`                                                                                               | `2025-02-28` (dependiendo de la fecha actual)                                  |
| `file_get_contents()`  | Lee un archivo y lo devuelve como una cadena.                  | `echo file_get_contents("ejemplo.txt");`                                                                            | Contenido del archivo "ejemplo.txt" (debe existir)                             |
| `json_encode()`        | Convierte un valor de PHP en una cadena JSON.                  | `echo json_encode(["manzana" => "🍎", "platano" => "🍌"]);`                                                         | `{"manzana":"🍎","platano":"🍌"}`                                                |
| `json_decode()`        | Decodifica una cadena JSON a un valor de PHP.                  | `$data = json_decode('{"manzana":"🍎","platano":"🍌"}'); echo $data->manzana;`                                       | `🍎`                                                                          |
| `trim()`               | Elimina espacios en blanco al inicio y final de una cadena.    | `echo trim("  Hola Mundo  ");`                                                                                      | `Hola Mundo` (sin espacios en extremos)                                        |
| `explode()`            | Divide una cadena en un array usando un delimitador.          | `$parts = explode(",", "🍎,🍌,🍊"); print_r($parts);`                                                              | `Array ( [0] => 🍎 [1] => 🍌 [2] => 🍊 )`                                       |
| `implode()`            | Une elementos de un array en una cadena usando un delimitador. | `$str = implode("-", ["🍎", "🍌", "🍊"]); echo $str;`                                                               | `🍎-🍌-🍊`                                                                     |
| `substr()`             | Extrae una parte de una cadena.                                | `echo substr("Hola Mundo", 5, 5);`                                                                                  | `Mundo`                                                                       |
| `preg_match()`         | Busca coincidencias en una cadena usando expresiones regulares. | `preg_match("/[0-9]+/", "abc123", $matches); print_r($matches);`                                                   | `Array ( [0] => 123 )`                                                        |
| `var_dump()`           | Muestra información estructurada sobre una variable.           | `var_dump(["manzana" => "🍎", "platano" => "🍌"]);`                                                                 | `array(2) { ["manzana"]=> string(4) "🍎", ["platano"]=> string(4) "🍌" }`       |
| `str_replace()`        | Reemplaza todas las apariciones de una subcadena por otra.       | `echo str_replace("mundo", "PHP", "Hola mundo");`                                                                  | `Hola PHP` (la búsqueda es sensible a mayúsculas/minúsculas)                    |
| `array_rand()`         | Obtiene una o más claves aleatorias de un array.               | `$array = ["🍎", "🍌", "🍊", "🍇", "🍓"]; echo array_rand($array);`                                                  | Clave aleatoria del array, por ejemplo `2`                                      |
| `random_int()`         | Genera un número entero aleatorio dentro de un rango especificado. | `echo random_int(1, 100);`                                                                                          | Un número aleatorio entre 1 y 100, por ejemplo `57`                             |
| `rand()`               | Genera un número entero aleatorio (deprecado en algunas versiones). | `echo rand(1, 100);`                                                                                                 | Un número aleatorio entre 1 y 100, por ejemplo `73`                             |
