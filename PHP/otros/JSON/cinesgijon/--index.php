<h1> Cines Gijón</h1>
<?php

$archivo = 'cartelera.json';

if(file_exists($archivo)){
    $miJSON = file_get_contents($archivo);

    $listaPeliculas = json_decode($miJSON,true);

    // $listaPeliculas = json_decode(file_get_contents('cartelera.json'),true);
}
else{
    echo "Parece que el archivo $archivo no existe. 😥";
}


if(isset($listaPeliculas)){
    echo '<ul class="cartelera">';
    foreach($listaPeliculas['pelisCartelera'] as $pelicula){
        echo "
        <li>
            <img src='{$pelicula['cartel']}' alt='Película {$pelicula['titulo']} dirigida por {$pelicula['director']} vela en el mejor cine de gijón con la máxima calidad, aquí ligas fijo.'>
            <h2>{$pelicula['titulo']}</h2>
            <p>{$pelicula['director']}</p>
        </li>";
    }
    echo '</ul>';
}







echo '<pre>';
    print_r($listaPeliculas);
echo '</pre>';





?>