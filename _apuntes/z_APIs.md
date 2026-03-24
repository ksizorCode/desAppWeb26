# USO DE APIs

Una API (Application Programming Interface) es un conjunto de reglas y protocolos que permite a diferentes sistemas o aplicaciones interactuar entre sí. Facilita el intercambio de datos y funcionalidades entre diferentes aplicaciones, plataformas y entornos tecnológicos.

Existen diferentes tipos de API, como las API REST, SOAP, GraphQL y RPC, entre otras. Las API REST son las más comunes y se basan en HTTP para realizar operaciones como GET, POST, PUT y DELETE en recursos específicos.


## Ejemplo 1: Consumir una API con file_get_contents()
Este método es el más sencillo, pero no permite muchas configuraciones avanzadas.

```php
<?php
$url = "http://jsonplaceholder.typicode.com/posts/1"; // API de prueba
$response = file_get_contents($url);
$data = json_decode($response, true);

echo "<h2>" . $data['title'] . "</h2>";
echo "<p>" . $data['body'] . "</p>";
?>
```

Pros:
- Fácil de usar.
- No requiere configuración adicional.
Contras:
- No permite cabeceras personalizadas.
- No es seguro para APIs que requieren autenticación.

## Ejemplo 2: Consumir una API con cURL (Método recomendado para mayor control)
Usamos cURL para hacer peticiones más avanzadas.

```php

<?php
$url = "http://jsonplaceholder.typicode.com/posts/1";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

echo "<h2>" . $data['title'] . "</h2>";
echo "<p>" . $data['body'] . "</p>";
?>
```
Pros:
- Permite autenticación, cabeceras y métodos HTTP (GET, POST, etc.).
- Más seguro y flexible.
Contras:
- Código más complejo.
- Requiere que cURL esté habilitado en el servidor.


## Ejemplo 3: Consumir una API con cURL y parámetros GET
En este caso, pasamos parámetros en la URL.

```php
<?php
$base_url = "https//jsonplaceholder.typicode.com/posts";
$params = http_build_query(["userId" => 1]); 
$url = "$base_url?$params";  

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);

foreach ($data as $post) {
    echo "<h2>{$post['title']}</h2>";
    echo "<p>{$post['body']}</p>";
}
?>
```
## Ejemplo 4: Consumir una API con cURL y método POST
Este ejemplo envía datos a la API.

```php
<?php
$url = "https://jsonplaceholder.typicode.com/posts";

$data = [
    "title" => "Título de prueba",
    "body" => "Este es el contenido del post",
    "userId" => 1
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);
print_r($result);
?>
```

## Ejemplo 5: Usar una API con Guzzle (Librería externa más moderna)
Si quieres usar una librería más avanzada y orientada a objetos, puedes instalar Guzzle con Composer:

```sh
composer require guzzlehttp/guzzle
```

Código en PHP:

```php
<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$response = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts/1');

$data = json_decode($response->getBody(), true);

echo "<h2>{$data['title']}</h2>";
echo "<p>{$data['body']}</p>";
?>
```

Pros:
- Más moderno y limpio.
- Maneja excepciones y errores de manera eficiente.
- Compatible con pruebas automatizadas.
Contras:
- Necesita instalación con Composer.



# APIs gratuitas y fáciles de usar para pruebas y desarrollo con PHP.
He incluido APIs de datos generales, tiempo, películas y cultura geek.

| Categoría	        | API	            |                                     Descripción	| URL de Documentación         |
|-------------------|-------------------|---------------------------------------------------|------------------------------|
|Datos de prueba	|JSONPlaceholder	|API falsa con posts, comentarios y usuarios de ejemplo.	|jsonplaceholder.typicode.com|
|Datos de prueba	|RandomUser	        |Genera perfiles de usuario aleatorios.	|randomuser.me|
|Tiempo/Clima	    |OpenWeatherMap	    |Datos meteorológicos y previsión del tiempo.	|openweathermap.org/api|
|Tiempo/Clima	    |WeatherAPI	        |API sencilla para obtener datos del clima.	|weatherapi.com|
|Películas y Series	|The Movie Database (TMDB)	|Información de películas, series y actores.	|developer.themoviedb.org|
|Películas y Series	|OMDB API	        |Alternativa a TMDB, basada en datos de IMDb.	|omdbapi.com|
|Mundo Friki	    |PokéAPI	        |Información sobre todos los Pokémon.	|pokeapi.co|
|Mundo Friki	    |Rick and Morty     |API	Datos sobre personajes, episodios y ubicaciones de la serie.	|rickandmortyapi.com|
|Mundo Friki	    |Star Wars API (SWAPI)	|Información de películas, personajes, naves y más del universo Star Wars.	|swapi.dev|
|Mundo Friki	    |DnD 5e API	|Datos sobre Dungeons & Dragons 5ª edición.	|dnd5eapi.co|
|Datos Aleatorios	|Bored API	|Ideas para actividades cuando estás aburrido.	|www.boredapi.com|
|Datos Aleatorios	|Numbers API	|Datos curiosos sobre números.	|numbersapi.com|
|Datos Aleatorios	|Cat Facts	|Datos aleatorios sobre gatos.	|catfact.ninja|

## Ejemplo de uso en PHP con la API de clima (WeatherAPI)
```php

<?php
$apiKey = "TU_API_KEY"; // Necesitas registrarte en weatherapi.com para obtener una clave
$city = "Gijón";
$url = "http://api.weatherapi.com/v1/current.json?key=$apiKey&q=$city";

$response = file_get_contents($url);
$data = json_decode($response, true);

echo "Ciudad: " . $data['location']['name'] . "<br>";
echo "Temperatura: " . $data['current']['temp_c'] . "°C<br>";
echo "Condición: " . $data['current']['condition']['text'];
?>
```
Si necesitas más ejemplos con alguna API en concreto, dime y te preparo el código en PHP.

