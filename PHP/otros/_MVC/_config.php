<?php

const THEME = 'tema1';

const LANG='es-ES';                    

const TITULOSITE ='Fontaneria Manolin'; 


// Función que llama al header (include)
function get_header(){
    include_once 'themes/'.THEME.'/_header.php';
}


// Función que llama al footer (include)
function get_footer(){
    include_once 'themes/'.THEME.'/_footer.php';
}


// Construye la estructura de un menú
function menu(){
    echo '<nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="servicios.php">Servicios</a></li>
                <li><a href="contacto.php">Contacto</a></li>
            </ul>
        </nav>';
}