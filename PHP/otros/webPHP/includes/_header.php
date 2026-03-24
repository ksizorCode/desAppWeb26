<?php

//Si la variable $descApt existe:
if(isset($descApt)){
    // escribe su valor
    $miDescripcion = $descApt;
    }
    else{
        // si no existe escribe el contenido de $datos (en _config.php)
        $miDescripcion = $datos['descripcion'];
    }



?>



<!DOCTYPE html>
<html lang="<? echo $datos['lang']?>">
<head>
    <meta charset="<? echo $datos['charset']?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><? echo $titulo?> - <? echo $datos['tituloSite']?></title>
    <!-- CSS -->
    <link rel="stylesheet" href="style.css<? if($debug) echo '?v='.time()?>">
    
<!-- Meta para Posicionamiento y temas de aspecto e imagen -->


    <!-- SEO Básico -->
    <meta name="description" content=" <? echo $miDescripcion?>">
    <meta name="keywords" content="<? echo $datos['metaKeywords']?>">
    <meta name="author" content="<? echo $datos['autor']?>">
    
    <!-- SEO Open Graph (Para compartir en Facebook, LinkedIn, etc.) -->
    <meta property="og:title" content="<? echo $titulo?> - <? echo $datos['tituloSite']?>">
    <meta property="og:description" content="<? echo $miDescripcion?>">
    <meta property="og:image" content="https://www.astralavista.com/assets/img/og-image.jpg">
    <meta property="og:url" content="https://www.astralavista.com/">
    <meta property="og:type" content="website">
    
    <!-- SEO Twitter Card (Para compartir en Twitter) -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<? echo $titulo?> - <? echo $datos['tituloSite']?>">
    <meta name="twitter:description" content="<? echo $miDescripcion?>">
    <meta name="twitter:image" content="https://www.astralavista.com/assets/img/twitter-card.jpg">
    <meta name="twitter:site" content="@AstraLavista">

    <!-- SEO Adicional -->
    <meta name="theme-color" content="#1E1E2E"> <!-- Color para navegadores móviles -->
    <meta name="language" content="es">
    <meta name="geo.region" content="ES-AST"> <!-- Código de Asturias, España -->
    <meta name="geo.placename" content="Asturias">
    <meta name="geo.position" content="43.3614;-5.8593"> <!-- Coordenadas de Asturias -->
    <meta name="ICBM" content="43.3614, -5.8593">

    <!-- Favicon -->
    <link rel="icon" href="https://www.astralavista.com/assets/img/favicon.ico" type="image/x-icon">

</head>
<body>
    <header>
    <? echo $datos['tituloSite']?>
    <? constructorMenu();?>
    

</header>
<main>
    <h1><? echo $titulo?></h1>


    <p>trasteando con el código</p>
    
 