<?php


/*
// Campos capturados del formulario
$campos=[
    'nombre',
    'email',
    'mensaje'
];

$miHTML='';

foreach($campos as $valor){
    $miHTML.= "<p>{$_POST[$valor]}</p>";
}

echo $miHTML;
*/


//Valores de mi emprea y valores capturados del formulario
$miEmail='moises@hoymejortabadurmiendo.com';
$nombre= $_POST['nombre'];
$email= $_POST['email'];
$mensaje= $_POST['mensaje'];



$to = 'hola@mail.com';
$subject = 'Oferta especial';
$msg = "<style>body{font-family:sans-serif;}</style>
        <h1>Hola!</h1>";

$headers = "From: tuemail@example.com\r\n
            MIME-Version: 1.0\r\n
            Content-Type: text/html; charset=UTF-8\r\n";

mail($to, $subject, $msg, $headers);
