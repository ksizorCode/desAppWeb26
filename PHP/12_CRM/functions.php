<?php
include 'config.php';
$json = file_get_contents('data.json');
$data = json_decode($json, true);

// -- MODO DEBUG -------------//

/**
 * Si DEBUG está activado muestra el print_r del $array
 */
function debug($array){
    if (DEBUG) {
        echo '<pre><code>';
        print_r($array);
        echo '</code></pre>';
    }
}


/**
 * Imprime titulo del apartado
 */
function titulo(){
    global $titulo;
    echo $titulo ?? 'Sin título';
}


function appTitulo(){
    global $data;
        echo $data['site']['title'] ?? 'Sin título';
}


/**
 * Imprime descripción del apartado. Si existe añade el meta description, si no: no.
 */
function description(){
    global $data;

    if (isset($data['site']['description'])) {
        echo '<meta name="description" content="' . $data['site']['description'] . '">';
    }
}