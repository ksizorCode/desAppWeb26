<?php
include 'config.php';
$json = file_get_contents('data.json');
$data = json_decode($json, true);

const DEBUG = true;

function debug($valor){
    if (DEBUG) {
        echo '<pre>';
        print_r($valor);
        echo '</pre>';
    }
}


debug($data);

function titulo(){
    global $data;
    echo $data['site']['title'] ?? 'Sin título';
}