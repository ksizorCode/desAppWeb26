<?php

const DEBUG=1;

const LANG = 'es-ES';
const SITENAME = 'FicxTorico';

const MAINMENU = [
    ["name" => "Inicio", "url" => "index.php"],
    ["name" => "Contacto", "url" => "contacto.php"]
];

const RUTES = [
    "includes" =>   "inc/",
    "includes" =>   "assets/img/",
    "css" =>        "assets/css/style.css",
    "js" =>         "assets/js/",
    "fonts" =>      "assets/fonts/",
    "header" =>     "inc/_header.php",
    "footer" =>     "inc/_footer.php"
];


function inc($elemento){
    include rutas($elemento);
}

function get($elemento){
    return rutas($elemento);
}

function rutas($elemento){
    switch($elemento){
        case 'header':
        case 'footer':
            return RUTES[$elemento];
        case 'css':
            return RUTES[$elemento] . "?v=" . time(); // Agrega timestamp para evitar caché
        default:
            return $elemento;
    }
}


// Si debug está activado.
function debug($mensaje="Debug mode on"){
    if(DEBUG){
        echo "<div class='debug'>$mensaje</div>";
    }
}


// Función para generar el título de la página
function titulo() {
    if (defined('TITULO') && TITULO !== '') {
        echo TITULO . " - ";
    }
    echo SITENAME;
}

// Función para generar el menú de navegación
function menu($array = MAINMENU, $class = 'mainmenu') {
    $mihtml = ''; // Inicializar variable vacía
    foreach ($array as $i) {
        $mihtml .= "<li><a href='{$i['url']}'>{$i['name']}</a></li>";
    }

    echo "<nav><ul class='$class'>$mihtml</ul></nav>";
}




// Función para incluir la cabecera
function meHeader() {
    inc('header');
}

// Función para incluir el pie de página
function meFooter() {
    inc('footer');
}


?>
