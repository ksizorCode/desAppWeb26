<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Teresa Museo</title>


    <!-- Estilos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">

    <!-- PWA: Manifest -->
    <link rel="manifest" href="/manifest.json">

    <!-- PWA: Configuración móvil -->
    <meta name="theme-color" content="#4157af">
    <meta name="background-color" content="#ffffff">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Museo">

    <!-- PWA: Iconos para iOS -->
    <link rel="apple-touch-icon" sizes="192x192" href="/icons/icon-192x192.png">
    <link rel="apple-touch-icon" sizes="512x512" href="/icons/icon-512x512.png">
</head>





</head>     
<body>
<header> 
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="expo.php">Exposiciones</a></li>
            <li><a href="logout.php">CerrarSesión</a></li>
            <li><a href="contacto.php">Contacto</a></li>

<?php
    if($logueado){
        echo '<li class="login"><a href="admin.php"><img src="assets/img/avatar.png"></a></li>';
        }
    else{
        echo '<li><a href="login.php">Login</a></li>';
    }
?>

        </ul> 
    </nav>
</header>
<main>