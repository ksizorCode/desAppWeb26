<?php
include 'functions.php';

$page = $_GET['page'] ?? 'home'; 

/* Capturamos la vista en bufer para mostrar el title antes de imprimir el contenido */
ob_start();
include "views/$page.php";
$content = ob_get_clean();

$titulo = $title ?? 'Mini CRM';


include 'inc/header.php';
echo $content;
include 'inc/footer.php';


