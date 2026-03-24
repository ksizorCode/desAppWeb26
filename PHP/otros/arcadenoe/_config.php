<?php

$admin=1; // es admin?

const DEBUG = 0;

const TITULO_SITE = 'Arca de Noé';

// Archivo que almacena todos los contenidos reutilizbles
const URL = 'http://aa.local/arcadenoe';
const RUTA = './inc';
const RUTA_IMG = './assets/img/';


// Base de datos
const HOST = "localhost";
const USER = "root";
const PASS = "root";
const DBNA = "arcadenoe";





/////// FUNCIONES ////////////////////////

function cargar($bloque){
    switch($bloque){
        case 'header':
        case 'cabecera':
            include RUTA.'/_header.php';
            break;
        case 'footer':
            include RUTA.'/_footer.php';
            break;
        default:
            include RUTA.'/'.$bloque.'.php';
    }
}

//cargar('header');

function cargarCabecera(){
    cargar('header');
}

function cargarPie(){
    cargar('footer');
}



//Titulo

function titulo(){
    global $titulo;
    if(isset($titulo)){
        echo $titulo;
        echo " - ";
    }
    echo TITULO_SITE;
}


// BASE DE DATOS

// $sql = "SELECT id_animal, nombre_animal, foto_animal, descripcion, nombre_especie FROM animales, especies WHERE animales.id_especie = especies.id_especie ORDER BY nombre_animal ASC";
// $result =consulta($sql,true);



function consulta($sql, $devuelve=false){
    
    
    // Create connection
    $conn = mysqli_connect(HOST, USER, PASS, DBNA);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    if($devuelve){
        return mysqli_query($conn, $sql);
    }

    //Cerrar consulta
    mysqli_close($conn);

}
