<?php
//cargamos el archivo JSON
$json=file_get_contents('datos.json');

//convertimos $json a array PHP
$arrayDatos = json_decode($json, true);

//mostrar datos del array
echo '<pre><code>';
print_r($arrayDatos);
echo '</pre></code>';  