Tú dijiste:
Dame más ejemplos
ChatGPT Plus
Aquí tienes más ejemplos de uso de APIs en PHP utilizando distintas categorías.

1. Obtener información de una película con OMDB API
Esta API permite buscar información de películas a partir de su título o ID de IMDb.

Código PHP
```php
<?php
$apiKey = "TU_API_KEY"; // Regístrate en https://www.omdbapi.com/
$title = "Inception";
$url = "http://www.omdbapi.com/?t=" . urlencode($title) . "&apikey=$apiKey";

$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data["Response"] == "True") {
    echo "<h2>{$data['Title']} ({$data['Year']})</h2>";
    echo "<p>Director: {$data['Director']}</p>";
    echo "<p>Género: {$data['Genre']}</p>";
    echo "<img src='{$data['Poster']}' alt='Poster'>";
} else {
    echo "Película no encontrada.";
}
?>
```

Salida esperada
```makefile
Título: Inception (2010)
Director: Christopher Nolan
Género: Acción, Ciencia Ficción
(Imagen del póster)
```

## 2. Obtener personajes de Rick & Morty con la API de Rick and Morty
Esta API devuelve información sobre personajes, episodios y ubicaciones de la serie.

```php
<?php
$url = "https://rickandmortyapi.com/api/character/?status=alive"; // Cambia a HTTPS

//Desactivar el SSL si da problemas
/*
$context = stream_context_create([
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false
    ]
]);
*/

$response = file_get_contents($url, false, $context);
$data = json_decode($response, true);

if ($data && isset($data['results'])) {
    foreach ($data['results'] as $character) {
        echo "<h3>{$character['name']}</h3>";
        echo "<p>Especie: {$character['species']} - Estado: {$character['status']}</p>";
        echo "<img src='{$character['image']}' alt='{$character['name']}' width='100'><hr>";
    }
} else {
    echo "Error al obtener los datos.";
}
?>

```

Salida esperada
```python-repl

Rick Sanchez - Humano - Vivo
(Imagen)
Morty Smith - Humano - Vivo
(Imagen)
...
3. Obtener un Pokémon con la PokéAPI
La PokéAPI permite consultar información sobre cualquier Pokémon.
```

```php
<?php
$pokemon = "pikachu";
$url = "https://pokeapi.co/api/v2/pokemon/$pokemon";

// Desactivar verificación SSL
$context = stream_context_create([
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false
    ]
]);

$response = file_get_contents($url, false, $context);

if ($response === false) {
    die("Error al obtener los datos de la API.");
}

$data = json_decode($response, true);

if (!$data) {
    die("No se pudo decodificar la respuesta JSON.");
}

echo "<h2>{$data['name']}</h2>";
echo "<img src='{$data['sprites']['front_default']}' alt='{$data['name']}'>";
echo "<p>Altura: " . ($data['height'] / 10) . " m</p>";
echo "<p>Peso: " . ($data['weight'] / 10) . " kg</p>";
?>
```

---

- Nombre: Pikachu
![pikachu](https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png)
- Altura: 0.4 m
- Peso: 6 kg

---

## 4. Obtener datos de Star Wars con SWAPI
La API de Star Wars permite consultar información de personajes, naves, planetas, etc.


```php
<?php
$character_id = 1; // Luke Skywalker
$url = "https://swapi.dev/api/people/$character_id/";
$response = file_get_contents($url);
$data = json_decode($response, true);

echo "<h2>{$data['name']}</h2>";
echo "<p>Altura: {$data['height']} cm</p>";
echo "<p>Peso: {$data['mass']} kg</p>";
echo "<p>Color de cabello: {$data['hair_color']}</p>";
?>
```

Salida esperada
```yaml

Luke Skywalker
Altura: 172 cm
Peso: 77 kg
Color de cabello: Rubio
```


## 5. Obtener datos meteorológicos con OpenWeatherMap
OpenWeatherMap ofrece información en tiempo real del clima en cualquier ciudad.

```php
<?php
$apiKey = "TU_API_KEY"; // Regístrate en https://openweathermap.org/
$city = "Madrid";
$url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=metric";

$response = file_get_contents($url);
$data = json_decode($response, true);

echo "<h2>Clima en {$data['name']}</h2>";
echo "<p>Temperatura: {$data['main']['temp']}°C</p>";
echo "<p>Humedad: {$data['main']['humidity']}%</p>";
echo "<p>Condición: {$data['weather'][0]['description']}</p>";
?>
```

Salida esperada
```makefile
Clima en Madrid
Temperatura: 22°C
Humedad: 50%
Condición: cielo despejado
```

## 6. Obtener datos curiosos sobre números con NumbersAPI
NumbersAPI devuelve datos aleatorios sobre cualquier número.

```php
<?php
$number = 42;
$url = "http://numbersapi.com/$number";
$response = file_get_contents($url);

echo "<p>$response</p>";
?>
```

Salida esperada
```css
42 es el significado de la vida, el universo y todo lo demás según la "Guía del autoestopista galáctico".
```

## 7. Obtener actividades aleatorias con BoredAPI
Esta API sugiere cosas para hacer cuando estás aburrido.

```php
<?php
$url = "https://www.boredapi.com/api/activity";
$response = file_get_contents($url);
$data = json_decode($response, true);

echo "<p>Actividad sugerida: {$data['activity']}</p>";
?>
```
Salida esperada
```less
Actividad sugerida: Aprende a tocar un nuevo instrumento musical.
```

