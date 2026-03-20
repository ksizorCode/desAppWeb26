<?php

$debug= 0;
_session_logueado();

function _debug($message){
    global$debug;
    if($debug)
    {
        echo '<div class="debug">';
        echo $message;
        echo '</div>';
    }

}

_debug('👁‍🗨 estás en modo desarrollo');


  


//mostrar el array
function debugPrint_r($array){
    global $debug;
    if($debug)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}


function cargarJSON($archivo){
        // cargar el JSON
    if (file_exists($archivo))
    {
        $miJSON=file_get_contents($archivo);
        $miArray=json_decode($miJSON,'true');
        return $miArray;
    }
    else{
        echo "No hemos guardado nada";
    }
        
}

/**** hasta aquí luego pa config.php */



// INICIO DE SESIÓN -------
function _session_logueado() {
    global $logueado; // Usamos la variable global
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
        _debug('sesion_start');

    if (!empty($_SESSION['logueado']) && $_SESSION['logueado'] === true) {
        _debug("<p>✅ Bienvenido; Has iniciado sesión.</p>");
        $logueado = true; // Modificamos la variable global
    } else {
        _debug("<p>⛔ No has iniciado sesión.</p>");
        $logueado = false; // Modificamos la variable global
    }
    _debug("Logueado dentro de la función: " . ($logueado ? '✅' : '⛔'));
}
_debug("Logueado dentro de la función: " . ($logueado ? '✅' : '⛔'));

//echo $saludo = isset($_SESION['logueado']) ? "tas dentro" : "tas fuera";






_debug("🟦 Logueado: $logueado");  
?>