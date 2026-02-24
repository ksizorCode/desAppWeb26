<?php
include 'functions.php';

// https://dominio.com/?page=algo
$page = $_GET['page'] ?? 'home'; 


include 'inc/header.php';
include 'views/'.$page.'.php';
include 'inc/footer.php';


?>