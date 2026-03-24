<?php

// TODO LO QUE PONGA AQUÍ SERÁ USUADO EN TODOS LOS APARTADOS


function _logueado(){ //comprueba si estoy logueado
    session_start();
    if (isset($_SESSION['logueado'])) {
        return true;
    }
    else{
        return false;
    }

    

}